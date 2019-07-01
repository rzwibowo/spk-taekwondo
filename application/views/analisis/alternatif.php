<div class="row" id="main">
	<div class="col-md-12">
		<div class="card">
			<div class="card-body">
				<h4 class="card-title text-center">Perbandingan Alternatif</h4>
			</div>

			<!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist" id="alt-tab">
                <li class="nav-item" v-for="(alt, i) in alternatifs">
					<a class="nav-link" :class="i === 0 ? 'active' : ''"
						@click="active_tab = i + 1"
						data-toggle="tab" :href="'#alt-' + alt.id_tempat_latihan"
						role="tab">
                        <span class="hidden-sm-up"></span>
                        <span class="hidden-xs-down">{{ alt.nama }}</span>
                    </a>
                </li>
            </ul>
            <!-- Tab panes -->
            <div class="tab-content tabcontent-border">
				<div class="tab-pane" v-for="(alt, i) in alternatifs" 
					:id="'alt-' + alt.id_tempat_latihan" 
					:class="i === 0 ? 'active' : ''" role="tabpanel">
                    <div class="col-md-8 offset-md-2">
                        <div class="card">
							<div class="card-body">
								<h4 class="card-title text-center">{{ alt.nama }}</h4>
								<div class="form-group row" v-for="(krt, j) in alt.kriteria" v-if="krt.is_multi == 1">
									<label class="col-md-3 text-right control-label col-form-label">
										{{ krt.nama_kriteria }}
									</label>
									<div class="col-md-9">
										<table class="table table-sm">
											<thead>
												<tr>
													<th>Subkriteria</th>
													<th class="text-right">Jumlah</th>
												</tr>
											</thead>
											<tfoot>
												<tr>
													<td class="text-right">Rata-rata</td>
													<td>
														<input type="number" 
															class="form-control form-control-sm text-right float-right"
															v-model="krt.rata_rata" 
															readonly style="width: 7em">
													</td>
												</tr>
											</tfoot>
											<tbody>
												<tr v-for="(subk, k) in krt.subkriteria">
													<td>{{ subk.bobot_kriteria }} | {{ subk.nama_sub }}</td>
													<td>
														<input type="number"
															class="form-control form-control-sm text-right float-right"
															min="0"
															style="width: 7em"
															v-model="subk.nilai"
															@change="hitungRataRata(krt.subkriteria,krt)">
													</td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
								<div class="form-group row" v-for="(krt, j) in alt.kriteria" v-if="krt.is_multi == 0">
									<label class="col-md-3 text-right control-label col-form-label">
										{{ krt.nama_kriteria }}
									</label>
									<div class="col-md-6">
										<select class="form-control"
											v-model="krt.rata_rata">
											<option v-for="subk in krt.subkriteria"
												:value="subk.bobot_kriteria">
												{{ subk.bobot_kriteria }} | {{ subk.nama_sub }}
											</option>
										</select>
									</div>
								</div>
							</div>
                        </div>
                    </div>
                </div>
            </div>

			<div class="card-body">
				<div class="row">
					<div class="col">
						<button class="btn btn-secondary" @click="activateTab(--active_tab)" 
							:disabled="active_tab === 1 ? true : false">
							<i class="mdi mdi-arrow-left-bold-circle-outline"></i>
						</button>
					</div>
					<div class="col text-center">
						Alternatif {{ active_tab }} -
						{{ alternatifs.length !== 0 ? alternatifs[active_tab - 1].nama : "..." }}
					</div>
					<div class="col text-right">
						<button class="btn btn-secondary" @click="activateTab(++active_tab)"
							:disabled="active_tab === alternatifs.length ? true : false">
							<i class="mdi mdi-arrow-right-bold-circle-outline"></i>
						</button>
					</div>
				</div>
			</div>

			<div class="card-body">
				<div class="row">
					<table class="table table-sm">
						<thead>
							<tr>
								<th>Bobot</th>
								<th v-for="i in 5" style="text-align: center;">{{ i }}</th>
							</tr>
							<tr>
								<th>Kriteria</th>
								<th v-for="krt in kriterias"
									style="vertical-align: middle; text-align: center;"
									rowspan="2">
									{{ krt.nama_kriteria }}
								</th>
							</tr>
							<tr>
								<th>Alternatif</th>
							</tr>
						</thead>
						<tfoot>
							<tr>
								<td></td>
								<td v-for="mm in maxmin" style="text-align: center;">
									{{ mm }}
								</td>
							</tr>
						</tfoot>
						<tbody>
							<tr v-for="alt in alternatifs">
								<td>{{ alt.nama }}</td>
								<td v-for="nk in alt.kriteria" style="text-align: center;">
									{{ nk.rata_rata }}
								</td>
							</tr>
							<tr>
								<td>Min/Max</td>
								<td v-for="krt in kriterias" style="text-align: center;">
									{{ krt.min_max }}
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<script src="<?php echo base_url() ?>assets/js/vue.js"></script>
<script src="<?php echo base_url() ?>assets/js/axios.min.js"></script>

<script>
	const main_script = new Vue({
		el: '#main',
		data: {
			alternatifs: [],
			kriterias: [],
			maxmin: [],
			active_tab: 1
		},
		mounted: function () {
			this.getListAlt();
		},
		methods: {
			getListAlt: async function () {
				await axios.get(server_host + '/api/TempatLatihan/ambilTl')
				.then(res => {
					this.alternatifs = res.data;
					this.kriterias = res.data[0].kriteria.map(kr => {
						return {
							id_kriteria: kr.id_kriteria,
							is_multi: kr.is_multi,
							min_max: kr.min_max,
							nama_kriteria: kr.nama_kriteria
						};
					})
				})
				.catch(err => console.error(err));
			},
			hitungRataRata: function (subK,Krt) {
				for (var i = 0 ; i < subK.length; i++) {
					subK[i].jumlah  = parseInt(subK[i].bobot_kriteria) * parseInt(subK[i].nilai);
				}
				Krt.rata_rata = Math.ceil(subK.reduce((a, b) => a + (b['jumlah'] || 0), 0)/subK.length);
			},
			cariMaxMin: function() {
				this.maxmin = this.kriterias.map(kr => {
					return 0;
				});

				this.kriterias.forEach((kr, i) => {
					const kondisi = kr.min_max;
				// 	const nilai_alternatif = this.alternatifs.map(alt => {
				// 		return alt.kriteria
				// 	}).map(altn => {
				// 		return altn.map(altn_ => {
				// 			return {
				// 				id: altn_.id_kriteria,
				// 				rt: altn_.rata_rata
				// 			}
				// 		})
				// 	}).map(altnf => altnf.filter(altnf_ => {
				// 			return altnf_.id === kr.id
				// 		})
				// 	).flatMap(a => {
				// 		return a.flatMap(b => {
				// 			return b.rt
				// 		})
					});

				// 	this.maxmin = kondisi === 'max'
				// 		? this.maxmin[i] = Math.max(...nilai_alternatif)
				// 		: this.maxmin[i] = Math.min(...nilai_alternatif);
				// });
			},
			activateTab: function (tab_index) {
				$(`#alt-tab li:nth-child(${tab_index}) a`).tab('show');
			}
		}
	})
</script>