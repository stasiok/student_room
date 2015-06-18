<?
	header('Content-Type:text/html; charset=UTF-8');
	
	$db=mysql_connect('127.0.0.1','root','');
	if(!$db)exit('db connect error');
	
	mysql_select_db('students_room',$db);
	if(mysql_error())exit('select db error');
	
	define('DB',$db);
?>