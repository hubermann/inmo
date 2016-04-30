<!--Enviar form sin recargar pagina-->
<script src="<?php echo base_url('public_folder/front/js/envio_form/runonload.js'); ?>"></script> 
<script src="<?php echo base_url('public_folder/front/js/envio_form/valida_recomendar_prop.js'); ?>"></script>     
<!--Fin Enviar form sin recargar pagina--> 


<div id="contenedor_formulario_recomendar"> 

	<div id="titulo_recomedar_amigo">
        <img src="<?php echo base_url('public_folder/front/layout/img_compartidas_estetica/logo_martin_cesarsky.png'); ?>"  width="280" alt="">
		Recomendar propiedad
	</div><!-- titulo_recomedar_amigo -->

    <form id="formulario_validar_recomendar_amigo" name="formulario_validar_recomendar_amigo" method="post" action="#">                

    <div class="columnas_form">

        <label for="mail_destinatario" class="nombre_campos">Email del destinatario *</label> 
        <input name="mail_destinatario" id="mail_destinatario" type="text" class="campos required">
        <label class="error_recomendar" for="mail_destinatario" id="mail_destinatario_error_vacio">Complete este campo</label>
        <label class="error_recomendar" for="mail_destinatario" id="mail_destinatario_error_formato">Formato de mail no valido</label>

        <label for="nombre_remitente" class="nombre_campos">Tu Nombre *</label>         
        <input name="nombre_remitente" id="nombre_remitente" type="text" class="campos required"> 
        <label class="error_recomendar" for="nombre_remitente" id="nombre_remitente_error">Complete este campo</label>               

        <label for="mail_remitente"  class="nombre_campos">Tu mail *</label>        
        <input name="mail_remitente" id="mail_remitente" type="text" class="campos required">
        <label class="error_recomendar" for="mail_remitente" id="mail_remitente_error_vacio">Complete este campo</label> 
        <label class="error_recomendar" for="mail_remitente" id="mail_remitente_error_formato">Formato de mail no valido</label>


    </div><!--columnas_form-->                 
                 
    <div id="contenedor_comentario">       
        <label for="comentario" class="nombre_campos">Comentario</label>
        <textarea  id="comentario" name="comentario" class="campos comentario"></textarea>
        <!--<label class="error error_comentario" for="comentario" id="comentario_error">Complete este campo</label>-->            
    </div>  

    <input type="submit" name="submit" class="bt_enviar_recomendar" value="ENVIAR"></input>             
    
    </form>
<div id="txt_campo_obligatorio">
    * Campo Obligatorio
</div><!--txt_campo_obligatorio-->        
</div><!--contenedor_formulario_recomendar -->