var urlServiceEstado       = 'http://localhost/sysauto/service/cidades/criarComboEstados/';
var urlServiceCidade       = 'http://localhost/sysauto/service/cidades/criarComboCidades/';
var urlServicePerfilAcesso = 'http://localhost/sysauto/service/usuarios/criarComboPerfilAcesso/';

var idEstado       = "Estados";
var idCidade       = "Cidades";
var idPerfilAcesso = "PerfilAcesso";

$(document).ready(function(){
	
	if(!(VAR_AMBIENTE === undefined)){
		ajaxCarregarCombo(urlServicePerfilAcesso, '', idPerfilAcesso);
		ajaxCarregarCombo(urlServiceEstado, '', idEstado);
		ajaxCarregarCombo(urlServiceCidade, '', idCidade, VAR_AMBIENTE[idEstado]);
	}
});

function ajaxCarregarCombo(urlBase, tipo_modelo, idDiv, id){
	var link = urlBase;
	
	if(tipo_modelo != ''){
		link += tipo_modelo + "/";
	} else if(id != null){
		link += id;
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
					ajaxCarregarCombo(urlServiceCidade, '', idCidade, this.value);
				});
				
				break;
			case idCidade:
				break;
			}
			if(idDiv != idPerfilAcesso){
				$("#combo"+idDiv).empty().append('<option value="0" selected>'+idDiv+'</option>');
			} else {
				$("#combo"+idDiv).empty().append('<option value="0" selected>Perfil de Acesso</option>');
			}

			$.each(dados, function(key, valor){
					if(key == VAR_AMBIENTE[idDiv]){
						$("#combo"+idDiv).append("<option value='"+key+"' selected>"+valor+"</option>");
						$("#combo" + idDiv + " option[value=0]").remove();
					} else {
						$("#combo"+idDiv).append("<option value='"+key+"'>"+valor+"</option>");
					}
			});

			$("#combo"+idDiv).change(function() {
				$("#combo" + idDiv + " option[value=0]").remove();
			});
		},
		error:function (qXHR, textStatus, errorThrown){
			$("#div"+idDiv).html("Erro, chama o Rhino!");
		}
	});
}