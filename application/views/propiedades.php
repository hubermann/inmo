<?php include_once("inc/charset.php"); ?>
<!DOCTYPE html>
<html lang="es">
<head>
	<?php include_once('inc/metas.php') ?>
	<title><?php include_once('inc/title.php') ?></title>

	
	<?php include_once('inc/css.php') ?>

	<!--Rino slider (home)-->
	<link type="text/css" rel="stylesheet" href="layout/rhinoslider-1.05.css" />
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
			<h1>Nuestras <span>Propiedades</span></h1>


			<div id="contenedor_opciones_filtros">

				<div id="encabezado_filtros">
					ORDENAR POR
				</div>



					<div id="content_form_filtros">

<form id="form_buscador_general" name="form_buscador_general" method="post" action="<?php echo base_url('propiedades'); ?>">


	<div class="grupo_info_form_filtros grupo_tipo_prop">
		<label for="tipo_propiedad"  class="label_campos_filtros tipo_prop">TIPO DE PROPIEDAD</label><br />
		<div class="selectwrap">
			<select name="tipo_propiedad_f" id="tipo_propiedad" class="select limita_ancho_select">
			<option value="">Seleccione</option>
		        <?php  
				        foreach ($categorias as $categoria) {
				        	$sel1="";
				        	if($this->session->userdata('filtro_tipo_propiedad') == $categoria->id){$sel1="selected";}
				        	echo '<option value="'.$categoria->id.'" '.$sel1.'>'.$categoria->nombre.'</option>';
				        }
				        ?>
    		</select> 
    	</div><!-- selectwrap  -->    
	</div><!-- grupo_info_form_filtros -->




	
	<div class="grupo_info_form_filtros grupo_barrio_filtro">

	
    	<label for="barrio_filtro" class="label_campos_filtros label_barrio_filtro">UBICACI&Oacute;N</label><br />
    	<a id="MostrarBarriosFiltros">Seleccione</a> 	

    	<!--  DIV CON BARRIOS	 -->		    
		<div class="barriosdivfiltros" style="display:none;">
			<?php echo $barrios_div; ?>
		</div>
		</select>   
	</div><!-- grupo_info_form_filtros -->



	<div class="grupo_info_form_filtros grupo_precio">
		<label for="precio"  class="label_campos_filtros precio">PRECIO</label><br />
		<div class="selectwrap">
    			<select name="filtro_precio" id="filtro_precio" class="select limita_ancho_select">
		        <option value="">Indistinto</option>

		        <option value="alto_bajo" <?php if($this->session->userdata('filtro_precio') == "alto_bajo"){echo "selected";} ?>>Mas alto primero</option>
		        <option value="bajo_alto" <?php if($this->session->userdata('filtro_precio') == "bajo_alto"){echo "selected";} ?>>Más bajo primero</option>
    		</select>
    	 </div><!-- selectwrap  -->      
	</div><!-- grupo_info_form_filtros -->



	<div class="grupo_info_form_filtros grupo_transaccion">
		<label for="transaccion" class="label_campos_filtros transaccion">TRANSACCI&Oacute;N</label><br />
		<div class="selectwrap">
    		<select name="transaccion" id="transaccion" class="select limita_ancho_select">
		    	<option value="" selected>Indistinto</option>
		    	<?php 

		    		foreach ($tipos_transaccion_db as $tipo) {
		    			$sel3="";
						if($this->session->userdata('filtro_transaccion') == $tipo->id){$sel3="selected";}
						echo '<option value="'.$tipo->id.'" '.$sel3.'>'.$tipo->nombre.'</option>';
					}

				?>

    		</select>
    	</div><!-- selectwrap  -->  
	</div><!-- grupo_info_form_filtros -->



	<div class="grupo_info_form_filtros grupo_cant_dorm">
		<label for="cant_dorm"  class="label_campos_filtros cant_dorm">CANTIDAD DE DORMITORIOS</label><br />
		<div class="selectwrap">
    		<select name="cant_dorm" id="cant_dorm" class="select limita_ancho_select">
		    	<option value="" >Indistinto</option>
				<?php  
				$cantidad_dormitorios = $this->config->item('cant_dormitorios');
				var_dump($cantidad_dormitorios);
				foreach ($cantidad_dormitorios as $canti_dormitorios) {
					if($canti_dormitorios!=0){
						$sel2="";
						if($this->session->userdata('filtro_cant_dorm') == $canti_dormitorios){$sel2="selected";}
						echo '<option value="'.$canti_dormitorios.'" '.$sel2.'>'.$canti_dormitorios.'</option>';
					}
				}
				?>

    		</select>
    	</div><!-- selectwrap  -->   

    	<input type="submit" name="submit" class="bt_buscar_propiedades filtros" value="ORDENAR">   
	</div><!-- grupo_info_form_filtros -->


</form>
					</div><!-- content_form_filtros -->




			</div><!-- contenedor_opciones_filtros -->
		

	<style>
		.conntent_prop_ind_home.chico{height: 290px;}
	</style>



			<!--*********************************** Fila de 4 propiedades *******************************-->

			<div class="filas_propiedades">
				<?php  
				$counter_p=0;
				if($propiedades){
				foreach ($propiedades as $propiedad) {
					/* IMAGEN */
					$imagen_principal = "";

					//new
					$img_name = $this->imagenes_propiedad->traer_una($propiedad->id);
					
					if($img_name->filename!=""){$imagen_principal = '<img src="'.base_url('images-propiedades/'.$img_name->filename).'" alt="">';}

					/*
					if(!empty($propiedad->main_image)){
						$img_name = $this->imagenes_propiedad->get_filename($propiedad->main_image);


						if($img_name!=""){$imagen_principal = '<img src="'.base_url('images-propiedades/'.$img_name).'" alt="">';}
					}
					*/


					/* BARRIO */
					$nombre_barrio = $this->barrio->traer_nombre($propiedad->barrio);

					/* BARRIO */
					$barrio = str_replace("CABA - ", "", $nombre_barrio);
					$barrio = str_replace("GBA - ", "", $barrio);
					/* TIPO PROPIEDAD */
					//$tipo_propiedad = $categorias[$propiedad->categoria_id];
					$tipo_propiedad = $this->categoria->traer_nombre($propiedad->categoria_id);
					/* TIPO TRANSACCION */
					$tipo_transaccion = $tipos_transaccion[$propiedad->tipo_transaccion];

					$vendido=""; if($propiedad->vendido==1){$vendido = '<div class="cartel_rv vendido chico"></div>';}
					$reservado=""; if($propiedad->reservado==1){$reservado = '<div class="cartel_rv reservado chico"></div>';}
					echo '
					<div class="conntent_prop_ind_home chico">
						<a href="'.base_url('propiedad/'.$propiedad->id).'" class="img_bt_vermas chico">
							<div class="content_thumb chico">
								'.$vendido.'
								'.$reservado.'
								'.$imagen_principal.'
							</div><!-- content_thumb -->
							<div class="bt_vermas_prop chico">
								+
							</div><!-- bt_vermas_prop -->
						</a><!-- img_bt_vermas -->

						<div class="info_inferior_thumb">
							<h2>'.$propiedad->direccion.'</h2>
							<p>
								<span>'.$barrio.'</span> <br />
								'.$tipo_propiedad.' '.$tipo_transaccion.'<br />
								Superficie total: '.$propiedad->sup_t_total.'m2<br />
								<span class="precio_listado_prop">'.$propiedad->moneda.' '.number_format($propiedad->precio).'</span>
							</p>
						</div><!-- info_inferior_thumb -->
					</div><!-- conntent_prop_ind_home -->
					';
					$counter_p++;
					if($counter_p == 4){
						echo '
			</div><!-- filas_propiedades -->

			<!--*********************************** Fila de 4 propiedades *******************************-->
			<div class="filas_propiedades">';
				$counter=0;
				}
				$tipo_propiedad="";
				$tipo_transaccion="";
				}
				}else{
					echo '<h3>No se encuentran publicaciones.</h3>';
				}
				?>							
			</div><!-- filas_propiedades --> 



		<?php  
		if($pagination_links!=""){
			echo '<div id="paginado">
					<ul>
						'.$pagination_links.'
					</ul>
				</div>';
		}

		?>
				
		

		</section>



	</div><!--wrapper-->


	<div id="wrapper_footer">
		<?php include_once("inc/footer.php"); ?>
	</div> <!--wrapper_footer-->


	<?php include_once("inc/js.php"); ?>

	<?php include_once("inc/g_analytics.php"); ?>
</body>
</html>

