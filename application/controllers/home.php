<?php if ( ! defined('BASEPATH')) exit('Você não deveria estar aqui!');
class Home extends CI_Controller{
	
	public function __construct() {
		parent::__construct();
		initHome();
	}
	
	function index() {
		$this->inicio();
	}
	
	public function inicio() {
		if(estaLogado(false)){
			redirect('veiculos/gerenciar');
		} else {
			redirect('usuarios/login');
		}
	}
}
?>
