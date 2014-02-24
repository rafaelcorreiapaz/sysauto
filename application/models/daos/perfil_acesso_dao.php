<?php if ( ! defined('BASEPATH')) exit('Você não deveria estar aqui');

class Cidade_dao extends CI_Model{
	private $table = 'cidade';
	
	public function insert($cidade = NULL){
		if($cidade != NULL){
			$this->db->insert($this->table, $cidade);
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
		if($cidade != NULL){
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
	
	public function getByIdEstado($id=NULL){
		$this->db->where('id_estado', $id);
		$query = $this->db->get($this->table);
		if($query->num_rows >= 1){
			return $query;
		}
		return FALSE;
	}
	
	private function createInstance($query) {
		$this->load->model('entities/cidade', 'cidadeEntity');
		
		$this->cidadeEntity->id($query->id);
		$this->cidadeEntity->placa($query->placa);
		$this->cidadeEntity->kmAtual($query->km_atual);
		$this->cidadeEntity->mediaKmDia($query->media_km_dia);
		$this->cidadeEntity->mediaKmLitro($query->media_km_litro);
		$this->cidadeEntity->ultimaTrocaOleo($query->ultima_troca_oleo);
		$this->cidadeEntity->kmUltimaTrocaOleo($query->km_ultima_troca_oleo);
		$this->cidadeEntity->ultimaTrocaPneus($query->ultima_troca_pneus);
		$this->cidadeEntity->kmUltimaTrocaPneus($query->km_ultima_troca_pneus);
		$this->cidadeEntity->capacidadeCarga($query->campacidade_carga);
		$this->cidadeEntity->tipoEixo($query->tipo_eixo);
		$this->cidadeEntity->idCliente($query->id_cliente);
		$this->cidadeEntity->idTipoBau($query->id_tipo_bau);
		$this->cidadeEntity->idTipoOleo($query->id_tipo_oleo);
		$this->cidadeEntity->idAnoModelo($query->id_ano_modelo);
		$this->cidadeEntity->idSeguro($query->id_seguro);
		$this->cidadeEntity->idcidade($query->id_cidade);
		

		return $this->cidadeEntity;
	}
}