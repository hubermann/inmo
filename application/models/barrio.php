<?php  

class Barrio extends CI_Model{

	public function __construct(){

	$this->load->database();

	}
	//all
	public function get_records($num,$start){
		$this->db->select()->from('barrios')->order_by('nombre','ASC')->limit($num,$start);
		return $this->db->get();

	}

	public function get_records_menu(){
		$this->db->select()->from('barrios')->order_by('nombre','ASC');
		$rs = $this->db->get();
		return $rs->result();
	}

	public function get_por_localidad($localidad){
		$this->db->select()->from('barrios')->where('localidad', $localidad)->order_by('nombre','ASC');
		$rs = $this->db->get();
		return $rs->result();
	}



public function get_records_front(){
		$this->db->select()->from('barrios');
		$rs = $this->db->get();
		return $rs->result();

	}
	//detail
	public function get_record($id){
		$this->db->where('id' ,$id);
		$this->db->limit(1);
		$c = $this->db->get('barrios');

		return $c->row(); 
	}
	
	//total rows
	public function count_rows(){ 
		$this->db->select('id')->from('barrios');
		$query = $this->db->get();
		return $query->num_rows();
	}



		//add new
		public function add_record($data){ $this->db->insert('barrios', $data);
				

	}


		//update
		public function update_record($id, $data){

			$this->db->where('id', $id);
			$this->db->update('barrios', $data);

		}

		//destroy
		public function delete_record(){

			$this->db->where('id', $this->uri->segment(4));
			$this->db->delete('barrios');
		}


		
		public function traer_nombre($id){
					$this->db->where('id' ,$id);
					$this->db->limit(1);
					$c = $this->db->get('barrios');

					return $c->row('nombre'); 
				}
		
		

}

?>