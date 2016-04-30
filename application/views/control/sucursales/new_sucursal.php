<?php  

$attributes = array('class' => 'form-horizontal', 'id' => 'new_sucursal');
echo form_open_multipart(base_url('control/sucursales/create/'),$attributes);

echo form_hidden('sucursal[id]');

?>
<legend><?php echo $title ?></legend>
<div class="well well-large well-transparent">


<!-- Text input-->
<!--
<div class="control-group">
<label class="control-label">Categoria</label>
	<div class="controls">
		
		<select name="categoria_id" id="categoria_id">
		<?php  
		/*
		$categorias = $this->Categoria->get_records_menu();
		if($categorias){

			foreach ($categorias->result() as $value) {
				echo '<option value="'.$value->id.'">'.$value->nombre.'</option>';
			}
		}
		*/
		?>
		</select>

		<?php echo form_error('categoria_id','<p class="error">', '</p>'); ?>
	</div>
</div>
-->
			<!-- Text input-->
			<div class="control-group">
			<label class="control-label">Nombre</label>
			<div class="controls">
			<input value="<?php echo set_value('nombre'); ?>" class="form-control" type="text" name="nombre" />
			<?php echo form_error('nombre','<p class="error">', '</p>'); ?>
			</div>
			</div>
			<!-- Text input-->
			<div class="control-group">
			<label class="control-label">Direccion</label>
			<div class="controls">
			<input value="<?php echo set_value('direccion'); ?>" class="form-control" type="text" name="direccion" />
			<?php echo form_error('direccion','<p class="error">', '</p>'); ?>
			</div>
			</div>
			<!-- Text input-->
			<div class="control-group">
			<label class="control-label">Emails</label>
			<div class="controls">
			<input value="<?php echo set_value('emails'); ?>" class="form-control" type="text" name="emails" />
			<?php echo form_error('emails','<p class="error">', '</p>'); ?>
			</div>
			</div>
			<!-- Text input-->
			<div class="control-group">
			<label class="control-label">Telefonos</label>
			<div class="controls">
			<input value="<?php echo set_value('telefonos'); ?>" class="form-control" type="text" name="telefonos" />
			<?php echo form_error('telefonos','<p class="error">', '</p>'); ?>
			</div>
			</div>
			<!-- Text input-->
			<!-- <div class="control-group">
			<label class="control-label">Detalles</label>
			<div class="controls">
			<textarea name="detalles" id="detalle" class="form-control" rows="5"><?php echo set_value('detalles'); ?></textarea>
			<?php echo form_error('detalles','<p class="error">', '</p>'); ?>
			</div>
			</div> -->

<div class="control-group">
<label class="control-label"></label>
	<div class="controls">
		<button class="btn" type="submit">Crear</button>
	</div>
</div>



</fieldset>

<?php echo form_close(); ?>

</div>