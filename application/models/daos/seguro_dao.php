<?php if ( ! defined('BASEPATH')) exit('Você não deveria estar aqui');

class Seguro_dao extends CI_Model{
	private $table = 'seguro';
	
	public function insert($seguro = NULL){
		if($seguro != NULL){
			$this->db->insert($this->table, $seguro);
			if($this->db->affected_rows() > 0){
				setMsg('msgok', 'Seguro cadastrado com sucesso', 'sucesso');
				return true;
			} else {
				setMsg('msgnok', 'Erro ao inserir dados');
			}
		} 
		return false;
	}
	
	public function delete($where){
		if($where != NULL){
			$this->db->delete($this->table, $where);
			if($this->db->affected_rows() > 0)
				return true;
		}
		return false;
	}
	
	public function update($dados=NULL, $condicao=NULL){
		if($dados != NULL){
			$this->db->update($this->table, $dados, $condicao);
			if($this->db->affected_rows() > 0){
				return true;
			}
		}
		return false;
	}
	
	public function getAll(){
		return $this->db->get($this->table);
	}
	
	public function get_byId($id=NULL){
		$this->db->where('id', $id);
		$query = $this->db->get($this->table);
		if($query->num_rows == 1){
			return $query;
		}

		return FALSE;
	}
}