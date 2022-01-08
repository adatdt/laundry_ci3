<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2021-06-11 09:24:07 --> 404 Page Not Found: ../modules/transaction/controllers/Transaction/getData
ERROR - 2021-06-11 09:27:27 --> 404 Page Not Found: ../modules/transaction/controllers/Transaction/getData
ERROR - 2021-06-11 09:31:01 --> Severity: Notice --> Undefined variable: getdata C:\xampp\htdocs\counter_pulsa\application\modules\Transaction\models\TransactionModel.php 26
ERROR - 2021-06-11 09:31:01 --> Severity: Notice --> Undefined variable: getdata C:\xampp\htdocs\counter_pulsa\application\modules\Transaction\models\TransactionModel.php 29
ERROR - 2021-06-11 09:46:49 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'where email='' and transaction_code=''' at line 4 - Invalid query: 

				SELECT tr.* from transaction tr
				left join transaction_detail trd on tr.transaction_code=trd.trsansaction_code
				left join product p on trd.id_product=p.id
				--where email='' and transaction_code=''
		
ERROR - 2021-06-11 09:47:23 --> Query error: Unknown column 'trd.trsansaction_code' in 'on clause' - Invalid query: 

				SELECT tr.* from transaction tr
				left join transaction_detail trd on tr.transaction_code=trd.trsansaction_code
				left join product p on trd.id_product=p.id
		
ERROR - 2021-06-11 09:48:01 --> Severity: Notice --> Undefined variable: getdata C:\xampp\htdocs\counter_pulsa\application\modules\Transaction\models\TransactionModel.php 38
ERROR - 2021-06-11 09:54:48 --> Query error: Column 'transaction_code' in where clause is ambiguous - Invalid query: 

				SELECT tr.* from transaction tr
				left join transaction_detail trd on tr.transaction_code=trd.transaction_code
				left join product p on trd.id_product=p.id
				where email='' and transaction_code=''
		
ERROR - 2021-06-11 09:55:16 --> Query error: Unknown column 'tr.ransaction_code' in 'where clause' - Invalid query: 

				SELECT tr.* from transaction tr
				left join transaction_detail trd on tr.transaction_code=trd.transaction_code
				left join product p on trd.id_product=p.id
				where email='' and tr.ransaction_code=''
		
ERROR - 2021-06-11 15:57:13 --> 404 Page Not Found: ../modules/transaction/controllers/Transaction/actionUpload
ERROR - 2021-06-11 16:06:16 --> 404 Page Not Found: ../modules/transaction/controllers/Transaction/actionUpload
ERROR - 2021-06-11 16:37:02 --> Severity: error --> Exception: syntax error, unexpected '=', expecting ')' C:\xampp\htdocs\counter_pulsa\application\modules\Transaction\controllers\Transaction.php 47
