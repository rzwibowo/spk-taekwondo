		<div class="row" id="app" style="text-align: center;">
			<!-- BEGIN form input -->
			<div class="col-lg-12">
			  <div class="card">
			    <div class="card-header">
			     <h3>Login</h3>
			    </div>
			    <div class="card-body">
			      <form action="" method="post" class="form-horizontal">
			        <div class="form-group row">
			          <label class="col-md-3 col-form-label" for="nim">User Name</label>
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
			    <div class="card-footer">
			      <button type="submit" class="btn btn-sm btn-primary"  v-on:click="Login">
			        <i class="fa fa-dot-circle-o"></i> Login</button>
			    </div>
			  </div>
			</div>
			<!-- END form input -->
		</div>
   </div>
 </div>
 </main>
</body>
<script type="text/javascript">

var app = new Vue({
  el: '#app',
  data: {
  	User:{},
  },
  created() {
    this.Initialization()
  },
  methods: {
    Login() 
    {
    	axios
    	.post('http://localhost/spk-beasiswa/index.php/api/login/UserAutorization',{
    		body: this.User
    	})
        .then(response => {

        	console.log(response.data);
          if(response.data.length > 0){
          
          this.$cookies.set("tokenUserApp",response.data[0].nip,"60MIN");
          window.location.replace("http://localhost/spk-beasiswa/index.php"); 
         }
       })
       .catch(error => {
        console.log(error)
        this.errored = true
      })
      .finally(() => console.log())
   },
    GetCokies () {
      return this.$cookies.get("tokenUserApp");
    },
   Initialization()
   {
   	console.log(this.GetCokies());
	if(this.GetCokies() !== "" && this.GetCokies() !== null && this.GetCokies() !== "undefined"){
          window.location.replace("http://localhost/spk-beasiswa/index.php"); 
	      }else{
	        this.User = {
	            IdUser:0,
	            Username:"",
	            Password:"",
	      }
	    }
   },
  }
})
        
</script>