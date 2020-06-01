<?php
include("../banlist.php");
$email = "anti.release@gmail.com";
$check22 = mysql_query("SELECT * FROM `Sys-User-Vip` WHERE `email`='{$email}'");  
if(@mysql_num_rows($check22) != 0) {
while($ro44 = mysql_fetch_array($check22)) {
$datevip = $ro44['date'];
$idvip = $ro44['user_id'];
echo $datevip;
echo "<br>";
echo $idvip;
echo "<br>";
}
}
$newdate = $datevip+604800;
echo $newdate;
echo "<br>";
/*
if(@mysql_num_rows($check22) == 0) {
$add = mysql_query("INSERT INTO `Sys-User-Vip` (`user_id` ,`username` ,`password` ,`date` ,`email` ,`donate` ,`site` )VALUES ('', '{$by}', '{$pw2}', '{$time2}', '{$email}', 'vip', '{$site}');"); 
	if($add != "")
	{		
	mail($email, "VIP at TV-NeT.Co.iL - Free FileFlyer", "UserName: {$by}\n\rPassWord: {$pw2}\nEnJoY! Free FileFlyer Team.", "From: Free FileFlyer <anti.release@gmail.com>");
	die("<script>alert('הסיסמא נוספה בהצלחה והמשתמש קיבל VIP')</script><script>window.location = 'index.php'</script>");
	}
} else {
	$add = mysql_query("UPDATE `Sys-User-Vip` SET `date` = '{$newdate}' WHERE `Sys-User-Vip`.`email` ={$email} ;");
	if($add != "")
	{		
	mail($email, "VIP at TV-NeT.Co.iL - Free FileFlyer", "Your User Got More 1 ViP Week \n\r to remind you, here is your details:\r\n UserName: {$by}\n\rPassWord: {$pw2}\nEnJoY! Free FileFlyer Team.", "From: Free FileFlyer <anti.release@gmail.com>");
	die("<script>alert('הסיסמא נוספה בהצלחה ולמשתמש נוסף שבוע VIP נוסף!')</script><script>window.location = 'index.php'</script>");
	}
}
*/
?>