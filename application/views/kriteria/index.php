<div class="row" id="main">
    <div class="col-md-12">
        <div class="card">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item" :class="disabledClass">
                    <a class="nav-link" data-toggle="tab" href="#edit" role="tab">
                        <span class="hidden-sm-up"></span>
                        <span class="hidden-xs-down"><i class="mdi mdi-pencil"></i> Edit</span>
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
                <div class="tab-pane" id="edit" role="tabpanel">
                    <div class="col-md-6 offset-md-3">
                        <div class="card">
                            <form class="form-horizontal" @submit.prevent="saveKr">
                                <div class="card-body">
                                    <h4 class="card-title text-center">Input Data <?php echo $title ?></h4>
                                    <div class="form-group row">
                                        <label for="i-id" 
                                            class="col-sm-3 text-right control-label col-form-label">
                                            ID
                                        </label>
                                        <div class="col-sm-3">
                                            <input type="number" class="form-control" id="i-id"
												placeholder="ID" v-model="kriteria.id_kriteria"
                                                readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="i-nama" 
                                            class="col-sm-3 text-right control-label col-form-label">
                                            Nama Kriteria
                                        </label>
                                        <div class="col-sm-7">
                                            <input type="text" class="form-control" id="i-nama"
												placeholder="Nama Kriteria" v-model="kriteria.nama_kriteria">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="i-maxmin" 
                                            class="col-sm-3 text-right control-label col-form-label">
                                            Max/Min
                                        </label>
                                        <div class="col-sm-4">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" class="custom-control-input" name="max_min" 
                                                    value="max" v-model="kriteria.min_max" id="k-max">
                                                <label class="custom-control-label" for="k-max">Max</label>
                                            </div>
                                            <div class="custom-control custom-radio">
                                                <input type="radio" class="custom-control-input" name="max_min" 
                                                    value="min" v-model="kriteria.min_max" id="k-min">
                                                <label class="custom-control-label" for="k-min">Min</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="i-multi" 
                                            class="col-sm-3 text-right control-label col-form-label">
                                            Multi Nilai
                                        </label>
                                        <div class="col-sm-4">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" class="custom-control-input" name="multi" 
                                                    value="1" v-model="kriteria.is_multi" id="k-mya">
                                                <label class="custom-control-label" for="k-mya">Ya</label>
                                            </div>
                                            <div class="custom-control custom-radio">
                                                <input type="radio" class="custom-control-input" name="multi" 
                                                    value="0" v-model="kriteria.is_multi" id="k-mtdk">
                                                <label class="custom-control-label" for="k-mtdk">Tidak</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row sub-input">
                                        <label class="col-sm-12 control-label col-form-label">Subkriteria</label>
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Rating</th>
                                                    <th>Keterangan Subkriteria</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr v-for="subk in kriteria.subkriteria">
                                                    <td>
                                                        <select class="form-control" v-model="subk.bobot_kriteria">
                                                            <option v-for="rtg in 5" :value="rtg">{{ rtg }}</option>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control" v-model="subk.nama_sub">
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="border-top">
                                    <div class="card-body text-right">
                                        <button type="reset" class="btn" @click="resetKr">Reset</button>
                                        <button type="button" class="btn btn-primary" @click="saveKr" :disabled="isDisabled">Simpan</button>
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
                                        <th>Min/Max</th>
                                        <th>Multi Nilai</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(kr, i) in kriterias">
                                        <td>{{ i+1 }}</td>
                                        <td>{{ kr.nama_kriteria }}</td>
                                        <td>{{ kr.min_max }}</td>
                                        <td>{{ kr.is_multi === "1" ? "Ya" : "Tidak" }}</td>
                                        <td>
                                            <button type="button" class="btn btn-default" 
                                                @click="lihatSub(kr.id_kriteria)">Lihat Subkriteria</button>
                                            <button type="button" class="btn btn-default" :class="disabledClass"
                                                @click="editKr(kr.id_kriteria)">Ubah</button>
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

    <div class="modal fade" id="Modal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true ">
        <div class="modal-dialog" role="document ">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Subkriteria dari {{ subkriteria_det[0] }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true ">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Rating</th>
                                    <th>Nama Subkriteria</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="sub in subkriteria_det[1]">
                                    <td>{{ sub.bobot_kriteria }}</td>
                                    <td>{{ sub.nama_sub }}</td>
                                </tr>
                            </tbody>
                        </table>
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
			kriterias: [],
			kriteria: {
                id_kriteria: null,
				nama_kriteria: '',
				min_max: '',
                is_multi: '',
                subkriteria: []
			},
            subkriteria_det: [],
            isDisabled: true,
            disabledClass: 'disabled-link'
		},
        created: function() {
            this.checkLevel();
        },
		mounted: function() {
			this.getListKr();
		},
		methods: {
			getListKr: function () {
				axios.get(server_host + '/api/Kriteria/ambilKrt')
				.then(res => this.kriterias = res.data)
				.catch(err => console.error(err));
			},
			saveKr: function () {
                axios.put(server_host + '/api/Kriteria/updateKrt',
                    { 
                        body: this.kriteria
                    })
                .then(res => {
                    console.log(res);
                    toastr.success('Data disimpan', 'Berhasil');
                    this.resetKr();
                    this.getListKr();
                })
                .catch(err => console.error(err));
			},
			editKr: function (id) {
				axios.get(server_host+'/api/Kriteria/ambilKrtDenganId/'+id)
				.then(res => { 
                    this.kriteria = res.data;
                    $('a[href="#edit"]').tab('show');

                    this.isDisabled = false;
                })
				.catch(err => console.error(err));
			},
            lihatSub: function (id) {
				axios.get(server_host+'/api/Kriteria/ambilKrtDenganId/'+id)
				.then(res => { 
                    this.subkriteria_det = [];

                    this.subkriteria_det.push(res.data.nama_kriteria);
                    this.subkriteria_det.push(res.data.subkriteria);

                    $('#Modal1').modal('show');
                })
				.catch(err => console.error(err));
			},
            resetKr: function () {
                this.kriteria.id_kriteria = null;
                this.kriteria.nama_kriteria = '';
                this.kriteria.min_max = '';
                this.kriteria.is_multi = '';
                this.kriteria.subkriteria = [];

                this.isDisabled = true;
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
