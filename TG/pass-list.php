<?php
include("../banlist2.php");

if($cban == "0") {
die("Error!");
}

if(!$cuser) {
die("Error Login!");
}
?>
<html><head>
<title>����� �������</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1255"> 
<script type="text/javascript" language="JavaScript">
function tdelete(id) {
	if (confirm("��� ������ ����� �� ����� ���� " + id + " ?\n ���� ���� ����� �� ��� ������ ������")) {
	self.location.href = "delete-pass.php?id=" + id;
	return true;
	} else {
	alert("�� ���� �� ���� ���");
	return false;
	}
}
</script>
<body>
<center><font color="red" size=3><b>
<div dir="rtl">
������ ����� ����� ����� ���� Tv-NeT - Free FileFlyer<br>
����� ���� ���� �� ��� AnTi ������. �� ������� ������.<br>
<BR>
<a href="admin.php"><font color="Red" size=3>���� ����� �����</font></a> || 
<a href="../index.php"><font color="Red" size=3>���� ����</font></a><Br><BR>
���� ����� �������� ����,<br>
����� �� Edit ���� ����� ����� ����� ������<br>
����� �� ����� �Delete ���� �� ������<BR>
�������� ������� ����� ����<Br><Br>
</font></b></center></div>

<table>
<?
$password = mysql_query("SELECT * FROM `RSS` ORDER BY `RSS`.`id` DESC LIMIT 0 , 500");  
while($ban = @mysql_fetch_array($password)) {
$time = $ban['time'];
$time = str_replace( '����', ',', $time );
echo <<<EOF
<Tr><Td>ID: {$ban['id']}</td><td> | </td>
<Td>Pass: {$ban['password']}</td><td> | </td>
<td>By:</td><td>{$ban['by']}</td><td> | </td>
<td>Time:</td><td>{$time}</td><td> | </td>
<Td>Top:</td><td>{$ban['Top']}</td><td> | </td>
<Td>Vip:</td><td>{$ban['vip']}</td><td> | </td>
<td>Max:</td><td>{$ban['max']}<td><td> | </td>
<td>Site:</td><td>{$ban['site']}<td>

<td> || </td><td><a href="edit-pass.php?id={$ban['id']}">Edit</a></td>
<td> | </td><td>
<a href="#" onclick="tdelete('{$ban['id']}');">Delete</a>
</td></tr>
EOF;
}
?>
</table>
<center><font color="Red" size=3><b>
<div dir="rtl"><Br><BR>
<a href="admin.php"><font color="Red" size=3>���� ����� �����</font></a> || 
<a href="../index.php"><font color="Red" size=3>���� ����</font></a><Br><BR>
���� ����� ���� Tv-NeT - Free FileFlyer<br>
����� ���� ���� �� ��� <a href="../connect.html"><font color="Red" size=3><b>AnTi</font></b></a> ������. �� ������� ������.
</font></b></div></center></body></html>