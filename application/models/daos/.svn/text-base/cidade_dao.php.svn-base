<?php if ( ! defined('BASEPATH')) exit('Você não deveria estar aqui');

class Cidade_dao extends CI_Model{
	private $table = 'cidade';
	
	public function getByIdEstado($id=NULL){
		$this->db->where('id_estado', $id);
		$query = $this->db->get($this->table);
		if($query->num_rows >= 1){
			return $query;
		}
		return FALSE;
	}
	
	public function getCep($id) {
		$this->db->select('cep');
		$this->db->from($this->table);
		$this->db->where('id', $id);
		
		$query = $this->db->get();
		
		if($query->num_rows == 1){
			return $query->row();
		}
		return FALSE;
	}
}