<?php
include("db.php");

if($cuser != "AnTi")
{
die("<script>alert('��� �� ����� �����')</script><script>window.location = 'index.php'</script>");
}

$id = $_GET['id'];
$before = $_POST['before'];
$after = $_POST['after'];
$test = $_POST['test'];

if($id)
{
$details = mysql_query("SELECT * FROM `Sys-Ban` WHERE `Sys-Ban`.`id` = '{$id}'") or die("Error!");  
	while($row = mysql_fetch_array($details)) {

		if($_POST['submit'] == " ���� ") {
		$ok = mysql_query("UPDATE `Sys-Ban` SET `before` = '{$before}',`after` = '{$after}',`test` = '{$test}' WHERE `Sys-Ban`.`id` ={$id} ;");
		}
		if($ok != "") {
		die("<script>alert('� id {$id} ����� ������')</script><script>window.location = 'ban-list.php'</script>");
		}

echo <<<EOF
	<html dir="rtl">
	<title>�����</title>
<center><font color="red" size=3><b>
<div dir="rtl">
������ ����� ����� ����� ���� Tv-NeT - Free FileFlyer<br>
����� ���� ���� �� ��� AnTi ������. �� ������� ������.<br>
<BR>
<a href="ban-list.php"><font color="Red" size=3>���� ������</font></a> || 
<a href="admin.php"><font color="Red" size=3>���� ����� �����</font></a> || 
<a href="../index.php"><font color="Red" size=3>���� ����</font></a><Br><BR>
��� ���� ����� �� ���� �����<Br><BR>
</font></b></center></div>
	<div align="center">
	<form action="edit-ban.php?id={$row['id']}" method="post">
	<table border=0 cellspacing=5 cellpadding=0>
	<tr>
	<td width=100>
	<b>����:</b>
	</td>
	<td width=300>
	<input type="text" name="before" value="{$row['before']}">
	</td>
	</tr>
	<tr>
	<td width=100>
	<b>����:</b>
	</td>
	<td width=300>
	<input type="text" name="after" value="{$row['after']}">
	</td>
	</tr>
	<tr>
	<td width=100>
	<b>���:</b>
	</td>
	<td width=300>
	<input type="text" name="test" value="{$row['test']}">
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
<a href="ban-list.php"><font color="Red" size=3>���� ������ ������</font></a> || 
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