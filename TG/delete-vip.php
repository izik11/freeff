<?php
include("db.php");

if(!$cuser)
{
die("<script>alert('אתה לא מחובר כמנהל')</script><script>window.location = 'index.php'</script>");
}

$id = $_GET['id'];

if($id)
{
$details = mysql_query("DELETE FROM `Sys-User-Vip` WHERE `Sys-User-Vip`.`user_id` = '{$id}'") or die("Error!");  
} else {
die("שגיאה אין אידי!");
}
if($details)
{
die("<script>alert('המשתמש נמחק בהצלחה!')</script><script>window.location = 'vip-list.php'</script>");
}
?>