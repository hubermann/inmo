
<div class="well sidebar-nav">
	<ul class="nav nav-list">
		<li class="nav-header">Opciones</li>
		<li><a href="<?php echo base_url('control/sucursales/');?>">Ver Sucursales</a></li>
		<?php  
		$cantidad_sucursales = $this->sucursal->count_rows();
		if($cantidad_sucursales < 3){
			echo '<li><a href="'.base_url('control/sucursales/form_new').'">Nueva Sucursal</a></li>';
		}else{
			echo '';
		}
		?>
		
	</ul>
</div><!--/.well -->
