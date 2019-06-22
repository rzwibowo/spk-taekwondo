<div class="row" id="main">
	<div class="col-md-12">
		<div class="card" v-show="Steps == 1">
			<div class="card-body">
				<h4 class="card-title text-center">Perbandingan Kriteria</h4>
			</div>
			<table class="table">
				<thead>
					<tr>
						<th>Kriteria Pertama</th>
						<th>Penilaian</th>
						<th>Kriteria Kedua</th>
					</tr>
				</thead>
				<tbody>
					<template v-for="kriteria in AKriteria">
						<tr v-for="colum in kriteria.colums">
							<template v-if="colum.IsShow == '1'">
								<th>{{kriteria.row}}</th>
								<th>
									<select class="form-control" v-model="colum.value">
										<option v-for="nilai in Penilaian" v-bind:value="nilai.value">{{nilai.name}}
										</option>
									</select>
								</th>
								<th>{{colum.row}}</th>
							</template>
						</tr>
					</template>

				</tbody>
			</table>
		</div>
		<div class="card" v-show="Steps == 2">
			<div class="card-body">
				<h4 class="card-title text-center">Perbandingan Kriteria</h4>
			</div>
			<table class="table">
				<thead>
					<tr>
						<th>Antar Kriteria</th>
						<th v-for="kriteria in Matrix.Matrix1">{{kriteria.row}}</th>
					</tr>
				</thead>
				<tbody>
					<template v-for="kriteria in Matrix.Matrix1">
						<tr>
							<th>{{kriteria.row}}</th>
							<template v-for="colum in kriteria.colums">
								<th>{{colum.value}}</th>
							</template>
						</tr>
					</template>
					<tr class="table-success">
						<th>Jumlah</th>
						<th v-for="kriteria in Matrix.Matrix1">{{kriteria.jumlah}}</th>
					</tr>
				</tbody>
			</table>
			<br>
			<table class="table">
				<thead>
					<tr>
						<th>Antar Kriteria</th>
						<th v-for="kriteria in Matrix.Matrix2">{{kriteria.row}}</th>
						<th class="table-success">Jumlah</th>
						<th class="table-success">Bobot</th>
					</tr>
				</thead>
				<tbody>
					<template v-for="kriteria in Matrix.Matrix2">
						<tr>
							<th>{{kriteria.row}}</th>
							<template v-for="colum in kriteria.colums">
								<th>{{colum.value}}</th>
							</template>
							<th class="table-success">{{kriteria.jumlah}}</th>
							<th class="table-success">{{kriteria.bobot}}</th>
						</tr>
					</template>
				</tbody>
			</table>
			<br>
			<table class="table">
				<thead>
					<tr>
						<th>Antar Kriteria</th>
						<th v-for="kriteria in Matrix.Matrix3">{{kriteria.row}}</th>
						<th class="table-success">Jumlah</th>
					</tr>
				</thead>
				<tbody>
					<template v-for="kriteria in Matrix.Matrix3">
						<tr>
							<th>{{kriteria.row}}</th>
							<template v-for="colum in kriteria.colums">
								<th>{{colum.value}}</th>
							</template>
							<th class="table-success">{{kriteria.jumlah}}</th>
						</tr>
					</template>
				</tbody>
			</table>
			<br>
			<table class="table">
				<thead>
					<tr>
						<th>Antar Kriteria</th>
						<th class="table-success">Jumlah</th>
						<th class="table-success">Bobot</th>
						<th class="table-success">Hasil</th>
					</tr>
				</thead>
				<tbody v-if="Matrix.Matrix4">
					<template v-for="kriteria in Matrix.Matrix4.Matrix4">
						<tr>
							<th>{{kriteria.row}}</th>
							<th class="table-success">{{kriteria.jumlah}}</th>
							<th class="table-success">{{kriteria.bobot}}</th>
							<th class="table-success">{{kriteria.hasil}}</th>
						</tr>
					</template>
					<tr>
						<th colspan="3" style="text-align: right">Rata- rata</th>
						<th v-if="Matrix.Matrix4">{{Matrix.Matrix4.ratarata}}</th>
					</tr>
				</tbody>
			</table>
			<br>
			<table class="table" v-if="Matrix.Matrix5">
				<thead>
					<tr>
						<th>N (Kriteria)</th>
						<th>{{Matrix.Matrix5.N}}</th>
					</tr>
					<tr>
						<th>Hasil Akhir (X maks)</th>
						<th>{{Matrix.Matrix5.Xmaks}}</th>
					</tr>
					<tr>
						<th>IR</th>
						<th>{{Matrix.Matrix5.IR}}</th>
					</tr>
					<tr>
						<th>CI</th>
						<th>{{Matrix.Matrix5.CI}}</th>
					</tr>
					<tr>
						<th>CR</th>
						<th>{{Matrix.Matrix5.CR}}</th>
					</tr>

				</thead>
			</table>
		</div>
		<div style="text-align: right;">
			<button class="btn btn-success" v-on:click="NextSteps" v-if="Steps == 1">Next</button>
			<button class="btn btn-success" v-on:click="Save" v-if="Steps == 2">Save</button>
		</div>
	</div>
</div>

<script src="<?php echo base_url() ?>assets/js/vue.js"></script>
<script src="<?php echo base_url() ?>assets/js/axios.min.js"></script>

<script>
	const main_script = new Vue({
		el: '#main',
		data: {
			AKriteria: [],
			Matrix: [],
			Penilaian: [],
			Steps: 1

		},
		mounted: function () {
			this.getBuatAnalisaKriteria();
		},
		methods: {
			getBuatAnalisaKriteria: function () {
				axios.get(server_host + '/api/Analisa/buatAnalisaKriteria')
					.then(res => {
						this.AKriteria = res.data;
						this.isiPenilaian();
					})
					.catch(err => console.error(err));
			},
			isiPenilaian: function () {
				const teksNilai = [
					'Sama penting dengan',
					'Mendekati sedikit lebih penting dari',
					'Sedikit lebih penting dari',
					'Mendekati lebih penting dari',
					'Lebih penting dari',
					'Mendekati sangat penting dari',
					'Sangat penting dari',
					'Mendekati mutlak dari',
					'Mutlak sangat penting dari'
				]
				for (var i = 1; i <= 9; i++) {
					this.Penilaian.push({
						name: `${i} | ${teksNilai[i-1]}`,
						value: i
					});
				}

			},
			NextSteps: function () {
				this.Steps = this.Steps + 1;
				if (this.Steps == 2) {
					this.hitungMatrixPerbandingan();
				}

			},
			hitungMatrixPerbandingan: function () {
				axios.post(server_host + '/api/Analisa/hitungMatrixPerbandingan', {
					body: this.AKriteria
				}).then(res => {
					this.Matrix = res.data;

				}).catch(err => console.error(err));
			},
			Save: function () {
				this.Matrix.Matrix4.user_id = JSON.parse(sessionStorage.getItem('auth_spk_tkwd')).id_user;
				axios.post(server_host + '/api/Analisa/saveAnalisisKriteria', {
					body: this.Matrix.Matrix4
				}).then(res => {
					// location.reload();
				}).catch(err => console.error(err));
			}
		},

	})

</script>
