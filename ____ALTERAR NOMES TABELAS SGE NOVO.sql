SET FOREIGN_KEY_CHECKS=0;

ALTER TABLE tbl_modulo RENAME COLUMN cd_modulo TO id;
ALTER TABLE tbl_modulo RENAME COLUMN ds_modulo TO `name`;
ALTER TABLE tbl_modulo RENAME COLUMN id_ativo TO is_activated;
ALTER TABLE tbl_modulo RENAME COLUMN no_ordem TO `order_by`;
RENAME TABLE tbl_modulo TO system_modules;

ALTER TABLE tbl_menu RENAME COLUMN cd_menu TO id;
ALTER TABLE tbl_menu RENAME COLUMN cd_modulo TO system_module_id;
ALTER TABLE tbl_menu RENAME COLUMN ds_menu TO `name`;
ALTER TABLE tbl_menu RENAME COLUMN obs TO `comment`;
ALTER TABLE tbl_menu RENAME COLUMN no_nivel TO `level`;
ALTER TABLE tbl_menu RENAME COLUMN ds_url TO `route`;
ALTER TABLE tbl_menu RENAME COLUMN no_ordem TO `order_by`;
ALTER TABLE tbl_menu RENAME COLUMN id_ativo TO is_activated;
RENAME TABLE tbl_menu TO menus;


ALTER TABLE tbl_pessoa RENAME COLUMN cd_pessoa TO id;
ALTER TABLE tbl_pessoa RENAME COLUMN nm_pessoa TO name;
ALTER TABLE tbl_pessoa RENAME COLUMN ds_pessoa_email to email;
ALTER TABLE tbl_pessoa RENAME COLUMN id_pessoa_sexo to gender;
ALTER TABLE tbl_pessoa RENAME COLUMN dt_pessoa_nasc to last_name;
ALTER TABLE tbl_pessoa RENAME COLUMN id_ativo TO is_activated;
ALTER TABLE tbl_pessoa ADD `created_at` TIMESTAMP NULL DEFAULT NULL;
ALTER TABLE tbl_pessoa ADD `deleted_at` TIMESTAMP NULL DEFAULT NULL;
ALTER TABLE tbl_pessoa ADD `updated_at` TIMESTAMP NULL DEFAULT NULL;
RENAME TABLE tbl_pessoa TO persons;

ALTER TABLE tbl_projeto RENAME COLUMN cd_projeto TO id;
ALTER TABLE tbl_projeto RENAME COLUMN ds_projeto TO `name`;
ALTER TABLE tbl_projeto RENAME COLUMN ds_projeto_alias TO short_name;
ALTER TABLE tbl_projeto RENAME COLUMN ds_projeto_prefixo TO prefix_code;
ALTER TABLE tbl_projeto RENAME COLUMN ds_ccusto TO cost_center;
ALTER TABLE tbl_projeto RENAME COLUMN id_ativo TO is_activated;
ALTER TABLE tbl_projeto RENAME COLUMN dt_datareg TO created_at;
ALTER TABLE tbl_projeto ADD `deleted_at` TIMESTAMP NULL DEFAULT NULL;
ALTER TABLE tbl_projeto ADD `updated_at` TIMESTAMP NULL DEFAULT NULL;
RENAME TABLE tbl_projeto TO projects;

ALTER TABLE tbl_veic_desmob RENAME COLUMN cd_veic_desmob TO id;
ALTER TABLE tbl_veic_desmob RENAME COLUMN cd_veic_dados TO vehicle_id;
ALTER TABLE tbl_veic_desmob RENAME COLUMN cd_projeto TO project_id;
ALTER TABLE tbl_veic_desmob RENAME COLUMN cd_projeto_solic TO cd_projeto_requested;
ALTER TABLE tbl_veic_desmob RENAME COLUMN cd_veic_status TO status_id;
ALTER TABLE tbl_veic_desmob RENAME COLUMN dt_mob_solic TO mobilization_date_requested;
ALTER TABLE tbl_veic_desmob RENAME COLUMN dt_mob TO mobilization_date;
ALTER TABLE tbl_veic_desmob RENAME COLUMN dt_desmob_solic TO demobilization_date_requested;
ALTER TABLE tbl_veic_desmob RENAME COLUMN dt_desmo TO demobilization_date;
ALTER TABLE tbl_veic_desmob RENAME COLUMN vl_km_atual_solic TO km_control_requested;
ALTER TABLE tbl_veic_desmob RENAME COLUMN vl_km_atual TO km_control;
ALTER TABLE tbl_veic_desmob RENAME COLUMN vl_km_devoluc_solic TO km_return_requested;
ALTER TABLE tbl_veic_desmob RENAME COLUMN vl_km_devoluc TO km_return;
ALTER TABLE tbl_veic_desmob RENAME COLUMN vl_h_atual_solic TO hour_control_requested;
ALTER TABLE tbl_veic_desmob RENAME COLUMN vl_h_atual TO hour_control;
ALTER TABLE tbl_veic_desmob RENAME COLUMN vl_h_devoluc_solic TO hour_control_return_requested;
ALTER TABLE tbl_veic_desmob RENAME COLUMN vl_h_devoluc TO hour_control_return;
ALTER TABLE tbl_veic_desmob RENAME COLUMN cd_usuar_solicdesmob TO user_id_return_requested;
ALTER TABLE tbl_veic_desmob RENAME COLUMN cd_usuar_desmob TO user_id_return;
ALTER TABLE tbl_veic_desmob RENAME COLUMN id_desmob_aguard TO request_status;
ALTER TABLE tbl_veic_desmob RENAME COLUMN cd_desmob_aprov TO user_id_approver;
ALTER TABLE tbl_veic_desmob RENAME COLUMN dt_cad_desmob TO demobilization_date_created;
ALTER TABLE tbl_veic_desmob RENAME COLUMN dt_desmob_aprov TO demobilization_approval_date;
ALTER TABLE tbl_veic_desmob RENAME COLUMN cd_usuar_cad TO user_id;
ALTER TABLE tbl_veic_desmob RENAME COLUMN dt_datareg TO created_at;
ALTER TABLE tbl_veic_desmob ADD `deleted_at` TIMESTAMP NULL DEFAULT NULL;
ALTER TABLE tbl_veic_desmob ADD `updated_at` TIMESTAMP NULL DEFAULT NULL;
RENAME TABLE tbl_veic_desmob TO mobilization_historics;

ALTER TABLE tbl_veic_marca RENAME COLUMN cd_veic_marca TO id;
ALTER TABLE tbl_veic_marca RENAME COLUMN ds_veic_marca TO `name`;
ALTER TABLE tbl_veic_marca RENAME COLUMN id_ativo TO is_activated;
ALTER TABLE tbl_veic_marca ADD `created_at` TIMESTAMP NULL DEFAULT NULL;
ALTER TABLE tbl_veic_marca ADD `deleted_at` TIMESTAMP NULL DEFAULT NULL;
ALTER TABLE tbl_veic_marca ADD `updated_at` TIMESTAMP NULL DEFAULT NULL;
RENAME TABLE tbl_veic_marca TO brands;

ALTER TABLE tbl_localidade RENAME COLUMN cd_localidade TO id;
ALTER TABLE tbl_localidade RENAME COLUMN ds_localidade TO `name`;
ALTER TABLE tbl_localidade RENAME COLUMN cd_projeto TO project_id;
ALTER TABLE tbl_localidade RENAME COLUMN id_ativo TO is_activated;
ALTER TABLE tbl_localidade ADD `created_at` TIMESTAMP NULL DEFAULT NULL;
ALTER TABLE tbl_localidade ADD `deleted_at` TIMESTAMP NULL DEFAULT NULL;
ALTER TABLE tbl_localidade ADD `updated_at` TIMESTAMP NULL DEFAULT NULL;
RENAME TABLE tbl_localidade TO project_locations;

ALTER TABLE tbl_veic_desc RENAME COLUMN cd_veic_desc TO id;
ALTER TABLE tbl_veic_desc RENAME COLUMN cd_usuar_cad TO user_id_created;
ALTER TABLE tbl_veic_desc RENAME COLUMN ds_desc_prefixo TO prefix;
ALTER TABLE tbl_veic_desc RENAME COLUMN ds_veic_desc TO `name`;
ALTER TABLE tbl_veic_desc RENAME COLUMN id_ativo TO is_activated;
ALTER TABLE tbl_veic_desc ADD `created_at` TIMESTAMP NULL DEFAULT NULL;
ALTER TABLE tbl_veic_desc ADD `updated_at` TIMESTAMP NULL DEFAULT NULL;
ALTER TABLE tbl_veic_desc ADD `deleted_at` TIMESTAMP NULL DEFAULT NULL;
RENAME TABLE tbl_veic_desc TO equipment_prefixes;

ALTER TABLE tbl_veic_grupo RENAME COLUMN cd_veic_grupo TO id;
ALTER TABLE tbl_veic_grupo RENAME COLUMN ds_veic_grupo TO `name`;
ALTER TABLE tbl_veic_grupo RENAME COLUMN id_ativo TO is_activated;
ALTER TABLE tbl_veic_grupo ADD `created_at` TIMESTAMP NULL DEFAULT NULL;
ALTER TABLE tbl_veic_grupo ADD `updated_at` TIMESTAMP NULL DEFAULT NULL;
ALTER TABLE tbl_veic_grupo ADD `deleted_at` TIMESTAMP NULL DEFAULT NULL;
RENAME TABLE tbl_veic_grupo TO equipment_groups;

ALTER TABLE tbl_veic_familia RENAME COLUMN cd_veic_familia TO id;
ALTER TABLE tbl_veic_familia RENAME COLUMN cd_veic_grupo TO equipment_group_id;
ALTER TABLE tbl_veic_familia RENAME COLUMN cd_usuar_cad TO user_id;
ALTER TABLE tbl_veic_familia RENAME COLUMN ds_veic_familia TO `name`;
ALTER TABLE tbl_veic_familia RENAME COLUMN hr_horas_maxdia TO maximum_hour;
ALTER TABLE tbl_veic_familia RENAME COLUMN id_tipo TO `type`;
ALTER TABLE tbl_veic_familia RENAME COLUMN id_implemento TO has_implement;
ALTER TABLE tbl_veic_familia RENAME COLUMN id_placa TO has_tag;
ALTER TABLE tbl_veic_familia RENAME COLUMN id_renavam TO has_vin_number;
ALTER TABLE tbl_veic_familia RENAME COLUMN id_ano_modelo TO has_model_year;
ALTER TABLE tbl_veic_familia RENAME COLUMN vl_fator_convert TO conversion_factor;
ALTER TABLE tbl_veic_familia RENAME COLUMN dt_datareg TO created_at;
ALTER TABLE tbl_veic_familia RENAME COLUMN id_ativo TO is_activated;
ALTER TABLE tbl_veic_familia ADD `updated_at` TIMESTAMP NULL DEFAULT NULL;
ALTER TABLE tbl_veic_familia ADD `deleted_at` TIMESTAMP NULL DEFAULT NULL;
RENAME TABLE tbl_veic_familia TO equipment_families;

ALTER TABLE tbl_veic_modelo RENAME COLUMN cd_veic_modelo TO id;
ALTER TABLE tbl_veic_modelo RENAME COLUMN cd_veic_marca TO equipment_brand_id;
ALTER TABLE tbl_veic_modelo RENAME COLUMN cd_veic_familia TO equipment_family_id;
ALTER TABLE tbl_veic_modelo RENAME COLUMN cd_veic_desc TO equipment_prefix_id;
ALTER TABLE tbl_veic_modelo RENAME COLUMN cd_usuar_cad TO user_id_created;
ALTER TABLE tbl_veic_modelo RENAME COLUMN cd_usuar_exc TO user_id_deleted;
ALTER TABLE tbl_veic_modelo RENAME COLUMN ds_veic_prefixo TO prefix;
ALTER TABLE tbl_veic_modelo RENAME COLUMN ds_veic_modelo TO `name`;
ALTER TABLE tbl_veic_modelo RENAME COLUMN ds_peso TO weight_measurment;
ALTER TABLE tbl_veic_modelo RENAME COLUMN id_unid1 TO unit1;
ALTER TABLE tbl_veic_modelo RENAME COLUMN ds_capacidade TO capacity_measurment;
ALTER TABLE tbl_veic_modelo RENAME COLUMN id_unid2 TO unit2;
ALTER TABLE tbl_veic_modelo RENAME COLUMN ds_potencia TO power_measurment;
ALTER TABLE tbl_veic_modelo RENAME COLUMN id_unid3 TO unit3;
ALTER TABLE tbl_veic_modelo RENAME COLUMN qt_tanque TO tank_capacity;
ALTER TABLE tbl_veic_modelo RENAME COLUMN ds_consumo_comb TO fuel_consumption;
ALTER TABLE tbl_veic_modelo RENAME COLUMN ds_consumo_lubrif TO lubricant_consumption;
ALTER TABLE tbl_veic_modelo RENAME COLUMN id_ativo TO is_activated;
ALTER TABLE tbl_veic_modelo ADD `updated_at` TIMESTAMP NULL DEFAULT NULL;
ALTER TABLE tbl_veic_modelo ADD `deleted_at` TIMESTAMP NULL DEFAULT NULL;
ALTER TABLE tbl_veic_modelo ADD `created_at` TIMESTAMP NULL DEFAULT NULL;
RENAME TABLE tbl_veic_modelo TO equipment_models;
ALTER TABLE equipment_models drop FOREIGN KEY cd_usuar_cad_fdk;
ALTER TABLE equipment_models drop column user_id_created;


ALTER TABLE tbl_veic_unids RENAME COLUMN cd_veic_unids TO id;
ALTER TABLE tbl_veic_unids RENAME COLUMN id_unid TO `type`;
ALTER TABLE tbl_veic_unids RENAME COLUMN ds_unid TO `name`;
ALTER TABLE tbl_veic_unids RENAME COLUMN ds_descricao_implem TO  description;
ALTER TABLE family_measures ADD `updated_at` TIMESTAMP NULL DEFAULT NULL;
ALTER TABLE family_measures ADD `deleted_at` TIMESTAMP NULL DEFAULT NULL;
ALTER TABLE family_measures ADD `created_at` TIMESTAMP NULL DEFAULT NULL;
RENAME TABLE tbl_veic_unids TO measurement_units;

ALTER TABLE tbl_veic_familia_unid RENAME COLUMN cd_veic_familia_unid TO id;
ALTER TABLE tbl_veic_familia_unid RENAME COLUMN cd_veic_familia TO equipment_family_id;
ALTER TABLE tbl_veic_familia_unid ADD measurement_unit_id INT(10) UNSIGNED DEFAULT NULL;
ALTER TABLE tbl_veic_familia_unid ADD `deleted_at` TIMESTAMP NULL DEFAULT NULL;
ALTER TABLE tbl_veic_familia_unid RENAME COLUMN id_unid TO `type`;
RENAME TABLE tbl_veic_familia_unid TO family_measures;
update family_measures fm
inner join measurement_units m on m.`type` = fm.`type` and m.name = fm.ds_unid
set fm.measurement_unit_id = m.id;

ALTER TABLE tbl_veic_locatario RENAME COLUMN cd_veic_locatario TO id;
ALTER TABLE tbl_veic_locatario RENAME COLUMN ds_veic_locatario TO `name`;
ALTER TABLE tbl_veic_locatario RENAME COLUMN ds_veic_locatario_fant TO fantasy_name;
ALTER TABLE tbl_veic_locatario RENAME COLUMN no_cnpj TO document_number;
ALTER TABLE tbl_veic_locatario RENAME COLUMN id_ativo TO is_activated;
ALTER TABLE tbl_veic_locatario RENAME COLUMN cd_usuar_exc TO user_id_deleted;
ALTER TABLE tbl_veic_locatario ADD `created_at` TIMESTAMP NULL DEFAULT now();
ALTER TABLE tbl_veic_locatario ADD `updated_at` TIMESTAMP NULL DEFAULT NULL;
ALTER TABLE tbl_veic_locatario ADD `deleted_at` TIMESTAMP NULL DEFAULT NULL;
RENAME TABLE tbl_veic_locatario TO supplyers;

ALTER TABLE tbl_empresa RENAME COLUMN cd_empresa TO id;
ALTER TABLE tbl_empresa RENAME COLUMN cd_empresa_tipo TO `segment`;
ALTER TABLE tbl_empresa RENAME COLUMN ds_empresa TO `name`;
ALTER TABLE tbl_empresa RENAME COLUMN ds_empresa_fantasia TO fantasy_name;
ALTER TABLE tbl_empresa RENAME COLUMN ds_empresa_cnpj TO document_number;
ALTER TABLE tbl_empresa RENAME COLUMN id_ativo TO is_activated;
ALTER TABLE tbl_empresa RENAME COLUMN ds_empresa_email TO is_activated;
ALTER TABLE tbl_empresa RENAME COLUMN ds_logomarca TO logo;
ALTER TABLE tbl_empresa RENAME COLUMN dt_datareg TO `created_at`;
ALTER TABLE tbl_empresa ADD `updated_at` TIMESTAMP NULL DEFAULT NULL;
ALTER TABLE tbl_empresa ADD `deleted_at` TIMESTAMP NULL DEFAULT NULL;
RENAME TABLE tbl_empresa TO companies;
ALTER TABLE companies DROP FOREIGN KEY cd_empresa_tipo_fk;
ALTER TABLE companies DROP FOREIGN KEY cd_usuar_fk3;
alter table companies drop column cd_usuar_cad;

ALTER TABLE tbl_veic_moto RENAME COLUMN cd_veic_moto TO id;
ALTER TABLE tbl_veic_moto RENAME COLUMN ds_moto_chapa TO registration;
ALTER TABLE tbl_veic_moto RENAME COLUMN ds_moto_nome TO `name`;
ALTER TABLE tbl_veic_moto RENAME COLUMN ds_moto_funcao TO `function`;
ALTER TABLE tbl_veic_moto RENAME COLUMN cd_projeto TO project_id;
ALTER TABLE tbl_veic_moto RENAME COLUMN id_ativo TO is_activated;
ALTER TABLE tbl_veic_moto RENAME COLUMN dt_datareg TO `created_at`;
ALTER TABLE tbl_veic_moto ADD `updated_at` TIMESTAMP NULL DEFAULT NULL;
ALTER TABLE tbl_veic_moto ADD `deleted_at` TIMESTAMP NULL DEFAULT NULL;
RENAME TABLE tbl_veic_moto TO drivers;

-- EQUIPAMENTOS

ALTER TABLE tbl_veic_dados RENAME COLUMN cd_veic_dados 		TO id;
ALTER TABLE tbl_veic_dados RENAME COLUMN ds_prefixo			TO prefix;
ALTER TABLE tbl_veic_dados RENAME COLUMN no_prefixo_seq		TO sequencial;
ALTER TABLE tbl_veic_dados RENAME COLUMN cd_empresa			TO company_id;
ALTER TABLE tbl_veic_dados RENAME COLUMN cd_projeto			TO project_id;
ALTER TABLE tbl_veic_dados RENAME COLUMN cd_veic_modelo		TO model_id;
ALTER TABLE tbl_veic_dados RENAME COLUMN cd_veic_locatario	TO supplyer_id;
ALTER TABLE tbl_veic_dados RENAME COLUMN cd_usuar_cad			TO user_id;
ALTER TABLE tbl_veic_dados RENAME COLUMN cd_veic_combust		TO fuel_id;
ALTER TABLE tbl_veic_dados RENAME COLUMN cd_veic_status		TO status_id;
ALTER TABLE tbl_veic_dados RENAME COLUMN cd_contaativ			TO activity_id;
ALTER TABLE tbl_veic_dados RENAME COLUMN vl_km_atual			TO km_control;
ALTER TABLE tbl_veic_dados RENAME COLUMN vl_h_atual			TO hour_control;
ALTER TABLE tbl_veic_dados RENAME COLUMN id_aguardando_moto TO waiting_driver;
ALTER TABLE tbl_veic_dados RENAME COLUMN ds_placa				TO tag;
ALTER TABLE tbl_veic_dados RENAME COLUMN no_chassis			TO vin_number;
ALTER TABLE tbl_veic_dados RENAME COLUMN id_unid_km			TO unit_measure;
ALTER TABLE tbl_veic_dados RENAME COLUMN no_ano_fab			TO manufacture_year;
ALTER TABLE tbl_veic_dados RENAME COLUMN no_ano_modelo		TO model_year;
ALTER TABLE tbl_veic_dados RENAME COLUMN qt_tanque				TO tank_capacity;
ALTER TABLE tbl_veic_dados RENAME COLUMN qt_tanque_dia		TO fuel_per_day;
ALTER TABLE tbl_veic_dados RENAME COLUMN ds_consumo_comb		TO fuel_consumption;
ALTER TABLE tbl_veic_dados RENAME COLUMN ds_consumo_lubrif	TO lubricant_consumption;
ALTER TABLE tbl_veic_dados RENAME COLUMN no_veic_renavam		TO renavam;
ALTER TABLE tbl_veic_dados RENAME COLUMN id_implemento			TO has_implement;
ALTER TABLE tbl_veic_dados RENAME COLUMN vl_implemento_master	TO implement_value;
ALTER TABLE tbl_veic_dados RENAME COLUMN vl_implemento			TO body_value;
ALTER TABLE tbl_veic_dados RENAME COLUMN id_radio_comunicador	TO have_radio;
ALTER TABLE tbl_veic_dados RENAME COLUMN no_telemetria			TO telemetry_number;
ALTER TABLE tbl_veic_dados RENAME COLUMN dt_telemetria			TO telemetry_install_date;
ALTER TABLE tbl_veic_dados RENAME COLUMN dt_telemetria_desinst	TO telemetry_uninstall_date;
ALTER TABLE tbl_veic_dados RENAME COLUMN ds_comentario			TO `comment`;
ALTER TABLE tbl_veic_dados RENAME COLUMN id_auto_pd				TO auto_created_at;
ALTER TABLE tbl_veic_dados RENAME COLUMN id_aprovado				TO is_approved;
ALTER TABLE tbl_veic_dados RENAME COLUMN id_enviado_aprov		TO sent_for_approval;
ALTER TABLE tbl_veic_dados RENAME COLUMN id_lib_locacao			TO released_for_rental;
ALTER TABLE tbl_veic_dados RENAME COLUMN vl_locacao				TO rental cost;
ALTER TABLE tbl_veic_dados RENAME COLUMN vl_fator_convert		TO conversion_factor;
ALTER TABLE tbl_veic_dados RENAME COLUMN cd_clienteproj			TO client_id;
ALTER TABLE tbl_veic_dados RENAME COLUMN isPD						TO has_daily_control;
ALTER TABLE tbl_veic_dados RENAME COLUMN id_indicadores			TO has_kpi_report;
ALTER TABLE tbl_veic_dados RENAME COLUMN id_h_pd					TO has_h;
ALTER TABLE tbl_veic_dados RENAME COLUMN id_km_pd					TO has_km;
ALTER TABLE tbl_veic_dados RENAME COLUMN id_ativo					TO is_activated;
ALTER TABLE tbl_veic_dados RENAME COLUMN dt_datareg 				TO `created_at`;
ALTER TABLE tbl_veic_dados ADD `updated_at` TIMESTAMP NULL DEFAULT NULL;
ALTER TABLE tbl_veic_dados ADD `deleted_at` TIMESTAMP NULL DEFAULT NULL;
RENAME TABLE tbl_veic_dados TO vehicles;

ALTER TABLE vehicles ADD driver_id INTEGER;


ALTER TABLE tbl_veic_contr RENAME COLUMN cd_veic_contr 		TO id;
ALTER TABLE tbl_veic_contr RENAME COLUMN cd_projeto			TO project_id;
ALTER TABLE tbl_veic_contr RENAME COLUMN cd_veicontr			TO contract_id;
ALTER TABLE tbl_veic_contr RENAME COLUMN cd_veic_dados 		TO vehicle_id;
ALTER TABLE tbl_veic_contr RENAME COLUMN cd_usuar_cad 		TO user_id;
ALTER TABLE tbl_veic_contr RENAME COLUMN vl_veicontr_valor  TO contract_value;
ALTER TABLE tbl_veic_contr RENAME COLUMN vl_mob					TO mobilization_value;
ALTER TABLE tbl_veic_contr RENAME COLUMN vl_desmob				TO demobilization_value;
ALTER TABLE tbl_veic_contr RENAME COLUMN dt_datareg			TO created_at;
ALTER TABLE tbl_veic_contr RENAME COLUMN id_ativo 				TO is_activated;
ALTER TABLE tbl_veic_contr ADD `created_at` TIMESTAMP NULL DEFAULT NULL;
ALTER TABLE tbl_veic_contr ADD `deleted_at` TIMESTAMP NULL DEFAULT NULL;
ALTER TABLE tbl_veic_contr ADD `updated_at` TIMESTAMP NULL DEFAULT NULL;
RENAME TABLE tbl_veic_contr TO equipment_contracts;


ALTER TABLE tbl_veic_combust RENAME COLUMN cd_veic_combust TO id;
ALTER TABLE tbl_veic_combust RENAME COLUMN ds_veic_combust TO `name`;
RENAME TABLE tbl_veic_combust TO fuels;

ALTER TABLE tbl_supervisor RENAME COLUMN cd_supervisor TO id;
ALTER TABLE tbl_supervisor RENAME COLUMN ds_supervisor TO `name`;
ALTER TABLE tbl_supervisor RENAME COLUMN id_ativo TO is_activated;
ALTER TABLE tbl_supervisor ADD `created_at` TIMESTAMP NULL DEFAULT NULL;
ALTER TABLE tbl_supervisor ADD `deleted_at` TIMESTAMP NULL DEFAULT NULL;
ALTER TABLE tbl_supervisor ADD `updated_at` TIMESTAMP NULL DEFAULT NULL;
RENAME TABLE tbl_supervisor TO supervisors;

ALTER TABLE tbl_supervisor_projeto  RENAME COLUMN cd_supervisor_projeto TO id;
ALTER TABLE tbl_supervisor_projeto  RENAME COLUMN cd_projeto TO project_id;
ALTER TABLE tbl_supervisor_projeto  RENAME COLUMN cd_supervisor TO supervisor_id;
ALTER TABLE tbl_supervisor_projeto  RENAME COLUMN id_ativo TO is_activated;
RENAME TABLE tbl_supervisor_projeto TO project_supervisors;

ALTER TABLE tbl_clienteproj RENAME COLUMN cd_clienteproj TO id;
ALTER TABLE tbl_clienteproj RENAME COLUMN ds_clienteproj TO name;
ALTER TABLE tbl_clienteproj RENAME COLUMN id_ativo TO is_activated;
ALTER TABLE tbl_clienteproj ADD `created_at` TIMESTAMP NULL DEFAULT NULL;
ALTER TABLE tbl_clienteproj ADD `deleted_at` TIMESTAMP NULL DEFAULT NULL;
ALTER TABLE tbl_clienteproj ADD `updated_at` TIMESTAMP NULL DEFAULT NULL;
RENAME TABLE tbl_clienteproj TO clients;

ALTER TABLE tbl_clienteproj_projeto RENAME COLUMN cd_clienteproj_projeto TO id;
ALTER TABLE tbl_clienteproj_projeto RENAME COLUMN cd_clienteproj TO client_id;
ALTER TABLE tbl_clienteproj_projeto RENAME COLUMN cd_projeto TO project_id;
ALTER TABLE tbl_clienteproj_projeto RENAME COLUMN id_ativo TO is_activated;
ALTER TABLE tbl_clienteproj_projeto ADD `created_at` TIMESTAMP NULL DEFAULT NULL;
ALTER TABLE tbl_clienteproj_projeto ADD `deleted_at` TIMESTAMP NULL DEFAULT NULL;
ALTER TABLE tbl_clienteproj_projeto ADD `updated_at` TIMESTAMP NULL DEFAULT NULL;
RENAME TABLE tbl_clienteproj_projeto TO project_clients;

ALTER TABLE tbl_tipodoc RENAME COLUMN cd_tipodoc TO id;
ALTER TABLE tbl_tipodoc RENAME COLUMN ds_tipodoc TO `name`;
ALTER TABLE tbl_tipodoc RENAME COLUMN ds_tipodoc_sigla TO `code`;
ALTER TABLE tbl_tipodoc RENAME COLUMN id_ativo TO is_activated;
ALTER TABLE tbl_tipodoc ADD `created_at` TIMESTAMP NULL DEFAULT NULL;
ALTER TABLE tbl_tipodoc ADD `updated_at` TIMESTAMP NULL DEFAULT NULL;
ALTER TABLE tbl_tipodoc ADD `deleted_at` TIMESTAMP NULL DEFAULT NULL;
RENAME TABLE tbl_tipodoc TO type_documents;
update type_documents set created_at = '2024-02-22 15:28:50' where id > 0;

ALTER TABLE tbl_veic_status RENAME COLUMN cd_veic_status TO id;
ALTER TABLE tbl_veic_status RENAME COLUMN ds_veic_status TO `name`;
ALTER TABLE tbl_veic_status RENAME COLUMN id_ativo TO is_activated;
RENAME TABLE tbl_veic_status TO statuses;

ALTER TABLE tbl_contaativ RENAME COLUMN cd_contaativ TO id;
ALTER TABLE tbl_contaativ RENAME COLUMN ds_contaativ_codigo TO `code`;
ALTER TABLE tbl_contaativ RENAME COLUMN ds_contaativ TO `name`;
ALTER TABLE tbl_contaativ RENAME COLUMN id_ativo TO is_activated;
alter table tbl_contaativ RENAME COLUMN id_ativo TO is_activated;
alter table tbl_contaativ add `created_at` TIMESTAMP NULL DEFAULT NULL;
alter table tbl_contaativ add `updated_at` TIMESTAMP NULL DEFAULT NULL;
alter table tbl_contaativ add `deleted_at` TIMESTAMP NULL DEFAULT NULL;
RENAME TABLE tbl_contaativ TO field_activities;

alter table tbl_contaativ_projeto RENAME COLUMN cd_contaativ_projeto TO id;
alter table tbl_contaativ_projeto RENAME COLUMN id_ativo TO is_activated;
alter table tbl_contaativ_projeto RENAME COLUMN cd_contaativ TO field_activity_id;
alter table tbl_contaativ_projeto RENAME COLUMN cd_projeto TO project_id;
RENAME TABLE tbl_contaativ_projeto TO project_activities;

/*
alter table tbl_prefixo_atividade
alter table tbl_prefixo_atividade
alter table tbl_prefixo_atividade
*/

CREATE TABLE allowed_actions (
	`id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
	`user_id` BIGINT(20) UNSIGNED NOT NULL,
	`read` INT(11) UNSIGNED NOT NULL DEFAULT 1,
	`store` INT(11) UNSIGNED NOT NULL DEFAULT 1,
	`edit` INT(11) UNSIGNED NOT NULL DEFAULT 1,
	`delete` INT(11) UNSIGNED NOT NULL DEFAULT 1,
	`export` INT(11) UNSIGNED NOT NULL DEFAULT 1,
	PRIMARY KEY (`id`)
);

alter table allowed_actions
ADD CONSTRAINT user_id_fk1x
FOREIGN KEY(user_id)
REFERENCES users (id)
;

alter table users add access_level INT(11) NULL DEFAULT 2;

CREATE TABLE `countries` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(50) NULL DEFAULT NULL,
	`locale` VARCHAR(10) NULL DEFAULT NULL,
	`code` VARCHAR(5) NULL DEFAULT NULL,
	`language` VARCHAR(20) NULL DEFAULT NULL,
	PRIMARY KEY (`id`)
)
;

alter table system_modules add country_id int(11) null default null;

alter table system_modules
ADD CONSTRAINT country_id_fk1
FOREIGN KEY(country_id)
REFERENCES countries (id)
;

alter table menus add country_id int(11) null default null;

alter table menus
ADD CONSTRAINT country_id_fk2
FOREIGN KEY(country_id)
REFERENCES countries (id)
;

CREATE TABLE `actions` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(50) NULL DEFAULT NULL,
	PRIMARY KEY (`id`)
)
;

CREATE TABLE `page_actions` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`menu_id` INT(11) NOT NULL,
	`action_id` INT(11) NOT NULL,
	`is_activated` INT(11) NOT NULL DEFAULT 1,
	PRIMARY KEY (`id`),
	CONSTRAINT `action_id_fk2x` FOREIGN KEY (`action_id`) REFERENCES `actions` (`id`),
	CONSTRAINT `menu_id_fk` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`)
)
;

CREATE TABLE `permissions` (
	`id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
	`user_id` BIGINT(20) UNSIGNED NOT NULL,
	`page_action_id` INT(11) NOT NULL,
	`is_activated` INT(11) NOT NULL DEFAULT 1,
	PRIMARY KEY (`id`),
	CONSTRAINT `user_id_fk10x` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
	CONSTRAINT `page_action_id_fk` FOREIGN KEY (`page_action_id`) REFERENCES `page_actions` (`id`)
)
;

CREATE TABLE system_settings (
	id 							INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
	company_id 					INT(11) NULL DEFAULT NULL,
	has_km 						INT(11) UNSIGNED NULL DEFAULT 1,
	has_h 						INT(11) UNSIGNED NULL DEFAULT 1,
	has_arrival_kilometer 	INT(11) UNSIGNED NULL DEFAULT 1, 
	has_driver 					INT(11) UNSIGNED NULL DEFAULT 1, 
	has_project_client 		INT(11) UNSIGNED NULL DEFAULT 1, 
	has_field_activity 		INT(11) UNSIGNED NULL DEFAULT 1,
	has_radio					INT(11) UNSIGNED NULL DEFAULT 1,
	requires_approval 		INT(11) UNSIGNED NULL DEFAULT 1,
	requires_attachments 	INT(11) UNSIGNED NULL DEFAULT 1,
	is_activated 				INT(10) UNSIGNED NULL DEFAULT 1,
	created_at 					TIMESTAMP NULL DEFAULT NULL,
	updated_at 					TIMESTAMP NULL DEFAULT NULL,
	deleted_at 					TIMESTAMP NULL DEFAULT NULL,
	PRIMARY KEY (id)
);

alter table system_settings
ADD CONSTRAINT company_id_fk1
FOREIGN KEY(company_id)
REFERENCES companies (id)
;

-- EXECUTAR APÓS MIGRATION
/*
alter table users add 	access_level INT(11) NULL DEFAULT '2';

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `remember_token`, `created_at`, `updated_at`, `access_level`) VALUES
(1, 'Marcelo de Jesus Usbert', 'usbert@gmail.com', NULL, '$2y$10$7HFcOoW6msQLKpeKPx/1NOA.kmp6mzI4gKuJMZy.Fif0u/7FSM8.G', NULL, NULL, NULL, NULL, '2024-01-05 19:10:33', '2024-01-05 19:10:33', 1),
(3, 'Manuela Monteiro Usbert', 'manu@gmail.com', NULL, '$2y$10$7HFcOoW6msQLKpeKPx/1NOA.kmp6mzI4gKuJMZy.Fif0u/7FSM8.G', NULL, NULL, NULL, NULL, '2024-01-05 19:10:33', '2024-01-05 19:10:33', 2);
*/

SET FOREIGN_KEY_CHECKS=1;
