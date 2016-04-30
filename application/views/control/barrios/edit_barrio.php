<?php  
$attributes = array('class' => 'form-horizontal', 'id' => 'edit_barrio');
echo form_open_multipart(base_url('control/barrios/update/'),$attributes);

echo form_hidden('id', $query->id); 
?>
<legend><?php echo $title ?></legend>
<div class="well well-large well-transparent">

 


			<!-- Text input-->
			<div class="control-group">
			<label class="control-label">Localidad</label>
			<div class="controls">
			<?php  echo form_dropdown('localidad', $this->config->item('localidad'), $query->localidad , 'id = localidad');?>
			<?php echo form_error('localidad','<p class="error">', '</p>'); ?>
			</div>
			</div>

			<!-- Text input-->
			<div class="control-group">
			<label class="control-label">Nombre</label>
			<div class="controls">
			<?php  
			$nombre_barrio = str_replace("CABA - ", "", $query->nombre);
			$nombre_barrio = str_replace("GBA - ", "", $nombre_barrio);
			?>
			<input value="<?php echo $nombre_barrio; ?>" type="text" class="form-control" name="nombre" />
			<?php echo form_error('nombre','<p class="error">', '</p>'); ?>
			</div>
			</div>
			

<div class="control-group">
<label class="control-label"></label>
	<div class="controls">
		<button class="btn" type="submit">Actualizar</button>
	</div>
</div>

</fieldset>

<?php echo form_close(); ?>

</div>
