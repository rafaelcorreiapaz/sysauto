<?php if ( ! defined('BASEPATH')) exit('Você não deveria estar aqui!');

switch ($tela) {
	case 'cadastrar':

		echo '<div class="container-fluid">';
		errosValidacao();
		getMsg('msgnok');
		getMsg('msgok');
			echo '<div class="form-cad-veiculos">';
		
				echo form_open('veiculos/cadastrar');
					echo '<div class="container-form">';
						echo '<div class="row-fluid">';
					
							echo '<div class="span4">';
							echo form_input(array('name'=>'placa', 'maxlength'=>'8', 'id'=>'placa', 'class'=>'span12', 'placeholder'=>'Placa', 'pattern'=>'[a-zA-Z]{3}-[0-9]{4}'), set_value('placa'),'autofocus required');
							echo '</div>';
						
							echo '<div class="span4">';
							echo form_input(array('name'=>'km_atual', 'maxlength'=>'8', 'id'=>'km_atual', 'class'=>'span12', 'placeholder'=>'KM Atual'), set_value('km_atual'), 'required');
							echo '</div>';
							
							echo '<div class="span4">';
							echo form_input(array('name'=>'media_km_litro', 'class'=>'span12', 'placeholder'=>'Média KM por litro'), set_value('media_km_litro'), 'required');
							echo '</div>';
							
						echo '</div>';
					
						echo '<div class="row-fluid">';
							echo '<div class="span4">';
								echo form_input(array('name'=>'media_km_dia', 'class'=>'span12', 'type'=>'number', 'placeholder'=>'Média KM por dia'), set_value('media_km_dia'), 'required');
							echo '</div>';
							
							echo '<div class="input-prepend span4">';
							echo '<span class="add-on img-calendar"></span>';
							echo form_input(array('name'=>'ultima_troca_oleo', 'id'=>'ultima_troca_oleo', 'type'=>'date', 'class'=>'span11', 'placeholder'=>'Última troca de óleo'), set_value('ultima_troca_oleo'), 'required');
							echo '</div>';
							
							echo '<div class="span4">';
								echo form_input(array('name'=>'km_ultima_troca_oleo', 'id'=>'km_ultima_troca_oleo', 'type'=>'number', 'class'=>'span12', 'placeholder'=>'KM última troca de óleo'), set_value('km_ultima_troca_oleo'), 'required');
							echo '</div>';
					
						echo '</div>';
					
						echo '<div class="row-fluid">';
							echo '<div class="input-prepend span4">';
								echo '<span class="add-on img-calendar"></span>';
								echo form_input(array('name'=>'ultima_troca_pneus', 'id'=>'ultima_troca_pneus', 'type'=>'date', 'class'=>'span11', 'placeholder'=>'Última troca de pneus'), set_value('ultima_troca_pneus'), 'required');
							echo '</div>';
						
							echo '<div class="span4">';
								echo form_input(array('name'=>'km_ultima_troca_pneus', 'id'=>'km_ultima_troca_pneus', 'class'=>'span12', 'placeholder'=>'KM última troca de pneus'), set_value('km_ultima_troca_pneus'), 'required');
							echo '</div>';
							
							echo '<div class="span4">';
								echo form_input(array('name'=>'tipo_eixo', 'id'=>'tipo_eixo', 'class'=>'span12', 'placeholder'=>'Tipo do eixo'), set_value('tipo_eixo'), 'required');
							echo '</div>';
											
						echo '</div>';
	
						echo '<div class="row-fluid">';
							echo '<div class="span4">';
								echo form_input(array('name'=>'capacidade_carga', 'id'=>'capacidade_carga', 'class'=>'span12', 'placeholder'=>'Capacidade da carga'), set_value('capacidade_carga'), 'required');
							echo '</div>';
						
							echo '<div class="span4">';
								echo form_input(array('name'=>'tipo_bau', 'id'=>'tipo_bau', 'class'=>'span12', 'placeholder'=>'Tipo do baú'), set_value('tipo_bau'), 'required');
							echo '</div>';
							
							echo '<div class="span4">';
								echo '<div id="divTipoOleo">';
								echo form_dropdown('id_tipo_oleo', array('Selecione um tipo de óleo'), NULL, 'id="comboTipoOleo" class="span12"');
								echo '</div>';
							echo '</div>';
						echo '</div>';
					
						echo anchor('', 'Deseja cadastrar um seguro para este veículo?', array('onClick'=>'return habilitarCadastroSeguro(this);'));
						echo form_hidden('cadastrar_seguro', set_value('cadastrar_seguro', 'FALSE'), "id='cadastrar_seguro'");
						
						echo form_fieldset('Cadastrar Seguro', array('class'=>'cadastrar-seguro', 'style'=>$this->input->post('cadastrar_seguro')=='TRUE'? 'display:display;':'display:none;'));
						echo '<div class="row-fluid">';
							echo '<div class="input-prepend span4">';
								echo '<span class="add-on">R$</span>';
								echo form_input(array('name'=>'valor', 'id'=>'valor', 'class'=>'span11', 'placeholder'=>'Valor total'), set_value('valor') ,'autofocus');
							echo '</div>';
				
							echo '<div class="control-group span8">';
								echo form_input(array('name'=>'seguradora', 'class'=>'span12', 'placeholder'=>'Seguradora'), set_value('seguradora'));
							echo '</div>';
						echo '</div>';
				
						echo '<div class="row-fluid">';
							echo '<div class="input-prepend span3">';
								echo '<span class="add-on img-calendar"></span>';
								echo form_input(array('name'=>'data_pagamento', 'id'=>'data_pagamento', 'type'=>'date', 'class'=>'span11', 'placeholder'=>'Data de pagamento'), set_value('data_pagamento'));
							echo '</div>';
					
							echo '<div class="span3">';
								echo form_input(array('name'=>'quantidade_parcelas', 'id'=>'quantidade_parcelas', 'type'=>'number', 'class'=>'span12', 'placeholder'=>'Número de parcelas'), set_value('quantidade_parcelas'));
							echo '</div>';
					
							echo '<div class="span3">';
								echo form_input(array('name'=>'num_parcelas_pagas', 'id'=>'num_parcelas_pagas', 'type'=>'number', 'class'=>'span12', 'placeholder'=>'Parcelas pagas'), set_value('num_parcelas_pagas'));
							echo '</div>';
					
							echo '<div class="span3">';
								echo form_input(array('name'=>'vencimento_seguro', 'id'=>'vencimento_seguro', 'type'=>'number', 'class'=>'span12', 'placeholder'=>'Vencimento'), set_value('vencimento_seguro'));
							echo '</div>';
						echo '</div>';
				
						echo '<div class="row-fluid">';
				
							echo '<div class="span6">';
								echo form_input(array('name'=>'contato_corretor', 'id'=>'contato_corretor', 'type'=>'tel', 'class'=>'span12', 'placeholder'=>'Contato do corretor', 'pattern'=>'\([0-9]{2}\)[0-9]{4}-[0-9]{4}'), set_value('contato_corretor'));
							echo '</div>';
				
							echo '<div class="span6">';
								echo form_input(array('name'=>'contato_sinistro', 'id'=>'contato_sinistro', 'type'=>'tel', 'class'=>'span12', 'placeholder'=>'Contato do sinistro', 'pattern'=>'\([0-9]{2}\)[0-9]{4}-[0-9]{4}'), set_value('contato_sinistro'));
							echo '</div>';
				
						echo '</div>';
						echo form_fieldset_close();
				echo '</div>';
				
				echo '<div class="pull-right">';
					echo form_fieldset('Selecione seu Carro', array('id'=>'fieldsetCarro'));
						echo '<div class="btn-group" data-toggle="buttons-radio">';
							echo form_button(array('id'=>'carro', 'class'=>'btn btn-info active'), 'Carro');
							echo form_button(array('id'=>'caminhao', 'class'=>'btn btn-info'), 'Caminhão');
							echo form_button(array('id'=>'moto', 'class'=>'btn btn-info'), 'Moto');
						echo'</div>';
						
						echo '<div class="row-fluid">'; 
						echo form_dropdown('id_marca', array('Marca'), NULL, 'id="comboMarcas"');
						echo '</div>';
						echo '<div class="row-fluid">';
						echo form_dropdown('id_modelo', array('Modelo'), NULL, 'id="comboModelos"');
						echo '</div>';
						echo '<div class="row-fluid">';
						echo form_dropdown('id_ano_modelo', array('Tipo'), NULL, 'id="comboTipo"');
						echo '</div>';
						
						echo '<hr />';
						
						echo '<div id="divEstado">';
						echo form_dropdown('id_estado', array('Estado'), NULL, 'id="comboEstados" class="span12"');
						echo '</div>';
						echo '<div id="divCidade">';
						echo form_dropdown('id_cidade', array('Cidade'), NULL, 'id="comboCidades" class="span12"');
						echo '</div>';
						echo '<div class="form-actions">';
						echo form_submit(array('name'=>'cadastrar'), 'Salvar', 'class="btn btn-success pull-left"');
						echo form_button('cancel', 'Cancelar', 'class="btn btn-danger pull-right"');
						echo '</div>';
					echo form_fieldset_close();
				echo '</div>';
			echo form_close();
		echo '</div>';

		setTema('footerinc', loadJs(array('ajax')), FALSE);		
	break;
	
	case 'cadastrar_seguro':
		echo '<div class="container-fluid">';
		echo form_open('veiculos/cadastrar_seguro');
		errosValidacao();
		getMsg('msgnok');
		getMsg('msgok');
		
		echo '<div class="row-fluid">';
			echo '<div class="input-prepend span3">';
				echo '<span class="add-on">R$</span>';
				echo form_input(array('name'=>'valor', 'id'=>'valor', 'class'=>'span11', 'placeholder'=>'Valor total'), set_value('valor_total'),'autofocus required');
				echo '</div>';
				
				echo '<div class="control-group span9">';
				echo form_input(array('name'=>'seguradora', 'class'=>'span12', 'placeholder'=>'Seguradora'), set_value('seguradora'), 'required');
			echo '</div>';
		echo '</div>';
		
		echo '<div class="row-fluid">';
			echo '<div class="input-prepend span2">';
				echo '<span class="add-on img-calendar"></span>';
				echo form_input(array('name'=>'data_pagamento', 'id'=>'data_pagamento', 'class'=>'span12', 'placeholder'=>'Data de pagamento'), set_value('data_pagamento'), 'required');
			echo '</div>';
			
			echo '<div class="span2">';
				echo form_input(array('name'=>'quantidade_parcelas', 'id'=>'quantidade_parcelas', 'class'=>'span12', 'placeholder'=>'Número de parcelas'), set_value('quantidade_parcelas'), 'required');
			echo '</div>';
			
			echo '<div class="span2">';
				echo form_input(array('name'=>'num_parcelas_pagas', 'id'=>'num_parcelas_pagas', 'class'=>'span12', 'placeholder'=>'Parcelas pagas'), set_value('num_parcelas_pagas'), 'required');
			echo '</div>';
			
			echo '<div class="span2">';
				echo form_input(array('name'=>'vencimento_seguro', 'id'=>'vencimento_seguro', 'class'=>'span12', 'placeholder'=>'Vencimento'), set_value('vencimento_seguro'), 'required');
			echo '</div>';
			
			echo '<div class="span2">';
				echo form_input(array('name'=>'contato_corretor', 'id'=>'contato_corretor', 'class'=>'span12', 'placeholder'=>'Contato do corretor'), set_value('contato_corretor'), 'required');
			echo '</div>';
			
			echo '<div class="span2">';
				echo form_input(array('name'=>'contato_sinistro', 'id'=>'contato_sinistro', 'class'=>'span12', 'placeholder'=>'Contato do sinistro'), set_value('contato_sinistro'), 'required');
			echo '</div>';
		echo '</div>';
		
		echo '<div class="row-fluid">';
		
		echo loadModulo('veiculo_view', 'table_veiculos_radio');
		
		echo '</div>';
		echo '<div class="row-fluid">';
			echo '<div class="form-actions">';
			echo form_button(array('name'=>'cadastrar', 'type'=>'submit'), 'Salvar', 'class="btn btn-primary espaco"');
			echo form_button(array('name'=>'cancelar', 'type'=>'reset'), 'Cancelar', 'class="btn btn-danger"'); 
			echo '</div>';
		echo '</div>';
		
		echo form_fieldset_close();
		echo form_close();
		echo '</div>';
		break;
		
	case 'gerenciar':
		errosValidacao();
		getMsg('msg');
		?>
			<div id="msg"></div>
			<div id="showRegDesativados" class="pull-right"><input type="checkbox" name="checkShowRegDesativados" onclick="mostrarVeiculosDesabilitados()"/> Mostrar registros desativados</div>
			<table class="table table-striped table-bordered data-table">
				<thead>
					<tr>
						<th>Modelo</th>
						<th>Marca</th>
						<th>Placa</th>
						<th>Ações</th>
					</tr>
			  </thead>
			  <tbody>
			  
			<?php 
			$this->load->model('veiculo_dao', 'veiculoDao');
			$veiculos = $this->veiculoDao->getAllWithModel();
			if($veiculos != FALSE){
				foreach ($veiculos as $veiculo) {
					
					printf("<tr id=%s class=%s>", $veiculo->id, ($veiculo->ativo!=1)?'desativado':'');
					printf('<td>%s</td>',anchor('clientes/analizar_veiculo', $veiculo->modelo .' - '. $veiculo->ano_modelo));
				  	printf('<td>%s</td>', $veiculo->marca);
				  	printf('<td>%s</td>', $veiculo->placa);
				  	
				  	echo '<td class="text-center">';
				  	if($veiculo->ativo) {
						echo anchor("veiculos/cadastrar_gasto/$veiculo->id",' ', array('class'=>'table-actions table-gasto', 'title'=>'Cadastrar Gasto'));
						echo anchor("veiculos/editar/$veiculo->id",' ', array('class'=>'table-actions table-edit', 'title'=>'Editar'));
						echo anchor("",' ', array('class'=>'table-actions table-delete deletereg', 'title'=>'Desabilitar'));
					} else {
						echo anchor("",' ', array('class'=>'table-actions table-ativar ativarreg', 'title'=>'Desabilitar'));
					}
					
					echo '</td>';
				  	echo '</tr>';
				}
			}	  
			  ?>
			  </tbody>
			</table>
			<script>
			$(function(){
				$('.deletereg').click(function(){
					if(confirm("Deseja realmente desabilitar este registro?")){ 
						var pai = $(this).closest('TR');
						var id = pai.attr('id');
		
						$.ajax({
							url: "http://localhost/sysauto/service/veiculos/deletarRegistro/"+id,
							dataType: 'html',
							type: 'GET',
							success:function(data){
								if(data == "ok"){
									pai.fadeOut('slow', function() {$(this).remove();});
									$('#msg').html(addMsgAlert('Veículo desabilitado com sucesso', 'sucesso'));
								} else {
									$('#msg').html(addMsgAlert('Erro ao tentar desabilitar o veículo', 'erro'));
								}
							},
							error:function(data){
								alert("Error");
							}
						});
					}
					return false;
				});
			});
			</script>
			<?php
			break;
			
	case 'table_veiculos_radio':
			?>
			<div id="msg"></div>
			<table class="table table-striped table-bordered data-table">
				<thead>
					<tr>
						<th> </th>
						<th>Modelo</th>
						<th>Marca</th>
						<th>Placa</th>
					</tr>
			  </thead>
			  <tbody>
			  
			<?php 
			$this->load->model('veiculo_dao', 'veiculoDao');
			$veiculos = $this->veiculoDao->veiculosSemSeguro();
			  
			foreach ($veiculos as $veiculo) {
				echo '<tr id="'. $veiculo->id .'">';
				printf('<td>'.form_radio(array('name'=>'id_veiculo', 'id'=>'veiculo%s', 'value'=>'%s')).'</td>', $veiculo->id, $veiculo->id);
				printf('<td>%s - %s</td>', $veiculo->modelo, $veiculo->ano_modelo);
			  	printf('<td>%s</td>', $veiculo->marca);
			  	printf('<td>%s</td>', $veiculo->placa);
			  	
			echo '</tr>';
			  }
			  
			  ?>
			  </tbody>
			</table>
			<?php
		break;
		
	case 'cadastrar_gasto':
		
		echo '<div class="form-cad-gasto">';
		errosValidacao();
		getMsg('msg');
		$idVeiculo = $this->uri->segment(3);

		echo form_open("veiculos/cadastrar_gasto/$idVeiculo");
		echo "<script type='text/javascript'>var VAR_AMBIENTE = new Array(); VAR_AMBIENTE['id_veiculo']='$idVeiculo';</script>";
		
		echo form_hidden('id_veiculo', $this->uri->segment(3));
		
		echo '<div class="row-fuild">';
		
		echo '<div class="span3">';
		echo form_input(array('name'=>'valor', 'type'=>'number', 'id'=>'valor', 'class'=>'span12', 'placeholder'=>'Valor', 'oninput'=>'checkCheckBox()'), set_value('valor'), 'autofocus required');
		echo '</div>';

		echo '<div class="span3">';
		echo form_input(array('name'=>'data_gasto', 'type'=>'date', 'id'=>'data_gasto', 'class'=>'span12'), set_value('data_gasto'),'required');
		echo '</div>';
		
		echo '<div class="span3">';
		echo form_input(array('name'=>'km_atual', 'id'=>'km_atual', 'type'=>'number', 'class'=>'span12', 'placeholder'=>'KM Atual'), set_value("km_atual"), 'required');
		echo '</div>';

		echo '<div class="span3">';
		echo form_dropdown('id_tipo_gasto', array('Selecione um tipo de gasto'), NULL, 'id="comboTipoGasto" class="span12"');
		echo '</div>';
		
		echo '</div>';
		
		echo '<div class="row-fluid span3 form-actions">';
		echo form_submit(array('name'=>'cadastrar'), 'Salvar', 'class="btn btn-success pull-left"');
		echo form_button('cancel', 'Cancelar', 'class="btn btn-danger pull-right"');
		echo '</div>';
		
		echo form_close();
		echo '</div>';
		
		setTema('footerinc', loadJs('actions_cadastro_gasto'), FALSE);
		break;
		
	case 'editar':
		
		$idVeiculo = $this->uri->segment(3);
		$veiculo = $this->generic_dao->getById('veiculo', $idVeiculo);
		$modelo = $this->modeloDao->getInformacaoCompleta($veiculo->id_ano_modelo);
		$estado = $this->estadoDao->getIdEstado($veiculo->id_cidade);
		
		echo '<script type="text/javascript">';
		echo 'var VAR_AMBIENTE = Array();';
		echo "VAR_AMBIENTE['TipoOleo'] = '$veiculo->id_tipo_oleo';";
		echo "VAR_AMBIENTE['Marcas']   = '$modelo->marca';";
		echo "VAR_AMBIENTE['Modelos']  = '$modelo->modelo';";
		echo "VAR_AMBIENTE['tipoAutomovel']   = '$modelo->tipoAutomovel';";
		echo "VAR_AMBIENTE['Tipo']     = '$veiculo->id_ano_modelo';";
		echo "VAR_AMBIENTE['Cidades']  = '$veiculo->id_cidade';";
		echo "VAR_AMBIENTE['Estados']  = '$estado->id';";
		echo '</script>';
		
		echo '<div class="container-fluid">';
		errosValidacao();
		getMsg('msgnok');
		getMsg('msgok');
		echo "<div class='form-cad-$tela'>";
		
		echo form_open("veiculos/editar/$idVeiculo");
		echo '<div class="container-form">';
		echo '<div class="row-fluid">';
			
		echo '<div class="span4">';
		echo form_input(array('name'=>'placa', 'maxlength'=>'8', 'id'=>'placa', 'class'=>'span12', 'placeholder'=>'Placa', 'pattern'=>'[a-zA-Z]{3}-[0-9]{4}'), $veiculo->placa,'autofocus required');
		echo '</div>';
		
		echo '<div class="span4">';
		echo form_input(array('name'=>'km_atual', 'maxlength'=>'8', 'id'=>'km_atual', 'class'=>'span12', 'placeholder'=>'KM Atual'), $veiculo->km_atual, 'required');
		echo '</div>';
			
		echo '<div class="span4">';
		echo form_input(array('name'=>'media_km_litro', 'class'=>'span12', 'placeholder'=>'Média KM por litro'), $veiculo->media_km_litro, 'required');
		echo '</div>';
			
		echo '</div>';
			
		echo '<div class="row-fluid">';
		echo '<div class="span4">';
		echo form_input(array('name'=>'media_km_dia', 'class'=>'span12', 'type'=>'number', 'placeholder'=>'Média KM por dia'), $veiculo->media_km_dia, 'required');
		echo '</div>';
			
		echo '<div class="input-prepend span4">';
		echo '<span class="add-on img-calendar"></span>';
		echo form_input(array('name'=>'ultima_troca_oleo', 'id'=>'ultima_troca_oleo', 'type'=>'date', 'class'=>'span11', 'placeholder'=>'Última troca de óleo'), $veiculo->ultima_troca_oleo, 'required');
		echo '</div>';
			
		echo '<div class="span4">';
		echo form_input(array('name'=>'km_ultima_troca_oleo', 'id'=>'km_ultima_troca_oleo', 'type'=>'number', 'class'=>'span12', 'placeholder'=>'KM última troca de óleo'), $veiculo->km_ultima_troca_oleo, 'required');
		echo '</div>';
			
		echo '</div>';
			
		echo '<div class="row-fluid">';
		echo '<div class="input-prepend span4">';
		echo '<span class="add-on img-calendar"></span>';
		echo form_input(array('name'=>'ultima_troca_pneus', 'id'=>'ultima_troca_pneus', 'type'=>'date', 'class'=>'span11', 'placeholder'=>'Última troca de pneus'), $veiculo->ultima_troca_pneus, 'required');
		echo '</div>';
		
		echo '<div class="span4">';
		echo form_input(array('name'=>'km_ultima_troca_pneus', 'id'=>'km_ultima_troca_pneus', 'class'=>'span12', 'placeholder'=>'KM última troca de pneus'), $veiculo->km_ultima_troca_pneus, 'required');
		echo '</div>';
			
		echo '<div class="span4">';
		echo form_input(array('name'=>'tipo_eixo', 'id'=>'tipo_eixo', 'class'=>'span12', 'placeholder'=>'Tipo do eixo'), $veiculo->tipo_eixo, 'required');
		echo '</div>';
			
		echo '</div>';
		
		echo '<div class="row-fluid">';
		echo '<div class="span4">';
		echo form_input(array('name'=>'capacidade_carga', 'id'=>'capacidade_carga', 'class'=>'span12', 'placeholder'=>'Capacidade da carga'), $veiculo->capacidade_carga, 'required');
		echo '</div>';
		
		echo '<div class="span4">';
		echo form_input(array('name'=>'tipo_bau', 'id'=>'tipo_bau', 'class'=>'span12', 'placeholder'=>'Tipo do baú'), $veiculo->tipo_bau, 'required');
		echo '</div>';
			
		echo '<div class="span4">';
		echo '<div id="divTipoOleo">';
		echo form_dropdown('id_tipo_oleo', array('Selecione um tipo de óleo'), NULL, 'id="comboTipoOleo" class="span12"');
		echo '</div>';
		echo '</div>';
		echo '</div>';
			
		echo '</div>';
		
		echo '<div class="pull-right">';
		echo form_fieldset('Selecione seu Carro', array('id'=>'fieldsetCarro'));
		echo '<div class="btn-group" data-toggle="buttons-radio">';
		echo form_button(array('id'=>'carro', 'class'=>'btn btn-info'), 'Carro');
		echo form_button(array('id'=>'caminhao', 'class'=>'btn btn-info'), 'Caminhão');
		echo form_button(array('id'=>'moto', 'class'=>'btn btn-info'), 'Moto');
		echo'</div>';
		
		echo '<div class="row-fluid">';
		echo form_dropdown('id_marca', array('Marca'), NULL, 'id="comboMarcas"');
		echo '</div>';
		echo '<div class="row-fluid">';
		echo form_dropdown('id_modelo', array('Modelo'), NULL, 'id="comboModelos"');
		echo '</div>';
		echo '<div class="row-fluid">';
		echo form_dropdown('id_ano_modelo', array('Tipo'), NULL, 'id="comboTipo"');
		echo '</div>';
		
		echo '<hr />';
		
		echo '<div id="divEstado">';
		echo form_dropdown('id_estado', array('Estado'), NULL, 'id="comboEstados" class="span12"');
		echo '</div>';
		echo '<div id="divCidade">';
		echo form_dropdown('id_cidade', array('Cidade'), NULL, 'id="comboCidades" class="span12"');
		echo '</div>';
		echo '<div class="form-actions">';
		echo form_submit(array('name'=>'cadastrar'), 'Salvar', 'class="btn btn-success pull-left"');
		echo form_button('cancel', 'Cancelar', 'class="btn btn-danger pull-right"');
		echo '</div>';
		echo form_fieldset_close();
		echo '</div>';
		echo form_close();
		echo '</div>';
		
		setTema('footerinc', loadJs(array('ajax_editar_veiculo')), FALSE);
		break;
	default:
		echo 'Padrão';
	break;
}

?>