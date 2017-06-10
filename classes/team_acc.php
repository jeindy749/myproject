<?php
	session_start();
	include("../con_db.php");
	$result = array();
	
	//check username duplicate
	$strSQLchk = "SELECT user_id, confirm
				FROM n_team_member
				WHERE user_id = '" . $_SESSION["mem_id"] . "'
					AND ( confirm = '1' OR confirm = '2' )
					AND ";
	$objQueryChk = mysql_query($strSQLchk);
	$num = mysql_num_rows($objQueryChk);
	
	if(empty($num)){
		$SQL = "UPDATE n_team_member
				SET confirm = '1' 
				WHERE id = '". $_GET["t"]; ."'	";
		
					
		$objQuery = mysql_query($SQL);
		
		if($objQuery){
			$result["success"] = TRUE;
			$result["message"] = "สมัครสมาชิกเรียบร้อยแล้ว";
			
		}else{
			$result["success"] = FALSE;
			$result["message"] = "ไม่สามารถสมัครสมาชิกได้ " . mysql_error();
		}
	}else{
		echo <script>alert ('คุณได้สังกัดทีมใดทีมหนึ่งอยู่แล้ว'); </script>;
		$result["message"] = "Username นี้ถูกใช้แล้ว" . mysql_error();	
	}
	
	
	
	mysql_close($link);
	
?>