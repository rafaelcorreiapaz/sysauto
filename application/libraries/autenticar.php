<?php  if ( ! defined('BASEPATH')) exit('Você não deveria estar aqui!');
class Autenticar {
	private $ci;
	
	public function __construct(){
		$this->ci = &get_instance();
	}

	function check_logged($classe, $metodo) {
		/*
		 * Criando uma instância do CodeIgniter para poder acessar
		* banco de dados, sessionns, models, etc...
		*/
		$this->CI =& get_instance();

		/**
		 * Buscando a classe e metodo da tabela sys_metodos
		*/
		$array = array('classe' => $classe, 'metodo' => $metodo);
		$this->CI->db->where($array);
		$query = $this->CI->db->get('menu');
		$result = $query->result();

		// Se este metodo ainda não existir na tabela sera cadastrado
		if(count($result)==0){
			$data = array(
					'classe' => $classe ,
					'metodo' => $metodo ,
					'url' => $classe .  '/' . $metodo,
					'nome' => $classe .  '/' . $metodo,
					'privado' => 1
			);
			$this->CI->db->insert('menu', $data);
			redirect(base_url(). $classe . '/' . $metodo, 'refresh');
		} else {
			//Se ja existir tras as informacoes de publico ou privado e se esta ativo
			if($result[0]->privado == 0 || $result[0]->ativo == FALSE){
				//Escapa da validacao e mostra o metodo.
				return false;
			} else {
				$id_menu = $result[0]->id;
				$id_perfil_acesso = $this->CI->session->userdata('user_perfil');

				// Se o usuario estiver logado vai verificar se tem permissao na tabela.
				if(estaLogado(FALSE)){

					$array = array('id_menu' => $id_menu, 'id_perfil_acesso' => $id_perfil_acesso);
					$this->CI->db->where($array);
					$query2 = $this->CI->db->get('permissoes');
					$result2 = $query2->result();
					
// 					print_r($result2);
					
					// Se não vier nenhum resultado da consulta, manda para página de
					// usuario sem permissão.
					if(count($result2)==0){
						redirect(base_url().'home/sempermissao', 'refresh');
					} else {
						return true;
					}
				}
				// Se não estiver logado, sera redirecionado para o login.
				else{
					redirect(base_url().'home/login', 'refresh');
				}
			}
		}
	}

	/**
	 * Método auxiliar para autenticar entradas em menu.
	 * Não faz parte do plugin como um todo.
	 */
	function check_menu($classe,$metodo){
		$this->CI =& get_instance();
		$sql = "SELECT SQL_CACHE count(sys_permissoes.id) as found
				FROM permissoes P INNER JOIN menu M ON M.id = P.id_metodo
				WHERE id_usuario = '" . $this->ci->session->userdata('id_usuario') . "'
						AND classe = '" . $classe . "'
								AND metodo = '" . $metodo . "'";
		$query = $this->CI->db->query($sql);
		$result = $query->result();
		return $result[0]->found;
	}
}