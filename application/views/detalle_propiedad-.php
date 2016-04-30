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
			<?php  
			$imagen_principal="";
			$main_image="";
			//TODAS LAS IMAGENES
			$imagenes_db = $this->imagenes_propiedad->view_all($propiedad->id);
			$imagenes_list = array();
			foreach ($imagenes_db as $imagen) {
				$imagenes_list[$imagen->id] = $imagen->filename;
			}
			//VERIFICO SI HAY UNA PRINCIPAL
			$tomar_primera=false;
			if(empty($propiedad->main_image)){
				//si no hay una por defecto tomo la primera del listado de imagenes
				list($imagen_principal) = array_shift($imagenes_list);
				$tomar_primera =true;
			}else{
				//si hay una marcada por defecto la tomo del array y la saco de la lista
				$imagen_principal =  $imagenes_list[$propiedad->main_image];
				unset($imagenes_list[$propiedad->main_image]);
			}

			if($imagen_principal!=""){
				$main_image = '<img src="'.base_url('images-propiedades/'.$imagen_principal).'" alt="">';
			}
			


			if(!empty($imagenes_list)){
				$counter_imagenes =0;
				foreach ($imagenes_list as $imagen) {
					$imagenes .= '
					<div class="cada_foto_extra">
					<img src="'.base_url('images-propiedades/'.$imagen).'" alt="">
					</div><!-- cada_foto_extra -->
					';
				}
			}
			?>




				<div id="img_bt_vermasfotos">
					<div id="content_img_ppal">
					<?php echo $main_image; ?>
						
					</div><!-- content_thumb -->
					<?php if(!empty($imagenes_list)){
						echo '
						<a href="#descripcion_detallada" class="bt_vermas_cerrar_fotos anchorLink" id="bt_vermas_fotos">
						Ver todas las fotos
						</a><!-- bt_vermas_fotos -->

					';
					} ?>
				</div><!-- img_bt_vermasfotos -->



				<div id="detalles_derecha_foto">
					<?php 
					$direccion = $propiedad->direccion; 
					$tipo_transaccion = $this->tipos_transaccion->traer_nombre($propiedad->tipo_transaccion);
					echo '<h1>'.$direccion.'<span>'.$tipo_transaccion.'</span></h1>'; 
					

					/* BARRIO */
					$barrio = str_replace("CABA - ", "", $propiedad->barrio);
					$barrio = str_replace("GBA - ", "", $barrio);

					echo '
					<ul id="sub_detalles">
						<li class=\'lugar\'>'.$barrio.'</li>
						<li class=\'precio\'>'.$propiedad->moneda.' '.number_format($propiedad->precio).'</li>
						<li class=\'sup_total\'>Superficie total: '.$propiedad->sup_t_total.'m2</li>
						<li class=\'codigo\'>C&oacute;digo:'.$propiedad->codigo.'</li>
						
					</ul><!-- sub_detalles -->
					';
						?>
					

					


					<div id="sucursal_detalle">

						<div id="content_icono">
						</div><!-- content_icono -->
				
						<p class="cada_sucursal_detalle">
						
						<?php  
						$sucursal = $this->sucursal->get_record($propiedad->sucursal_id);
					
						$emails_list = explode(',', $sucursal->emails);
				
						foreach ($emails_list as $email) {
							$emails .= '<a href="mailto:'.$email.'">'.$email.'</a>';
						}
						echo '
						<span>'.$sucursal->nombre.'</span><br />
						'.$sucursal->direccion.'<br />
						<span class="tel_contacto">'.$sucursal->telefonos.' </span><br />
						'.$emails.'

						';
						?>



						</p>
						<input type="hidden" id="id_compartir" value="<?php echo $propiedad->id; ?>">
						<a href="<?php echo base_url('form_a_completar'); ?>" rel="facebox" id="enviar_amigo" >
							Enviar por mail a un amigo
						</a><!-- enviar_amigo -->

					
						<a href="<?php echo base_url('form_a_completar'); ?>?nota=1" rel="facebox" class="icono_acciones_notas icono_mail mail_bemass"></a>

					</div><!-- sucursal_detalle -->

				</div><!-- detalles_derecha_foto -->

			</div><!-- encabezado_detalles -->

		</section>







		<section>			
			
			<div id="descripcion_detallada">

				<div id="content_fotos_extra">

					<div class="bt_top_cerrar_fotos">
						<a href="#" id="cerrar_fotos_extras">X</a>
					</div><!-- bt_top_cerrar_fotos	 -->			
					
					<?php echo $imagenes; ?>


					<a href="#encabezado_detalles" class="bt_vermas_cerrar_fotos cerrar anchorLink" id="cerrar_fotos_extras">
						Cerrar las fotos
					</a><!-- bt_vermas_fotos -->

				</div><!-- content_fotos_extra -->


				<div class="grupo_info_detalle">
					<h2 class="icono_info_gral">Información General</h2>
					<ul>
						<?php  
						$tipo_propiedad = $this->categoria->traer_nombre($propiedad->categoria_id);
						
						$localidad = $propiedad->localidad;

						$barrio =  str_replace('GBA - ', "", $propiedad->barrio);
						$barrio =  str_replace('CABA - ', "", $propiedad->barrio);
						$transaccion = $this->tipos_transaccion->traer_nombre($propiedad->tipo_transaccion);
						/*
						if($propiedad->titulo){echo '<li><span>'.$propiedad->titulo.'</span> </li>';}
						if($propiedad->subtitulo){echo '<li><span>'.$propiedad->subtitulo.'</span> </li>';}
						*/
						$link_mapa ="";
						if($propiedad->coordenadas){
							$coordenadas = str_replace("(", "", $propiedad->coordenadas);
							$coordenadas = str_replace(")", "", $coordenadas);
							$link_mapa = '<a href="http://maps.google.com/?q='.$coordenadas.'" target="_blank" class="ver_mapa_detalles" title=""><img src="http://www.martincesarsky.com.ar/public_folder/front/layout/img_compartidas_estetica/ver_mapa_descripciones.png"></a>';
						}
						echo '
						<li>Tipo de propiedad:<span>'.$tipo_propiedad.'</span> </li>  
						<li>Localidad:<span>'.$localidad.'</span> </li>
						<li>Barrio:<span>'.$barrio.'</span> </li>      
						<li>Dirección:<span>'.$propiedad->direccion.' '.$link_mapa.' </span> </li>
						<li>Transacción:<span>'.$transaccion.'</span> </li>
						<li>Precio:<span>'.$propiedad->moneda.' '.$propiedad->precio.'</span> </li>
						';
						if($propiedad->sup_lote){echo '<li>Superficie de lote: <span>'.$propiedad->sup_lote.'m2</span> </li>';}
						if($propiedad->sup_cubierta){echo '<li>Superficie cubierta: <span>'.$propiedad->sup_cubierta.'m2</span> </li>';}
						if($propiedad->sup_semi_cubierta){echo '<li>Superficie semi-cubierta: <span>'.$propiedad->sup_semi_cubierta.'m2</span> </li>';}
						if($propiedad->sup_t_total){echo '<li>Superficie total:<span>'.$propiedad->sup_t_total.'m2</span></li>';}

						?>
						
					</ul>
				</div><!-- grupo_info_detalle -->



				

					<?php  
					$hay_info=false; 
					$lista_descripcion = "";
					if(!empty($propiedad->palier_privado)){ $hay_info=true; $lista_descripcion .= '<li>Palier privado:<span>'.$propiedad->palier_privado.'</span> </li>';}
					if(!empty($propiedad->hall_de_entrada)){ $hay_info=true; $lista_descripcion .= '<li>Hall de entrada:<span>'.$propiedad->hall_de_entrada.'</span> </li>';}
					if(!empty($propiedad->living)){ $hay_info=true; $lista_descripcion .= '<li>Living:<span>'.$propiedad->living.'</span> </li>';}
					if(!empty($propiedad->toilette)){ $hay_info=true; $lista_descripcion .= '<li>Toilette:<span>'.$propiedad->toilette.'</span> </li>';}
					if(!empty($propiedad->cant_banos)){ $hay_info=true; $lista_descripcion .= '<li>Cantidad de ba&ntilde;os:<span>'.$propiedad->cant_banos.'</span> </li>';}
					if(!empty($propiedad->cocina)){ $hay_info=true; $lista_descripcion .= '<li>Cocina:<span>'.$propiedad->cocina.'</span> </li>';}
					if(!empty($propiedad->comedor_diario)){ $hay_info=true; $lista_descripcion .= '<li>Comedor diario:<span>'.$propiedad->comedor_diario.'</span> </li>';}
					if(!empty($propiedad->lavadero)){ $hay_info=true; $lista_descripcion .= '<li>Lavadero:<span>'.$propiedad->lavadero.'</span> </li>';}
					if(!empty($propiedad->hab_servicio)){ $hay_info=true; $lista_descripcion .= '<li>Habitación de servicio:<span>'.$propiedad->hab_servicio.'</span> </li>';}
					if(!empty($propiedad->balcon)){ $hay_info=true; $lista_descripcion .= '<li>Balcón:<span>'.$propiedad->balcon.'</span> </li>';}
					if(!empty($propiedad->segundo_balcon)){ $hay_info=true; $lista_descripcion .= '<li>Segundo balcón:<span>'.$propiedad->segundo_balcon.'</span> </li>';}
					if(!empty($propiedad->quincho)){ $hay_info=true; $lista_descripcion .= '<li>Quincho:<span>'.$propiedad->quincho.'</span> </li>';}
					if(!empty($propiedad->cochera)){ $hay_info=true; $lista_descripcion .= '<li>Cochera:<span>'.$propiedad->cochera.'</span> </li>';}
					if(!empty($propiedad->garage)){ $hay_info=true; $lista_descripcion .= '<li>Garage:<span>'.$propiedad->garage.'</span> </li>';}
					if(!empty($propiedad->baulera)){ $hay_info=true; $lista_descripcion .= '<li>Baulera:<span>'.$propiedad->baulera.'</span> </li>';}
					if(!empty($propiedad->parrilla)){ $hay_info=true; $lista_descripcion .= '<li>Parrilla:<span>'.$propiedad->parrilla.'</span> </li>';}
					if(!empty($propiedad->piscina)){ $hay_info=true; $lista_descripcion .= '<li>Piscina:<span>'.$propiedad->piscina.'</span> </li>';}
					
					if($hay_info==true){
						echo '<div class="grupo_info_detalle">
					<h2 class="icono_desc_inmueble">Descripción del inmueble</h2>
					<ul>
					'.$lista_descripcion.'
					</ul>
					</div><!-- grupo_info_detalle -->';
					}

					?>
					



				<?php  
				if(!empty($propiedad->cant_dormitorios)){

				
					$descripciones_dormitorios = json_decode($propiedad->descrip_dormitorios);

					foreach ( $descripciones_dormitorios as $descrip_dormitorio) {
						
						$info_dormitorios .= "<li>$descrip_dormitorio</li>";
					}
					echo '
					<div class="grupo_info_detalle">
					<h2 class="icono_dormitorios">Dormitorios</h2>
					<ul>
						<li>Cantidad:<span>'.$propiedad->cant_dormitorios.'</span> </li>
						'.$info_dormitorios.'
					</ul>
				</div><!-- grupo_info_detalle -->

				';


				}
				?>



				<div class="grupo_info_detalle">
					<h2 class="icono_desc_complementaria">Descripción complementaria</h2>
					<ul>
						<?php  

						if(!empty($propiedad->expensas)){ echo '<li>Expensas:<span>'.$propiedad->expensas.'</span> </li>';}
						if(!empty($propiedad->abl)){ echo '<li>ABL:<span>'.$propiedad->abl.'</span> </li>';}
						if(!empty($propiedad->arba)){ echo '<li>Arba:<span>'.$propiedad->arba.'</span> </li>';}
						if(!empty($propiedad->tipo_piso)){ echo '<li>Tipo de piso:<span>'.$propiedad->tipo_piso.'</span> </li>';}
						if(!empty($propiedad->calefaccion)){ echo '<li>Calefacci&oacute;n:<span>'.$propiedad->calefaccion.'</span> </li>';}
						if(!empty($propiedad->aire_acondicionado)){ echo '<li>Aire acondicionado:<span>'.$propiedad->aire_acondicionado.'</span> </li>';}
						if(!empty($propiedad->agua_caliente)){ echo '<li>Agua Caliente:<span>'.$propiedad->agua_caliente.'</span> </li>';}
						if(!empty($propiedad->entrada_servicio)){ echo '<li>Entrada de servicio:<span>'.$propiedad->entrada_servicio.'</span> </li>';}
						if(!empty($propiedad->doble_circulacion)){ echo '<li>Doble circulación:<span>'.$propiedad->doble_circulacion.'</span> </li>';}
						if(!empty($propiedad->orientacion)){ echo '<li>Orientación:<span>'.$propiedad->orientacion.'</span> </li>';}
						if(!empty($propiedad->condicion)){ echo '<li>Entrada de servicio:<span>'.$propiedad->condicion.'</span> </li>';}
						if(!empty($propiedad->apto_profesional)){ echo '<li>Apto profesional:<span>'.$propiedad->apto_profesional.'</span> </li>';}
						if(!empty($propiedad->sum)){ echo '<li>SUM:<span>'.$propiedad->sum.'</span> </li>';}
						if(!empty($propiedad->antiguedad)){ echo '<li>Antig&uuml;edad:<span>'.$propiedad->antiguedad.'</span> </li>';}
						if(!empty($propiedad->estado)){ echo '<li>Estado:<span>'.$propiedad->estado.'</span> </li>';}
						if(!empty($propiedad->ascensor)){ echo '<li>Ascensor:<span>'.$propiedad->ascensor.'</span> </li>';}
						if(!empty($propiedad->otros_servicios)){ echo '<li>Otros Servicios:<span>'.$propiedad->otros_servicios.'</span> </li>';}
						if(!empty($propiedad->observaciones)){ echo '<li>Observaciones:<span>'.$propiedad->observaciones.'</span> </li>';}


						?>
					</ul>
				</div><!-- grupo_info_detalle -->



			</div><!-- descripcion_detallada -->

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
	        loadingImage : '<?php echo base_url("public_folder/front/src/loading.gif"); ?>',
	        closeImage   : '<?php echo base_url("public_folder/front/src/closelabel.png"); ?>'
	      })
	    })
	</script>
	<!-- Facebox -->


	<?php include_once("inc/g_analytics.php"); ?>



</body>
</html>