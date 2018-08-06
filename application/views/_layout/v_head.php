<!doctype html>
<html>
  <head>
    <title><?php echo isset($title) ? $title." | " : "" ?>SPK Beasiswa</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport" />

    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <link href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.1/css/simple-line-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="<?php echo base_url() ?>assets/css/style.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>assets/css/dash.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>assets/css/loader.css" rel="stylesheet">
    
    <script src="https://cdn.jsdelivr.net/npm/vue@2.5.13/dist/vue.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.18.0/axios.min.js"></script>
    <script src="https://unpkg.com/vue-cookies@1.5.5/vue-cookies.js"></script>
    <script type="text/javascript">
      var locationServer ="<?php echo base_url() ?>index.php";
    </script>
    <style>
      #app {
        margin: 1em auto;
      }
      .nav-link.active.nav-menu::after {
        content: '';
        background: #ccddee;
        display: block;
        height: 5px;
        position: absolute;
        left: 0;
        right: 0;
        bottom: -1em;
      }
      .above {
        margin: 2em auto;
      }
    </style>
  </head>
  <body class="app header-fixed">
    <div class="loader">
      <img src="<?php echo base_url() ?>assets/img/load.svg" alt="Loading ...">
    </div>
    <header class="app-header navbar">
      <button class="navbar-toggler sidebar-toggler d-lg-none mr-auto" type="button" data-toggle="sidebar-show">
        <span class="navbar-toggler-icon"></span>
      </button>
      <a class="navbar-brand" href="<?php echo site_url() ?>">
        <img class="navbar-brand-full" src="<?php echo base_url() ?>assets/img/brand/logo.svg" width="89" height="25" alt="CoreUI Logo">
        <img class="navbar-brand-minimized" src="<?php echo base_url() ?>assets/img/brand/sygnet.svg" width="30" height="30" alt="CoreUI Logo">
      </a>
      <ul class="nav navbar-nav d-md-down-none">
        <li class="nav-item px-3">
          <a class="nav-link nav-menu<?php if ($this->uri->segment(1) == "") { echo " active"; } ?>" href="<?php echo site_url() ?>">
            <i class="nav-icon icon-home"></i> Home
          </a>
        </li>
        <li class="nav-item px-3">
          <a class="nav-link nav-menu<?php if ($this->uri->segment(1) == "tahunangkatan") { echo " active"; } ?>" href="<?php echo site_url() ?>/tahunangkatan">
            <i class="nav-icon icon-calendar"></i> Tahun Angkatan
          </a>
        </li>
        <li class="nav-item px-3">
          <a class="nav-link nav-menu<?php if ($this->uri->segment(1) == "kriteria") { echo " active"; } ?>" href="<?php echo site_url() ?>/kriteria">
            <i class="nav-icon icon-equalizer"></i> Kriteria
          </a>
        </li>
        <li class="nav-item px-3">
          <a class="nav-link nav-menu<?php if ($this->uri->segment(1) == "mahasiswa") { echo " active"; } ?>" href="<?php echo site_url() ?>/mahasiswa">
            <i class="nav-icon icon-graduation"></i> Mahasiswa
          </a>
        </li>
        <li class="nav-item px-3">
          <a class="nav-link nav-menu<?php if ($this->uri->segment(1) == "perhitungan") { echo " active"; } ?>" href="<?php echo site_url() ?>/perhitungan">
            <i class="nav-icon icon-calculator"></i> Perhitungan
          </a>
        </li>
      </ul>
      <ul class="nav navbar-nav ml-auto" id="identity">
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
            <img class="img-avatar" src="<?php echo base_url() ?>assets/img/avatars/1.png" alt="admin@bootstrapmaster.com">
          </a>
          <div class="dropdown-menu dropdown-menu-right">
            <div class="dropdown-header text-center">
              <strong>Pengguna</strong>
            </div>
            <a class="dropdown-item disabled bg-gray-300 text-white" style="cursor: default; pointer-events: none;">
              <i class="fa fa-user text-white"></i> <strong>{{username}}</strong></a>
            <a class="dropdown-item" href="<?php echo site_url() ?>/user">
              <i class="fa fa-users"></i> Daftar Pengguna</a>
            <a class="dropdown-item text-danger" href="#" v-on:click="Logout()">
              <i class="fa fa-lock text-danger"></i> Logout</a>
          </div>
        </li>
      </ul>
    </header>
    <div class="app-body">
      <main class="main" id="main">
        <div class="container">
          <div class="animated fadeIn">

<script type="text/javascript">
  var idt = new Vue({
    el: '#identity',
    data: {
      username: ''
    },
    created() {
      this.GetUserName();
    },
    methods: {
      GetUserName () {
        axios.get(locationServer+'/api/login/GetUserName/'+this.$cookies.get("tokenUserApp"))
        .then(response => {
            this.username = response.data.username;
        })
        .catch(error => {
          console.log(error)
          this.errored = true
        })
      },
    Logout()
     {
      this.$cookies.remove("tokenUserApp");
      window.location.replace(locationServer+"/login?logout=true"); 
     }
    }
  })
  var app = new Vue({
  created() {
    this.Initialization()
  },
  methods: {
   GetCokies () {
    return this.$cookies.get("tokenUserApp");
   },
   Initialization()
   {
     if(this.GetCokies() == "" || this.GetCokies() == null || this.GetCokies() == "undefined"){
      window.location.replace(locationServer+"/login");
     }
   },
  }
})
var loader = document.querySelectorAll('.loader')
function loaderStop() {
  setInterval(function() {
    if (loader[0].style.opacity > 0) {
      loader[0].style.opacity -= 0.1
    }
  }, 500)
  loader[0].style.display = "none"
}
</script>