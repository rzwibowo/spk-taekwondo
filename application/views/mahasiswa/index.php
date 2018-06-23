<div class="row" id="app">
	<!-- BEGIN form input -->
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
	            <input type="text" id="nim" name="nim" v-model="mahasiswa.nim" class="form-control" placeholder="Masukkan NIM">
	          </div>
	        </div>
	        <div class="form-group row">
	          <label class="col-md-3 col-form-label" for="nama">Nama</label>
	          <div class="col-md-9">
	            <input type="text" id="nama" name="nama" v-model="mahasiswa.nama" class="form-control" placeholder="Masukkan Nama">
	          </div>
	        </div>
	        <div class="form-group row">
	          <label class="col-md-3 col-form-label" for="thn_angkatan">Tahun Angkatan</label>
	          <div class="col-md-5">
	            <input type="number" id="thn_angkatan" v-model="mahasiswa.thn_angkatan" name="thn_angkatan" class="form-control">
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
	          </div>
	        </div>
	        <div class="form-group row">
	          <label class="col-md-3 col-form-label" for="tempat_lahir">Tempat Lahir</label>
	          <div class="col-md-9">
	            <input type="text" id="tempat_lahir" name="tempat_lahir"  v-model="mahasiswa.tempat_lahir" class="form-control" placeholder="Masukkan Tempat Lahir">
	          </div>
	        </div>
	        <div class="form-group row">
	          <label class="col-md-3 col-form-label" for="tgl_lahir">Tanggal Lahir</label>
	          <div class="col-md-5">
	            <input type="date" id="tgl_lahir" name="tgl_lahir" v-model="mahasiswa.tgl_lahir" class="form-control">
	          </div>
	        </div>
	        <div class="form-group row">
	          <label class="col-md-3 col-form-label" for="alamat">Alamat</label>
	          <div class="col-md-9">
	            <textarea id="alamat" name="alamat" rows="3" v-model="mahasiswa.alamat" class="form-control" placeholder="Masukkan Alamat"></textarea>
	          </div>
	        </div>
	        <!-- <div class="form-group row">
	          <label class="col-md-3 col-form-label" for="nama">IPK</label>
	          <div class="col-md-4">
	            <input type="number" id="nama" name="nama" v-model="mahasiswa.ipk" class="form-control" placeholder="Masukkan IPK">
	          </div>
	        </div>
	        <div class="form-group row">
	          <label class="col-md-3 col-form-label" for="kendaraan">Kendaraan</label>
	          <div class="col-md-9">
	            <input type="text" id="kendaraan" name="kendaraan" v-model="mahasiswa.kendaraan" class="form-control" placeholder="Masukkan Kendaraan">
	          </div>
	        </div> -->
	        <!-- <div class="form-group row">
	          <label class="col-md-3 col-form-label" for="pgh_orangtua">Penghasilan Orang Tua</label>
	          <div class="col-md-7">
	          	<div class="input-group">
	          		<div class="input-group-prepend">
		          		<span class="input-group-text">Rp</span>
	          		</div>
		            <input type="number" id="pgh_orangtua" name="pgh_orangtua" v-model="mahasiswa.pgh_orangtua" class="form-control">
	          	</div>
	          </div>
	        </div> -->
	        <!-- <div class="form-group row">
	          <label class="col-md-3 col-form-label" for="pkj_orangtua">Pekerjaan Orang Tua</label>
	          <div class="col-md-9">
	            <input type="text" id="pkj_orangtua" name="pkj_orangtua" v-model="mahasiswa.pkj_orangtua" class="form-control" placeholder="Masukkan Pekerjaan Orang Tua">
	          </div>
	        </div> -->
	       <!--  <div class="form-group row">
	          <label class="col-md-3 col-form-label" for="jml_tanggungan">Jumlah Tanggungan</label>
	          <div class="col-md-3">
	            <input type="number" id="jml_tanggungan" name="jml_tanggungan" v-model="mahasiswa.jml_tanggungan" class="form-control">
	          </div>
	        </div> -->
	      </form>
	    </div>
	    <div class="card-footer">
	      <button type="submit" class="btn btn-sm btn-primary"  v-on:click="Save">
	        <i class="fa fa-dot-circle-o"></i> Simpan</button>
	      <button type="reset" v-on:click="reset" class="btn btn-sm btn-danger">
	        <i class="fa fa-ban"></i> Reset</button>
	    </div>
	  </div>
	</div>
	<!-- END form input -->

	<!-- START list -->
	<div class="col-md-6">
		<div class="card">
		  <div class="card-header">
		    Daftar <strong>Mahasiswa</strong>
		  </div>
		  <div class="card-body">
		    <table class="table table-responsive-sm table-striped">
		      <thead>
		        <tr>
		          <th>#</th>
		          <th>NIM</th>
		          <th>Nama</th>
		          <th>Tahun Angkatan</th>
		          <th></th>
		        </tr>
		      </thead>
		      <tbody>
		       <tr v-for="(mahasiswa,index) in mahasiswas">
		       	<td>{{index + 1}}</td>
		       	<td>{{mahasiswa.nim}}</td>
		       	<td>{{mahasiswa.nama}}</td>
		       	<td>{{mahasiswa.thn_angkatan}}</td>
		       </tr>
		      </tbody>
		    </table>
		    <ul class="pagination">
		      <li class="page-item">
		        <a class="page-link" href="#">Prev</a>
		      </li>
		      <li class="page-item active">
		        <a class="page-link" href="#">1</a>
		      </li>
		      <li class="page-item">
		        <a class="page-link" href="#">2</a>
		      </li>
		      <li class="page-item">
		        <a class="page-link" href="#">3</a>
		      </li>
		      <li class="page-item">
		        <a class="page-link" href="#">4</a>
		      </li>
		      <li class="page-item">
		        <a class="page-link" href="#">Next</a>
		      </li>
		    </ul>
		  </div>
		</div>
	</div>
	<!-- END list -->

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
	      	      <p class="form-control-static"><b>1456110123</b></p>
	      	    </div>
	      	  </div>
	      	  <div class="form-group row">
	      	    <label class="col-md-3 col-form-label">Nama</label>
	      	    <div class="col-md-9">
	      	      <p class="form-control-static"><b>Informatiko</b></p>
	      	    </div>
	      	  </div>
	      	  <div class="form-group row">
	      	    <label class="col-md-3 col-form-label">Tahun Angkatan</label>
	      	    <div class="col-md-9">
	      	      <p class="form-control-static"><b>2014</b></p>
	      	    </div>
	      	  </div>
	      	  <div class="form-group row">
	      	    <label class="col-md-3 col-form-label">Jenis Kelamin</label>
	      	    <div class="col-md-9">
	      	      <p class="form-control-static"><b>Laki-laki</b></p>
	      	    </div>
	      	  </div>
	      	  <div class="form-group row">
	      	    <label class="col-md-3 col-form-label">Tempat Lahir</label>
	      	    <div class="col-md-9">
	      	      <p class="form-control-static"><b>Alas Pari</b></p>
	      	    </div>
	      	  </div>
	      	  <div class="form-group row">
	      	    <label class="col-md-3 col-form-label">Tanggal Lahir</label>
	      	    <div class="col-md-9">
	      	      <p class="form-control-static"><b>11 November 1991</b></p>
	      	    </div>
	      	  </div>
	      	  <div class="form-group row">
	      	    <label class="col-md-3 col-form-label">Alamat</label>
	      	    <div class="col-md-9">
	      	      <p class="form-control-static"><b>Jalan Lurus No. 11</b></p>
	      	    </div>
	      	  </div>
	      	  <div class="form-group row">
	      	    <label class="col-md-3 col-form-label">IPK</label>
	      	    <div class="col-md-9">
	      	      <p class="form-control-static"><b>3.88</b></p>
	      	    </div>
	      	  </div>
	      	  <div class="form-group row">
	      	    <label class="col-md-3 col-form-label">Kendaraan</label>
	      	    <div class="col-md-9">
	      	      <p class="form-control-static"><b>Traktor</b></p>
	      	    </div>
	      	  </div>
	      	  <div class="form-group row">
	      	    <label class="col-md-3 col-form-label">Penghasilan Orang Tua</label>
	      	    <div class="col-md-9">
	      	      <p class="form-control-static"><b>Rp 1.234.000,00</b></p>
	      	    </div>
	      	  </div>
	      	  <div class="form-group row">
	      	    <label class="col-md-3 col-form-label">Pekerjaan Orang Tua</label>
	      	    <div class="col-md-9">
	      	      <p class="form-control-static"><b>Anggota DPR</b></p>
	      	    </div>
	      	  </div>
	      	  <div class="form-group row">
	      	    <label class="col-md-3 col-form-label">Jumlah Tanggungan</label>
	      	    <div class="col-md-9">
	      	      <p class="form-control-static"><b>11</b></p>
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
<script type="text/javascript">

var app = new Vue({
  el: '#app',
  created(){
    this.GetData();
  },
  data: {
  	mahasiswa:{},
  	mahasiswas:[]
  },
  methods: {
    Save() 
    {
    	axios
    	.post('http://localhost/spk-beasiswa/index.php/api/mahasiswa/mahasiswa',{
          body: this.mahasiswa
    	})
        .then(response => {
        	this.GetData();
        	this.reset();
       })
       .catch(error => {
        console.log(error)
        this.errored = true
      })
      .finally(() => this.GetData())
   },
   GetData()
   {
      axios
    	.get('http://localhost/spk-beasiswa/index.php/api/mahasiswa/mahasiswas')
        .then(response => {
        	this.mahasiswas =  response.data;
       })
       .catch(error => {
        console.log(error)
        this.errored = true
      })
      .finally(() => this.loading = false )

   },
   reset()
   {
   	this.mahasiswa = {};
   }
 }
})
        
</script>