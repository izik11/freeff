<?php
header("Content-type: text/html; charset=windows-1255");
include("db.php");

if(!$cuser)
{
echo("��� �� ����� �����");
die();
}

$id = $_GET['id'];
$type = mysql_real_escape_string(htmlspecialchars($_GET['type']));

if($id)
{
if($type=="Sys-Mail" && $cuser!="AnTi") { die("�� AnTi ���� ����� ������"); }
$details = mysql_query("DELETE FROM `{$type}` WHERE `{$type}`.`id` = '{$id}'") or die("Error!");
} else {
die("����� ��� ����!");
}
if($details)
{
echo("���� ������!");
}

?> 