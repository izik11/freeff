<?php
include("db.php");

if($cuser != "AnTi")
{
die("<script>alert('אתה לא מחובר כמנהל')</script><script>window.location = 'index.php'</script>");
}

$id = $_GET['id'];
$before = $_POST['before'];
$after = $_POST['after'];
$test = $_POST['test'];

if($id)
{
$details = mysql_query("SELECT * FROM `Sys-Ban` WHERE `Sys-Ban`.`id` = '{$id}'") or die("Error!");  
	while($row = mysql_fetch_array($details)) {

		if($_POST['submit'] == " עדכן ") {
		$ok = mysql_query("UPDATE `Sys-Ban` SET `before` = '{$before}',`after` = '{$after}',`test` = '{$test}' WHERE `Sys-Ban`.`id` ={$id} ;");
		}
		if($ok != "") {
		die("<script>alert('ה id {$id} עודכן בהצלחה')</script><script>window.location = 'ban-list.php'</script>");
		}

echo <<<EOF
	<html dir="rtl">
	<title>עריכה</title>
<center><font color="red" size=3><b>
<div dir="rtl">
ברוכים הבאים לפאנל ניהול לאתר Tv-NeT - Free FileFlyer<br>
הפאנל נבנה כולו על ידי AnTi בלעדית. כל הזכויות שמורות.<br>
<BR>
<a href="ban-list.php"><font color="Red" size=3>חזור לרשימה</font></a> || 
<a href="admin.php"><font color="Red" size=3>חזור לפאנל ניהול</font></a> || 
<a href="../index.php"><font color="Red" size=3>חזור לאתר</font></a><Br><BR>
כאן תוכל לערוך את הבאן שבחרת<Br><BR>
</font></b></center></div>
	<div align="center">
	<form action="edit-ban.php?id={$row['id']}" method="post">
	<table border=0 cellspacing=5 cellpadding=0>
	<tr>
	<td width=100>
	<b>לפני:</b>
	</td>
	<td width=300>
	<input type="text" name="before" value="{$row['before']}">
	</td>
	</tr>
	<tr>
	<td width=100>
	<b>אחרי:</b>
	</td>
	<td width=300>
	<input type="text" name="after" value="{$row['after']}">
	</td>
	</tr>
	<tr>
	<td width=100>
	<b>טסט:</b>
	</td>
	<td width=300>
	<input type="text" name="test" value="{$row['test']}">
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
<a href="ban-list.php"><font color="Red" size=3>חזור לרשימת הבאנים</font></a> || 
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