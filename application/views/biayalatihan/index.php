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
                                            <select name="id_tempat_latihan" class="form-control" v-model="biaya.id_tempat_latihan">
                                                <option v-for="(tl, i) in tempatlatihans"
                                                    :value="tl.id_tempat_latihan">
                                                    {{ tl.nama }}
                                                    </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="i-biaya"
                                            class="col-sm-3 text-right control-label col-form-label">
                                            Biaya Latihan
                                        </label>
                                        <div class="col-sm-5">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Rp</span>
                                                </div>
                                                <input type="number" class="form-control" id="i-biaya"
                                                    placeholder="######" v-model="biaya.nilai">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="border-top">
                                    <div class="card-body text-right">
                                        <button type="reset" class="btn" @click="resetBya">Reset</button>
                                        <button type="button" class="btn btn-primary" @click="saveBya">Simpan</button>
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
                                        <th>Biaya Latihan</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(bya, i) in biayas">
                                        <td>{{ i+1 }}</td>
                                        <td>{{ bya.nama }}</td>
                                        <td>{{ bya.nilai }}</td>
                                        <td>
                                            <button type="button" class="btn btn-default" @click="editBya(bya.id_detail_kriteria)">Ubah</button>
                                            <button type="button" class="btn btn-danger" @click="deleteBya(bya.id_detail_kriteria)">Hapus</button>
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
            biayas: [],
            biaya: {
                id_detail_kriteria: null,
                id_tempat_latihan: null,
                id_kriteria: 2,
                nilai: 0
            },
            tempatlatihans: []
        },
        mounted: function() {
            this.getListTl();
            this.getListBya();
        },
        methods: {
            getListTl: function () {
				axios.get(server_host + '/api/tempatlatihan/ambilTl')
				.then(res => this.tempatlatihans = res.data)
				.catch(err => console.error(err));
			},
            getListBya: function () {
				axios.get(server_host + '/api/biayalatihan/ambilBya')
				.then(res => this.biayas = res.data)
				.catch(err => console.error(err));
			},
            saveBya: function () {
                if (this.biaya.id_detail_kriteria) {
                    axios.put(server_host + '/api/biayalatihan/updateBya',
                        { 
                            body: this.biaya
                        })
                    .then(res => {
                        console.log(res);
                        toastr.success('Data disimpan', 'Berhasil');
                        this.resetBya();
                        this.getListBya();
                    })
                    .catch(err => console.error(err));
                } else {
                    axios.post(server_host + '/api/biayalatihan/simpanBya',
                        { 
                            body: this.biaya
                        })
                    .then(res => {
                        console.log(res);
                        toastr.success('Data disimpan', 'Berhasil');
                        this.resetBya();
                        this.getListBya();
                    })
                    .catch(err => console.error(err));
                }
			},
			editBya: function (id) {
				axios.get(server_host+'/api/biayalatihan/ambilByaDenganId/'+id)
				.then(res => { 
                    this.biaya = res.data;
                    $('a[href="#input"]').tab('show');
                })
				.catch(err => console.error(err));
			},
			deleteBya: function (id) {
				const cnf = confirm('Hapus Data?');
				if (cnf) {
					axios.delete(server_host+'/api/biayalatihan/hapusBya/'+id)
					.then(res => {
						console.log(res);
                        toastr.success('Data dihapus', 'Berhasil');
						this.getListBya();
					})
					.catch(err => console.error(err));
				}
			},
            resetBya: function () {
                this.biaya.id_detail_kriteria = null;
                this.biaya.id_tempat_latihan = null;
                this.biaya.id_kriteria = 2;
                this.biaya.nilai = 0;
            }
        },
        
    })
</script>