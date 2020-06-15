<?php
		include ('db.inc');
		include_once('error.inc');
		// 1. Tao ket noi CSDL
		if (!($connection = mysqli_connect($hostName,$username,$password,$databaseName)))
			die ("couldn't connect to localhost");
		if (!(mysqli_select_db($connection,$databaseName)))
			showError();
		//2. Thiet lap font Unicode
		if (!(mysqli_set_charset($connection,"utf8")))
			showError();
			else echo "set tieng viet";
		
?>