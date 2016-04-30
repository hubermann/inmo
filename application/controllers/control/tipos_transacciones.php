<?php 

class tipos_transacciones extends CI_Controller{


public function __construct(){

	parent::__construct();
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

}

public function index(){
	//Pagination
	$per_page = 20;
	$page = $this->uri->segment(3);
	if(!$page){ $start =0; $page =1; }else{ $start = ($page -1 ) * $per_page; }
		$data['pagination_links'] = "";
		$total_pages = ceil($this->tipos_transaccion->count_rows() / $per_page);

		if ($total_pages > 1){ 
			for ($i=1;$i<=$total_pages;$i++){ 
			if ($page == $i) 
				//si muestro el índice de la página actual, no coloco enlace 
				$data['pagination_links'] .=  '<li class="active"><a>'.$i.'</a></li>'; 
			else 
				//si el índice no corresponde con la página mostrada actualmente, coloco el enlace para ir a esa pagina 
				$data['pagination_links']  .= '<li><a href="'.base_url().'control/tipos_transacciones/'.$i.'" > '. $i .'</a></li>'; 
		} 
	}
	//End Pagination

	$data['title'] = 'Tipos de transacciones';
	$data['menu'] = 'control/tipos_transacciones/menu_tipos_transaccion';
	$data['content'] = 'control/tipos_transacciones/all';
	$data['query'] = $this->tipos_transaccion->get_records($per_page,$start);

	$this->load->view('control/control_layout', $data);

}

//detail
public function detail(){

$data['title'] = 'tipos_transaccion';
$data['content'] = 'control/tipos_transacciones/detail';
$data['menu'] = 'control/tipos_transacciones/menu_tipos_transaccion';
$data['query'] = $this->tipos_transaccion->get_record($this->uri->segment(4));
$this->load->view('control/control_layout', $data);
}


//new
public function form_new(){
$this->load->helper('form');
$data['title'] = 'Nuevo tipo de transaccion';
$data['content'] = 'control/tipos_transacciones/new_tipos_transaccion';
$data['menu'] = 'control/tipos_transacciones/menu_tipos_transaccion';
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
		$data['title'] = 'Nuevo tipo de transaccion';
		$data['content'] = 'control/tipos_transacciones/new_tipos_transaccion';
		$data['menu'] = 'control/tipos_transacciones/menu_tipos_transaccion';
		$this->load->view('control/control_layout', $data);

	}else{
		

		$this->load->helper('url');
		$slug = url_title($this->input->post('nombre'), 'dash', TRUE);
	


		$newtipos_transaccion = array( 'nombre' => $this->input->post('nombre'), 
		'slug' => $slug, 
		);
		#save
		$this->tipos_transaccion->add_record($newtipos_transaccion);
		$this->session->set_flashdata('success', 'Tipo de transaccion creada. <a href="tipos_transacciones/detail/'.$this->db->insert_id().'">Ver</a>');
		redirect('control/tipos_transacciones', 'refresh');

	}



}

//edit
public function editar(){
	$this->load->helper('form');
	$data['title']= 'Editar tipos de transaccion';	
	$data['content'] = 'control/tipos_transacciones/edit_tipos_transaccion';
	$data['menu'] = 'control/tipos_transacciones/menu_tipos_transaccion';
	$data['query'] = $this->tipos_transaccion->get_record($this->uri->segment(4));
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

		$data['title'] = 'Nuevo tipo de transaccion';
		$data['content'] = 'control/tipos_transacciones/edit_tipos_transaccion';
		$data['menu'] = 'control/tipos_transacciones/menu_tipos_transaccion';
		$data['query'] = $this->tipos_transaccion->get_record($this->input->post('id'));
		$this->load->view('control/control_layout', $data);

	}else{		
		$id=  $this->input->post('id');

		$this->load->helper('url');
		$slug = url_title($this->input->post('nombre'), 'dash', TRUE);


		$editedtipos_transaccion = array(  
		'nombre' => $this->input->post('nombre'),

		'slug' => $slug,
		);
		#save
		$this->session->set_flashdata('success', 'tipo de transaccion actualizado!');
		$this->tipos_transaccion->update_record($id, $editedtipos_transaccion);
		if($this->input->post('id')!=""){
			redirect('control/tipos_transacciones', 'refresh');
		}else{
			redirect('control/tipos_transacciones', 'refresh');
		}



	}



}


//delete comfirm		
public function delete_comfirm(){
	$this->load->helper('form');
	$data['content'] = 'control/tipos_transacciones/comfirm_delete';
	$data['title'] = 'Eliminar tipo de transaccion';
	$data['menu'] = 'control/tipos_transacciones/menu_tipos_transaccion';
	$data['query'] = $data['query'] = $this->tipos_transaccion->get_record($this->uri->segment(4));
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

		$data['content'] = 'control/tipos_transacciones/comfirm_delete';
		$data['title'] = 'Eliminar tipo de transaccion';
		$data['menu'] = 'control/tipos_transacciones/menu_tipos_transaccion';
		$data['query'] = $this->tipos_transaccion->get_record($this->input->post('id'));
		$this->load->view('control/control_layout', $data);
	}else{
		#validation passed
		$this->session->set_flashdata('success', 'Tipo de transaccion eliminado!');


		$this->tipos_transaccion->delete_record();
		redirect('control/tipos_transacciones', 'refresh');
		

	}
}


} //end class

?>