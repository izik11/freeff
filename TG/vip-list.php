<?php
include("db.php");

if($cvip == "0") {
die("Error!");
}

if(!$cuser) {
die("Error Login!");
}
?>
<html>
<head>
<title>����� VIP</title>
<script type="text/javascript" language="JavaScript">
function tdelete(user_id) {
	if (confirm("��� ������ ����� ����� ���� "+ user_id +"?,\n ���� ���� ����� �� ��� ������ ������")) {
	self.location.href = "delete-vip.php?id=" + user_id;
	return true;
	} else {
	alert("�� ���� �� ������ ���");
	return false;
	}
}

function tweek(user_id) {
	if (confirm("��� ��� ���� ���� ���� ��� ������ ���� "+ user_id +" ��� ���� ViP?")) {
	self.location.href = "weekaddvip.php?id=" + user_id;
	return true;
	} else {
	alert("�� ���� ������ ��� ��� ����, ��� ���!");
	return false;
	}
}

function tsend(username,password, email) {
	if (confirm("��� ��� ���� ������� ����� ������ �� ����?")) {
	self.location.href = "mail-vip.php?user=" + username + "&pass=" + password + "&email=" + email;
	return true;
	} else {
	alert("�� ���� ������");
	return false;
	}
}
</script>
</head>
<body>
<center><font color="red" size=3><b>
<div dir="rtl">
������ ����� ����� ����� ���� Tv-NeT - Free FileFlyer<br>
����� ���� ���� �� ��� AnTi ������. �� ������� ������.<br>
<BR>
<a href="admin.php"><font color="Red" size=3>���� ����� �����</font></a> || 
<a href="../index.php"><font color="Red" size=3>���� ����</font></a><Br><BR>
���� ����� ������ �Vip ����,<br>
����� �� �� ������/����� ���� ����� ����� ����� ������<br>
����� �� ����� ������� ��� ���� �� ������ �� ������ ��� ���<br>
����� �� ����� �Delete ���� �� ������ ��VIP<BR>
�������� ������� ��� ����� �� ��� ���� ��� ���� ����<Br><Br>
����� ����� VIP: 
<form method="get" action="addvip.php?username=&password=&email=&donate=">
<table><tr><td>
�� �����: <input name="username" id="username" value="" class="skin" type="text"></td><td>
����� : <input name="password" id="password" class="skin" type="text"></td></tr><tr><td>
������ : <input name="email" id="email" class="skin" type="text"></td><td>
����� ����: <input name="donate" id="donate" class="skin" type="text"></td></tr><tr><td>
����: <input name="site" id="site" class="skin" type="text" value="fileflyer"></td><td>
<input value="���� ����� �� �VIP" class="skin" type="submit"></td></tr>
</table>
</form><br><BR>
</font></b></center></div>
<table>

<?
$ip = $_SERVER["REMOTE_ADDR"];
$details = mysql_query("SELECT * FROM `Sys-User-Vip` ORDER BY `date`");  
while($ban = mysql_fetch_array($details)) {
	$tims = (time() - $row['date'] - 604800);
	$timeleft = ($row['date'] + 604800);
	$left = ($tims / 24 / 60 / 60);
	$new = substr($left, 1, 1);
	$a = $row['date'];
	$bla = date("H:i j.n.y", $a);
echo <<<EOF
<tr><td>Id: {$ban['user_id']}</td><Td> | </td><td>user: <a href="edit-vip.php?id={$ban['user_id']}">{$ban['username']}</a></td>
<td> | </td><td>pass: <a href="edit-vip.php?id={$ban['user_id']}">{$ban['password']}</a></a></td><td> | </td>
<!-- <td>date: {$bla} </td><td | </td><Td> | </td> -->
<td>
email: <!-- <a href="mail-vip.php?email={$ban['email']}&user={$ban['username']}&pass={$ban['password']}">{$ban['email']}</a> -->
<a href="#" onclick="tsend('{$ban['username']}', '{$ban['password']}', '{$ban['email']}');">{$ban['email']}</a>
</td>
<td> | </td><td>donate: {$ban['donate']}</td><td> | </td><td>site: {$ban['site']}</td><td> | </td>
<td><a href="weekaddvip.php?id={$ban['user_id']}">Add Week</a></td>
<td> | </td><td><a href="#" onclick="tdelete('{$ban['user_id']}');">Delete</a></td>
</tr>
EOF;
}

$query = mysql_query("SELECT count(*) as total FROM `Sys-User-Vip`");
$row3 = mysql_fetch_array($query, MYSQL_ASSOC);
$total = $row3['total'];

echo "</table><br><div align=center dir=rtl> ����: $total ���� VIP ������ ����</div>";

?>

<center><font color="Red" size=3><b>
<div dir="rtl"><Br><BR>
<a href="admin.php"><font color="Red" size=3>���� ����� �����</font></a> || 
<a href="../index.php"><font color="Red" size=3>���� ����</font></a><Br><BR>
���� ����� ���� Tv-NeT - Free FileFlyer<br>
����� ���� ���� �� ��� <a href="../connect.html"><font color="Red" size=3><b>AnTi</font></b></a> ������. �� ������� ������.
</font></b></div></center></body></html>