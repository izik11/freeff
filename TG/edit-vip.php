<?php
include("db.php");

if(!$cuser)
{
die("<script>alert('אתה לא מחובר כמנהל')</script><script>window.location = 'index.php'</script>");
}

$id = $_GET['id'];
$pass = $_POST['pass'];
$user = $_POST['user'];
$email = $_POST['email'];
$donate = $_POST['donate'];
$site = $_POST['site'];


if($id)
{
$details = mysql_query("SELECT * FROM `Sys-User-Vip` WHERE `Sys-User-Vip`.`user_id` = '{$id}'") or die("Error!");  
	while($row = mysql_fetch_array($details)) {

		if($_POST['submit'] == " עדכן ") {
		$ok = mysql_query("UPDATE `Sys-User-Vip` SET `password` = '{$pass}',`username` = '{$user}',`site` = '{$site}',`email` = '{$email}',`donate` = '{$donate}' WHERE `Sys-User-Vip`.`user_id` ={$id} ;");
		}
		if($ok != "") {
		die("<script>alert('המשתמש {$id} עודכנה בהצלחה')</script><script>window.location = 'vip-list.php'</script>");
		}

echo <<<EOF
	<html dir="rtl">
	<title>עריכת משתמש</title>
<center><font color="red" size=3><b>
<div dir="rtl">
ברוכים הבאים לפאנל ניהול לאתר Tv-NeT - Free FileFlyer<br>
הפאנל נבנה כולו על ידי AnTi בלעדית. כל הזכויות שמורות.<br>
<BR>
<a href="vip-list.php"><font color="Red" size=3>חזור לרשימת vip</font></a> || 
<a href="admin.php"><font color="Red" size=3>חזור לפאנל ניהול</font></a> || 
<a href="../index.php"><font color="Red" size=3>חזור לאתר</font></a><Br><BR>
כאן תוכל לערוך את המשתמש VIP שבחרת<Br><BR>
</font></b></center></div>
	<div align="center">
	<form action="edit-vip.php?id={$row['user_id']}" method="post">
	<table border=0 cellspacing=5 cellpadding=0>
	<tr>

	<td width=100><b>שם משתמש:</b></td>
	<td width=300><input type="text" maxlength="50" name="user" value="{$row['username']}"></td>
	</tr>
	<tr>
	<td width=100>
	<b>סיסמא:</b>
	</td>
	<td width=300>
	<input type="text" maxlength="50" name="pass" value="{$row['password']}">
	</td>
	</tr>
	<tr>
	<td width=100>
	<b>email:</b>
	</td>
	<td width=300>
	<input type="text" maxlength="50" name="email" value="{$row['email']}">
	</td>
	</tr>
	<tr>
	<td width=100>
	<b>הסיסמא שהוא תרם:</b>
	</td>
	<td width=300>
	<input type="text" maxlength="50" name="donate" value="{$row['donate']}">
	</td>
	</tr>
	<tr>
	<td width=100>
	<b>לאתר:</b>
	</td>
	<td width=300>
	<input type="text" maxlength="50" name="site" value="{$row['site']}">
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
<center><font color="Red" size=3><b>
<div dir="rtl"><Br><BR>
<a href="vip-list.php"><font color="Red" size=3>חזור לרשימת vip</font></a> || 
<a href="admin.php"><font color="Red" size=3>חזור לפאנל ניהול</font></a> || 
<a href="../index.php"><font color="Red" size=3>חזור לאתר</font></a><Br><BR>
פאנל ניהול לאתר Tv-NeT - Free FileFlyer<br>
הפאנל נבנה כולו על ידי <a href="../connect.html"><font color="Red" size=3><b>AnTi</font></b></a> בלעדית. כל הזכויות שמורות.
</font></b></div></center>
	</html>
EOF;
}
}
?>