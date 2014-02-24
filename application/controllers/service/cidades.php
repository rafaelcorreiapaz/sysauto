<?php if ( ! defined('BASEPATH')) exit('Você não deveria estar aqui!');

class Cidades extends CI_Controller{

	public function __construct(){
		parent::__construct();
	}

	public function criarComboCidades($idEstado, $id=NULL) {
		estaLogado();
		$this->load->model('daos/cidade_dao', 'cidadeDao');

		$result = $this->cidadeDao->getByIdEstado($idEstado);
		$array = array();
		if($result != FALSE){
			$result = $result->result();
	
			foreach ($result as $cidade) {
				$array[$cidade->id] = $cidade->nome;
			}
		}
		echo json_encode($array);
	}
	
	public function criarComboEstados($id=NULL) {
		estaLogado();
	
		$result = $this->generic_dao->getAll('estado');
		$array = array();
		if($result != FALSE){
	
			foreach ($result as $estado) {
				$array[$estado->id] = $estado->nome;
			}
		}
		echo json_encode($array);
	}
	
	public function getCep($id) {
		estaLogado();
	
		$this->load->model('daos/cidade_dao', 'cidadeDao');
	
		$result = $this->cidadeDao->getCep($id);
		if($result != FALSE){
			echo json_encode($result->cep);
		} else {
			echo json_encode(array(''));
		}
	}
}