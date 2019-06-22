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
								<div class="form-group row" v-for="krt in kriterias">
									<template v-if="krt.is_multi === '0'">
										<label class="col-md-3 text-right control-label col-form-label">
											{{ krt.nama_kriteria }}
										</label>
										<div class="col-md-6">
											<select class="form-control">
												<option v-for="subk in krt.subkriteria">
													{{ subk.bobot_kriteria }} | {{ subk.nama_sub }}
												</option>
											</select>
										</div>
									</template>
									<template v-else>
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
																readonly style="width: 7em">
														</td>
													</tr>
												</tfoot>
												<tbody>
													<tr v-for="subk in krt.subkriteria">
														<td>{{ subk.bobot_kriteria }} | {{ subk.nama_sub }}</td>
														<td>
															<input type="number"
																class="form-control form-control-sm text-right float-right"
																style="width: 7em">
														</td>
													</tr>
												</tbody>
											</table>
										</div>
									</template>
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
			kriterias: [],
			active_tab: 1
		},
		mounted: function () {
			this.getListAlt();
			this.getListKr();
		},
		methods: {
			getListAlt: function () {
				axios.get(server_host + '/api/TempatLatihan/ambilTl')
				.then(res => this.alternatifs = res.data)
				.catch(err => console.error(err));
			},
			getListKr: function () {
				axios.get(server_host + '/api/Kriteria/ambilKrtDanSub')
				.then(res => this.kriterias = res.data)
				.catch(err => console.error(err));
			},
			activateTab: function (tab_index) {
				$(`#alt-tab li:nth-child(${tab_index}) a`).tab('show');
			}
		}
	})
</script>