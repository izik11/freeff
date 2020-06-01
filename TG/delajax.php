<?php
header("Content-type: text/html; charset=windows-1255");
include("db.php");

if(!$cuser)
{
echo("אתה לא מחובר כמנהל");
die();
}

$id = $_GET['id'];
$type = mysql_real_escape_string(htmlspecialchars($_GET['type']));

if($id)
{
if($type=="Sys-Mail" && $cuser!="AnTi") { die("רק AnTi יכול למחוק מכתבים"); }
$details = mysql_query("DELETE FROM `{$type}` WHERE `{$type}`.`id` = '{$id}'") or die("Error!");
} else {
die("שגיאה אין אידי!");
}
if($details)
{
echo("נמחק בהצלחה!");
}

?> 