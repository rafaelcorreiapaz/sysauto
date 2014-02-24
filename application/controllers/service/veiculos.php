<?php if ( ! defined('BASEPATH')) exit('Você não deveria estar aqui!');

class Veiculos extends CI_Controller{

	public function __construct(){
		parent::__construct();
	}

	public function criarComboMarcas($tipo, $id=NULL) {
		estaLogado();
		$this->load->model('daos/marca_dao', 'marcaDao');
		
		$result = $this->marcaDao->getByTipo($tipo);
		$marcas = array();
		if($result != FALSE){
			$result = $result->result();
			
			foreach ($result as $marca) {
				$marcas[$marca->id] = $marca->nome;
			}
		}
		echo json_encode($marcas);
	}
	
	public function criarComboModelos($id) {
		estaLogado();
		$this->load->model('daos/modelo_dao', 'modeloDao');
	
		$result = $this->modeloDao->getByIdMarca($id);
		$modelos = array();
		if($result != FALSE){
			$result = $result->result();
			foreach ($result as $modelo) {
				$modelos[$modelo->id] = $modelo->nome;
			}
		}
		echo json_encode($modelos);
	}
	
	public function criarComboAnoModelo($id=NULL) {
		estaLogado();
		$this->load->model('daos/ano_modelo_dao', 'anoModeloDao');
		
		$result = $this->anoModeloDao->getByIdModelo($id);
		if($result != FALSE){
			$result = $result->result();
	
			$ano_modelos = array();
			foreach ($result as $ano_modelo) {
				$ano_modelos[$ano_modelo->id] = $ano_modelo->nome;
			}
		}
		echo json_encode($ano_modelos);
	}
	
	public function criarComboTipoOleo($id=NULL) {
		estaLogado();
	
		$this->load->model('daos/tipo_oleo_dao', 'tipoOleoDao');
	
		$result = $this->tipoOleoDao->getAll();
		$array = array();
		
		if(is_array($result)){
			foreach ($result as $tipoOleo) {
				$array[$tipoOleo->id] = $tipoOleo->tipo_oleo;
			}
		}
		echo json_encode($array);
	}
	
	public function criarComboTipoGasto($id=NULL) {
		estaLogado();
		$result = $this->generic_dao->getAll('tipo_gasto');
		$tipoGastos = array();
		
		if(is_array($result)){
			foreach ($result as $tipoGasto) {
				$tipoGastos[$tipoGasto->id] = $tipoGasto->tipo_gasto;
			}
		}
		echo json_encode($tipoGastos);
	}
	
	public function pegarUltimoKmAtual($id){
		estaLogado();
		$this->load->model('daos/veiculo_dao', 'veiculoDao');
		
		$ultimoKmAtual = $this->veiculoDao->pegarUltimoKmAtual($id);
		
		if($ultimoKmAtual != FALSE){
			echo $ultimoKmAtual->km_atual;
		}
		echo '';		
	}
	
	public function veiculoTemMotorista($id){
		estaLogado();
		$this->load->model('daos/veiculo_dao', 'veiculoDao');
			
		echo $this->veiculoDao->veiculoTemMotorista($id);
	}
	
	public function desativarMotorista() {
		estaLogado();
		$this->load->model('daos/motorista_dao', 'motoristaDao');
		
		$ids = elements(array('idVeiculo', 'idMotorista'), $this->input->post());
		if($this->motoristaDao->desativarMotorista($ids['idVeiculo'], $ids['idMotorista']))
			echo 'ok';
		else
			echo 'nok';
	}

	public function deletarRegistro($id) {
		estaLogado();
		
		if($this->generic_dao->desativar('veiculo', $id))
			echo 'ok';
		else
			echo 'nok';
	}
}