<?php
include("db.php");

if(!$cuser)
{
die("<script>alert('אתה לא מחובר כמנהל')</script><script>window.location = 'index.php'</script>");
}

$id = $_GET['id'];
$reason = $_POST['reason'];
$from = $_POST['from'];
$post = $_POST['post'];

if($id)
{
$details = mysql_query("SELECT * FROM `banlist` WHERE `banlist`.`id` = '{$id}'") or die("Error!");  
	while($row = mysql_fetch_array($details)) {

		if($_POST['submit'] == " עדכן ") {
		$ok = mysql_query("UPDATE `banlist` SET `reason` = '{$reason}',`from` = '{$from}',`post` = '{$post}' WHERE `banlist`.`id` ={$id} ;");
		}
		if($ok != "") {
		die("<script>alert('הבאן {$id} עודכן בהצלחה')</script><script>window.location = 'banned-list.php'</script>");
		}

echo <<<EOF
	<html dir="rtl">
	<title>עריכת סיבת באן</title>
<center><font color="red" size=3><b>
<div dir="rtl">
ברוכים הבאים לפאנל ניהול לאתר Tv-NeT - Free FileFlyer<br>
הפאנל נבנה כולו על ידי AnTi בלעדית. כל הזכויות שמורות.<br>
<BR>
<a href="banned-list.php"><font color="Red" size=3>חזור לרשימת הבאנים</font></a> || 
<a href="admin.php"><font color="Red" size=3>חזור לפאנל ניהול</font></a> || 
<a href="../index.php"><font color="Red" size=3>חזור לאתר</font></a><Br><BR>
כאן תוכל לערוך את הבאן שבחרת<Br><BR>
</font></b></center></div>
	<div align="center">
	<form action="edit-banned.php?id={$row['id']}" method="post">
	<table border=0 cellspacing=5 cellpadding=0>
	<tr>
	<td width=100><b>הסיבה:</b></td>
	<td width=300><textarea maxlength="3000" name="reason" style="width: 250px; height: 70px;">{$row['reason']}</textarea>
	</tr>
	<tr>
	<td width=100>
	<b>מ:</b>
	</td>
	<td width=300>
	<input type="text" maxlength="50" name="from" value="{$row['from']}">
	</td>
	</tr>
	<tr>
	<td width=100><b>ההודעה:</b></td>
	<td width=300><textarea maxlength="3000" name="post" style="width: 250px; height: 70px;">{$row['post']}</textarea>
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
<a href="banned-list.php"><font color="Red" size=3>חזור לרשימת הבאנים</font></a> || 
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