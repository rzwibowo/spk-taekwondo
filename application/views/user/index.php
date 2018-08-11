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
				<a class="nav-link" v-bind:class="Form == true?'active':''" data-toggle="tab" href="#tab_input" role="tab" aria-controls="tab_input" v-on:click="Form = true;reset()">
					<i class="icon-pencil"></i> Input
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" v-bind:class="Form == false?'active':''" data-toggle="tab" href="#tab_list" role="tab" aria-controls="tab_list" v-on:click="Form = false">
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
									<label class="col-md-3 col-form-label" for="username">NIP</label>
									<div class="col-md-9">
										<input type="text" id="nip" name="nip" v-model="User.nip" class="form-control" placeholder="nip">
									</div>
								</div>
								<div class="form-group row">
									<label class="col-md-3 col-form-label" for="username">User Name</label>
									<div class="col-md-9">
										<input type="text" id="username" name="username" v-model="User.username" class="form-control" placeholder="User Name">
									</div>
								</div>
								<div class="form-group row">
									<label class="col-md-3 col-form-label" for="nim">Password</label>
									<div class="col-md-9">
										<input type="password" id="password" name="password" v-model="User.password" class="form-control" placeholder="Password">
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
				<div class="col-md-8 offset-md-2">
					<div class="card">
						<div class="card-header">
							Daftar <strong><?php echo $title ?></strong>
						</div>
						<table class="table table-responsive-sm table-striped">
							<thead>
								<tr>
									<th>#</th>
									<th>NIP</th>
									<th>User Name</th>
									<th></th>
								</tr>
								<tr>
									<th></th>
									<th><input type="text" name="nip" class="form-control" v-model="FilterModel.nip" v-on:keyup="ChangeFilter(FilterModel.nip)" placeholder="Cari NIP pengguna ..."></th>
									<th><input type="text" name="username" class="form-control" v-model="FilterModel.username" v-on:keyup="ChangeFilter(FilterModel.username)" placeholder="Cari username ..."></th>
									<th></th>
								</tr>
							</thead>
							<tbody>
								<tr v-for="(user,index) in Users">
									<td>{{index + 1}}</td>
									<td>{{user.nip}}</td>
									<td>{{user.username}}</td>
									<td> <button type="button" class="btn btn-sm btn-primary" v-on:click="Edit(user.id_pengelola)">
												<i class="fa fa-pencil"></i> Edit</button>
												<button type="button" class="btn btn-sm btn-success" v-on:click="View(user.id_pengelola)">
												<i class="fa fa-dot-circle-o"></i> View</button>
												<button type="button" class="btn btn-sm btn-danger" v-on:click="Delete(user.id_pengelola)" v-show="user.id_pengelola !== '1'">
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
	      	    <label class="col-md-6 col-form-label">NIP</label>
	      	    <div class="col-md-3">
	      	      <label class=" col-form-label"><b>{{User.nip}}</b></label>
	      	    </div>
	      	  </div>
	      	  <div class="form-group row">
	      	    <label class="col-md-6 col-form-label">User Name</label>
	      	    <div class="col-md-3">
	      	      <label class=" col-form-label"><b>{{User.username}}</b></label>
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
  	User:{},
  	Users:[],
  	FilterModel:{},
  	Form:{},
  },
  methods: {
   Save() 
   {
       axios
    	.post(locationServer+'/api/user/user',{
          body: this.User
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
   },
   GetData()
   {
      axios
    	.post(locationServer+'/api/User/getusers',{
    		body: this.Filter()
    	})
        .then(response => {
        	this.Users =  response.data;
        	this.Form = false;
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
   	this.User = {};
   },
   Filter()
   {
      var FilterParam = {};
      if(this.FilterModel.nip !== null && this.FilterModel.nip !== "" ){
        FilterParam.nip =this.FilterModel.nip;
      }
       if(this.FilterModel.username !== null && this.FilterModel.username !== "" ){
        FilterParam.username =this.FilterModel.username;
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
    	.get(locationServer+'/api/user/getdatauserbyid/'+Id)
        .then(response => {
        	this.User =  response.data;
        	this.Form = true;
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
   	   .get(locationServer+'/api/user/userdelete/'+Id)
        .then(response => {
        this.GetData();
        this.Form = false;
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
    	.get(locationServer+'/api/user/getdatauserbyid/'+Id)
        .then(response => {
        	this.User =  response.data;
        	this.Form = false;
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