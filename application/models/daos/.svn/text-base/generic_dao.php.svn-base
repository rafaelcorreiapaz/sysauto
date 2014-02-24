<?php if ( ! defined('BASEPATH')) exit('Você não deveria estar aqui');

class Generic_dao extends CI_Model{

	public function insert($table, $dados){
		$this->db->insert($table, $dados);
		
		if($this->db->affected_rows() >= 1){
			return TRUE;
		}
		return FALSE;
	}
	/**
	 * @name delete
	 * @param String $table
	 * @param String $condicao
	 * @return boolean
	 * @deprecated
	 * Não utilize este método, ao invés dele use o desativar
	 */
	public function delete($table, $condicao){
		if($marca != NULL){
			$this->db->delete($table, $condicao);
			if($this->db->affected_rows() > 0)
				return TRUE;
		}
		return FALSE;
	}
	
	public function update($table, $dados, $condicao){
			$this->db->update($table, $dados, $condicao);
			
			if($this->db->affected_rows() > 0){
				return TRUE;
			}
		return FALSE;
	}
	
	public function getAll($table){
		if($table != NULL){
			return $this->db->get($table)->result();
		}
		return array();
	}
	
	public function getById($table, $id){
		if($table != NULL){
			$this->db->where('id', $id);
			
			$result = $this->db->get($table);
			
			if($result->num_rows == 1){
				return $result->row();
			}
		}
		return FALSE;
	}
	
	public function desativar($table, $id){
		$this->db->update($table, array('ativo'=>0), array('id'=>$id));
		if($this->db->affected_rows() > 0){
			return TRUE;
		}
		return FALSE;
	}
	
	public function ativar($table, $id){
		$this->db->update($table, array('ativo'=>1), array('id'=>$id));
		if($this->db->affected_rows() > 0){
			return TRUE;
		}
		return FALSE;
	}
}