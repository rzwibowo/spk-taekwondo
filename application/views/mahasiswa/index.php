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
		        <tr>
		          <th></th>
		          <th><input type="text" name="nim" class="form-control" v-model="FilterModel.nim" v-on:keyup="ChangeFilter(FilterModel.nim)"></th>
		          <th><input type="text" name="nama" class="form-control" v-model="FilterModel.nama" v-on:keyup="ChangeFilter(FilterModel.nama)"></th>
		          <th><input type="text" name="thn_angkatan" class="form-control" v-model="FilterModel.thn_angkatan" v-on:keyup="ChangeFilter(FilterModel.thn_angkatan)"></th>
		          <th></th>
		        </tr>
		      </thead>
		      <tbody>
		       <tr v-for="(mahasiswa,index) in mahasiswas">
		       	<td>{{index + 1}}</td>
		       	<td>{{mahasiswa.nim}}</td>
		       	<td>{{mahasiswa.nama}}</td>
		       	<td>{{mahasiswa.thn_angkatan}}</td>
		       	<td> <button type="button" class="btn btn-sm btn-primary" v-on:click="Edit(mahasiswa.id_mahasiswa)">
	                 <i class="fa fa-ban"></i> Edit</button>
	                <button type="button" class="btn btn-sm btn-success" v-on:click="View(mahasiswa.id_mahasiswa)">
	                <i class="fa fa-dot-circle-o"></i> View</button>
	                <button type="button" class="btn btn-sm btn-danger" v-on:click="Delete(mahasiswa.id_mahasiswa)">
	                <i class="fa fa-minus-circle"></i> Delete</button>
	            </td>
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
	      	      <p class="form-control-static"><b>{{mahasiswaView.thn_angkatan}}</b></p>
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
	      	<!--   <div class="form-group row">
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
	      	  </div> -->
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
  	mahasiswas:[],
  	FilterModel:[],
  	mahasiswaView:{}
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
    	.post('http://localhost/spk-beasiswa/index.php/api/mahasiswa/mahasiswas',{
    		body: this.Filter()
    	})
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
   },
   Filter()
   {
      var FilterParam = {};
      if(this.FilterModel.nim !== "" && this.FilterModel.nim !== null ){
        FilterParam.nim =this.FilterModel.nim;
      }
      if(this.FilterModel.nama !== null && this.FilterModel.nama !== "" ){
        FilterParam.nama =this.FilterModel.nama;
      }
      if(this.FilterModel.thn_angkatan !== null && this.FilterModel.thn_angkatan !== "" ){
        FilterParam.thn_angkatan =this.FilterModel.thn_angkatan;
      }
      return FilterParam;
   },
   ChangeFilter(Param)
   {
   	if(Param.length > 2){
        this.GetData();
    }else if(Param.length == 0){
          this.GetData();
    }

   },
   Edit(Id)
   {
     axios
    	.get('http://localhost/spk-beasiswa/index.php/api/mahasiswa/GetDataMahasiswaById/'+Id)
        .then(response => {
        	this.mahasiswa =  response.data;
       })
       .catch(error => {
        console.log(error)
        this.errored = true
      })
      .finally(() => this.loading = false )
   },
   Delete(Id)
   {
   	var x = confirm("Are you sure you want to delete?");
    if (x){
       axios
   	   .get('http://localhost/spk-beasiswa/index.php/api/mahasiswa/mahasiswadelete/'+Id)
        .then(response => {
        this.GetData();
       })
       .catch(error => {
        console.log(error)
        this.errored = true
       })
       .finally(() => this.loading = false )
    }
   },
   View(Id)
   {
   	axios
    	.get('http://localhost/spk-beasiswa/index.php/api/mahasiswa/GetDataMahasiswaById/'+Id)
        .then(response => {
        	this.mahasiswaView =  response.data;
         	$("#detail-modal").modal('show');
       })
       .catch(error => {
        console.log(error)
        this.errored = true
      })
      .finally(() => this.loading = false )
   }
 }
})
        
</script>