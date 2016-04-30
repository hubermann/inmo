<?php 

class sucursales extends CI_Controller{


public function __construct(){

	parent::__construct();
	$this->load->model('sucursal');
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

}

public function index(){
	//Pagination
	$per_page = 20;
	$page = $this->uri->segment(3);
	if(!$page){ $start =0; $page =1; }else{ $start = ($page -1 ) * $per_page; }
		$data['pagination_links'] = "";
		$total_pages = ceil($this->sucursal->count_rows() / $per_page);

		if ($total_pages > 1){ 
			for ($i=1;$i<=$total_pages;$i++){ 
			if ($page == $i) 
				//si muestro el índice de la página actual, no coloco enlace 
				$data['pagination_links'] .=  '<li class="active"><a>'.$i.'</a></li>'; 
			else 
				//si el índice no corresponde con la página mostrada actualmente, coloco el enlace para ir a esa pagina 
				$data['pagination_links']  .= '<li><a href="'.base_url().'control/sucursales/'.$i.'" > '. $i .'</a></li>'; 
		} 
	}
	//End Pagination

	$data['title'] = 'sucursales';
	$data['menu'] = 'control/sucursales/menu_sucursal';
	$data['content'] = 'control/sucursales/all';
	$data['query'] = $this->sucursal->get_records($per_page,$start);

	$this->load->view('control/control_layout', $data);

}

//detail
public function detail(){

$data['title'] = 'sucursal';
$data['content'] = 'control/sucursales/detail';
$data['menu'] = 'control/sucursales/menu_sucursal';
$data['query'] = $this->sucursal->get_record($this->uri->segment(4));
$this->load->view('control/control_layout', $data);
}


//new
public function form_new(){
$this->load->helper('form');
$data['title'] = 'Nueva sucursal';
$data['content'] = 'control/sucursales/new_sucursal';
$data['menu'] = 'control/sucursales/menu_sucursal';
$this->load->view('control/control_layout', $data);
}

//create
public function create(){

	$this->load->helper('form');
	$this->load->library('form_validation');
$this->form_validation->set_rules('nombre', 'Nombre', 'required');

$this->form_validation->set_message('required','El campo %s es requerido.');

	
	if ($this->form_validation->run() === FALSE){

		$this->load->helper('form');
		$data['title'] = 'Nueva sucursale';
		$data['content'] = 'control/sucursales/new_sucursal';
		$data['menu'] = 'control/sucursales/menu_sucursal';
		$this->load->view('control/control_layout', $data);

	}else{
		
		if($this->input->post('slug')){
			$this->load->helper('url');
			$slug = url_title($this->input->post('titulo'), 'dash', TRUE);
		}

		
		$newsucursal = array( 'nombre' => $this->input->post('nombre'), 
 'direccion' => $this->input->post('direccion'), 
 'emails' => $this->input->post('emails'), 
 'telefonos' => $this->input->post('telefonos'), 
 'detalles' => $this->input->post('detalles'), 
);
		#save
		$this->sucursal->add_record($newsucursal);
		$this->session->set_flashdata('success', 'Sucursal creada. <a href="sucursales/detail/'.$this->db->insert_id().'">Ver</a>');
		redirect('control/sucursales', 'refresh');

	}



}

//edit
public function editar(){
	$this->load->helper('form');
	$data['title']= 'Editar sucursal';	
	$data['content'] = 'control/sucursales/edit_sucursal';
	$data['menu'] = 'control/sucursales/menu_sucursal';
	$data['query'] = $this->sucursal->get_record($this->uri->segment(4));
	$this->load->view('control/control_layout', $data);
}

//update
public function update(){
	$this->load->helper('form');
	$this->load->library('form_validation'); 
$this->form_validation->set_rules('nombre', 'Nombre', 'required');




	$this->form_validation->set_message('required','El campo %s es requerido.');

	if ($this->form_validation->run() === FALSE){
		$this->load->helper('form');

		$data['title'] = 'Nueva sucursal';
		$data['content'] = 'control/sucursales/edit_sucursal';
		$data['menu'] = 'control/sucursales/menu_sucursal';
		$data['query'] = $this->sucursal->get_record($this->input->post('id'));
		$this->load->view('control/control_layout', $data);
	}else{		
		$id=  $this->input->post('id');

		if($this->input->post('slug')){
			$this->load->helper('url');
			$slug = url_title($this->input->post('titulo'), 'dash', TRUE);
		}

		$editedsucursal = array(  
'nombre' => $this->input->post('nombre'),

'direccion' => $this->input->post('direccion'),

'emails' => $this->input->post('emails'),

'telefonos' => $this->input->post('telefonos'),

'detalles' => $this->input->post('detalles'),
);
		#save
		$this->session->set_flashdata('success', 'Sucursal actualizada!');
		$this->sucursal->update_record($id, $editedsucursal);
		if($this->input->post('id')!=""){
			redirect('control/sucursales', 'refresh');
		}else{
			redirect('control/sucursales', 'refresh');
		}



	}



}


//delete comfirm		
public function delete_comfirm(){
	$this->load->helper('form');
	$data['content'] = 'control/sucursales/comfirm_delete';
	$data['title'] = 'Eliminar sucursal';
	$data['menu'] = 'control/sucursales/menu_sucursal';
	$data['query'] = $data['query'] = $this->sucursal->get_record($this->uri->segment(4));
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

		$data['content'] = 'control/sucursales/comfirm_delete';
		$data['title'] = 'Eliminar sucursal';
		$data['menu'] = 'control/sucursales/menu_sucursal';
		$data['query'] = $this->sucursal->get_record($this->input->post('id'));
		$this->load->view('control/control_layout', $data);
	}else{
		#validation passed
		$this->session->set_flashdata('success', 'sucursal eliminada!');

		$prod = $this->sucursal->get_record($this->input->post('id'));
			$path = 'images-sucursales/'.$prod->filename;
			if(is_link($path)){
				unlink($path);
			}
		

		$this->sucursal->delete_record();
		redirect('control/sucursales', 'refresh');
		

	}
}


} //end class

?>