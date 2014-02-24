var urlServiceEstado       = 'http://localhost/sysauto/service/cidades/criarComboEstados/';
var urlServiceCidade       = 'http://localhost/sysauto/service/cidades/criarComboCidades/';
var urlServiceCEP          = 'http://localhost/sysauto/service/cidades/getCep/';
var urlServicePerfilAcesso = 'http://localhost/sysauto/service/usuarios/criarComboPerfilAcesso/';

var idEstado       = "Estados";
var idCidade       = "Cidades";
var idPerfilAcesso = "PerfilAcesso";
var idCep          = 'cep';

$(document).ready(function(){
	ajaxCarregarComboCidade(urlServiceEstado, '', idEstado);
	ajaxCarregarComboCidade(urlServicePerfilAcesso, '', idPerfilAcesso);
});

//Função que carregará os combo box por ajax.
//@paramets:
//	urlBase: URL base do service
//	tipo_modelo: Para o 1º combo-box é necessário informar se é carro, caminhão ou moto
//	idDiv: Id da div que receberá o combo-box pronto
//	id: Id do objeto, no caso será utilizado para selecionar os modelos e ano_modelo
function ajaxCarregarComboCidade(urlBase, tipo_modelo, idDiv, id){
	var link = urlBase;
	
	if(tipo_modelo != ''){
		link += tipo_modelo + "/";
	} else if(id != null){
		link += id;
	}
	
	if(!(VAR_AMBIENTE["estado"] === undefined) && idDiv == idEstado){
		link += VAR_AMBIENTE["estado"];
	} else if(!(VAR_AMBIENTE["cidade"] === undefined) && idDiv == idCidade){
		link += '/'+VAR_AMBIENTE["cidade"];
	} else if(!(VAR_AMBIENTE["perfil_acesso"] === undefined) && idDiv == idPerfilAcesso){
		link += VAR_AMBIENTE["perfil_acesso"];
	}
	$.ajax({
		url:link,
		dataType: 'json',
		type: 'POST',
		beforeSend:function(){
		},
		success:function (dados){
			
			switch(idDiv){
			case idEstado:
				$("#combo"+idDiv).change(function () {
					ajaxCarregarComboCidade(urlServiceCidade, '', idCidade, this.value);
				}).change();
				
				break;
			case idCidade:
				$("#combo"+idDiv).change(function () {
					ajaxCarregarComboCidade(urlServiceCEP, '', idCep, this.value);
				}).change();
				
				break;
			case idCep:
				$('#'+idCep).val(dados);
				break;
			}
			
			if(idDiv != idPerfilAcesso){
				$("#combo"+idDiv).empty().append('<option value="0" selected>'+idDiv+'</option>');
			} else {
				$("#combo"+idDiv).empty().append('<option value="0" selected>Perfil de acesso</option>');
			}
			
			$("#combo"+idDiv).change(function() {
				$("#combo" + idDiv + " option[value=0]").remove();
			});
			
			$.each(dados, function(key, valor) {
				$("#combo"+idDiv).append("<option value='"+key+"'>"+valor+"</option>");
			});
			
			
		},
		error:function (qXHR, textStatus, errorThrown){
//			alert(textStatus);
		}
	});
}