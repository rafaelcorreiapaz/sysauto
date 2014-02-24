<?php if ( ! defined('BASEPATH')) exit('Você não deveria estar aqui!');

class Usuarios extends CI_Controller{

	public function __construct(){
		parent::__construct();
	}

	public function criarComboPerfilAcesso($id=NULL) {
		estaLogado();
		$result = $this->generic_dao->getAll('perfil_acesso');

		$array = array();
		if(is_array($result)){
			foreach ($result as $perfil_acesso) {
				$array[$perfil_acesso->id] = $perfil_acesso->perfil_acesso;
			}
		}
		echo json_encode($array);
	}
	
	public function deletarRegistro($id=NULL) {
		estaLogado();
	
		if($this->generic_dao->desativar('usuario', $id))
			echo 'ok';
		else
			echo 'nok';
	}
	
	public function ativarRegistro($id=NULL) {
		estaLogado();
	
		if($this->generic_dao->ativar('usuario', $id))
			echo 'ok';
		else
			echo 'nok';
	}
}