<?php if ( ! defined('BASEPATH')) exit('Você não deveria estar aqui!');

class Veiculo_bi extends CI_Model{
	public function cadastrarVeiculoComSeguto($veiculo, $seguro) {
		//Carregar models para trabalhar, se eles já estiverem carregados o ignorará a chamada
		$this->load->model('daos/veiculo_dao', 'veiculoDao');
		$this->load->model('daos/seguro_dao', 'seguroDao');
		
		//Iniciar uma transação
		$this->db->trans_begin();
		
		//Insiro o veículo no banco
		if($this->seguroDao->insert($seguro)){
			$veiculo['id_seguro'] = $this->db->insert_id();
			
			if($this->db->trans_status() === TRUE && $this->veiculoDao->insert($veiculo)){
				if($this->db->trans_status() === TRUE){
					setMsg('msgok', 'Cadastro efetuado com sucesso!');
					$this->db->trans_commit();
					return TRUE;
				} else {
					setMsg('msgnok', 'Cadastro não efetuado', 'erro');
					$this->db->trans_rollback();
				} 
			}
		}
		return FALSE;
	}
}
?>