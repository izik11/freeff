<?php
include("db.php");

if(!$cuser)
{
die("<script>alert('��� �� ����� �����')</script><script>window.location = 'index.php'</script>");
}

$id = $_GET['id'];

if($id)
{
$details = mysql_query("DELETE FROM `banlist` WHERE `banlist`.`id` = '{$id}'") or die("Error!");  
} else {
die("����� ��� ����!");
}
if($details)
{
die("<script>alert('���� ���� ������!')</script><script>window.location = 'banned-list.php'</script>");
}
?>