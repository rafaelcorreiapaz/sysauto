<?php if ( ! defined('BASEPATH')) exit('Você não deveria estar aqui!');

switch ($tela) {
	case 'login':
		
		echo form_open('usuarios/login', array('class'=>'form-signin'));
		echo form_fieldset('Identifique-se');
		errosValidacao();
		getMsg('msg');
		echo form_label('Email');
		echo form_input(array('name'=>'email'), set_value('usuario'), 'autofocus');
		echo form_label('Senha');
		echo form_password(array('name'=>'senha'), set_value('password'));
		echo form_submit(array('name'=>'entrar', 'class'=>'btn btn-success'), 'Entrar');
		echo anchor('usuario/nova_senha', 'Esqueci minha senha', array('class'=>'pull-right'));
		echo form_fieldset_close();
		echo form_close();
		
	break;
	case 'alterar_senha':
		echo '<div class="span3">';
		//echo breadcrumb();
		errosValidacao();
		getMsg('msg');
		echo form_open('usuarios/alterar_senha');
		echo form_fieldset('Alterar senha');
		echo form_label('Nova senha');
		echo form_password(array('name'=>'senha'), NULL, 'autofocus');
		echo form_label('Repetir senha');
		echo form_password(array('name'=>'senha2'));
		echo form_submit(array('name'=>'entrar', 'class'=>'btn btn-success'), 'Alterar');
		echo anchor('usuarios/gerenciar', 'Cancelar', 'class="btn btn-danger pull-right"');
		echo form_fieldset_close();
		echo form_close();
		
		echo '</div>';
		break;
	case 'cadastrar':
		
		echo "<div class='form-cad-$tela'>";
		errosValidacao();
		getMsg('msg');
		echo form_open('usuarios/cadastrar');
		echo '<div class="row-fluid">';
			
			echo '<div class="span5">';
			echo form_input(array('name'=>'nome', 'maxlength'=>'60', 'id'=>'nome', 'class'=>'span12', 'placeholder'=>'Nome'), set_value('nome'),'autofocus required');
			echo '</div>';
			
			echo '<div class="span5">';
			echo form_input(array('name'=>'email', 'type'=>'email', 'maxlength'=>'60', 'id'=>'email', 'class'=>'span12', 'placeholder'=>'Email'), set_value('email'), 'required');
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
				echo form_input(array('name'=>'cep', 'id'=>'cep', 'class'=>'span12', 'placeholder'=>'CEP', 'pattern'=>'\d{5}-?\d{3}', 'required'), set_value('cep'));
			echo '</div>';
			
			echo '<div class="span2">';
			echo form_radio(array('name'=>'id_sexo'), '1', TRUE) . ' Masculino ';
			echo form_radio(array('name'=>'id_sexo'), '2', $this->input->post('id_sexo')== '2'? TRUE: FALSE) . ' Feminino';
			echo '</div>';
			
		echo '</div>';
		
		echo '<div class="row-fluid">';
			
			echo '<div class="span3">';
			echo form_password(array('name'=>'senha', 'id'=>'senha', 'class'=>'span12', 'placeholder'=>'Senha'), NULL, 'required');
			echo '</div>';
			
			echo '<div class="span3">';
			echo form_password(array('name'=>'senha2', 'id'=>'senha2', 'class'=>'span12', 'placeholder'=>'Repita a senha', 'oninput'=>'checkPassword(this)'), NULL, 'required');
			echo '</div>';
			
		echo '</div>';
		
		echo '<div class="row-fluid">';
			echo '<div class="span3">';
			echo form_fieldset('Perfil de Acesso');
			echo '<div id="divPerfilAcesso">';
			echo form_dropdown('id_perfil_acesso', array('Selecione uma perfil'), NULL, 'id="comboPerfilAcesso" class="span12"');
			echo '</div>';
			echo form_fieldset_close();
			echo '</div>';
		echo '</div>';
		
		echo '<div class="row-fluid span3 form-actions">';
			echo form_submit(array('name'=>'cadastrar'), 'Salvar', 'class="btn btn-success pull-left"');
			echo form_button('cancel', 'Cancelar', 'class="btn btn-danger pull-right"');
		echo '</div>';
		
		echo '</div>';
		echo form_close();
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
						<th>Email</th>
						<th>Telefone</th>
						<th>Ações</th>
					</tr>
			  </thead>
			  <tbody>
			  
			<?php 
			$usuarios = $this->generic_dao->getAll('usuario');
			if($usuarios != FALSE){
				foreach ($usuarios as $usuario) {
					if($usuario->id == $this->session->userdata('user_id'))	continue;
					
					printf("<tr id=%s class=%s>", $usuario->id, ($usuario->ativo!=1)?'desativado':'');
					printf('<td>%s</td>',anchor('usuarios/analizar_veiculo', $usuario->nome));
				  	printf('<td>%s</td>', $usuario->email);
				  	printf('<td>%s</td>', $usuario->telefone);
				  	
				  	echo '<td class="text-center">';
				  	if($usuario->ativo) {
						echo anchor("usuarios/alterar_senha/$usuario->id",' ', array('class'=>'table-actions table-pass', 'title'=>'Alterar senha'));
						echo anchor("usuarios/editar/$usuario->id",' ', array('class'=>'table-actions table-edit', 'title'=>'Editar'));
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
							url: "http://localhost/sysauto/service/usuarios/deletarRegistro/"+id,
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
							url: "http://localhost/sysauto/service/usuarios/ativarRegistro/"+id,
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
	case 'editar':
	
		echo "<div class='form-$tela'>";
		errosValidacao();
		getMsg('msg');
		
		$idUsuario = $this->uri->segment(3);
		$usuario = $this->generic_dao->getById('usuario', $idUsuario);
		$estado = $this->estadoDao->getIdEstado($usuario->id_cidade);
		
		echo '<script type="text/javascript">';
		echo 'var VAR_AMBIENTE = Array();';
		echo "VAR_AMBIENTE['PerfilAcesso'] = '$usuario->id_perfil_acesso';";
		echo "VAR_AMBIENTE['Cidades']      = '$usuario->id_cidade';";
		echo "VAR_AMBIENTE['Estados']      = '$estado->id';";
		echo '</script>';
		
		echo form_open("usuarios/editar/$idUsuario");
		echo '<div class="row-fluid">';
		
			echo '<div class="span5">';
			echo form_input(array('name'=>'nome', 'maxlength'=>'60', 'id'=>'nome', 'class'=>'span12', 'placeholder'=>'Nome'), $usuario->nome,'autofocus required');
			echo '</div>';
		
			echo '<div class="span5">';
			echo form_input(array('name'=>'email', 'type'=>'email', 'maxlength'=>'60', 'id'=>'email', 'class'=>'span12', 'placeholder'=>'Email'), $usuario->email, 'disabled');
			echo '</div>';
	
			echo '<div class="span2">';
			echo form_input(array('name'=>'telefone', 'id'=>'telefone', 'type'=>'tel', 'class'=>'span12', 'placeholder'=>'Telefone', 'pattern'=>'\([0-9]{2}\)[0-9]{4}-[0-9]{4}'), $usuario->telefone);
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
			echo form_input(array('name'=>'cep', 'id'=>'cep', 'class'=>'span12', 'placeholder'=>'CEP', 'pattern'=>'\d{5}-?\d{3}', 'required'), $usuario->cep);
			echo '</div>';
					
			echo '<div class="span2" style="heigth:100%">';
			echo form_radio(array('name'=>'id_sexo'), '1', $usuario->id_sexo == '1'? TRUE: FALSE) . ' Masculino ';
			echo form_radio(array('name'=>'id_sexo'), '2', $usuario->id_sexo == '2'? TRUE: FALSE) . ' Feminino';
			echo '</div>';

		echo '</div>';
	
		echo '<div class="row-fluid">';
		
			echo '<div class="span3">';
			echo form_password(array('name'=>'senha', 'id'=>'senha', 'class'=>'span12', 'placeholder'=>'Senha'), NULL);
			echo '</div>';
		
			echo '<div class="span3">';
			echo form_password(array('name'=>'senha2', 'id'=>'senha2', 'class'=>'span12', 'placeholder'=>'Repita a senha'), NULL);
			echo '</div>';

		echo '</div>';

		echo '<div class="row-fluid">';
			echo '<div class="span3">';
			echo form_fieldset('Perfil de Acesso');
			echo form_dropdown('id_perfil_acesso', array('Selecione uma perfil'), NULL, 'id="comboPerfilAcesso" class="span12"');
			echo form_fieldset_close();
			echo '</div>';
		echo '</div>';
	
			echo '<div class="row-fluid span3 form-actions">';
			echo form_submit(array('name'=>'cadastrar'), 'Salvar', 'class="btn btn-success"');
			echo form_button('cancel', 'Cancelar', 'class="btn btn-danger pull-right"');
			echo '</div>';
	
		echo '</div>';
		echo form_close();
	break;
	default:
		echo 'Padr�o';
		break;
}
?>