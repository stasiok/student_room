<?
	include_once('../sys/global.php');
	include_once('sys/api_global.php');
	
	if(!hash_to_id($_REQUEST[auth_hash]))exit(json_encode(array("status"=>"error","error"=>"403 Forbidden")));
	
	$res=mysql_query("SELECT * FROM groups ORDER BY title ASC");
	$data=array();
	
	
	
	while($row=mysql_fetch_assoc($res)){
		$data[$row[group_id]]=array(
			"title"=>$row[title],
			"group_code"=>$row[group_code]
		);
	}
	
	exit(json_encode(array("status"=>"ok","data"=>$data),JSON_NUMERIC_CHECK));
	
	
	
	
	
	
	
?>