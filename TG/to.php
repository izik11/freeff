<?php
include("db.php");

if(!$cuser)
{
die("<script>alert('��� �� ����� �����')</script><script>window.location = 'index.php'</script>");
}

$name="���� ������";
$email="idonthave";
$funtime = time();
$time66 = time();
$correct_time66 = $time66 + $badate;
$date = date("H:i , j.n.y", $correct_time66);
$ip="no-ip-4-me";
/*
$text="�����, ����� �� �������� ����!!! ����� ��� ��� ����� ��� ������� �����!!<BR>
����� ����� ��� ������� ���� ������ �� �������� ����... �� ����� ��� ��� ��� ��� ����� ����� �������� �������!! <br>
��� ����� ��� ����? �� ��� ��! �� �����, ������ ����� ��� ��� ����� ��� ���� �������!!!<BR>
��� �� �� ����� ����� �� ���� �������� ������ ����� ������� ����� ����� :)

<b><center>
<script type= "text/javascript" language="javascript" src="http://live.sekindo.com/live/liveView.php?s=2659"></script>
<br>
</b></center>

";*/

$text="�����, �� ��� ����� ����� ����, �� ���� ����, ����� �� �������� ���� �����!<br>
������ �� ��� ������, �� ����� ��� ���, ������ �� ���� ������, �� ����!<br>
�� �� ����� ����� ��� ����, �� ���� ���� �� ������ ������ (����� ������ �������)<br>
��.. ��� ����� ��� ����? �� ��, ��� ��� �����?! ������� ���� ��� ��������!!";

$text2='
<center>
<script type="text/javascript" language="javascript" src="http://live.sekindo.com/live/liveView.php?s=9337"></script><br> 
</center>
';
if($_GET['who'] == 2) { 
	$ok2 = mysql_query("INSERT INTO `Sys-TG` (`id` ,`name` ,`email` ,`admin` ,`date` ,`post`,`ip`,`time` )VALUES ('0', 'AnTi-BoT', '$email', '1', '$date', '$text2', '$ip','$funtime');");
} else { 
	if($_GET['who']==1) {
		echo " <script>window.location='delban.php?bot=1';</script>";
	} else {
		if($_GET['who']==3) { 
			$ok = mysql_query("INSERT INTO `Sys-TG` (`id` ,`name` ,`email` ,`admin` ,`date` ,`post`,`ip`,`time` )VALUES ('0', '$name', '$email', '0', '$date', '$text', '$ip','$funtime');");
		}
	}
}

if($ok != "" || $ok2 != "")
{
die("<script>alert('������ ����� ������')</script><script>window.location='../tg.php'</script>");
}


?>