<?php
include("db.php");

$id=htmlspecialchars($_GET['prob']);
$id = intval($id);
if(!($id > 1 && $id < 6)) { die("����"); }
$email=htmlspecialchars($_GET['email']);
$by=htmlspecialchars($_GET['by']);
$res=htmlspecialchars($_GET['res']);
$pas=htmlspecialchars($_GET['pas']);
$note=htmlspecialchars($_GET['note']);
echo <<<EOF
<html dir=rtl>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1255"> 
<title>����� � FreeFF.Co.iL Free FileFlyer</title>
EOF;

if($id = "5") {
die("
���� ����: {$email}<Br><br>
�����: ���� �� ������ � FreeFF ��..<Br><br>
��� ������� �� �� ������ �����: {$pas} �� ������ VIP, ��� ��� ����� �� FF �� ��� ���� VIP. <br> ��� ��� ��� ����� �����! ����� ������: {$note} ���� �� ��� �����: {$by} 
<BR><BR><Br>
<a href='../index.php'>���� ����</a>
");
}


echo <<<EOF
���� ����: {$email}<BR><Br>
�����: ������ �����: {$pas} ���� �����<BR><Br>
���� ��, ��� ������� �� ������ ����� ��� ����� ������, ������ ������� ���: {$res} ������ �������: {$pas} ��� ��� ��� ����� �����! ����� ������: {$note} ���� �� ��� �����: {$by}
<BR><BR><Br>
<a href="../index.php">���� ����</a>

EOF;

?>