<?
	include_once('../sys/global.php');
	include_once('sys/api_global.php');
	
	if(empty($_REQUEST[pass]) || empty($_REQUEST[rbn]))exit(error("не указаны обязательные параметры"));
	
	if(!preg_match('/^[0-9]{8}$/',$_REQUEST[rbn]))exit(error("некорректное значение параметра rbn"));
	
	$rbn=$_REQUEST[rbn];
	$pass=md5(md5($_REQUEST[pass]."kasbdgkasgdkasbgd")."asdasdasd");
	
	$res=mysql_query("SELECT student_id,f_name,l_name,m_name FROM students WHERE record_book_number = $rbn AND pass = '$pass' LIMIT 1",DB);
	if(mysql_num_rows($res)){
		$data=mysql_fetch_assoc($res);
		
		$data[auth_hash]=md5(uniqid("",1).time().rand(1,1000000));
		
		mysql_query("INSERT INTO auth_data VALUES (".$data[student_id].",'".$data[auth_hash]."',".time().",INET_ATON('".$_SERVER[REMOTE_ADDR]."'))",DB);
		if(mysql_error())exit(error("auth data saves error"));
		
		exit(json_encode(array("status"=>"ok","data"=>$data)));
	}else{
		exit(error("bad auth data"));
	}
?>