<?php if ( ! defined('BASEPATH')) exit('VocÃª nÃ£o deveria estar aqui!');

class Veiculos extends CI_Controller{

	public function __construct(){
		parent::__construct();
		initHome();
	}
	
	public function gerenciar() {
		estaLogado();
		$this->autenticar->check_logged($this->router->class, $this->router->method);
	
		setTema('titulo', 'Gerenciar Veículo');
		setTema('menu', criarMenu($this->session->userdata('user_id')));
		setTema('conteudo', loadModulo('veiculo_view','gerenciar'));
		loadTemplate();
	}
	
	public function cadastrar() {
		estaLogado();
		$this->autenticar->check_logged($this->router->class, $this->router->method);
	
		$this->form_validation->set_message('is_unique', "Esta %s já está cadastrado no sistema");
		$this->form_validation->set_rules('placa', 'PLACA', 'trim|required|min_length[8]|strtoupper|is_unique[veiculo.placa]');
// 		$this->form_validation->set_rules('km_atual', 'KM ATUAL', 'trim|required|numeric');
// 		$this->form_validation->set_rules('media_km_dia', 'MÃ©dia de KM por DIA', 'trim|required|numeric');
// 		$this->form_validation->set_rules('media_km_litro', 'MÃ©dia de KM por LITRO', 'trim|required|numeric');
// 		$this->form_validation->set_rules('ultima_troca_oleo', 'Ãšltima troca de Ã“LEO', 'trim|required');
// 		$this->form_validation->set_rules('km_ultima_troca_oleo', 'KM da Ãºltima troca de Ã“LEO', 'trim|required|numeric');
// 		$this->form_validation->set_rules('ultima_troca_pneus', 'Ãšltima troca de PNEUS', 'trim|required');
// 		$this->form_validation->set_rules('km_ultima_troca_pneus', 'KM da Ãºltima troca de PNEUS', 'trim|required|numeric');
// 		$this->form_validation->set_rules('tipo_bau', 'TIPO DO BAU', 'trim|required');
// 		$this->form_validation->set_rules('capacidade_carga', 'CAPACIDADE DE CARGA', 'trim|required');
// 		$this->form_validation->set_rules('tipo_eixo', 'TIPO EIXO', 'trim|required');
	
		$cadastrar_seguro = $this->input->post('cadastrar_seguro');
	
		if($cadastrar_seguro == 'TRUE'){
			$this->form_validation->set_rules('valor', 'VALOR', 'trin|required');
			$this->form_validation->set_rules('seguradora', 'SEGURADORA', 'trin|required');
			$this->form_validation->set_rules('data_pagamento', 'DATA DO PAGAMENTO', 'trin|required');
			$this->form_validation->set_rules('quantidade_parcelas', 'NÃšMERO DE PARCELAS', 'trin|required|numeric');
			$this->form_validation->set_rules('num_parcelas_pagas', 'NÃšMERO DE PARCELAS PAGAS', 'trin|required|numeric');
			$this->form_validation->set_rules('vencimento_seguro', 'VENCIMENTO DO SEGURO', 'trin|required|numeric');
			$this->form_validation->set_rules('contato_corretor', 'CONTATO DO CORRETOR', 'trin|required');
			$this->form_validation->set_rules('contato_sinistro', 'CONTATO DO SINISTRO', 'trin|required');
		}
		if($this->form_validation->run()){
			$veiculo = elements(array('placa', 'km_atual', 'media_km_dia', 'media_km_litro', 'ultima_troca_oleo', 'km_ultima_troca_oleo',
					'ultima_troca_pneus', 'km_ultima_troca_pneus','tipo_bau','capacidade_carga','tipo_eixo','id_tipo_oleo','id_ano_modelo', 'id_cidade'),
					$this->input->post());
				
// 			$veiculo['ultima_troca_pneus'] = alterarData($veiculo['ultima_troca_pneus']);
// 			$veiculo['ultima_troca_oleo'] = alterarData($veiculo['ultima_troca_oleo']);
			$veiculo['id_empresa'] = $this->session->userdata('empresa_id');
	
			if($cadastrar_seguro == "TRUE"){
				$seguro = elements(array('valor', 'seguradora','data_pagamento','quantidade_parcelas','num_parcelas_pagas','vencimento_seguro','contato_corretor','contato_sinistro'),
						$this->input->post());
				$seguro['data_pagamento'] = alterarData($seguro['data_pagamento']);
	
				$this->load->model('BI/veiculo_bi', 'veiculoBi');
				$this->veiculoBi->cadastrarVeiculoComSeguto($veiculo, $seguro);
	
			} else {
				$this->generic_dao->insert('veiculo', $veiculo);
			}
		}
	
		setTema('titulo', 'Cadastrar Veículo');
		setTema('menu', criarMenu($this->session->userdata('user_id')));
		setTema('conteudo', loadModulo('veiculo_view', 'cadastrar'));
		loadTemplate();
	}
	
	public function cadastrar_seguro() {
		estaLogado();
		$this->autenticar->check_logged($this->router->class, $this->router->method);
	
		$this->form_validation->set_rules('valor', 'VALOR', 'trin|required');
		$this->form_validation->set_rules('seguradora', 'SEGURADORA', 'trin|required');
		$this->form_validation->set_rules('data_pagamento', 'DATA DO PAGAMENTO', 'trin|required');
		$this->form_validation->set_rules('quantidade_parcelas', 'NÃšMERO DE PARCELAS', 'trin|required');
		$this->form_validation->set_rules('num_parcelas_pagas', 'NÃšMERO DE PARCELAS PAGAS', 'trin|required');
		$this->form_validation->set_rules('vencimento_seguro', 'VENCIMENTO DO SEGURO', 'trin|required');
		$this->form_validation->set_rules('contato_corretor', 'CONTATO DO CORRETOR', 'trin|required');
		$this->form_validation->set_rules('contato_sinistro', 'CONTATO DO SINISTRO', 'trin|required');
	
		if($this->form_validation->run()){
			$seguro = elements(array('valor', 'seguradora', 'data_pagamento', 'quantidade_parcelas', 'num_parcelas_pagas', 'vencimento_seguro', 'contato_corretor', 'contato_sinistro'), $this->input->post());
			$seguro['data_pagamento'] = alterarData($seguro['data_pagamento']);
				
			$veiculo = $this->input->post('id_veiculo');
				
			$this->generic_dao->insert('seguro', $seguro);
		}
	
		setTema('titulo', 'Cadastrar Seguro');
		setTema('menu', criarMenu($this->session->userdata('user_id')));
		setTema('conteudo', loadModulo('veiculo_view', 'cadastrar_seguro'));
		loadTemplate();
	}
	
	public function cadastrar_gasto($id){
		estaLogado();
		$this->autenticar->check_logged($this->router->class, $this->router->method);
		
		$this->form_validation->set_rules('id_veiculo', 'VEÃ�CULO', 'required');
		
		if($this->form_validation->run()){
			$dados = elements(array('valor', 'data_gasto', 'km_atual', 'id_tipo_gasto', 'id_veiculo'), $this->input->post());

			if($this->generic_dao->insert('gasto', $dados)){
				setMsg('msg', 'Gasto cadastrado com sucesso', 'sucess');
			}
		}
		
		setTema('titulo', 'Cadastrar Gasto');
		setTema('menu', criarMenu($this->session->userdata('user_id')));
		setTema('conteudo', loadModulo('veiculo_view', 'cadastrar_gasto'));
		loadTemplate();
	}

	public function editar($id) {
		estaLogado();
		$this->autenticar->check_logged($this->router->class, $this->router->method);
		
		$this->load->model('daos/modelo_dao', 'modeloDao');
		$this->load->model('daos/estado_dao', 'estadoDao');
		
		$this->form_validation->set_rules('placa', 'PLACA', 'trim|required|min_length[8]|strtoupper');
		
		if($this->form_validation->run()){
			$veiculo = elements(array('placa', 'km_atual', 'media_km_dia', 'media_km_litro', 'ultima_troca_oleo', 'km_ultima_troca_oleo',
						'ultima_troca_pneus', 'km_ultima_troca_pneus','tipo_bau','capacidade_carga','tipo_eixo','id_tipo_oleo','id_ano_modelo', 'id_cidade'),
						$this->input->post());
			
			if($this->generic_dao->update('veiculo', $veiculo, array('id'=>$id))){
				setMsg('msgok', 'Gasto cadastrado com sucesso', 'sucesso');
				redirect('veiculos/gerenciar');	
			} else {
				setMsg('msgok', 'Gasto cadastrado com sucesso', 'error');
			}
		}
		setTema('titulo', 'Editar Veículo');
		setTema('menu', criarMenu($this->session->userdata('user_id')));
		setTema('conteudo', loadModulo('veiculo_view', 'editar'));
		loadTemplate();
	}
}