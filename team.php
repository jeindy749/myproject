<!DOCTYPE html>
<html lang="en">

<?php
include("head.php");
?>

<body>

<?php
include("menu.php");
?>
<div class="container">
	<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                <font FACE="Impact Regular">Team</font>
            </h1>
		<?php 
			//Check Team
			$CheckteamSQL = "SELECT a.full_name, a.leader, b.id, b.team_id, b.user_id, a.game_id 
								FROM n_team a, n_team_member b
								WHERE b.team_id = a.id
								AND b.user_id = '". $_SESSION["mem_id"] ."' 
								AND b.confirm = '0'";
			$CheckteamQuery = mysql_query($CheckteamSQL);
			$Checkteamnum = mysql_num_rows($CheckteamQuery);
			
			if (!empty($Checkteamnum)) {
			?>	
				<div class="col-lg-12">
					<h3>Invite</h3>
				</div>
				<div class="col-lg-12" style="border-width:1px;border-radius:5px;border-style:groove">
					</br>
					<table class="table table-holver" width="100%">
						<tr>
							<th width="10%">No.</th>
							<th width="45%">Team</th>
							<th width="15%">Game</th>
							<th width="10%">#</th>
							<th width="10%">#</th>
						</tr>
						<?php
						while( $CheckteamRes = mysql_fetch_array($CheckteamQuery) ){
							if ($CheckteamRes["game_id"] == '1') {
								$gamename = "DOTA2";
							} else {
								$gamename = "OVERWATCH";
							}
						?>
							<tr>
								<td><?php echo $teamno = $teamno + 1; ?></td>
								<td><?php echo $CheckteamRes["full_name"]; ?></td>
								<td><?php echo $gamename; ?></td>
								<td><a href="classes/team_acc.php?t=<?php echo $CheckteamRes["id"]; ?>&g=<?php echo $CheckteamRes["game_id"]; ?>"><button type="submit" class="btn btn-default btn-sm" name="btn_acc" id="btn_acc" >Accept</button></a></td>
								<td><a href="classes/team_dec.php?t=<?php echo $CheckteamRes["id"]; ?>&g=<?php echo $CheckteamRes["game_id"]; ?>"><button type="submit" class="btn btn-default btn-sm" name="btn_dec" id="btn_dec" >Decline</button></a></td>
							</tr>
						<?php
						}
						?>
					</table>
				</div>
			<?php 
			}
			?>
			
			<div class="col-lg-12">
			<br>
			</div>
			
			<div class="col-lg-12" style="border-width:1px;border-radius:5px;border-style:groove">
				<h3>DOTA2</h3>
				<?php
				$teamDotaSQL = "SELECT a.user_id, a.team_id, b.username, c.full_name, c.short_name, c.id, c.picture
								FROM n_team_member a, n_user b, n_team c
								WHERE a.user_id = b.id
									AND a.team_id = c.id
									AND c.game_id = '1'
									AND a.user_id = '". $_SESSION["mem_id"] ."'
									AND (a.confirm = '1' OR a.confirm = '2') ";
				$teamDotaQuery = mysql_query($teamDotaSQL);
				$teamDotaNum = mysql_num_rows($teamDotaQuery);
				while ($teamDotaRes = mysql_fetch_array($teamDotaQuery)) {
					$dota_full_name = $teamDotaRes["full_name"];
					$dota_short_name = $teamDotaRes["short_name"];
					$dota_pic = $teamDotaRes["picture"];
					$dota_id = $teamDotaRes["id"];
				}
				
				if (empty($teamDotaNum)) {
				?>
					<a href="team_register.php?t=2"><button type="submit" class="btn btn-default btn-lg" name="btn_cre" id="btn_cre" >CreateTeam</button></a>
					<br><br>
				<?php
				} else {
					
					$memberDotaSQL = "SELECT a.user_id, a.team_id, b.username, a.confirm
									FROM n_team_member a, n_user b
									WHERE a.user_id = b.id 
										AND a.team_id = '". $dota_id ."' ";
					$memberDotaQuery = mysql_query($memberDotaSQL);
					
					$leadDotaSQL = "SELECT a.user_id, a.team_id, b.username, a.confirm, a.id
									FROM n_team_member a, n_user b
									WHERE a.user_id = b.id 
										AND a.team_id = '". $dota_id ."' 
										AND a.user_id = '". $_SESSION["mem_id"] ."' ";
					$leadDotaQuery = mysql_query($leadDotaSQL);
					
				?>
				<center>
				<img src="team_logo/<? echo $dota_pic; ?>" width="150px">
				<h4><b><?php echo $dota_full_name; ?></b></h4>
				<h4><?php echo "[&nbsp;&nbsp;".$dota_short_name."&nbsp;&nbsp;]"; ?></h4>
				</center>
				<? while ($leaddota = mysql_fetch_array($leadDotaQuery)) {
					if ($leaddota["confirm"] == '2') { ?>
						<a href="classes/team_lev.php?t=<?php echo $leaddota["id"]; ?>" class="btn btn-default pull-right"><span class="glyphicon"></span> Leave</a>
						<a href="team_edit.php?t=<?php echo $leaddota["id"]; ?>" class="btn btn-default pull-right"><span class="glyphicon glyphicon-pencil"></span> Edit</a>
				<? 	} else { ?>
						<a href="classes/team_lev.php?t=<?php echo $leaddota["id"]; ?>" class="btn btn-default pull-right"><span class="glyphicon"></span> Leave</a>
				<? 	}
				} ?>
				<table class="table table-holver" width="100%">
					<tr>
						<th width="10%">No.</th>
						<th width="70%">Member</th>
						<th width="20%">##</th>
					</tr>
					<?php
					while ($memberDotaRes = mysql_fetch_array($memberDotaQuery)) {
						switch ( $memberDotaRes["confirm"] ) {
							case '0':
								$status = "Pending";
								break;
							case '1':
								$status = "Member";
								break;
							case '2':
								$status = "Leader";
								break;
							default:
								$status = "";
								break;
						}
					?>
						<tr>
							<td><?php echo $memberdotano = $memberdotano+1; ?></td>
							<td><?php echo $memberDotaRes["username"]; ?></td>
							<td><?php echo $status; ?></td>
						</tr>
					<?php
					}
					?>
				</table>
				<?php
				
				}
				?>
			</div>

			<!-- OVERWATCH -->
			<div class="col-lg-12" style="border-width:1px;border-radius:5px;border-style:groove">
				</br>
				<h3>OVERWATCH</h3>
				<?php
				$teamOwSQL = "SELECT a.user_id, a.team_id, b.username, c.full_name, c.short_name, c.id, c.picture
								FROM n_team_member a, n_user b, n_team c
								WHERE a.user_id = b.id
									AND a.team_id = c.id
									AND c.game_id = '2'
									AND a.user_id = '". $_SESSION["mem_id"] ."'
									AND (a.confirm = '1' OR a.confirm = '2') ";
				$teamOwQuery = mysql_query($teamOwSQL);
				$teamOwNum = mysql_num_rows($teamOwQuery);
				while ($teamOwRes = mysql_fetch_array($teamOwQuery)) {
					$Ow_full_name = $teamOwRes["full_name"];
					$Ow_short_name = $teamOwRes["short_name"];
					$Ow_pic = $teamOwRes["picture"];
					$Ow_id = $teamOwRes["id"];
				}
				if (empty($teamOwNum)) {
				?>
					<a href="team_register.php?t=2"><button type="submit" class="btn btn-default btn-lg" name="btn_cre" id="btn_cre" >CreateTeam</button></a>
					<br><br>
				<?php
				} else {
					
					$memberOwSQL = "SELECT a.user_id, a.team_id, b.username, a.confirm
									FROM n_team_member a, n_user b
									WHERE a.user_id = b.id 
										AND a.team_id = '". $Ow_id ."' ";
					$memberOwQuery = mysql_query($memberOwSQL);
					
					$leadOwSQL = "SELECT a.user_id, a.team_id, b.username, a.confirm, a.id
									FROM n_team_member a, n_user b
									WHERE a.user_id = b.id 
										AND a.team_id = '". $Ow_id ."' 
										AND a.user_id = '". $_SESSION["mem_id"] ."' ";
					$leadOwQuery = mysql_query($leadOwSQL);
					
				?>
				<center>
				<img src="team_logo/<? echo $Ow_pic; ?>" width="150px">
				<h4><?php echo $Ow_full_name; ?></h4>
				<h4><?php echo "[&nbsp;&nbsp;".$Ow_short_name."&nbsp;&nbsp;]"; ?></h4>
				</center>
				<? while ($leadOw = mysql_fetch_array($leadOwQuery)) {
					if ($leadOw["confirm"] == '2') { ?>
						<a href="classes/team_lev.php?t=<?php echo $leadOw["id"]; ?>" class="btn btn-default pull-right"><span class="glyphicon"></span> Leave</a>
						<a href="team_edit.php?t=<?php echo $leadOw["id"]; ?>" class="btn btn-default pull-right"><span class="glyphicon glyphicon-pencil"></span> Edit</a>
				<? 	} else { ?>
						<a href="classes/team_lev.php?t=<?php echo $leadOw["id"]; ?>" class="btn btn-default pull-right"><span class="glyphicon"></span> Leave</a>
				<? 	}
				} ?>
				<table class="table table-holver" width="100%">
					<tr>
						<th width="10%">No.</th>
						<th width="70%">Member</th>
						<th width="20%">##</th>
					</tr>
					<?php
					while ($memberOwRes = mysql_fetch_array($memberOwQuery)) {
						switch ( $memberOwRes["confirm"] ) {
							case '0':
								$status = "Pending";
								break;
							case '1':
								$status = "Member";
								break;
							case '2':
								$status = "Leader";
								break;
							default:
								$status = "";
								break;
						}
					?>
						<tr>
							<td><?php echo $memberOwno = $memberOwno+1; ?></td>
							<td><?php echo $memberOwRes["username"]; ?></td>
							<td><?php echo $status; ?></td>
						</tr>
					<?php
					}
					?>
				</table>
				<?php
				}
				?>
			</div>	
		</div>
	</div>
</div>

<hr>

<?php
include("footer.php");
?>
</body>
</html>