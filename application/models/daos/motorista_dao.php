<?php if ( ! defined('BASEPATH')) exit('Você não deveria estar aqui');

class Motorista_dao extends CI_Model{
	private $table = 'empresa';
	
	public function desativarMotorista($idVeiculo, $idMotorista) {
		estaLogado();
		
		$this->db->update('veiculo_motorista', array('data_desativado'=>date('Y/m/d')), array('id_veiculo'=>$idVeiculo, 'id_motorista'=>$idMotorista));
		echo $this->db->last_query();
		if($this->db->affected_rows() == 1){
			return TRUE;
		} else {
			return FALSE;
		}
	}
	
}