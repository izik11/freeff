<Html dir=rtl>
<head>
<title>����� ����� ������� �����</title>
<META NAME="language" CONTENT="hebrew">
<meta http-equiv="Content-Language" content="he"> 
<meta http-equiv="Content-Type" content="text/html; charset=windows-1255"> 
<script language="javascript" type="text/javascript">
function popitup() 
{
if(confirm("��� ��� ������� ����� �� ����?")) {
a=window.open( "http://www.freeff.co.il" )
a.focus()
}
}
function help() 
{
alert("�� ���� ���� ���� �� ���� �� ��� �� �� ����� ����\n�� �� ��� ����� �� ����� �� �� ������ ����� �� �� ����\n����� ���� ������ ��� ���� ���� ������� �����\n���� �������� ����� ������ ��� �� �� ������ ����� �� ������\n�� ���� ����� �� �� ���� ��� ���� �� �� ��� ���\n�� �� ����� �� ������ �� ����");
}

function help2() 
{
alert("���� ��, ���� ������� �ie7 �� ��������� ������ ����,\n��� ���� ��� �� ����� �� �������� ����� ���� ����!\n��� �� ���!!! ��� ��� ��� ���� ���� �� ");
}
</script>

<?
include("banlist.php");
if(!($_GET["do"] == "true")) { die("������ ����"); }
if($_POST["check"] != "checku" || $_POST["checked2"] != "another") { die("������ ���� �����"); }
//if($_SERVER["HTTP_REFERER"] != "http://www.freeff.co.il/tol2.php?where=tool") { die("������ ���� ����� ����"); }

$password = mysql_query("SELECT * FROM `RSS` WHERE `vip` = '0' ORDER BY `RSS`.`id` DESC LIMIT 0 , 6");  
$rows = mysql_num_rows($password);
while($row = @mysql_fetch_array($password)) {
if ($row['Top'] == 1) { $true=1; }
}
if ( $true==1) {
echo <<<EOF

<EMBED name="musicpass" src="{$voice}" width=0 height=0 PLAYCOUNT=2 type=application/x-mplayer2 VOLUME=100 AUTOSTART=true>
<meta http-equiv="Refresh" content="300; URL=tol2.php">
<script>alert("����� ����� ����! ��� ���� ����� ����!");</script>
<body onload="popitup();">
����� ����� ���� ����! ���� ����� ����!<Br>
��� ����� ����� ����� ������� ����� ���� 5 ����!
</body>

EOF;
} else {
echo <<<EOF
<meta http-equiv="Refresh" content="50; URL=tol2.php?where=tool">
</head>
��� ���� ������� �����, ���� �� ������ �������, ��� �� ����� �� ��� �� :)<br>
<a onclick="help();"><u><font color=blue>�� ���� ����� ��� ����?</font></u></a><Br>
<a onclick="help2();"><u><font color=blue>�� �� ��� ���� ��</font></u></a><Br>
<a href=http://www.freeff.co.il target=_blank><u><font color=blue>����� ����</font></u></a><Br>
<iframe src="http://www.freeff.co.il/index.php?err=8"></iframe>
EOF;
}

?>