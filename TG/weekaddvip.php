<?php
include("db.php");

if(!$cuser)
{
die("<script>alert('��� �� ����� �����')</script><script>window.location = 'index.php'</script>");
}

if($cvip == "0")
{
die("<script>alert('��� �� ������')</script><script>window.location = 'index.php'</script>");
}

$id = $_GET['id'];


if($id)
{
	$sel = mysql_query("SELECT * FROM `Sys-User-Vip` WHERE `Sys-User-Vip`.`user_id` = '{$id}'") or die("Error!");
	while($row = mysql_fetch_array($sel)) {

	$tims = (time() - $row['date'] - 604800);
	$timeleft = ($row['date'] - time());
	$left = ($tims / 24 / 60 / 60);
	$new = substr($left, 1, 2);
	$new = str_replace( '.', '', $new );
	$minus = $new*24;
	$minus2 = $new*24;
	$left2 = ($tims / 3600 + $minus2);
	$new2 = substr($left2, 1, 2);
	$left3 = ($tims / 60);
	$new3 = substr($left3, 0, 0);
	echo "<html dir='rtl'><font color='lightblue' size='5' face='David'>���� �� {$new} ���� ����� �{$new2} ���� ����� �����</font><br><br>";

	if($_POST['submit'] == "���� ����") {
	$date = $row['date'];
	$newdate = $date+604800;
	$ok = mysql_query("UPDATE `Sys-User-Vip` SET `date` = '{$newdate}' WHERE `Sys-User-Vip`.`user_id` ={$id} ;");

		if($ok != "") {
		die("<script>alert('���� ������ ��� ���� VIP')</script><script>window.location = 'vip-list.php'</script>");
		} else { die("problam"); }
	}

echo <<<EOF
<script type="text/javascript" language="JavaScript">
function tadd() {
	if (confirm("��� ���� ���� ������ ���� ���� ��� �� ��� ����?")) {
	return true;
	} else {
	alert("����, �� ��� �� �� �� ����");
	return false;
	}
}
</script>
<form action='weekaddvip.php?id=$id' method='post'>
<input onclick="return tadd();" type='submit' name='submit' value='���� ����' >
</form>
EOF;

	}
} else {
die("����� ��� ����!");
}

?>

