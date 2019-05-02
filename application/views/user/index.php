<div class="row" id="main">
    <div class="col-md-12">
        <div class="card">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#input" role="tab">
                        <span class="hidden-sm-up"></span>
                        <span class="hidden-xs-down"><i class="mdi mdi-pencil"></i> Input</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#list" role="tab">
                        <span class="hidden-sm-up"></span>
                        <span class="hidden-xs-down"><i class="mdi mdi-format-list-bulleted"></i> List</span>
                    </a>
                </li>
            </ul>
            <!-- Tab panes -->
            <div class="tab-content tabcontent-border">
                <div class="tab-pane active" id="input" role="tabpanel">
                    <div class="col-md-6 offset-md-3">
                        <div class="card">
                            <form class="form-horizontal">
                                <div class="card-body">
                                    <h4 class="card-title text-center">Input Data <?php echo $title ?></h4>
                                    <div class="form-group row">
                                        <label for="i-nama" 
                                            class="col-sm-3 text-right control-label col-form-label">
                                            Username
                                        </label>
                                        <div class="col-sm-5">
                                            <input type="text" class="form-control" id="i-nama" placeholder="Nama Pengguna" v-model="user.username">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="i-psw"
                                            class="col-sm-3 text-right control-label col-form-label">
                                            Password
                                        </label>
                                        <div class="col-sm-5">
                                            <input type="password" class="form-control" id="i-psw" placeholder="Password Pengguna" v-model="user.password">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="i-lvl"
                                            class="col-sm-3 text-right control-label col-form-label">
                                            Level
                                        </label>
                                        <div class="col-sm-4">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" class="custom-control-input" name="level" 
                                                    value="admin" v-model="user.level" id="l-adm">
                                                <label class="custom-control-label" for="l-adm">Admin</label>
                                            </div>
                                            <div class="custom-control custom-radio">
                                                <input type="radio" class="custom-control-input" name="level" 
                                                    value="user" v-model="user.level" id="l-usr">
                                                <label class="custom-control-label" for="l-usr">User</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="border-top">
                                    <div class="card-body text-right">
                                        <button type="reset" class="btn" @click="resetUsr">Reset</button>
                                        <button type="button" class="btn btn-primary" @click="saveUsr">Simpan</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="list" role="tabpanel">
                    <div class="col-md-6 offset-md-3">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title text-center">Daftar <?php echo $title ?></h4>
                            </div>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama</th>
                                        <th>Level</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(usr, i) in users">
                                        <td>{{ i+1 }}</td>
                                        <td>{{ usr.username }}</td>
                                        <td>{{ usr.level }}</td>
                                        <td>
                                            <button type="button" class="btn btn-default" @click="editUsr(usr.id_user)">Ubah</button>
                                            <button type="button" class="btn btn-danger" @click="deleteUsr(usr.id_user)">Hapus</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo base_url() ?>assets/js/vue.js"></script>
<script src="<?php echo base_url() ?>assets/js/axios.min.js"></script>

<script>
    const main_script = new Vue({
        el: '#main',
        data: {
            users: [],
            user: {
                id_user: null,
                username: '',
                password: '',
                level: ''
            }
        },
        mounted: function() {
            this.getListUsr();
        },
        methods: {
            getListUsr: function () {
				axios.get(server_host + '/api/user/ambilUsr')
				.then(res => this.users = res.data)
				.catch(err => console.error(err));
			},
            saveUsr: function () {
                if (this.user.id_user) {
                    axios.put(server_host + '/api/user/updateUsr',
                        { 
                            body: this.user
                        })
                    .then(res => {
                        console.log(res);
                        toastr.success('Data disimpan', 'Berhasil');
                        this.resetUsr();
                        this.getListUsr();
                    })
                    .catch(err => console.error(err));
                } else {
                    axios.post(server_host + '/api/user/simpanUsr',
                        { 
                            body: this.user
                        })
                    .then(res => {
                        console.log(res);
                        toastr.success('Data disimpan', 'Berhasil');
                        this.resetUsr();
                        this.getListUsr();
                    })
                    .catch(err => console.error(err));
                }
			},
			editUsr: function (id) {
				axios.get(server_host+'/api/user/ambilUsrDenganId/'+id)
				.then(res => { 
                    this.user = res.data;
                    this.user.password = '';
                    $('a[href="#input"]').tab('show');
                })
				.catch(err => console.error(err));
			},
			deleteUsr: function (id) {
                const cnf = confirm('Hapus Data?');
				if (cnf) {
					axios.delete(server_host+'/api/user/hapusUsr/'+id)
					.then(res => {
						console.log(res);
                        toastr.success('Data dihapus', 'Berhasil');
						this.getListUsr();
					})
					.catch(err => console.error(err));
				}
			},
            resetUsr: function () {
                this.user.id_user = null;
                this.user.username = '';
                this.user.password = '' ;
                this.user.level = '';
            }
        },
        
    })
</script>