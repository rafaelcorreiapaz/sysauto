var urlServiceGasto = 'http://localhost/sysauto/service/veiculos/criarComboTipoGasto/';
var urlServiceUltimoKmAtual = 'http://localhost/sysauto/service/veiculos/pegarUltimoKmAtual/';

var idGasto = "TipoGasto";
var idKmAtual = 'km_atual';

//Quando a página terminar de carregar
$(document).ready(function(){

	ajaxCarregarCombo(urlServiceGasto, '', idGasto);
	var id = null;
	if(!(VAR_AMBIENTE["id_veiculo"] === undefined)){
		id = VAR_AMBIENTE["id_veiculo"];
	}
	ajaxCarregarCombo(urlServiceUltimoKmAtual, '', idKmAtual, id);
	
	$("input[type=submit]").click(function(){
		var select = document.getElementById('combo'+idGasto);
		if(select.value == 0){
			select.setCustomValidity('Selecione um tipo de gasto');
		} else {
			select.setCustomValidity('');
		}
		return true;
	});
});

//Função que carregará os combo box por ajax.
//@paramets:
//	urlBase: URL base do service
//	tipo_modelo: Para o 1º combo-box é necessário informar se é carro, caminhão ou moto
//	idDiv: Id da div que receberá o combo-box pronto
//	id: Id do objeto, no caso será utilizado para selecionar os modelos e ano_modelo
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
		beforeSend:function(){},
		success:function (dados){
			switch (idDiv) {
			case idGasto:
				$.each(dados, function(key, valor){
					$("#combo"+idDiv).append("<option value='"+key+"'>"+valor+"</option>");
				});
				break;
			case idKmAtual:
				$('#'+idDiv).val(dados);
				break;
			default:
				break;
			}
			
			$("#combo"+idDiv).change(function() {
				$("#combo" + idDiv + " option[value=0]").remove();
			});
		},
		error:function (qXHR, textStatus, errorThrown){
			alert('Ixi, fudeo corre e chama o Rhino');
		}
	});
}