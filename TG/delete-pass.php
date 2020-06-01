<?php
include("db.php");

if(!$cuser)
{
die("<script>alert('You aren't login at admin  אתה לא מחובר כמנהל')</script><script>window.location = 'index.php'</script>");
}

$id = $_GET['id'];

if($id)
{
$details = mysql_query("DELETE FROM `RSS` WHERE `RSS`.`id` = '{$id}'") or die("Error!");  
} else {
die("שגיאה אין אידי!");
}
if($details)
{
die("<script>alert('הסיסמא נמחקה בהצלחה!')</script><script>window.location = 'pass-list.php'</script>");
}
?>