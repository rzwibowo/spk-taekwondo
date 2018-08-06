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
				<a class="nav-link" v-bind:class="Form == true?'active':''" data-toggle="tab" href="#tab_input" role="tab" aria-controls="tab_input" v-on:click="Form =true;Submit = false;reset()">
					<i class="icon-pencil"></i> Input
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link"  v-bind:class="Form == false?'active':''" data-toggle="tab" href="#tab_list" role="tab" aria-controls="tab_list" v-on:click="Form = false;Submit = false">
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
									<label class="col-md-3 col-form-label" for="nim">Kode</label>
									<div class="col-md-4">
										<input type="text" id="kode_kriteria" name="kode_kriteria" v-model="kriteria.kode_kriteria" class="form-control" placeholder="Masukkan Kode">
										<span style="color: red" v-show="Submit && !kriteria.kode_kriteria">Field harus diisi</span>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-md-3 col-form-label" for="nama">Nama</label>
									<div class="col-md-9">
										<input type="text" id="nama_kriteria" name="nama_kriteria" v-model="kriteria.nama_kriteria" class="form-control" placeholder="Masukkan Nama Kriteria">
										<span style="color: red" v-show="Submit && !kriteria.nama_kriteria">Field harus diisi</span>
									</div>
								</div>
							    <div class="form-group row">
										<label class="col-md-3 col-form-label">Type</label>
										<div class="col-md-9 col-form-label">
											<div class="form-check form-check-inline mr-1">
												<input class="form-check-input" type="radio" id="istext" v-model="kriteria.istext" value="1" name="istext" v-on:click="SubmitKriteria = []">
												<label class="form-check-label" for="true">Text</label>
											</div>
											<div class="form-check form-check-inline mr-1">
												<input class="form-check-input" type="radio" id="istext" v-model="kriteria.istext" value="0" name="istext" v-on:click="SubmitKriteria = []">
												<label class="form-check-label" for="false">Non Text</label>
											</div>
										</div>
								</div>
							</form>
						<div class="card" v-show="kriteria.istext == 1">
						<div class="card-header">
							<div class="row">
							 <div class="text-left col-md-10">
							   <strong>Detail Kriteria</strong>
							 </div>
							 <div class="text-right  col-md-2">
							    <button type="submit" class="btn btn-sm btn-primary"  v-on:click="AddKriteria(true)"> + </button>
						     </div>
						     </div>
							</div>
							<table class="table table-responsive-sm table-striped">
								<thead>
									<tr>
										<th>#</th>
										<th>Kriteria</th>
										<th>Bobot</th>
										<th>Keterangan</th>
										<th></th>
									</tr>
									
								</thead>
								<tbody>
									<tr v-for="(sub,index) in SubKriterias">
										<td>{{index + 1}}</td>
										<td>{{sub.kriteria}}</td>
										<td>{{sub.bobot}}</td>
										<td>{{sub.keterangan}}</td>
										<td><button  v-on:click="SubKriterias.splice(index,1)" class="btn btn-sm btn-danger">
											<i class="fa fa-close"></i>
										    </button>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
						<div class="card" v-show="kriteria.istext == 0">
						<div class="card-header">
							<div class="row">
							 <div class="text-left col-md-10">
							   <strong>Detail Kriteria</strong>
							 </div>
							 <div class="text-right  col-md-2">
							    <button type="submit" class="btn btn-sm btn-primary"  v-on:click="AddKriteria(false)"> + </button>
						     </div>
						     </div>
						 </div>
							<table class="table table-responsive-sm table-striped">
								<thead>
									<tr>
										<th>#</th>
										<th>Kriteria</th>
										<th>Max</th>
										<th>Oprator Max</th>
										<th>Min</th>
										<th>Operator Min</th>
										<th></th>
									</tr>
									<tr  v-for="(sub,index) in SubKriterias">
										<td>{{index+1}}</td>
										<td>{{sub.kriteria}}</td>
										<td>{{sub.max}}</td>
										<td>{{sub.operator_max}}</td>
										<td>{{sub.min}}</td>
										<td>{{sub.operator_min}}</td>
										<td><button  v-on:click="SubKriterias.splice(index,1)" class="btn btn-sm btn-danger">
											<i class="fa fa-close"></i>
										    </button>
										</td>
									</tr>
								</thead>
								<tbody>
									
								</tbody>
							</table>
						</div>
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
					<div class="card">
						<div class="card-header">
							Daftar <strong><?php echo $title ?></strong>
						</div>
						<table class="table table-responsive-sm table-striped">
							<thead>
								<tr>
									<th>#</th>
									<th>Kode Kriteria</th>
									<th>Nama Kriteria</th>
									<th></th>
								</tr>
								<tr>
									<th></th>
									<th><input type="text" 
										name="kode_kriteria" 
										class="form-control" 
										v-model="FilterModel.kode_kriteria" 
										v-on:keyup="ChangeFilter(FilterModel.kode_kriteria)"
										placeholder="Cari kode kriteria ..."></th>
									<th><input type="text" 
										name="nama_kriteria" 
										class="form-control" 
										v-model="FilterModel.nama_kriteria" 
										v-on:keyup="ChangeFilter(FilterModel.nama_kriteria)"
										placeholder="Cari nama kriteria ..."></th>
									<th></th>
									<th></th>
								</tr>
							</thead>
							<tbody>
								<tr v-for="(kriteria,index) in kriterias">
									<td>{{index + 1}}</td>
									<td>{{kriteria.kode_kriteria}}</td>
									<td>{{kriteria.nama_kriteria}}</td>
									<td> <!-- <button type="button" class="btn btn-sm btn-primary" v-on:click="Edit(kriteria.id_kriteria)">
												<i class="fa fa-pencil"></i> Edit</button> -->
												<button type="button" class="btn btn-sm btn-success" v-on:click="View(kriteria.id_kriteria)">
												<i class="fa fa-dot-circle-o"></i> View</button>
												<!-- <button type="button" class="btn btn-sm btn-danger" v-on:click="Delete(kriteria.id_kriteria)">
												<i class="fa fa-minus-circle"></i> Delete</button> -->
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
	        <h4 class="modal-title">kriteria</h4>
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
	      	  <div class="card" v-show="kriteriaView.istext == 1">
						<div class="card-header">
							   <strong>Detail Kriteria</strong>
							</div>
							<table class="table table-responsive-sm table-striped">
								<thead>
									<tr>
										<th>#</th>
										<th>Kriteria</th>
										<th>Bobot</th>
										<th>Keterangan</th>
									</tr>
									
								</thead>
								<tbody>
									<tr v-for="(sub,index) in SubKriterias">
										<td>{{index + 1}}</td>
										<td>{{sub.kriteria}}</td>
										<td>{{sub.bobot}}</td>
										<td>{{sub.keterangan}}</td>
									</tr>
								</tbody>
							</table>
			       </div>
						<div class="card" v-show="kriteriaView.istext == 0">
						<div class="card-header">
							   <strong>Detail Kriteria</strong>
						 </div>
							<table class="table table-responsive-sm table-striped">
								<thead>
									<tr>
										<th>#</th>
										<th>Kriteria</th>
										<th>Max</th>
										<th>Oprator Max</th>
										<th>Min</th>
										<th>Operator Nim</th>
									</tr>
									<tr  v-for="(sub,index) in SubKriterias">
										<td>{{index+1}}</td>
										<td>{{sub.kriteria}}</td>
										<td>{{sub.max}}</td>
										<td>{{sub.operator_max}}</td>
										<td>{{sub.min}}</td>
										<td>{{sub.operator_min}}</td>
									</tr>
								</thead>
								<tbody>
									
								</tbody>
							</table>
					</div>
	      	</form>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	      </div>
	    </div>
	  </div>
	</div>

	<div class="modal fade" id="modalDetailkriteriaText" tabindex="-1" role="dialog" aria-labelledby="modalDetailkriteriaText" aria-hidden="true" data-backdrop="static" data-keyboard="false" >
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
	      	    <label class="col-md-3 col-form-label">Kriteria</label>
	      	    <div class="col-md-9">
	      	      <input type="text" name="kriteria" v-model="SubKriteria.kriteria" class="form-control">
	      	      <input type="hidden" name="id_kriteria" v-model="SubKriteria.id_kriteria">
	      	      <span v-show="SubmitKriteria && !SubKriteria.kriteria" style="color: red">Field Harus Diisi</span>
	      	    </div>
	      	  </div>
	      	  <div class="form-group row">
	      	    <label class="col-md-3 col-form-label">Bobot</label>
	      	    <div class="col-md-9">
	      	    	<input type="number" name="bobot" v-model="SubKriteria.bobot" class="form-control">
	      	        <span v-show="SubmitKriteria && !SubKriteria.bobot" style="color: red">Field Harus Diisi</span>
	      	    </div>
	      	  </div>
	      	  <div class="form-group row">
	      	    <label class="col-md-3 col-form-label">Keterangan</label>
	      	    <div class="col-md-9">
	      	    	<textarea name="keterangan" v-model="SubKriteria.keterangan" class="form-control">
	      	    		
	      	    	</textarea>
	      	    	<span v-show="SubmitKriteria && !SubKriteria.bobot" style="color: red">Field Harus Diisi</span>
	      	    </div>
	      	  </div>
	      	</form>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-primary" v-on:click="AddKriteriatext">Add</button>
	      </div>
	    </div>
	  </div>
	</div>
	<div class="modal fade" id="modalDetailkriterianonText" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="modalDetailkriteriaText" aria-hidden="true">
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
	      	    <label class="col-md-3 col-form-label">Kriteria</label>
	      	    <div class="col-md-9">
	      	      <input type="text" name="kriteria" v-model="SubKriteria.kriteria" class="form-control">
	      	      <input type="hidden" name="id_kriteria" v-model="SubKriteria.id_kriteria">
	      	      <span v-show="SubmitKriteria && !SubKriteria.kriteria" style="color: red">Field Harus Diisi</span>
	      	    </div>
	      	  </div>
	      	  <div class="form-group row">
	      	    <label class="col-md-3 col-form-label">Min</label>
	      	    <div class="col-md-9">
	      	    	<input type="number" name="min" v-model="SubKriteria.min" class="form-control">
	      	       <span v-show="SubmitKriteria && !SubKriteria.min" style="color: red">Field Harus Diisi</span>
	      	    </div>
	      	  </div>
	      	   <div class="form-group row">
	      	    <label class="col-md-3 col-form-label">Operator Min</label>
	      	   <div class="col-md-9 col-form-label">
					<div class="form-check form-check-inline mr-1">
							<input class="form-check-input" type="radio" id="operator_nim" v-model="SubKriteria.operator_min" value=">" name="operator_nim">
							<label class="form-check-label" for="operator_nim">></label>
					</div>
					<div class="form-check form-check-inline mr-1">
							<input class="form-check-input" type="radio" id="operator_nim" v-model="SubKriteria.operator_min" value="<" name="operator_nim">
							<label class="form-check-label" for="operator_nim"><</label>
					</div>
					<div class="form-check form-check-inline mr-1">
							<input class="form-check-input" type="radio" id="operator_nim" v-model="SubKriteria.operator_min" value=">=" name="operator_nim">
							<label class="form-check-label" for="operator_nim">>=</label>
					</div>
					<div class="form-check form-check-inline mr-1">
							<input class="form-check-input" type="radio" id="operator_nim" v-model="SubKriteria.operator_min" value="<=" name="operator_nim" >
							<label class="form-check-label" for="operator_nim"><=</label>
					</div>
					<div class="form-check form-check-inline mr-1">
							<input class="form-check-input" type="radio" id="operator_nim" v-model="SubKriteria.operator_min" value="==" name="operator_nim" >
							<label class="form-check-label" for="operator_nim">==</label>
					</div>
					<span v-show="SubmitKriteria && !SubKriteria.operator_min" style="color: red">Field Harus Diisi</span>
				</div>
	      	  </div>
	      	  <div class="form-group row">
	      	    <label class="col-md-3 col-form-label">Max</label>
	      	    <div class="col-md-9">
	      	    	<input type="number" name="max" v-model="SubKriteria.max" class="form-control" :disabled="SubKriteria.operator_min == '<' || SubKriteria.operator_min == '<=' ">
	      	    	<span v-show="SubmitKriteria && !SubKriteria.max" style="color: red">Field Harus Diisi</span>
	      	    </div>
	      	  </div>
	      	  <div class="form-group row">
	      	    <label class="col-md-3 col-form-label">Operator Max</label>
	      	   <div class="col-md-9 col-form-label">
					<div class="form-check form-check-inline mr-1">
							<input class="form-check-input" type="radio" id="oprator_max" v-model="SubKriteria.operator_max" value="<" name="oprator_max" :disabled="SubKriteria.operator_min == '<' || SubKriteria.operator_min == '<=' ">
							<label class="form-check-label" for="oprator_max"><</label>
					</div>
					<div class="form-check form-check-inline mr-1">
							<input class="form-check-input" type="radio" id="oprator_max" v-model="SubKriteria.operator_max" value="<=" name="oprator_max" :disabled="SubKriteria.operator_min == '<' || SubKriteria.operator_min == '<=' ">
							<label class="form-check-label" for="oprator_max"><=</label>
					</div>
					<div class="form-check form-check-inline mr-1">
							<input class="form-check-input" type="radio" id="oprator_max" v-model="SubKriteria.operator_max" value="==" name="oprator_max" :disabled="SubKriteria.operator_min == '<' || SubKriteria.operator_min == '<=' ">
							<label class="form-check-label" for="oprator_max">==</label>
					</div>
					<span v-show="SubmitKriteria && !SubKriteria.operator_max" style="color: red">Field Harus Diisi</span>
				</div>
	      	  </div>
	      	  <div class="form-group row">
	      	    <label class="col-md-3 col-form-label">Bobot</label>
	      	    <div class="col-md-9">
	      	    	<input type="number" name="bobot" v-model="SubKriteria.bobot" class="form-control">
	      	    	<span v-show="SubmitKriteria && !SubKriteria.bobot" style="color: red">Field Harus Diisi</span>
	      	    </div>
	      	  </div>
	      	  <div class="form-group row">
	      	    <label class="col-md-3 col-form-label">Keterangan</label>
	      	    <div class="col-md-9">
	      	    	<textarea name="keterangan" v-model="SubKriteria.keterangan" class="form-control">
	      	    		
	      	    	</textarea>
	      	    	<span v-show="SubmitKriteria && !SubKriteria.keterangan" style="color: red">Field Harus Diisi</span>
	      	    </div>
	      	  </div>
	      	</form>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-primary" v-on:click="AddKriterianontext">Add</button>
	      </div>
	    </div>
	  </div>
	</div>
</div>
<script type="text/javascript">

var app = new Vue({
  el: '#app',
  created(){
    this.GetData();
    this.kriteria.SubKriteria = [];
  },
  data: {
  	kriteria:{},
  	kriterias:[],
  	FilterModel:[],
  	kriteriaView:{},
  	SubKriterias :[],
  	SubKriteria:{},
  	Form:{},
  	Submit:{},
  	SubmitKriteria:{},
  },
  methods: {
    Save() 
    {
    	this.Submit = true;
    	if(this.kriteria.kode_kriteria && this.kriteria.nama_kriteria){
    	this.kriteria.SubKriteria = this.SubKriterias;
    	axios
    	.post(locationServer+'/api/kriteria/kriteria',{
          body: this.kriteria
    	})
        .then(response => {
        	this.GetData();
        	this.reset();
  	        this.Submit = false;
       })
       .catch(error => {
        console.log(error);
        alert("Gagal Simpan Data");
        this.errored = true
      })
      .finally(() => console.log())
      }
   },
   GetData()
   {
      axios
    	.post(locationServer+'/api/kriteria/kriterias',{
    		body: this.Filter()
    	})
        .then(response => {
        	this.kriterias =  response.data;
        	this.Form = false;
  	        this.Submit = false;
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
   	this.Submit = false;
   	this.SubKriterias = [];
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
  	this.Submit = false;
     axios
    	.get(locationServer+'/api/kriteria/GetDataKriteriaById/'+Id)
        .then(response => {
        	this.kriteria =  response.data;
        	this.Form = true;
        	this.EditDetail(Id,response.data.istext);
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
        	this.GetDetailKriteria(Id,response.data.istext);
       })
       .catch(error => {
        console.log(error)
        this.errored = true
      })
      .finally(() => this.loading = false )
   },
   AddKriteria(text){
   	this.SubKriteria = {};
   	this.SubmitKriteria = false;
   if(text){
	$("#modalDetailkriteriaText").modal('show');
   }else{
   	$("#modalDetailkriterianonText").modal('show');
   }
    
   },
   AddKriteriatext(){
   	this.SubmitKriteria = true;
    if(this.SubKriteria.kriteria && this.SubKriteria.bobot && this.SubKriteria.keterangan){
        var sub = this.SubKriteria;
	   	this.SubKriterias.push(sub);
	   $("#modalDetailkriteriaText").modal('hide');
    }
   },
    AddKriterianontext(){
   	this.SubmitKriteria = true;
   	if(this.SubKriteria.kriteria && this.SubKriteria.min && this.SubKriteria.operator_nim && this.SubKriteria.max && this.SubKriteria.operator_max && this.SubKriteria.bobot && this.SubKriteria.keterangan ){
   		var sub = this.SubKriteria;
   		this.SubKriterias.push(sub);
    	$("#modalDetailkriterianonText").modal('hide');
   	}
   },
   GetDetailKriteria(Id,Type){
   	    axios
    	.get(locationServer+'/api/kriteria/GetDetailKriteria/'+Id+'/'+Type)
        .then(response => {
        	this.SubKriterias =  response.data;
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