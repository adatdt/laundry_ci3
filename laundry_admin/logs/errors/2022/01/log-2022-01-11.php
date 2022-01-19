<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2022-01-11 10:16:32 --> Severity: error --> Exception: syntax error, unexpected identifier "formatUang" C:\xampp_php8\htdocs\laundry_ci3\laundry_admin\application\modules\transaction\models\TransactionModel.php 53
ERROR - 2022-01-11 10:53:06 --> Query error: Unknown column 'tr.created_on' in 'where clause' - Invalid query: 		
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
			 where CAST(tr.created_on as date) BETWEEN '2022-01-11' and '2022-01-11'  
			
ERROR - 2022-01-11 10:53:46 --> Query error: Column 'status' in where clause is ambiguous - Invalid query: 		
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
			 where  status is not null 
			
ERROR - 2022-01-11 13:04:06 --> Query error: Unknown column 'tr.created_on' in 'where clause' - Invalid query: 		
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
			 where CAST(tr.created_on as date) BETWEEN '2022-01-11' and '2022-01-11'  
			
ERROR - 2022-01-11 14:10:34 --> Severity: Warning --> Undefined variable $totalAmount C:\xampp_php8\htdocs\laundry_ci3\laundry_admin\application\modules\transaction\controllers\Transaction.php 95
ERROR - 2022-01-11 15:15:17 --> Query error: Unknown column 'status_poces' in 'field list' - Invalid query: UPDATE `transaction_service` SET `status_poces` = '1', `total_weight` = '0', `total_amount` = '7000', `updated_on` = '2022-01-11 15:15:17', `updated_by` = 'admin'
WHERE `transaction_code` = 'TRX-20220108103915'
ERROR - 2022-01-11 16:29:20 --> Severity: error --> Exception: Object of class stdClass could not be converted to string C:\xampp_php8\htdocs\laundry_ci3\laundry_admin\application\modules\transaction\models\TransactionModel.php 45
ERROR - 2022-01-11 16:30:49 --> Severity: error --> Exception: Object of class stdClass could not be converted to string C:\xampp_php8\htdocs\laundry_ci3\laundry_admin\application\modules\transaction\models\TransactionModel.php 45
ERROR - 2022-01-11 16:42:03 --> Severity: Warning --> Undefined variable $value C:\xampp_php8\htdocs\laundry_ci3\laundry_admin\application\modules\transaction\models\TransactionModel.php 115
ERROR - 2022-01-11 16:42:03 --> Severity: Warning --> Attempt to read property "transaction_code" on null C:\xampp_php8\htdocs\laundry_ci3\laundry_admin\application\modules\transaction\models\TransactionModel.php 115
ERROR - 2022-01-11 16:42:03 --> Severity: Warning --> Undefined variable $value C:\xampp_php8\htdocs\laundry_ci3\laundry_admin\application\modules\transaction\models\TransactionModel.php 115
ERROR - 2022-01-11 16:42:03 --> Severity: Warning --> Attempt to read property "total_amount" on null C:\xampp_php8\htdocs\laundry_ci3\laundry_admin\application\modules\transaction\models\TransactionModel.php 115
ERROR - 2022-01-11 16:42:03 --> Severity: error --> Exception: Attempt to assign property "total_amount2" on null C:\xampp_php8\htdocs\laundry_ci3\laundry_admin\application\modules\transaction\models\TransactionModel.php 115
ERROR - 2022-01-11 16:54:45 --> Severity: Warning --> Undefined variable $value C:\xampp_php8\htdocs\laundry_ci3\laundry_admin\application\modules\transaction\models\TransactionModel.php 110
ERROR - 2022-01-11 16:54:45 --> Severity: Warning --> Attempt to read property "transaction_code" on null C:\xampp_php8\htdocs\laundry_ci3\laundry_admin\application\modules\transaction\models\TransactionModel.php 110
ERROR - 2022-01-11 16:54:57 --> Severity: Warning --> Undefined variable $value C:\xampp_php8\htdocs\laundry_ci3\laundry_admin\application\modules\transaction\models\TransactionModel.php 110
ERROR - 2022-01-11 16:54:57 --> Severity: Warning --> Attempt to read property "transaction_code" on null C:\xampp_php8\htdocs\laundry_ci3\laundry_admin\application\modules\transaction\models\TransactionModel.php 110
