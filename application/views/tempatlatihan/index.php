<div class="row" id="main">
    <div class="col-md-12">
        <div class="card">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item" :class="disabledClass">
                    <a class="nav-link" data-toggle="tab" href="#input" role="tab">
                        <span class="hidden-sm-up"></span>
                        <span class="hidden-xs-down"><i class="mdi mdi-pencil"></i> Input</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#list" role="tab">
                        <span class="hidden-sm-up"></span>
                        <span class="hidden-xs-down"><i class="mdi mdi-format-list-bulleted"></i> List</span>
                    </a>
                </li>
            </ul>
            <!-- Tab panes -->
            <div class="tab-content tabcontent-border">
                <div class="tab-pane" id="input" role="tabpanel">
                    <div class="col-md-6 offset-md-3">
                        <div class="card">
                            <form class="form-horizontal" @submit.prevent="saveTl">
                                <div class="card-body">
                                    <h4 class="card-title text-center">Input Data <?php echo $title ?></h4>
                                    <div class="form-group row">
                                        <label for="i-id" 
                                            class="col-sm-3 text-right control-label col-form-label">
                                            ID
                                        </label>
                                        <div class="col-sm-3">
                                            <input type="number" class="form-control" id="i-id"
												placeholder="BARU" v-model="tempatlatihan.id_tempat_latihan"
                                                readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="i-nama" 
                                            class="col-sm-3 text-right control-label col-form-label">
                                            Nama
                                        </label>
                                        <div class="col-sm-7">
                                            <input type="text" class="form-control" id="i-nama"
												placeholder="Nama Tempat Latihan" v-model="tempatlatihan.nama">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="i-alamat"
                                            class="col-sm-3 text-right control-label col-form-label">
                                            Alamat
                                        </label>
                                        <div class="col-sm-9">
                                            <textarea id="i-alamat" class="form-control"
												placeholder="Alamat Tempat Latihan" v-model="tempatlatihan.alamat"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="i-lat"
                                            class="col-sm-3 text-right control-label col-form-label">
                                            Latitude
                                        </label>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" id="i-lat"
												placeholder="##.####" v-model="tempatlatihan.latitude">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="i-lng"
                                            class="col-sm-3 text-right control-label col-form-label">
                                            Longitude
                                        </label>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" id="i-lng"
												placeholder="##.####" v-model="tempatlatihan.longitude">
                                        </div>
                                    </div>
                                </div>
                                <div class="border-top">
                                    <div class="card-body text-right">
                                        <button type="reset" class="btn" @click="resetTl">Reset</button>
                                        <button type="button" class="btn btn-primary" @click="saveTl">Simpan</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="tab-pane active" id="list" role="tabpanel">
                    <div class="col-md-8 offset-md-2">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title text-center">Daftar <?php echo $title ?></h4>
                            </div>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama</th>
                                        <th>Alamat</th>
                                        <th>Latitude</th>
                                        <th>Longitude</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(tl, i) in tempatlatihans">
                                        <td>{{ i+1 }}</td>
                                        <td>{{ tl.nama }}</td>
                                        <td>{{ tl.alamat }}</td>
                                        <td>{{ tl.latitude }}</td>
                                        <td>{{ tl.longitude }}</td>
                                        <td>
                                            <button type="button" class="btn btn-default" :class="disabledClass"
                                                @click="editTl(tl.id_tempat_latihan)">Ubah</button>
                                            <button type="button" class="btn btn-danger" :class="disabledClass"
                                                @click="deleteTl(tl.id_tempat_latihan)">Hapus</button>
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
			tempatlatihans: [],
			tempatlatihan: {
                id_tempat_latihan: null,
				nama: '',
				alamat: '',
				latitude: 0,
				longitude: 0
			},
            disabledClass: 'disabled-link'
		},
        created: function() {
            this.checkLevel();
        },
		mounted: function() {
			this.getListTl();
		},
		methods: {
			getListTl: function () {
				axios.get(server_host + '/api/tempatlatihan/ambilTl')
				.then(res => this.tempatlatihans = res.data)
				.catch(err => console.error(err));
			},
			saveTl: function () {
                if (this.tempatlatihan.id_tempat_latihan) {
                    axios.put(server_host + '/api/tempatlatihan/updateTl',
                        { 
                            body: this.tempatlatihan
                        })
                    .then(res => {
                        console.log(res);
                        toastr.success('Data disimpan', 'Berhasil');
                        this.resetTl();
                        this.getListTl();
                    })
                    .catch(err => console.error(err));
                } else {
                    axios.post(server_host + '/api/tempatlatihan/simpanTl',
                        { 
                            body: this.tempatlatihan
                        })
                    .then(res => {
                        console.log(res);
                        toastr.success('Data disimpan', 'Berhasil');
                        this.resetTl();
                        this.getListTl();
                    })
                    .catch(err => console.error(err));
                }
			},
			editTl: function (id) {
				axios.get(server_host+'/api/tempatlatihan/ambilTlDenganId/'+id)
				.then(res => { 
                    this.tempatlatihan = res.data;
                    $('a[href="#input"]').tab('show');
                })
				.catch(err => console.error(err));
			},
			deleteTl: function (id) {
				const cnf = confirm('Hapus Data?');
				if (cnf) {
					axios.delete(server_host+'/api/tempatlatihan/hapusTl/'+id)
					.then(res => {
						console.log(res);
                        toastr.success('Data dihapus', 'Berhasil');
						this.getListTl();
					})
					.catch(err => console.error(err));
				}
			},
            resetTl: function () {
                this.tempatlatihan.id_tempat_latihan = null;
                this.tempatlatihan.nama = '';
                this.tempatlatihan.alamat = '';
                this.tempatlatihan.latitude = 0;
                this.tempatlatihan.longitude = 0;
            },
            checkLevel: function () {
                const level = JSON.parse(sessionStorage.getItem('auth_spk_tkwd')).level;
                if (level === 'user') {
                    this.disabledClass = 'disabled-link';
                } else {
                    this.disabledClass = '';
                }
            }
		}
	})
</script>
