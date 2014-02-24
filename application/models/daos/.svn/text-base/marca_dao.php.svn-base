<?php if ( ! defined('BASEPATH')) exit('Você não deveria estar aqui!');

class Marca_dao extends CI_Model{
	private $table = 'marca';
	
	public function getByTipo($tipo=NULL){
		if($tipo != NULL){
			$this->db->where('tipo', $tipo);
			$this->db->order_by('nome', 'asc');
			
			$query = $this->db->get($this->table);
			
			if($query->num_rows > 0){
				return $query;
			}
		}
		return FALSE;
	}
}

?>