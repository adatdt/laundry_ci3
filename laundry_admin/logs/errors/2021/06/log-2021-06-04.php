<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2021-06-04 00:18:34 --> Severity: error --> Exception: syntax error, unexpected '{' C:\xampp\htdocs\skill_tes\application\modules\order\controllers\Order.php 35
ERROR - 2021-06-04 00:19:34 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near '20210603205219
WHERE `order_product_detail` IS NULL' at line 1 - Invalid query: DELETE FROM 20210603205219
WHERE `order_product_detail` IS NULL
ERROR - 2021-06-04 00:20:42 --> Severity: Notice --> Undefined variable: id_product C:\xampp\htdocs\skill_tes\application\modules\order\controllers\Order.php 43
ERROR - 2021-06-04 00:20:42 --> Query error: Column 'id_product' cannot be null - Invalid query: INSERT INTO `order_product_detail` (`order_code`, `id_product`, `price`) VALUES ('20210603205219', NULL, '50000')
ERROR - 2021-06-04 00:32:32 --> Severity: Notice --> Undefined property: Order::$product C:\xampp\htdocs\skill_tes\application\modules\order\controllers\Order.php 58
ERROR - 2021-06-04 00:32:32 --> Severity: error --> Exception: Call to a member function select_data() on null C:\xampp\htdocs\skill_tes\application\modules\order\controllers\Order.php 58
ERROR - 2021-06-04 00:53:01 --> Query error: Unknown column 'status' in 'where clause' - Invalid query: select * from order_product  where order_code='20210603205219' and status=0 
ERROR - 2021-06-04 00:53:02 --> Query error: Unknown column 'status' in 'where clause' - Invalid query: select * from order_product  where order_code='20210603205219' and status=0 
ERROR - 2021-06-04 00:53:12 --> Query error: Unknown column 'status' in 'where clause' - Invalid query: select * from order_product  where order_code='20210603205219' and status=0 
ERROR - 2021-06-04 07:14:02 --> Severity: Warning --> mysqli::real_connect(): (HY000/2002): No connection could be made because the target machine actively refused it.
 C:\xampp\htdocs\skill_tes\system\database\drivers\mysqli\mysqli_driver.php 201
ERROR - 2021-06-04 07:14:02 --> Unable to connect to the database
ERROR - 2021-06-04 07:32:19 --> 404 Page Not Found: /index
ERROR - 2021-06-04 09:28:58 --> Severity: Notice --> Undefined variable: countChart C:\xampp\htdocs\skill_tes\application\modules\order\controllers\Order.php 126
ERROR - 2021-06-04 10:02:32 --> Severity: error --> Exception: syntax error, unexpected '$getdata' (T_VARIABLE) C:\xampp\htdocs\skill_tes\application\modules\payment\models\PaymentModel.php 38
ERROR - 2021-06-04 13:36:26 --> Severity: error --> Exception: syntax error, unexpected '"created_on"' (T_CONSTANT_ENCAPSED_STRING), expecting ')' C:\xampp\htdocs\skill_tes\application\modules\order\controllers\Order.php 107
ERROR - 2021-06-04 13:36:44 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near '' at line 1 - Invalid query: select * from kurir  where id= 
ERROR - 2021-06-04 14:09:57 --> Query error: Column 'kurir_fare' cannot be null - Invalid query: INSERT INTO `checkout` (`order_code`, `kurir_id`, `total_amount`, `kurir_fare`, `created_on`) VALUES ('20210604093311', '1', '60000', NULL, '2021-06-04 14:09:57')
ERROR - 2021-06-04 14:11:29 --> Query error: Column 'kurir_fare' cannot be null - Invalid query: INSERT INTO `checkout` (`order_code`, `kurir_id`, `total_amount`, `kurir_fare`, `created_on`) VALUES ('20210604093311', '3', '60000', NULL, '2021-06-04 14:11:29')
ERROR - 2021-06-04 14:12:34 --> Query error: Column 'kurir_fare' cannot be null - Invalid query: INSERT INTO `checkout` (`order_code`, `kurir_id`, `total_amount`, `kurir_fare`, `created_on`) VALUES ('20210604093311', '2', '60000', NULL, '2021-06-04 14:12:34')
ERROR - 2021-06-04 14:27:54 --> Severity: error --> Exception: Call to undefined function arary() C:\xampp\htdocs\skill_tes\application\modules\payment\models\PaymentModel.php 43
ERROR - 2021-06-04 14:28:58 --> Severity: Notice --> Undefined property: stdClass::$status C:\xampp\htdocs\skill_tes\application\modules\payment\models\PaymentModel.php 46
ERROR - 2021-06-04 14:46:24 --> Severity: error --> Exception: syntax error, unexpected '=', expecting ')' C:\xampp\htdocs\skill_tes\application\modules\payment\models\PaymentModel.php 64
ERROR - 2021-06-04 14:46:40 --> Severity: error --> Exception: syntax error, unexpected '=', expecting ')' C:\xampp\htdocs\skill_tes\application\modules\payment\models\PaymentModel.php 64
ERROR - 2021-06-04 21:30:15 --> Severity: Notice --> Undefined index: imageFile C:\xampp\htdocs\skill_tes\application\modules\payment\controllers\Payment.php 44
ERROR - 2021-06-04 21:32:24 --> Severity: Notice --> Undefined index: imageFile C:\xampp\htdocs\skill_tes\application\modules\payment\controllers\Payment.php 44
ERROR - 2021-06-04 21:35:03 --> Severity: Notice --> Undefined index: imageFile C:\xampp\htdocs\skill_tes\application\modules\payment\controllers\Payment.php 44
ERROR - 2021-06-04 21:56:37 --> Severity: error --> Exception: syntax error, unexpected '=', expecting ')' C:\xampp\htdocs\skill_tes\application\modules\payment\controllers\Payment.php 89
ERROR - 2021-06-04 22:18:59 --> Severity: Notice --> Undefined index: input_gambar C:\xampp\htdocs\skill_tes\application\modules\payment\controllers\Payment.php 51
ERROR - 2021-06-04 22:18:59 --> Severity: Notice --> Undefined variable: name C:\xampp\htdocs\skill_tes\application\modules\payment\controllers\Payment.php 53
ERROR - 2021-06-04 22:19:02 --> Severity: Notice --> Undefined index: input_gambar C:\xampp\htdocs\skill_tes\application\modules\payment\controllers\Payment.php 51
ERROR - 2021-06-04 22:19:02 --> Severity: Notice --> Undefined variable: name C:\xampp\htdocs\skill_tes\application\modules\payment\controllers\Payment.php 53
ERROR - 2021-06-04 22:19:05 --> Severity: Notice --> Undefined index: input_gambar C:\xampp\htdocs\skill_tes\application\modules\payment\controllers\Payment.php 51
ERROR - 2021-06-04 22:19:05 --> Severity: Notice --> Undefined variable: name C:\xampp\htdocs\skill_tes\application\modules\payment\controllers\Payment.php 53
ERROR - 2021-06-04 22:19:07 --> Severity: Notice --> Undefined index: input_gambar C:\xampp\htdocs\skill_tes\application\modules\payment\controllers\Payment.php 51
ERROR - 2021-06-04 22:19:07 --> Severity: Notice --> Undefined variable: name C:\xampp\htdocs\skill_tes\application\modules\payment\controllers\Payment.php 53
ERROR - 2021-06-04 22:20:14 --> Severity: Notice --> Undefined variable: name C:\xampp\htdocs\skill_tes\application\modules\payment\controllers\Payment.php 53
ERROR - 2021-06-04 22:38:46 --> Severity: Notice --> Undefined variable: noAccountBankUse C:\xampp\htdocs\skill_tes\application\modules\payment\controllers\Payment.php 94
ERROR - 2021-06-04 23:32:10 --> Severity: error --> Exception: syntax error, unexpected '$dataOrderDetail' (T_VARIABLE) C:\xampp\htdocs\skill_tes\application\modules\payment\models\PaymentModel.php 121
