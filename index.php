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

<!-- Page Content -->
    <div class="container">

        <!-- Marketing Icons Section -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    <font FACE="Impacted Regular">Welcome to E-Sport Ranking By ETP</font>
                </h1>
            </div>
            <div class="col-md-4">
				<div class="panel panel-default" id="login">
					<?php
					if(empty($_SESSION["is_login"])){
					?>
                    <div class="panel-heading">
                        <h4><i class="fa fa-fw fa-user"></i> Login</h4>
                    </div>
                    <div class="panel-body">
                        <form id="login_form" name="login_form" method="post">	
							<table width="100%" border="0px">
								<tr>
									<td align="right">USERNAME &nbsp;&nbsp;&nbsp; </td>
									<td><input type="text" name="txt_user" id="txt_user" value="" class="form-control" style="width:200px;"> </td>
								</tr>
								<tr>
									<td align="right">PASSWORD &nbsp;&nbsp;&nbsp; </td>
									<td><input type="password" name="txt_pass" id="txt_pass" value="" class="form-control" style="width:200px;"> </td>
								</tr>
								<tr>
									<td></br></td>
								</tr>
								<tr>
									<td colspan="2" align="center"><input type="button" class="btn btn-primary" name="btn_login" id="btn_login" value="LOGIN">
									<a href="register.php"><input type="button" class="btn btn-primary" name="btn_regis" id="btn_regis" value="Register"></a></td>
								</tr>
							</table>
						</from>
                    </div>
					<? } else { ?>
					<div class="panel-heading">
                        <h4><i class="fa fa-fw fa-user"></i> Welcome</h4>
                    </div>
                    <div class="panel-body">
                        <form id="login_form" name="login_form" method="post">	
							<table width="100%" border="0px">
								<tr>
									<td width="100px"><img class="img-responsive" src="img/default.png" width="100px" alt=""></td>
									<td align="center"><h4><label><?php echo $_SESSION["sess_id"]; ?> </label></h4></td>
								</tr>
								<tr>
									<td></br></td>
								</tr>
								<tr>
									<td colspan="2" align="center"><input type="button" class="btn btn-default" name="btn_login" id="btn_login" value="Edit Profile">
									<a href="logout.php"><input type="button" class="btn btn-default" name="btn_regis" id="btn_regis" value="Logout"></a></td>
								</tr>
							</table>
						</from>
                    </div>
					<? } ?>
                </div>
            </div>
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4><i class="fa fa-fw fa-star"></i> What Is " E-Sport Ranking by ETP "</h4>
                    </div>
                    <div class="panel-body">
                        <p>..................</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->

        <!-- Portfolio Section -->
        <div class="row">
            <div class="col-lg-12">
                <h2 class="page-header"><font FACE="Impact Regular">News</font></h2>
            </div>
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-body">
						<img class="img-responsive" src="img/cms.png" width="400px" alt="">
                        <p>Comming Soon..</p>
                        <a href="#" class="btn btn-default">Learn More</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-body">
						<img class="img-responsive" src="img/cms.png" width="400px" alt="">
                        <p>Comming Soon..</p>
                        <a href="#" class="btn btn-default">Learn More</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-body">
						<img class="img-responsive" src="img/cms.png" width="400px" alt="">
                        <p>Comming Soon..</p>
                        <a href="#" class="btn btn-default">Learn More</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->

        <!-- Features Section -->
        <div class="row">
            <div class="col-lg-12">
                <h2 class="page-header"><font FACE="Impact Regular">Tournament</font></h2>
            </div>
            <div class="col-md-6">
                <p><h4><b>DOTA2</b></h4></p>
                <p>Comming Soon...</p>
            </div>
            <div class="col-md-6">
                <img class="img-responsive" src="img/dota2bg.gif" alt="">
            </div>
			<div class="col-lg-12">
			<hr>
			</div>
			<div class="col-md-6">
                <img class="img-responsive" src="img/owbg.gif" alt="">
            </div>
            <div class="col-md-6">
                <p><h4><b>OverWatch</b></h4></p>
                <p>Comming Soon...</p>
            </div>
            
        </div>
        <!-- /.row -->

        <hr>

<?php
include("footer.php");
?>
<script>
$('#btn_login').click(function(){
			
	if(($('#txt_user').val() == "")){
		$('#err_msg').show();
	}else if(($('#txt_pass').val() == "")){
		$('#err_msg').show();
	}else{
		$('#err_msg').hide();
		$.ajax({
			type: "POST",
			url: "classes/check_login.php",					
			data: $('#login_form').serialize(),
			dataType: 'json',
			success: function(res){
				if (res.success == true){
					alert(res.message);
					window.location='index.php';
				}else{			
					alert(res.message);
					$('#err_msg').show();
				}
			}

		}); 
	}
});
</script>
</body>
</html>