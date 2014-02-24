<?php if ( ! defined('BASEPATH')) exit('Você não deveria estar aqui!');

//carrega um módulo do sistema devolvendo a tela solicitada
function loadModulo($modulo=NULL, $tela=NULL, $diretorio='gerencia'){
	$CI =& get_instance();
	if($modulo != NULL){
		return $CI->load->view("$diretorio/$modulo", array('tela'=>$tela), TRUE);
	}
	return FALSE;
}

//Seta valores ao array $tema da classe sistema
function setTema($propriedade, $valor, $replace=TRUE) {
	$CI =& get_instance();
	$CI->load->library('sistema');
	
	if($replace){
		$CI->sistema->tema[$propriedade] = $valor;
	} else {
		if(!isset($CI->sistema->tema[$propriedade])) 
			$CI->sistema->tema[$propriedade] = '';
		$CI->sistema->tema[$propriedade] .= $valor;
	}
}

//retorna os valores do array $tema da classe sistema
function getTema() {
	$CI =& get_instance();
	$CI->load->library('sistema');
	
	return $CI->sistema->tema;
}


function estaLogado($redir=TRUE) {
	$CI =& get_instance();
	$CI->load->library('session');
	
	$user_status = $CI->session->userdata('user_logado');
	if(!isset($user_status) || $user_status != TRUE){
		if($redir){
			$CI->session->set_userdata(array('redir_para'=>current_url()));
			setMsg('msgnok', 'Acesso restrito, fa�a o login antes de prosseguir');
			redirect('usuarios/login');
		} else {
			return FALSE;
		}
	} else {
		return TRUE;
	}
}

//Carrega os recursos para trabalhar com o painel
function initHome() {
	$CI =& get_instance();
	
	$CI->load->model('daos/usuario_dao', 'usuarioDao');
	$CI->load->model('daos/veiculo_dao', 'veiculoDao');
	
	//carregamento dos models
	setTema('titulo_padrao', 'SysAuto');
	setTema('rodape', 'LUCAS SE VIRA');
	setTema('template', 'home_view');
	
	setTema('headerinc', loadCss(array('app', 'jquery.notifyBar')), FALSE);
	setTema('headerinc', loadJs('http://code.jquery.com/jquery-latest.js', NULL, TRUE), FALSE);
	setTema('footerinc', loadJs(array('jquery.maskedinput.min', 'bootstrap.min', 'data-table', 'table', 'functions')), FALSE);
	setTema('menu', '');	
}

//Cria o menu de acordo com a permissão que o cliente possui
function criarMenu($id) {
	$CI =& get_instance();

	$CI->load->model('BI/menu_bi', 'menuBi');
	$menus = $CI->menuBi->selecionarMenusAcessiveisPorUsuario();
	if(is_array($menus)){
		$menuLi = '<div class="row-fluid">
 			<div class="navbar menu-site">
				<nav class="navbar-inner">
                  	<div class="nav-collapse collapse">
						<ul class="nav">';
		
		foreach ($menus as $item){
			if(isset($item['filhos'])){
				$menuLi .= '<li class="dropdown">'.anchor($item['url'], $item['nome'].'<b class="caret"></b>', array('class'=>'dropdown-toggle','data-toggle'=>'dropdown', 'id'=>'menu'.$item['id']));
				$menuLi .= '<ul class="dropdown-menu">';
				foreach ($item['filhos'] as $filho){
					$menuLi .= '<li>'.anchor($filho['url'], $filho['nome'], array('class'=>'', 'id'=>'menu'.$filho['id'])).'</li>';
				}
				$menuLi .= '</ul>';
			}else {
				$menuLi .= '<li>'.anchor($item['url'], $item['nome'], array('id'=>'menu'.$item['id']));
			}
			
			$menuLi .= '</li><li class="divider"></li>';
		}
		$menuLi .= '</ul>
					<ul class="nav pull-right">
						<li class="dropdown">'. anchor('', '<b class="icon-user"></b> '.word_limiter($CI->session->userdata('user_nome'), 2, '').'<b class="caret"></b>', array('class'=>'dropdown-toggle','data-toggle'=>'dropdown', 'id'=>'usuarioLogado')) . '
							<ul class="dropdown-menu">
								<li>' . anchor('usuarios/alterar_senha/' . $id, '<b class="icon-lock"></b> Alterar Senha') . '</li>
								<li>' . anchor('usuarios/editar/'.$id, '<b class="icon-edit"></b> Editar') . '</li>
								<li>' . anchor('usuarios/logoff', '<b class="icon-off"></b> Sair') . '</li>
							</ul></li>
						</ul></div></nav></div></div>';
		
		return $menuLi;
	} else {
		setMsg('msgnok', 'Erro ao selecionar os itens do menu!');
	}
}

//Carrega um template passando o array $tema como parâmetro
function loadTemplate() {
	$CI =& get_instance();
	
	$CI->parser->parse($CI->sistema->tema['template'], getTema());
}

//Carrega um ou mais arquivos .css de uma pasta
function loadCss($arquivo=NULL, $pasta='css', $media='all') {
	if($arquivo != NULL){
		$CI =& get_instance();
		$CI->load->helper('url');
		
		$retorno = '';
		if(is_array($arquivo)){
			foreach ($arquivo AS $css){
				$retorno .= '<link rel="stylesheet" type="text/css" href="'.base_url("$pasta/$css.css").'" media="'. $media .'">';
			}
		} else {
			$retorno .= '<link rel="stylesheet" type="text/css" href="'.base_url("$pasta/$arquivo.css").'" media="'. $media .'">';
		}
	}
	return $retorno;
}

//Carrega um ou mais arquivos .js de uma pasta ou site
function loadJs($arquivo=NULL, $pasta='js', $remoto=FALSE) {
	if($arquivo != NULL){
		$CI =& get_instance();
		$CI->load->helper('url');

		$retorno = '';
		if(is_array($arquivo)){
			foreach ($arquivo AS $js){
				if($remoto){
					$retorno .= '<script type="text/javascript" src="'.$js.'"></script>';
				} else {
					$retorno .= '<script type="text/javascript" src="'.base_url("$pasta/$js.js").'"></script>';
				}
			}
		} else {
			if($remoto){
				$retorno .= '<script type="text/javascript" src="'.$arquivo.'"></script>';
			} else {
				$retorno .= '<script type="text/javascript" src="'.base_url("$pasta/$arquivo.js").'"></script>';
			}
		}
	}
	return $retorno;
}

function setMsg($id, $msg, $tipo){
	$CI =& get_instance();
	$CI->session->set_flashdata($id, "alertMessage($tipo, $msg)");
}

function getMsg($id, $printar=TRUE) {
	$CI =& get_instance();
	
	if($CI->session->flashdata($id) != NULL){
		echo " Achou";
		if($printar){
			echo '<script type="text/javascript">'.$CI->session->flashdata($id) . '</script>';
			return TRUE;
		} else {
			return $CI->session->flashdata($id);
		}
	}
	return FALSE;
}

//Mostra erros de validação em forms
function errosValidacao() {
	if(validation_errors())
		echo '<div class="alert-box alert">'.validation_errors('<p>','</p>').'</div>';
}

//Alterar a data do PHP>MySQL e vice-versa. 
//Se passar 01/12/1999 será convertido para 1999-12-01 (PHP > MySQL)
//Se passar 1999-12-01 será conversito para 01/12/1999 (MySQL > PHP)
function alterarData($data) {
// 	$explode = explode("/",$data);
	if(explode("/",$data)[0] != $data){
		return implode("-",array_reverse(explode("/",$data)));
	} else {
		return implode("/",array_reverse(explode("-",$data)));
	}
}