<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2021-06-19 10:35:20 --> Severity: error --> Exception: syntax error, unexpected '}' C:\xampp\htdocs\counter_pulsa_admin\application\modules\transaction\models\TransactionModel.php 112
ERROR - 2021-06-19 11:01:49 --> Severity: Notice --> Undefined variable: data C:\xampp\htdocs\counter_pulsa_admin\application\modules\transaction\controllers\Transaction.php 130
ERROR - 2021-06-19 11:22:05 --> Severity: error --> Exception: syntax error, unexpected 'downloadExcel' (T_STRING), expecting function (T_FUNCTION) or const (T_CONST) C:\xampp\htdocs\counter_pulsa_admin\application\modules\transaction\models\TransactionModel.php 68
ERROR - 2021-06-19 11:28:22 --> Severity: Notice --> Undefined variable: siswa C:\xampp\htdocs\counter_pulsa_admin\application\modules\transaction\controllers\Transaction.php 166
ERROR - 2021-06-19 11:28:22 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\counter_pulsa_admin\application\modules\transaction\controllers\Transaction.php 166
ERROR - 2021-06-19 11:42:47 --> Severity: Notice --> Undefined variable: status C:\xampp\htdocs\counter_pulsa_admin\application\modules\transaction\models\TransactionModel.php 34
ERROR - 2021-06-19 11:43:23 --> Query error: Unknown column 'name' in 'where clause' - Invalid query: SELECT *,
	    		(select count(id) from transaction_detail where transaction_code=tr.transaction_code) as total_barang
				FROM transaction tr
				 where CAST(tr.created_on as date) BETWEEN '2021-06-19' and '2021-06-19'   and ( name like '%TRX-20210619114236%' ) 
			
ERROR - 2021-06-19 11:44:00 --> Severity: Notice --> Undefined variable: status C:\xampp\htdocs\counter_pulsa_admin\application\modules\transaction\models\TransactionModel.php 90
ERROR - 2021-06-19 13:20:29 --> Query error: Unknown column 'name' in 'order clause' - Invalid query: select * from user   where id is not null  order by name asc
ERROR - 2021-06-19 17:56:27 --> Severity: error --> Exception: syntax error, unexpected 'empty' (T_EMPTY) C:\xampp\htdocs\counter_pulsa\counter_pulsa_admin\application\modules\user\controllers\User.php 44
ERROR - 2021-06-19 19:11:01 --> Query error: Unknown column 'phoneNumber' in 'field list' - Invalid query: INSERT INTO `user` (`name`, `address`, `password`, `username`, `phoneNumber`, `created_by`, `id_group`) VALUES ('admin', 'jakarta', '21232f297a57a5a743894a0e4a801fc3', 'admin', '08999999', 'admin', '1')
ERROR - 2021-06-19 20:10:14 --> Severity: Notice --> Undefined variable: username C:\xampp\htdocs\counter_pulsa\counter_pulsa_admin\application\modules\user\controllers\User.php 107
ERROR - 2021-06-19 20:20:14 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near ')  order by name asc' at line 7 - Invalid query: select * from user   where id is not null  and ( 
							name like '%ss%' or
							username like '%ss%' or
							no_hp like '%ss%' or
							address like '%ss%' or

				)  order by name asc
ERROR - 2021-06-19 20:42:16 --> 404 Page Not Found: ../modules/login/controllers/Login/index
ERROR - 2021-06-19 20:43:55 --> Severity: Notice --> Undefined variable: title C:\xampp\htdocs\counter_pulsa\counter_pulsa_admin\application\modules\login\views\index.php 4
ERROR - 2021-06-19 20:44:30 --> Severity: Notice --> Undefined variable: title C:\xampp\htdocs\counter_pulsa\counter_pulsa_admin\application\modules\login\views\index.php 4
ERROR - 2021-06-19 20:44:45 --> Severity: Notice --> Undefined variable: title C:\xampp\htdocs\counter_pulsa\counter_pulsa_admin\application\modules\login\views\index.php 4
ERROR - 2021-06-19 20:45:07 --> Severity: Notice --> Undefined variable: title C:\xampp\htdocs\counter_pulsa\counter_pulsa_admin\application\modules\login\views\index.php 4
ERROR - 2021-06-19 20:45:21 --> Severity: Notice --> Undefined variable: title C:\xampp\htdocs\counter_pulsa\counter_pulsa_admin\application\modules\login\views\index.php 4
ERROR - 2021-06-19 20:45:37 --> Severity: Notice --> Undefined variable: title C:\xampp\htdocs\counter_pulsa\counter_pulsa_admin\application\modules\login\views\index.php 4
ERROR - 2021-06-19 20:47:53 --> Severity: Notice --> Undefined variable: title C:\xampp\htdocs\counter_pulsa\counter_pulsa_admin\application\modules\login\views\index.php 4
ERROR - 2021-06-19 22:00:31 --> Severity: error --> Exception: Call to undefined method stdClass::row() C:\xampp\htdocs\counter_pulsa\counter_pulsa_admin\application\modules\login\controllers\Login.php 40
ERROR - 2021-06-19 22:04:39 --> Severity: Notice --> Undefined property: stdClass::$is_group C:\xampp\htdocs\counter_pulsa\counter_pulsa_admin\application\modules\login\controllers\Login.php 51
ERROR - 2021-06-19 22:13:36 --> Severity: error --> Exception: Call to undefined method CI_Session::user_data() C:\xampp\htdocs\counter_pulsa\counter_pulsa_admin\application\helpers\global_helper.php 7
ERROR - 2021-06-19 22:43:23 --> Severity: Notice --> Undefined variable: data C:\xampp\htdocs\counter_pulsa\counter_pulsa_admin\application\modules\login\controllers\Login.php 65
ERROR - 2021-06-19 22:43:23 --> Severity: Notice --> Undefined variable: title C:\xampp\htdocs\counter_pulsa\counter_pulsa_admin\application\modules\login\views\index.php 4
ERROR - 2021-06-19 22:43:51 --> Severity: Notice --> Undefined variable: title C:\xampp\htdocs\counter_pulsa\counter_pulsa_admin\application\modules\login\views\index.php 4
ERROR - 2021-06-19 22:44:27 --> Severity: Notice --> Undefined variable: title C:\xampp\htdocs\counter_pulsa\counter_pulsa_admin\application\modules\login\views\index.php 4
