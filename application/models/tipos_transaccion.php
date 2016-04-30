<?php  

class Tipos_transaccion extends CI_Model{

	public function __construct(){

	$this->load->database();

	}
	//all
	public function get_records($num,$start){
		$this->db->select()->from('tipos_transacciones')->order_by('id','ASC')->limit($num,$start);
		return $this->db->get();

	}

	//detail
	public function get_record($id){
		$this->db->where('id' ,$id);
		$this->db->limit(1);
		$c = $this->db->get('tipos_transacciones');

		return $c->row(); 
	}

	public function get_records_menu(){
		$this->db->select()->from('tipos_transacciones')->order_by('nombre','ASC');
		$rs = $this->db->get();
		return $rs->result();
	}
	
	//total rows
	public function count_rows(){ 
		$this->db->select('id')->from('tipos_transacciones');
		$query = $this->db->get();
		return $query->num_rows();
	}



		//add new
		public function add_record($data){ $this->db->insert('tipos_transacciones', $data);
				

	}


		//update
		public function update_record($id, $data){

			$this->db->where('id', $id);
			$this->db->update('tipos_transacciones', $data);

		}

		//destroy
		public function delete_record(){

			$this->db->where('id', $this->uri->segment(4));
			$this->db->delete('tipos_transacciones');
		}


		
		public function traer_nombre($id){
			$this->db->where('id' ,$id);
			$query = $this->db->get('tipos_transacciones');
			$this->db->limit(1);
			$res = $query->row();
			
			return $res->nombre;
			

		}
		
		

}

?>