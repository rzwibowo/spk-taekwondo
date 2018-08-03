<div class="row" id="app">
	<div class="col-md-12">
		<div class="card">
			<div class="card-body">
				<h3>Data <?php echo $title ?></h3>
			</div>
		</div>
	</div>
	<div class="col-md-12">
		<ul class="nav nav-tabs" role="tablist">
			<li class="nav-item">
				<a class="nav-link" v-bind:class="Form == true?'active':''" data-toggle="tab" href="#tab_input" role="tab" aria-controls="tab_input" v-on:click="Form = true;Submit = false;">
					<i class="icon-pencil"></i> Input
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" v-bind:class="Form == false?'active':''" data-toggle="tab" href="#tab_list" role="tab" aria-controls="tab_list" v-on:click="Form = false;Submit = false">
					<i class="icon-list"></i> List
				</a>
			</li>
		</ul>
		<div class="tab-content">
			<div class="tab-pane" id="tab_input" role="tabpanel" v-bind:class="Form == true?'active':''">
				<!-- BEGIN form input -->
				<div class="col-md-6 offset-md-3">
					<div class="card">
						<div class="card-header">
							Input Data 
							<strong><?php echo $title ?></strong>
						</div>
						<div class="card-body">
							<form action="" method="post" class="form-horizontal">
								<div class="form-group row">
									<label class="col-md-4 col-form-label" for="nim">Tahun Angkatan</label>
									<div class="col-md-4">
										<input type="number" min="2000" id="tahun_angkatan" name="tahun_angkatan" v-model="TahunAngkatan.tahun_angkatan" class="form-control" placeholder="Tahun Angkatan">
										<span style="color: red" v-show="!TahunAngkatan.tahun_angkatan && Submit">Fied harus diisi</span>
									</div>
								</div>
							</form>
						</div>
						<div class="card-footer text-right">
							<button type="submit" class="btn btn-sm btn-primary"  v-on:click="Save">
								<i class="fa fa-dot-circle-o"></i> Simpan</button>
							<button type="reset" v-on:click="reset" class="btn btn-sm btn-danger" v-on:click="Submit = false">
								<i class="fa fa-ban"></i> Reset</button>
						</div>
					</div>
				</div>
				<!-- END form input -->	
			</div>
			<div class="tab-pane" id="tab_list" role="tabpanel" v-bind:class="Form == false?'active':''">
				<!-- START list -->
				<div class="col-md-6 offset-md-3">
					<div class="card">
						<div class="card-header">
							Daftar <strong><?php echo $title ?></strong>
						</div>
						<table class="table table-responsive-sm table-striped">
							<thead>
								<tr>
									<th>#</th>
									<th class="text-center">Tahun</th>
									<th></th>
								</tr>
								<tr>
									<th></th>
									<th><input type="text" 
										name="tahun_angkatan" 
										class="form-control text-center" 
										v-model="FilterModel.tahun_angkatan" 
										v-on:keyup="ChangeFilter(FilterModel.tahun_angkatan)"
										placeholder="Cari tahun angkatan ..."></th>
									<th></th>
								</tr>
							</thead>
							<tbody>
								<tr v-for="(tahunangkatan,index) in TahunAngkatans">
									<td>{{index + 1}}</td>
									<td class="text-center">{{tahunangkatan.tahun_angkatan}}</td>
									<td> <button type="button" class="btn btn-sm btn-primary" v-on:click="Edit(tahunangkatan.id_tahun_angkatan)">
												<i class="fa fa-pencil"></i> Edit</button>
												<button type="button" class="btn btn-sm btn-success" v-on:click="View(tahunangkatan.id_tahun_angkatan)">
												<i class="fa fa-dot-circle-o"></i> View</button>
												<button type="button" class="btn btn-sm btn-danger" v-on:click="Delete(tahunangkatan.id_tahun_angkatan)">
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
	<div class="modal fade" id="detail-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  <div class="modal-dialog modal-info modal-dialog-centered" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h4 class="modal-title">Detail <?php echo $title ?></h4>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	      	<form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
	      	  <div class="form-group row">
	      	    <label class="col-md-6 col-form-label">Tahun Angkatan</label>
	      	    <div class="col-md-3">
	      	      <label class=" col-form-label"><b>{{TahunAngkatan.tahun_angkatan}}</b></label>
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
	</div>
	<!-- END modal detail -->
</div>
<script type="text/javascript">

var app = new Vue({
  el: '#app',
  created(){
    this.GetData();
    this.Form = false;
  },
  data: {
  	TahunAngkatan:{},
  	TahunAngkatans:[],
  	FilterModel:{},
  	Form:{},
  	Submit:{}
  },
  methods: {
   Save() 
   {
   	this.Submit = true;
   	if(this.TahunAngkatan.tahun_angkatan){
       axios
    	.post(locationServer+'/api/tahunangkatan/tahunangkatan',{
          body: this.TahunAngkatan
    	})
        .then(response => {
        	this.GetData();
        	this.reset();
        	this.Form = false;
	       })
	       .catch(error => {
	        console.log(error);
	       	alert("Save Gagal");
	        this.errored = true
	      })
	      .finally(() => this.GetData())
	      this.Submit = false;
	 }
   },
   GetData()
   {
      axios
    	.post(locationServer+'/api/tahunangkatan/tahunangkatans',{
    		body: this.Filter()
    	})
        .then(response => {
        	this.TahunAngkatans =  response.data;
        	this.Form = false;
        	this.Submit = false;
       })
       .catch(error => {
        console.log(error);
       	alert("Get Data Gagal");
        this.errored = true
      })
      .finally(() => this.loading = false )

   },
   reset()
   {
   	this.TahunAngkatan = {};
   },
   Filter()
   {
      var FilterParam = {};
      if(this.FilterModel.tahun_angkatan !== null && this.FilterModel.tahun_angkatan !== "" ){
        FilterParam.tahun_angkatan =this.FilterModel.tahun_angkatan;
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
    	.get(locationServer+'/api/tahunangkatan/gettahunangkatanbyid/'+Id)
        .then(response => {
        	this.TahunAngkatan =  response.data;
        	this.Form = true;
        	this.Submit = false;
       })
       .catch(error => {
        console.log(error);
        alert("Get Data Gagal Gagal");
        this.errored = true
      })
      .finally(() => this.loading = false )
   },
   Delete(Id)
   {
   	var x = confirm("Are you sure you want to delete?");
    if (x){
       axios
   	   .get(locationServer+'/api/tahunangkatan/tahunangkatandelete/'+Id)
        .then(response => {
        this.GetData();
        this.Form = false;
        this.Submit = false;
       })
       .catch(error => {
        console.log(error);
        alert("Delete Gagal");
        this.errored = true
       })
       .finally(() => this.loading = false )
    }
   },
   View(Id)
   {
   	axios
    	.get(locationServer+'/api/tahunangkatan/gettahunangkatanbyid/'+Id)
        .then(response => {
        	this.TahunAngkatan =  response.data;
        	this.Form = false;
        	this.Submit = false;
         	$("#detail-modal").modal('show');
       })
       .catch(error => {
        console.log(error);
        alert("Get Data Gagal");
        this.errored = true
      })
      .finally(() => this.loading = false )
   }
  }
})

loaderStop()      
</script>