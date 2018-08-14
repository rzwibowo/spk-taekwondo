var app = new Vue({
  el: '#app',
  created(){
    this.GetData();
    this.InitializeFrom();
  },
  data: {
    mahasiswas:[],
    FilterModel:[],
    mahasiswaView:{},
    tahunangkatan:[],
    Form:{},
    Submit:{},
    PekerjaanOrangTua:[],
    Kendaraan:[],
    JumlahTanggungan:[],
    PenghasilanOrangTua:[],
    IPK:[],
    IPKValue:{},
    mahasiswa:{
      nim:"",
      nama:"",
      id_tahun_angkatan:"",
      jenis_kelamin:"",
      tempat_lahir:"",
      tgl_lahir:"",
      alamat:"",
      ipk:"",
      kendaraan:"",
      pgh_orangtua:"",
      pkj_orangtua:"",
      jml_tanggungan:"",
      ipkCriteria:"",
      tanggunganCriteria:"",
      penghasilanCriteria:""
    },
  },
  methods: {
    Save() 
    {
      this.Submit = true;
      if(this.mahasiswa.nim && this.mahasiswa.nama && this.mahasiswa.id_tahun_angkatan && this.mahasiswa.jenis_kelamin && this.mahasiswa.tempat_lahir && this.mahasiswa.tgl_lahir && this.mahasiswa.alamat && this.mahasiswa.ipk && this.mahasiswa.kendaraan && this.mahasiswa.pgh_orangtua && this.mahasiswa.pkj_orangtua && this.mahasiswa.jml_tanggungan)
      {
      axios
        .post(locationServer+'/api/mahasiswa/mahasiswa',{
          body: this.mahasiswa
        })
        .then(response => {
          this.GetData();
          this.reset();
        })
        .catch(error => {
          console.log("Gagal Simpan Data")
          this.errored = true
        })
        .finally(
          document.getElementById('list').scrollIntoView({
            behavior: 'smooth'
          })
        )
   }
    },
    GetData()
    {
      axios
        .post(locationServer+'/api/mahasiswa/mahasiswas',{
          body: this.Filter()
        })
        .then(response => {
          this.mahasiswas =  response.data;
          this.Submit = false;
          this.Form = false;
        })
        .catch(error => {
          console.log(error)
          this.errored = true
        })
        // .finally(() => this.loading = false )
        .finally(
          document.getElementById('list').scrollIntoView({
            behavior: 'smooth'
          })
        )
    },
    reset()
    {
      this.mahasiswa = {};
      this.mahasiswa.pkj_orangtua = "";
      this.mahasiswa.id_tahun_angkatan ="";
      this.mahasiswa.kendaraan = "";
      this.Submit = false;
      this.Form = true;
    },
    Filter()
    {
      var FilterParam = {};
      if(this.FilterModel.nim !== "" && this.FilterModel.nim !== null ){
        FilterParam.nim =this.FilterModel.nim;
      }
      if(this.FilterModel.nama !== null && this.FilterModel.nama !== "" ){
        FilterParam.nama =this.FilterModel.nama;
      }
      if(this.FilterModel.tahun_angkatan !== null && this.FilterModel.tahun_angkatan !== "" ){
        FilterParam.tahun_angkatan =this.FilterModel.tahun_angkatan;
      }
      if(this.FilterModel.jenis_kelamin !== null && this.FilterModel.jenis_kelamin !== "" ){
        FilterParam.jenis_kelamin =this.FilterModel.jenis_kelamin;
      }
      if(this.FilterModel.ipk !== null && this.FilterModel.ipk !== "" ){
        FilterParam.ipk =this.FilterModel.ipk;
      }
      if(this.FilterModel.kendaraan !== null && this.FilterModel.kendaraan !== "" ){
        FilterParam.kendaraan =this.FilterModel.kendaraan;
      }
      return FilterParam;

    },
    ChangeFilter(Param)
    {
      if(Param.length > 2){
        this.GetData();
      } else if(Param.length == 0){
        this.GetData();
      }

    },
    Edit(Id)
    {
      this.Form = true;
      this.Submit = false;
      axios
        .get(locationServer+'/api/mahasiswa/GetDataMahasiswaEdit/'+Id)
        .then(response => {
          this.mahasiswa =  response.data;
        })
        .catch(error => {
          console.log("Gagal Ambil Data");
          this.errored = true
        })
        .finally(() => this.loading = false 
      )
      document.getElementById('input').scrollIntoView({
        behavior: 'smooth'
      })
    },
    Delete(Id)
    {
      var x = confirm("Are you sure you want to delete?");
      if (x){
        axios
          .get(locationServer+'/api/mahasiswa/mahasiswadelete/'+Id)
          .then(response => {
            this.GetData();
          })
          .catch(error => {
            console.log("Gagal Hapus");
            this.errored = true
          })
          .finally(() => this.loading = false )
       }
    },
    View(Id)
    {
      axios
        .get(locationServer+'/api/mahasiswa/GetDataMahasiswaById/'+Id)
        .then(response => {
          this.mahasiswaView =  response.data;
          $("#detail-modal").modal('show');
        })
        .catch(error => {
          console.log("Gagal Ambil Data");
          this.errored = true
        })
        .finally(() => this.loading = false )
    },
    InitializeFrom(){
  this.mahasiswa= {
      nim:"",
      nama:"",
      id_tahun_angkatan:"",
      jenis_kelamin:"",
      tempat_lahir:"",
      tgl_lahir:"",
      alamat:"",
      ipk:"",
      kendaraan:"",
      pgh_orangtua:"",
      pkj_orangtua:"",
      jml_tanggungan:"",      
      ipkCriteria:"",
      tanggunganCriteria:"",
      penghasilanCriteria:""
    };
      axios
      .get(locationServer+'/api/tahunangkatan/tahunangkatans')
        .then(response => {
          this.tahunangkatan = response.data;
        })
        .catch(error => {
          this.errored = true
        })
        .finally(() => console.log())
        // PekerjaanOrangTua
        axios
      .get(locationServer+'/api/kriteria/detailkriteria/'+'Pekerjaan_Orang_Tua')
        .then(response => {
          this.PekerjaanOrangTua = response.data;
        })
        .catch(error => {
          this.errored = true
        })
        .finally(() => console.log())
        //Kendaraan
        axios
      .get(locationServer+'/api/kriteria/detailkriteria/'+'Kendaraan')
        .then(response => {
          this.Kendaraan = response.data;
        })
        .catch(error => {
          this.errored = true
        })
        .finally(() => console.log())
        //JumlahTanggungan
        axios
      .get(locationServer+'/api/kriteria/detailkriteria/'+'Jumlah_Tanggungan')
        .then(response => {
          this.JumlahTanggungan = response.data;
        })
        .catch(error => {
          this.errored = true
        })
        .finally(() => console.log())
        //PenghasilanOrangTua
        axios
      .get(locationServer+'/api/kriteria/detailkriteria/'+'Penghasilan_Orang_Tua')
        .then(response => {
          this.PenghasilanOrangTua = response.data;
        })
        .catch(error => {
          this.errored = true
        })
        .finally(() => console.log())
        //IPK
        axios
      .get(locationServer+'/api/kriteria/detailkriteria/'+'IPK')
        .then(response => {
          this.IPK = response.data;
        })
        .catch(error => {
          this.errored = true
        })
        .finally(() => console.log())
    },
    SearchIPK(IPK){
      var BreakException = {};
      var criteria ="";
      try {
        this.IPK.forEach(function (value, i) {
            if(value.min !== '' && value.max !== '')
            {
              if(eval(IPK+value.operator_min+value.min+'&&'+IPK+value.operator_max+value.max)){
                criteria = value.id_sub_criteria;
                throw BreakException;
              }
            }else if(value.min !== '' && value.max == '')
            {
              if(eval(IPK+value.operator_min+value.min)){
                criteria = value.id_sub_criteria;
                throw BreakException;
               }
            }
        });
      } catch (e) {  
    }
    this.mahasiswa.ipkCriteria = criteria;
    },
    SearchJumlahTanggungan(anak){
      var BreakException = {};
      var criteria ="";
      try {
        this.JumlahTanggungan.forEach(function (value, i) {
            if(value.min !== '' && value.max !== '')
            {
              if(eval(anak+value.operator_min+value.min+'&&'+anak+value.operator_max+value.max)){
                criteria = value.id_sub_criteria;
                throw BreakException;
              }
            }else if(value.min !== '' && value.max == '')
            {
              if(eval(anak+value.operator_min+value.min)){
                criteria = value.id_sub_criteria;
                throw BreakException;
               }
            }
        });
      } catch (e) {  
    }
    this.mahasiswa.tanggunganCriteria = criteria;
    },
    SearchPghOrangtua(penghasilan){
      var BreakException = {};
      var criteria="";
      try {
        this.PenghasilanOrangTua.forEach(function (value, i) {
            if(value.min !== '' && value.max !== '')
            {
              if(eval(parseInt(penghasilan.replace(/\./g,''))+value.operator_min+parseInt(value.min.replace(/\./g,''))+'&&'+parseInt(penghasilan.replace(/\./g,''))+value.operator_max+parseInt(value.max.replace(/\./g,'')))){
                criteria = value.id_sub_criteria;
                throw BreakException;
              }
            }else if(value.min !== '' && value.max == '')
            {
              if(eval(parseInt(penghasilan.replace(/\./g,''))+value.operator_min+parseInt(value.min.replace(/\./g,'')))){
                criteria = value.id_sub_criteria;
                throw BreakException;
               }
            }
        });
      } catch (e) {  
    }
    this.mahasiswa.penghasilanCriteria = criteria;
    },
    GetFormatIPK(ipk){
     let NotValid = false;
     let dot =  ipk.substr(1, 1);
     if(ipk.substr(0, 1) === "."){
      NotValid = true;
     }else if(dot !=="."){
       NotValid = true;
     }
     return NotValid; 
    }
  }
})

loaderStop()
function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}