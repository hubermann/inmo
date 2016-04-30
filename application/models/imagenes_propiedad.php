<?php  

class Imagenes_propiedad extends CI_Model{

	public function __construct(){

	$this->load->database();

	}
	//all
	public function get_records($num,$start){
		$this->db->select()->from('imagenes_propiedades')->limit($num,$start);
		$rs = $this->db->get();
		return $rs->result();
	}
	
	
	
	function view_all($id){
		
		$this->db->where('propiedad_id', $id);
		$rs =  $this->db->get('imagenes_propiedades');
		return $rs->result();
		
		}
		
	//all by publiccacion
	public function imagenes_propiedad($id_propiedad){

		$this->db->select()->from('imagenes_propiedades')->where('propiedad_id',$id_propiedad);
		$rs= $this->db->get();
		return $rs->result();

	}

	//detail
	public function get_record($id){
		$this->db->where('id' ,$id);
		$this->db->limit(1);
		$c = $this->db->get('imagenes_propiedades');

		return $c->row(); 
	}

	public function traer_una($id){
		$this->db->where('propiedad_id' ,$id);
		$this->db->limit(1)->order_by('id','ASC');
		$c = $this->db->get('imagenes_propiedades');

		return $c->row(); 
	}
	
	public function get_records_menu(){
			$this->db->select()->from('imagenes_propiedades')->order_by('id','ASC');
			return $this->db->get();
	
		}


	
	//total rows
	public function count_rows(){ 
		$this->db->select('id')->from('imagenes_propiedades');
		$query = $this->db->get();
		return $query->num_rows();
	}

	//total rows
	public function total_por_propiedad($id_propiedad){ 
		$this->db->select('id')->from('imagenes_propiedades')->where('propiedad_id',$id_propiedad);
		$query = $this->db->get();
		return $query->num_rows();
	}



		//add new
		public function add_record($data){ 
		
		$this->db->insert('imagenes_propiedades', $data);
		}


		//update
		public function update_record($id, $data){

			$this->db->where('id', $id);
			$this->db->update('imagenes_propiedades', $data);

		}

		//destroy
		public function delete_record($id_imagen){

			$this->db->where('id', $id_imagen);
			$this->db->delete('imagenes_propiedades');
		}


		public function delete_por_propiedad($id_propiedad){

			$this->db->where('propiedad_id', $id_propiedad);
			$this->db->delete('imagenes_propiedades');
		}
		
		public function get_filename($id){
			$this->db->where('id' ,$id);
			$query = $this->db->get('imagenes_propiedades');
			$this->db->limit(1);
			$res = $query->row();
			return $res->filename;

		}




}


?>