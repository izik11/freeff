<?php 
function auth() { 
   header('WWW-Authenticate: Basic realm="AnTi Rulez"'); 
   header('HTTP/1.0 401 Unauthorized'); 
   echo "<script>alert('���� ��� ����� ����� ����� ��� ���� ��� �����?')</script><script>window.location = 'index.php'</script>"; 
   exit; 
} 
if (isset($_GET['logout'])) { 
auth(); 
} 
if ($_SERVER['PHP_AUTH_USER'] == "alonalala" && $_SERVER['PHP_AUTH_PW'] == "koksexkok") { 
    echo ("<script>alert('������ ������ ����� ������ - ��� �� �� ���� �� ���� �� ��� AnTi')</script>"); 
} 
else { 
  auth(); 
  } 
?> 
<?php
include("db.php");

if(!$cuser) {
die("<script>alert('��� �� ����� ����� - ����� ��� ���� ��')</script><script>window.location = 'index.php'</script>");
}
?>
<html dir="rtl">
<title>���� ����� ����, ���� �� ��� AnTi</title>
<Center>
<font color="red" size="7"><B><u>
���� ����� ��� </u></font><br><BR><Br>

<a href="banned-list.php"><font color="green" size="4">
����, �����, ������ �����</font></a><Br><BR>

<a href="pass-list.php"><font color="green" size="4">
����, �����, ������ �������</font></a><Br><BR>

<a href="vip-list.php"><font color="green" size="4">
����, �����, ������ ���� vip</font></a><Br><BR>

<a href="ban-list.php"><font color="green" size="4">
����, �����, ������ ������/���</font></a><Br><BR>

<a href="mail-list.php"><font color="green" size="4">
����� ������</font></a><Br><BR><br>

<a href="../checklog.php"><font color="green" size="4">
����� ����� �������</font></a><Br><BR><br>

<center><font color="Red" size=3><b>
<a href="../index.php"><font color="green" size=4>���� ����</font></a><Br><BR>
���� ����� ���� FreeFF - Free FileFlyer<br>
����� ���� ���� �� ��� <a href="../connect.html"><font color="Red" size=3><b>AnTi</font></b></a> ������. �� ������� ������.
</font></b></center></body></html>