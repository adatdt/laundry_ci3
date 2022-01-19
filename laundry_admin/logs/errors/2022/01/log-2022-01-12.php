<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2022-01-12 09:53:15 --> Severity: Warning --> Undefined property: stdClass::$trasaction_code C:\xampp_php8\htdocs\laundry_ci3\laundry_admin\application\modules\transaction\models\TransactionModel.php 68
ERROR - 2022-01-12 09:53:15 --> Severity: Warning --> Undefined property: stdClass::$trasaction_code C:\xampp_php8\htdocs\laundry_ci3\laundry_admin\application\modules\transaction\models\TransactionModel.php 68
ERROR - 2022-01-12 09:53:15 --> Severity: Warning --> Undefined property: stdClass::$trasaction_code C:\xampp_php8\htdocs\laundry_ci3\laundry_admin\application\modules\transaction\models\TransactionModel.php 68
ERROR - 2022-01-12 09:53:15 --> Severity: Warning --> Undefined property: stdClass::$trasaction_code C:\xampp_php8\htdocs\laundry_ci3\laundry_admin\application\modules\transaction\models\TransactionModel.php 68
ERROR - 2022-01-12 09:53:15 --> Severity: Warning --> Undefined property: stdClass::$trasaction_code C:\xampp_php8\htdocs\laundry_ci3\laundry_admin\application\modules\transaction\models\TransactionModel.php 68
ERROR - 2022-01-12 10:59:47 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'ilike ='%TRX-20220108102141%'
					or ts.email ilike ='%TRX-20220108102141%'...' at line 24 - Invalid query: 		
			SELECT 
				ts.transaction_code,
				ts.status_payment ,
				ts.status_proces,
				ts.email,
				ts.no_hp,
				ps.name as product_service_name,
				ts.price_product_service ,
				ts.price_service_delivery ,
				ts.price_service_pickup ,
				ts.total_amount ,
				ts.total_weight ,
				ts.address ,
				ts.created_on,
				ts.date_pickup ,
				ts.time_pickup ,
				s.name as layanan_antar,
				s2.name as layanan_jemput
			from transaction_service ts 
			left join service s on ts.id_service_delivery =s.id 
			left join service s2 on ts.id_service_pickup =s2.id 
			left join product_service  ps on ts.id_product_service =ps.id 
			 where  ts.status is not null and CAST(ts.created_on AS DATE)  between '2021-12-13' and '2022-01-12'  and (
					ts.transaction_code ilike ='%TRX-20220108102141%'
					or ts.email ilike ='%TRX-20220108102141%'
					or ts.no_hp ilike ='%TRX-20220108102141%'
					or ts.user_transaction ilike ='%TRX-20220108102141%'
			)  order by ts.id desc 
			
ERROR - 2022-01-12 11:02:47 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'ilike '%ani@gmail.com%'
					or ts.email ilike '%ani@gmail.com%'
					or ts...' at line 24 - Invalid query: 		
			SELECT 
				ts.transaction_code,
				ts.status_payment ,
				ts.status_proces,
				ts.email,
				ts.no_hp,
				ps.name as product_service_name,
				ts.price_product_service ,
				ts.price_service_delivery ,
				ts.price_service_pickup ,
				ts.total_amount ,
				ts.total_weight ,
				ts.address ,
				ts.created_on,
				ts.date_pickup ,
				ts.time_pickup ,
				s.name as layanan_antar,
				s2.name as layanan_jemput
			from transaction_service ts 
			left join service s on ts.id_service_delivery =s.id 
			left join service s2 on ts.id_service_pickup =s2.id 
			left join product_service  ps on ts.id_product_service =ps.id 
			 where  ts.status is not null and CAST(ts.created_on AS DATE)  between '2021-12-13' and '2022-01-12'  and (
					ts.transaction_code ilike '%ani@gmail.com%'
					or ts.email ilike '%ani@gmail.com%'
					or ts.no_hp ilike '%ani@gmail.com%'
					or ts.user_transaction ilike '%ani@gmail.com%'
			)  order by ts.id desc 
			
ERROR - 2022-01-12 11:11:11 --> Severity: error --> Exception: syntax error, unexpected token "public" C:\xampp_php8\htdocs\laundry_ci3\laundry_admin\application\modules\transaction\models\TransactionModel.php 105
ERROR - 2022-01-12 11:12:52 --> Query error: Unknown column 'tr.created_on' in 'where clause' - Invalid query: 		
			SELECT 
				ts.transaction_code,
				ts.status_payment ,
				ts.status_proces,
				ts.email,
				ts.no_hp,
				ps.name as product_service_name,
				ts.price_product_service ,
				ts.price_service_delivery ,
				ts.price_service_pickup ,
				ts.total_amount ,
				ts.total_weight ,
				ts.address ,
				ts.created_on,
				ts.date_pickup ,
				ts.time_pickup ,
				s.name as layanan_antar,
				s2.name as layanan_jemput
			from transaction_service ts 
			left join service s on ts.id_service_delivery =s.id 
			left join service s2 on ts.id_service_pickup =s2.id 
			left join product_service  ps on ts.id_product_service =ps.id 
			 where CAST(tr.created_on as date) BETWEEN '2021-12-13' and '2022-01-12'  
			
ERROR - 2022-01-12 11:36:33 --> Query error: Unknown column 'tr.created_on' in 'where clause' - Invalid query: 		
			SELECT 
				ts.transaction_code,
				ts.status_payment ,
				ts.status_proces,
				ts.email,
				ts.no_hp,
				ps.name as product_service_name,
				ts.price_product_service ,
				ts.price_service_delivery ,
				ts.price_service_pickup ,
				ts.total_amount ,
				ts.total_weight ,
				ts.address ,
				ts.created_on,
				ts.date_pickup ,
				ts.time_pickup ,
				s.name as layanan_antar,
				s2.name as layanan_jemput
			from transaction_service ts 
			left join service s on ts.id_service_delivery =s.id 
			left join service s2 on ts.id_service_pickup =s2.id 
			left join product_service  ps on ts.id_product_service =ps.id 
			 where CAST(tr.created_on as date) BETWEEN '2021-12-13' and '2022-01-12'  
			
ERROR - 2022-01-12 13:21:36 --> Severity: Warning --> Undefined variable $dataJasa C:\xampp_php8\htdocs\laundry_ci3\laundry_admin\application\modules\transaction\views\add.php 20
ERROR - 2022-01-12 13:21:36 --> Severity: Warning --> Undefined variable $dataJasaAntar C:\xampp_php8\htdocs\laundry_ci3\laundry_admin\application\modules\transaction\views\add.php 27
ERROR - 2022-01-12 13:21:36 --> Severity: Warning --> Undefined variable $dataJasaJemput C:\xampp_php8\htdocs\laundry_ci3\laundry_admin\application\modules\transaction\views\add.php 34
ERROR - 2022-01-12 13:22:23 --> Severity: Warning --> Undefined variable $dataJasa C:\xampp_php8\htdocs\laundry_ci3\laundry_admin\application\modules\transaction\views\add.php 20
ERROR - 2022-01-12 13:22:23 --> Severity: Warning --> Undefined variable $dataJasaAntar C:\xampp_php8\htdocs\laundry_ci3\laundry_admin\application\modules\transaction\views\add.php 27
ERROR - 2022-01-12 13:22:23 --> Severity: Warning --> Undefined variable $dataJasaJemput C:\xampp_php8\htdocs\laundry_ci3\laundry_admin\application\modules\transaction\views\add.php 34
ERROR - 2022-01-12 13:41:37 --> 404 Page Not Found: /index
ERROR - 2022-01-12 13:42:35 --> 404 Page Not Found: /index
ERROR - 2022-01-12 14:16:58 --> Query error: Unknown column 'ts.transaction_name' in 'field list' - Invalid query: 		
			SELECT 
				ts.transaction_code,
				ts.status_payment ,
				ts.status_proces,
				ts.email,
				ts.no_hp,
				ps.name as product_service_name,
				ts.price_product_service ,
				ts.price_service_delivery ,
				ts.price_service_pickup ,
				ts.total_amount ,
				ts.total_weight ,
				ts.address ,
				ts.created_on,
				ts.date_pickup ,
				ts.time_pickup ,
				s.name as layanan_antar,
				ts.transaction_name,
				s2.name as layanan_jemput

			from transaction_service ts 
			left join service s on ts.id_service_delivery =s.id 
			left join service s2 on ts.id_service_pickup =s2.id 
			left join product_service  ps on ts.id_product_service =ps.id 
			 where  ts.status is not null and CAST(ts.created_on AS DATE)  between '2021-12-13' and '2022-01-12'  order by ts.id desc 
			
ERROR - 2022-01-12 15:18:27 --> Query error: Unknown column 'link' in 'field list' - Invalid query: INSERT INTO `menu` (`name`, `link`, `ordering`, `status`, `created_on`, `created_by`) VALUES ('Home', 'home', '1', 1, '2022-01-12 15:18:27', 'admin')
ERROR - 2022-01-12 16:41:06 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near '' at line 1 - Invalid query: select * from menu  where upper(name)=upper('Menu1') and status!='-5' and id<> 
ERROR - 2022-01-12 16:42:20 --> Query error: Unknown column 'url' in 'field list' - Invalid query: UPDATE `user_group` SET `name` = 'Menu1', `url` = 'menu1', `ordering` = '71', `updated_on` = '2022-01-12 16:42:20', `updated_by` = 'admin'
WHERE `id` = 11
ERROR - 2022-01-12 16:54:46 --> 404 Page Not Found: /index
ERROR - 2022-01-12 17:13:55 --> Severity: Warning --> Undefined variable $menu_id C:\xampp_php8\htdocs\laundry_ci3\laundry_admin\application\modules\privilege\models\PrivilegeModel.php 66
ERROR - 2022-01-12 17:13:55 --> Severity: Warning --> Undefined variable $menu_id C:\xampp_php8\htdocs\laundry_ci3\laundry_admin\application\modules\privilege\models\PrivilegeModel.php 66
ERROR - 2022-01-12 17:13:55 --> Severity: Warning --> Undefined variable $menu_id C:\xampp_php8\htdocs\laundry_ci3\laundry_admin\application\modules\privilege\models\PrivilegeModel.php 66
ERROR - 2022-01-12 17:13:55 --> Severity: Warning --> Undefined variable $menu_id C:\xampp_php8\htdocs\laundry_ci3\laundry_admin\application\modules\privilege\models\PrivilegeModel.php 66
ERROR - 2022-01-12 17:13:55 --> Severity: Warning --> Undefined variable $menu_id C:\xampp_php8\htdocs\laundry_ci3\laundry_admin\application\modules\privilege\models\PrivilegeModel.php 66
ERROR - 2022-01-12 17:13:55 --> Severity: Warning --> Undefined variable $menu_id C:\xampp_php8\htdocs\laundry_ci3\laundry_admin\application\modules\privilege\models\PrivilegeModel.php 66
ERROR - 2022-01-12 17:13:55 --> Severity: Warning --> Undefined variable $menu_id C:\xampp_php8\htdocs\laundry_ci3\laundry_admin\application\modules\privilege\models\PrivilegeModel.php 66
ERROR - 2022-01-12 17:14:32 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'status=1' at line 1 - Invalid query: select * from privilege  where menu_id=5 status=1
