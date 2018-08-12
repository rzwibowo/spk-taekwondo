<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/cetak-laporan.css">
<div class="row" id="app">
	<div class="col-md-12">
		<div class="card">
			<div class="card-body">
				<h3><?php echo $title ?></h3>
			</div>
		</div>
	</div>
	<div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="text-left">
                            <label class="col-md-4">Pilih Tahun Angkatan:</label>
                            <div class="col-md-4">
                                <select class="form-control" v-model="tahun_angkatan_selected">
                                    <option value=""> - </option>
                                    <option v-for="(thn, idx) in tahun_angkatan"
                                        :key="idx"
                                        :value="thn.id_tahun_angkatan">
                                        {{ thn.tahun_angkatan }}
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="text-right" v-show="tahun_angkatan_selected != ''">
                            <button type="button"
                                class="btn btn-info"
                                @click="getCalonBeasiswa(tahun_angkatan_selected)"
                                :class="tipe_laporan === 'calon' ? 'active' : ''">
                                <i class="icon-paper-clip"></i>
                                Daftar Calon Penerima Beasiswa
                            </button>
                            <button type="button"
                                class="btn btn-info"
                                @click="getPenerimaBeasiswa(tahun_angkatan_selected)"
                                :class="tipe_laporan === 'penerima' ? 'active' : ''">
                                <i class="icon-paper-clip"></i>
                                Laporan Penerima Beasiswa
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card laporan-preview" v-if="tahun_angkatan_selected != '' && tipe_laporan === 'calon'">
                    <div class="card-header">
                        <strong>Daftar Calon Penerima Beasiswa</strong>
                    </div>
                    <div class="card-body">
                        <div class="laporan" id="laporan-calon">
                            <div class="__head align-center">
                                <h4>Daftar Calon Penerima Beasiswa Tahun Angkatan {{ tahun_angkatan_selected_ }}</h4>
                                <h3>PEMERINTAH KABUPATEN MAPPI</h3>
                                <h3>DINAS PENDIDIKAN DAN PENGAJARAN</h3>
                                <h5>Jl. Poros Agham Km. 05, Kec. Obaa Kepi, Kab. Mappi</h5>
                            </div>
                            <div class="__line"></div>
                            <div>
                                <table class="__table">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th colspan="5">Mahasiswa</th>
                                        </tr>
                                    </thead>
                                    <tbody is="table-body"
                                        v-for="(mhs, idx) in mahasiswa"
                                        :key="idx"
                                        :nomer="idx + 1"
                                        :nama="mhs.nama | capitalize"
                                        :nim="mhs.nim"
                                        :tahunangkatan="mhs.tahun_angkatan"
                                        :jeniskelamin="mhs.jenis_kelamin | capitalize"
                                        :tempatlahir="mhs.tempat_lahir | capitalize"
                                        :tgllahir="mhs.tgl_lahir | formatDate"
                                        :alamat="mhs.alamat"
                                        :ipk="mhs.ipk"
                                        :kendaraan="mhs.kendaraan"
                                        :pkjorangtua="mhs.pkj_orangtua"
                                        :pghorangtua="mhs.pgh_orangtua"
                                        :jmltanggungan="mhs.jml_tanggungan">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <button type="button"
                            class="btn btn-success"
                            onclick="printJS({printable: 'laporan-calon',
                                type: 'html',
                                css: '<?php echo base_url() ?>assets/css/cetak-laporan.css'})">
                            <i class="icon-printer"></i>
                            Cetak
                        </button>
                    </div>
                </div>
                <div class="card laporan-preview" v-if="tahun_angkatan_selected != '' && tipe_laporan === 'penerima'">
                    <div class="card-header">
                        <strong>Laporan Penerima Beasiswa</strong>
                    </div>
                    <div class="card-body">
                        <div class="laporan" id="laporan-penerima">
                            <div class="__head align-center">
                                <h4>Laporan Penerima Beasiswa Tahun Angkatan {{ tahun_angkatan_selected_ }}</h4>
                                <h3>PEMERINTAH KABUPATEN MAPPI</h3>
                                <h3>DINAS PENDIDIKAN DAN PENGAJARAN</h3>
                                <h5>Jl. Poros Agham Km. 05, Kec. Obaa Kepi, Kab. Mappi</h5>
                            </div>
                            <div class="__line"></div>
                            <div>
                                <table class="__table">
                                    <thead>
                                        <tr>
                                            <th>Peringkat</th>
                                            <th colspan="5">Mahasiswa</th>
                                        </tr>
                                    </thead>
                                    <tbody is="table-body"
                                        v-for="(mhs, idx) in mahasiswa"
                                        :key="idx"
                                        :nomer="mhs.peringkat"
                                        :nama="mhs.nama | capitalize"
                                        :nim="mhs.nim"
                                        :tahunangkatan="mhs.tahun_angkatan"
                                        :jeniskelamin="mhs.jenis_kelamin | capitalize"
                                        :tempatlahir="mhs.tempat_lahir | capitalize"
                                        :tgllahir="mhs.tgl_lahir | formatDate"
                                        :alamat="mhs.alamat"
                                        :ipk="mhs.ipk"
                                        :kendaraan="mhs.kendaraan"
                                        :pkjorangtua="mhs.pkj_orangtua"
                                        :pghorangtua="mhs.pgh_orangtua"
                                        :jmltanggungan="mhs.jml_tanggungan">
                                    </tbody>
                                </table>
                            </div>
                            <div class="__foot">
                                <div class="__signature align-left">
                                    <p>Mappi, {{ new Date() | formatDate }}</p>
                                    <p>Kepala Dinas</p>
                                    <p class="__space"></p>
                                    <p>NIP.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <button type="button"
                            class="btn btn-success"
                            onclick="printJS({printable: 'laporan-penerima',
                                type: 'html',
                                css: '<?php echo base_url() ?>assets/css/cetak-laporan.css'})">
                            <i class="icon-printer"></i>
                            Cetak
                        </button>
                    </div>
                </div>
            </div>
        </div>
	</div>
</div>
<script src="https://printjs-4de6.kxcdn.com/print.min.js"></script>
<script type="text/javascript">
let TableBody = {
    props: ['nomer', 'nama', 'nim', 'tahunangkatan', 'jeniskelamin',
            'tempatlahir', 'tgllahir', 'alamat', 'ipk', 'kendaraan',
            'pkjorangtua', 'pghorangtua', 'jmltanggungan'],
    template: `<tbody>
            <tr>
                <td rowspan="9">{{ nomer }}.</td>
                <td colspan="5"><b>{{ nama }}</b></td>
            </tr>
            <tr>
                <td>NIM: </td>
                <td colspan="4">{{ nim }}</td>
            </tr>
            <tr>
                <td>Tahun Angkatan: </td>
                <td colspan="4">{{ tahunangkatan }}</td>
            </tr>
            <tr>
                <td>Jenis Kelamin: </td>
                <td colspan="4">{{ jeniskelamin }}</td>
            </tr>
            <tr>
                <td>Tempat, Tanggal Lahir: </td>
                <td colspan="4">{{ tempatlahir }}, {{ tgllahir }}</td>
            </tr>
            <tr>
                <td>Alamat: </td>
                <td colspan="4">{{ alamat }}</td>
            </tr>
            <tr>
                <td colspan="5">Keterangan: </td>
            </tr>
            <tr class="inner-head">
                <td class="align-center">IPK</td>
                <td class="align-center">Kendaraan</td>
                <td class="align-center">Pekerjaan Orang Tua</td>
                <td class="align-center">Penghasilan Orang Tua</td>
                <td class="align-center">Jumlah Tanggungan Orang Tua</td>
            </tr>
            <tr>
                <td class="align-right">{{ ipk }}</td>
                <td>{{ kendaraan }}</td>
                <td>{{ pkjorangtua }}</td>
                <td class="align-right">{{ pghorangtua }}</td>
                <td class="align-right">{{ jmltanggungan }}</td>
            </tr>
        </tbody>`
}

var app = new Vue({
    el: '#app',
    data: {
        tahun_angkatan: [],
        mahasiswa: [],
        tahun_angkatan_selected: '',
        tipe_laporan: ''
    },
    components: {
        'table-body': TableBody
    },
    filters: {
        formatDate: function (date) {
            const month_name = ['Januari', 'Fenruari', 'Maret', 'April',
                'Mei', 'Juni', 'Juli', 'Agustus',
                'September', 'Oktober', 'November', 'Desember']
            
            let date_ = new Date(date)
            
            let day = date_.getDate()
            let month = month_name[date_.getMonth()]
            let year = date_.getFullYear()

            return `${day} ${month} ${year}`
        },
        capitalize: function (value) {
            if (!value) return ''
            value = value.toString()
            return value.charAt(0).toUpperCase() + value.slice(1)
        }
    },
    created() {
        this.getTahunAngkatan()
    },
    computed: {
        tahun_angkatan_selected_: function() {
            if (this.mahasiswa.length > 1) {
                const tahun = this.tahun_angkatan.filter( thn =>
                    thn.id_tahun_angkatan === this.tahun_angkatan_selected
                )
                return tahun[0].tahun_angkatan
            }
        }
    },
    methods: {
        getTahunAngkatan() {
			axios.get(locationServer+'/api/tahunangkatan/tahunangkatans')
			.then(response => {
				this.tahun_angkatan =  response.data;
			})
			.catch(error => {
				console.log(error)
			})
		},
        getCalonBeasiswa: function (id_thn) {
            axios.get(locationServer+'/api/mahasiswa/getmahasiswawithtahunangkatan/'+id_thn)
                .then(response => {
                    this.mahasiswa =  response.data
                    this.tipe_laporan = 'calon'
                })
                .catch(error => {
                    console.error(error)
                    this.errored = true
                })
                .finally(() => this.loading = false)
        },
        getPenerimaBeasiswa: function (id_thn) {
            axios.get(locationServer+'/api/beasiswa/GetBeasiswaByTahunAngkatan/'+id_thn)
                .then(response => {
                    this.mahasiswa =  response.data
                    this.tipe_laporan = 'penerima'
                })
                .catch(error => {
                    console.error(error)
                    this.errored = true
                })
                .finally(() => this.loading = false)
        }
    }
})

loaderStop()      
</script>