<?php use Doctrine\DBAL\Types\IntegerType;
if ( ! defined('BASEPATH')) exit('Você não deveria estar aqui!');

class Ano_modelo_dao extends CI_Model{
	private $table = 'ano_modelo';
	
	public function insert($modelo = NULL){
		if($modelo != NULL){
			$this->db->insert($this->table, $modelo);
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
		if($modelo != NULL){
			$this->db->delete($this->table, $where);
			if($this->db->affected_rows() > 0)
				setMsg('msgok', 'Modelo removido com sucesso', 'sucesso');
				return true;
		}
		return false;
	}
	
	public function update($dados, $condicao){
		if($dados != NULL){
			$this->db->update($this->table, $dados, $condicao);
			if($this->db->affected_rows() > 0){
				setMsg('msgok', 'Modelo atualizado com sucesso', 'sucesso');
				return true;
			}
		}
		return false;
	}
	
	public function getAll(){
		return $this->db->get($this->table);
	}

	public function getById($id){
		$this->db->where('id', $id);
		$query = $this->db->get($this->table);
		if($query->num_rows == 1){
			return $this->createInstance($query->row());
		}

		return FALSE;
	}
	
	public function getByIdModelo($id){
		$this->db->where('modelo', $id);
		$query = $this->db->get($this->table);
		if($query->num_rows >= 1){
			return $query;
		}
	
		return FALSE;
	}
	
	private function createInstance($query) {
		$this->load->model('entities/modelo', 'modeloEntity');
		
		$this->modeloEntity->id($query->id);
		$this->modeloEntity->nome($query->nome);
		$this->modeloEntity->marca($query->marca);
		$this->modeloEntity->idTipoModelo($query->id_tipo_modelo);

		return $this->modeloEntity;
	}
	
	
}

?>