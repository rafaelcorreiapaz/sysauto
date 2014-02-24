<?php if ( ! defined('BASEPATH')) exit('Você não deveria estar aqui');

class Usuario_dao extends CI_Model{
	private $table = 'usuario';
	
	public function insert($cliente = NULL){
		if($cliente != NULL){
			$this->db->insert($this->table, $cliente);
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
		if($cliente != NULL){
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
	
	public function doLogin($email=NULL, $senha=NULL){
		if($email != NULL && $senha != NULL){
			$this->db->where('email', $email);
			$this->db->where('senha', $senha);
			$this->db->where('ativo', 1);
			
			$query = $this->db->get($this->table);
			if($query->num_rows == 1){
				return TRUE;
			} else {
				return FALSE;
			}
		} else {
			return FALSE;
		}
	}
	
	public function getByEmail($email=NULL){
		if($email != NULL){
			$this->db->where('email', $email);
			$this->db->limit(1);
			$query = $this->db->get($this->table);
			
			if($query->num_rows == 1){
				return $query->row();
			}else 
				setMsg('msgnok', 'Email inexistente');
		}
		return FALSE;
	}
	
	public function getPerfilId($id) {
		$query = $this->db->query("SELECT id_perfil_acesso FROM $this->table WHERE id=$id");
		
		if($query->num_rows == 1){
			return $query->row();
		}
		return FALSE;
	}
}