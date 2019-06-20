
<!DOCTYPE html>
<html dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url() ?>assets/images/favicon.png">
		<title>Login</title>
		<!-- Custom CSS -->
		<link href="<?php echo base_url() ?>assets/css/style.min.css" rel="stylesheet">
		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body>
    <div class="main-wrapper">
        <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
        <div id="spin">
            <div class="preloader" v-show="isLoading">
                <div class="lds-ripple">
                    <div class="lds-pos"></div>
                    <div class="lds-pos"></div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Login box.scss -->
        <!-- ============================================================== -->
        <div class="auth-wrapper d-flex no-block justify-content-center align-items-center bg-dark">
            <div class="auth-box bg-dark border-top border-secondary">
                <div id="loginform">
                    <div class="text-center p-t-20 p-b-20">
												<span class="db"><img src="<?php echo base_url() ?>assets/images/logo-text.png" alt="logo" /></span>
                    </div>
                    <!-- Form -->
                    <form class="form-horizontal m-t-20" @submit.prevent="login">
                        <div class="row p-b-30">
                            <div class="col-12">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-success text-white" id="basic-addon1"><i class="ti-user"></i></span>
                                    </div>
                                    <input type="text" class="form-control form-control-lg" placeholder="Username"
                                        aria-label="Username" aria-describedby="basic-addon1" required=""
                                        v-model="user.username">
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-warning text-white" id="basic-addon2"><i class="ti-pencil"></i></span>
                                    </div>
                                    <input type="password" class="form-control form-control-lg" placeholder="Password"
                                        aria-label="Password" aria-describedby="basic-addon1" required=""
                                        v-model="user.password">
                                </div>
                            </div>
                        </div>
                        <div class="row border-top border-secondary">
                            <div class="col-12">
                                <div class="form-group">
                                    <div class="p-t-20">
                                        <button class="btn btn-success float-right" type="submit">Login</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- Login box.scss -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper scss in scafholding.scss -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper scss in scafholding.scss -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Right Sidebar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Right Sidebar -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- All Required js -->
    <!-- ============================================================== -->
    <script src="<?php echo base_url() ?>assets/libs/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="<?php echo base_url() ?>assets/libs/popper.js/dist/umd/popper.min.js"></script>
    <script src="<?php echo base_url() ?>assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>

    <script src="<?php echo base_url() ?>assets/js/vue.js"></script>
    <script src="<?php echo base_url() ?>assets/js/axios.min.js"></script>

    <script type="text/javascript">
        const server_host = "<?php echo site_url() ?>";

        const store = {
            state: {
                isLoading: true
            },
            setLoadingState (loadingState) {
                this.state.isLoading = loadingState;
            },
            getLoadingState () {
                return this.state.isLoading;
            } 
        }

        const loading_control = new Vue({
            el: '#spin',
            data: {
                isLoading: true
            },
            created: function() {
                this.getLoadingState();
            },
            methods: {
                getLoadingState: function () {
                    this.isLoading = store.getLoadingState();
                }
            }
        })

        const main_script = new Vue({
            el: '#loginform',
            data: {
                user: {
                    username: '',
                    password: ''
                },
                chkdt: null
            },
            created: function () {
                this.checkAuth();
            },
            methods: {
                checkAuth: function () {
                    this.chkdt = JSON.parse(sessionStorage.getItem('auth_spk_tkwd'));
                    if (this.chkdt !== null) {
                        if (this.chkdt.token) {
                            window.location.assign(server_host);
                        }
                    }
                    
                    store.setLoadingState(false);
                    loading_control.getLoadingState();
                },
                login: function() {
                    //window.location.assign(server_host); 
                    axios.post(server_host + '/api/User/Login',
                            { 
                                    body: this.user
                            })
                    .then(res => {
                            console.log(res);
                            const udt = res.data[0];
                            udt.token = new Date().getTime().toString();
                            sessionStorage.setItem('auth_spk_tkwd', JSON.stringify(udt));
                            window.location.assign(server_host); 
                    })
                    .catch(err => {
                        alert("error "+err);
                        console.error(err);
                    });
                }
            }
        });
                    
    </script>

</body>

</html>
   