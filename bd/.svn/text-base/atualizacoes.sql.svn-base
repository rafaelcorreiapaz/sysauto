/* 25/08/2013 */

//Novo menu
INSERT INTO menu VALUES ('13', 'Gerenciar Motorista', 'gerenciar', 'motoristas', 'motoristas/gerenciar', 1, 1, 2, 1);
INSERT INTO `sysauto`.`permissoes` (`id_menu`, `id_perfil_acesso`) VALUES ('13', '1');


/* 19/08/2013 */
ALTER TABLE `sysauto`.`veiculo_motorista` CHANGE COLUMN `date_desativado` `data_desativado` DATE NULL;

ALTER TABLE `sysauto`.`motorista` 
	CHANGE COLUMN `bairro` `bairro` VARCHAR(45) NOT NULL  AFTER `endereco` , 
	CHANGE COLUMN `ativo` `ativo` TINYINT(1) NOT NULL DEFAULT '1'  AFTER `id_sexo` ,
	CHANGE COLUMN `endereco` `endereco` VARCHAR(45) NOT NULL  , 
	ADD COLUMN `cep` VARCHAR(45) NOT NULL  AFTER `bairro` ;
INSERT `sysauto`.`menu` VALUES (12, 'Cadastrar Motoristas', 'cadastrar', 'motoristas', 'motoristas/cadastrar', 1, 1, 2, 1);
UPDATE `sysauto`.`menu` SET `nome`='Alterar Senha' WHERE `id`='11';

UPDATE `sysauto`.`menu` SET `nome`='Gerenciar' WHERE `id`='8';
UPDATE `sysauto`.`menu` SET `nome`='Cadastrar' WHERE `id`='7';
INSERT INTO `sysauto`.`menu` (nome, metodo, classe, url, privado, ativo, id_menu_pai, menu_geral) 
	   VALUES ('Alterar Senha', 'alterar_senha', 'usuarios', 'usuarios/alterar_senha', 1, 1, 6, 0);
INSERT INTO `sysauto`.`permissoes` (`id_menu`, `id_perfil_acesso`) VALUES ('11', '1');

/**
* Versão: 1.3.4
*/
UPDATE `sysauto`.`menu` SET `metodo`='gerenciar', `classe`='usuarios', `url`='usuarios/gerenciar' WHERE `id`='6';
UPDATE `sysauto`.`menu` SET `metodo`='cadastrar', `classe`='usuarios', `url`='usuarios/cadastrar' WHERE `id`='7';
UPDATE `sysauto`.`menu` SET `classe`='usuarios', `url`='usuarios/gerenciar' WHERE `id`='8';
UPDATE `sysauto`.`menu` SET `metodo`='cadastrar', `url`='veiculos/cadastrar' WHERE `id`='3';

/**
* Versão: 1.3.3
*/

ALTER TABLE `sysauto`.`menu` ADD COLUMN `menu_geral` VARCHAR(45) NOT NULL DEFAULT 1 AFTER `id_menu_pai` ;
UPDATE `sysauto`.`menu` SET `id_menu_pai`='2', `menu_geral`='0' WHERE `id`='9';
INSERT INTO `sysauto`.`menu` (nome, metodo, classe, url, privado, ativo, id_menu_pai, menu_geral) 
	   VALUES ('Cadastrar Gasto', 'cadastrar_gasto', 'veiculos', 'veiculos/cadastrar_gasto', 1, 1, 2, 0);