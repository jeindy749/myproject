<!DOCTYPE html>
<html lang="en">

<?php
include("head.php");
?>

<body>

<?php
include("menu.php");
include("header.php");
?>

<div class="container">
	<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                <font FACE="Impact Regular">Build Team</font>
            </h1>
			<form action="classes/save_team_register.php" name="frmMain" method="post" enctype="multipart/form-data" target="iframe_target" onSubmit="return ChkSubmit();">
				<div class="col-lg-8 col-lg-offset-2" >
				<!--<form class="form-horizontal" action=" " method="post"  id="data_form">-->
					<div class="col-lg-4">
						<label class="control-label">Select Game</label>
					</div>
					<div class="form-group row"> 
						<div class="col-lg-6">
							<div class="input-group">
								<label class="radio-inline"><input type="radio" name="game" id="game" value="1" <?php if($_GET["t"]=='1'){ echo "checked"; } ?>> DOTA2 </label>
								<label class="radio-inline"><input type="radio" name="game" id="game" value="2" <?php if($_GET["t"]=='2'){ echo "checked"; } ?>> OVERWATCH </label>
							</div>
						</div>
					</div>
					<!-- Text input-->

					<div class="form-group">
						<label class="col-lg-4 control-label">Team Name (Full)</label>  
						<div class="col-lg-6 inputGroupContainer">
							<div class="input-group">
								<span class="input-group-addon"><i class="glyphicon glyphicon-star"></i></span>
								<input  name="txt_fullname" id="txt_fullname" placeholder="Full Name" class="form-control"  type="text">
							</div>
						</div>
					</div>
					
					<!-- Text input-->

					<div class="form-group">
						<label class="col-lg-4 control-label">Team Name (Short)</label>  
						<div class="col-lg-6 inputGroupContainer">
							<div class="input-group">
								<span class="input-group-addon"><i class="glyphicon glyphicon-star-empty"></i></span>
								<input  name="txt_shortname" id="txt_shortname" placeholder="Short Name" class="form-control"  type="text">
							</div>
						</div>
					</div>
					
						<iframe id="iframe_target" name="iframe_target" src="#" style="width:0;height:0;border:0px solid #fff;"></iframe>
						<script language="JavaScript">

							function ChkSubmit(result)
							{
								if(document.getElementById("filUpload").value == "")
								{
									alert('Please select file...');
									return false;
								}
								
								document.getElementById("progress").style.visibility="visible"; 
								document.getElementById("divresult").innerHTML ="Uploading....";
								return true;
							}

							function showResult(result)
							{
								document.getElementById("progress").style.visibility="hidden"; 
								if(result==1)
								{
									document.getElementById("divresult").innerHTML = "<font color=green> Save successfully! </font>  <br>";
								}
								else
								{
									document.getElementById("divresult").innerHTML = "<font color=red> Error!! Cannot upload data </font> <br>";
								}
							}
						</script>
						<div class="form-group">
							<label class="col-lg-4 control-label">Team Logo</label>  
							<div class="input-group"> 
								<div class="col-lg-6">
									<input type="file" name="filUpload" id="filUpload" >
									<div id="progress" style="visibility:hidden"></div>
								</div>
							</div>
						</div>
					
					<!-- Success message 
					<div class="alert alert-success" role="alert" id="success_message">Success <i class="glyphicon glyphicon-thumbs-up"></i> Thanks for Register.</div>
					-->
					<!-- Button -->
					<div class="form-group">
						<label class="col-lg-4 control-label"></label>
						<div class="col-lg-6">
							<!--<input type="button" class="btn btn-warning" name="btn_ok" id="btn_ok" value="Register">-->
							<input type="submit" name="submit" value="ตกลง" class="btn btn-primary"><div id="divresult"></div>
						</div>
					</div>
				</div>
			</form>
			<!--<div class="col-lg-6">
				<form action="classes/upload_logo_save.php" name="frmMain" method="post" enctype="multipart/form-data" target="iframe_target" onSubmit="return ChkSubmit();">
					<iframe id="iframe_target" name="iframe_target" src="#" style="width:0;height:0;border:0px solid #fff;"></iframe>
					<script language="JavaScript">

						function ChkSubmit(result)
						{
							if(document.getElementById("filUpload").value == "")
							{
								alert('Please select file...');
								return false;
							}
							
							document.getElementById("progress").style.visibility="visible"; 
							document.getElementById("divresult").innerHTML ="Uploading....";
							return true;
						}

						function showResult(result)
						{
							document.getElementById("progress").style.visibility="hidden"; 
							if(result==1)
							{
								document.getElementById("divresult").innerHTML = "<font color=green> Save successfully! </font>  <br>";
							}
							else
							{
								document.getElementById("divresult").innerHTML = "<font color=red> Error!! Cannot upload data </font> <br>";
							}
						}
					</script>
					<table width="100%" border="0px">
						<tr>
							<td align="center" colspan="4"><h4>Team</h4></td>
						</tr>
						<tr>
							<td>&nbsp;&nbsp;</td>
						</tr>
						<tr>
							<td colspan="2" align="right">รูปทีม :&nbsp </td>
							<td colspan="2"><input type="file" name="filUpload" id="filUpload" >
							<input type="submit" name="submit" value="ตกลง" class="btn btn-default"><div id="divresult"><font color="red">**ถ้ารูปไม่ขึ้นให้ Refresh หน้า 1 ครั้ง</font></div>
							<div id="progress" style="visibility:hidden"></div></td>
						</tr>
					</table>
					</form>-->
		</div>
	</div>

<hr>


<?php
include("footer.php");
?>

</div>


<script>

</script>
</body>
</html>