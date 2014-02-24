<?php if ( ! defined('BASEPATH')) exit('Você não deveria estar aqui!');
class Usuarios extends CI_Controller{
	
	public function __construct(){
		parent::__construct();
		initHome();
	}
	
	public function index() {}
	
	public function gerenciar() {
		estaLogado();
		$this->autenticar->check_logged($this->router->class, $this->router->method);
	
		setTema('titulo', 'Gerenciar Usuário');
		setTema('menu', criarMenu($this->session->userdata('user_id')));
		setTema('conteudo', loadModulo('usuario_view','gerenciar'));
		loadTemplate();
	}	
	
	//Carregar o módulo usuário e faz o login
	public function login() {
		if(!estaLogado(FALSE)){
		
			$this->form_validation->set_rules('email', 'EMAIL', 'trim|required|valid_email|min_length[4]|strtolower');
			$this->form_validation->set_rules('senha', 'SENHA', 'trim|required|min_length[4]|strtolower');
			
			if($this->form_validation->run()){
				$email = $this->input->post('email', FALSE);
				$senha = md5($this->input->post('senha', TRUE));
				$redirect = $this->input->post('redirect');
				
				if($this->usuarioDao->doLogin($email, $senha)){
					
					$usuario = $this->usuarioDao->getByEmail($email);
					
					$empresa = $this->generic_dao->getById('empresa', $usuario->id_empresa);
					
					$dados = array(
							'user_id'       => $usuario->id,
							'user_nome'     => $usuario->nome,
							'user_email'    => $usuario->email,
							'user_perfil'   => $usuario->id_perfil_acesso,
							'empresa_id'    => $empresa->id,
							'empresa_nome'  => $empresa->nome_fantasia,
							'empresa_logo'  => $empresa->logo,
							'user_logado'   => TRUE
					);
					$this->session->set_userdata($dados);
					
					if($redirect != ''){
						redirect($redirect);
					} else {
						redirect('home');
					}
				}
			} 
			
			setTema('titulo', 'Login');
			setTema('conteudo', loadModulo('usuario_view', 'login'));
			setTema('rodape', '');
			loadTemplate();
		} else {
			redirect('usuarios/gerenciar');
		}
	}
	
	public function alterar_senha($id) {
		estaLogado();
		
		if($id != $this->session->userdata('user_id')){
			$this->autenticar->check_logged($this->router->class, $this->router->method);
		}
		
		$this->form_validation->set_message('matches', "O campo %s é diferente do campo %s");
		
		$this->form_validation->set_rules('senha',  'SENHA',          'trim|required|min_length[4]');
		$this->form_validation->set_rules('senha2', 'REPITA A SENHA', 'trim|required|min_length[4]|matches[senha]');
		
		if($this->form_validation->run()){
			$dados['senha'] = md5($this->input->post('senha'));
			
			if($this->usuarioDao->update($dados, array('id'=>$id))){
				setMsg('msg', 'Senha alterada com sucesso!', 'success');
// 				setTema('msgScriptAlert', "alertMessage('success', 'Senha alterada com sucesso!1');");
				redirect('usuarios/gerenciar');
			} else {
				setMsg('msg', 'Erro ao alterar senha!', 'error');
				//TODO: Continuar tentando descobrir pq não consigo mostrar msg na tela
			}
		}
		
		setTema('titulo', 'Alterar Senha');
		setTema('menu', criarMenu($this->session->userdata('user_id')));
		setTema('conteudo', loadModulo('usuario_view','alterar_senha'));

		loadTemplate();
	}
	
	public function logoff() {
		$this->session->userdata(array(
							'user_id' => '',
							'user_nome' => '',
							'user_email' => '',
							'user_logado' => ''
					)
		);
		$this->session->sess_destroy();
		$this->session->sess_create();
		
		setMsg('msgok', 'Logoff realizado com sucesso', 'sucesso');
		redirect('usuarios/login');
	}
	
	public function cadastrar() {
		estaLogado();
		$this->autenticar->check_logged($this->router->class, $this->router->method);
		
		$this->form_validation->set_message('is_unique', "O email %s já está cadastrado no sistema");
		$this->form_validation->set_message('matches', "Os campos %s e %s devem ser iguais");
		
		$this->form_validation->set_rules('email', 'EMAIL', 'trim|required|strtolower|is_unique[usuario.email]');
		$this->form_validation->set_rules('nome', 'NOME', 'trim|required|min_length[4]|ucwords');
		$this->form_validation->set_rules('cep', 'CEP', 'trim|required');
		$this->form_validation->set_rules('senha', 'SENHA', 'trim|required|min_length[4]');
		$this->form_validation->set_rules('senha2', 'REPITA A SENHA', 'trim|required|min_length[4]|matches[senha]');
		
		if($this->form_validation->run()){
			$usuario = elements(array('nome', 'email', 'cep', 'telefone', 'senha', 'id_cidade', 'id_sexo', 'id_perfil_acesso'), $this->input->post());
			$usuario['senha'] = md5($usuario['senha']);
			$usuario['id_empresa'] = $this->session->userdata("empresa_id");
			
			$result = $this->generic_dao->insert('usuario', $usuario);
			
			if($result){
				$cssClass = "success";
				$html = "Senha alterada com sucesso!";
			} else {
				$cssClass = "error";
				$html = "Erro ao tentar alterar a senha.";
			}
		}
		echo '<script  type="text/javascript">VAR_AMBIENTE = new Array();'; 
		
		if( isset($_POST['estados'])) echo 'VAR_AMBIENTE["estado"]='. $this->input->post('estados') . ';';
		if( isset($_POST['id_cidade'])) echo 'VAR_AMBIENTE["cidade"]='. $this->input->post('id_cidade') . ';';
		if( isset($_POST['id_perfil_acesso'])) echo 'VAR_AMBIENTE["perfil_acesso"]='. $this->input->post('id_perfil_acesso') . ';';
		
		echo '</script>';
		
		if(isset($cssClass) && isset($html)){
			setTema('msgScriptAlert', "alertMessage('$cssClass', '$html');");
		}
		setTema('titulo', 'Cadastrar Usuário');
		setTema('menu', criarMenu($this->session->userdata('user_id')));
		setTema('conteudo', loadModulo('usuario_view', 'cadastrar'));
		setTema('footerinc', loadJs(array('ajax_cadastro_usuario', 'functions')), FALSE);
		loadTemplate();
	} 

	public function editar($id) {
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
	}
}