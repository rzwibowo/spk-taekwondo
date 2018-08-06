<div class="row" id="app">
	<div class="col-md-12">
		<div class="card">
			<div class="card-body">
				<h3><?php echo $title ?></h3>
			</div>
		</div>
	</div>
	<div class="col-md-12">
		<ul class="nav nav-tabs" role="tablist">
			<li class="nav-item">
				<a class="nav-link" v-bind:class="Form == true?'active':''" data-toggle="tab" href="#tab_input" role="tab" aria-controls="tab_input" v-on:click="Form =true;Submit = false;InitializeFrom();reset()">
					<i class="icon-pencil"></i> Input
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" v-bind:class="Form == false?'active':''" data-toggle="tab" href="#tab_list" role="tab" aria-controls="tab_list" v-on:click="Form =false;Submit = false">
					<i class="icon-list"></i> List
				</a>
			</li>
		</ul>
		<div class="tab-content">
			<div class="tab-pane" id="tab_input" role="tabpanel" v-bind:class="Form == true?'active':''">
					<!-- BEGIN form input -->
					<div class="col-md-8 offset-md-2">
						<div class="card" id="input">
							<div class="card-header">
								Input Data 
								<strong>Mahasiswa</strong>
							</div>
							<div class="card-body">
								<form action="" method="post" class="form-horizontal">
									<div class="form-group row">
										<label class="col-md-3 col-form-label" for="nim">NIM</label>
										<div class="col-md-9">
											<input type="text" id="nim" name="nim" v-model="mahasiswa.nim" class="form-control" placeholder="Masukkan NIM">
											<span v-show="Submit && !mahasiswa.nim" style="color: red">Field harus diisi</span>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-md-3 col-form-label" for="nama">Nama</label>
										<div class="col-md-9">
											<input type="text" id="nama" name="nama" v-model="mahasiswa.nama" class="form-control" placeholder="Masukkan Nama">
											<span v-show="Submit && !mahasiswa.nama" style="color: red">Field harus diisi</span>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-md-3 col-form-label" for="thn_angkatan">Tahun Angkatan</label>
										<div class="col-md-5">
											<select class="form-control" 
								          	name="thn_angkatan" 
								          	id="thn_angkatan" 
								          	v-model="mahasiswa.id_tahun_angkatan" >
								          		<option value="">-Pilih-</option>
								          		<option v-for="(value, key) in tahunangkatan" :value="value.id_tahun_angkatan">
								          			 {{value.tahun_angkatan}}
								          		</option>
							          		</select>
											<span v-show="Submit && !mahasiswa.thn_angkatan" style="color: red">Field harus diisi</span>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-md-3 col-form-label">Jenis Kelamin</label>
										<div class="col-md-9 col-form-label">
											<div class="form-check form-check-inline mr-1">
												<input class="form-check-input" type="radio" id="laki-laki" v-model="mahasiswa.jenis_kelamin" value="laki-laki" name="jenis_kelamin">
												<label class="form-check-label" for="laki-laki">Laki-laki</label>
											</div>
											<div class="form-check form-check-inline mr-1">
												<input class="form-check-input" type="radio" id="perempuan" v-model="mahasiswa.jenis_kelamin" value="perempuan" name="jenis_kelamin">
												<label class="form-check-label" for="perempuan">Perempuan</label>
											</div>
											<span v-show="Submit && !mahasiswa.jenis_kelamin" style="color: red">Field harus diisi</span>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-md-3 col-form-label" for="tempat_lahir">Tempat Lahir</label>
										<div class="col-md-9">
											<input type="text" id="tempat_lahir" name="tempat_lahir"  v-model="mahasiswa.tempat_lahir" class="form-control" placeholder="Masukkan Tempat Lahir"/>
											<span v-show="Submit && !mahasiswa.tempat_lahir" style="color: red">Field harus diisi</span>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-md-3 col-form-label" for="tgl_lahir">Tanggal Lahir</label>
										<div class="col-md-5">
											<input type="date" id="tgl_lahir" name="tgl_lahir" v-model="mahasiswa.tgl_lahir" class="form-control">
											<span v-show="Submit && !mahasiswa.tgl_lahir" style="color: red">Field harus diisi</span>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-md-3 col-form-label" for="alamat">Alamat</label>
										<div class="col-md-9">
											<textarea id="alamat" name="alamat" rows="3" v-model="mahasiswa.alamat" class="form-control" placeholder="Masukkan Alamat"></textarea>
											<span v-show="Submit && !mahasiswa.alamat" style="color: red">Field harus diisi</span>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-md-3 col-form-label" for="nama">IPK (format: x.xx)</label>
										<div class="col-md-4">
											<input type="number" id="nama" name="nama" v-model="mahasiswa.ipk" class="form-control" placeholder="Masukkan IPK" v-on:change="SearchIPK(mahasiswa.ipk)" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==4) return false;">
											<span v-show="Submit && !mahasiswa.ipk" style="color: red">Field harus diisi</span>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-md-3 col-form-label" for="kendaraan">Kendaraan</label>
										<div class="col-md-9">
											<select name="kendaraan" class="form-control" id="kendaraan" v-model="mahasiswa.kendaraan">
												<option value="">-Pilih-</option>
												<option v-for="(value, key) in Kendaraan" :value="value.id_sub_criteria">
								          			 {{value.kriteria}}
								          		</option>
											</select>
											<span v-show="Submit && !mahasiswa.kendaraan" style="color: red">Field harus diisi</span>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-md-3 col-form-label" for="pgh_orangtua">Penghasilan Orang Tua</label>
										<div class="col-md-7">
											<div class="input-group">
												<div class="input-group-prepend">
													<span class="input-group-text">Rp</span>
												</div>
											<input type="text" id="pgh_orangtua" name="pgh_orangtua" v-model="mahasiswa.pgh_orangtua" class="form-control" v-on:change="SearchPghOrangtua(mahasiswa.pgh_orangtua)" pattern="^[0-9]*$">
											</div>
											<span v-show="Submit && !mahasiswa.pgh_orangtua" style="color: red">Field harus diisi</span>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-md-3 col-form-label" for="pkj_orangtua">Pekerjaan Orang Tua</label>
										<div class="col-md-9">
											<select class="form-control" 
								          	name="pkj_orangtua" 
								          	id="pkj_orangtua" 
								          	v-model="mahasiswa.pkj_orangtua" >
								          		<option value="">-Pilih-</option>
								          		<option v-for="(value, key) in PekerjaanOrangTua" :value="value.id_sub_criteria">
								          			 {{value.kriteria}}
								          		</option>
							          		</select>
											<span v-show="Submit && !mahasiswa.pkj_orangtua" style="color: red">Field harus diisi</span>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-md-3 col-form-label" for="jml_tanggungan">Jumlah Tanggungan</label>
										<div class="col-md-3">
											<input type="number" id="jml_tanggungan" name="jml_tanggungan" v-model="mahasiswa.jml_tanggungan" class="form-control" v-on:change="SearchJumlahTanggungan(mahasiswa.jml_tanggungan)">
											<span v-show="Submit && !mahasiswa.jml_tanggungan" style="color: red">Field harus diisi</span>
										</div>
									</div>
								</form>
							</div>
							<div class="card-footer text-right">
								<button type="submit" class="btn btn-sm btn-primary"  v-on:click="Save">
									<i class="fa fa-dot-circle-o"></i> Simpan</button>
								<button type="reset" v-on:click="reset" class="btn btn-sm btn-danger">
									<i class="fa fa-ban"></i> Reset</button>
							</div>
						</div>
					</div>
					<!-- END form input -->		
			</div>
			<div class="tab-pane" id="tab_list" role="tabpanel" v-bind:class="Form == false?'active':''">
					<!-- START list -->
					<div class="col-md-12">
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
										<th class="text-center">Tahun</th>
										<th>JK</th>
										<th class="text-center">IPK</th>
										<th>Kendaraan</th>
										<th></th>
									</tr>
									<tr>
										<th></th>
										<th><input type="text" name="nim" class="form-control" v-model="FilterModel.nim" v-on:keyup="ChangeFilter(FilterModel.nim)" placeholder="Cari NIM mahasiswa ..."></th>
										<th><input type="text" name="nama" class="form-control" v-model="FilterModel.nama" v-on:keyup="ChangeFilter(FilterModel.nama)" placeholder="Cari nama mahasiswa ..."></th>
										<th><input type="number" name="tahun_angkatan" class="form-control text-center" v-model="FilterModel.tahun_angkatan" v-on:keyup="ChangeFilter(FilterModel.tahun_angkatan)" placeholder="Cari tahun angkatan ..."></th>
										<th><input type="text" name="jenis_kelamin" class="form-control" v-model="FilterModel.jenis_kelamin" v-on:keyup="ChangeFilter(FilterModel.jenis_kelamin)" placeholder="Cari jenis kelamin mahasiswa ..."></th>
										<th><input type="number" name="ipk" class="form-control text-center" v-model="FilterModel.ipk" v-on:keyup="ChangeFilter(FilterModel.ipk)" placeholder="Cari IPK mahasiswa ..."></th>
										<th><input type="text" name="kendaraan" class="form-control" v-model="FilterModel.kendaraan" v-on:keyup="ChangeFilter(FilterModel.kendaraan)" placeholder="Cari kendaraan mahasiswa ..."></th>
										<th></th>
									</tr>
								</thead>
								<tbody>
								<tr v-for="(mahasiswa,index) in mahasiswas">
									<td>{{index + 1}}</td>
									<td>{{mahasiswa.nim}}</td>
									<td>{{mahasiswa.nama}}</td>
									<td class="text-center">{{mahasiswa.tahun_angkatan}}</td>
									<td>{{mahasiswa.jenis_kelamin}}</td>
									<td class="text-center">{{mahasiswa.ipk}}</td>
									<td>{{mahasiswa.kendaraan}}</td>
									<td> <button type="button" class="btn btn-sm btn-primary" v-on:click="Edit(mahasiswa.id_mahasiswa)">
												<i class="fa fa-pencil"></i> Edit</button>
												<button type="button" class="btn btn-sm btn-success" v-on:click="View(mahasiswa.id_mahasiswa)">
												<i class="fa fa-dot-circle-o"></i> View</button>
												<button type="button" class="btn btn-sm btn-danger" v-on:click="Delete(mahasiswa.id_mahasiswa)">
												<i class="fa fa-minus-circle"></i> Delete</button>
										</td>
								</tr>
								</tbody>
							</table>
						</div>
					</div>
					<!-- END list -->
			</div>
		</div>
	</div>

	<!-- BEGIN modal detail -->
	<div class="modal fade" id="detail-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  <div class="modal-dialog modal-info modal-dialog-centered" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h4 class="modal-title">Detail Mahasiswa</h4>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	      	<form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
	      	  <div class="form-group row">
	      	    <label class="col-md-3 col-form-label">NIM</label>
	      	    <div class="col-md-9">
	      	      <p class="form-control-static"><b>{{mahasiswaView.nim}}</b></p>
	      	    </div>
	      	  </div>
	      	  <div class="form-group row">
	      	    <label class="col-md-3 col-form-label">Nama</label>
	      	    <div class="col-md-9">
	      	      <p class="form-control-static"><b>{{mahasiswaView.nama}}</b></p>
	      	    </div>
	      	  </div>
	      	  <div class="form-group row">
	      	    <label class="col-md-3 col-form-label">Tahun Angkatan</label>
	      	    <div class="col-md-9">
	      	      <p class="form-control-static"><b>{{mahasiswaView.tahun_angkatan}}</b></p>
	      	    </div>
	      	  </div>
	      	  <div class="form-group row">
	      	    <label class="col-md-3 col-form-label">Jenis Kelamin</label>
	      	    <div class="col-md-9">
	      	      <p class="form-control-static"><b>{{mahasiswaView.jenis_kelamin}}</b></p>
	      	    </div>
	      	  </div>
	      	  <div class="form-group row">
	      	    <label class="col-md-3 col-form-label">Tempat Lahir</label>
	      	    <div class="col-md-9">
	      	      <p class="form-control-static"><b>{{mahasiswaView.tempat_lahir}}</b></p>
	      	    </div>
	      	  </div>
	      	  <div class="form-group row">
	      	    <label class="col-md-3 col-form-label">Tanggal Lahir</label>
	      	    <div class="col-md-9">
	      	      <p class="form-control-static"><b>{{mahasiswaView.tgl_lahir}}</b></p>
	      	    </div>
	      	  </div>
	      	  <div class="form-group row">
	      	    <label class="col-md-3 col-form-label">Alamat</label>
	      	    <div class="col-md-9">
	      	      <p class="form-control-static"><b>{{mahasiswaView.alamat}}</b></p>
	      	    </div>
	      	  </div>
	      	  <div class="form-group row">
	      	    <label class="col-md-3 col-form-label">IPK</label>
	      	    <div class="col-md-9">
	      	      <p class="form-control-static"><b>{{mahasiswaView.ipk}}</b></p>
	      	    </div>
	      	  </div>
	      	  <div class="form-group row">
	      	    <label class="col-md-3 col-form-label">Kendaraan</label>
	      	    <div class="col-md-9">
	      	      <p class="form-control-static"><b>{{mahasiswaView.kendaraan}}</b></p>
	      	    </div>
	      	  </div>
	      	  <div class="form-group row">
	      	    <label class="col-md-3 col-form-label">Penghasilan Orang Tua</label>
	      	    <div class="col-md-9">
	      	      <p class="form-control-static"><b>Rp.{{mahasiswaView.pgh_orangtua}}</b></p>
	      	    </div>
	      	  </div>
	      	  <div class="form-group row">
	      	    <label class="col-md-3 col-form-label">Pekerjaan Orang Tua</label>
	      	    <div class="col-md-9">
	      	      <p class="form-control-static"><b>{{mahasiswaView.pkj_orangtua}}</b></p>
	      	    </div>
	      	  </div>
	      	  <div class="form-group row">
	      	    <label class="col-md-3 col-form-label">Jumlah Tanggungan</label>
	      	    <div class="col-md-9">
	      	      <p class="form-control-static"><b>{{mahasiswaView.jml_tanggungan}}</b></p>
	      	    </div>
	      	  </div>
	      	</form>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	      </div>
	    </div>
	    <!-- /.modal-content -->
	  </div>
	  <!-- /.modal-dialog -->
	</div>
	<!-- END modal detail -->
</div>
<script type="text/javascript" src="http://localhost/spk-beasiswa/assets/js/mahasiswa.js">


</script>