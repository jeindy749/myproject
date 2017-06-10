<?php
	session_start();
	include("../con_db.php");
	$result = array();
	
	//check username duplicate
	$strSQLchk = "SELECT id
				FROM n_user 
				WHERE username = '" . strtoupper($_POST['txt_username']) . "' ";
	$objQueryChk = mysql_query($strSQLchk);
	$num = mysql_num_rows($objQueryChk);
	
	if(empty($num)){
		$strSQL1 = "INSERT INTO n_user (username,password,first_name,last_name,email,phone,facebook,steam,picture,create_date,is_ban)
					VALUE (
						'". $_POST["txt_username"] ."' ,
						'". $_POST["txt_password"] ."' ,
						'". $_POST["txt_name"] ."' ,
						'". $_POST["txt_lastname"] ."' ,
						'". $_POST["txt_email"] ."' ,
						'". $_POST["txt_phone"] ."' ,
						'". $_POST["txt_facebook"] ."' ,
						'". $_POST["txt_steam"] ."' ,
						'default.png' ,
						'".date("Y-m-d")."' ,
						'0'
						)
					";
					
		$objQuery = mysql_query($strSQL1);
		
		if($objQuery){
			$result["success"] = TRUE;
			$result["message"] = "สมัครสมาชิกเรียบร้อยแล้ว";
			
			echo json_encode($result);	
		}else{
			$result["success"] = FALSE;
			$result["message"] = "ไม่สามารถสมัครสมาชิกได้ " . mysql_error();	
			echo json_encode($result);
		}
	}else{
		$result["success"] = FALSE;
		$result["message"] = "Username นี้ถูกใช้แล้ว" . mysql_error();	
		echo json_encode($result);
	}
	
	
	
	mysql_close($link);
	
?>