
<p><a class="btn btn-info btn-xs" onclick="javascript:history.back()">Regresar</a></p>
<?php  
$attributes = array('class' => 'form-horizontal', 'id' => 'delete_propiedad');
echo form_open(base_url('control/propiedades/delete/'.$query->id), $attributes);
echo '<fieldset>'.form_hidden('id', $query->id); 

?>


<legend>   <?php echo ucfirst($title) ?></legend>
<div class="well well-large well-transparent">

 <!-- <p>Categoria id: <?php #echo $nombre_categoria = $this->categoria->traer_nombre($query->categoria_id); ?></p> -->
<?php 
$nombre_categoria = $this->categoria->traer_nombre($query->categoria_id);
$nombre_tipo_transaccion = $this->tipos_transaccion->traer_nombre($query->tipo_transaccion);  

?>
 <p>Titulo: <?php echo $query->titulo; ?></p>
 <p>Subtitulo: <?php echo $query->subtitulo; ?></p>
 <p>Codigo: <?php echo $query->codigo; ?></p>
 <p>Categoria_id: <?php echo $nombre_categoria; ?></p>
 <p>Localidad: <?php echo $query->localidad; ?></p>
 <p>Barrio: <?php echo $query->barrio; ?></p>
 <p>Direccion: <?php echo $query->input_direccion; ?></p>
 <p>Tipo_transaccion: <?php echo $nombre_tipo_transaccion; ?></p>
 <p>Moneda: <?php echo $query->moneda; ?></p>
 <p>Precio: <?php echo $query->precio; ?></p>
 


<!--  -->

<div class="control-group">

<label >


<p> Confirma eliminar? <input type="checkbox" name="comfirm" id="comfirm"  /></p>
<?php echo form_error('comfirm','<p class="error">', '</p>'); ?>
 </label>
</div>
<!--  -->
<div class="control-group">
<button class="btn btn-danger" type="submit"><i class="icon-trash icon-large"></i> Eliminar</button>
</div>


</fieldset>

<?php echo form_close(); ?>
