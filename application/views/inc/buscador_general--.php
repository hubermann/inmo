<?php  
				//$barrios = $this->config->item('barrio');
				$barrios = $this->barrio->get_records_front('barrio');
				var_dump($barrios);
				#var_dump($barrios);
				$barrios_caba="";
				$barrios_gba="";
				$barrios_filtro=""; //todos
				$barrios_div="";
				foreach ($barrios as $barrio) {
					$checked_barrio="";
					if(in_array($barrio, $this->session->userdata('filtro_barrio'))){$checked_barrio = "checked"; }
					$barrios_div .= '<div class="boxbarrio"><input type="checkbox" name="barrio[]" value="'.$barrio.'" '.$checked_barrio .'>'.$barrio.'</div>';
					
					$barrios_filtro .= '<div class="boxbarrio"><input type="checkbox" name="barrio[]" value="'.$barrio.'" '.$checked_barrio .'>'.$barrio.'</div>';
					if (strpos($barrio,'CABA') !== false) {
						$barrio = str_replace('CABA - ', "", $barrio);
						if(in_array($barrio, $this->session->userdata('filtro_barrio'))){$checked_barrio = "checked"; }
    					$barrios_caba .= '<div class="boxbarrio"><input type="checkbox" name="barrio[]" value="'.$barrio.'" '.$checked_barrio .'>'.$barrio.'</div>';
					}
					if (strpos($barrio,'GBA') !== false) {
						$barrio = str_replace('GBA - ', "", $barrio);
						if(in_array($barrio, $this->session->userdata('filtro_barrio'))){$checked_barrio = "checked"; }
    					$barrios_gba .= '<div class="boxbarrio"><input type="checkbox" name="barrio[]" value="'.$barrio.'" '.$checked_barrio .'>'.$barrio.'</div>';
    					
					}

				}
			
				?>

				<script>
				var barrios_caba = '<?php echo $barrios_caba; ?>';
				var barrios_gba = '<?php echo $barrios_gba; ?>';
				var barrios_filtro = '<?php echo $barrios_filtro; ?>';
				
				</script>


				<div id="wrapper_buscador_general">

	<div id="buscador_general">
		<img src="<?php echo base_url('public_folder/front/layout/img_compartidas_estetica/titulo_buscador.png'); ?>" height="100" width="227">

		<div id="content_form_buscador_general">

			<form id="form_buscador_general" name="form_buscador_general" method="post" action="<?php echo base_url('busqueda'); ?>">

				<div class="grupo_info_form tipo_transaccion">
				<!--<input type="radio" name="tipo_transaccion" value="">Indistinto-->
				<?php  
				$tipos_propiedad = $this->config->item('tipo_propiedad');
				$categorias = $this->categoria->get_records_menu();
				/** tipo de transaccion **/
					$tipos_transaccion_db = $this->tipos_transaccion->get_records_menu();
					$tipos_transaccion =array();
					foreach ($tipos_transaccion_db as $tipo) {
						$tipos_transaccion[$tipo->id] = $tipo->nombre;
						$selectedTipoTransaccion="";
						if($this->session->userdata('filtro_transaccion') == $tipo->id){$selectedTipoTransaccion="checked";}
						echo '<input type="radio" name="tipo_transaccion" value="'.$tipo->id.'" '.$selectedTipoTransaccion.'>'.$tipo->nombre;
					}
				?>

				</div><!-- grupo_info_form -->


		    	<div class="grupo_info_form">
		    		<label for="tipo_propiedad"  class="nombre_campos_buscador_general">TIPO DE PROPIEDAD</label><br />
		    		<select name="tipo_propiedad" id="tipo_propiedad" class="styled campos_buscador_general campo_160 select required">
				    	<option value="" selected>Elija una opción</option>
				        <?php  
				        foreach ($categorias as $categoria) {
				        	$selectedCategoria="";
				        	if($this->session->userdata('filtro_tipo_propiedad') == $categoria->id){$selectedCategoria="selected";}
				        	echo '<option value="'.$categoria->id.'" '.$selectedCategoria.'>'.$categoria->nombre.'</option>';
				        }
				        ?>
		    		</select>       
		    		<label class="error_buscador" for="tipo_propiedad" id="tipo_cliente_error">Elija un opción</label>
				</div><!-- grupo_info_form -->		    		

		    	<div class="grupo_info_form">
		    		<label for="zona"  class="nombre_campos_buscador_general">ZONA</label><br />
		    		<select onchange="checkbarrios();" name="localidad" id="zona" class="styled campos_buscador_general campo_160 select required" >
				    	<option value="" selected>Elija una opción</option>
				        <option value="CABA" <?php if($this->session->userdata('filtro_localidad') == 'CABA'){echo "selected";} ?>>CABA</option>
				        <option value="GBA" <?php if($this->session->userdata('filtro_localidad') == 'GBA'){echo "selected";} ?>>GBA</option>
		    		</select>       
		    		<label class="error_buscador" for="zona" id="tipo_cliente_error">Elija un opción</label>
				</div><!-- grupo_info_form -->



			

				<div class="grupo_info_form">
			    	<label for="barrio" class="nombre_campos_buscador_general">BARRIO</label><br />
		    		
		    		<!-- <select name="barrio" id="barrio" multiple="multiple" class="styled campos_buscador_general campo_160 select required">
				    	<option value="" selected>Elija una opción</option>
				        <option value="01">01</option>
				        <option value="02">02</option>
				        <option value="03">03</option>
		    		</select> -->

				<a id="MostrarBarrios">Seleccione</a>  


		    		<!-- <label class="error_buscador" for="barrio" id="tipo_cliente_error">Elija un opción</label> -->
				</div><!-- grupo_info_form -->


		    	<div class="grupo_info_form">
					<label for="rango_precios" class="nombre_campos_buscador_general">RANGO DE PRECIOS</label><br />     
					<input name="precios_desde" id="rango_precios" type="text" class="campos_buscador_general required rango_precios" placeholder="DESDE"
					<?php if($this->session->userdata('filtro_precio_desde') !=""){echo 'value="'.$this->session->userdata('filtro_precio_desde').'"';} ?>> 
					<input name="precios_hasta" id="rango_precios" type="text" class="campos_buscador_general required rango_precios" placeholder="HASTA"
					<?php if($this->session->userdata('filtro_precio_hasta') !=""){echo 'value="'.$this->session->userdata('filtro_precio_hasta').'"';} ?>> 
					<label class="error_buscador" for="rango_precios">Campo Obligatorio</label>  
				</div><!-- grupo_info_form -->		    
			           
			    

			    <div class="grupo_info_form texto_moneda">
			    	<label for="tipo_propiedad" class="nombre_campos_buscador_general">MONEDA</label><br />
			    	<input type="radio" name="moneda" value="$"<?php if( trim($this->session->userdata('filtro_moneda')) == '$'){echo "checked";} ?>>$
					<input type="radio" name="moneda" value="u$s" <?php if(trim($this->session->userdata('filtro_moneda')) == 'u$s'){echo "checked";} ?>>u$s
				</div><!-- grupo_info_form -->			    
<!--  DIV CON BARRIOS	 -->		    
<div class="barriosdiv" style="display:none;" id="barriosporzona">
	<?php echo $barrios_div; ?>
</div>



			    <div class="grupo_info_form tipo_transaccion">
			    	<input type="submit"  name="submit" class="bt_buscar_propiedades" value="BUSCAR"></input>             
			    </div><!-- grupo_info_form -->

			</form>
		</div><!-- content_form_buscador_general -->
	</div><!-- buscador_general -->
</div><!-- wrapper_buscador_general -->

