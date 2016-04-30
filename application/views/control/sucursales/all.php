
<h2><?php echo $title; ?></h2>

<?php 
if(count($query->result())){
	echo '<table class="table table-striped">';
	foreach ($query->result() as $row):

		/* $nombre_categoria = $this->categoria->traer_nombre($row->categoria_id); */

		echo '<tr>';
		echo '<td>'.$row->nombre.' </td>';
		echo '<td>'.$row->direccion.' </td>';
		echo '<td>'.$row->emails.' </td>';
		echo '<td>'.$row->telefonos.' </td>';
		#echo '<td>'.$row->detalles.' </td>';

		echo '</td>';

		echo '<td> 
		<div class="btn-group">
		<a class="btn btn-small" href="'.base_url('control/sucursales/delete_comfirm/'.$row->id.'').'"><i class="fa fa-trash-o"></i></a>
		<a class="btn btn-small" href="'.base_url('control/sucursales/editar/'.$row->id.'').'"><i class="fa fa-edit"></i></a>		
		<!--<a class="btn btn-small" href="'.base_url('control/sucursales/detail/'.$row->id.'').'"><i class="fa fa-chain"></i></a>-->
		</div>
		</td>';


		echo '</tr>';

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