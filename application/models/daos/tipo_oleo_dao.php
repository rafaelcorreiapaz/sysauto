<?php if ( ! defined('BASEPATH')) exit('Você não deveria estar aqui');

class Tipo_oleo_dao extends CI_Model{
	private $table = 'tipo_oleo';
	
	public function insert($tipoOleo = NULL){
		if($tipoOleo != NULL){
			$this->db->insert($this->table, $tipoOleo);
			if($this->db->affected_rows() > 0){
				setMsg('msgok', 'Cdastro efetuado com sucesso', 'sucesso');
				return true;
			} else {
				setMsg('msgnok', 'Erro ao inserir dados');
			}
		} 
		return false;
	}
	
	public function delete($where){
		if($tipoOleo != NULL){
			$this->db->delete($this->table, $where);
			if($this->db->affected_rows() > 0)
				//Setar mensagem
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
		return $this->db->get($this->table)->result();
	}
	
	public function getById($id=NULL){
		$this->db->where('id', $id);
		$query = $this->db->get($this->table);
		if($query->num_rows == 1){
			return $this->createInstance($query->row());
		}

		return FALSE;
	}
	
	private function createInstance($query) {
		$this->load->model('entities/tipo_oleo', 'tipoOleoEntity');
		
		$this->tipoOleoEntity->id($query->id);
		$this->tipoOleoEntity->tipo($query->tipo_oleo);
		

		return $this->tipoOleoEntity;
	}
}