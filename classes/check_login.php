<?php
session_start();
include("../con_db.php");
	//echo strtoupper($_POST['txt_user']).$_POST['txt_pass'];

	$strSQL = "SELECT id,username,password,first_name
				FROM n_user
				WHERE username = '" . strtoupper($_POST['txt_user']) . "' 
					AND password = '" . $_POST['txt_pass'] ."' ";
	$res = mysql_query($strSQL);
	while($r = mysql_fetch_array($res))
	{
		$id = strtoupper($r["username"]);
		$name = $r["first_name"];
		$seq = $r["id"];	
	}
	
	$objQuery = mysql_query($strSQL);

	$num = mysql_num_rows($objQuery);
	
	$result = array();
	if(!empty($num)) {
		 if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
		$ip = $_SERVER['HTTP_CLIENT_IP'];
		} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
			$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		} else {
			$ip = $_SERVER['REMOTE_ADDR'];
		}
		$result["success"] = TRUE;
		$result["id"] = $id;
		$result["user"] = $name;		
		$result["message"] = "Login OK";
		$_SESSION["mem_id"] = $seq;
		$_SESSION["sess_id"] = $result["id"];
		$_SESSION["is_login"] = 1;
		//$_SESSION["sess_stream"] = 1;
	
		echo json_encode($result);	
		
	}else{
		$result["success"] = FALSE;
		$_SESSION["is_login"] = 0;
		$result["message"] = "Username หรือ Password ไม่ถูกต้องครับ  :-) " . mysql_error();	
		echo json_encode($result);
	}
	
	mysql_close($link);
	
?>