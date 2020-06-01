<?php
include("db.php");
$ip = $_SERVER["REMOTE_ADDR"];
echo '<meta http-equiv="Content-Type" content="text/html; charset=windows-1255">';

$sendFrom = $_POST['sendFrom']; 
$subject = $_POST['subject']; 
$message = $_POST['message']; 
$name = $_POST['name']; 
$date = time();
if ($sendFrom == "NY") { die("ok"); } 
if ($sendFrom == $subject || $sendFrom == $message || $message == $subject)
 {
        echo("אין באפשרותך לכתוב בשני שדות טקסט זהה .  ");
 }
else
 {
$org=$message;
$message = "{$message} <br>\n name: {$name}";
$check = mysql_query("SELECT * FROM `Sys-Mail` WHERE `ip`='{$ip}'");  
	if(@mysql_num_rows($check) >= 1) {
		while($row = mysql_fetch_array($check)) {
			if (($subject == $row['subject']) || ($message ==  $row['msg'])) {
			die("אתה לא יכול לשלוח הודעה עם אותו נושא /הודעה שכבר שלחת!");
			}
		}
	}

mail('<anti.release@gmail.com>', $subject, "$org \n name: $name \n ip: $ip sent by: site", "From:".$sendFrom); 

$add = mysql_query("INSERT INTO `Sys-Mail` (`id` ,`email` ,`subject` ,`msg` ,`ip` ,`date` ,`read` )VALUES ('0', '{$sendFrom}', '{$subject}', '{$message}', '{$ip}', '{$date}', '1');") or die(mysql_error());

die('<script>alert("ההודעה נשלחה בהצלחה!");window.location="index.php";</script>'); 

}
?>