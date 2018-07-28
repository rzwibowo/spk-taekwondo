		<div class="row" id="app">
			<!-- BEGIN form input -->
			<div class="col-lg-12">
			  <div class="card" style="width: 25rem">
			    <div class="card-header text-center">
			     <h3>Login</h3>
			    </div>
			    <div class="card-body">
			      <form action="" method="post" class="form-horizontal">
			        <div class="form-group row">
			          <label class="col-md-4 col-form-label" for="nim">User Name</label>
			          <div class="col-md-8">
			            <input type="text" id="username" name="username" v-model="User.username" class="form-control" placeholder="User Name">
			          </div>
			        </div>
			        <div class="form-group row">
			          <label class="col-md-4 col-form-label" for="nim">Password</label>
			          <div class="col-md-8">
			            <input type="password" id="password" name="password" v-model="User.password" class="form-control" placeholder="Password">
			          </div>
			        </div>
			       </form>
			    </div>
			    <div class="card-footer">
			      <button type="submit" class="btn btn-sm btn-primary pull-right" v-on:click="Login">
							<i class="fa fa-dot-circle-o"></i> Login
						</button>
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
    Login() {
    	axios
    	.post('<?php echo site_url() ?>/api/login/UserAutorization',{
    		body: this.User
    	})
			.then(response => {

				console.log(response.data);
				if(response.data.length > 0){ 
                  this.$cookies.set("tokenUserApp",response.data[0].nip,60 * 60 * 1);
				  window.location.replace("<?php echo site_url() ?>"); 
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
		Initialization() {
			console.log(this.GetCokies());
			if(this.GetCokies() !== "" && this.GetCokies() !== null && this.GetCokies() !== "undefined"){
			 	window.location.replace("<?php echo site_url() ?>"); 
			} else {
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