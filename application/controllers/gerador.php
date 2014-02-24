<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gerador extends CI_Controller{

	public $anoModelo = NULL;
	public $dataAtual;
	
	public $numeroEmpresas = 5;
	public $numeroVeiculos = 15;


	public function __construct(){
		$this->dataAtual = date('Y-m-d', strtotime('2013-1-1'));

		parent::__construct();
		initHome();
	}

	public function index(){
		$this->gerarDados();
	}

	public function gerar_dados() {
		
		$this->load->model('daos/veiculo_dao', 'veiculoDao');
		
		$arrayIdEmpresas = array();
		$arrayIdVeiculos = array();
		
		// EMPRESAS
		for($i = 0; $i<$this->numeroEmpresas ;$i++){
			//Gera as empresas
			$this->db->insert('empresa',array(
					'cnpj'=>rand(100, 999),
					'nome_fantasia'=>"Empresa $i"
			));
			
			$arrayIdEmpresas[] = $this->db->insert_id();
			
			$this->db->insert('usuario', array(
					'nome'=>"Nome $i",
					'email'=>"email$i@gmail.com",
					'telefone'=>"($i$i) $i$i$i$i-$i$i$i$i",
					'cep'=> '37550-000',
					'senha'=>md5("$i$i$i$i"),
					'id_empresa'=>$this->db->insert_id(),
					'id_sexo'=>1,
					'id_perfil_acesso'=>1,
					'id_cidade'=>3654
			));
		}
		
		// VEICULOS 
		foreach ($arrayIdEmpresas as $empresa){
			for ($j = 0; $j<$this->numeroVeiculos ;$j++){
	
				$this->db->insert('veiculo',array(
						'placa'=>$this->gerarPlacas(),
						'km_atual'=>rand(100, 99999),
						'media_km_dia'=>rand(4, 250),
						'media_km_litro'=>rand(3, 15),
						'id_empresa' => $empresa,
						'id_ano_modelo'=>$this->getAnoModelo(),
						'id_cidade'=>3654,
						'id_tipo_oleo'=>rand(1, 3)
				));
	
				$idVeiculo = $this->db->insert_id();
	
				$this->db->insert('motorista',array(
						'nome'=>"nome_$j",
						'cpf'=>$j,
						'data_nascimento'=> $this->gerarDatas(),
						'endereco'=>'Rua '.$j,
						'telefone'=>"($j$j) $j$j$j$j-$j$j$j$j",
						'bairro'=>"Bairro $j",
						'id_cidade'=>3654,
						'id_empresa'=>$empresa,
						'id_sexo'=>1
				));
	
				$this->db->insert('veiculo_motorista',array('id_veiculo'=>$idVeiculo, 'id_motorista'=>$this->db->insert_id()));
				$arrayIdVeiculos[] = $idVeiculo;
			}
		}
		// GASTOS 
		foreach ($arrayIdVeiculos as $veiculo){
			echo "Gastos Veículo $veiculo";
			
			$teste = true;
			while($teste){
					
				$kmMin = $this->veiculoDao->pegarUltimoKmAtual($veiculo)->km_atual;
				
				$this->dataGastos();
				
				if($this->dataAtual < date('Y-m-d')){
					
					$tipoGasto = rand(1, 8);
					$valorMin = 10;
					$valorMax = 6000;
					if($tipoGasto == 8){	
						$valorMax = 250;
					}
					
					$this->db->insert('gasto', array(
							'id_veiculo' => $veiculo,
							'id_tipo_gasto'=>$tipoGasto,
							'data_gasto'=>$this->dataAtual,
							'data_cadastro'=>date('Y-m-d'),
							'valor'=>rand($valorMin, $valorMax),
							'km_atual'=>rand($kmMin, $kmMin+300)
					));
				} else {
					$this->dataAtual = date('Y-m-d', strtotime('2013-1-1'));
					$teste = false;
				}
			}
		}
	}

	public function dataGastos()
	{
		$somar = rand(1,5);

		$this->dataAtual = date('Y-m-d', strtotime("+$somar days",strtotime($this->dataAtual)));
	}

	//gera as datas aleatórias
	public function gerarDatas()
	{
		$mes = rand(1, 12);
		$dia = rand(1,28);
		$ano = rand(1960,1995);

		return $ano.'-'.$mes.'-'.$dia;
	}

	//Gera as placas
	public function gerarPlacas()
	{
		$letras = array("a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","u","v","w","x","y","z");
		return random_element($letras).random_element($letras).random_element($letras).'-'.rand(1000, 9999);

	}
	//Pega os ano_modelos para popular a tabela veiuculo
	public function getAnoModelo()
	{
		if($this->anoModelo==NULL)
		{
			$this->db->select('id');
			$query = $this->db->get('ano_modelo');
			$this->anoModelo = $query->result_array();
// 			print_r($this->anoModelo);
		}
		
		return $this->anoModelo[rand(0, sizeof($this->anoModelo))]['id'];

	}
}

/* End of file: painel.php
 * Location: /application/controllers
*/