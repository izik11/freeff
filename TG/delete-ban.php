<?php
include("db.php");

if($cuser != "AnTi")
{
die("<script>alert('��� �� ����� �����')</script><script>window.location = 'index.php'</script>");
}

$id = $_GET['id'];

if($id)
{
$details = mysql_query("DELETE FROM `Sys-Ban` WHERE `Sys-Ban`.`id` = '{$id}'") or die("Error!");  
} else {
die("����� ��� ����!");
}
if($details)
{
die("<script>alert('���� ���� ������!')</script><script>window.location = 'ban-list.php'</script>");
}
?>