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


	<!-- Slider -->
	<div id="page">
		<ul id="slider_int">
			<li><img src="<?php echo base_url('public_folder/front/imagenes_rinoslideer/01.jpg'); ?>" height="495" width="2500" class="imagen_slide" /></li>
			<li><img src="<?php echo base_url('public_folder/front/imagenes_rinoslideer/02.jpg'); ?>" height="495" width="2500" class="imagen_slide" /></li>
			<li><img src="<?php echo base_url('public_folder/front/imagenes_rinoslideer/03.jpg'); ?>" height="495" width="2500" class="imagen_slide" /></li>
			<!-- <li><img src="imagenes_rinoslideer/04.jpg" height="495" width="2500" class="imagen_slide" /></li> -->
		</ul><!--slider_int-->
	</div><!-- page -->
	<!-- Slider -->


	<div id="wrapper">	

		<section>
			<h1>Propiedades <span>Destacadas</span></h1>
		



				<!--*********************************** Fila de 3 propiedades *******************************-->

				<div class="filas_propiedades">
					<?php  
					
					
					/// VIENEN ARRAYS CON VALORES DESDE BUSCADOR GENERAL


					$counter=0;
					foreach ($destacadas as $destacada) {
						/* IMAGEN */
						$imagen_principal = "";

						$img_name = $this->imagenes_propiedad->traer_una($destacada->id);
					
					if($img_name->filename!=""){$imagen_principal = '<img src="'.base_url('images-propiedades/'.$img_name->filename).'" alt="">';}



						/*
						if(!empty($destacada->main_image)){
							$img_name = $this->imagenes_propiedad->get_filename($destacada->main_image);
							if($img_name!=""){$imagen_principal = '<img src="'.base_url('images-propiedades/'.$img_name).'" alt="">';}
						}
						*/
						/* BARRIO */
						$nombre_barrio = $this->barrio->traer_nombre($destacada->barrio);

					/* BARRIO */
					$barrio = str_replace("CABA - ", "", $nombre_barrio);
					$barrio = str_replace("GBA - ", "", $barrio);
						/* TIPO PROPIEDAD */
						$tipo_propiedad = $this->categoria->traer_nombre($destacada->categoria_id);
						/* TIPO TRANSACCION */
						$tipo_transaccion = $tipos_transaccion[$destacada->tipo_transaccion];

						echo '
							<div class="conntent_prop_ind_home">
						<a href="'.base_url('propiedad/'.$destacada->id).'" class="img_bt_vermas">
							<div class="content_thumb">
								'.$imagen_principal.'
							</div><!-- content_thumb -->
							<div class="bt_vermas_prop">
								VER MAS
							</div><!-- bt_vermas_prop -->
						</a><!-- img_bt_vermas -->

						<div class="info_inferior_thumb">
							<h2>'.$destacada->direccion.'</h2>
							<p>
								<span>'.$barrio.'</span><br />
								'.$tipo_propiedad.' '.$tipo_transaccion.'<br />
								Superficie total: '.$destacada->sup_t_total.'m2<br />
								<span class="precio_listado_prop">'.$destacada->moneda.' '.number_format($destacada->precio).'</span>
							</p>
						</div><!-- info_inferior_thumb -->
					</div><!-- conntent_prop_ind_home -->
						';
						$counter++;
						if($counter ==3){
						echo '
						</div><!-- filas_propiedades -->
						<!--*********************************** Fila de 3 propiedades *******************************-->
						<div class="filas_propiedades">';
						$counter=0;
						}



					}


					?>
					







						
		</section>



	</div><!--wrapper-->


	<div id="wrapper_footer">
		<?php include_once("inc/footer.php"); ?>
	</div> <!--wrapper_footer-->


	<?php include_once("inc/js.php"); ?>


	<!--Rino slider (casos)-->
	<!-- <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script> -->
	<script type="text/javascript" src="<?php echo base_url('public_folder/front/js/rino_slider/rhinoslider-1.05.min.js'); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url('public_folder/front/js/rino_slider/mousewheel.js'); ?>"></script> <!--SCRIPT PARA RUEDA DE RATON-->
	<!-- <script type="text/javascript" src="js/rino_slider/easing.js"></script> -->
	<script type="text/javascript">
		$(document).ready(function() {
			$('#slider_int').rhinoslider({
				effectTime: 400,
				easing: 'easeOutExpo',
				controlsMousewheel: false,
				controlsKeyboard: false,
				controlsPlayPause: false,
				showBullets: 'false ',
				showControls: 'false',
				slidePrevDirection: 'toRight',
				slideNextDirection: 'toLeft',
				autoPlay: true,
				pauseOnHover: false,
			});
		});
	</script>
	<!--Rino slider (casos)-->



	
	<?php include_once("inc/g_analytics.php"); ?>


</body>
</html>