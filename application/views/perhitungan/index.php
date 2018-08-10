<link href="https://cdn.jsdelivr.net/npm/animate.css@3.5.1" rel="stylesheet" type="text/css">
<style>
	.steps {
		margin: .5em auto;
	}
	.step {
		opacity: 0.5;
		height: 2em;
		width: 2em;
		background-color: #63c2de;
		display: inline-flex;
		color: white;
		align-items: center;
		justify-content: center;
		margin-left: 20px;
		margin-right: 20px;
		border-radius: 3px;
	}
	.step:not(:first-child)::before{
		content: '';
		width: 20px;
		height: 3px;
		position: absolute;
		margin-left: -35px;
		background-color: grey;
	}
	.step.active{
		opacity: 1;
	}
</style>
<div class="row" id="app">
	<div class="col-md-12">
		<div class="card">
			<div class="card-body">
				<div class="steps text-center">
					<span class="step" :class="step === 1 ? ' active' : ''">1</span>
					<span class="step" :class="step === 2 ? ' active' : ''">2</span>
					<span class="step" :class="step === 3 ? ' active' : ''">3</span>
					<span class="step" :class="step === 4 ? ' active' : ''">4</span>
				</div>
				<div class="steps title text-center">
					<transition name="custom-class-trans"
						enter-active-class="animated fadeInRight faster"
						leave-active-class="animated fadeOutLeft faster"
						mode="out-in">
						<h3 :key="step">{{ stepTitle }}</h3>
					</transition>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-12">
		<section>
			<div role="form">
				<div class="tab-content">
					<div class="tab-pane" role="tabpanel" id="step1" v-bind:class="step === 1 ? 'active' : 'disabled'">
						<div class="col-md-12">
							<div class="card">
								<div class="col-md-6">
									<div class="form-group row" style="margin: .5em auto">
										<label class="col-md-4 col-form-label"><strong>Tahun Angkatan</strong></label>
										<div class="col-md-6">
											<select class="form-control"
												name="tahun_angkatan"
												id="tahun_angkatan"
												v-model="selected"
												v-on:change="GetMahasiswa(selected)">
												<option value="">-Pilih-</option>
												<option v-for="(value, key) in TahunAngkatan" :value="value.id_tahun_angkatan">
													{{value.tahun_angkatan}}
												</option>
											</select>
										</div>
									</div>
								</div>
								<div class="col-md-12" v-show="selected">
									<div class="card" id="list">
										<div class="card-header">
											Daftar <strong>Mahasiswa</strong>
										</div>
										<table class="table table-responsive-sm table-striped">
											<thead>
												<tr>
													<th>#</th>
													<th>NIM</th>
													<th>Nama</th>
													<th>Tahun</th>
													<th>JK</th>
													<th>IPK</th>
													<th>Kendaraan</th>
												</tr>
											</thead>
											<tbody>
												<tr v-for="(mahasiswa,index) in Mahasiswa">
													<td>{{index + 1}}</td>
													<td>{{mahasiswa.nim}}</td>
													<td>{{mahasiswa.nama}}</td>
													<td>{{mahasiswa.thn_angkatan}}</td>
													<td>{{mahasiswa.jenis_kelamin}}</td>
													<td>{{mahasiswa.ipk}}</td>
													<td>{{mahasiswa.kendaraan}}</td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
								<div class="card-footer text-right">
									<button type="button" 
										class="btn btn-success next-step" 
										v-on:click="step += 1" 
										:disabled="!selected || !Mahasiswa.length">
										Selanjutnya
									</button>
								</div>
							</div>
						</div>
					</div>
					<div class="tab-pane" role="tabpanel" id="step2"  v-bind:class="step == 2 ? 'active' : 'disabled'">
						<div class="col-md-12">
							<div class="card" >
								<div class="card-body">
									<div class="col-md-12" v-show="Mahasiswa.length && selected">
										<div class="card" id="list">
											<div class="card-header">
												<strong>Matriks Perbandingan Berpasangan</strong>
											</div>
											<table class="table table-responsive-sm table-striped">
												<thead>
													<tr>
														<th>Kriteria</th>
														<th v-for="(kriteria,index) in Kriteria">{{kriteria.nama_kriteria}}</th>
													</tr>
												</thead>
												<tbody>
													<tr v-for="(matrix,indexperent) in MatrixPerbandingan">
														<td><strong>{{matrix.kriteria}}</strong> </td>
														<td v-for="(row,index) in matrix.row">
															<select class="form-control"
																v-model="row.value"
																v-show="row.isChange"
																v-on:change="CalculateMatrix(row,matrix,index,indexperent)">
																<option v-for="i in 9"  :value="i">{{i}}</option>
															</select>
															<label class="col-form-label"
															v-show="!row.isChange">{{row.value}}</label>
														</td>
													</tr>
													<tr>
														<th><strong>Jumlah</strong></th>
														<th v-for="(matrix,indexperent) in MatrixPerbandingan">
															<strong>{{matrix.jumlah}}</strong>
														</th>
													</tr>
												</tbody>
											</table>
											<div class="card-footer text-right">
												<button class="btn btn-primary" v-on:click="Calculate()"><i class="fa fa-refresh" v-show="isCalculate"></i> Hitung</button>
											</div>
										</div>
										<div class="card" v-show="isCalculate">
											<div class="card-header">
												<strong>Matriks Normalisasi</strong>
											</div>
											<table class="table table-responsive-sm table-striped">
												<thead>
													<tr>
														<th>Kriteria</th>
														<th v-for="(kriteria,index) in Kriteria">{{kriteria.nama_kriteria}}</th>
														<th>∑ Baris</th>
														<th>Rata-rata Baris</th>
													</tr>
												</thead>
												<tbody>
													<tr v-for="(matrix,index) in MatriksNormalisasi">
														<td><strong>{{matrix.kriteria}}</strong> </td>
														<td v-for="(row,index) in matrix.row">
															<label class="col-form-label">{{row.value}}</label>
														</td>
														<td>{{matrix.baris}}</td>
														<td>{{matrix.rata2}}</td>
													</tr>
												</tbody>
											</table>
										</div>
										<div class="card" v-show="isCalculate">
											<div class="card-header">
												<strong>Menghitung konsistensi</strong>
											</div>
											<table class="table table-responsive-sm table-striped">
												<thead>
													<tr>
														<th>Kriteria</th>
														<th v-for="(kriteria,index) in Kriteria">{{kriteria.nama_kriteria}}</th>
														<th>∑ Baris</th>
													</tr>
												</thead>
												<tbody>
													<tr v-for="(matrix,index) in Konsistensi">
														<td><strong>{{matrix.kriteria}}</strong> </td>
														<td v-for="(row,index) in matrix.row">
															<label class="col-form-label">{{row.value}}</label>
														</td>
														<td>{{matrix.baris}}</td>
													</tr>
												</tbody>
											</table>
										</div>
										<div class="card" v-show="isCalculate">
											<div class="card-body">
												<div class="col-md-6">
													<div class="card">
														<table class="table table-responsive-sm table-striped">
															<thead>
																<tr><th>Lamda:</th><th></th></tr>
															</thead>
															<tbody>
																<tr v-for="(lamda,index) in Lamda.lamda">
																	<td></td>
																	<td>{{lamda}}</td>
																</tr>
															</tbody>
															<tfoot>
																<tr>
																	<th>Rata-Rata:</th>
																	<th>{{Lamda.rata2}}</th>
																</tr>
															</tfoot>
														</table>
													</div>
												</div>
												<div class="col-md-6">
													<div class="card">
														<table class="table table-responsive-sm table-striped">
															<tbody>
																<tr><td>IC = </td><td>{{IC}}</td></tr>
																<tr><td>IR = </td><td>{{IR}}</td></tr>
																<tr><td>CR = </td><td>{{CR}}</td></tr>
															</tbody>
														</table>
														<div class="card-footer text-center"><strong>{{ terimaAtauTidak }}</strong></div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="card-footer text-right">
									<button type="button" class="btn btn-default prev-step" v-on:click="step -= 1">Sebelumnya</button>
									<button type="button" class="btn btn-success next-step" v-on:click="step += 1" :disabled="!isCalculate">Berikutnya</button>
								</div>
							</div>
						</div>
					</div>
					<div class="tab-pane" role="tabpanel" id="step3" v-bind:class="step == 3 ? 'active' : 'disabled'">
						<div class="card">
							<div class="card-body">
								<div class="card">
									<table class="table table-responsive-sm table-striped">
										<thead>
											<tr>
												<th rowspan="2" class="text-center">Alternatif</th>
												<th :colspan="Kriteria.length" class="text-center">Kriteria</th>
											</tr>
											<tr>
												<th v-for="(kriteria, idx) in Kriteria" :key="idx">{{ kriteria.nama_kriteria }}</th>
											</tr>
										</thead>
										<tbody>
											<tr v-for="(mtx, idx) in MatriksSaw" :key="idx">
												<td><strong>{{ mtx.nama }}</strong></td>
												<td v-for="(cell, i_idx) in mtx.row" :key="i_idx">
													{{ cell.cellvalue }}
												</td>
											</tr>
											<tr>
												<td><strong>X</strong></td>
												<td v-for="(col, idx) in maxormin" :key="idx">{{ col.maxminvalue }}</td>
											</tr>
											<tr>
												<td><strong>Bobot</strong></td>
												<td v-for="(matriks, idx) in MatriksNormalisasi" :key="idx">{{matriks.rata2}}</td>
											</tr>
											<tr>
												<td><strong>Sifat</strong></td>
												<td v-for="(col, idx) in maxormin" :key="idx">
													<select class="form-control" v-model="col.state" @change="findMaxOrMin(idx)">
														<option value="max">MAX</option>
														<option value="min">MIN</option>
													</select>
												</td>
											</tr>
										</tbody>
									</table>
									<div class="card-footer text-right">
										<button class="btn btn-primary" v-on:click="CalculateMatriksSaw()">Hitung</button>
									</div>
								</div>
								<div class="card" v-show="sawCalculate">
									<div class="card-header">
										<strong>Normalisasi</strong>
									</div>
									<table class="table table-responsive-sm table-striped">
										<thead>
											<tr>
												<th>Alternatif</th>
												<th v-for="(ktr, idx) in Kriteria" :key="idx">{{ ktr.nama_kriteria }}</th>
											</tr>
										</thead>
										<tbody>
											<tr v-for="(mtx, idx) in MatriksSawNormalisasi" :key="idx">
												<td><strong>{{ mtx.nama }}</strong></td>
												<td v-for="(i_mtx, i_idx) in mtx.row">{{ i_mtx.value }}</td>
											</tr>
										</tbody>
									</table>
								</div>
								<div class="card" v-show="sawCalculate">
									<table class="table table-responsive-sm table-striped">
										<thead>
											<tr>
												<th>Alternatif</th>
												<th v-for="(ktr, idx) in Kriteria" :key="idx">{{ ktr.nama_kriteria }}</th>
												<th>Jumlah</th>
											</tr>
										</thead>
										<tbody>
											<tr v-for="(mtx, idx) in MatriksSawFinal" :key="idx">
												<td><strong>{{ mtx.nama }}</strong></td>
												<td v-for="(i_mtx, i_idx) in mtx.row" :key="i_idx">{{ i_mtx.value }}</td>
												<td>{{ mtx.jumlah }}</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
							<div class="card-footer text-right">
								<button type="button" class="btn btn-default prev-step" v-on:click="step -=1">Sebelumnya</button>
								<button type="button" class="btn btn-success next-step" :disabled="!sawCalculate" v-on:click="step +=1" >Berikutnya</button>
							</div>
						</div>
					</div>
					<div class="tab-pane" role="tabpanel" id="complete" v-bind:class="step == 4?'active':'disabled'">
						<div class="card">
							<div class="card-body">
								<div class="card">
									<div class="card-header">
										<strong>Penerima Beasiswa</strong>
									</div>
									<table class="table table-responsive-sm table-striped">
										<thead>
											<tr>
												<th>#</th>
												<th>Nama</th>
												<th>Nilai</th>
											</tr>
										</thead>
										<tbody>
											<tr v-for="(mhs, idx) in TerimaBeasiswa" :key="idx">
												<td>{{ idx + 1 }}</td>
												<td>{{ mhs.nama }}</td>
												<td>{{ mhs.jumlah }}</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
							<div class="card-footer text-right">
								<button type="button" class="btn btn-default prev-step" v-on:click="step -=1">Sebelumnya</button>
								<button type="button" class="btn btn-success next-step" v-show="step === 4" v-on:click="SaveBeasiswa">Simpan</button>
							</div>
						</div>
						<ul class="list-inline pull-right">
						</ul>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
		</section>
	</div>
</div>
<script type="text/javascript">
var app = new Vue({
	el: '#app',
	created(){
		this.GetTahunAngkatan();
		this.GetKriteria();
	},
	computed: {
		stepTitle: function() {
			switch (this.step) {
				case 1 : return 'Pilih Tahun Angkatan'
				case 2 : return 'AHP'
				case 3 : return 'SAW'
				case 4 : return 'Simpan Data Beasiswa'
			}
		},
		terimaAtauTidak: function() {
			if (this.CR <= 0.1) {
				return 'Perhitungan diterima karena CR <= 0.1'
			} else {
				return 'Perhitungan ditolak karena CR > 0.1'
			}
		}
	},
	data: {
		TahunAngkatan:[],
		selected: '',
		Mahasiswa:[],
		Kriteria:[],
		MatrixPerbandingan:[],
		isCalculate:'',
		MatriksNormalisasi:[],
		Konsistensi:[],
		Lamda:{},
		IC:{},
		IR:{},
		CR:{},
		MatriksSaw: [],
		maxormin: [],
		MatriksSawNormalisasi: [],
		sawCalculate: false,
		MatriksSawFinal: [],
		step: 1,
		TerimaBeasiswa: []
	},
	methods: {
		GetTahunAngkatan() {
			axios.get(locationServer+'/api/tahunangkatan/tahunangkatans')
			.then(response => {
				this.TahunAngkatan =  response.data;
			})
			.catch(error => {
				console.log(error)
				this.errored = true
			})
			.finally(() => this.loading = false )
		},
		// BEGIN AHP
		GetMahasiswa(idTahun) {
			axios.get(locationServer+'/api/mahasiswa/getmahasiswawithtahunangkatan/'+idTahun)
			.then(response => {
				this.Mahasiswa =  response.data;
				this.isCalculate=false;
				this.SetMatriksSawAwal()
			})
			.catch(error => {
				console.log(error)
				this.errored = true
			})
			.finally(() => this.loading = false)
		},
		GetKriteria(){
			axios.get(locationServer+'/api/kriteria/getkriterias')
			.then(response => {
				this.Kriteria =  response.data;
				this.SetMaxtrixPerbandingan();
			})
			.catch(error => {
				console.log(error)
				this.errored = true
			})
			.finally(() => this.loading = false )
		},
		SetMaxtrixPerbandingan(){
			var MatrixPerbandingan = [];
			var defaultvalue = 0;
			var lengkriteria = this.Kriteria.length;
			this.Kriteria.forEach(function (value, i) {
				var row = [];
				for (var j = 0; j < lengkriteria;j++) {
					var colum = {
						row : i,
						colum:j,
						value:defaultvalue == j?1:0,
						isChange:j > i? true:false,
					}
					row.push(colum);
				}
				var matrix = {
					kriteria :value.nama_kriteria,
					row:row,
					jumlah:1
				};
				MatrixPerbandingan.push(matrix);
				defaultvalue ++;
			});
			this.MatrixPerbandingan = MatrixPerbandingan;
		},
		CalculateMatrix(row,matrix,index,indexparent){
			var total = 0;
			this.MatrixPerbandingan[row.colum].row[indexparent].value = parseFloat(matrix.row[row.row].value) / parseFloat(row.value);
				for (var i = 0; i < this.MatrixPerbandingan.length; i++) {
					total += parseFloat(this.MatrixPerbandingan[i].row[row.row].value);
				}
				this.MatrixPerbandingan[row.row].jumlah = total.toFixed(2);
				total = 0;
				for (var i = 0; i < this.MatrixPerbandingan.length; i++) {
				total += parseFloat(this.MatrixPerbandingan[i].row[index].value);
			}
			this.MatrixPerbandingan[index].jumlah = total.toFixed(2);
		},
		Calculate(){
			var valid = true;
			this.MatrixPerbandingan.forEach(function (value, i) {
				if(value.row.filter(x => x.isChange == true && x.value == 0).length > 0){
					valid =false;
				}
			});
			if(!valid) {
				alert("Ada data yang tidak falid");
			} else {
				this.isCalculate = true;
				var MatrixNormalisasi =[];
				var konsistensi = [];
				var lamda =[];
				var baris = 0;
				var rata2 =0;
				var length = this.MatrixPerbandingan.length;
				var MatrixPerbandingan = this.MatrixPerbandingan;
				var IndexRandom =
					[{
						matrix:1,
						value:0.00
					},
					{
						matrix:2,
						value:0.00
					},
					{
						matrix:3,
						value:0.58
					},
					{
						matrix:4,
						value:0.90
					},
					{
						matrix:5,
						value:1.12
					},
					{
						matrix:6,
						value:1.24
					},
					{
						matrix:7,
						value:1.32
					},
					{
						matrix:8,
						value:1.41
					},
					{
						matrix:9,
						value:1.45
					},
					{
						matrix:10,
						value:1.49
					},
					{
						matrix:11,
						value:1.51
					},
					{
						matrix:12,
						value:1.48
					},
					{
						matrix:13,
						value:1.56
					},
					{
						matrix:14,
						value:1.57
					},
					{
						matrix:15,
						value:1.59
					}];
				//HITUNG Matrix Normalisasi
				this.MatrixPerbandingan.forEach(function (value, i) {
					baris = 0;
					rata2 =0;
					var row = [];
					for (var j = 0; j < length; j++) {
						var colum = {
							row : i,
							colum:j,
							value: (parseFloat(MatrixPerbandingan[i].row[j].value) / parseFloat(MatrixPerbandingan[j].jumlah)).toFixed(5),
						}
						baris += parseFloat(colum.value);
						row.push(colum);
					}
					var matrix = {
						kriteria :value.kriteria,
						row:row,
						baris:baris,
						rata2:parseFloat(baris / row.length),
					};
					MatrixNormalisasi.push(matrix);
				});
				this.MatriksNormalisasi = MatrixNormalisasi;
				//END Matrix Normalisasi
				//Hitung Kosistensi
				MatrixPerbandingan.forEach(function (value, i) {
					baris = 0;
					var row = [];
					for (var j = 0; j < length; j++) {
						var colum = {
							row : i,
							colum:j,
							value: parseFloat(MatrixPerbandingan[i].row[j].value * MatrixNormalisasi[j].rata2),
						}
						baris +=parseFloat(colum.value);
						row.push(colum);
					}
					var matrix = {
						kriteria :value.kriteria,
						row:row,
						baris:baris,
					};
					konsistensi.push(matrix);
				});
				this.Konsistensi = konsistensi;
				//END Konsistensi
				//Hitung Lamda
				rata2 = 0;
				for (var i = 0; i < length; i++) {
					lamda.push(parseFloat(konsistensi[i].baris / MatrixNormalisasi[i].rata2));
					rata2 += parseFloat(konsistensi[i].baris / MatrixNormalisasi[i].rata2);
				}
				this.Lamda ={
					lamda :lamda,
					rata2 :parseFloat(rata2 / lamda.length)
				};
				//END Lamda
				//IC,IR,CR
				this.IC = parseFloat((this.Lamda.rata2 - konsistensi.length)/(konsistensi.length - 1));
				var RendomValue = IndexRandom.filter(x => x.matrix == parseInt(this.Lamda.rata2));
				if(RendomValue.length){
					this.IR = RendomValue[0].value;
				}else{
				this.IR = IndexRandom[IndexRandom.length - 1].value;
				}
				this.CR = parseFloat(this.IC / this.IR);
			}
		},
		// END AHP
		// BEGIN SAW
		SetMatriksSawAwal: function() {
			let MatriksSawAwal = []
			for(let index = 0; index < this.Mahasiswa.length; index++){
				let row = [
					{
						cellvalue: this.Mahasiswa[index].bobotipk
					},
					{
						cellvalue: this.Mahasiswa[index].bobotkendaraan
					},
					{
						cellvalue: this.Mahasiswa[index].bobotpenghasilanorg
					},
					{
						cellvalue: this.Mahasiswa[index].bobotpkj_orangtua
					},
					{
						cellvalue: this.Mahasiswa[index].bobotJmlTanggungan
					}
				]
				let matrix = {
					nama: this.Mahasiswa[index].nama,
					id_mahasiswa: this.Mahasiswa[index].id_mahasiswa,
					row: row
				}
				MatriksSawAwal.push(matrix)
			}
			this.MatriksSaw = MatriksSawAwal
			this.SetMatriksMaxormin()
		},
		SetMatriksMaxormin: function () {
			let maxorminAwal = []
			for(let index = 0; index < this.Kriteria.length; index++){
				let maxmincell = {
					col_index: index,
					state: 'max',
					maxminvalue: 0
				}
				maxorminAwal.push(maxmincell)
			}
			this.maxormin = maxorminAwal
			for(let index = 0; index < this.maxormin.length; index++) {
				this.findMaxOrMin(index)
			}
		},
		findMaxOrMin: function(x) {
			const states = this.maxormin[x].state
			let col_vals = []
			this.MatriksSaw.forEach((rows) => {
				col_vals.push(rows.row[x].cellvalue)
				// console.log(`kolom ${x} : ${rows.row[x].cellvalue}`)
			})
			states === 'max' ? this.maxormin[x].maxminvalue = Math.max(...col_vals) : this.maxormin[x].maxminvalue = Math.min(...col_vals)
			// console.log(this.maxormin[x].maxminvalue)
		},
		CalculateMatriksSaw: function() {
			this.sawCalculate = true
			let MatriksSawNormalisasiAwal = []
			for(let index = 0; index < this.MatriksSaw.length; index++) {
				let norm_cell_value
				let rows = []
				for(let i_index = 0; i_index < this.maxormin.length; i_index++) {
					norm_cell_value = {
						value: parseFloat(this.maxormin[i_index].maxminvalue) / parseFloat(this.MatriksSaw[index].row[i_index].cellvalue)
					}
					rows.push(norm_cell_value)
				}
				let NormalisasiRow = {
					nama: this.MatriksSaw[index].nama,
					row: rows,
					id_mahasiswa:this.MatriksSaw[index].id_mahasiswa
				}
				MatriksSawNormalisasiAwal.push(NormalisasiRow)
			}
			this.MatriksSawNormalisasi = MatriksSawNormalisasiAwal
			this.CalculateSawFinal()
		},
		CalculateSawFinal: function() {
			let MatriksSawFinalAwal = []
			for(let index = 0; index < this.MatriksSawNormalisasi.length; index++) {
				let jumlah = 0
				let final_value
				let rows = []
				for(let i_index = 0; i_index < this.MatriksNormalisasi.length; i_index++) {
					const calc_final_value = this.MatriksNormalisasi[i_index].rata2 * this.MatriksSawNormalisasi[index].row[i_index].value
					final_value = {
						value: calc_final_value
					}
					jumlah += calc_final_value
					rows.push(final_value)
				}
				let FinalRow = {
					id_mahasiswa: this.MatriksSawNormalisasi[index].id_mahasiswa,
					nama: this.MatriksSawNormalisasi[index].nama,
					jumlah: jumlah,
					row: rows,
				}
				MatriksSawFinalAwal.push(FinalRow)
			}
			this.MatriksSawFinal = MatriksSawFinalAwal

			this.RankPenerima()
		},
		// END SAW
		RankPenerima: function() {
			let terimaBeasiswa = this.MatriksSawFinal.slice(0, 5)
									.sort((a, b) => b.jumlah - a.jumlah)
									.map(item => { 
										return {
											id_mhs: item.id_mahasiswa,
											nama: item.nama,
											jumlah: item.jumlah
										}
									})
			this.TerimaBeasiswa = terimaBeasiswa
		},
		SaveBeasiswa() {
			var Beasiswa ={};
			this.MatriksSawFinal.forEach(function (value, i) {
				Beasiswa = {
					jumlah_beasiswa	 : value.jumlah,
					id_mahasiswa : value.id_mahasiswa
				}
			});
			axios.post(locationServer+'/api/beasiswa/beasiswa',{
				body: Beasiswa
			})
			.then(response => {
				alert("Data Berhasil Disimpan");
				window.location.replace(locationServer);
			})
			.catch(error => {
				console.log(error);
				alert("Save Gagal");
				this.errored = true
			})
			.finally(() => console.log())
		}
	}
})
loaderStop()
</script>