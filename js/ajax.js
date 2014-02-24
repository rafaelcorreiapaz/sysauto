var urlServiceMarcas =         'http://localhost/sysauto/service/veiculos/criarComboMarcas/';
var urlServiceModelo =         'http://localhost/sysauto/service/veiculos/criarComboModelos/';
var urlServiceAnoModelo =      'http://localhost/sysauto/service/veiculos/criarComboAnoModelo/';
var urlServiceTipoOleo =       'http://localhost/sysauto/service/veiculos/criarComboTipoOleo/';
var urlServiceEstado =         'http://localhost/sysauto/service/cidades/criarComboEstados/';
var urlServiceCidade =         'http://localhost/sysauto/service/cidades/criarComboCidades/';

var idMarca     = "Marcas";
var idModelo    = "Modelos";
var idAnoModelo = "Tipo";
var idEstado    = "Estados";
var idCidade    = "Cidades";
var idTipoOleo  = "TipoOleo";
var idDeletar   = "Deletar";

//Quando a página terminar de carregar
$(document).ready(function(){
	//Mando carregar o combo-box de carro, assim o cliente não precisará clicar 
	//em nenhum botão se quiser selecionar um carro
	ajaxCarregarCombo(urlServiceMarcas, 'carro', idMarca);
	//Carrega os tipo de óleo e os estados
	ajaxCarregarCombo(urlServiceTipoOleo, '', idTipoOleo);
	ajaxCarregarCombo(urlServiceEstado, '', idEstado);
	
	//Eu adiciono um evento de click para cada botão
	$("#carro").click(function (){
		//Cada botão chamará a função abaixo passando o link, o tipo_modelo que será carregado
		//e o id da div que receberá o retorno da informação.
		ajaxCarregarCombo(urlServiceMarcas, 'carro', idMarca);
		resetarCombobox();
	});

	$("#moto").click(function (){
		ajaxCarregarCombo(urlServiceMarcas, 'moto', idMarca);
		resetarCombobox();
	});

	$("#caminhao").click(function (){
		ajaxCarregarCombo(urlServiceMarcas, 'caminhao', idMarca);
		resetarCombobox();
	});
});

//Função que carregará os combo box por ajax.
//@paramets:
//	urlBase: URL base do service
//	tipo_modelo: Para o 1º combo-box é necessário informar se é carro, caminhão ou moto
//	idDiv: Id da div que receberá o combo-box pronto
//	id: Id do objeto, no caso será utilizado para selecionar os modelos e ano_modelo
function ajaxCarregarCombo(urlBase, tipo_modelo, idDiv, id){
	//Crio o link iniciando com a urlBase
	var link = urlBase;
	
	//Verifico se o tipo_modelo foi passado
	if(tipo_modelo != ''){
		//Se foi passado eu adiciono ele ao link.
		//vale resaltar que se o tipo_modelo for passado o id não será utilizado
		link += tipo_modelo + "/";
	} else if(id != null){
		//Adiciona o id no link
		link += id;
	}
	
	//Método Ajax do jQuery (Muito foda)
	$.ajax({
		//URL que será requisitada
		url:link,
		//Tipo do dado de retorno
		dataType: 'json',
		//Como os dados serão passados, neste caso tanto faz GET ou POST
		type: 'POST',
		//função chamada antes de iniciar a requisição
		beforeSend:function(){
//			$("#div"+idDiv).html("Carregando as informações...");
		},
		//função chamada quando terminar a requisição
		success:function (dados){
			//verifico se o idDiv é igual a Marca
			switch(idDiv){
			case idMarca:
				//Caso sejá, significa que o combo retornado é o de marcas, 
				//então eu adiciono, e já chamo, o evento para carregar o combo de modelos
				$("#combo"+idDiv).change(function () {
					ajaxCarregarCombo(urlServiceModelo, '', idModelo, this.value);
				});
				
//				$("#combo"+idMarca).empty().append('<option value="0" selected>Marca</option>');
				break;
			case idModelo:
				//Verifico se o idDiv é igual a Modelo
				//Se for significa que o combo retornado é de modelo,
				//então eu adiciono, e já chamo, o evento para carregar o combo.
				$("#combo"+idDiv).change(function () {
					ajaxCarregarCombo(urlServiceAnoModelo, '', idAnoModelo, this.value);
				}).change();
				
				//Limpo o combo
//				$("#combo"+idModelo).empty().append('<option value="0" selected>Modelo</option>');
				break;
			case idAnoModelo:
//				$("#combo"+idAnoModelo).empty().append('<option value="0" selected>Tipo</option>');
				break;
			case idEstado:
				$("#combo"+idDiv).change(function () {
					ajaxCarregarCombo(urlServiceCidade, '', idCidade, this.value);
				}).change();
				
//				$("#combo"+idEstado).empty().append('<option value="0" selected>Estado</option>');
				break;
			case idCidade:
//				$("#combo"+idCidade).empty().append('<option value="0" selected>Cidade</option>');
				break;
			}
			if(idDiv != idTipoOleo){
				$("#combo"+idDiv).empty().append('<option value="0" selected>'+idDiv+'</option>');
			} else {
				$("#combo"+idDiv).empty().append('<option value="0" selected>Tipo do Óleo</option>');
			}
			//seto o que for retornado na div de destino
			$.each(dados, function(key, valor){
				$("#combo"+idDiv).append("<option value='"+key+"'>"+valor+"</option>");
			});

			//Adiciona a ação no evento de mudança(Change) para remover o item de valor 0
			$("#combo"+idDiv).change(function() {
				$("#combo" + idDiv + " option[value=0]").remove();
			});
		},
		//Função chamada se acontecer algum erro
		error:function (qXHR, textStatus, errorThrown){
//			alert(textStatus);
		}
	});
}

function resetarCombobox(){
	$("#combo"+idMarca).empty().append('<option value="0" selected>'+idMarca+'</option>');
	$("#combo"+idModelo).empty().append('<option value="0" selected>'+idModelo+'</option>');
	$("#combo"+idAnoModelo).empty().append('<option value="0" selected>'+idAnoModelo+'</option>');
}