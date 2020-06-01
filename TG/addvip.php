<?php
include("db.php");
if($cvip == "0")
{
die("אין לך גישה לעריכת הודעות");
}

if(!$cuser)
{
die("<script>alert('אתה לא מחובר כמנהל')</script><script>window.location = 'index.php'</script>");
}

$username = $_GET['username'];
$password = $_GET['password'];
$site = $_GET['site'];
$time = time();
$email = $_GET['email'];
$donate = $_GET['donate'];

if($username != "" && $password != "" && $email != "" && $donate != "")
{

		$testmail = mysql_query("SELECT * FROM Sys-User-Vip WHERE email = '$email'");
		if(@mysql_num_rows($testmail) != 0) {
		die("<script>alert('למשתמש זה יש כבר VIP')</script><script>history.back()</script>");
		}

	$add = mysql_query("INSERT INTO `Sys-User-Vip` (`user_id` ,`username` ,`password` ,`date` ,`email` ,`donate` ,`site` )VALUES ('0', '{$username}', '{$password}', '{$time}', '{$email}', '{$donate}', '{$site}');")or die(mysql_error()); 

	if($add != "")
	{
	mail($email, "VIP at FreeFF.Co.iL - Free FileFlyer", "UserName: {$username}\n\rPassWord: {$password}\nEnJoY! Free FileFlyer Team.", "From: Free FileFlyer <anti.release@gmail.com>");
	die("<script>alert('הוספת משתמש לVip תודה לך אתה מעובר')</script><script>history.back()</script>");
	}
}
else 
{
die("<script>alert('לא מילאת פרטים של משתמש VIP')</script><script>history.back()</script>");
}
?>