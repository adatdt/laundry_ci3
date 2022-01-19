<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2022-01-13 10:32:33 --> Query error: Unknown column 'groupId' in 'where clause' - Invalid query: select * from privilege  where menu_id=5 and groupId=1 
ERROR - 2022-01-13 10:33:31 --> Severity: Warning --> Undefined variable $groupMenu C:\xampp_php8\htdocs\laundry_ci3\laundry_admin\application\modules\privilege\controllers\Privilege.php 70
ERROR - 2022-01-13 10:33:31 --> Query error: Column 'user_group_id' cannot be null - Invalid query: INSERT INTO `privilege` (`menu_id`, `user_group_id`, `created_on`, `created_by`) VALUES ('5', NULL, '2022-01-13 10:33:31', 'admin')
ERROR - 2022-01-13 10:57:01 --> Severity: Warning --> Undefined variable $getMenu C:\xampp_php8\htdocs\laundry_ci3\laundry_admin\application\views\default.php 163
ERROR - 2022-01-13 10:57:01 --> Severity: error --> Exception: Value of type null is not callable C:\xampp_php8\htdocs\laundry_ci3\laundry_admin\application\views\default.php 163
ERROR - 2022-01-13 10:57:20 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near ' m.url from menu m 
		join privilege p on m.id=p.menu_id
		where 
			p.use...' at line 1 - Invalid query: 
		SELECT m.name, , m.url from menu m 
		join privilege p on m.id=p.menu_id
		where 
			p.user_group_id=1
			and m.status <>'-5'	
			order by m.ordering asc 
	
ERROR - 2022-01-13 10:57:56 --> Severity: error --> Exception: Array callback must have exactly two elements C:\xampp_php8\htdocs\laundry_ci3\laundry_admin\application\helpers\global_helper.php 42
ERROR - 2022-01-13 11:09:24 --> 404 Page Not Found: /index
ERROR - 2022-01-13 11:12:35 --> Query error: Table 'laundry_skripsi.category' doesn't exist - Invalid query: select * from category  order by name asc 
ERROR - 2022-01-13 11:12:49 --> Query error: Table 'laundry_skripsi.category' doesn't exist - Invalid query: select * from category  order by name asc 
ERROR - 2022-01-13 11:12:58 --> Query error: Table 'laundry_skripsi.category' doesn't exist - Invalid query: select * from category  order by name asc 
ERROR - 2022-01-13 11:13:05 --> Query error: Table 'laundry_skripsi.category' doesn't exist - Invalid query: select * from category  order by name asc 
ERROR - 2022-01-13 11:13:47 --> Query error: Table 'laundry_skripsi.category' doesn't exist - Invalid query: select * from category  order by name asc 
ERROR - 2022-01-13 11:14:44 --> Query error: Table 'laundry_skripsi.category' doesn't exist - Invalid query: select * from category  order by name asc 
ERROR - 2022-01-13 11:15:06 --> Severity: Warning --> Undefined variable $dataCategory C:\xampp_php8\htdocs\laundry_ci3\laundry_admin\application\modules\product\controllers\Product.php 18
ERROR - 2022-01-13 11:15:06 --> Severity: Warning --> Undefined variable $dataOperator C:\xampp_php8\htdocs\laundry_ci3\laundry_admin\application\modules\product\controllers\Product.php 19
ERROR - 2022-01-13 11:39:34 --> Query error: FUNCTION laundry_skripsi.max does not exist. Check the 'Function Name Parsing and Resolution' section in the Reference Manual - Invalid query: select max (service_code) as max_code from service where left(service_code,3)='LY-' 
ERROR - 2022-01-13 13:51:45 --> 404 Page Not Found: /index
ERROR - 2022-01-13 14:04:57 --> 404 Page Not Found: /index
ERROR - 2022-01-13 17:15:44 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'where CAST(ts.created_on AS DATE) between '2022-01-13' and '2022-01-13'  
		...' at line 13 - Invalid query: 
		
				select 
					ps.name as product_service_name,
					ts.status_payment,
					CAST(ts.created_on AS DATE) as transaction_date,
					sum(ts.total_amount) as total,
					count(CAST(ts.created_on AS DATE)) as total_transaction
				from transaction_service ts 
				left join product_service ps on ts.id_product_service =ps.id
				group by 
					ps.name,
					ts.status_payment,
					CAST(ts.created_on AS DATE) 
					 where CAST(ts.created_on AS DATE) between '2022-01-13' and '2022-01-13'  
					order by ts.created_on asc 

		
		
ERROR - 2022-01-13 17:45:23 --> 404 Page Not Found: ../modules/laporan/controllers/Laporan/download_pdf
ERROR - 2022-01-13 17:45:31 --> 404 Page Not Found: ../modules/laporan/controllers/Laporan/download_pdf
ERROR - 2022-01-13 17:46:06 --> Severity: Warning --> Undefined variable $dateFrom C:\xampp_php8\htdocs\laundry_ci3\laundry_admin\application\modules\laporan\views\pdf.php 62
ERROR - 2022-01-13 17:46:06 --> Severity: Warning --> Undefined variable $dateTo C:\xampp_php8\htdocs\laundry_ci3\laundry_admin\application\modules\laporan\views\pdf.php 62
ERROR - 2022-01-13 17:46:06 --> Severity: error --> Exception: Class "html2pdf" not found C:\xampp_php8\htdocs\laundry_ci3\laundry_admin\application\modules\laporan\views\pdf.php 100
ERROR - 2022-01-13 17:52:24 --> Severity: Warning --> Undefined variable $dateFrom C:\xampp_php8\htdocs\laundry_ci3\laundry_admin\application\modules\laporan\views\pdf.php 62
ERROR - 2022-01-13 17:52:24 --> Severity: Warning --> Undefined variable $dateTo C:\xampp_php8\htdocs\laundry_ci3\laundry_admin\application\modules\laporan\views\pdf.php 62
ERROR - 2022-01-13 17:52:24 --> Severity: Warning --> require(C:\xampp_php8\htdocs\laundry_ci3\laundry_admin\application\modules\laporan\views/vendor/autoload.php): Failed to open stream: No such file or directory C:\xampp_php8\htdocs\laundry_ci3\laundry_admin\application\modules\laporan\views\pdf.php 100
ERROR - 2022-01-13 17:52:24 --> Severity: error --> Exception: Failed opening required 'C:\xampp_php8\htdocs\laundry_ci3\laundry_admin\application\modules\laporan\views/vendor/autoload.php' (include_path='C:\xampp_php8\php\PEAR') C:\xampp_php8\htdocs\laundry_ci3\laundry_admin\application\modules\laporan\views\pdf.php 100
ERROR - 2022-01-13 17:53:22 --> Severity: Warning --> require(C:\xampp_php8\htdocs\laundry_ci3\laundry_admin\application\modules\laporan\controllers/vendor/autoload.php): Failed to open stream: No such file or directory C:\xampp_php8\htdocs\laundry_ci3\laundry_admin\application\modules\laporan\controllers\Laporan.php 2
ERROR - 2022-01-13 17:53:22 --> Severity: error --> Exception: Failed opening required 'C:\xampp_php8\htdocs\laundry_ci3\laundry_admin\application\modules\laporan\controllers/vendor/autoload.php' (include_path='C:\xampp_php8\php\PEAR') C:\xampp_php8\htdocs\laundry_ci3\laundry_admin\application\modules\laporan\controllers\Laporan.php 2
ERROR - 2022-01-13 17:53:24 --> Severity: Warning --> require(C:\xampp_php8\htdocs\laundry_ci3\laundry_admin\application\modules\laporan\controllers/vendor/autoload.php): Failed to open stream: No such file or directory C:\xampp_php8\htdocs\laundry_ci3\laundry_admin\application\modules\laporan\controllers\Laporan.php 2
ERROR - 2022-01-13 17:53:24 --> Severity: error --> Exception: Failed opening required 'C:\xampp_php8\htdocs\laundry_ci3\laundry_admin\application\modules\laporan\controllers/vendor/autoload.php' (include_path='C:\xampp_php8\php\PEAR') C:\xampp_php8\htdocs\laundry_ci3\laundry_admin\application\modules\laporan\controllers\Laporan.php 2
ERROR - 2022-01-13 17:54:39 --> Severity: Warning --> require_once(C:\xampp_php8\htdocs\laundry_ci3\laundry_admin\application\modules\laporan\controllers/vendor/autoload.php): Failed to open stream: No such file or directory C:\xampp_php8\htdocs\laundry_ci3\laundry_admin\application\modules\laporan\controllers\Laporan.php 2
ERROR - 2022-01-13 17:54:39 --> Severity: error --> Exception: Failed opening required 'C:\xampp_php8\htdocs\laundry_ci3\laundry_admin\application\modules\laporan\controllers/vendor/autoload.php' (include_path='C:\xampp_php8\php\PEAR') C:\xampp_php8\htdocs\laundry_ci3\laundry_admin\application\modules\laporan\controllers\Laporan.php 2
ERROR - 2022-01-13 17:55:11 --> Severity: Warning --> Undefined variable $dateFrom C:\xampp_php8\htdocs\laundry_ci3\laundry_admin\application\modules\laporan\views\pdf.php 62
ERROR - 2022-01-13 17:55:11 --> Severity: Warning --> Undefined variable $dateTo C:\xampp_php8\htdocs\laundry_ci3\laundry_admin\application\modules\laporan\views\pdf.php 62
ERROR - 2022-01-13 17:55:11 --> Severity: error --> Exception: Class "Spipu\Html2Pdf\Html2Pdf" not found C:\xampp_php8\htdocs\laundry_ci3\laundry_admin\application\modules\laporan\views\pdf.php 101
ERROR - 2022-01-13 17:57:36 --> Severity: Warning --> Undefined variable $dateFrom C:\xampp_php8\htdocs\laundry_ci3\laundry_admin\application\modules\laporan\views\pdf.php 62
ERROR - 2022-01-13 17:57:36 --> Severity: Warning --> Undefined variable $dateTo C:\xampp_php8\htdocs\laundry_ci3\laundry_admin\application\modules\laporan\views\pdf.php 62
ERROR - 2022-01-13 17:58:05 --> 404 Page Not Found: ../modules/laporan/controllers/Laporan/download_pdf
ERROR - 2022-01-13 17:58:11 --> Severity: Warning --> Undefined variable $dateFrom C:\xampp_php8\htdocs\laundry_ci3\laundry_admin\application\modules\laporan\views\pdf.php 62
ERROR - 2022-01-13 17:58:11 --> Severity: Warning --> Undefined variable $dateTo C:\xampp_php8\htdocs\laundry_ci3\laundry_admin\application\modules\laporan\views\pdf.php 62
ERROR - 2022-01-13 17:58:50 --> Severity: Warning --> Undefined variable $dateFrom C:\xampp_php8\htdocs\laundry_ci3\laundry_admin\application\modules\laporan\views\pdf.php 62
ERROR - 2022-01-13 17:58:50 --> Severity: Warning --> Undefined variable $dateTo C:\xampp_php8\htdocs\laundry_ci3\laundry_admin\application\modules\laporan\views\pdf.php 62
ERROR - 2022-01-13 17:59:28 --> Severity: Warning --> Undefined variable $dateFrom C:\xampp_php8\htdocs\laundry_ci3\laundry_admin\application\modules\laporan\views\pdf.php 62
ERROR - 2022-01-13 17:59:28 --> Severity: Warning --> Undefined variable $dateTo C:\xampp_php8\htdocs\laundry_ci3\laundry_admin\application\modules\laporan\views\pdf.php 62
ERROR - 2022-01-13 18:00:12 --> Severity: Warning --> Undefined variable $dateFrom C:\xampp_php8\htdocs\laundry_ci3\laundry_admin\application\modules\laporan\views\pdf.php 62
ERROR - 2022-01-13 18:00:12 --> Severity: Warning --> Undefined variable $dateTo C:\xampp_php8\htdocs\laundry_ci3\laundry_admin\application\modules\laporan\views\pdf.php 62
ERROR - 2022-01-13 18:00:12 --> Severity: Warning --> Undefined variable $dateFrom C:\xampp_php8\htdocs\laundry_ci3\laundry_admin\application\modules\laporan\views\pdf.php 62
ERROR - 2022-01-13 18:00:12 --> Severity: Warning --> Undefined variable $dateTo C:\xampp_php8\htdocs\laundry_ci3\laundry_admin\application\modules\laporan\views\pdf.php 62
ERROR - 2022-01-13 18:00:12 --> Severity: Warning --> Undefined variable $dateFrom C:\xampp_php8\htdocs\laundry_ci3\laundry_admin\application\modules\laporan\views\pdf.php 62
ERROR - 2022-01-13 18:00:12 --> Severity: Warning --> Undefined variable $dateTo C:\xampp_php8\htdocs\laundry_ci3\laundry_admin\application\modules\laporan\views\pdf.php 62
