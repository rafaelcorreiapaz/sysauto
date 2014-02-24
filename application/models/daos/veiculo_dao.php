<?php if ( ! defined('BASEPATH')) exit('Você não deveria estar aqui');

class Veiculo_dao extends CI_Model{
	private $table = 'veiculo';
	
	public function getByPlaca($placa){
		$this->db->where('placa', $placa);
		$this->db->where('id_empresa', $this->session->userdata('empresa_id'));
		$query = $this->db->get($this->table);
		
		if($query->num_rows == 1){
			return $query->row();
		}
		return FALSE;
	}
	
	public function getAllWithModel(){
		$this->db->select('V.id, V.placa, AM.nome AS ano_modelo, MO.nome AS modelo, MA.nome AS marca, V.ativo');
		$this->db->from('veiculo V');
		$this->db->join('ano_modelo AM', 'V.id_ano_modelo = AM.id');
		$this->db->join('modelo MO', 'MO.id = AM.modelo');
		$this->db->join('marca MA', 'MA.id = MO.marca');
		$this->db->where('id_empresa', $this->session->userdata('empresa_id'));
		
		$query = $this->db->get();

		if($query->num_rows > 0){
			return $query->result();
		}
		return array();
	}
	
	public function veiculosSemSeguro() {
		$this->db->select('V.id, V.placa, AM.nome AS ano_modelo, MO.nome AS modelo, MA.nome AS marca, V.ativo');
		$this->db->from('veiculo V');
		$this->db->join('ano_modelo AM', 'V.id_ano_modelo = AM.id');
		$this->db->join('modelo MO', 'MO.id = AM.modelo');
		$this->db->join('marca MA', 'MA.id = MO.marca');
		$this->db->where('id_empresa', $this->session->userdata('empresa_id'));
		$this->db->where('V.id_seguro', NULL);
		$this->db->where('V.ativo', TRUE);
		
		$query = $this->db->get(); 
		
		if($query->num_rows > 0){
			return $query->result();
		}
		return array();
	}
	
	public function pegarUltimoKmAtual($id) {
		$query = $this->db->select('km_atual')->from('gasto')->where('ativo', TRUE)->where('id_veiculo', $id)->order_by('id DESC')->limit(1)->get();
		
		if($query->num_rows == 1){
			return $query->row();
		} else {
			$query = $this->db->select('km_atual')->from($this->table)->where('ativo', TRUE)->where('id', $id)->get();
			
			if($query->num_rows == 1){
				return $query->row(); 
			}
		}
		return array('error');
	}
	
	public function veiculoTemMotorista($id) {
		if($id == NULL)
			return 'ID NULL';
		$this->db->select('M.id, M.nome, M.cpf');
		$this->db->from('motorista M');
		$this->db->join('veiculo_motorista VM', 'M.id = VM.id_motorista');
		$this->db->where('VM.id_veiculo', $id);
		$this->db->where('VM.data_desativado', NULL);
		$query = $this->db->get();
		 
		if($query->num_rows == 1){
			$query = $query->row();
				return json_encode(array('id'=>$query->id, 'nome'=>$query->nome, 'cpf'=> $query->cpf));
		}
		
		return json_encode(array('ok'=>'Veículo sem motorista'));
	}

	public function getVeiculoByMotorista($id) {
		$this->db->select('V.id, V.placa, AM.nome AS ano_modelo, MO.nome AS modelo, MA.nome AS marca, V.ativo');
		$this->db->from('veiculo V');
		$this->db->join('ano_modelo AM', 'V.id_ano_modelo = AM.id');
		$this->db->join('modelo MO', 'MO.id = AM.modelo');
		$this->db->join('marca MA', 'MA.id = MO.marca');
		$this->db->join('veiculo_motorista VM', 'VM.id_veiculo = V.id');
		$this->db->join('motorista M', 'VM.id_motorista = M.id');
		$this->db->where('M.id', $id);
		$this->db->where('M.id_empresa', $this->session->userdata('empresa_id'));
		
		$query = $this->db->get();

		if($query->num_rows == 1){
			return $query->row();
		}
		
		return FALSE;
	}
}