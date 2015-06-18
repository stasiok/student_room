<?
	header('Content-Type:application/json; charset=utf-8');
	
	function hash_to_id($hash=null){
		if($hash===null || !preg_match('/^[a-f0-9]{32}$/',$hash)) return false;
		$res=mysql_query("SELECT student_id,auth_time FROM auth_data WHERE auth_hash='$hash' LIMIT 1",DB);
		if(!mysql_num_rows($res))return false;
		$data=mysql_fetch_assoc($res);
		if($data[auth_time]<time()-31*24*60*60)return false;
		return $data[student_id];
	}
	function error($error_message){
		return json_encode(array("status"=>"error","error"=>$error_message));
	}
	
	
	
	
?>