<?php
include("db.php");

if(!$cuser)
{
die("<script>alert('��� �� ����� �����')</script><script>window.location = 'index.php'</script>");
}

$id = $_GET['id'];
$pass = $_POST['pass'];
$by = $_POST['by'];
$vip = $_POST['vip'];
$top = $_POST['top'];
$site = $_POST['site'];
$max = $_POST['max'];


if($id)
{
$details = mysql_query("SELECT * FROM `RSS` WHERE `RSS`.`id` = '{$id}'") or die("Error!");  
	while($row = mysql_fetch_array($details)) {

		if($_POST['submit'] == " ���� ") {
		$ok = mysql_query("UPDATE `RSS` SET `password` = '{$pass}',`by` = '{$by}',`max` = '{$max}',`Top` = '{$top}',`vip` = '{$vip}',`site` = '{$site}' WHERE `RSS`.`id` ={$id} ;");
		}
		if($ok != "") {
		die("<script>alert('������ {$id} ������ ������')</script><script>window.location = 'pass-list.php'</script>");
		}

echo <<<EOF
	<html dir="rtl">
	<title>����� �����</title>
<center><font color="red" size=3><b>
<div dir="rtl">
������ ����� ����� ����� ���� Tv-NeT - Free FileFlyer<br>
����� ���� ���� �� ��� AnTi ������. �� ������� ������.<br>
<BR>
<a href="pass-list.php"><font color="Red" size=3>���� ������ ��������</font></a> || 
<a href="admin.php"><font color="Red" size=3>���� ����� �����</font></a> || 
<a href="../index.php"><font color="Red" size=3>���� ����</font></a><Br><BR>
��� ���� ����� �� ������ �����<Br>
����� �VIP ���� vip = 1 = ��<br>
vip = 0 = �� - ������ �������<Br><BR>
</font></b></center></div>
	<div align="center">
	<form action="edit-pass.php?id={$row['id']}" method="post">
	<table border=0 cellspacing=5 cellpadding=0>
	<tr>

	<td width=100><b>������:</b></td>

	<td width=300><input type="text" maxlength="800" name="pass" value="{$row['password']}" size=50></td>
	</tr>
	<tr>
	<td width=100>
	<b>�� ���:</b>
	</td>
	<td width=300>
	<input type="text" maxlength="50" name="by" value="{$row['by']}">
	</td>
	</tr>
	<tr>
	<td width=100>
	<b>vip:</b>
	</td>
	<td width=300>
	<input type="text" maxlength="50" name="vip" value="{$row['vip']}">
	</td>
	</tr>
	<tr>
	<td width=100>
	<b>�����:</b>
	</td>
	<td width=300>
	<input type="text" maxlength="50" name="top" value="{$row['Top']}">
	</td>
	</tr>
	<tr>
	<td width=100>
	<b>���:</b>
	</td>
	<td width=300>
	<input type="text" maxlength="50" name="site" value="{$row['site']}">
	</td>
	</tr>
	<tr>
	<td width=100>
	<b>������� ������:</b>
	</td>
	<td width=300>
	<input type="text" maxlength="50" name="max" value="{$row['max']}">
	</td>
	</tr>
	<tr>
	<td colspan=2>
	<table width=100% border=0 cellspacing=0 cellpadding=3>
	<tr>
	<td width=100% align="center">
	<input type="submit" name="submit" value=" ���� "></td>
	</tr>
	</table>
	</td>
	</tr>
	</table>
	</form>
	</div>
<center><font color="Red" size=3><b>
<div dir="rtl"><Br><BR>
<a href="pass-list.php"><font color="Red" size=3>���� ������ vip</font></a> || 
<a href="admin.php"><font color="Red" size=3>���� ����� �����</font></a> || 
<a href="../index.php"><font color="Red" size=3>���� ����</font></a><Br><BR>
���� ����� ���� Tv-NeT - Free FileFlyer<br>
����� ���� ���� �� ��� <a href="../connect.html"><font color="Red" size=3><b>AnTi</font></b></a> ������. �� ������� ������.
</font></b></div></center>
	</html>
EOF;
}
}
?>