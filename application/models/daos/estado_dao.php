<?php if ( ! defined('BASEPATH')) exit('Você não deveria estar aqui');

class Estado_dao extends CI_Model{
	private $table = 'estado';
	
	public function getIdEstado($idCidade) {
		$idEstado = $this->generic_dao->getById('cidade', $idCidade)->id_estado;
		
		$this->db->from($this->table);
		$this->db->where('id', $idEstado);
		
		$query = $this->db->get();

		if($query->num_rows == 1){
			return $query->row();
		}
		
		return FALSE;
	}
}