<?php  

$attributes = array('class' => 'form-horizontal', 'id' => 'new_barrio');
echo form_open_multipart(base_url('control/barrios/create/'),$attributes);

echo form_hidden('barrio[id]');

?>
<legend><?php echo $title ?></legend>
<div class="well well-large well-transparent">
			
			<!-- Text input-->
			<div class="control-group">
			<label class="control-label">Localidad</label>
			<div class="controls">
			<?php  echo form_dropdown('localidad', $this->config->item('localidad'), $this->input->post('localidad'), 'id = localidad');?>
			<?php echo form_error('localidad','<p class="error">', '</p>'); ?>
			</div>
			</div>

			<!-- Text input-->
			<div class="control-group">
			<label class="control-label">Nombre</label>
			<div class="controls">
			<input value="<?php echo set_value('nombre'); ?>" class="form-control" type="text" name="nombre" />
			<?php echo form_error('nombre','<p class="error">', '</p>'); ?>
			</div>
			</div>


<div class="control-group">
<label class="control-label"></label>
	<div class="controls">
		<button class="btn" type="submit">Crear</button>
	</div>
</div>



</fieldset>

<?php echo form_close(); ?>

</div>