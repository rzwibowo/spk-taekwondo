<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">
  <!-- Favicon icon -->
  <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url() ?>assets/images/favicon.png">
  <title><?php echo isset($title) ? $title." | " : "" ?>SPK Tempat Latihan Taekwondo</title>
  <!-- Custom CSS -->
  <link href="<?php echo base_url() ?>assets/css/style.min.css" rel="stylesheet">
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
  <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body>
  <!-- ============================================================== -->
  <!-- Preloader - style you can find in spinners.css -->
  <!-- ============================================================== -->
  <div class="preloader">
      <div class="lds-ripple">
          <div class="lds-pos"></div>
          <div class="lds-pos"></div>
      </div>
  </div>
  <!-- ============================================================== -->
  <!-- Main wrapper - style you can find in pages.scss -->
  <!-- ============================================================== -->
  <div id="main-wrapper">
      <!-- ============================================================== -->
      <!-- Topbar header - style you can find in pages.scss -->
      <!-- ============================================================== -->
      <header class="topbar" data-navbarbg="skin5">
          <nav class="navbar top-navbar navbar-expand-md navbar-dark">
              <div class="navbar-header" data-logobg="skin5">
                  <!-- This is for the sidebar toggle which is visible on mobile only -->
                  <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
                  <!-- ============================================================== -->
                  <!-- Logo -->
                  <!-- ============================================================== -->
                  <a class="navbar-brand" href="index.html">
                      <!-- Logo icon -->
                      <b class="logo-icon p-l-10">
                          <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                          <!-- Dark Logo icon -->
                          <img src="<?php echo base_url() ?>assets/images/logo-icon.png" alt="homepage" class="light-logo" />
                          
                      </b>
                      <!--End Logo icon -->
                        <!-- Logo text -->
                      <span class="logo-text">
                            <!-- dark Logo text -->
                            <img src="<?php echo base_url() ?>assets/images/logo-text.png" alt="homepage" class="light-logo" />
                          
                      </span>
                      <!-- Logo icon -->
                      <!-- <b class="logo-icon"> -->
                          <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                          <!-- Dark Logo icon -->
                          <!-- <img src="<?php echo base_url() ?>assets/images/logo-text.png" alt="homepage" class="light-logo" /> -->
                          
                      <!-- </b> -->
                      <!--End Logo icon -->
                  </a>
                  <!-- ============================================================== -->
                  <!-- End Logo -->
                  <!-- ============================================================== -->
                  <!-- ============================================================== -->
                  <!-- Toggle which is visible on mobile only -->
                  <!-- ============================================================== -->
                  <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i class="ti-more"></i></a>
              </div>
              <!-- ============================================================== -->
              <!-- End Logo -->
              <!-- ============================================================== -->
              <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">
                  <!-- ============================================================== -->
                  <!-- toggle and nav items -->
                  <!-- ============================================================== -->
                  <ul class="navbar-nav float-left mr-auto">
                      <li class="nav-item d-none d-md-block"><a class="nav-link sidebartoggler waves-effect waves-light" href="javascript:void(0)" data-sidebartype="mini-sidebar"><i class="mdi mdi-menu font-24"></i></a></li>
                  </ul>
                  <!-- ============================================================== -->
                  <!-- Right side toggle and nav items -->
                  <!-- ============================================================== -->
                  <ul class="navbar-nav float-right">
                      <!-- ============================================================== -->
                      <!-- User profile and search -->
                      <!-- ============================================================== -->
                      <li class="nav-item dropdown">
                          <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark pro-pic" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="<?php echo base_url() ?>assets/images/users/1.jpg" alt="user" class="rounded-circle" width="31"></a>
                          <div class="dropdown-menu dropdown-menu-right user-dd animated">
                              <a class="dropdown-item" href="javascript:void(0)"><i class="ti-user m-r-5 m-l-5"></i> My Profile</a>
                              <a class="dropdown-item" href="javascript:void(0)"><i class="ti-panel m-r-5 m-l-5"></i> Kelola User</a>
                              <div class="dropdown-divider"></div>
                              <a class="dropdown-item" href="javascript:void(0)"><i class="fa fa-power-off m-r-5 m-l-5"></i> Logout</a>
                          </div>
                      </li>
                      <!-- ============================================================== -->
                      <!-- User profile and search -->
                      <!-- ============================================================== -->
                  </ul>
              </div>
          </nav>
      </header>
      <!-- ============================================================== -->
      <!-- End Topbar header -->
      <!-- ============================================================== -->
      <!-- ============================================================== -->
      <!-- Left Sidebar - style you can find in sidebar.scss  -->
      <!-- ============================================================== -->
      <aside class="left-sidebar" data-sidebarbg="skin5">
          <!-- Sidebar scroll-->
          <div class="scroll-sidebar">
              <!-- Sidebar navigation-->
              <nav class="sidebar-nav">
                  <ul id="sidebarnav" class="p-t-30">
                      <li class="sidebar-item">
                          <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo site_url() ?>" aria-expanded="false">
                              <i class="mdi mdi-home"></i>
                              <span class="hide-menu">Home</span>
                          </a>
                      </li>
                      <li class="sidebar-item">
                          <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo site_url() ?>/tempatlatihan" aria-expanded="false">
                              <i class="mdi mdi-bank"></i>
                              <span class="hide-menu">Tempat Latihan</span>
                          </a>
                      </li>
                  </ul>
              </nav>
              <!-- End Sidebar navigation -->
          </div>
          <!-- End Sidebar scroll-->
      </aside>
      <!-- ============================================================== -->
      <!-- End Left Sidebar - style you can find in sidebar.scss  -->
      <!-- ============================================================== -->
      <!-- ============================================================== -->
      <!-- Page wrapper  -->
      <!-- ============================================================== -->
      <div class="page-wrapper">
          <!-- ============================================================== -->
          <!-- Bread crumb and right sidebar toggle -->
          <!-- ============================================================== -->
            <div class="page-breadcrumb">
              <div class="row">
                  <div class="col-12 d-flex no-block align-items-center">
                      <h4 class="page-title"><?php echo isset($title) ? $title : "" ?></h4>
                      <div class="ml-auto text-right">
                          <nav aria-label="breadcrumb">
                              <ol class="breadcrumb">
                                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                                  <?php if(isset($title) && $title != "Home") {
                                      echo '<li class="breadcrumb-item active" aria-current="page">'.$title.'</li>';
                                  } ?>
                              </ol>
                          </nav>
                      </div>
                  </div>
              </div>
          </div>
          <!-- ============================================================== -->
          <!-- End Bread crumb and right sidebar toggle -->
          <!-- ============================================================== -->
          <!-- ============================================================== -->
          <!-- Container fluid  -->
          <!-- ============================================================== -->
          <div class="container-fluid" style="min-height: 100vh;">