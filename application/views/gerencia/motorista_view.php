<?php if ( ! defined('BASEPATH')) exit('Você não deveria estar aqui!');

switch ($tela) {
	case 'cadastrar':
		echo "<div class='form-cad-$tela'>";
		errosValidacao();
		getMsg('msg');
		echo form_open('motoristas/cadastrar');
		echo '<div class="row-fluid">';
			
		echo '<div class="span5">';
		echo form_input(array('name'=>'nome', 'maxlength'=>'60', 'id'=>'nome', 'class'=>'span12', 'placeholder'=>'Nome'), set_value('nome'),'autofocus required');
		echo '</div>';
			
		echo '<div class="span2">';
		echo form_input(array('name'=>'cpf', 'type'=>'text', 'maxlength'=>'60', 'id'=>'cpf', 'class'=>'span12', 'placeholder'=>'CPF'), set_value('cpf'), 'required');
		echo '</div>';
		
		echo '<div class="span3">';
		echo form_input(array('name'=>'data_nascimento', 'type'=>'date', 'id'=>'data_nascimento', 'class'=>'span12'), set_value('data_nascimento'), 'required');
		echo '</div>';
		
		echo '<div class="span2">';
		echo form_input(array('name'=>'telefone', 'id'=>'telefone', 'type'=>'tel', 'class'=>'span12', 'placeholder'=>'Telefone', 'pattern'=>'\([0-9]{2}\)[0-9]{4}-[0-9]{4}'), set_value('telefone'));
		echo '</div>';
		
		echo '</div>';
		
		echo '<div class="row-fluid">';
			
		echo '<div class="span3">';
		echo form_dropdown('id_estado', array('Selecione um estado'), NULL, 'id="comboEstados" class="span12"');
		echo '</div>';
		echo '<div class="span3">';
		echo form_dropdown('id_cidade', array('Selecione uma cidade'), NULL, 'id="comboCidades" class="span12"');
		echo '</div>';
		
		echo '<div class="span2">';
		echo form_input(array('name'=>'cep', 'id'=>'cep', 'class'=>'span12', 'placeholder'=>'CEP', 'pattern'=>'\d{5}-?\d{3}', ''), set_value('cep'));
		echo '</div>';
			
		echo '<div class="span2">';
		echo form_radio(array('name'=>'id_sexo'), '1', TRUE) . ' Masculino ';
		echo form_radio(array('name'=>'id_sexo'), '2', $this->input->post('id_sexo')== '2'? TRUE: FALSE) . ' Feminino';
		echo '</div>';
			
		echo '</div>';
		
		echo '<div class="row-fluid">';

		echo '<div class="span3">';
		echo form_input(array('name'=>'endereco', 'type'=>'text', 'id'=>'endereco', 'class'=>'span12', 'placeholder'=>'Endereço'), set_value('endereco'));
		echo '</div>';
			
		echo '<div class="span3">';
		echo form_input(array('name'=>'bairro', 'type'=>'text', 'id'=>'bairro', 'class'=>'span12', 'placeholder'=>'Bairro'), set_value('bairro'), 'required');
		echo '</div>';
			
		echo '</div>';
		
		echo loadModulo('veiculo_view', 'table_veiculos_radio');
		
		echo '<div class="row-fluid span3 form-actions">';
		echo form_submit(array('name'=>'cadastrar', 'disabled'=>'disabled'), 'Salvar', 'class="btn btn-success pull-left"');
		echo form_button('cancel', 'Cancelar', 'class="btn btn-danger pull-right"');
		echo '</div>';
		echo form_close();
		
		echo '</div>';
	break;
	
	case 'gerenciar':
		errosValidacao();
		getMsg('msg');
		?>
				<div id="msg"></div>
				<div id="showRegDesativados" class="pull-right"><input type="checkbox" name="checkShowRegDesativados" onclick="mostrarVeiculosDesabilitados()"/> Mostrar registros desativados</div>
				<table class="table table-bordered data-table">
					<thead>
						<tr>
							<th>Nome</th>
							<th>Telefone</th>
							<th>Modelo</th>
							<th>Marca</th>
							<th>Placa</th>
							<th>Ações</th>
						</tr>
				  </thead>
				  <tbody>
				  
				<?php 
				$this->db->where('id_empresa', $this->session->userdata('empresa_id'));
				$motoristas = $this->generic_dao->getAll('motorista');
				
				if($motoristas != FALSE){
					foreach ($motoristas as $motorista) {
						$veiculo = $this->veiculoDao->getVeiculoByMotorista($motorista->id);
					
						printf("<tr id=%s class=%s>", $motorista->id, ($motorista->ativo!=1)?'desativado':'');
						printf('<td>%s</td>',anchor("motoristas/editar/$motorista->id", $motorista->nome));
					  	printf('<td>%s</td>', $motorista->telefone);
					  	printf('<td>%s</td>', $veiculo->modelo .' - '. $veiculo->ano_modelo);
				  		printf('<td>%s</td>', $veiculo->marca);
				  		printf('<td>%s</td>', $veiculo->placa);
					  	
						echo '<td class="text-center">';
					  	if($motorista->ativo) {
							echo anchor("motoristas/alterar_senha/$motorista->id",' ', array('class'=>'table-actions table-pass', 'title'=>'Alterar senha'));
							echo anchor("motoristas/editar/$motorista->id",' ', array('class'=>'table-actions table-edit', 'title'=>'Editar'));
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
								url: "http://localhost/sysauto/service/motoristas/deletarRegistro/"+id,
								dataType: 'html',
								type: 'GET',
								success:function(data){
									if(data == "ok"){
										pai.fadeOut('slow', function() {
											$(this).addClass('desativado');
											$(this).css('display', 'none');
										});
										$('#msg').html(addMsgAlert('Ve�culo desabilitado com sucesso', 'sucesso'));
									} else {
										$('#msg').html(addMsgAlert('Erro ao tentar desabilitar o ve�culo', 'erro'));
									}
								},
								error:function(data){
									alert("Error");
								}
							});
						}
						return false;
					});
					$('.ativarreg').click(function(){
						if(confirm("Deseja realmente habilitar este registro?")){ 
							var pai = $(this).closest('TR');
							var id = pai.attr('id');
			
							$.ajax({
								url: "http://localhost/sysauto/service/motoristas/ativarRegistro/"+id,
								dataType: 'html',
								type: 'GET',
								success:function(data){
									if(data == "ok"){
										pai.fadeOut('slow', function() {
											$(this).removeClass('desativado');
											$(this).css('display', 'table-row');
										});
										$('#msg').html(addMsgAlert('Ve�culo desabilitado com sucesso', 'sucesso'));
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
	default:
		echo 'Tela não existente!';
	break;
}

?>