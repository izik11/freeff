<html dir=rtl>
<?
include("db.php");
if($_POST['pas'] != "" && $_POST['submit'] == "���") {
$add = mysql_query("INSERT INTO `openpass` (`id` ,`pass` ,`active` )VALUES ('', '{$_POST['pas']}', '1');"); 
if($add) { die("<script>alert('������ �����');</script>"); } 
}

if($_POST['submit2']=="���!" && $_POST['pas2'] != "" && $_POST['active'] != "" && $_POST['id2'] != "") {
$add = mysql_query("UPDATE `openpass` SET `pass` ='".$_POST['pas2']."',`active`='".$_POST['active']."'  WHERE `id` ={$_POST['id2']} ;"); 
die("����� ������");
}

if($_GET['edit'] != "") {
	$details = mysql_query("SELECT * FROM `openpass` WHERE `id`=".$_GET['edit'] ) or die("Error!");  
	while($row = mysql_fetch_array($details)) {
echo <<<EOF
		<form method=post>
		<input type=text value="{$row['pass']}" name=pas2>
		<input type=text value="{$row['active']}" name=active>
		<input type=hidden value="{$_GET['edit']}" name=id2>
		<input type=submit name=submit2 value="���!">
		</form>
EOF;
die();
	}

}
?>
����� ����� ������ ����� �������!<Br>
���� �� ������ ��� ���:
<form method=post>
<input type=text name=pas>
<Br><input type=submit name=submit value="���"></form>

<br><BR>����� ������� ������:<br>
<?

$details = mysql_query("SELECT * FROM `openpass` WHERE `active`='1' ") or die("Error!");  
while($row = mysql_fetch_array($details)) {
echo <<<EOF
<a href="?edit={$row['id']}">{$row['pass']}</a><br>
EOF;
}

?>