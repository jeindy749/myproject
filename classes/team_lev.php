<?php
	session_start();
	include("../con_db.php");
	$result = array();
	
	//check username duplicate
	/*$strSQLchk = "SELECT user_id, confirm
				FROM n_team_member
				WHERE user_id = '" . $_SESSION["mem_id"] . "'
					AND ( confirm = '1' OR confirm = '2' )
					";
	$objQueryChk = mysql_query($strSQLchk);
	$num = mysql_num_rows($objQueryChk);*/
	
	if(empty($num)){
		$SQL = "UPDATE n_team_member
				SET confirm = '0' 
				WHERE id = '". $_GET["t"] ."'	";
					
		$objQuery = mysql_query($SQL);
		
		if($objQuery){
			echo "<script>alert ('คุณได้ออกจากทีมเรียบร้อยแล้ว') </script>";
			echo "<script>window.location='../team.php'</script>";	
			
		}else{
			echo "<script>alert ('คุณทำรายการไม่สำเร็จ') </script>";
			echo "<script>window.location='../team.php'</script>";	
		}
	}/*else{
		echo "<script>alert ('คุณได้สังกัดทีมใดทีมหนึ่งอยู่แล้ว') </script>";
		echo "<script>window.location='../team.php'</script>";	
	}*/
	
	
	
	mysql_close($link);
	
?>