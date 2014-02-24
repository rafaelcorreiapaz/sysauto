<?php if ( ! defined('BASEPATH')) exit('Você não deveria estar aqui!');
class RA_Sistema {
	protected $CI;
	public $tema = array();
	
	public function __construct() {
		$this->CI =& get_instance();
	}
	
	public function enviar_email($para, $assunto, $mensagem, $formato='html') {
		$this->CI->load->library('email');
		
		$config['mailtype'] = $formato;
		$this->CI->email->initialize($config);
		$this->CI->email->from('rhinoandre@gmail.com', "Rhino's Administração");
		$this->CI->email->to($para);
		$this->CI->email->subject($assunto);
		$this->CI->email->message($mensagem);
		
		if($this->CI->email->send()){
			return TRUE;
		} else {
			return  $this->CI->email->print_debugger();
		}
	}
}
/* End of file: sistema.php
 * Location: /application/libraries
*/