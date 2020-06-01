<?php
include("db.php");
include("functions.php");
include("../banlist.php");

if(getUserVip($_COOKIE['TG-Vip'], 1) == 0)
{
die("<script>alert('אתה לא מחובר כVIP')</script><script>window.location = 'index.php'</script>");
}

$id = $_GET['id'];
$email = $_GET['email'];

if($id != "" && $email != "")
{
$details = mysql_query("SELECT * FROM `Sys-User-Vip` WHERE `Sys-User-Vip`.`user_id` = '{$id}'") or die("Error!");  
while($row = mysql_fetch_array($details)) {
	if($row['email'] != $email) {
	die ("שגיאה!");	
	}
		if($_POST['submit'] == " עדכן " && $_POST['pass'] != "") {
		if($_POST['pass'] != $row['password']) { die("סיסמא נוכחית!"); }
		if($_POST['new'] != $_POST['new2']) { die("אימות סיסמא נכשל!"); }
		$pas2 = $_POST['new'];
		$user = $_POST['user'];
		if($pas2 == "" && $_POST['new2'] == "") { $pas2=$row['password']; }
		$ok = mysql_query("UPDATE `Sys-User-Vip` SET `username` = '{$user}',`password` = '{$pas2}' WHERE `Sys-User-Vip`.`user_id` ={$id} ;");
		}
		if($ok != "") {
		die("<script>alert('שונה בהצלחה')</script><script>window.location = 'vip.php'</script>");
		}

echo <<<EOF
	<html dir="rtl">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1255"> 
	<div align="center">
	<form action="editu.php?id={$id}&email={$email}" method="post">
	<table border=0 cellspacing=5 cellpadding=0>
	<tr>
	<td width=100>
	<b>שם משתמש:</b>
	</td>
	<td width=300>
	<input type="text" name="user" value="{$row['username']}">
	</td>
	</tr>
	<tr>
	<td width=100>
	<b>סיסמא חדשה:</b>
	</td>
	<td width=300>
	<input type="password" name="new" value="">
	</td>
	</tr>
	<tr>
	<td width=100>
	<b>אימות סיסמא חדשה:</b>
	</td>
	<td width=300>
	<input type="password" name="new2" value="">
	</td>
	</tr>
	<tr>
	<td width=100>
	<b>סיסמא נוכחית:</b>
	</td>
	<td width=300>
	<input type="password" name="pass" value="">
	</td>
	</tr>
	<tr>
	<td colspan=2>
	<table width=100% border=0 cellspacing=0 cellpadding=3>
	<tr>
	<td width=100% align="center">
	<input type="submit" name="submit" value=" עדכן "></td>
	</tr>
	</table>
	</td>
	</tr>
	</table>
	</form>
	</div>

EOF;
}
}
?>