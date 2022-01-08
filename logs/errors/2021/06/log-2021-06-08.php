<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2021-06-08 11:05:06 --> Severity: Warning --> mysqli::real_connect(): (HY000/1049): Unknown database 'counter' C:\xampp\htdocs\counter_pulsa\system\database\drivers\mysqli\mysqli_driver.php 201
ERROR - 2021-06-08 11:05:06 --> Unable to connect to the database
ERROR - 2021-06-08 11:05:07 --> Severity: Warning --> mysqli::real_connect(): (HY000/1049): Unknown database 'counter' C:\xampp\htdocs\counter_pulsa\system\database\drivers\mysqli\mysqli_driver.php 201
ERROR - 2021-06-08 11:05:07 --> Unable to connect to the database
ERROR - 2021-06-08 11:05:08 --> Severity: Warning --> mysqli::real_connect(): (HY000/1049): Unknown database 'counter' C:\xampp\htdocs\counter_pulsa\system\database\drivers\mysqli\mysqli_driver.php 201
ERROR - 2021-06-08 11:05:08 --> Unable to connect to the database
ERROR - 2021-06-08 11:05:46 --> Query error: Table 'counter_pulsa.order_product' doesn't exist - Invalid query: select * from order_product  where status_payment=0
ERROR - 2021-06-08 11:09:23 --> 404 Page Not Found: ../modules/product/controllers/Product/3
ERROR - 2021-06-08 11:09:27 --> 404 Page Not Found: ../modules/product/controllers/Product/4
ERROR - 2021-06-08 11:10:03 --> 404 Page Not Found: ../modules/product/controllers/Product/3
ERROR - 2021-06-08 11:12:23 --> Severity: Notice --> Array to string conversion C:\xampp\htdocs\counter_pulsa\application\modules\product\models\ProductModel.php 25
ERROR - 2021-06-08 11:13:06 --> Severity: 4096 --> Object of class CI_DB_mysqli_result could not be converted to string C:\xampp\htdocs\counter_pulsa\application\modules\product\models\ProductModel.php 25
ERROR - 2021-06-08 11:21:31 --> 404 Page Not Found: ../modules/product/controllers/Product/2
ERROR - 2021-06-08 11:41:31 --> Query error: Table 'counter_pulsa.checkout' doesn't exist - Invalid query: SELECT
					count(opd.order_code) as total_barang,
					sum(opd.price) as total_harga,
					op.status_payment,
					ck.order_code,					
					ck.created_on
				FROM checkout ck
					join order_product op on ck.order_code=op.order_code
					join order_product_detail opd on ck.order_code=opd.order_code
				group by 
				op.status_payment,
				ck.order_code,
				ck.created_on

				order by ck.created_on desc
			
ERROR - 2021-06-08 11:41:33 --> Query error: Table 'counter_pulsa.kurir' doesn't exist - Invalid query: select * from kurir  order by name asc 
ERROR - 2021-06-08 11:41:35 --> Query error: Table 'counter_pulsa.checkout' doesn't exist - Invalid query: SELECT
					count(opd.order_code) as total_barang,
					sum(opd.price) as total_harga,
					op.status_payment,
					ck.order_code,					
					ck.created_on
				FROM checkout ck
					join order_product op on ck.order_code=op.order_code
					join order_product_detail opd on ck.order_code=opd.order_code
				group by 
				op.status_payment,
				ck.order_code,
				ck.created_on

				order by ck.created_on desc
			
ERROR - 2021-06-08 11:41:46 --> Query error: Table 'counter_pulsa.kurir' doesn't exist - Invalid query: select * from kurir  order by name asc 
ERROR - 2021-06-08 11:41:48 --> Query error: Table 'counter_pulsa.checkout' doesn't exist - Invalid query: SELECT
					count(opd.order_code) as total_barang,
					sum(opd.price) as total_harga,
					op.status_payment,
					ck.order_code,					
					ck.created_on
				FROM checkout ck
					join order_product op on ck.order_code=op.order_code
					join order_product_detail opd on ck.order_code=opd.order_code
				group by 
				op.status_payment,
				ck.order_code,
				ck.created_on

				order by ck.created_on desc
			
ERROR - 2021-06-08 11:48:17 --> Severity: error --> Exception: syntax error, unexpected '=', expecting ')' C:\xampp\htdocs\counter_pulsa\application\modules\product\models\ProductModel.php 38
ERROR - 2021-06-08 12:33:38 --> Query error: Table 'counter_pulsa.kurir' doesn't exist - Invalid query: select * from kurir  order by name asc 
ERROR - 2021-06-08 12:51:24 --> Query error: Table 'counter_pulsa.order_product' doesn't exist - Invalid query: select * from order_product  where status_payment=0
ERROR - 2021-06-08 12:52:08 --> Query error: Table 'counter_pulsa.order_product' doesn't exist - Invalid query: select * from order_product  where status_payment=0
ERROR - 2021-06-08 12:56:07 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'where p.id_category='1' 
				order by p.id desc' at line 7 - Invalid query:  SELECT 
					p.*,
					need_number 
				from 
					product p 
				left join category c on p.id_category=c.id;
					 where p.id_category='1' 
				order by p.id desc  
				
ERROR - 2021-06-08 12:56:08 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'where p.id_category='1' 
				order by p.id desc' at line 7 - Invalid query:  SELECT 
					p.*,
					need_number 
				from 
					product p 
				left join category c on p.id_category=c.id;
					 where p.id_category='1' 
				order by p.id desc  
				
ERROR - 2021-06-08 12:56:27 --> Query error: Table 'counter_pulsa.order_product' doesn't exist - Invalid query: select * from order_product  where status_payment=0
ERROR - 2021-06-08 13:09:33 --> Query error: Unknown column 'category_id' in 'where clause' - Invalid query:  SELECT 
					p.*,
					need_number 
				from 
					product p 
				left join category c on p.id_category=c.id
					 where p.id_category='1' and category_id not in (1,2) 
				order by p.id desc  
				
ERROR - 2021-06-08 13:09:34 --> Query error: Unknown column 'category_id' in 'where clause' - Invalid query:  SELECT 
					p.*,
					need_number 
				from 
					product p 
				left join category c on p.id_category=c.id
					 where p.id_category='1' and category_id not in (1,2) 
				order by p.id desc  
				
ERROR - 2021-06-08 13:09:42 --> Query error: Unknown column 'category_id' in 'where clause' - Invalid query:  SELECT 
					p.*,
					need_number 
				from 
					product p 
				left join category c on p.id_category=c.id
					 where p.id_category='1' and category_id not in (1,2) 
				order by p.id desc  
				
ERROR - 2021-06-08 13:09:45 --> Query error: Unknown column 'category_id' in 'where clause' - Invalid query:  SELECT 
					p.*,
					need_number 
				from 
					product p 
				left join category c on p.id_category=c.id
					 where p.id_category='2' and category_id not in (1,2) 
				order by p.id desc  
				
ERROR - 2021-06-08 13:32:58 --> Query error: Unknown column 'category_id' in 'where clause' - Invalid query:  SELECT 
					p.*,
					need_number 
				from 
					product p 
				left join category c on p.id_category=c.id
					 where p.id_category='2' and category_id not in (1,2) 
				order by p.id desc  
				
ERROR - 2021-06-08 15:10:28 --> Query error: Table 'counter_pulsa.kurir' doesn't exist - Invalid query: select * from kurir  order by name asc 
ERROR - 2021-06-08 15:14:16 --> Severity: error --> Exception: Unable to locate the model you have specified: ProductModel C:\xampp\htdocs\counter_pulsa\system\core\Loader.php 348
ERROR - 2021-06-08 15:14:18 --> Severity: error --> Exception: Unable to locate the model you have specified: ProductModel C:\xampp\htdocs\counter_pulsa\system\core\Loader.php 348
ERROR - 2021-06-08 15:53:37 --> Severity: error --> Exception: Unable to locate the model you have specified: ProductModel C:\xampp\htdocs\counter_pulsa\system\core\Loader.php 348
ERROR - 2021-06-08 16:02:02 --> Severity: error --> Exception: syntax error, unexpected ';', expecting ')' C:\xampp\htdocs\counter_pulsa\application\modules\productPulsa\controllers\ProductPulsa.php 32
ERROR - 2021-06-08 16:02:03 --> Severity: error --> Exception: syntax error, unexpected ';', expecting ')' C:\xampp\htdocs\counter_pulsa\application\modules\productPulsa\controllers\ProductPulsa.php 32
ERROR - 2021-06-08 16:02:18 --> Query error: Unknown column 'status' in 'where clause' - Invalid query: select * from category  where status in (1,2) 
ERROR - 2021-06-08 16:02:20 --> Query error: Unknown column 'status' in 'where clause' - Invalid query: select * from category  where status in (1,2) 
ERROR - 2021-06-08 17:32:33 --> Severity: Notice --> Undefined variable: his C:\xampp\htdocs\counter_pulsa\application\modules\productPulsa\controllers\ProductPulsa.php 103
ERROR - 2021-06-08 17:32:33 --> Severity: Notice --> Trying to get property 'product' of non-object C:\xampp\htdocs\counter_pulsa\application\modules\productPulsa\controllers\ProductPulsa.php 103
ERROR - 2021-06-08 17:32:33 --> Severity: error --> Exception: Call to a member function select_data() on null C:\xampp\htdocs\counter_pulsa\application\modules\productPulsa\controllers\ProductPulsa.php 103
ERROR - 2021-06-08 23:17:48 --> Severity: Notice --> Undefined variable: no_hp C:\xampp\htdocs\counter_pulsa\application\modules\productPulsa\controllers\ProductPulsa.php 51
ERROR - 2021-06-08 23:17:48 --> Query error: Column 'no_hp' cannot be null - Invalid query: INSERT INTO `transaction` (`transaction_code`, `email`, `no_hp`, `status`) VALUES ('TRX-20210608231747', 'adatdt@gmail.com', NULL, 0)
