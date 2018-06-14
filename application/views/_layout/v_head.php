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
    
  </head>
  <body class="app header-fixed sidebar-fixed aside-menu-fixed sidebar-lg-show">
    <header class="app-header navbar">
  <button class="navbar-toggler sidebar-toggler d-lg-none mr-auto" type="button" data-toggle="sidebar-show">
    <span class="navbar-toggler-icon"></span>
  </button>
  <a class="navbar-brand" href="#">
    <img class="navbar-brand-full" src="<?php echo base_url() ?>assets/img/brand/logo.svg" width="89" height="25" alt="CoreUI Logo">
    <img class="navbar-brand-minimized" src="<?php echo base_url() ?>assets/img/brand/sygnet.svg" width="30" height="30" alt="CoreUI Logo">
  </a>
  <button class="navbar-toggler sidebar-toggler d-md-down-none" type="button" data-toggle="sidebar-lg-show">
    <span class="navbar-toggler-icon"></span>
  </button>
  <ul class="nav navbar-nav ml-auto">
    <li class="nav-item dropdown">
      <a class="nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
        <img class="img-avatar" src="<?php echo base_url() ?>assets/img/avatars/6.jpg" alt="admin@bootstrapmaster.com">
      </a>
      <div class="dropdown-menu dropdown-menu-right">
        <div class="dropdown-header text-center">
          <strong>Account</strong>
        </div>
        <a class="dropdown-item" href="#">
          <i class="fa fa-user"></i> Profile</a>
        <a class="dropdown-item" href="#">
          <i class="fa fa-lock"></i> Logout</a>
      </div>
    </li>
  </ul>
</header>
<div class="app-body">
  <div class="sidebar">
    <nav class="sidebar-nav">
      <ul class="nav">
        <li class="nav-item">
          <a class="nav-link<?php if ($this->uri->segment(1) == "Navigation") { echo " active"; } ?>" href="<?php base_url() ?>Mahasiswa">
            <i class="nav-icon icon-graduation"></i> Mahasiswa
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="index.html">
            <i class="nav-icon icon-equalizer"></i> Kriteria
          </a>
        </li>
      </ul>
    </nav>
  </div>
  <main class="main">
    <!-- Breadcrumb-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item active"><?php echo isset($title) ? $title : "" ?></li>
    </ol>
    <div class="container-fluid">
      <div class="animated fadeIn">