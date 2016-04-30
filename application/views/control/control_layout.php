<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="<?php echo base_url('public_folder/css/normalize.min.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url('public_folder/css/bootstrap.min.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url('public_folder/css/backend.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url('public_folder/css/font-awesome.min.css'); ?>">

        <script src="<?php echo base_url('public_folder/js/vendor/modernizr-2.6.2.min.js'); ?>"></script>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <style>
        body {
        padding-top: 20px;
        padding-bottom: 20px;
        }

        .navbar {
        margin-bottom: 20px;
        }
        </style>


    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    
        <!-- HEADER -->
    <header class="container">
      <!-- Static navbar -->
      <div class="navbar navbar-default" role="navigation">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo base_url('control/propiedades'); ?>">Mart&iacute;n Cersarsky</a>
          </div>
          <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
              
        


              <li <?php if($this->uri->segment(2) == "sucursales"){echo 'class="active"';} ?>>
              <a href="<?php echo base_url('control/sucursales'); ?>">Sucursales</a>
              </li>

              <li <?php if($this->uri->segment(2) == "categorias"){echo 'class="active"';} ?>>
              <a href="<?php echo base_url('control/categorias'); ?>">Tipo propiedad</a>
              </li>

              <li <?php if($this->uri->segment(2) == "barrios"){echo 'class="active"';} ?>>
             <a href="<?php echo base_url('control/barrios'); ?>">Barrios</a>
              </li>

              <li <?php if($this->uri->segment(2) == "propiedades"){echo 'class="active"';} ?>>
             <a href="<?php echo base_url('control/propiedades'); ?>">Propiedades</a>
              </li>

              <li <?php if($this->uri->segment(2) == "tipos_transacciones"){echo 'class="active"';} ?>>
             <a href="<?php echo base_url('control/tipos_transacciones'); ?>">Tipos transaccion</a>
              </li>

              <!--
              <li>
              <a href="<?php echo base_url('control/'); ?>">Link</a>
              </li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">titulo drop <span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                  <li><a href="<?php echo base_url(); ?>">Opciones uno</a></li>
                  <li><a href="<?php echo base_url(); ?>">Opciones dos</a></li>

                </ul>

              </li>
              -->
            </ul>
            <ul class="nav navbar-nav navbar-right">
              <li><a href="<?php echo base_url('control/logout'); ?>">Cerrar sesion</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
      </div>

    </header>

<!-- BODY -->
<div class="container">

  <div class="row">
    <div id="avisos" class="col-lg-12">

    <?php 

      if($this->session->flashdata('success')): 
      echo '<div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert">&times;</button>
      '.$this->session->flashdata('success').'</div>';
      endif;

      if($this->session->flashdata('warning')): 
      echo '<div class="alert alert-warning"  role="alert"><button type="button" class="close" data-dismiss="alert">&times;</button>
      '.$this->session->flashdata('warning').'</div>';
      endif;

      if($this->session->flashdata('error')): 
      echo '<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert">&times;</button>
      '.$this->session->flashdata('error').'</div>';
      endif;

    ?>
    </div>
  </div>
</div>

<div class="container">
  <div class="row">
    <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
    <!-- menu column -->
    <?php $this->load->view($menu); ?>
    </div>
    <div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">

    <?php $this->load->view($content); ?>
    </div>
  </div>
</div>



        <!-- FOOTER -->
    <footer class="container">
      <div class="row">
      <hr>
        <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3 red">
          <p> | Mart&iacute;n Cersarsky - 2015 | </p>
        </div>
        <div class="col-xs-12 col-sm-9 col-md-9 col-lg-9 ">
        <p></p>
        </div>
      </div>

    </footer>

    <!-- END BODY -->
        
        <script>window.jQuery || document.write('<script src="<?php echo base_url("public_folder/js/vendor/jquery-1.11.0.min.js"); ?>"><\/script>')</script>


<script type="text/javascript" src="http://code.jquery.com/ui/1.9.2/jquery-ui.js"></script>
<script src="<?php echo base_url('public_folder/js/jquery-ui-1.10.3.js') ?>"></script>


        <script src="<?php echo base_url('public_folder/js/plugins.js'); ?>"></script>
        <script src="<?php echo base_url('public_folder/js/bootstrap.min.js'); ?>"></script>
        <script src="<?php echo base_url('public_folder/js/main.js'); ?>"></script>

        
        <script>
        window.setTimeout(function() { $(".alert-success").alert('close'); }, 6000);
        window.setTimeout(function() { $(".alert-warning").alert('close'); }, 6000);
        window.setTimeout(function() { $(".alert-danger").alert('close'); }, 6000);


        function goBack() {
           window.location.history.go(-2);
        }



        </script>

      


    </body>
</html>