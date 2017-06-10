<?php
	session_start();
	include("../con_db.php");
	$strSQLchk = "SELECT id
				FROM n_team 
				WHERE full_name = '" . strtoupper($_POST['txt_fullname']) . "' ";	
	$objQueryChk = mysql_query($strSQLchk);
	$num = mysql_num_rows($objQueryChk);
	if(empty($num)){
		//insert Team
		$strSQL = "INSERT INTO n_team (full_name,short_name,leader,picture,create_date,is_ban,game_id)
					VALUE (
						'". $_POST["txt_fullname"] ."' ,
						'". strtoupper($_POST["txt_shortname"]) ."' ,
						'". $_SESSION["mem_id"] ."' ,
						'default.png' ,
						'".date("Y-m-d")."' ,
						'2' ,
						'". $_POST["game"] ."' 
						)
					";
					
		$objQuery = mysql_query($strSQL);
		
		//get team_id
		$strSQL = "select max(id) as id from n_team";
		$res = mysql_query($strSQL);

		$max_oid = 0;

		while($r = mysql_fetch_array($res)){
			$max_oid = $r["id"];
		}
		//team_detail_type 1=ตัวจริง 2=ตัวสำรอง
		
		//Insert Point Rank
		$strSQL1 = "INSERT INTO n_user_rank (user_id,game_id)
					VALUE (
						'". $_SESSION["mem_id"] ."' ,
						'". $_POST["game"] ."' 
						)
					";
					
		$objQuery1 = mysql_query($strSQL1);
		
		//Insert Team member
		$strSQL2 = "INSERT INTO n_team_member (team_id,user_id)
					VALUE (
						'". $max_oid ."' ,
						'". $_SESSION["mem_id"] ."' 
						)
					";
					
		$objQuery2 = mysql_query($strSQL2);
		
		$result = array();
		
		if($objQuery){
			$result["success"] = TRUE;
			$result["message"] = "สมัครทีมเรียบร้อยแล้ว";
			
			echo json_encode($result);	
		}else{
			$result["success"] = FALSE;
			$result["message"] = "ไม่สามารถสมัครทีมได้ " . mysql_error();	
			echo json_encode($result);
		}
	} else {
		$result = array();
		$result["success"] = FALSE;
		$result["message"] = "ชื่อทีมนี้ถูกใช้แล้ว " . mysql_error();	
		echo json_encode($result);
	}
	
	mysql_close($link);
	
?>