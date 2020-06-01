<?php
include("db.php");

if($cuser != "AnTi")
{
die("<script>alert('ניסיון נחמד טמבל')</script><script>window.location = 'adminon.php'</script>");
}

$id = $_GET['id'];

if($id)
{
$details = mysql_query("DELETE FROM `adminon` WHERE `adminon`.`time` = '{$id}'") or die("Error!");  
} else {
die("שגיאה אין אידי!");
}
if($details)
{
die("<script>alert('הבאן נמחק בהצלחה!')</script><script>window.location = 'adminon.php'</script>");
}
?>