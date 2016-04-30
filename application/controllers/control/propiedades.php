<?php 

class propiedades extends CI_Controller{


public function __construct(){

	parent::__construct();
	$this->load->model('propiedad');
	$this->load->model('imagenes_propiedad');
	$this->load->model('categoria');
	$this->load->model('barrio');
	$this->load->model('sucursal');
	$this->load->model('tipos_transaccion');
	$this->load->helper('url');
	$this->load->library('session');

	//Si no hay session redirige a Login
	if(! $this->session->userdata('logged_in')){
		redirect('dashboard');
	}

	if( ! ini_get('date.timezone') ){
	    date_default_timezone_set('GMT');
	    setlocale(LC_ALL,"es_ES");
	    setlocale(LC_TIME, 'es_AR');
	}

	$this->data['thumbnail_sizes'] = array(); //thumbnails sizes 
	// $actual = current_url();
	// $this->session->set_userdata('url_anterior', $actual);
}


public function index(){
	//Pagination
	$per_page = 20;
	$page = $this->uri->segment(3);
	if(!$page){ $start =0; $page =1; }else{ $start = ($page -1 ) * $per_page; }
		$data['pagination_links'] = "";
		$total_pages = ceil($this->propiedad->count_rows() / $per_page);

		if ($total_pages > 1){ 
			for ($i=1;$i<=$total_pages;$i++){ 
			if ($page == $i) 
				//si muestro el índice de la página actual, no coloco enlace 
				$data['pagination_links'] .=  '<li class="active"><a>'.$i.'</a></li>'; 
			else 
				//si el índice no corresponde con la página mostrada actualmente, coloco el enlace para ir a esa pagina 
				$data['pagination_links']  .= '<li><a href="'.base_url().'control/propiedades/'.$i.'" > '. $i .'</a></li>'; 
		} 
	}
	//End Pagination

	$data['title'] = 'propiedades';
	$data['menu'] = 'control/propiedades/menu_propiedad';
	$data['content'] = 'control/propiedades/all';
	$data['query'] = $this->propiedad->get_records($per_page,$start);

	$this->load->view('control/control_layout', $data);

}

//detail
public function detail(){

$data['title'] = 'propiedad';
$data['content'] = 'control/propiedades/detail';
$data['menu'] = 'control/propiedades/menu_propiedad';
$data['query'] = $this->propiedad->get_record($this->uri->segment(4));
$this->load->view('control/control_layout', $data);
}


//new
public function form_new(){
$this->load->helper('form');
$data['title'] = 'Nuevo propiedad';
$data['content'] = 'control/propiedades/new_propiedad';
$data['menu'] = 'control/propiedades/menu_propiedad';
$this->load->view('control/control_layout', $data);
}

//create
public function create(){

	$this->load->helper('form');
	$this->load->library('form_validation');
#$this->form_validation->set_rules('titulo', 'Titulo', 'required');

#$this->form_validation->set_rules('subtitulo', 'Subtitulo', 'required');

$this->form_validation->set_rules('direccion', 'Direccion', 'required');
$this->form_validation->set_rules('codigo', 'Codigo', 'required');

$this->form_validation->set_message('required','El campo %s es requerido.');

	
	if ($this->form_validation->run() === FALSE){

		$this->load->helper('form');
		$data['title'] = 'Nuevo propiedades';
		$data['content'] = 'control/propiedades/new_propiedad';
		$data['menu'] = 'control/propiedades/menu_propiedad';
		$this->load->view('control/control_layout', $data);

	}else{
		
		if($this->input->post('slug')){
			$this->load->helper('url');
			$slug = url_title($this->input->post('titulo'), 'dash', TRUE);
		}

if($this->input->post('precio') ==""){$precio = 0; }else{$precio = $this->input->post('precio');}

if($this->input->post('reservado')==""){$reservado= 0;}else{$reservado=1;}
if($this->input->post('vendido')==""){$vendido= 0;}else{$vendido=1;}

		$newpropiedad = array( 'titulo' => $this->input->post('titulo'), 
 'subtitulo' => $this->input->post('subtitulo'), 
 'codigo' => $this->input->post('codigo'), 
 'categoria_id' => $this->input->post('categoria_id'), 
 'localidad' => $this->input->post('localidad'), 
 'barrio' => $this->input->post('barrio'), 
 'input_direccion' => $this->input->post('input_direccion'),
 'direccion' => $this->input->post('direccion'), 
 'mapa' => $this->input->post('mapa'), 
 'tipo_transaccion' => $this->input->post('tipo_transaccion'), 
 'moneda' => $this->input->post('moneda'), 
 'precio' => $precio, 
 'sup_cubierta' => $this->input->post('sup_cubierta'), 
 'sup_descubierta' => $this->input->post('sup_descubierta'), 
 'sup_lote' => $this->input->post('sup_lote'), 
 'sup_semi_cubierta' => $this->input->post('sup_semi_cubierta'), 
 'sup_t_total' => $this->input->post('sup_t_total'), 
 'palier_privado' => $this->input->post('palier_privado'), 
 'hall_de_entrada' => $this->input->post('hall_de_entrada'), 
 'living' => $this->input->post('living'), 
 'comedor' => $this->input->post('comedor'), 
 'toilette' => $this->input->post('toilette'), 
 'cant_banos' => $this->input->post('cant_banos'), 
 'cocina' => $this->input->post('cocina'), 
 'comedor_diario' => $this->input->post('comedor_diario'), 
 'lavadero' => $this->input->post('lavadero'), 
 'hab_servicio' => $this->input->post('hab_servicio'), 
 'balcon' => $this->input->post('balcon'), 
 'segundo_balcon' => $this->input->post('segundo_balcon'), 
 'quincho' => $this->input->post('quincho'), 
 'cochera' => $this->input->post('cochera'), 
 'garage' => $this->input->post('garage'), 
 'baulera' => $this->input->post('baulera'), 
 'parrilla' => $this->input->post('parrilla'), 
 'cant_dormitorios' => $this->input->post('cant_dormitorios'), 
 'descrip_dormitorios' => json_encode($this->input->post('descrip_dormitorios')), 
 'expensas' => $this->input->post('expensas'), 
 'abl' => $this->input->post('abl'), 
 'arba' => $this->input->post('arba'), 
 'tipo_piso' => $this->input->post('tipo_piso'), 
 'calefaccion' => $this->input->post('calefaccion'), 
 'aire_acondicionado' => $this->input->post('aire_acondicionado'), 
 'agua_caliente' => $this->input->post('agua_caliente'), 
 'entrada_servicio' => $this->input->post('entrada_servicio'), 
 'doble_circulacion' => $this->input->post('doble_circulacion'), 
 'piscina' => $this->input->post('piscina'), 
 'orientacion' => $this->input->post('orientacion'), 
 'condicion' => $this->input->post('condicion'), 
 'sucursal_id' => $this->input->post('sucursal_id'),
 'apto_profesional' => $this->input->post('apto_profesional'), 
 'sum' => $this->input->post('sum'), 
 'antiguedad' => $this->input->post('antiguedad'), 
 'telefono' => $this->input->post('telefono'), 
 'estado' => $this->input->post('estado'), 
 'ascensor' => $this->input->post('ascensor'), 
 'otros_servicios' => $this->input->post('otros_servicios'), 
 'observaciones' => $this->input->post('observaciones'), 
 'coordenadas' => $this->input->post('coordenadas'),
 'destacada' => $this->input->post('destacada'),
 'family' => $this->input->post('family'),
'playroom' => $this->input->post('playroom'),
'escritorio' => $this->input->post('escritorio'),
'reservado' => $reservado,
'vendido' => $vendido,
);
		#save
		$this->propiedad->add_record($newpropiedad);
		$this->session->set_flashdata('success', 'Propiedad creada. <a href="propiedades/detail/'.$this->db->insert_id().'">Ver</a>');
		redirect('control/propiedades', 'refresh');

	}



}

//edit
public function editar(){
	$this->load->helper('form');
	$data['title']= 'Editar propiedad';	
	$data['content'] = 'control/propiedades/edit_propiedad';
	$data['menu'] = 'control/propiedades/menu_propiedad';
	$data['query'] = $this->propiedad->get_record($this->uri->segment(4));
	$this->load->view('control/control_layout', $data);
}

//update
public function update(){
	$this->load->helper('form');
	$this->load->library('form_validation'); 
#$this->form_validation->set_rules('titulo', 'Titulo', 'required');

$this->form_validation->set_rules('direccion', 'Direccion', 'required');
#$this->form_validation->set_rules('subtitulo', 'Subtitulo', 'required');

$this->form_validation->set_rules('codigo', 'Codigo', 'required');




	$this->form_validation->set_message('required','El campo %s es requerido.');

	if ($this->form_validation->run() === FALSE){
		$this->load->helper('form');

		$data['title'] = 'Nuevo propiedad';
		$data['content'] = 'control/propiedades/edit_propiedad';
		$data['menu'] = 'control/propiedades/menu_propiedad';
		$data['query'] = $this->propiedad->get_record($this->input->post('id'));
		$this->load->view('control/control_layout', $data);
	}else{		
		$id=  $this->input->post('id');

		if($this->input->post('slug')){
			$this->load->helper('url');
			$slug = url_title($this->input->post('titulo'), 'dash', TRUE);
		}
	
if($this->input->post('precio') ==""){$precio = 0; }else{$precio = $this->input->post('precio');}
if($this->input->post('reservado')==""){$reservado= 0;}else{$reservado=1;}
if($this->input->post('vendido')==""){$vendido= 0;}else{$vendido=1;}


		$editedpropiedad = array(  
'titulo' => $this->input->post('titulo'),

'subtitulo' => $this->input->post('subtitulo'),

'codigo' => $this->input->post('codigo'),

'categoria_id' => $this->input->post('categoria_id'),

'localidad' => $this->input->post('localidad'),

'barrio' => $this->input->post('barrio'),

'input_direccion' => $this->input->post('input_direccion'),
'direccion' => $this->input->post('direccion'),

'mapa' => $this->input->post('mapa'),

'tipo_transaccion' => $this->input->post('tipo_transaccion'),

'moneda' => $this->input->post('moneda'),

'precio' => $this->input->post('precio'),

'sup_cubierta' => $this->input->post('sup_cubierta'),
'sup_descubierta' => $this->input->post('sup_descubierta'),
'sup_lote' => $this->input->post('sup_lote'), 

'sup_semi_cubierta' => $this->input->post('sup_semi_cubierta'),

'sup_t_total' => $this->input->post('sup_t_total'),

'palier_privado' => $this->input->post('palier_privado'),

'hall_de_entrada' => $this->input->post('hall_de_entrada'),

'living' => $this->input->post('living'),

'comedor' => $this->input->post('comedor'),

'toilette' => $this->input->post('toilette'),

'cant_banos' => $this->input->post('cant_banos'),

'cocina' => $this->input->post('cocina'),

'comedor_diario' => $this->input->post('comedor_diario'),

'lavadero' => $this->input->post('lavadero'),

'hab_servicio' => $this->input->post('hab_servicio'),

'balcon' => $this->input->post('balcon'),

'segundo_balcon' => $this->input->post('segundo_balcon'),

'quincho' => $this->input->post('quincho'),

'cochera' => $this->input->post('cochera'),

'garage' => $this->input->post('garage'),

'baulera' => $this->input->post('baulera'),

'parrilla' => $this->input->post('parrilla'),

'cant_dormitorios' => $this->input->post('cant_dormitorios'),

'descrip_dormitorios' => json_encode($this->input->post('descrip_dormitorios')),

'expensas' => $this->input->post('expensas'),

'abl' => $this->input->post('abl'),
'arba' => $this->input->post('arba'),

'tipo_piso' => $this->input->post('tipo_piso'),

'calefaccion' => $this->input->post('calefaccion'),

'aire_acondicionado' => $this->input->post('aire_acondicionado'),

'agua_caliente' => $this->input->post('agua_caliente'),

'entrada_servicio' => $this->input->post('entrada_servicio'),

'doble_circulacion' => $this->input->post('doble_circulacion'),

'piscina' => $this->input->post('piscina'),

'orientacion' => $this->input->post('orientacion'),

'condicion' => $this->input->post('condicion'),

'apto_profesional' => $this->input->post('apto_profesional'),

'sum' => $this->input->post('sum'),

'antiguedad' => $this->input->post('antiguedad'),
'telefono' => $this->input->post('telefono'),

'estado' => $this->input->post('estado'),
'sucursal_id' => $this->input->post('sucursal_id'),

'ascensor' => $this->input->post('ascensor'),

'otros_servicios' => $this->input->post('otros_servicios'),

'observaciones' => $this->input->post('observaciones'),
'coordenadas' => $this->input->post('coordenadas'),
'destacada' => $this->input->post('destacada'),

'family' => $this->input->post('family'),
'playroom' => $this->input->post('playroom'),
'escritorio' => $this->input->post('escritorio'),
'reservado' => $reservado,
'vendido' => $vendido,
);
		#save
		$this->session->set_flashdata('success', 'Propiedad modificada!');
		$this->propiedad->update_record($id, $editedpropiedad);
		if($this->input->post('id')!=""){
			redirect('control/propiedades', 'refresh');
		}else{
			redirect('control/propiedades', 'refresh');
		}



	}



}


//delete comfirm		
public function delete_comfirm(){
	$this->load->helper('form');
	$data['content'] = 'control/propiedades/comfirm_delete';
	$data['title'] = 'Eliminar propiedad';
	$data['menu'] = 'control/propiedades/menu_propiedad';
	$data['query'] = $data['query'] = $this->propiedad->get_record($this->uri->segment(4));
	$this->load->view('control/control_layout', $data);


}

//delete
public function delete(){

	$this->load->helper('form');
	$this->load->library('form_validation');

	$this->form_validation->set_rules('comfirm', 'comfirm', 'required');
	$this->form_validation->set_message('required','Por favor, confirme para eliminar.');


	if ($this->form_validation->run() === FALSE){
		#validation failed
		$this->load->helper('form');

		$data['content'] = 'control/propiedades/comfirm_delete';
		$data['title'] = 'Eliminar propiedad';
		$data['menu'] = 'control/propiedades/menu_propiedad';
		$data['query'] = $this->propiedad->get_record($this->input->post('id'));
		$this->load->view('control/control_layout', $data);
	}else{
		#validation passed
		$this->session->set_flashdata('success', 'propiedad eliminado!');

		$prod = $this->propiedad->get_record($this->input->post('id'));
			/*
			$path = 'images-propiedades/'.$prod->filename;
			if(is_link($path)){
				unlink($path);
			}
			*/
		

		$this->propiedad->delete_record();
		redirect('control/propiedades', 'refresh');
		

	}
}

	public function imagenes(){
	$this->load->helper('form');
	$data['content'] = 'control/propiedades/imagenes';
	$data['title'] = 'Imagenes ';
	$data['menu'] = 'control/propiedades/menu_propiedad';
	$data['query_imagenes'] = $this->imagenes_propiedad->imagenes_propiedad($this->uri->segment(4));
	$this->load->view('control/control_layout', $data);
}

	public function guardar_orden(){
		if($this->input->post('orden_imagenes')){
			$orden  = $this->input->post('orden_imagenes');

			//nuevo array con imagenes en el orden seleccionado
			$nuevo_orden = array();
			foreach ( $orden as $key => $value ) {
				$img = $this->imagenes_propiedad->get_record($key);

				array_push($nuevo_orden, $img->filename);
				
			}
	
		}
		
		$this->imagenes_propiedad->delete_por_propiedad($this->input->post('id'));

		foreach ($nuevo_orden as $value) {
			$nueva_imagen = array('propiedad_id' => $this->input->post('id'),'filename' => $value );
			$this->imagenes_propiedad->add_record($nueva_imagen);
		}

		redirect('control/propiedades/imagenes/'.$this->input->post('id'));
	}

	public function add_imagen(){

	$hubo_imagen=0; 
	$mensaje_imagen ="";
	//adjunto
	if($_FILES['adjunto']['size'] > 0){

		//imagen 1
		$file  = $this->upload_file();
		if ( $file['status'] != 0 ){
			//guardo
			$nueva_imagen = array('propiedad_id' => $this->input->post('id'),'filename' => $file['filename'] );
			$this->imagenes_propiedad->add_record($nueva_imagen);
			$mensaje_imagen .= "Imagen 1 cargada. ";
			$hubo_imagen=1;
		}
	}

	//adjunto2
	if($_FILES['adjunto2']['size'] > 0){
		
		//imagen 1
		$file2  = $this->upload_file2();
		if ( $file2['status'] != 0 ){
			//guardo
			$nueva_imagen = array('propiedad_id' => $this->input->post('id'),'filename' => $file2['filename'] );
			$this->imagenes_propiedad->add_record($nueva_imagen);
			$mensaje_imagen .= "Imagen 2 cargada. ";
			$hubo_imagen=1;
		}
	}

	//adjunto3
	if($_FILES['adjunto3']['size'] > 0){
		
		//imagen 1
		$file3  = $this->upload_file3();
		if ( $file3['status'] != 0 ){
			//guardo
			$nueva_imagen = array('propiedad_id' => $this->input->post('id'),'filename' => $file3['filename'] );
			$this->imagenes_propiedad->add_record($nueva_imagen);
			$mensaje_imagen .= "Imagen 3 cargada. ";
			$hubo_imagen=1;
		}
	}



		if($hubo_imagen=1){
			#save
			$this->session->set_flashdata('success', $mensaje_imagen );
			redirect('control/propiedades/imagenes/'.$this->input->post('id'));
		}


	$this->session->set_flashdata('error', $file['msg']);
	redirect('control/propiedades/imagenes/'.$this->input->post('id'));
}



public function delete_imagen(){
	$id_imagen = $this->uri->segment(4); 
	 
	$imagen = $this->imagenes_propiedad->get_record($id_imagen);
	$path = 'images-propiedades/'.$imagen->filename;
	unlink($path);
	
	$this->imagenes_propiedad->delete_record($id_imagen);	
	#echo "Eliminada : ".$imagen->filename;
}

function main_imagen_update(){
	$idimagen = $this->input->post('idimagen');
	$idpropiedad = $this->input->post('idpropiedad');
	$data_update = array('main_image' => $idimagen);
	$this->propiedad->update_main($idpropiedad, $data_update);
	$arr = array('status' => "OK");
	echo json_encode($arr);
	exit();
}

/*******  FILE ADJUNTO  ********/
public function upload_file(){
	
	//1 = OK - 0 = Failure
	$file = array('status' => '', 'filename' => '', 'msg' => '' );
	
	array('image/jpeg','image/pjpeg', 'image/jpg', 'image/png', 'image/gif','image/bmp');
	//check extencion
	/*
	$file_extensions_allowed = array('application/pdf', 'application/msword', 'application/rtf', 'application/vnd.ms-excel','application/vnd.ms-powerpoint','application/zip','application/x-rar-compressed', 'text/plain');
	$exts_humano = array('PDF', 'WORD', 'RTF', 'EXCEL', 'PowerPoint', 'ZIP', 'RAR');
	*/
	$file_extensions_allowed = array('image/jpeg','image/pjpeg', 'image/jpg', 'image/png', 'image/gif','image/bmp');
	$exts_humano = array('JPG', 'JPEG', 'PNG', 'GIF');
	
	
	$exts_humano = implode(', ',$exts_humano);
	$ext = $_FILES['adjunto']['type'];
	#$ext = strtolower($ext);
	if(!in_array($ext, $file_extensions_allowed)){
		$exts = implode(', ',$file_extensions_allowed);
		
	$file['msg'] .="<p>".$_FILES['adjunto']['name']." <br />Puede subir archivos que tengan alguna de estas extenciones: ".$exts_humano."</p>";
	$file['status'] = 0 ;
	}else{
		include_once(APPPATH.'libraries/class.upload.php');
		$yukle = new upload;
		$yukle->set_max_size(1900000);
		$yukle->set_directory('./images-propiedades');
		$yukle->set_tmp_name($_FILES['adjunto']['tmp_name']);
		$yukle->set_file_size($_FILES['adjunto']['size']);
		$yukle->set_file_type($_FILES['adjunto']['type']);
		$random = substr(md5(rand()),0,6);
		$name_whitout_whitespaces = str_replace(" ","-",$_FILES['adjunto']['name']);
		$imagname=''.$random.'_'.$name_whitout_whitespaces;
		#$thumbname='tn_'.$imagname;
		$yukle->set_file_name($imagname);
		
	
		$yukle->start_copy();
		
		
		if($yukle->is_ok()){
		#$yukle->resize(600,0);
		#$yukle->set_thumbnail_name('tn_'.$random.'_'.$name_whitout_whitespaces);
		#$yukle->create_thumbnail();
		#$yukle->set_thumbnail_size(180, 0);
		
			//UPLOAD ok
			$file['filename'] = $imagname;
			$file['status'] = 1;
		}
		else{
			$file['status'] = 0 ;
			$file['msg'] = 'Error al subir archivo';
		}
		
		//clean
		$yukle->set_tmp_name('');
		$yukle->set_file_size('');
		$yukle->set_file_type('');
		$imagname='';
	}//fin if(extencion)	
		
		
	return $file;
}


/*******  FILE ADJUNTO  ********/
public function upload_file2(){
	
	//1 = OK - 0 = Failure
	$file = array('status' => '', 'filename' => '', 'msg' => '' );
	
	array('image/jpeg','image/pjpeg', 'image/jpg', 'image/png', 'image/gif','image/bmp');
	//check extencion
	/*
	$file_extensions_allowed = array('application/pdf', 'application/msword', 'application/rtf', 'application/vnd.ms-excel','application/vnd.ms-powerpoint','application/zip','application/x-rar-compressed', 'text/plain');
	$exts_humano = array('PDF', 'WORD', 'RTF', 'EXCEL', 'PowerPoint', 'ZIP', 'RAR');
	*/
	$file_extensions_allowed = array('image/jpeg','image/pjpeg', 'image/jpg', 'image/png', 'image/gif','image/bmp');
	$exts_humano = array('JPG', 'JPEG', 'PNG', 'GIF');
	
	
	$exts_humano = implode(', ',$exts_humano);
	$ext = $_FILES['adjunto2']['type'];
	#$ext = strtolower($ext);
	if(!in_array($ext, $file_extensions_allowed)){
		$exts = implode(', ',$file_extensions_allowed);
		
	$file['msg'] .="<p>".$_FILES['adjunto2']['name']." <br />Puede subir archivos que tengan alguna de estas extenciones: ".$exts_humano."</p>";
	$file['status'] = 0 ;
	}else{
		include_once(APPPATH.'libraries/class.upload.php');
		$yukle = new upload;
		$yukle->set_max_size(1900000);
		$yukle->set_directory('./images-propiedades');
		$yukle->set_tmp_name($_FILES['adjunto2']['tmp_name']);
		$yukle->set_file_size($_FILES['adjunto2']['size']);
		$yukle->set_file_type($_FILES['adjunto2']['type']);
		$random = substr(md5(rand()),0,6);
		$name_whitout_whitespaces = str_replace(" ","-",$_FILES['adjunto2']['name']);
		$imagname=''.$random.'_'.$name_whitout_whitespaces;
		#$thumbname='tn_'.$imagname;
		$yukle->set_file_name($imagname);
		
	
		$yukle->start_copy();
		
		
		if($yukle->is_ok()){
		#$yukle->resize(600,0);
		#$yukle->set_thumbnail_name('tn_'.$random.'_'.$name_whitout_whitespaces);
		#$yukle->create_thumbnail();
		#$yukle->set_thumbnail_size(180, 0);
		
			//UPLOAD ok
			$file['filename'] = $imagname;
			$file['status'] = 1;
		}
		else{
			$file['status'] = 0 ;
			$file['msg'] = 'Error al subir archivo';
		}
		
		//clean
		$yukle->set_tmp_name('');
		$yukle->set_file_size('');
		$yukle->set_file_type('');
		$imagname='';
	}//fin if(extencion)	
		
		
	return $file;
}

/*******  FILE ADJUNTO  ********/
public function upload_file3(){
	
	//1 = OK - 0 = Failure
	$file = array('status' => '', 'filename' => '', 'msg' => '' );
	
	array('image/jpeg','image/pjpeg', 'image/jpg', 'image/png', 'image/gif','image/bmp');
	//check extencion
	/*
	$file_extensions_allowed = array('application/pdf', 'application/msword', 'application/rtf', 'application/vnd.ms-excel','application/vnd.ms-powerpoint','application/zip','application/x-rar-compressed', 'text/plain');
	$exts_humano = array('PDF', 'WORD', 'RTF', 'EXCEL', 'PowerPoint', 'ZIP', 'RAR');
	*/
	$file_extensions_allowed = array('image/jpeg','image/pjpeg', 'image/jpg', 'image/png', 'image/gif','image/bmp');
	$exts_humano = array('JPG', 'JPEG', 'PNG', 'GIF');
	
	
	$exts_humano = implode(', ',$exts_humano);
	$ext = $_FILES['adjunto3']['type'];
	#$ext = strtolower($ext);
	if(!in_array($ext, $file_extensions_allowed)){
		$exts = implode(', ',$file_extensions_allowed);
		
	$file['msg'] .="<p>".$_FILES['adjunto3']['name']." <br />Puede subir archivos que tengan alguna de estas extenciones: ".$exts_humano."</p>";
	$file['status'] = 0 ;
	}else{
		include_once(APPPATH.'libraries/class.upload.php');
		$yukle = new upload;
		$yukle->set_max_size(1900000);
		$yukle->set_directory('./images-propiedades');
		$yukle->set_tmp_name($_FILES['adjunto3']['tmp_name']);
		$yukle->set_file_size($_FILES['adjunto3']['size']);
		$yukle->set_file_type($_FILES['adjunto3']['type']);
		$random = substr(md5(rand()),0,6);
		$name_whitout_whitespaces = str_replace(" ","-",$_FILES['adjunto2']['name']);
		$imagname=''.$random.'_'.$name_whitout_whitespaces;
		#$thumbname='tn_'.$imagname;
		$yukle->set_file_name($imagname);
		
	
		$yukle->start_copy();
		
		
		if($yukle->is_ok()){
		#$yukle->resize(600,0);
		#$yukle->set_thumbnail_name('tn_'.$random.'_'.$name_whitout_whitespaces);
		#$yukle->create_thumbnail();
		#$yukle->set_thumbnail_size(180, 0);
		
			//UPLOAD ok
			$file['filename'] = $imagname;
			$file['status'] = 1;
		}
		else{
			$file['status'] = 0 ;
			$file['msg'] = 'Error al subir archivo';
		}
		
		//clean
		$yukle->set_tmp_name('');
		$yukle->set_file_size('');
		$yukle->set_file_type('');
		$imagname='';
	}//fin if(extencion)	
		
		
	return $file;
}

} //end class

?>