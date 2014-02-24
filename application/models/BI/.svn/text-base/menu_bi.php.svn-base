<?php if ( ! defined('BASEPATH')) exit('Você não deveria estar aqui!');

class Menu_bi extends CI_Model{
	public function selecionarMenusAcessiveisPorUsuario() {
		estaLogado();
		
		$this->load->model('daos/usuario_dao', 'usuarioDao');
		
		$id_perfil_acesso = $this->usuarioDao->getPerfilId($this->session->userdata('user_id'))->id_perfil_acesso;

		$this->db->select('M.id, M.nome, M.url, M.id_menu_pai, PA.perfil_acesso');
		$this->db->from('menu M');
		$this->db->join('permissoes P', 'M.id = P.id_menu');
		$this->db->join('perfil_acesso PA', 'P.id_perfil_acesso = PA.id');
		$this->db->where('PA.id', $id_perfil_acesso);
		$this->db->where('M.menu_geral', TRUE);
		$this->db->where('M.ativo', TRUE);
		
		$query = $this->db->get();
		
		if($query->num_rows > 0){
			$menu = array();
			$posicaoFilho = 0;
			
			foreach ($query->result() as $item){
				if($item->id_menu_pai == null){
					$menu[] = array('id'=>$item->id, 'nome'=>$item->nome, 'url'=>$item->url, 'perfil_acesso'=>$item->perfil_acesso);
				} else {
					for ($i = 0; $i<count($menu); $i++){
						if($menu[$i]['id'] == $item->id_menu_pai){
							$menu[$i]['filhos'][$posicaoFilho] = array('id'=>$item->id, 'nome'=>$item->nome, 'url'=>$item->url, 'id_menu_pai'=>$item->id_menu_pai, 'perfil_acesso'=>$item->perfil_acesso);
							$posicaoFilho++;
						}
					}
				}
			}
			return $menu;
		}
		return FALSE;
	}
}
?>