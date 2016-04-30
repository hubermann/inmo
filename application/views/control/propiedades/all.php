
<h2><?php echo ucfirst($title); ?></h2>
<hr />
<?php 
if(count($query)){
	echo '<table class="table table-striped">';
	foreach ($query as $row):

		$nombre_categoria = $this->categoria->traer_nombre($row->categoria_id); 
		$total_de_imagenes = $this->imagenes_propiedad->total_por_propiedad($row->id); 
		$nombre_transaccion = $this->tipos_transaccion->traer_nombre($row->tipo_transaccion);

		$nombre_barrio = $this->barrio->traer_nombre($row->barrio);

		if(!is_array($nombre_barrio)){$barrio =$nombre_barrio; }else{$barrio="";}
		$precio = str_replace(".00", "", $row->precio);
		echo '
			<div class="row">
			<div class="col-md-12">

			<h4>  '.$row->direccion.'</h4>
			<h6>'.$nombre_transaccion.'</h6>
			<p><span>'.$nombre_categoria.'</span> | <span>'.$row->codigo.' </span>| <span>'.$row->moneda.' '.$precio.' </span> | <span> '.$row->localidad.' '.$barrio.'</span></p>
			
			<div class="btn-group">
			<a class="btn btn-small" href="'.base_url('control/propiedades/delete_comfirm/'.$row->id.'').'" title="Eliminar" ><i class="fa fa-trash-o"></i></a>
			<a class="btn btn-small" href="'.base_url('control/propiedades/editar/'.$row->id.'').'" title="Modificar" ><i class="fa fa-edit"></i></a>
			<a class="btn btn-small" href="'.base_url('control/propiedades/imagenes/'.$row->id.'').'" title="imagenes: ('.$total_de_imagenes .')" ><i class="fa fa-camera-retro"></i>  </a>		
			<!--<a class="btn btn-small" href="'.base_url('control/propiedades/detail/'.$row->id.'').'"><i class="fa fa-chain"></i></a>-->
			</div>
			<hr />
			</div>
			</div>
			';




	endforeach; 
	echo '</table>';
}else{
	echo 'No hay resultados.';
}
?>
<div>




<ul class="pagination pagination-small pagination-centered">
<?php echo $pagination_links;  ?>
</ul>
</div>