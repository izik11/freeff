<?php
ob_start();
session_start();
include("banlist.php");
//include("date.php");
if(isset($_POST['name'])){
$date = date("H:i , j.n.y");
$ip = "no-ip-for-me";
$name = $_POST['name'];
$email = $_POST['email'];
$text = $_POST['text'];
$funtime = time();
$ok = mysql_query("INSERT INTO `anti_tvnet`.`Sys-TG` (`id` ,`name` ,`email` ,`admin` ,`date` ,`post`,`ip`,`time` )VALUES ('', '$name', '$email', '1', '$date', '$text', '$ip','$funtime');");
}
?>