

 <script type="text/javascript">
function confirma_eliminar(idvar, urldel) {
	var result = confirm("Confirma eliminar esta imagen?");
	if (result==true) {
    	//Confirmada la eliminacion de la img
    	$.ajax({
    	    url: "<?php echo base_url('control/propiedades/delete_imagen/');?>/"+idvar,
    	    context: document.body,
    	    success: function(data){
    	      //wrapper del thumbnail
              $(".wrapp_thumb"+idvar).remove();
              $("#"+idvar).remove();

    	    }
    	});	
	}
}

/*FUNCION CAMBIAR PRINCIPAL */
function update_main(idimagen,idpreview){
    $('#imagenes img').css('border', 'none');
    //Logic to delete the item
    var idpropiedad = document.getElementById('idpropiedad').value;

    var formData = new FormData();
    formData.append('idimagen', idimagen);
    formData.append('idpropiedad', idpropiedad);
    var xhr = new XMLHttpRequest();
    xhr.open('POST', "<?php echo base_url('/control/propiedades/main_imagen_update/') ?>", true);
    xhr.onload = function () {
        if (xhr.status === 200) {
                var output = JSON.parse(xhr.responseText);


                if (typeof output == "object") {

                    if (output.status === "OK") {

                        //Eliminar box
                        $("#wrapp_thumb"+idimagen+"  img").css("border", "3px solid #d6e9c6");

                        //divpreview.parentNode.removeChild(divpreview);

                    } else {
                        // Response is HTML
                        notificar("error", "Error al modificar! ");
                    }



                } else {
                    //si recibo error, aqui lo notifico.
                    notificar_main("error", "Error! " + output.status);
                }


        } else {
          alert('An error occurred!');
        }
      };

      // Send the Data.
      xhr.send(formData);


}//end cambiar principal
</script>


<style>
  #sortable li{list-style:none; margin:.5em; float:left; cursor: move;}
    .container_img{height: 120px;  overflow: hidden;}
    .seleccionado img{border:3px solid #d6e9c6;}
</style>


<p><a class="btn btn-info btn-xs" onclick="javascript:history.back()">Regresar</a></p>
<h4>Imagenes de la propiedad</h4>
<hr>
<div class="panel panel-default">
    <div class="panel-body">
    <?php 

    $atts = array('id' => 'form_imagenes', 'class' => "navbar-form navbar-left", 'role'=> 'search');
    echo form_open_multipart(base_url('control/propiedades/add_imagen'), $atts);

    echo form_hidden('id', $this->uri->segment(4));

    echo '
    <div class="control-group">
        <div class="controls">
            <input type="file" class="form-control" name="adjunto" id="adjunto" onchange="validateFile(\'adjunto\');"/>
        </div>
        <div class="controls">
            <input type="file" class="form-control" name="adjunto2" id="adjunto2" onchange="validateFile(\'adjunto2\');"/>
        </div>
            <input type="file" class="form-control" name="adjunto3" id="adjunto3" onchange="validateFile(\'adjunto3\');"/>
        <div class="controls">
      
        <button id="botonenvio" class="btn btn-default"><span class="glyphicon glyphicon-camera"></span> Agregar Imagen</button>
        </div>
    </div>
    ';
    echo form_close();
    ?>
    </div>
</div>


<?php 
    //fomr orden imagenes
    $atts = array('id' => 'form_orden_imagenes');
    echo form_open(base_url('control/propiedades/guardar_orden'), $atts);

    echo form_hidden('id', $this->uri->segment(4));

if($query_imagenes){
    echo "<div id='imagenes'><p></p><input id='saved_columns' type='hidden' name='TableColumns' />
    <ul id=\"sortable\">";
    $count = 1;
    foreach ($query_imagenes as $imagen) {
        $propiedad = $this->propiedad->get_record($this->uri->segment(4));
        $actual_principal = $propiedad->main_image;
        $clase_selected=""; //default
        if($actual_principal==$imagen->id){$clase_selected="seleccionado";}
        echo '<li ">
        <div id="wrapp_thumb'.$imagen->id.'" class="'.$clase_selected.' ">
        
        <div class="thumbnail_delete thumbnail" id="'.$imagen->id.'" style="float:left; margin: 1em; padding:.8em; text-align:center;">
        <div class="container_img"><img src="'.base_url('images-propiedades/'.$imagen->filename).'" width="120" alt="" /></div>
        <p onclick="confirma_eliminar('.$imagen->id.')" class="btn btn-default btn-xs" role="button">Quitar imagen</p>
        <input type="hidden" id="idpropiedad" name="idpropiedad" value="'.$this->uri->segment(4).'" />
         <!--<p onclick="update_main('.$imagen->id.','.$imagen->id.')" class="btn btn-default" role="button">Principal</p>--></div>
        
        <input type="hidden" name="orden_imagenes['.$imagen->id.']" class="item-'.$count.' imagenitem" id="item-'.$count.' value="'.$imagen->filename.'"/>
        
         </div></li>';
        
         $count++;
    }  
    echo '</ul>
    
    </div>

   <div class="col-md-12"> <button type="submit" class="btn btn-success btn-xs">Guardar orden</button></div>

    '; //fin #imagenes 

}else{
    echo '<p>Aun no tiene imagenes &eacute;sta propiedad.</p>';
}

echo form_close();
?>



<script>
    document.getElementById("botonenvio").disabled = true;


    function validateFile(input) 
        {
            var allowedExtension = ['jpeg', 'jpg', 'png', 'gif'];
            var fileExtension = document.getElementById(input).value.split('.').pop().toLowerCase();
            var isValidFile = false;

                for(var index in allowedExtension) {

                    if(fileExtension === allowedExtension[index]) {
                        isValidFile = true; 
                        document.getElementById("botonenvio").disabled = false;
                        break;
                    }
                }

                if(!isValidFile) {
                    alert('Allowed Extensions are : *.' + allowedExtension.join(', *.'));
                }

                return isValidFile;
        }


$(document).ready(function () {
    $('ul').sortable({
       
        //stop: function (event, ui) {
            //var data = $('orden_imagenes').sortable('serialize');
            
        //}
    });
});


</script>



