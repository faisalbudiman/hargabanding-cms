<?php if (!defined('BASEPATH')) exit ('No direct script access allowed');

class _Process_MYSQL extends CI_Model {

	public function read_data($table, $orderidentity, $orderby, $where = null)
	{
		$this->db->select('*');
		$this->db->from($table);
		$this->db->order_by($orderidentity, $orderby);

		if ($where) {
			$this->db->where($where);
		}

		return $this->db->get();
	}

	public function insert_data($table,$data)
	{
		$this->db->insert($table,$data);
		return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
	}

	public function get_data($table,$identity){       
		return $this->db->get_where($table,$identity);
	} 

	public function get_data_multiple($table,$id,$identity){

		$this->db->select('*');

		$this->db->from($table);

		if(is_array($id)){
			$this->db->where_in($identity, $id);
		}else{
			$this->db->where($identity, $id);
		}
		return $this->db->get();
	}

	public function update_data($table,$data,$identity){
		$this->db->trans_start();
		$this->db->update($table, $data, $identity);
		$this->db->trans_complete();
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			if ($this->db->trans_status() === FALSE) {
				return false;
			}
			return true;
		}
	}

	public function delete_data($table, $identity)
	{
		$this->db->delete($table,$identity);
		return ($this->db->affected_rows() > 0) ? TRUE : FALSE;          
	}

	public function delete_data_multiple($table,$id,$identity)
	{
		if(is_array($id)){
			$this->db->where_in($identity, $id);
		}else{
			$this->db->where($identity, $id);
		}
		$this->db->delete($table);
		return ($this->db->affected_rows() > 0) ? TRUE : FALSE;          
	}	

}
