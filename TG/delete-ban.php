<?php
include("db.php");

if($cuser != "AnTi")
{
die("<script>alert('אתה לא מחובר כמנהל')</script><script>window.location = 'index.php'</script>");
}

$id = $_GET['id'];

if($id)
{
$details = mysql_query("DELETE FROM `Sys-Ban` WHERE `Sys-Ban`.`id` = '{$id}'") or die("Error!");  
} else {
die("שגיאה אין אידי!");
}
if($details)
{
die("<script>alert('הבאן נמחק בהצלחה!')</script><script>window.location = 'ban-list.php'</script>");
}
?>