<div class="row" id="main">
	<div class="col-md-12">
		<div class="card">
			<div class="card-body">
				<h4 class="card-title text-center">Input Nilai Alternatif</h4>
			</div>

			<div class="card-body">
				<div class="row">
						<table class="table table-sm">
								<thead>
									<tr>
										<th>Alternatif</th>
										<th v-for="(krt, i) in alternatifs.header">{{krt.nama_kriteria}}</th>
									</tr>
								</thead>
								<tbody>
								<tr v-for="(alt , i) in alternatifs.data">
									<th>{{alt.nama}}</th>
									<th v-for="(krt,i) in alt.kriteria">
										<table class="table table-sm" v-if="krt.is_multi == 1">
											<tr>
												<td v-for="(subk, k) in krt.subkriteria" class="text-center">{{ subk.bobot_kriteria }}</td>
											</tr>
										    <tr>
												<td v-for="(subk, k) in krt.subkriteria">{{ subk.nama_sub }}</td>
											</tr>
											 <tr>
												<td v-for="(subk, k) in krt.subkriteria">
													<input type="number"
																class="form-control form-control-sm text-right float-right"
																min="0"
																style="width: 7em"
																v-model="subk.nilai"
																@change="hitungRataRata(krt.subkriteria,krt)">
												</td>
											</tr>
											<tr>
												<td :colspan="krt.subkriteria.length" >
												<input type="number" 
												class="form-control form-control-sm" 
												v-model="krt.rata_rata" 
												readonly style="width: 7em">
												</td>
											</tr>
										</table>
										<table class="table table-sm" v-if="krt.is_multi == 0">
											 <tr>
												<td>
													<select class="form-control form-control-sm"
													v-model="krt.rata_rata">
														<option v-for="subk in krt.subkriteria"
														:value="subk.bobot_kriteria">
														{{ subk.bobot_kriteria }} | {{ subk.nama_sub }}
														</option>
													</select>
												</td>
											</tr>
										</table>
									</th>
								</tr>
								</tbody>
						</table>
					<div class="col text-right">
						<button class="btn btn-primary" @click="Simpan()"> SIMPAN
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
		created: function () {
			this.checkLevel();
		},
		mounted: function () {
			this.getListAlt();
		},
		methods: {
			checkLevel: function () {
				const level = JSON.parse(sessionStorage.getItem('auth_spk_tkwd')).level;
				if (level === 'user') {
					toastr.warning('Kembali ke halaman sebelumnya', 'Anda tidak memiliki akses');
					history.back();
				}
			},
			getListAlt: async function () {
				await axios.get(server_host + '/api/TempatLatihan/ambilTl')
				.then(res => {
					this.alternatifs = res.data;
				})
				.catch(err => console.error(err));
			},
			hitungRataRata: function (subK,Krt) {
				for (var i = 0 ; i < subK.length; i++) {
					subK[i].jumlah  = parseInt(subK[i].bobot_kriteria) * parseInt(subK[i].nilai);
				}
				Krt.rata_rata = Math.ceil(subK.reduce((a, b) => a + (b['jumlah'] || 0), 0)/subK.length);
			},
			activateTab: function (tablist_id, tab_index) {
				$(`#${tablist_id} li:nth-child(${tab_index}) a`).tab('show');
			},
			Simpan:function()
			{
				var data = {
					user : JSON.parse(sessionStorage.getItem('auth_spk_tkwd')).id_user ,
					alternatif: this.alternatifs
				};
				//console.log(data);
				axios.post(server_host + '/api/Analisa/saveNilaiPerbandiganAlternatif', {
					body: data
				}).then(res => {
					toastr.success('Data disimpan', 'Berhasil');
				}).catch(err => console.error(err));
			}
		}
	})
</script>
