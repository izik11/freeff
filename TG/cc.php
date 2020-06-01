<?php
include("db.php");

if(!$cuser) {
die("Error Login!");
}

$ip = $_POST['ip'];

if($ip)
{
$details = mysql_query("SELECT * FROM `Sys-TG` WHERE `Sys-TG`.`ip` = '{$ip}' ORDER BY `Sys-TG`.`id` DESC") or die("Error!");  
	while($row = mysql_fetch_array($details)) {

		if($_POST['submit'] == " ωμη ") {
			echo "name: {$row['name']} | email: {$row['email']} | date: {$row['date']} | post: <br>{$row['post']} <iframe src=delete.php?id={$row['id']}></iframe><Br><Br><br>";
		} else {
			echo "test2";
		}

	}
}

?>



	<div align="center">
	<form action="cc.php" method="post">
	<table border=0 cellspacing=5 cellpadding=0>
	<tr>

	<td width=100><b>enter the ip:</b></td>

	<td width=300><input type="text" maxlength="20" name="ip" value=""></td>
	</tr>
	<tr>
	<td colspan=2>
	<table width=100% border=0 cellspacing=0 cellpadding=3>
	<tr>
	<td width=100% align="center">
	<input type="submit" name="submit" value=" ωμη "></td>
	</tr>
	</table>
	</td>
	</tr>
	</table>
	</form>
	</div>