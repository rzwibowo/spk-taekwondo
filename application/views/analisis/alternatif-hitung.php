<div class="row" id="main">
	<div class="col-md-12">
		<div class="card">
			<div class="card-body">
				<h4 class="card-title text-center">Perbandingan Alternatif</h4>
			</div>

			<ul class="nav nav-pills nav-fill" role="tablist" id="process-tab">
				<li class="nav-item">
					<a href="#hitung" class="nav-link active"
						data-toggle="tab" role="tab"
						@click="active_outer_tab = 1">
						Penghitungan
					</a>	
				</li>
				<li class="nav-item">
					<a href="#hasil" class="nav-link"
						data-toggle="tab" role="tab"
						@click="active_outer_tab = 2">
						Hasil Pemeringkatan
					</a>	
				</li>
			</ul>

			<div class="tab-content tabcontent-border">
				<div class="tab-pane active" id="hitung" role="tabpanel">
					<!-- #region Tabel Keputusan -->
					<div class="card-body">
						<h4 class="card-title m-b-0">Tabel Keputusan</h4>
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
							<div class="col text-right">
								<button type="button" class="btn btn-primary" @click="getListBobotKriteria">Pilih Bobot Kriteria</button>
								<button type="button" class="btn btn-primary" @click="hitung" :disabled="bobot.length === 0">Hitung</button>
							</div>
						</div>
					</div>
					<!-- #endregion Tabel Keputusan -->

					<!-- #region Tabel Normalisasi -->
					<div class="card-body">
						<h4 class="card-title m-b-0">Tabel Normalisasi</h4>
						<div class="row">
							<table class="table table-sm">
								<thead>
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
								<tbody>
									<tr v-for="nrm in normalisasi">
										<td>{{ nrm.nm }}</td>
										<td v-for="n in nrm.nilai" style="text-align: center">{{ n }}</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
					<!-- #endregion Tabel Normalisasi -->

					<!-- #region Tabel Pemeringkatan -->
					<div class="card-body">
						<h4 class="card-title m-b-0">Tabel Pemeringkatan</h4>
						<div class="row">
							<table class="table table-sm">
								<thead>
									<tr>
										<th>Kriteria</th>
										<th v-for="krt in kriterias"
											style="vertical-align: middle; text-align: center;"
											rowspan="2">
											{{ krt.nama_kriteria }}
										</th>
										<th rowspan="2"
											style="vertical-align: middle; text-align: center;">
											Jumlah
										</th>
									</tr>
									<tr>
										<th>Alternatif</th>
									</tr>
								</thead>
								<tbody>
									<tr v-for="prg in pemeringkatan">
										<td>{{ prg.nm }}</td>
										<td v-for="p in prg.nilai" style="text-align: center">{{ p }}</td>
										<td style="text-align: center">{{ prg.jumlah }}</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
					<!-- #endregion Tabel Pemeringkatan -->
				</div>

				<div class="tab-pane" id="hasil" role="tabpanel">
					<!-- #region Hasil Peringkat -->
					<div class="card-body">
						<h4 class="card-title m-b-0">Tabel Hasil Peringkat</h4>
						<div class="row">
							<table class="table table-sm">
								<thead>
									<tr>
										<th>Peringkat</th>
										<th>Tempat Latihan</th>
										<th>Jumlah Nilai</th>
									</tr>
								</thead>
								<tbody>
									<tr v-for="(hprg, i) in peringkat">
										<td>{{ ++i }}</td>
										<td>{{ hprg.nm }}</td>
										<td>{{ hprg.jumlah }}</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
					<!-- #endregion Hasil Peringkat -->
				</div>
			</div>

			<div class="card-body">
				<div class="row">
					<div class="col">
						<button class="btn btn-primary" @click="activateTab('process-tab', --active_outer_tab)" 
							:disabled="active_outer_tab === 1 ? true : false">
							<i class="mdi mdi-arrow-left-bold-circle-outline"></i>
							Sebelumnya
						</button>
					</div>
					<div class="col text-right">
						<button class="btn btn-primary" @click="activateTab('process-tab', ++active_outer_tab)"
							:disabled="active_outer_tab === 2 ? true : false">
							Selanjutnya
							<i class="mdi mdi-arrow-right-bold-circle-outline"></i>
						</button>
					</div>
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
			normalisasi: [],
			pemeringkatan: [],
			peringkat: [],
			active_tab: 1,
			active_outer_tab: 1
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
				this.bobot = [];
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
			hitungNormalisasi: function () {
				this.normalisasi = this.alternatifs.map((alt, i) => {
					const id = alt.id_tempat_latihan;
					const nm = alt.nama;
					const nilai = [];
					alt.kriteria.forEach((krt, j) => {
						nilai.push(
							parseFloat(krt.rata_rata) / this.maxmin[j]
						);
					});
					return {
						id: id,
						nm: nm,
						nilai: nilai
					};
				});
			},
			hitungPeringkat: function () {
				this.pemeringkatan = this.normalisasi.map(nrm => {
					const id = nrm.id;
					const nm = nrm.nm;
					const nilai = [];
					let jumlah = 0;
					nrm.nilai.forEach((nil, i) => {
						const nilai_baris = this.bobot[i] * nil;
						
						nilai.push(
							nilai_baris
						);
						jumlah += nilai_baris;
					});
					return {
						id: id,
						nm: nm,
						nilai: nilai,
						jumlah: jumlah
					};
				});
			},
			urutkanPeringkat: function () {
				this.peringkat = this.pemeringkatan.slice(0)
					.sort((a, b) => b.jumlah - a.jumlah)
					.map(prg => {
						return {
							id: prg.id,
							nm: prg.nm,
							jumlah: prg.jumlah
						}
					});
			},
			hitung: function() {
				this.cariMaxMin();
				this.hitungNormalisasi();
				this.hitungPeringkat();
				this.urutkanPeringkat();
			},
			activateTab: function (tablist_id, tab_index) {
				$(`#${tablist_id} li:nth-child(${tab_index}) a`).tab('show');
			}
		}
	})
</script>