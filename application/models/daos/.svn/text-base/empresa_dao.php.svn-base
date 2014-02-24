<?php if ( ! defined('BASEPATH')) exit('Você não deveria estar aqui');

class Empresa_dao extends CI_Model{
	private $table = 'empresa';
	
	public function insert($empresa = NULL){
		if($empresa != NULL){
			$this->db->insert($this->table, $empresa);
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
		if($empresa != NULL){
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
	
	public function getById($id=NULL){
		$this->db->where(array('id'=>$id, 'ativo'=>1));
		
		$query = $this->db->get($this->table);
		if($query->num_rows == 1){
			return $query->row();
		}
		return FALSE;
	}
}