<?php
include("db.php");

if($cban == "0") {
die("Error!");
}

if(!$cuser) {
die("Error Login!");
}
?>
<html><head>
<title>����� ������ ������ ���������</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1255"> 
<script type="text/javascript" language="JavaScript">
function tdelete(id) {
	if (confirm("��� ������ ����� �� " + id + " ?\n ���� ���� ����� �� ��� ������ ������")) {
	self.location.href = "delete-ban.php?id=" + id;
	return true;
	} else {
	alert("�� ���� �� ��");
	return false;
	}
}
</script>

<body>
<center><font color="red" size=3><b>
<div dir="rtl">
������ ����� ����� ����� ���� FreeFF - Free FileFlyer<br>
����� ���� ���� �� ��� AnTi ������. �� ������� ������.<br>
<BR>
<a href="admin.php"><font color="Red" size=3>���� ����� �����</font></a> || 
<a href="../index.php"><font color="Red" size=3>���� ����</font></a><Br><BR>
���� ����� ������ ���������� ���������� ����,<br>
test=0 - ����� �����<BR>
test=1 - ����� �� �������<br>
test=2 - ��� �������<br>
test=3 - ����� �������� ������ �� ������ ��� ���<br>
test=4 - ���� ������<br>
test=5 - ����� ����� ���� ����<Br><Br>
<form method="get" action="addb.php?before=&after=&test=">
����: <input name="before" id="before" value="" class="skin" type="text">
����: <input name="after" id="after" value="" class="skin" type="text">
���: <input name="test" id="test" value="" class="skin" type="text">
<input value="Add" class="skin" type="submit">
</form>
<br><Br>
</font></b></center></div>
<table border=1>
<?

$details = mysql_query("SELECT * FROM `Sys-Ban` ORDER BY `test`");  
while($ban = mysql_fetch_array($details)) {
$b4 = mysql_real_escape_string(htmlspecialchars($ban['before']));
$af = mysql_real_escape_string(htmlspecialchars($ban['after']));
echo <<<EOF
<tr><td>before: <a href="edit-ban.php?id={$ban['id']}">{$b4}</a></td>
<td>after: <a href="edit-ban.php?id={$ban['id']}">{$af}</a></td>
<td>test: {$ban['test']}</td>
<td><a href="#" onclick="tdelete('{$ban['id']}');">Delete</a></td></tr>
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