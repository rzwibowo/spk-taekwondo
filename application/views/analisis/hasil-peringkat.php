<div class="row" id="main">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title text-center">Hasil Pemeringkatan {{ tgl_peringkat }}</h4>
            </div>

            <div class="card-body">
                <h4 class="card-title m-b-0">Tabel Hasil Peringkat</h4>
                <div class="row">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>Peringkat</th>
                                <th>Tempat Latihan</th>
                                <th>Jumlah Nilai</th>
                                <th>Lokasi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <template v-if="peringkat.length > 0">
                                <tr v-for="hprg in peringkat">
                                    <td>{{ hprg.peringkat }}</td>
                                    <td>{{ hprg.nama }}</td>
                                    <td>{{ hprg.jumlah_nilai }}</td>
                                    <td>
                                        <a :href="'https://www.google.com/maps/search/?api=1&query=' + hprg.latitude + ',' + hprg.longitude" target="_blank">
                                            {{ hprg.latitude }}, {{ hprg.longitude }}
                                        </a>
                                    </td>
                                </tr>
                            </template>
                            <template v-else>
                                <tr>
                                    <td colspan="4" class="text-center" 
                                        style="height: 5em; vertical-align: middle;">
                                        Tidak ada hasil peringkat hari ini.
                                        Coba <a href="javascript:void(0)" @click="getLatestPeringkat">
                                            muat ulang data
                                        </a>
                                        atau <a href="javascript:void(0)" @click="getListPeringkat">
                                            pilih hasil peringkat tanggal lain</a>.
                                    </td>
                                </tr>
                            </template>
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col text-right">
                        <button type="button" class="btn btn-primary" @click="getLatestPeringkat">Refresh Hasil
                            Peringkat Hari Ini</button>
                        <button type="button" class="btn btn-primary" @click="getListPeringkat">Pilih Hasil
                            Peringkat</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="Modal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true ">
        <div class="modal-dialog" role="document ">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Pilih Hasil Peringkat</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true ">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Tanggal Input</th>
                                    <th>User</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="prg in peringkats">
                                    <td>{{ prg.tanggal }}</td>
                                    <td>{{ prg.username }}</td>
                                    <td>
                                        <button type="button" class="btn btn-default" @click="getPeringkat(prg.id_peringkat, prg.tanggal)">Ambil Hasil Peringkat
                                        </button>
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

<script src="<?php echo base_url() ?>assets/js/vue.js"></script>
<script src="<?php echo base_url() ?>assets/js/axios.min.js"></script>

<script>
    const main_script = new Vue({
        el: '#main',
        data: {
            peringkats: [],
            peringkat: [],
            tgl_peringkat: ''
        },
        mounted: function () {
            this.getLatestPeringkat();
        },
        methods: {
            getLatestPeringkat: function () {
                const hari_ini = new Date();
                this.tgl_peringkat = hari_ini.getFullYear() + '-' + 
                    String(hari_ini.getMonth() + 1).padStart(2, '0') + '-' + 
                    String(hari_ini.getDate()).padStart(2, '0');

                axios.get(server_host + '/api/Analisa/ambilPeringkatHariIni')
                    .then(res => this.peringkat = res.data)
                    .catch(err => {
                        console.error(err);
                        toastr.warning('Belum ada data terbaru', 'Kosong');
                    });
            },
            getListPeringkat: function () {
                this.peringkats = [];
                axios.get(server_host + '/api/analisa/ambilListPeringkat')
					.then(res => {
						this.peringkats = res.data;
						$('#Modal1').modal('show');
					})
					.catch(err => console.error(err));
            },
            getPeringkat: function (id_peringkat, tanggal) {
                this.peringkat = [];
                this.tgl_peringkat = tanggal;

				axios.get(server_host + '/api/analisa/ambilPeringkatDenganId/' + id_peringkat)
					.then(res => {
						this.peringkat = res.data;
						$('#Modal1').modal('hide');
					})
					.catch(err => console.error(err));
            }
        }
    })
</script>