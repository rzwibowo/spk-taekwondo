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
								<div class="form-group row" v-for="(krt, j) in kriterias.kriteria_multi">
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
															v-model="nilai_subkriteria[i][j].rata_rata" 
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
															style="width: 7em"
															v-model="nilai_subkriteria[i][j].nilai[k]"
															@change="hitungRataRata(i, j)">
													</td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
								<div class="form-group row" v-for="(krt, j) in kriterias.kriteria_nomulti">
									<label class="col-md-3 text-right control-label col-form-label">
										{{ krt.nama_kriteria }}
									</label>
									<div class="col-md-6">
										<select class="form-control"
											v-model="nilai_alternatif[i].nilai[j + kriterias.kriteria_multi.length]">
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
			kriterias: {
				kriteria_nomulti: [],
				kriteria_multi: []
			},
			bobot_subkriteria_multi: [],
			nilai_alternatif: [],
			nilai_subkriteria: [],
			active_tab: 1
		},
		mounted: function () {
			this.getListKr();
		},
		methods: {
			getListAlt: async function () {
				await axios.get(server_host + '/api/TempatLatihan/ambilTl')
				.then(res => {
					this.alternatifs = res.data;
					this.nilai_alternatif = res.data.map(alt => {
						return { 
							id_alternatif: alt.id_tempat_latihan,
							nama_alternatif: alt.nama,
							nilai: this.kriterias.kriteria_multi.map(kr => {
								return 0;
							}).concat(this.kriterias.kriteria_nomulti.map(kr => {
								return 0;
							}))
						};
					});
				})
				.catch(err => console.error(err));
			},
			getListKr: async function () {
				await axios.get(server_host + '/api/Kriteria/ambilKrtDanSub')
				.then(async res => {
					this.kriterias.kriteria_nomulti = await res.data.filter(kr => {
						return kr.is_multi === '0'
					});

					this.kriterias.kriteria_multi = await res.data.filter(kr => {
						return kr.is_multi === '1'
					});

					this.bobot_subkriteria_multi = await this.kriterias.kriteria_multi.map(kr => {
						return {
							id_kriteria: kr.id_kriteria,
							nama_kriteria: kr.nama_kriteria,
							bobot_subkriteria: kr.subkriteria.map(sub => {
								return sub.bobot_kriteria;
							})
						};
					});

					// ambil hanya kriteria yg subkriterianya multi
					this.nilai_subkriteria = await this.kriterias.kriteria_multi;

					// ambil alternatif
					await this.getListAlt();
					
					// buat array untuk nilai subkriteria multi tiap alternatif
					this.nilai_subkriteria = await this.alternatifs.map(alt => {
						const _mapped = this.nilai_subkriteria.map((kr,i) => {
							return {
								id_alternatif: alt.id_tempat_latihan,
								id_kriteria: kr.id_kriteria,
								nilai: this.kriterias.kriteria_multi[i].subkriteria.map(sub =>{
									return 0;
								}),
								rata_rata:0,
							}
						});
						return _mapped;
					})
				})
				.catch(err => console.error(err));
			},
			hitungRataRata: function (indexA, indexK) {
				this.nilai_alternatif[indexA].nilai[indexK] = 
					this.nilai_subkriteria[indexA][indexK].nilai.map((ns, i) => {
						return ns === '' || ns === null ? 0 : parseInt(ns) * parseInt(this.bobot_subkriteria_multi[indexK].bobot_subkriteria[i]);
					});

				this.nilai_subkriteria[indexA][indexK].rata_rata = this.nilai_subkriteria[indexA][indexK].nilai.reduce((a, b) => parseInt(a) + parseInt(b), 0);
			},
			activateTab: function (tab_index) {
				$(`#alt-tab li:nth-child(${tab_index}) a`).tab('show');
			}
		}
	})
</script>