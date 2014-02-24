<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Json extends CI_Controller{
	private $json;
	private $teste;
	private $tab = 1;
	
	public function __construct(){
		$this->json = "{";
		$this->teste = "{";
	}
	
	public function openKey(){
		$this->json .= "\"$tag\":[{";
	}
	
	public function closeKey(){
		$this->json .= "}";
	}
	public function openKeyArray($tag){
		$this->json .= "\"$tag\":[{";
	}
	public function closeKeyArray($virgula=false){
		$this->json .= "}]";

		if($virgula){
			$this->json .= ",";
		}
	}

	public function openTag($tag, $value, $virgula=false){
		if(is_int($value) || is_bool($value)){
			$this->json .= "\"$tag\":$value";
		} else if (is_string($value)){
			$this->json .= "\"$tag\": \"$value\"";
		}

		if($virgula){
			$this->json .= ",";
		}
	}

	public function __toString(){
		return $this->json;
	}

}

?>