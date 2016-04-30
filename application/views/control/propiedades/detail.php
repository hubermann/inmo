<p><a class="btn btn-info btn-xs" onclick="javascript:history.back()">Regresar</a></p>

<h2><?php echo ucfirst($title) ?></h2>

<div class="well well-large well-transparent">
<?php
$nombre_categoria = $this->categoria->traer_nombre($query->categoria_id); 
		$total_de_imagenes = $this->imagenes_propiedad->total_por_propiedad($query->id); 
 echo '
			<div class="row">
			<div class="col-md-12">

			<h4>  '.$query->titulo.'</h4>
			<h6>'.$query->subtitulo.'</h6>
			<p><span>'.$nombre_categoria.'</span> | <span>'.$query->codigo.' </span>| <span>'.$query->moneda.' '.$query->precio.' </span> | <span> '.$query->localidad.' '.$query->barrio.'</span></p>
			
			<div class="btn-group">
			<a class="btn btn-small" href="'.base_url('control/propiedades/delete_comfirm/'.$query->id.'').'" title="Eliminar" ><i class="fa fa-trash-o"></i></a>
			<a class="btn btn-small" href="'.base_url('control/propiedades/editar/'.$query->id.'').'" title="Modificar" ><i class="fa fa-edit"></i></a>
			<a class="btn btn-small" href="'.base_url('control/propiedades/imagenes/'.$query->id.'').'" title="imagenes: ('.$total_de_imagenes .')" ><i class="fa fa-camera-retro"></i>  </a>		
			<!--<a class="btn btn-small" href="'.base_url('control/propiedades/detail/'.$query->id.'').'"><i class="fa fa-chain"></i></a>-->
			</div>
			<hr />
			</div>
			</div>
			';
?>

</div>