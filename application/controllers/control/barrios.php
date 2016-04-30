<?php 

class barrios extends CI_Controller{


public function __construct(){

	parent::__construct();
	$this->load->model('barrio');
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
	$per_page = 120;
	$page = $this->uri->segment(3);
	if(!$page){ $start =0; $page =1; }else{ $start = ($page -1 ) * $per_page; }
		$data['pagination_links'] = "";
		$total_pages = ceil($this->barrio->count_rows() / $per_page);

		if ($total_pages > 1){ 
			for ($i=1;$i<=$total_pages;$i++){ 
			if ($page == $i) 
				//si muestro el índice de la página actual, no coloco enlace 
				$data['pagination_links'] .=  '<li class="active"><a>'.$i.'</a></li>'; 
			else 
				//si el índice no corresponde con la página mostrada actualmente, coloco el enlace para ir a esa pagina 
				$data['pagination_links']  .= '<li><a href="'.base_url().'control/barrios/'.$i.'" > '. $i .'</a></li>'; 
		} 
	}
	//End Pagination

	$data['title'] = 'barrios';
	$data['menu'] = 'control/barrios/menu_barrio';
	$data['content'] = 'control/barrios/all';
	$data['query'] = $this->barrio->get_records($per_page,$start);

	$this->load->view('control/control_layout', $data);

}

//detail
public function detail(){

$data['title'] = 'barrio';
$data['content'] = 'control/barrios/detail';
$data['menu'] = 'control/barrios/menu_barrio';
$data['query'] = $this->barrio->get_record($this->uri->segment(4));
$this->load->view('control/control_layout', $data);
}


//new
public function form_new(){
$this->load->helper('form');
$data['title'] = 'Nuevo barrio';
$data['content'] = 'control/barrios/new_barrio';
$data['menu'] = 'control/barrios/menu_barrio';
$this->load->view('control/control_layout', $data);
}

//create
public function create(){

	$this->load->helper('form');
	$this->load->library('form_validation');
$this->form_validation->set_rules('nombre', 'Nombre', 'required');

	
	if ($this->form_validation->run() === FALSE){

		$this->load->helper('form');
		$data['title'] = 'Nuevo barrios';
		$data['content'] = 'control/barrios/new_barrio';
		$data['menu'] = 'control/barrios/menu_barrio';
		$this->load->view('control/control_layout', $data);

	}else{
		
		
		$this->load->helper('url');
		$slug = url_title($this->input->post('nombre'), 'dash', TRUE);
		

		$nombre_barrio = $this->input->post('localidad')." - ".$this->input->post('nombre');
		$newbarrio = array( 'nombre' => $nombre_barrio, 
			'localidad' =>$this->input->post('localidad'),
		 'slug' => $slug, 
		);




		#save
		$this->barrio->add_record($newbarrio);
		$this->session->set_flashdata('success', 'Barrio creado.');
		redirect('control/barrios', 'refresh');

	}



}

//edit
public function editar(){
	$this->load->helper('form');
	$data['title']= 'Editar barrio';	
	$data['content'] = 'control/barrios/edit_barrio';
	$data['menu'] = 'control/barrios/menu_barrio';
	$data['query'] = $this->barrio->get_record($this->uri->segment(4));
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

		$data['title'] = 'Nuevo barrio';
		$data['content'] = 'control/barrios/edit_barrio';
		$data['menu'] = 'control/barrios/menu_barrio';
		$data['query'] = $this->barrio->get_record($this->input->post('id'));
		$this->load->view('control/control_layout', $data);
	}else{		
		$id=  $this->input->post('id');

		
			$this->load->helper('url');
			$slug = url_title($this->input->post('nombre'), 'dash', TRUE);
		
		$nombre_barrio = $this->input->post('localidad')." - ".$this->input->post('nombre');
		$editedbarrio = array(  
		'nombre' => $nombre_barrio,
		'localidad' => $this->input->post('localidad'),
		'slug' => $slug,
		);
		#save
		$this->session->set_flashdata('success', 'barrio Actualizado!');
		$this->barrio->update_record($id, $editedbarrio);
		if($this->input->post('id')!=""){
			redirect('control/barrios', 'refresh');
		}else{
			redirect('control/barrios', 'refresh');
		}



	}



}


//delete comfirm		
public function delete_comfirm(){
	$this->load->helper('form');
	$data['content'] = 'control/barrios/comfirm_delete';
	$data['title'] = 'Eliminar barrio';
	$data['menu'] = 'control/barrios/menu_barrio';
	$data['query'] = $data['query'] = $this->barrio->get_record($this->uri->segment(4));
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

		$data['content'] = 'control/barrios/comfirm_delete';
		$data['title'] = 'Eliminar barrio';
		$data['menu'] = 'control/barrios/menu_barrio';
		$data['query'] = $this->barrio->get_record($this->input->post('id'));
		$this->load->view('control/control_layout', $data);
	}else{
		#validation passed
		$this->session->set_flashdata('success', 'barrio eliminado!');

		
		

		$this->barrio->delete_record();
		redirect('control/barrios', 'refresh');
		

	}
}


} //end class

?>