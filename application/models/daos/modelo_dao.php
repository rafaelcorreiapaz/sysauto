<?php use Doctrine\DBAL\Types\IntegerType;
if ( ! defined('BASEPATH')) exit('Você não deveria estar aqui!');

class Modelo_dao extends CI_Model{
	private $table = 'modelo';
	
	public function getByIdMarca($id){
		$this->db->where('marca', $id);
		$query = $this->db->get($this->table);
		if($query->num_rows >= 1){
			return $query;
		}
		return FALSE;
	}
	
	/**
	 * Método para retornar id da marca e do modelo
	 * @param int $idModelo
	 */
	public function getInformacaoCompleta($idAnoModelo) {
		$this->db->select('MO.id modelo, MA.id marca, MA.tipo tipoAutomovel');
		$this->db->from('ano_modelo AM');
		$this->db->join('modelo MO', 'AM.modelo = MO.id');
		$this->db->join('marca MA', 'MO.marca = MA.id');
		$this->db->where('AM.id', $idAnoModelo);
		
		$query = $this->db->get();

		if($query->num_rows > 0){
			return $query->row();
		}

		return FALSE;
	}
}

?>