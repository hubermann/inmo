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

			<br /><br /><br />
			<h1>Nuestros <span>Contactos</span></h1>


			<div id="contenedor_formulario">        

			    <form id="formulario_validar" name="formulario_validar" method="post" action="#">
			    
			    
			    <div class="columna_divide_campos">

				    <label for="nombre" class="nombre_campos">Nombre:</label> 
				    <input name="nombre" id="nombre" type="text" class="campos required">
				    <label class="error" for="nombre" id="nombre_error">Debe completar este campo</label>

				    <label for="email" class="nombre_campos">E-mail:</label>         
			    	<input name="email" id="email" type="text" class="campos required email"> 
			    	<label class="error" for="email" id="error_vacio">Debe completar este campo</label>  
			    	<label class="error" for="email" id="error_formato">Formato de mail no valido</label> 

			    </div><!-- columna_divide_campos -->

			    
			    <div class="columna_divide_campos">

			    	<label for="apellido"  class="nombre_campos">Apellido:</label>        
				    <input name="apellido" id="apellido" type="text" class="campos required">
				    <label class="error" for="apellido" id="apellido_error">Debe completar este campo</label>

				    <label for="phone"  class="nombre_campos">Tel&eacute;fono:</label>        
				    <input name="phone" id="phone" type="text" class="campos required">
				    <label class="error" for="phone" id="phone_error">Debe completar este campo</label>
				    

			    </div><!-- columna_divide_campos -->


			    	<label for="consulta" class="nombre_campos">Mensaje:</label>
				    <textarea  id="consulta" name="consulta" class="campos consulta required"></textarea>
				    <label class="error consulta" for="consulta" id="consulta_error">Debe completar este campo</label>
			    
			    
			    <input type="submit"  name="submit" class="bt_enviar" value="ENVIAR"></input>             
			    
			    </form>
			            
			</div><!--contenedor_formulario-->



			<div id="contiene_sucursales_contacto">

				<div class="cada_sucursal">
					<a href="#mapa" class="bt_ver_mapa anchorLink" id="ver_nunez" title=""></a>
					<p>
						<span>Nuñez</span><br />
						Ramallo 2300 esq. Vuelta De Obligado<br />
						<span class="tel_contacto">4704-6925 .  4703-1425</span><br />
						<a href="mailto:info@martincesarsky.com.ar">info@martincesarsky.com.ar</a>
					</p>
				</div><!-- cada_sucursal -->


				<div class="cada_sucursal">
					<a href="#mapa" class="bt_ver_mapa anchorLink" id="ver_san_isidro" title=""></a>
					<p>
						<span>San Isidro</span><br />
						Blanco Encalada 2269, La Horqueta<br />
						<span class="tel_contacto">4737-4545/4646 </span><br />
						<a href="mailto:zonanorte@martincesarsky.com.ar">zonanorte@martincesarsky.com.ar</a>
					</p>
				</div><!-- cada_sucursal -->


				<div class="cada_sucursal">
					<a href="#mapa" class="bt_ver_mapa anchorLink" id="ver_pilar" title=""></a>
					<p>
						<span>Pilar</span><br />
						La Rioja 1500, Barrio El Mirasol, Villa Rosa, altura Km. 50 <br />
						<span class="tel_contacto">(011) 152 311 4809</span><br />
						<a href="mailto:sucursalpilar@martincesarsky.com.ar">sucursalpilar@martincesarsky.com.ar</a>
					</p>
				</div><!-- cada_sucursal -->
				
			</div><!-- contiene_sucursales_contacto -->



			<div id="contiene_googlemaps">

				<div id="mapa">
					<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3286.4396733889457!2d-58.4714587!3d-34.5424216!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x95bcb6a267a4b957%3A0x2c29ca2e12b76111!2sRamallo+2300%2C+C1429DUL+CABA!5e0!3m2!1ses!2sar!4v1434063627243" width="960" height="350" frameborder="0" style="border:0"></iframe>
				</div><!-- mapa -->
			</div><!-- contiene_googlemaps-->

		</section>



	</div><!--wrapper-->


	<div id="wrapper_footer">
		<?php include_once("inc/footer.php"); ?>
	</div> <!--wrapper_footer-->


	<?php include_once("inc/js.php"); ?>

	<!--animar anclas-->
	<script src="<?php echo base_url('public_folder/front/js/anchor.jquery.js'); ?>" type="text/javascript"></script>
	
	
	<?php include_once("inc/g_analytics.php"); ?>


</body>
</html>