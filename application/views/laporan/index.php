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
                                <select class="form-control">
                                    <option>2018</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="text-right">
                            <button type="button" class="btn btn-info">
                                <i class="icon-paper-clip"></i>
                                Daftar Calon Penerima Beasiswa
                            </button>
                            <button type="button" class="btn btn-info">
                                <i class="icon-paper-clip"></i>
                                Laporan Penerima Beasiswa
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card laporan-preview">
                    <div class="card-header">
                        <strong>Daftar Calon Penerima Beasiswa</strong>
                    </div>
                    <div class="card-body">
                        <div class="text-center">
                            <h4>Daftar Calon Penerima Beasiswa Tahun Angkatan</h4>
                            <h3>PEMERINTAH KABUPATEN MAPPI</h3>
                            <h3>DINAS PENDIDIKAN DAN PENGAJARAN</h3>
                            <h5>Jl. Poros Agham Km. 05, Kec. Obaa Kepi, Kab. Mappi</h5>
                        </div>
                        <div class="horizontal-line"></div>
                        <div>
                            <ol>
                                <li v-for="(mhs, idx) in mahasiswa" :key="idx">
                                    <b>{{ mhs.nama | capitalize }}</b>
                                    <table>
                                        <tbody>
                                            <tr>
                                                <td>NIM:</td>
                                                <td>{{ mhs.nim }}</td>
                                            </tr>
                                            <tr>
                                                <td>Tahun Angkatan: </td>
                                                <td>{{ mhs.tahun_angkatan }}</td>
                                            </tr>
                                            <tr>
                                                <td>Jenis Kelamin: </td>
                                                <td>{{ mhs.jenis_kelamin | capitalize }}</td>
                                            </tr>
                                            <tr>
                                                <td>Tempat, Tanggal Lahir:</td>
                                                <td>{{ mhs.tempat_lahir }}, {{ mhs.tgl_lahir | formatDate }}</td>
                                            </tr>
                                            <tr>
                                                <td>Alamat:</td>
                                                <td>{{ mhs.alamat }}</td>
                                            </tr>
                                            <tr>
                                                <td>IPK:</td>
                                                <td>{{ mhs.ipk }}</td>
                                            </tr>
                                            <tr>
                                                <td>Kendaraan:</td>
                                                <td>{{ mhs.kendaraan }}</td>
                                            </tr>
                                            <tr>
                                                <td>Pekerjaan Orang Tua:</td>
                                                <td>{{ mhs.pkj_orangtua }}</td>
                                            </tr>
                                            <tr>
                                                <td>Penghasilan Orang Tua:</td>
                                                <td>{{ mhs.pgh_orangtua }}</td>
                                            </tr>
                                            <tr>
                                                <td>Jumlah Tanggungan Orang Tua:</td>
                                                <td>{{ mhs.jml_tanggungan }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
	</div>
</div>
<script type="text/javascript">

var app = new Vue({
    el: '#app',
    data: {
        tahun_angkatan: [],
        mahasiswa: []
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

            return `${day}, ${month} ${year}`
        },
        capitalize: function (value) {
            if (!value) return ''
            value = value.toString()
            return value.charAt(0).toUpperCase() + value.slice(1)
        }
    },
    methods: {
        getCalonBeasiswa: function () {
            axios.get(locationServer+'/api/mahasiswa/getmahasiswawithtahunangkatan/'+2)
                .then(response => {
                    this.mahasiswa =  response.data;
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