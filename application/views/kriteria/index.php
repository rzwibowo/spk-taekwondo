<div class="row" id="main">
    <div class="col-md-12">
        <div class="card">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
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
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(kr, i) in kriterias">
                                        <td>{{ i+1 }}</td>
                                        <td>{{ kr.nama_kriteria }}</td>
                                        <td>{{ kr.min_max }}</td>
                                        <td>
                                            <button type="button" class="btn btn-default" @click="editKr(kr.id_kriteria)">Ubah</button>
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
			kriterias: [],
			kriteria: {
                id_kriteria: null,
				nama_kriteria: '',
				min_max: ''
			},
            isDisabled: true
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
            resetKr: function () {
                this.kriteria.id_kriteria = null;
                this.kriteria.nama_kriteria = '';
                this.kriteria.min_max = '';

                this.isDisabled = true;
            }
		}
	})
</script>
