<?php
include("db.php");
if($cban == "0")
{
die("אין לך גישות לתת באן");
}

if(!$cuser)
{
die("<script>alert('אתה לא מחובר כמנהל')</script><script>window.location = 'index.php'</script>");
}

$ip = $_GET['ip'];
$from = $_GET['from'];
$reason = $_GET['reason'];
$post = $_GET['post'];

if($ip != "")
{

	$check = mysql_query("SELECT * FROM `banlist` WHERE `ip`='{$ip}'");  
	if(@mysql_num_rows($check) == 0)
	{

		$add = mysql_query("INSERT INTO `banlist` (`id` ,`ip` ,`from` ,`reason` ,`post` )VALUES ('0', '{$ip}', '{$from}', '{$reason}', '{$post}');") or die(mysql_error()); 

		if($add != "")
		{
		die("<script>alert('הבאן נוסף בהצלחה!')</script><script>history.back()</script>");
		}
	} else {
		die("<script>alert('לIP הזה כבר יש באן אתה לא יכול לתת לו עוד אחד')</script><script>history.back()</script>");	
	}
} else {
die("<script>alert('לא הכנסת IP')</script><script>history.back()</script>");
}
?>