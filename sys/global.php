<?
	header('Content-Type:text/html; charset=UTF-8');
	
	/*mysql connect*/
	$db_info=array(
		"server"=>"mysql.hostinger.com.ua",
		"login"=>"u546139275_data",
		"pass"=>"z52565854Z",
		"db"=>"u546139275_data",
	);
	if($_SERVER[COMPUTERNAME]=="SAMBER"){
		$db_info=array(
			"server"=>"127.0.0.1",
			"login"=>"root",
			"pass"=>"z52565854Z",
			"db"=>"students_room",
		);
	}
	
	
	$db=mysql_connect($db_info[server],$db_info[login],$db_info[pass]);
	if(!$db)exit('db connect error');
	
	mysql_select_db($db_info[db],$db);
	if(mysql_error())exit('select db error');
	
	mysql_set_charset('utf8',$db);
	
	define('DB',$db);
	unset($db_info,$db);
	/*mysql connect end*/
?>