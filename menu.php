    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php"><p><img src="img/ETP.png" width="32px"> <font FACE="Impact Regular">E-Sport Ranking by ETP</font></p></a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="ranking.php">Ranking</a>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Tournament <b class="caret"></b></a>
                        <ul class="dropdown-menu">
							<li>
								<label><img src="img/dota2_logo.png" width="20px"> DOTA2</label>
							</li>
                            <li>
                                <a href="#">Comming Soon...</a>
                            </li>
                            <li>
                                <label> <img src="img/ow_logo.png" width="20px"> OVERWATCH</label>
                            </li>
                            <li>
                                <a href="#">Comming Soon...</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="contact.html">Contact</a>
                    </li>
					<?php
					if(empty($_SESSION["is_login"])){
					?>
					<li>
                        <a href="register.php">Register</a>
                    </li>
					<li>
                        <a href="login.php">Login</a>
                    </li>
					<? } else { ?>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span> Welcome : <?php echo $_SESSION["sess_id"]; ?><?php if(!empty($numindex)){ ?><span class="badge"><? echo $numindex; ?></span><?php }?> <span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							<li><a href="team.php"><span class="glyphicon glyphicon-globe"></span> Team</a></li>
							<li><a href="edit_profile.php"><span class="glyphicon glyphicon-pencil"></span> Edit Profile</a></li>
							<li><a href="classes/logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
						</ul>
					</li>
					<? } ?>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>