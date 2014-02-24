var urlVeiculoTemMotorista = 'http://localhost/sysauto/service/veiculos/veiculoTemMotorista/';
var urlDesativarMotorista  = 'http://localhost/sysauto/service/veiculos/desativarMotorista/';

//Quando a página terminar de carregar
$(document).ready(function(){
	$("input[name=id_veiculo]").click(function(){
		ajaxCarregarCombo(urlVeiculoTemMotorista, $('input[name=id_veiculo]:checked').val());
	});
});

//Função que carregará os combo box por ajax.
//@paramets:
//	urlBase: URL base do service
//	id: Id do objeto, no caso será utilizado para selecionar os modelos e ano_modelo
function ajaxCarregarCombo(urlBase, id){
	$.ajax({
		url:urlBase+id,
		dataType: 'json',
		type: 'GET',
		beforeSend:function(){},
		success:function (dados){
			if(dados['ok'] == undefined){
				//Tirar este confirm()
				if(confirm("O motorista "+ dados['nome'] + ", com o CPF "+ dados['cpf'] +" já esta cadastrado para este veículo, " +
						"para cadastrar um novo motorista para este veículo é necessário desativar este motorista. Deseja desativa-lo?")){
					
					$.ajax({
						url:urlDesativarMotorista,
						dataType:'text',
						data:{'idVeiculo':id, 'idMotorista':dados['id']},
						type:'GET',
						success:function(resposta){
							if(resposta == 'ok'){
								//E este alert
								alert('Motorista removido com sucesso. Pode efetuar o cadastro.');
								$("input[type=submit]").removeAttr("disabled");
							}
						},
						error:function(){
							alert('Fudeo');
						}
					});
				}
			} else {
				$("input[type=submit]").removeAttr("disabled");
			}
		},
		error:function (qXHR, textStatus, errorThrown){
			alert('Ixi, fudeo corre e chama o Rhino');
		}
	});
}
