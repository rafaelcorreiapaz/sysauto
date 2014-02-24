<?php if ( ! defined('BASEPATH')) exit('Você não deveria estar aqui');

class Menu_dao extends CI_Model{
	private $table = 'menu';
	
	public function insert($menu = NULL){
		if($menu != NULL){
			$this->db->insert($this->table, $menu);
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
		if($menu != NULL){
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
		return $this->db->get($this->table);
	}
}