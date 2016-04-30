<?php  
$attributes = array('class' => 'form-horizontal', 'id' => 'edit_sucursal');
echo form_open_multipart(base_url('control/sucursales/update/'),$attributes);

echo form_hidden('id', $query->id); 
?>
<legend><?php echo $title ?></legend>
<div class="well well-large well-transparent">

 


<!-- Text input-->
<!--
<div class="control-group">
<label class="control-label">Categoria id</label>
	<div class="controls">
	<select name="categoria_id" id="categoria_id">
		<?php 
		/* 
		$categorias = $this->categoria->get_records_menu();
		if($categorias){

			foreach ($categorias as $value) {
				if($query->categoria_id == $value->id){$sel= "selected";}else{$sel="";}
				echo '<option value="'.$value->id.'" '.$sel.'>'.$value->nombre.'</option>';
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
			<input value="<?php echo $query->nombre; ?>" type="text" class="form-control" name="nombre" />
			<?php echo form_error('nombre','<p class="error">', '</p>'); ?>
			</div>
			</div>
			<!-- Text input-->
			<div class="control-group">
			<label class="control-label">Direccion</label>
			<div class="controls">
			<input value="<?php echo $query->direccion; ?>" type="text" class="form-control" name="direccion" />
			<?php echo form_error('direccion','<p class="error">', '</p>'); ?>
			</div>
			</div>
			<!-- Text input-->
			<div class="control-group">
			<label class="control-label">Emails</label>
			<div class="controls">
			<input value="<?php echo $query->emails; ?>" type="text" class="form-control" name="emails" />
			<?php echo form_error('emails','<p class="error">', '</p>'); ?>
			</div>
			</div>
			<!-- Text input-->
			<div class="control-group">
			<label class="control-label">Telefonos</label>
			<div class="controls">
			<input value="<?php echo $query->telefonos; ?>" type="text" class="form-control" name="telefonos" />
			<?php echo form_error('telefonos','<p class="error">', '</p>'); ?>
			</div>
			</div>
			<!-- Text input-->
			<!-- <div class="control-group">
			<label class="control-label">Detalles</label>
			<div class="controls">
			<textarea name="detalles" id="detalle" class="form-control" rows="5"><?php echo $query->detalles; ?></textarea>
			<?php echo form_error('detalles','<p class="error">', '</p>'); ?>
			
			
			</div>
			</div> -->

<div class="control-group">
<label class="control-label"></label>
	<div class="controls">
		<button class="btn" type="submit">Actualizar</button>
	</div>
</div>

</fieldset>

<?php echo form_close(); ?>

</div>
