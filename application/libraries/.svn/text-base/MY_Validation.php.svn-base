<?php  if (!defined('BASEPATH')) exit('Você não deveria estar aqui!');
/**
 * Code Igniter
 *
 * An open source application development framework for PHP 4.3.2 or newer
 *
 * @package     CodeIgniter
 * @author      Rick Ellis
 * @copyright   Copyright (c) 2006, pMachine, Inc.
 * @license     http://www.codeignitor.com/user_guide/license.html
 * @link        http://www.codeigniter.com
 * @since       Version 1.0
 * @filesource
*/

//------------------------------------------------------------------------

/**
 * Validation Class extends
 *
 * @package    CodeIgniter
 * @subpackage Libraries
 * @category   Validation
 * @author     Edinho Almeida (after google search: 'php cpf
 validação')
 * @link http://www.codeigniter.com/user_guide/libraries/validation.html
*/
class MY_Validation extends CI_Validation {
	function __construct(){
		parent::CI_Validation();
	}
	/**
	 * cpf
	 *
	 * @access    public
	 * @param    string
	 * @return    bool
	 */
	function cpf($CampoNumero){
		$RecebeCPF=preg_replace('/[^0-9]/i','',$CampoNumero);
		
		if (strlen($RecebeCPF)!=11 || $RecebeCPF=="00000000000000" ||
		$RecebeCPF=="11111111111" || $RecebeCPF=="22222222222" ||
		$RecebeCPF=="33333333333" ||
		$RecebeCPF=="44444444444" || $RecebeCPF=="55555555555" ||
		$RecebeCPF=="66666666666" ||
		$RecebeCPF=="77777777777" || $RecebeCPF=="88888888888" ||
		$RecebeCPF=="99999999999"){
			return FALSE;
		}

		$Numero[1]=intval(substr($RecebeCPF,1-1,1));
		$Numero[2]=intval(substr($RecebeCPF,2-1,1));
		$Numero[3]=intval(substr($RecebeCPF,3-1,1));
		$Numero[4]=intval(substr($RecebeCPF,4-1,1));
		$Numero[5]=intval(substr($RecebeCPF,5-1,1));
		$Numero[6]=intval(substr($RecebeCPF,6-1,1));
		$Numero[7]=intval(substr($RecebeCPF,7-1,1));
		$Numero[8]=intval(substr($RecebeCPF,8-1,1));
		$Numero[9]=intval(substr($RecebeCPF,9-1,1));
		$Numero[10]=intval(substr($RecebeCPF,10-1,1));
		$Numero[11]=intval(substr($RecebeCPF,11-1,1));


		$soma=10*$Numero[1]+9*$Numero[2]+8*$Numero[3]+7*$Numero[4]+6*$Numero[5]+5*$Numero[6]+4*$Numero[7]+3*$Numero[8]+2*$Numero[9];

		$soma=$soma-(11*(intval($soma/11)));

		if ($soma==0 || $soma==1){
			$resultado1=0;
		}else{
			$resultado1=11-$soma;
		}

		if ($resultado1==$Numero[10]){

			$soma=$Numero[1]*11+$Numero[2]*10+$Numero[3]*9+$Numero[4]*8+$Numero[5]*7+$Numero[6]*6+$Numero[7]*5+$Numero[8]*4+$Numero[9]*3+$Numero[10]*2;
			$soma=$soma-(11*(intval($soma/11)));
			if ($soma==0 || $soma==1){
				$resultado2=0;
			}else{
				$resultado2=11-$soma;
			}
			if ($resultado2==$Numero[11]){
				return TRUE;
			}else{
				return FALSE;
			}
		}else{
			return FALSE;
		}
	}

	//--------------------------------------------------------------------

	/**
	 * cnpj
	 *
	 * @access    public
	 * @param    string
	 * @return    bool
	 */
	function cnpj($CampoNumero){
		$RecebeCNPJ=preg_replace('/[^0-9]/i','',$CampoNumero);
		if (strlen($RecebeCNPJ)!=14 || $RecebeCNPJ=="00000000000000"){
			return FALSE;
		}
		$Numero[1]=intval(substr($RecebeCNPJ,1-1,1));
		$Numero[2]=intval(substr($RecebeCNPJ,2-1,1));
		$Numero[3]=intval(substr($RecebeCNPJ,3-1,1));
		$Numero[4]=intval(substr($RecebeCNPJ,4-1,1));
		$Numero[5]=intval(substr($RecebeCNPJ,5-1,1));
		$Numero[6]=intval(substr($RecebeCNPJ,6-1,1));
		$Numero[7]=intval(substr($RecebeCNPJ,7-1,1));
		$Numero[8]=intval(substr($RecebeCNPJ,8-1,1));
		$Numero[9]=intval(substr($RecebeCNPJ,9-1,1));
		$Numero[10]=intval(substr($RecebeCNPJ,10-1,1));
		$Numero[11]=intval(substr($RecebeCNPJ,11-1,1));
		$Numero[12]=intval(substr($RecebeCNPJ,12-1,1));
		$Numero[13]=intval(substr($RecebeCNPJ,13-1,1));
		$Numero[14]=intval(substr($RecebeCNPJ,14-1,1));


		$soma=$Numero[1]*5+$Numero[2]*4+$Numero[3]*3+$Numero[4]*2+$Numero[5]*9+$Numero[6]*8+$Numero[7]*7+$Numero[8]*6+$Numero[9]*5+$Numero[10]*4+$Numero[11]*3+$Numero[12]*2;
		$soma=$soma-(11*(intval($soma/11)));
		if ($soma==0 || $soma==1){
			$resultado1=0;
		}else{
			$resultado1=11-$soma;
		}
		if ($resultado1==$Numero[13]){

			$soma=$Numero[1]*6+$Numero[2]*5+$Numero[3]*4+$Numero[4]*3+$Numero[5]*2+$Numero[6]*9+$Numero[7]*8+$Numero[8]*7+$Numero[9]*6+$Numero[10]*5+$Numero[11]*4+$Numero[12]*3+$Numero[13]*2;

			$soma=$soma-(11*(intval($soma/11)));
			if ($soma==0 || $soma==1){
				$resultado2=0;
			}else{
				$resultado2=11-$soma;
			}
			if ($resultado2==$Numero[14]){
				return TRUE;
			}else{
				return FALSE;
			}
		}else{
			return FALSE;
		}
	}
}
// END Validation Class
?>