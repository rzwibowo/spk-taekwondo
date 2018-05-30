<div class="row">
	<div class="col-md-6">
	  <div class="card">
	    <div class="card-header">
	      Input Data
	      <strong>Mahasiswa</strong>
	    </div>
	    <div class="card-body">
	      <form action="" method="post" class="form-horizontal">
	        <div class="form-group row">
	          <label class="col-md-3 col-form-label" for="nim">NIM</label>
	          <div class="col-md-9">
	            <input type="text" id="nim" name="nim" class="form-control" placeholder="Masukkan NIM">
	          </div>
	        </div>
	        <div class="form-group row">
	          <label class="col-md-3 col-form-label" for="nama">Nama</label>
	          <div class="col-md-9">
	            <input type="text" id="nama" name="nama" class="form-control" placeholder="Masukkan Nama">
	          </div>
	        </div>
	        <div class="form-group row">
	          <label class="col-md-3 col-form-label" for="thn_angkatan">Tahun Angkatan</label>
	          <div class="col-md-5">
	            <input type="number" id="thn_angkatan" name="thn_angkatan" class="form-control" placeholder="Masukkan Tahun Angkatan">
	          </div>
	        </div>
	        <div class="form-group row">
	          <label class="col-md-3 col-form-label">Jenis Kelamin</label>
	          <div class="col-md-9 col-form-label">
	            <div class="form-check form-check-inline mr-1">
	              <input class="form-check-input" type="radio" id="laki-laki" value="laki-laki" name="jns_kelamin">
	              <label class="form-check-label" for="laki-laki">Laki-laki</label>
	            </div>
	            <div class="form-check form-check-inline mr-1">
	              <input class="form-check-input" type="radio" id="perempuan" value="perempuan" name="jns_kelamin">
	              <label class="form-check-label" for="perempuan">Perempuan</label>
	            </div>
	          </div>
	        </div>
	        <div class="form-group row">
	          <label class="col-md-3 col-form-label" for="tmp_lahir">Tempat Lahir</label>
	          <div class="col-md-9">
	            <input type="text" id="tmp_lahir" name="tmp_lahir" class="form-control" placeholder="Masukkan Tempat Lahir">
	          </div>
	        </div>
	        <div class="form-group row">
	          <label class="col-md-3 col-form-label" for="tgl_lahir">Tanggal Lahir</label>
	          <div class="col-md-5">
	            <input type="date" id="tgl_lahir" name="tgl_lahir" class="form-control" placeholder="Masukkan Tanggal Lahir">
	          </div>
	        </div>
	        <div class="form-group row">
	          <label class="col-md-3 col-form-label" for="alamat">Alamat</label>
	          <div class="col-md-9">
	            <textarea id="alamat" name="alamat" rows="3" class="form-control" placeholder="Masukkan Alamat"></textarea>
	          </div>
	        </div>
	        <div class="form-group row">
	          <label class="col-md-3 col-form-label" for="nama">IPK</label>
	          <div class="col-md-4">
	            <input type="number" id="nama" name="nama" class="form-control" placeholder="Masukkan IPK">
	          </div>
	        </div>
	        <div class="form-group row">
	          <label class="col-md-3 col-form-label" for="kendaraan">Kendaraan</label>
	          <div class="col-md-9">
	            <input type="text" id="kendaraan" name="kendaraan" class="form-control" placeholder="Masukkan Kendaraan">
	          </div>
	        </div>
	        <div class="form-group row">
	          <label class="col-md-3 col-form-label" for="pgh_orangtua">Penghasilan Orang Tua</label>
	          <div class="col-md-7">
	          	<div class="input-group">
	          		<div class="input-group-prepend">
		          		<span class="input-group-text">Rp</span>
	          		</div>
		            <input type="number" id="pgh_orangtua" name="pgh_orangtua" class="form-control" placeholder="Masukkan Penghasilan Orang Tua">
	          	</div>
	          </div>
	        </div>
	        <div class="form-group row">
	          <label class="col-md-3 col-form-label" for="pkj_orangtua">Pekerjaan Orang Tua</label>
	          <div class="col-md-9">
	            <input type="text" id="pkj_orangtua" name="pkj_orangtua" class="form-control" placeholder="Masukkan Pekerjaan Orang Tua">
	          </div>
	        </div>
	        <div class="form-group row">
	          <label class="col-md-3 col-form-label" for="jml_tanggungan">Jumlah Tanggungan</label>
	          <div class="col-md-3">
	            <input type="number" id="jml_tanggungan" name="jml_tanggungan" class="form-control" placeholder="Masukkan Jumlah Tanggungan">
	          </div>
	        </div>
	      </form>
	    </div>
	    <div class="card-footer">
	      <button type="submit" class="btn btn-sm btn-primary">
	        <i class="fa fa-dot-circle-o"></i> Submit</button>
	      <button type="reset" class="btn btn-sm btn-danger">
	        <i class="fa fa-ban"></i> Reset</button>
	    </div>
	  </div>
	</div>
</div>