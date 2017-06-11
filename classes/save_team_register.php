<?php
	session_start();
	include("../con_db.php");
	$strSQLchk = "SELECT id
				FROM n_team 
				WHERE full_name = '" . strtoupper($_POST['txt_fullname']) . "' ";	
	$objQueryChk = mysql_query($strSQLchk);
	$num = mysql_num_rows($objQueryChk);
	if(empty($num)){
		$imageupload = $_FILES['filUpload']['tmp_name'];
		$imageupload_name = $_FILES['filUpload']['name'];
		$arraypic = explode(".",$imageupload_name);//แบ่งชื่อไฟล์กับนามสกุลออกจากกัน
		//$lastname = strtolower($arraypic);
		$filename = $arraypic[0];//ชื่อไฟล์
		$filetype = $arraypic[1];//นามสกุลไฟล์
		//$newimage = $filename.".".$filetype;
		$newimage = $_POST["txt_fullname"]."_LOGO.".$filetype;
		if(move_uploaded_file($_FILES["filUpload"]["tmp_name"],"../team_logo/".$newimage))
		{	
			//insert Team
			$strSQL = "INSERT INTO n_team (full_name,short_name,leader,picture,create_date,is_ban,game_id)
						VALUE (
							'". $_POST["txt_fullname"] ."' ,
							'". strtoupper($_POST["txt_shortname"]) ."' ,
							'". $_SESSION["mem_id"] ."' ,
							'". $newimage ."' ,
							'". date("Y-m-d") ."' ,
							'0' ,
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
			$strSQL2 = "INSERT INTO n_team_member (team_id,user_id,confirm)
						VALUE (
							'". $max_oid ."' ,
							'". $_SESSION["mem_id"] ."'  ,
							'2'
							)
						";
						
			$objQuery2 = mysql_query($strSQL2);
			
			$result = array();
			/*$SQL = "INSERT INTO team (team_name,team_n,team_pic)
						VALUES (
							'". $_POST["tt"] ."' ,
							'". $_POST["tn"] ."' ,
							 '". $newimage ."'
							)
					";
			$objQuery3 = mysql_query($SQL);*/
			//mysql_close($link);
			//echo "<script>alert('Upload file successfully!');</script>";
			echo "<script>window.top.window.showResult('1');</script>";
		}
		else
		{	
			//echo "<script>alert('Error! Cannot upload data');</script>";
			echo "<script>window.top.window.showResult('2');</script>";
		}
		
		
		if($objQuery){
			echo "<script>alert('สร้างทีมเรียบร้อยแล้ว!');</script>";
			echo "<script>window.location='../team.php'</script>";
			
			//echo json_encode($result);	
		}else{
			echo "<script>alert('ไม่สามารถสร้างทีมได้!');</script>";
			echo "<script>window.top.window.showResult('2');</script>";
			//echo json_encode($result);
		}
	} else {
		//$result = array();
		echo "<script>alert('ชื่อนี้ถูกใช้งานไปแล้ว!');</script>";
		echo "<script>window.top.window.showResult('2');</script>";
		//echo json_encode($result);
	}
	
	mysql_close($link);
	
?>