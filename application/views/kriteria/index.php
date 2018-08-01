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
				<a class="nav-link active" data-toggle="tab" href="#tab_input" role="tab" aria-controls="tab_input">
					<i class="icon-pencil"></i> Input
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" data-toggle="tab" href="#tab_list" role="tab" aria-controls="tab_list">
					<i class="icon-list"></i> List
				</a>
			</li>
		</ul>
		<div class="tab-content">
			<div class="tab-pane active" id="tab_input" role="tabpanel">
				<!-- BEGIN form input -->
				<div class="col-md-6 offset-3">
					<div class="card">
						<div class="card-header">
							Input Data 
							<strong>Kriteria</strong>
						</div>
						<div class="card-body">
							<form action="" method="post" class="form-horizontal">
								<div class="form-group row">
									<label class="col-md-3 col-form-label" for="nim">Kode</label>
									<div class="col-md-9">
										<input type="text" id="kode_kriteria" name="kode_kriteria" v-model="kriteria.kode_kriteria" class="form-control" placeholder="Masukkan Kode">
									</div>
								</div>
								<div class="form-group row">
									<label class="col-md-3 col-form-label" for="nama">Nama</label>
									<div class="col-md-9">
										<input type="text" id="nama_kriteria" name="nama_kriteria" v-model="kriteria.nama_kriteria" class="form-control" placeholder="Masukkan Nama">
									</div>
								</div>
								<div class="form-group row">
									<label class="col-md-3 col-form-label" for="nama">Bobot</label>
									<div class="col-md-9">
										<input type="text" id="bobot_kriteria" name="bobot_kriteria" v-model="kriteria.bobot_kriteria" class="form-control" placeholder="Masukkan Bobot">
									</div>
								</div>
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
			</div>
			<div class="tab-pane" id="tab_list" role="tabpanel">
				<!-- START list -->
				<div class="col-md-12">
					<div class="card">
						<div class="card-header">
							Daftar <strong>kriteria</strong>
						</div>
						<div class="card-body">
							<table class="table table-responsive-sm table-striped">
								<thead>
									<tr>
										<th>#</th>
										<th>Kode Kriteria</th>
										<th>Nama Kriteria</th>
										<th>Bobot</th>
										<th></th>
									</tr>
									<tr>
										<th></th>
										<th><input type="text" name="kode_kriteria" class="form-control" v-model="FilterModel.kode_kriteria" v-on:keyup="ChangeFilter(FilterModel.kode_kriteria)"></th>
										<th><input type="text" name="nama_kriteria" class="form-control" v-model="FilterModel.nama_kriteria" v-on:keyup="ChangeFilter(FilterModel.nama_kriteria)"></th>
										<th><input type="text" name="bobot_kriteria" class="form-control" v-model="FilterModel.bobot_kriteria" v-on:keyup="ChangeFilter(FilterModel.bobot_kriteria)"></th>
										<th></th>
									</tr>
								</thead>
								<tbody>
									<tr v-for="(kriteria,index) in kriterias">
										<td>{{index + 1}}</td>
										<td>{{kriteria.kode_kriteria}}</td>
										<td>{{kriteria.nama_kriteria}}</td>
										<td> <button type="button" class="btn btn-sm btn-primary" v-on:click="Edit(kriteria.kode_kriteria)">
													<i class="fa fa-pencil"></i> Edit</button>
													<button type="button" class="btn btn-sm btn-success" v-on:click="View(kriteria.kode_kriteria)">
													<i class="fa fa-dot-circle-o"></i> View</button>
													<button type="button" class="btn btn-sm btn-danger" v-on:click="Delete(kriteria.kode_kriteria)">
													<i class="fa fa-minus-circle"></i> Delete</button>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
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
	        <h4 class="modal-title">Detail kriteria</h4>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	      	<form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
	      	  <div class="form-group row">
	      	    <label class="col-md-3 col-form-label">Kode Kriteria</label>
	      	    <div class="col-md-9">
	      	      <p class="form-control-static"><b>{{kriteriaView.kode_kriteria}}</b></p>
	      	    </div>
	      	  </div>
	      	  <div class="form-group row">
	      	    <label class="col-md-3 col-form-label">Nama Kriteria</label>
	      	    <div class="col-md-9">
	      	      <p class="form-control-static"><b>{{kriteriaView.nama_kriteria}}</b></p>
	      	    </div>
	      	  </div>
	      	  <div class="form-group row">
	      	    <label class="col-md-3 col-form-label">Bobot Kriteria</label>
	      	    <div class="col-md-9">
	      	      <p class="form-control-static"><b>{{kriteriaView.bobot_kriteria}}</b></p>
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
  	kriteria:{},
  	kriterias:[],
  	FilterModel:[],
  	kriteriaView:{}
  },
  methods: {
    Save() 
    {
    	axios
    	.post(locationServer+'/api/kriteria/kriteria',{
          body: this.kriteria
    	})
        .then(response => {
        	this.GetData();
        	this.reset();
					$('.nav-tabs a[href="#tab_list"]').tab('show')
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
    	.post(locationServer+'/api/kriteria/kriterias',{
    		body: this.Filter()
    	})
        .then(response => {
        	this.kriterias =  response.data;
       })
       .catch(error => {
        console.log(error)
        this.errored = true
      })
      .finally(() => this.loading = false )

   },
   reset()
   {
   	this.kriteria = {};
   },
   Filter()
   {
      var FilterParam = {};
      if(this.FilterModel.kode_kriteria !== "" && this.FilterModel.kode_kriteria !== null ){
        FilterParam.kode_kriteria =this.FilterModel.kode_kriteria;
      }
      if(this.FilterModel.nama_kriteria !== null && this.FilterModel.nama_kriteria !== "" ){
        FilterParam.nama =this.FilterModel.nama_kriteria;
      }
      if(this.FilterModel.bobot_kriteria !== null && this.FilterModel.bobot_kriteria !== "" ){
        FilterParam.bobot_kriteria =this.FilterModel.bobot_kriteria;
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
    	.get(locationServer+'/api/kriteria/GetDataKriteriaById/'+Id)
        .then(response => {
        	this.kriteria =  response.data;
					$('.nav-tabs a[href="#tab_input"]').tab('show')
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
   	   .get(locationServer+'/api/kriteria/kriteriadelete/'+Id)
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
    	.get(locationServer+'/api/kriteria/GetDataKriteriaById/'+Id)
        .then(response => {
        	this.kriteriaView =  response.data;
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

loaderStop()      
</script>