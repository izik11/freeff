<?php
include("db.php");

if($cdelete == "0")
{
die("<h1>��� �� ���� ������ ������</h1>");
}

if(!$cuser)
{
die("<script>alert('You aren't login at admin  ��� �� ����� �����')</script><script>window.location = 'index.php'</script>");
}




$id = $_GET['id'];

if($id)
{
$details = mysql_query("DELETE FROM `Sys-TG` WHERE `Sys-TG`.`id` = '{$id}'") or die("Error!");  
} else {
die("����� ��� ����!");
}
if($details)
{
die("<script>history.back()</script>");
}
?>