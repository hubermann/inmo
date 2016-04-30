<style>
	.row_divisor{width: 50%; float: left; }
	select{width: 100%;}
</style>

<style type="text/css">
	#mapa_draw{ height: 300px;}
	#getCords{padding: .4em 1em .4em 1em; background: #999; float: left;margin: 0 0 0 .3em; color: #fff;}
	#maininput{float: left; width: 100%;}
	#maininput input[type="text"] {width: 90%;padding-right: 50px; float: left;}
	#maininput span {width: 50px;}
	#mapa_draw{ height: 400px; width: 100%; margin-top: .5em}
	#coordenadas_mapa #coordenadas{width: 310px; float: left; margin: .3em;}
	#latFld{visibility: hidden;}
	#lngFld{visibility: hidden;}
	#coordenadas{width: 500px; padding: .1em; color: #ccc; font-size: 11px}
	.subtitulos{color: #ddd; padding-bottom:.3em;margin-top: .8em; border-bottom: 1px solid #ddd}
</style>

<!-- API from google -->


<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&libraries=places"></script>


<script type="text/javascript">
if(navigator.onLine){
		//Auto complete function for address input
        function initialize() {
        var address = (document.getElementById('input_direccion'));
        var autocomplete = new google.maps.places.Autocomplete(address);
        autocomplete.setTypes(['geocode']);
        google.maps.event.addListener(autocomplete, 'place_changed', function() {
            var place = autocomplete.getPlace();
            if (!place.geometry) {
                return;
            }

        var address = '';
        if (place.address_components) {
            address = [
                (place.address_components[0] && place.address_components[0].short_name || ''),
                (place.address_components[1] && place.address_components[1].short_name || ''),
                (place.address_components[2] && place.address_components[2].short_name || '')
                ].join(' ');
        }
      });
	}
function codeAddress() {
    geocoder = new google.maps.Geocoder();
    var address = document.getElementById("input_direccion").value;
    geocoder.geocode( { 'address': address}, function(results, status) {
      if (status == google.maps.GeocoderStatus.OK) {


      latitud = results[0].geometry.location.lat();
      longitud = results[0].geometry.location.lng();

		var myLatlng = new google.maps.LatLng(parseFloat(latitud),parseFloat(longitud));
		ubicarMarcador(myLatlng);
		document.getElementById("latFld").value = parseFloat(latitud);
        document.getElementById("lngFld").value = parseFloat(longitud);
      }

      else {
      	//var divNotificacion = document.getElementById("div-notificacion");
      //document.getElementById("input_direccion").value = "No se encuentra direccion";
     // divNotificacion.innerHTML='No se encunetra';
      }
    });
  }
google.maps.event.addDomListener(window, 'load', initialize);

//draw map
var map;
var arrayMarcadores = [];

function initMap()
{
    var latlng = new google.maps.LatLng(-34.604603,-58.45852);
    var myOptions = {
        zoom: 11,
        center: latlng,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    map = new google.maps.Map(document.getElementById("mapa_draw"), myOptions);

    //agrego evento para manejar clicks sobre el mapa
    google.maps.event.addListener(map, "click", function(event)
    {

        // agrego marcador
        ubicarMarcador(event.latLng);

        // Muestro coordenadas en inputs de solo lectura.
        document.getElementById("latFld").value = event.latLng.lat();
        document.getElementById("lngFld").value = event.latLng.lng();
    });



}


//Agrego marcador al hacer click sobre el mapa
function ubicarMarcador(location) {


    // Remuevo marcadores
    limpiarMarcadores();

    var marker = new google.maps.Marker({
        position: location,
        map: map
    });


    // Mostrar direccion en el input, al hacer click en mapa.
    var geocoder = new google.maps.Geocoder();
    geocoder.geocode({"latLng":location}, function (results, status) {

    	if (status == google.maps.GeocoderStatus.OK) {

    	var lat = results[0].geometry.location.lat(),lng = results[0].geometry.location.lng(),placeName = results[0].address_components[0].long_name,latlng = new google.maps.LatLng(lat, lng);


     	document.getElementById("input_direccion").value = results[0].formatted_address;

     }
    });

    // add marker in markers array
    arrayMarcadores.push(marker);

    // Muestro coordenas en inputs
    document.getElementById("latFld").value = location.lat();
    document.getElementById("lngFld").value = location.lng();
    document.getElementById("coordenadas").value = location;

    //muevo centro del mapa
    map.panTo(location);
}


// limpio marcadores
function limpiarMarcadores() {
    if (arrayMarcadores) {
        for (i in arrayMarcadores) {
            arrayMarcadores[i].setMap(null);
        }
    arrayMarcadores.length = 0;
    }
}




	function show_preview(input) {
	if (input.files && input.files[0]) {
	var reader = new FileReader();
	reader.onload = function (e) {
	$('#previewImg').html('<img src="'+e.target.result+'" width="140" />' );
	}
	reader.readAsDataURL(input.files[0]);
	}
}

}else{
	alert('Sin conexion a internet!');
}
</script>

<style>
	#coordenadas{display: none;}
</style>

<?php  

$attributes = array('class' => 'form-horizontal', 'id' => 'new_propiedad');
echo form_open_multipart(base_url('control/propiedades/create/'),$attributes);

echo form_hidden('propiedad[id]');

?>
<legend><?php echo ucfirst($title) ?></legend>
<div class="well well-large well-transparent">

<div class="row">
	<div class="col-md-12"><h4 class="subtitulos">Sucursal</h4></div>
</div>
<div class="row">
	

	<div class="col-md-4">
		<!-- Text input-->
			<div class="control-group">
			<label class="control-label">Sucursal</label>
			<div class="controls">

			<select name="sucursal_id" id="sucursal_id">
				<?php  

					$sucursales = $this->sucursal->get_records_menu();
					if($sucursales){

						foreach ($sucursales as $sucursal) {

							echo '<option value="'.$sucursal->id.'">'.$sucursal->nombre.'</option>';
						}

					}

				?>
			</select>
			<?php echo form_error('sucursales_id','<p class="error">', '</p>'); ?>
			</div>
			</div>
	</div>
	<div class="col-md-4"></div>
	<div class="col-md-4"></div>


</div>



<div class="row">
	<div class="col-md-12"><h4 class="subtitulos">Informacion general</h4></div>
</div>
<div class="row">


	<div class="col-md-4">
		<!-- Text input-->
			<div class="control-group">
			<label class="control-label">Tipo propiedad</label>
			<div class="controls">

			<select name="categoria_id" id="categoria_id">
				<?php  

					$categorias = $this->categoria->get_records_menu();
					if($categorias){

						foreach ($categorias as $value) {
							echo '<option value="'.$value->id.'">'.$value->nombre.'</option>';
						}

					}

				?>
			</select>
			<?php echo form_error('categoria_id','<p class="error">', '</p>'); ?>
			</div>
			</div>
	</div>

	<div class="col-md-2">
		<!-- Text input-->
		<div class="control-group">
		<label class="control-label">Transaccion</label>
		<div class="controls">
		<select name="tipo_transaccion" id="tipo_transaccion">
		<?php  

			$tipos_transaccion = $this->tipos_transaccion->get_records_menu();
			if($tipos_transaccion){

				foreach ($tipos_transaccion as $tipo_trans) {
					echo '<option value="'.$tipo_trans->id.'">'.$tipo_trans->nombre.'</option>';
				}

			}

		?>
		</select>
		<?php echo form_error('tipo_transaccion','<p class="error">', '</p>'); ?>
		</div>
		</div>
	</div>
	
	<div class="col-md-2">
		<!-- Text input-->
		<div class="control-group">
		<label class="control-label">Zona</label>
		<div class="controls">

		


		<?php  echo form_dropdown('localidad', $this->config->item('localidad'), $this->input->post('localidad'), 'id = localidad');?>
		<?php echo form_error('localidad','<p class="error">', '</p>'); ?>
		</div>
		</div>
	</div>


	<div class="col-md-4">
		<!-- Text input-->
		<div class="control-group">
		<label class="control-label">Barrio / Localidad</label>
		<div class="controls">
		<?php  #echo form_dropdown('barrio', $this->config->item('barrio'), $this->input->post('barrio'), 'id = barrio');?>
		<select name="barrio" id="barrio">
		<?php  

			$barrios = $this->barrio->get_records_menu();

			if($barrios){

				foreach ($barrios as $barrio) {
					echo '<option value="'.$barrio->id.'">'.$barrio->nombre.'</option>';
				}

			}

		?>
		</select>

		<?php echo form_error('barrio','<p class="error">', '</p>'); ?>
		</div>
		</div>
	</div>

</div>




			<div class="row">
				<div class="col-md-4">
					<!-- Text input-->
					<div class="control-group">
					<label class="control-label">Codigo</label>
					<div class="controls">
					<input value="<?php echo set_value('codigo'); ?>" class="form-control" type="text" name="codigo" />
					<?php echo form_error('codigo','<p class="error">', '</p>'); ?>
					</div>
				</div>

				</div>
				<!-- <div class="col-md-3">
					<div class="control-group">
					<label class="control-label">Condicion</label>
					<div class="controls">
					<?php  echo form_dropdown('condiciones_propiedad', $this->config->item('condiciones_propiedad'), $this->input->post('condiciones_propiedad'), 'id = condiciones_propiedad');?>
					<?php echo form_error('condiciones_propiedad','<p class="error">', '</p>'); ?>
					</div>
					</div>
				</div>-->

				<div class="col-md-4">
					<!-- Text input-->
					<div class="control-group">
					<label class="control-label">Moneda</label>
					<div class="controls">
					<?php  echo form_dropdown('moneda', $this->config->item('moneda'), $this->input->post('moneda'), 'id = moneda');?>
					<?php echo form_error('moneda','<p class="error">', '</p>'); ?>
					</div>
					</div>
				</div>
				<div class="col-md-4">
					<!-- Text input-->
					<div class="control-group">
					<label class="control-label">Precio <small>(sin comas/puntos)</small></label>
					<div class="controls">
					<input value="<?php echo set_value('precio'); ?>" class="form-control" type="text" name="precio" id="precio" />
					<?php echo form_error('precio','<p class="error">', '</p>'); ?>
					</div>
					</div>
				</div>
			</div>


			<div class="row">
			<div class="col-md-12">
			<!-- Text input-->
			<div class="control-group">
			<label class="control-label">Direccion</label>
			<div class="controls">
			<input value="<?php echo set_value('direccion'); ?>" class="form-control" type="text" name="direccion" id="direccion" />
			<?php echo form_error('direccion','<p class="error">', '</p>'); ?>
			</div>
			</div>

			</div>
			</div>



			<!-- Text input-->
			<div class="control-group">
			<label class="control-label">Direccion mapa <span class="btn btn-xs btn-default" data-toggle="modal" data-target="#ayudadireccion">( ? )</span></label>
			<div id="maininput">
			<div id="div-notificacion"></div>
			<input type="text" name="input_direccion" id="input_direccion" class="form-control"  placeholder="Ingrese direccion a buscar.">
			<p id="getCords" onClick="codeAddress();" class="btn">>></p>
			</div>

				<!-- MAPA -->
				<div id="mapa_draw"></div>

				<!-- COORDENADAS -->
				<div id="coordenadas_mapa">
				
				<input type="text" id="coordenadas" name="coordenadas" class="form-control"  readonly="true" value="<?php echo set_value('coordenadas'); ?>">
				<input type="text" id="latFld" readonly="true">
				<input type="text" id="lngFld" readonly="true">
				</div>

				<?php echo form_error('mapa','<p class="error">', '</p>'); ?>
			<br />
			</div>



			
			
			
<div class="row">
	<div class="col-md-12"><h4 class="subtitulos">Superficies aproximadas</h4></div>
</div>
			
			<div class="row">
				<div class="col-md-2">
					<!-- Text input-->
					<div class="control-group">
					<label class="control-label">Lote</label>
					<div class="controls">
					<input id="sup_lote" value="<?php echo set_value('sup_lote'); ?>" class="form-control" type="text" name="sup_lote" />
					<?php echo form_error('sup_lote','<p class="error">', '</p>'); ?>
					</div>
					</div>
				</div>
				<div class="col-md-3">
					<!-- Text input-->
					<div class="control-group">
					<label class="control-label">Descubierta</label>
					<div class="controls">
					<input id="sup_descubierta" value="<?php echo set_value('sup_descubierta'); ?>" class="form-control" type="text" name="sup_descubierta" />
					<?php echo form_error('sup_descubierta','<p class="error">', '</p>'); ?>
					</div>
					</div>
				</div>
				<div class="col-md-3">
					<!-- Text input-->
					<div class="control-group">
					<label class="control-label">Cubierta</label>
					<div class="controls">
					<input id="sup_cubierta" value="<?php echo set_value('sup_cubierta'); ?>" class="form-control" type="text" name="sup_cubierta" />
					<?php echo form_error('sup_cubierta','<p class="error">', '</p>'); ?>
					</div>
					</div>
				</div>
				<div class="col-md-2">
					<!-- Text input-->
					<div class="control-group">
					<label class="control-label">Semi-cubierta</label>
					<div class="controls">
					<input id="sup_semi_cubierta" value="<?php echo set_value('sup_semi_cubierta'); ?>" class="form-control" type="text" name="sup_semi_cubierta" />
					<?php echo form_error('sup_semi_cubierta','<p class="error">', '</p>'); ?>
					</div>
					</div>
				</div>
				<div class="col-md-2">
					<!-- Text input-->
					<div class="control-group">
					<label class="control-label">Total</label>
					<div class="controls">
					<input id="sup_t_total" value="<?php echo set_value('sup_t_total'); ?>" class="form-control" type="text" name="sup_t_total" />
					<?php echo form_error('sup_t_total','<p class="error">', '</p>'); ?>
					</div>
					</div>
				</div>
			</div>

<div class="row">
	<div class="col-md-12"><h4 class="subtitulos">Descripcion del inmueble</h4></div>
</div>


			<div class="row">
				<div class="col-md-4">
					<!-- Text input-->
					<div class="control-group">
					<label class="control-label">Palier</label>
					<div class="controls">
					<input value="<?php echo set_value('palier_privado'); ?>" class="form-control" type="text" name="palier_privado" />
					<?php echo form_error('palier_privado','<p class="error">', '</p>'); ?>
					</div>
					</div>
				</div>
				<div class="col-md-4">
					<!-- Text input-->
					<div class="control-group">
					<label class="control-label">Hall de entrada</label>
					<div class="controls">
					<input value="<?php echo set_value('hall_de_entrada'); ?>" class="form-control" type="text" name="hall_de_entrada" />
					<?php echo form_error('hall_de_entrada','<p class="error">', '</p>'); ?>
					</div>
					</div>
				</div>
				<div class="col-md-4">
					<!-- Text input-->
					<div class="control-group">
					<label class="control-label">Living</label>
					<div class="controls">
					<input value="<?php echo set_value('living'); ?>" class="form-control" type="text" name="living" />
					<?php echo form_error('living','<p class="error">', '</p>'); ?>
					</div>
					</div>
				</div>
			</div>

			
			
			

			<div class="row">
				<div class="col-md-4">
					<!-- Text input-->
					<div class="control-group">
					<label class="control-label">Comedor</label>
					<div class="controls">
					<input value="<?php echo set_value('comedor'); ?>" class="form-control" type="text" name="comedor" />
					<?php echo form_error('comedor','<p class="error">', '</p>'); ?>
					</div>
					</div>
				</div>
				<div class="col-md-4">
					<!-- Text input-->
					<div class="control-group">
					<label class="control-label">Toilette</label>
					<div class="controls">
					<input value="<?php echo set_value('toilette'); ?>" class="form-control" type="text" name="toilette" />
					<?php echo form_error('toilette','<p class="error">', '</p>'); ?>
					</div>
					</div>
				</div>
				<div class="col-md-4">
					<!-- Text input-->
					<div class="control-group">
					<label class="control-label">Cantidad de ba&ntilde;os</label>
					<div class="controls">
					<input value="<?php echo set_value('cant_banos'); ?>" class="form-control" type="text" name="cant_banos" />
					<?php echo form_error('cant_banos','<p class="error">', '</p>'); ?>
					</div>
					</div>
				</div>
			</div>


			
			
			

			<div class="row">
				<div class="col-md-4">
					<!-- Text input-->
					<div class="control-group">
					<label class="control-label">Cocina</label>
					<div class="controls">
					<input value="<?php echo set_value('cocina'); ?>" class="form-control" type="text" name="cocina" />
					<?php echo form_error('cocina','<p class="error">', '</p>'); ?>
					</div>
					</div>
				</div>
				<div class="col-md-4">
					<!-- Text input-->
					<div class="control-group">
					<label class="control-label">Comedor diario</label>
					<div class="controls">
					<input value="<?php echo set_value('comedor_diario'); ?>" class="form-control" type="text" name="comedor_diario" />
					<?php echo form_error('comedor_diario','<p class="error">', '</p>'); ?>
					</div>
					</div>
				</div>
				<div class="col-md-4">
					<!-- Text input-->
					<div class="control-group">
					<label class="control-label">Lavadero</label>
					<div class="controls">
					<input value="<?php echo set_value('lavadero'); ?>" class="form-control" type="text" name="lavadero" />
					<?php echo form_error('lavadero','<p class="error">', '</p>'); ?>
					</div>
					</div>
				</div>
			</div>


			<div class="row">
				<div class="col-md-4">
					<!-- Text input-->
					<div class="control-group">
					<label class="control-label">Habitacion de servicio</label>
					<div class="controls">
					<input value="<?php echo set_value('hab_servicio'); ?>" class="form-control" type="text" name="hab_servicio" />
					<?php echo form_error('hab_servicio','<p class="error">', '</p>'); ?>
					</div>
					</div>
				</div>
				<div class="col-md-4">
					<!-- Text input-->
					<div class="control-group">
					<label class="control-label">Balcon</label>
					<div class="controls">
					<input value="<?php echo set_value('balcon'); ?>" class="form-control" type="text" name="balcon" />
					<?php echo form_error('balcon','<p class="error">', '</p>'); ?>
					</div>
					</div>
				</div>
				<div class="col-md-4">
					<!-- Text input-->
					<div class="control-group">
					<label class="control-label">Patio</label>
					<div class="controls">
					<input value="<?php echo set_value('segundo_balcon'); ?>" class="form-control" type="text" name="segundo_balcon" />
					<?php echo form_error('segundo_balcon','<p class="error">', '</p>'); ?>
					</div>
					</div>
				</div>
			</div>
			
			
			

			<div class="row">
				<div class="col-md-4">
					<!-- Text input-->
					<div class="control-group">
					<label class="control-label">Quincho</label>
					<div class="controls">
					<input value="<?php echo set_value('quincho'); ?>" class="form-control" type="text" name="quincho" />
					<?php echo form_error('quincho','<p class="error">', '</p>'); ?>
					</div>
					</div>
				</div>
				<div class="col-md-4">
					<!-- Text input-->
					<div class="control-group">
					<label class="control-label">Cochera</label>
					<div class="controls">
					<input value="<?php echo set_value('cochera'); ?>" class="form-control" type="text" name="cochera" />
					<?php echo form_error('cochera','<p class="error">', '</p>'); ?>
					</div>
					</div>
				</div>
				<div class="col-md-4">
					<!-- Text input-->
					<div class="control-group">
					<label class="control-label">Garage</label>
					<div class="controls">
					<input value="<?php echo set_value('garage'); ?>" class="form-control" type="text" name="garage" />
					<?php echo form_error('garage','<p class="error">', '</p>'); ?>
					</div>
					</div>
				</div>
			</div>


			
			
			

			<div class="row">
				<div class="col-md-4">
					<!-- Text input-->
					<div class="control-group">
					<label class="control-label">Baulera</label>
					<div class="controls">
					<input value="<?php echo set_value('baulera'); ?>" class="form-control" type="text" name="baulera" />
					<?php echo form_error('baulera','<p class="error">', '</p>'); ?>
					</div>
					</div>
				</div>
				<div class="col-md-4">
					<!-- Text input-->
					<div class="control-group">
					<label class="control-label">Parrilla</label>
					<div class="controls">
					<input value="<?php echo set_value('parrilla'); ?>" class="form-control" type="text" name="parrilla" />
					<?php echo form_error('parrilla','<p class="error">', '</p>'); ?>
					</div>
					</div>
				</div>
				<div class="col-md-4">
					<!-- Text input-->
					<div class="control-group">
					<label class="control-label">Piscina</label>
					<div class="controls">
					<input value="<?php echo set_value('piscina'); ?>" class="form-control" type="text" name="piscina" />
					<?php echo form_error('piscina','<p class="error">', '</p>'); ?>
					</div>
					</div>
				</div>
			</div>


			<div class="row">
				<div class="col-md-4">
					<!-- Text input-->
					<div class="control-group">
					<label class="control-label">Family</label>
					<div class="controls">
					<input value="<?php echo set_value('family'); ?>" class="form-control" type="text" name="family" />
					<?php echo form_error('family','<p class="error">', '</p>'); ?>
					</div>
					</div>
				</div>
				<div class="col-md-4">
					<!-- Text input-->
					<div class="control-group">
					<label class="control-label">Playroom</label>
					<div class="controls">
					<input value="<?php echo set_value('playroom'); ?>" class="form-control" type="text" name="playroom" />
					<?php echo form_error('playroom','<p class="error">', '</p>'); ?>
					</div>
					</div>
				</div>
				<div class="col-md-4">
					<!-- Text input-->
					<div class="control-group">
					<label class="control-label">Escritorio</label>
					<div class="controls">
					<input value="<?php echo set_value('escritorio'); ?>" class="form-control" type="text" name="escritorio" />
					<?php echo form_error('escritorio','<p class="error">', '</p>'); ?>
					</div>
					</div>
				</div>
			</div>

			


<div class="row">
	<div class="col-md-12"><h4 class="subtitulos">Dormitorios</h4></div>
</div>
	<div class="row">
		<div class="col-md-3">
			<!-- Text input-->
			<div class="control-group">
			<label class="control-label">Cantidad </label>
			<div class="controls">
			<?php  echo form_dropdown('cant_dormitorios', $this->config->item('cant_dormitorios'), $this->input->post('cant_dormitorios'), 'id = cant_dormitorios');?>
			<?php echo form_error('cant_dormitorios','<p class="error">', '</p>'); ?>
			</div>
			</div>
		</div>
		<div class="col-md-9">
			<!-- Text input-->
			<div class="control-group">
			<label class="control-label"> <span class="btn-link" onclick="add_field();">Agregar campos para descripcion de dormitorios +</span></label>
			<div class="controls">
			<div id="campos_dormitorios">
				<?php if($this->input->post('descrip_dormitorios')){
					$count_descrips = 1;
					foreach ($this->input->post('descrip_dormitorios') as $value_descripcion) {

						if($value_descripcion!=""){
							echo '<div class="wrap_descrip_dorm" id="descrip_dorm'.$count_descrips.'" ><label class="control-label">Descripcion dormitorio '.$count_descrips.' </label><input type="text" class="form-control"  name="descrip_dormitorios[]" value="'.$value_descripcion.'" id="descripcion_dormitorio['.$count_descrips.']"></div>';
							$count_descrips++;
						}
						
					
					}
					echo '<script>var valinput='.$count_descrips.';</script>';

					}else{
						echo '<script>var valinput=1;</script>';
					}


					?>
			</div>
			<!-- <input value="<?php echo set_value('descrip_dormitorios'); ?>" class="form-control" type="text" name="descrip_dormitorios" />
			<?php echo form_error('descrip_dormitorios','<p class="error">', '</p>'); ?> -->
			</div>
			</div>
		</div>
	</div>
			
<div class="row">
	<div class="col-md-12"><h4 class="subtitulos">Descripcion complementaria</h4></div>
</div>
<div class="row">
				<div class="col-md-4">
					<!-- Text input-->
					<div class="control-group">
					<label class="control-label">Expensas</label>
					<div class="controls">
					<input value="<?php echo set_value('expensas'); ?>" class="form-control" type="text" name="expensas" />
					<?php echo form_error('expensas','<p class="error">', '</p>'); ?>
					</div>
					</div>
				</div>
				<div class="col-md-2">
					<!-- Text input-->
					<div class="control-group">
					<label class="control-label">Abl</label>
					<div class="controls">
					<input value="<?php echo set_value('abl'); ?>" class="form-control" type="text" name="abl" />
					<?php echo form_error('abl','<p class="error">', '</p>'); ?>
					</div>
					</div>
				</div>
				<div class="col-md-2">
					<!-- Text input-->
					<div class="control-group">
					<label class="control-label">Arba</label>
					<div class="controls">
					<input value="<?php echo set_value('arba'); ?>" class="form-control" type="text" name="arba" />
					<?php echo form_error('arba','<p class="error">', '</p>'); ?>
					</div>
					</div>
				</div>
				<div class="col-md-4">
					<!-- Text input-->
					<div class="control-group">
					<label class="control-label">Tipo de piso</label>
					<div class="controls">
					<input value="<?php echo set_value('tipo_piso'); ?>" class="form-control" type="text" name="tipo_piso" />
					<?php echo form_error('tipo_piso','<p class="error">', '</p>'); ?>
					</div>
					</div>
				</div>
			</div>


			<div class="row">
				<div class="col-md-4">
					<!-- Text input-->
					<div class="control-group">
					<label class="control-label">Calefaccion</label>
					<div class="controls">
					<input value="<?php echo set_value('calefaccion'); ?>" class="form-control" type="text" name="calefaccion" />
					<?php echo form_error('calefaccion','<p class="error">', '</p>'); ?>
					</div>
					</div>
				</div>
				<div class="col-md-4">
					<!-- Text input-->
					<div class="control-group">
					<label class="control-label">Aire acondicionado</label>
					<div class="controls">
					<input value="<?php echo set_value('aire_acondicionado'); ?>" class="form-control" type="text" name="aire_acondicionado" />
					<?php echo form_error('aire_acondicionado','<p class="error">', '</p>'); ?>
					</div>
					</div>
				</div>
				<div class="col-md-4">
					<!-- Text input-->
					<div class="control-group">
					<label class="control-label">Agua caliente</label>
					<div class="controls">
					<input value="<?php echo set_value('agua_caliente'); ?>" class="form-control" type="text" name="agua_caliente" />
					<?php echo form_error('agua_caliente','<p class="error">', '</p>'); ?>
					</div>
					</div>
				</div>
			</div>
			
			
			
			
			
			

			<div class="row">
				<div class="col-md-4">
					<!-- Text input-->
					<div class="control-group">
					<label class="control-label">Entrada de servicio</label>
					<div class="controls">
					<input value="<?php echo set_value('entrada_servicio'); ?>" class="form-control" type="text" name="entrada_servicio" />
					<?php echo form_error('entrada_servicio','<p class="error">', '</p>'); ?>
					</div>
					</div>
				</div>
				<div class="col-md-4">
					<!-- Text input-->
					<div class="control-group">
					<label class="control-label">Doble circulacion</label>
					<div class="controls">
					<input value="<?php echo set_value('doble_circulacion'); ?>" class="form-control" type="text" name="doble_circulacion" />
					<?php echo form_error('doble_circulacion','<p class="error">', '</p>'); ?>
					</div>
					</div>
				</div>
				<div class="col-md-4">
					<!-- Text input-->
					<div class="control-group">
					<label class="control-label">Orientacion</label>
					<div class="controls">
					<?php  echo form_dropdown('orientacion', $this->config->item('orientacion'), $this->input->post('orientacion'), 'id = orientacion');?>
					
					<?php echo form_error('orientacion','<p class="error">', '</p>'); ?>
					</div>
					</div>
				</div>
			</div>


			
			
			
			

			<div class="row">
				<div class="col-md-4">
					<!-- Text input-->
					<div class="control-group">
					<label class="control-label">Otros</label>
					<div class="controls">
					<input value="<?php echo set_value('condicion'); ?>" class="form-control" type="text" name="condicion" />
					<?php echo form_error('condicion','<p class="error">', '</p>'); ?>
					</div>
					</div>
				</div>
				<div class="col-md-4">
					<!-- Text input-->
					<div class="control-group">
					<label class="control-label">Apto profesional</label>
					<div class="controls">
					<?php   echo form_dropdown('apto_profesional', $this->config->item('opciones_apto'), $this->input->post('apto_profesional'), 'id = apto_profesional');?>
					
					
					</div>
					</div>
				</div>
				<div class="col-md-4">
					<!-- Text input-->
					<div class="control-group">
					<label class="control-label">Sum</label>
					<div class="controls">
					<input value="<?php echo set_value('sum'); ?>" class="form-control" type="text" name="sum" />
					<?php echo form_error('sum','<p class="error">', '</p>'); ?>
					</div>
					</div>
				</div>
			</div>

			
			
			

			<div class="row">
				<div class="col-md-3">
					<!-- Text input-->
					<div class="control-group">
					<label class="control-label">Antiguedad</label>
					<div class="controls">
					<input value="<?php echo set_value('antiguedad'); ?>" class="form-control" type="text" name="antiguedad" />
					<?php echo form_error('antiguedad','<p class="error">', '</p>'); ?>
					</div>
					</div>
				</div>
				<div class="col-md-3">
					<!-- Text input-->
					<div class="control-group">
					<label class="control-label">Estado</label>
					<div class="controls">
					<input value="<?php echo set_value('estado'); ?>" class="form-control" type="text" name="estado" />
					<?php echo form_error('estado','<p class="error">', '</p>'); ?>
					</div>
					</div>
				</div>
				<div class="col-md-3">
					<!-- Text input-->
					<div class="control-group">
					<label class="control-label">Ascensor</label>
					<div class="controls">
					<input value="<?php echo set_value('ascensor'); ?>" class="form-control" type="text" name="ascensor" />
					<?php echo form_error('ascensor','<p class="error">', '</p>'); ?>
					</div>
					</div>
				</div>
				<div class="col-md-3">
					<!-- Text input-->
					<div class="control-group">
					<label class="control-label">Telefono</label>
					<div class="controls">
					<input value="<?php echo set_value('telefono'); ?>" class="form-control" type="text" name="telefono" />
					<?php echo form_error('telefono','<p class="error">', '</p>'); ?>
					</div>
					</div>
				</div>
			</div>	
			

	
<div class="row">
	
			<div class="col-md-12">
				<!-- Text input-->
			<div class="control-group">
			<label class="control-label">Otros servicios</label>
			<div class="controls">
			<textarea name="otros_servicios" id="otros_servicios" cols="30" rows="5" class="form-control"><?php echo set_value('otros_servicios'); ?></textarea>
			
			<?php echo form_error('otros_servicios','<p class="error">', '</p>'); ?>
			</div>
			</div>
			<!-- Text input-->
			<div class="control-group">
			<label class="control-label">Observaciones</label>
			<div class="controls">
			<textarea name="observaciones" class="form-control"  id="observaciones" cols="30" rows="10"><?php echo set_value('observaciones'); ?></textarea>
			<?php echo form_error('observaciones','<p class="error">', '</p>'); ?>
			</div>
			</div>
			</div>
</div>

<div class="row">
	<!-- Text input-->
	<div class="col-md-4">
		<div class="control-group">
		<label class="control-label">Destacada</label>
		<div class="controls">
		<?php  echo form_dropdown('destacada', $this->config->item('destacada'), $this->input->post('destacada'), 'id = destacada');?>
		<?php echo form_error('destacada','<p class="error">', '</p>'); ?>
		</div>
		</div>
	</div>
	<div class="col-md-4">
		<div class="control-group">
		<label class="control-label">Reservado</label>
		<div class="controls">
		
		<?php echo form_checkbox('reservado', '1');
		echo form_error('destacada','<p class="error">', '</p>'); ?>
		</div>
		</div>
	</div>
	<div class="col-md-4">
		<div class="control-group">
		<label class="control-label">Vendido</label>
		<div class="controls">
		<?php echo form_checkbox('vendido', '1'); 
		echo form_error('destacada','<p class="error">', '</p>'); ?>
		</div>
		</div>
	</div>
</div>
			

<div class="row">
	<div class="control-group">
	<label class="control-label"></label>
		<div class="controls">
			<button class="btn" type="submit">Crear</button>
		</div>
	</div>
</div>

</fieldset>
<?php echo form_close(); ?>
</div>



<!-- #ayudadireccion -->
<div id="ayudadireccion"  class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
<div class="modal-dialog modal-lg">
<div class="modal-content" style="background:#fff;">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
<h4 class="modal-title">Direccion y Direccion mapa.</h4>
</div>

<div class="modal-body">
	<div class="col-md-12">
	<!-- img big -->
	<p>La direccion real puede variar de acurdo a la direccion provista por Google Maps.</p>
	<p>La direccion a mostrarse es la ingresada en el campo "Direccion" la ingresada en "Direccion mapa" es solo para ubicar el marcador.</p>
</div>
<div class="modal-footer"></div>

</div>


</div>
</div>
</div>



<script type="text/javascript">
	window.onload = initMap();

	
	function add_field(){
		
		nuevoinput = '<p><label class="control-label">Descripcion dormitorio '+valinput+' </label><input type="text" class="form-control"  name="descrip_dormitorios[]" id="descripcion_dormitorio['+valinput+']"></p>';
		$('#campos_dormitorios').append(nuevoinput);
		valinput++;

	}


</script>