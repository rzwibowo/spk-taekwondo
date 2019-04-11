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
                                            Nama Tempat Latihan
                                        </label>
                                        <div class="col-sm-7">
                                        <select name="id_tempat_latihan" class="form-control" v-model="jarak.id_tempat_latihan">
                                                <option v-for="(tl, i) in tempatlatihans"
                                                    :value="tl.id_tempat_latihan">
                                                    {{ tl.nama }}
                                                    </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="i-jarak"
                                            class="col-sm-3 text-right control-label col-form-label">
                                            Jarak
                                        </label>
                                        <div class="col-sm-4">
                                            <div class="input-group">
                                                <input type="number" class="form-control" id="i-jarak"
                                                    placeholder="###" v-model="jarak.nilai">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">km</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="border-top">
                                    <div class="card-body text-right">
                                    <button type="reset" class="btn" @click="resetJrk">Reset</button>
                                        <button type="button" class="btn btn-primary" @click="saveJrk">Simpan</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="list" role="tabpanel">
                    <div class="col-md-8 offset-md-2">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title text-center">Daftar <?php echo $title ?></h4>
                            </div>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama Tempat Latihan</th>
                                        <th>Jarak</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(jrk, i) in jaraks">
                                        <td>{{ i+1 }}</td>
                                        <td>{{ jrk.nama }}</td>
                                        <td>{{ jrk.nilai }} km</td>
                                        <td>
                                            <button type="button" class="btn btn-default" @click="editJrk(jrk.id_detail_kriteria)">Ubah</button>
                                            <button type="button" class="btn btn-danger" @click="deleteJrk(jrk.id_detail_kriteria)">Hapus</button>
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
            jaraks: [],
            jarak: {
                id_detail_kriteria: null,
                id_tempat_latihan: null,
                id_kriteria: 3,
                nilai: 0
            },
            tempatlatihans: []
        },
        mounted: function() {
            this.getListTl();
            this.getListJrk();
        },
        methods: {
            getListTl: function () {
				axios.get(server_host + '/api/tempatlatihan/ambilTl')
				.then(res => this.tempatlatihans = res.data)
				.catch(err => console.error(err));
			},
            getListJrk: function () {
				axios.get(server_host + '/api/jarak/ambilJrk')
				.then(res => this.jaraks = res.data)
				.catch(err => console.error(err));
			},
            saveJrk: function () {
                if (this.jarak.id_detail_kriteria) {
                    axios.put(server_host + '/api/jarak/updateJrk',
                        { 
                            body: this.jarak
                        })
                    .then(res => {
                        console.log(res);
                        toastr.success('Data disimpan', 'Berhasil');
                        this.resetJrk();
                        this.getListJrk();
                    })
                    .catch(err => console.error(err));
                } else {
                    axios.post(server_host + '/api/jarak/simpanJrk',
                        { 
                            body: this.jarak
                        })
                    .then(res => {
                        console.log(res);
                        toastr.success('Data disimpan', 'Berhasil');
                        this.resetJrk();
                        this.getListJrk();
                    })
                    .catch(err => console.error(err));
                }
			},
			editJrk: function (id) {
				axios.get(server_host+'/api/jarak/ambilJrkDenganId/'+id)
				.then(res => { 
                    this.jarak = res.data;
                    $('a[href="#input"]').tab('show');
                })
				.catch(err => console.error(err));
			},
			deleteJrk: function (id) {
				const cnf = confirm('Hapus Data?');
				if (cnf) {
					axios.delete(server_host+'/api/jarak/hapusJrk/'+id)
					.then(res => {
						console.log(res);
                        toastr.success('Data dihapus', 'Berhasil');
						this.getListJrk();
					})
					.catch(err => console.error(err));
				}
			},
            resetJrk: function () {
                this.jarak.id_detail_kriteria = null;
                this.jarak.id_tempat_latihan = null;
                this.jarak.id_kriteria = 3;
                this.jarak.nilai = 0;
            }
        },
        
    })
</script>