//Adicionando mascara aos campos

//Mask: ABC-1234
$("#placa").mask("aaa-9999");

//Mascaras Cadastro de Seguro
$("#contato_corretor").mask("(99)9999-9999");
$("#contato_sinistro").mask("(99)9999-9999");

//Mascaras Cadastro Usuário
$("#telefone").mask("(99)9999-9999");
$("#cep").mask("99999-999");

/*
 * Função para mostrar ou não mostrar os carros desabilitados.
 * Página: clientes/gerenciar
 */
function mostrarVeiculosDesabilitados(){
	if($(".desativado").css('display') == 'none'){
		$(".desativado").fadeIn('slow', function() {$(this).css('display', 'table-row');});
	} else {
		$(".desativado").fadeOut('slow', function() {$(this).css('display', 'none');});
	}
}

//Criar uma caixa de erro com um X para fecha-la
//@atribs: String msg: Mensagem
//		   String tipo: tipo da msg. Tipos permitidos: erro e sucesso
function addMsgAlert(msg, tipo){
	switch (tipo) {
	case "erro":
		return '<div class="alert alert-danger">'+ msg + '<button class="close" data-dismiss="alert">x</button></div>';
		break;
	case "sucesso":
		return '<div class="alert alert-success">'+ msg + '<button class="close" data-dismiss="alert">x</button></div>';
		break;
	default:
		return '';
		break;
	}
}

function checkPassowrd(input){
	if(input.value != $("#senha").val()){
		input.setCustonValidity("As 2 senhas devem ser iguais");
	} else {
		input.setCustonValidity("");
	}
}

/**
 * Funções para a página cliente/cadastrar_veiculo
 */
function habilitarCadastroSeguro(link){
	if($(".cadastrar-seguro").css("display") == "none"){
		$(".cadastrar-seguro").fadeIn('slow', function() {$(this).css("display", "block");});
		$("input[name='cadastrar_seguro']").val("TRUE");
		link.innerHTML = "Mudei de ideia, desejo cadastrar o seguro depois.";
		
	} else {
		$(".cadastrar-seguro").fadeOut('slow', function() {$(this).css("display", "none");});
		$("input[name='cadastrar_seguro']").val("FALSE");
		link.innerHTML = "Deseja cadastrar um seguro para este veículo?";
	} 
	return false;
}