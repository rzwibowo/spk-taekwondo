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
								<th v-for="bbtdet in bobot" style="text-align: center;">{{ bbtdet }}</th>
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
				<div class="row">
					<div class="col-md-6">
						<button type="button" class="btn btn-primary" @click="getListBobotKriteria">Pilih Bobot Kriteria</button>
					</div>
					<div class="col-md-6"></div>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="Modal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true ">
        <div class="modal-dialog" role="document ">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Pilih Bobot</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true ">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Tanggal Input</th>
									<th>User</th>
									<th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="bbt in bobots">
                                    <td>{{ bbt.tanggal_buat }}</td>
                                    <td>{{ bbt.username }}</td>
                                    <td>
										<button type="button" class="btn btn-default" 
											@click="getBobotKriteria(bbt.analisis_kriteria_id)">Ambil Bobot
										</button>
									</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
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
			bobots: [],
			bobot: [],
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
					const alternatif = this.alternatifs.map(alt => alt.kriteria);
					const list_krt = [];

					alternatif.forEach(krt => 
						krt.forEach(sub => {
							list_krt.push(
								{
									id: sub.id_kriteria, 
									rt: sub.rata_rata
								}
							)
						})
					)

					const nilai_alt = list_krt.filter(nil => 
						nil.id == kr.id_kriteria
					).map(nil => 
						parseInt(nil.rt)
					)

					this.maxmin[i] = kondisi === 'max'
						? Math.max(...nilai_alt)
						: Math.min(...nilai_alt)
				});
			},
			getListBobotKriteria: function () {
				axios.get(server_host + '/api/analisa/ambilListAnalisis')
				.then(res => {
					this.bobots = res.data;

                    $('#Modal1').modal('show');
				})
				.catch(err => console.error(err));
			},
			getBobotKriteria: function (id_analisis) {
				axios.get(server_host + '/api/analisa/ambilAnlsDenganId/' + id_analisis)
				.then(res => {
					this.kriterias.forEach(kr => {
						this.bobot.push(
							parseFloat(res.data.filter(bbt => 
								bbt.kriteria_id == kr.id_kriteria
							)[0].bobot)
						)
					});

                    $('#Modal1').modal('hide');
				})
				.catch(err => console.error(err));
			},
			activateTab: function (tab_index) {
				$(`#alt-tab li:nth-child(${tab_index}) a`).tab('show');
			}
		}
	})
</script>