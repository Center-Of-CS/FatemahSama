<?php
	define("IS_ENV_PRODUCTION",false);
	if(!IS_ENV_PRODUCTION){
		error_reporting(E_ALL & ~E_DEPRECATED & ~E_STRICT);
	}
	ini_set("display_errors",!IS_ENV_PRODUCTION);
	ini_set("error_log","../log/log.txt");
	date_default_timezone_set("Asia/Kabul");
	define("DB_HOST","localhost");
	define("DB_USER","root");
	define("DB_PASSWORD","");
	define("DB_SCHEMA","php project");
	$GLOBALS['DB'] = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_SCHEMA);
	if(!$GLOBALS['DB']){
		echo "Debagging Error Code: ".mysqli_connect_errno();
		echo "<br>Error Message: ".mysqli_connect_error();
		exit("<br>Can not Connect To Database");
	}
?>