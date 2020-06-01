<?php

//include("../banlist.php");



$agent = $_SERVER['HTTP_USER_AGENT'];
$ip = $_SERVER['REMOTE_ADDR'];
$q = mysql_query("SELECT * FROM `Sys-onlines` WHERE ip = '$ip' ");
$time = time();
if(@mysql_num_rows($q) == 0)
{
 mysql_query("INSERT INTO `Sys-onlines` (date , ip, agent) VALUES ('$time' , '$ip', '$agent') ") OR die(mysql_error());
$new1=1;
}
else
{
 mysql_query("UPDATE `Sys-onlines` SET date = '$time' WHERE ip = '$ip' ") OR die ('#2');
$new1=0;
}
$min = 5;
$limit = 60 * $min;
mysql_query("DELETE FROM `Sys-onlines` WHERE UNIX_TIMESTAMP() - date > $limit ") OR die ('#3');  

$total_q = mysql_query("SELECT * FROM `Sys-onlines`") OR die ('#3');
$total_users = number_format(mysql_num_rows($total_q));

$string = "$total_users";

echo $string;
?>