<?php include_once("inc/charset.php"); ?>
<!DOCTYPE html>
<html lang="es">
<head>
	<?php include_once('inc/metas.php') ?>
	<title><?php include_once('inc/title.php') ?></title>

	
	<?php include_once('inc/css.php') ?>

	<!--Rino slider (home)-->
	<link type="text/css" rel="stylesheet" href="<?php echo base_url('public_folder/front/layout/rhinoslider-1.05.css'); ?>" />
	<!--Rino slider (home)-->


</head>
<body>


	<div id="wrapper_header">
		<?php include_once("inc/header.php"); ?>
	</div><!-- wrapper_header -->


	<?php include_once("inc/buscador_general.php"); ?>



	<div id="wrapper">	

		<section>			
			
			<div id="encabezado_detalles">

			<?php if($mensaje){echo "<h3>$mensaje</h3>";} ?>
			

			</div>

		</section>


	</div><!--wrapper-->


	<div id="wrapper_footer">
		<?php include_once("inc/footer.php"); ?>
	</div> <!--wrapper_footer-->


	<?php include_once("inc/js.php"); ?>


	<!-- Facebox -->
	<link href="<?php echo base_url('public_folder/front/src/facebox.css'); ?>" media="screen" rel="stylesheet" type="text/css" />
	<script src="<?php echo base_url('public_folder/front/src/facebox.js'); ?>" type="text/javascript"></script>
	  <script type="text/javascript">
	    jQuery(document).ready(function($) {
	      $('a[rel*=facebox]').facebox({
	        loadingImage : 'src/loading.gif',
	        closeImage   : 'src/closelabel.png'
	      })
	    })
	</script>
	<!-- Facebox -->


	<?php include_once("inc/g_analytics.php"); ?>


</body>
</html>