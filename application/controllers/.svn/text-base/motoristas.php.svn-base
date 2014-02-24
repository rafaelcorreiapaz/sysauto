<?php if ( ! defined('BASEPATH')) exit('Você não deveria estar aqui!');
class Motoristas extends CI_Controller{
	
	public function __construct(){
		parent::__construct();
		initHome();
	}
	
	public function index() {}
	
	public function gerenciar() {
		estaLogado();
		$this->autenticar->check_logged($this->router->class, $this->router->method);
		
		$this->load->model('daos/veiculo_dao', 'veiculoDao');
		
		setTema('titulo', 'Gerenciar Motoristas');
		setTema('menu', criarMenu($this->session->userdata('user_id')));
		setTema('conteudo', loadModulo('motorista_view','gerenciar'));
		loadTemplate();
	}	
	
	public function cadastrar() {
		estaLogado();
		$this->autenticar->check_logged($this->router->class, $this->router->method);
		
		$this->form_validation->set_message('is_unique', "O email %s já está cadastrado no sistema");
		$this->form_validation->set_message('matches', "Os campos %s e %s devem ser iguais");
		
		$this->form_validation->set_rules('nome', 'NOME', 'trim|required|min_length[4]|ucwords');
		$this->form_validation->set_rules('endereco', 'ENDEREÇO', 'trim|required|ucwords');
		$this->form_validation->set_rules('bairro', 'BAIRRO', 'trim|required|ucwords');
		$this->form_validation->set_rules('cep', 'CEP', 'trim|required');
		$this->form_validation->set_rules('cpf', 'CPF', 'trim|required|cpf');
		$this->form_validation->set_rules('data_nascimento', 'DATA DE NASCIMENTO', 'trim|required|date');
		
		if($this->form_validation->run()){
			$motorista = elements(array('nome', 'endereco', 'cpf', 'bairro', 'cep', 'telefone', 'id_cidade', 'id_sexo'), $this->input->post());
			$motorista['id_empresa'] = $this->session->userdata('empresa_id');
			
			$this->generic_dao->insert('motorista', $motorista);

			$motoristaVeiculo = array('id_motorista'=>$this->db->insert_id(), 'id_veiculo'=>$this->input->post('id_veiculo'));
			$this->generic_dao->insert('veiculo_motorista', $motoristaVeiculo);
			redirect(current_url());
		}
		
		echo '<script  type="text/javascript">VAR_AMBIENTE = new Array();'; 
		
		if( isset($_POST['estados'])) echo 'VAR_AMBIENTE["estado"]='. $this->input->post('estados') . ';';
		if( isset($_POST['id_cidade'])) echo 'VAR_AMBIENTE["cidade"]='. $this->input->post('id_cidade') . ';';
		if( isset($_POST['id_perfil_acesso'])) echo 'VAR_AMBIENTE["perfil_acesso"]='. $this->input->post('id_perfil_acesso') . ';';
		
		echo '</script>';
		
		if(isset($cssClass) && isset($html)){
			setTema('msgScriptAlert', "alertMessage('$cssClass', '$html');");
		}
		setTema('titulo', 'Cadastrar Motoristas');
		setTema('menu', criarMenu($this->session->userdata('user_id')));
		setTema('conteudo', loadModulo('motorista_view', 'cadastrar'));
		setTema('footerinc', loadJs(array('jquery.easy-confirm-dialog','actions_cadastro_motorista', 'ajax_cadastro_usuario', 'functions')), FALSE);
		loadTemplate();
	} 

	/*public function editar($id) {
		estaLogado();
		
		$this->load->model('daos/estado_dao', 'estadoDao');
		
		$this->form_validation->set_message('matches', "Os campos %s e %s devem ser iguais");
		
		$this->form_validation->set_rules('nome', 'NOME', 'trim|required|min_length[4]|ucwords');
		$this->form_validation->set_rules('cep', 'CEP', 'trim|required');
		$this->form_validation->set_rules('senha',  'SENHA', 'trim|min_length[4]');
		$this->form_validation->set_rules('senha2', 'REPITA A SENHA', 'trim|min_length[4]|matches[senha]');
		
		if($this->form_validation->run()){
			$usuario = elements(array('nome', 'cep', 'telefone', 'id_cidade', 'id_sexo', 'id_perfil_acesso'), $this->input->post());
			if($this->input->post('senha') != ''){
				$usuario['senha'] = md5($this->input->post('senha'));
				echo 'senha';
			}
			
			if($this->generic_dao->update('usuario', $usuario, array('id'=>$id))){
				setMsg('msgok', 'Usuário alterado com sucesso', 'sucesso');
				redirect('usuarios/gerenciar');
			} else {
				setMsg('msgok', 'Não foi possível alterar o usuário', 'error');
			}
		}
		
		setTema('titulo', 'Editar Usuário');
		setTema('menu', criarMenu($this->session->userdata('user_id')));
		setTema('conteudo', loadModulo('usuario_view', 'editar'));
		setTema('footerinc', loadJs(array('ajax_editar_usuario', 'functions')), FALSE);
		
		loadTemplate();
	}*/
}