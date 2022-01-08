<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2022-01-08 10:11:31 --> Query error: Unknown column 'trx_code' in 'field list' - Invalid query: INSERT INTO `transaction_service` (`trx_code`, `id_product_service`, `id_service_delivery`, `id_service_pickup`, `no_hp`, `address`, `price_product_service`, `total_amount`, `email`, `price_service_delivery`, `price_service_pickup`, `date_pickup`, `time_pickup`, `status`, `user_transaction`, `created_on`, `created_by`) VALUES ('TRX-20220108101131', '3', '1', '2', '08998198', 'jakarata', '5000', '9000', 'adat.nutech@gmail.com', '2000', '2000', '2022-01-08', '19:00', 1, 'adi', 'admin', '2022-01-08 10:11:31')
ERROR - 2022-01-08 10:13:12 --> Query error: Unknown column 'total_amount' in 'field list' - Invalid query: INSERT INTO `transaction_service` (`transaction_code`, `id_product_service`, `id_service_delivery`, `id_service_pickup`, `no_hp`, `address`, `price_product_service`, `total_amount`, `email`, `price_service_delivery`, `price_service_pickup`, `date_pickup`, `time_pickup`, `status`, `user_transaction`, `created_on`, `created_by`) VALUES ('TRX-20220108101312', '3', '1', '2', '08998198', 'jakarata', '5000', '9000', 'adatdt@gmail.com', '2000', '2000', '2022-01-08', '17:00', 1, 'adi', 'admin', '2022-01-08 10:13:12')
ERROR - 2022-01-08 10:14:24 --> Query error: Unknown column 'user_transaction' in 'field list' - Invalid query: INSERT INTO `transaction_service` (`transaction_code`, `id_product_service`, `id_service_delivery`, `id_service_pickup`, `no_hp`, `address`, `price_product_service`, `total_amount`, `email`, `price_service_delivery`, `price_service_pickup`, `date_pickup`, `time_pickup`, `status`, `user_transaction`, `created_on`, `created_by`) VALUES ('TRX-20220108101424', '3', '1', '2', '08998198', 'jakarata', '5000', '9000', 'adatdt@gmail.com', '2000', '2000', '2022-01-08', '17:00', 1, 'adi', 'admin', '2022-01-08 10:14:24')
ERROR - 2022-01-08 11:26:27 --> Severity: error --> Exception: mysqli::query(): Argument #1 ($query) cannot be empty C:\xampp_php8\htdocs\loundry_c3\system\database\drivers\mysqli\mysqli_driver.php 305
ERROR - 2022-01-08 11:27:41 --> Severity: error --> Exception: mysqli::query(): Argument #1 ($query) cannot be empty C:\xampp_php8\htdocs\loundry_c3\system\database\drivers\mysqli\mysqli_driver.php 305
ERROR - 2022-01-08 11:53:47 --> Severity: Warning --> Undefined variable $title C:\xampp_php8\htdocs\loundry_c3\application\modules\login\views\index.php 4
ERROR - 2022-01-08 11:59:25 --> Severity: Warning --> Undefined variable $title C:\xampp_php8\htdocs\loundry_c3\application\modules\login\views\index.php 4
ERROR - 2022-01-08 19:47:50 --> 404 Page Not Found: ../modules/checkTransaction/controllers/CheckTransaction/index
ERROR - 2022-01-08 19:48:29 --> 404 Page Not Found: ../modules/checkTransaction/controllers/CheckTransaction/index
ERROR - 2022-01-08 19:50:17 --> 404 Page Not Found: ../modules/checkTransaction/controllers/CheckTransaction/index
ERROR - 2022-01-08 19:50:19 --> 404 Page Not Found: ../modules/checkTransaction/controllers/CheckTransaction/index
ERROR - 2022-01-08 19:50:20 --> 404 Page Not Found: ../modules/checkTransaction/controllers/CheckTransaction/index
ERROR - 2022-01-08 20:03:25 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'ts.transaction_code='TRX-20220108103915'' at line 21 - Invalid query: 
			SELECT
				ts.created_on,
				ts.transaction_code,
				ts.created_by,
				ts.total_weight ,
				ts.price_service_delivery ,
				ts.price_service_pickup ,
				ts.price_product_service ,
				ts.total_amount ,
				ps.name as layanan_prodak,
				s.name as service_pengiriman,
				(
					select status_proces from transaction_service_detail
					where status=1 order by id desc limit 1
				) as status_process,				
				s2.name as service_pengambilan
			from transaction_service ts 
			join product_service ps on ts.id_product_service =ps.id 
			join service s on ts.id_service_delivery =s.id 
			join service s2 on ts.id_service_pickup =s2.id		
			ts.transaction_code='TRX-20220108103915'
		
