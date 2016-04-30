<?php  
$attributes = array('class' => 'form-horizontal', 'id' => 'delete_sucursal');
echo form_open(base_url('control/sucursales/delete/'.$query->id), $attributes);
echo '<fieldset>'.form_hidden('id', $query->id); 

?>
<legend><?php echo $title ?></legend>
<div class="well well-large well-transparent">
 <!-- <p>Categoria id: <?php #echo $nombre_categoria = $this->categoria->traer_nombre($query->categoria_id); ?></p> -->

 <p>Nombre: <?php echo $query->nombre; ?></p>
 <p>Direccion: <?php echo $query->direccion; ?></p>
 <p>Emails: <?php echo $query->emails; ?></p>
 <p>Telefonos: <?php echo $query->telefonos; ?></p>
 <p>Detalles: <?php echo $query->detalles; ?></p>

<!--  -->
<div class="control-group">

<label>


<p>Confirma eliminar? <input type="checkbox" name="comfirm" id="comfirm" /></p>
<?php echo form_error('comfirm','<p class="error">', '</p>'); ?>
 </label>
</div>
<!--  -->
<div class="control-group">
<button class="btn btn-danger" type="submit"><i class="icon-trash icon-large"></i> Eliminar</button>
</div>


</fieldset>

<?php echo form_close(); ?>