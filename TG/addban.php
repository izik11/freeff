<?php
include("db.php");
if($cban == "0")
{
die("��� �� ����� ��� ���");
}

if(!$cuser)
{
die("<script>alert('��� �� ����� �����')</script><script>window.location = 'index.php'</script>");
}

$ip = $_GET['ip'];
$from = $_GET['from'];
$reason = $_GET['reason'];
$post = $_GET['post'];

if($ip != "")
{

	$check = mysql_query("SELECT * FROM `banlist` WHERE `ip`='{$ip}'");  
	if(@mysql_num_rows($check) == 0)
	{

		$add = mysql_query("INSERT INTO `banlist` (`id` ,`ip` ,`from` ,`reason` ,`post` )VALUES ('0', '{$ip}', '{$from}', '{$reason}', '{$post}');") or die(mysql_error()); 

		if($add != "")
		{
		die("<script>alert('���� ���� ������!')</script><script>history.back()</script>");
		}
	} else {
		die("<script>alert('�IP ��� ��� �� ��� ��� �� ���� ��� �� ��� ���')</script><script>history.back()</script>");	
	}
} else {
die("<script>alert('�� ����� IP')</script><script>history.back()</script>");
}
?>