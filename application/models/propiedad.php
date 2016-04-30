<?php  

class Propiedad extends CI_Model{

public function __construct(){

	$this->load->database();
	//$this->output->enable_profiler(TRUE); 
	}
	//all
	public function get_records($num,$start){
	$this->db->select()->from('propiedades')->order_by('direccion','ASC')->limit($num,$start);
	$rs = $this->db->get();
	return $rs->result();
	}

public function get_por_codigo($codigo){
	
	$this->db->where('codigo' ,$codigo);
	$this->db->limit(1);
	$c = $this->db->get('propiedades');

	return $c->row(); 
	}


		public function get_records_busqueda($num,$start){
		#var_dump($this->session->userdata('filtro_barrio'));
		//por defecto no hay busqueda
		$hay_busqueda=false;
		//por defecto el orden es por ID, DESC.
		$hay_orden=false;
		$this->db->select()->from('propiedades');

		//CATEGORIA
		if( $this->input->post('tipo_propiedad') ){
			$hay_busqueda=true;
			$this->session->set_userdata('filtro_tipo_propiedad', $this->input->post('tipo_propiedad'));
			$this->db->where('categoria_id', $this->session->userdata('filtro_tipo_propiedad'));
		}else{
			$this->session->unset_userdata('filtro_tipo_propiedad');
		}
		//DORMITORIOS
		if( $this->input->post('cant_dorm') ){
			$hay_busqueda=true;
			$this->session->set_userdata('filtro_cant_dorm', $this->input->post('cant_dorm'));
			$this->db->where('cant_dormitorios', $this->session->userdata('filtro_cant_dorm'));
		}else{
			$this->session->unset_userdata('filtro_cant_dorm');
		}

		//MONEDA
		if( $this->input->post('moneda') ){
			$hay_busqueda=true;
			$this->session->set_userdata('filtro_moneda', trim($this->input->post('moneda') ) );
			$this->db->where('moneda', $this->session->userdata('filtro_moneda'));
		}else{
			$this->session->unset_userdata('filtro_moneda');
		}

		//LOCALIDAD
		if( $this->input->post('localidad') ){
			$hay_busqueda=true;
			$this->session->set_userdata('filtro_localidad', trim($this->input->post('localidad') ) );
			$this->db->where('localidad', $this->session->userdata('filtro_localidad'));
		}else{
			$this->session->unset_userdata('filtro_localidad');
		}
		
		//TRANSACCION
		if( $this->input->post('tipo_transaccion') ){
			$hay_busqueda=true;
			$this->session->set_userdata('filtro_transaccion', $this->input->post('tipo_transaccion'));
			$this->db->where('tipo_transaccion', $this->session->userdata('filtro_transaccion'));
		}else{
			$this->session->unset_userdata('filtro_transaccion');
		}

		//BARRIO
		if( $this->input->post('barrio') ){
			$hay_busqueda=true;
			####echo 'barrio:'.$this->input->post('barrio_filtro');
			$this->session->set_userdata('filtro_barrio', $this->input->post('barrio'));
			$this->db->where_in('propiedades.barrio', $this->session->userdata('filtro_barrio'));
		}else{
			$this->session->unset_userdata('filtro_barrio');
		}

		//PRECIO DESDE
		if( $this->input->post('precios_desde') ){
			$hay_busqueda=true;
			$this->session->set_userdata('filtro_precio_desde', $this->input->post('precios_desde'));
			$this->db->where('precio >', $this->session->userdata('filtro_precio_desde'));
		}else{
			$this->session->unset_userdata('filtro_precio_desde');
		}


		//PRECIO HASTA
		if( $this->input->post('precios_hasta') ){
			$hay_busqueda=true;
			$this->session->set_userdata('filtro_precio_hasta', $this->input->post('precios_hasta'));
			$this->db->where('precio <', $this->session->userdata('filtro_precio_hasta'));
		}else{
			$this->session->unset_userdata('filtro_precio_hasta');
		}

		
		if($hay_orden==false){
			$this->db->order_by('direccion','ASC');
		}


	$this->db->limit($num,$start);
	$rs = $this->db->get();
	return $rs->result();
	}

	public function count_rows_busqueda(){
		#var_dump($this->session->userdata('filtro_barrio'));
		//por defecto no hay busqueda
		$hay_busqueda=false;
		//por defecto el orden es por ID, DESC.
		$hay_orden=false;
		$this->db->select()->from('propiedades');

		//CATEGORIA
		if( $this->input->post('tipo_propiedad') ){
			$hay_busqueda=true;
			$this->session->set_userdata('filtro_tipo_propiedad', $this->input->post('tipo_propiedad'));
			$this->db->where('categoria_id', $this->session->userdata('filtro_tipo_propiedad'));
		}else{
			$this->session->unset_userdata('filtro_tipo_propiedad');
		}
		//DORMITORIOS
		if( $this->input->post('cant_dorm') ){
			$hay_busqueda=true;
			$this->session->set_userdata('filtro_cant_dorm', $this->input->post('cant_dorm'));
			$this->db->where('cant_dormitorios', $this->session->userdata('filtro_cant_dorm'));
		}else{
			$this->session->unset_userdata('filtro_cant_dorm');
		}

		//MONEDA
		if( $this->input->post('moneda') ){
			$hay_busqueda=true;
			$this->session->set_userdata('filtro_moneda', trim($this->input->post('moneda') ) );
			$this->db->where('moneda', $this->session->userdata('filtro_moneda'));
		}else{
			$this->session->unset_userdata('filtro_moneda');
		}

		//LOCALIDAD
		if( $this->input->post('localidad') ){
			$hay_busqueda=true;
			$this->session->set_userdata('filtro_localidad', trim($this->input->post('localidad') ) );
			$this->db->where('localidad', $this->session->userdata('filtro_localidad'));
		}else{
			$this->session->unset_userdata('filtro_localidad');
		}
		
		//TRANSACCION
		if( $this->input->post('tipo_transaccion') ){
			$hay_busqueda=true;
			$this->session->set_userdata('filtro_transaccion', $this->input->post('tipo_transaccion'));
			$this->db->where('tipo_transaccion', $this->session->userdata('filtro_transaccion'));
		}else{
			$this->session->unset_userdata('filtro_transaccion');
		}

		//BARRIO
		if( $this->input->post('barrio') ){
			$hay_busqueda=true;
			####echo 'barrio:'.$this->input->post('barrio_filtro');
			$this->session->set_userdata('filtro_barrio', $this->input->post('barrio'));
			$this->db->where_in('propiedades.barrio', $this->session->userdata('filtro_barrio'));
		}else{
			$this->session->unset_userdata('filtro_barrio');
		}

		//PRECIO DESDE
		if( $this->input->post('precios_desde') ){
			$hay_busqueda=true;
			$this->session->set_userdata('filtro_precio_desde', $this->input->post('precios_desde'));
			$this->db->where('precio >', $this->session->userdata('filtro_precio_desde'));
		}else{
			$this->session->unset_userdata('filtro_precio_desde');
		}


		//PRECIO HASTA
		if( $this->input->post('precios_hasta') ){
			$hay_busqueda=true;
			$this->session->set_userdata('filtro_precio_hasta', $this->input->post('precios_hasta'));
			$this->db->where('precio <', $this->session->userdata('filtro_precio_hasta'));
		}else{
			$this->session->unset_userdata('filtro_precio_hasta');
		}

		
		if($hay_orden==false){
			$this->db->order_by('direccion','ASC');
		}


	#$this->db->limit($num,$start);
	$query = $this->db->get();
	return $query->num_rows();


	}

	public function get_records_front($num,$start){

		//por defecto no hay busqueda
		$hay_busqueda=false;
		//por defecto el orden es por ID, DESC.
		$hay_orden=false;
		$this->db->select()->from('propiedades');
//"*, CAST(precio AS DECIMAL(10.2))"
		//CATEGORIA
		if( $this->input->post('tipo_propiedad_f') ){
			$hay_busqueda=true;
			$this->session->set_userdata('filtro_tipo_propiedad', $this->input->post('tipo_propiedad_f'));
			$this->db->where('categoria_id', $this->session->userdata('filtro_tipo_propiedad'));
		}else{
			$this->session->unset_userdata('filtro_tipo_propiedad');
		}
		//DORMITORIOS
		if( $this->input->post('cant_dorm') ){
			$hay_busqueda=true;
			$this->session->set_userdata('filtro_cant_dorm', $this->input->post('cant_dorm'));
			$this->db->where('cant_dormitorios', $this->session->userdata('filtro_cant_dorm'));
		}else{
			$this->session->unset_userdata('filtro_cant_dorm');
		}

		//MONEDA
		if( $this->input->post('moneda') ){
			$hay_busqueda=true;
			$this->session->set_userdata('filtro_moneda', trim($this->input->post('moneda') ) );
			$this->db->where('moneda', $this->session->userdata('filtro_moneda'));
		}else{
			$this->session->unset_userdata('filtro_moneda');
		}

		//LOCALIDAD
		if( $this->input->post('localidad') ){
			$hay_busqueda=true;
			$this->session->set_userdata('filtro_localidad', trim($this->input->post('localidad') ) );
			$this->db->where('localidad', $this->session->userdata('filtro_localidad'));
		}else{
			$this->session->unset_userdata('filtro_localidad');
		}
		
		//TRANSACCION
		if( $this->input->post('transaccion') ){
			$hay_busqueda=true;
			$this->session->set_userdata('filtro_transaccion', $this->input->post('transaccion'));
			$this->db->where('tipo_transaccion', $this->session->userdata('filtro_transaccion'));
		}else{
			$this->session->unset_userdata('filtro_transaccion');
		}

		//BARRIO
		if( $this->input->post('barrio') ){
			$hay_busqueda=true;
			####echo 'barrio:'.$this->input->post('barrio_filtro');
			$this->session->set_userdata('filtro_barrio', $this->input->post('barrio'));
			$this->db->where_in('propiedades.barrio', $this->session->userdata('filtro_barrio'));
		}else{
			$this->session->unset_userdata('filtro_barrio');
		}

		//PRECIOS
		if( $this->input->post('filtro_precio') ){

			$hay_orden=true;
			$this->session->set_userdata('filtro_precio', $this->input->post('filtro_precio'));
				if( $this->session->userdata('filtro_precio') == "alto_bajo"){
					$this->db->order_by('precio','DESC');

				}else{
					$this->db->order_by('precio','ASC');
				}
			
		}else{
			$this->session->unset_userdata('filtro_precio');
		}

		
		if($hay_orden==false){
			$this->db->order_by('direccion','ASC');
		}


	$this->db->limit($num,$start);
	$rs = $this->db->get();
	return $rs->result();
	}



	public function get_destacadas($limit){
	$this->db->select()->from('propiedades')->where('destacada',1)->order_by('direccion','ASC');
	$rs = $this->db->get();
	return $rs->result();
	}


	//detail
	public function get_record($id){
	$this->db->where('id' ,$id);
	$this->db->limit(1);
	$c = $this->db->get('propiedades');

	return $c->row(); 
	}

	//total rows
	public function count_rows(){ 
	$this->db->select('id')->from('propiedades');
	$query = $this->db->get();
	return $query->num_rows();
	}



	//add new
	public function add_record($data){ $this->db->insert('propiedades', $data);


	}


	//update
	public function update_record($id, $data){

	$this->db->where('id', $id);
	$this->db->update('propiedades', $data);

	}

	//destroy
	public function delete_record(){

	$this->db->where('id', $this->uri->segment(4));
	$this->db->delete('propiedades');
	}

	//update
	public function update_main($id, $data){

	$this->db->where('id', $id);
	$this->db->update('propiedades', $data);

	}
	/*
	public function traer_nombre($id){
	$this->db->where('propiedades_categoria_id' ,$id);
	$this->db->limit(1);
	$c = $this->db->get('propiedades');

	return $c->row('nombre'); 
	}

	*/

}

?>