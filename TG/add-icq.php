<?
include("db.php");
if(!$cuser)
{
die("<script>alert('��� �� ����� �����')</script><script>window.location = 'index.php'</script>");
}

if($_POST['submit'] && $_POST['anp'] == "yes")
{
	$num = mysql_real_escape_string(htmlspecialchars($_POST['num']));
	$pass = mysql_real_escape_string(htmlspecialchars($_POST['pass']));
	$time2 = time();
$time66 = time();
$correct_time66 = $time66 + $badate;
$date2 = date("H:i , j.n.y", $correct_time66);
$date3 = date("j.n.y ���� H:i", $correct_time66);

	$by = mysql_real_escape_string(htmlspecialchars($_POST['by']));
	$sifra = mysql_real_escape_string(htmlspecialchars($_POST['sifra']));

$check2 = mysql_query("SELECT * FROM `icq` WHERE `num`='{$num}'");  

if(@mysql_num_rows($check2) == 0) {
	$ok = mysql_query("INSERT INTO `icq` (`id` ,`num` ,`by` ,`vip` ,`took` ,`date` ,`time` ,`pass` ,`sifra` )VALUES (NULL , '{$num}', '{$by}', '0', '0', '{$time66}', '{$date3}', '{$pass}', '{$sifra}');");

	$ok2 = mysql_query("INSERT INTO `gilronen_tgova`.`Sys-TG` (`id` ,`name` ,`email` ,`admin` ,`date` ,`post`,`ip`,`time` )VALUES ('', '{$cuser}', 'autopass@tv-net.co.il', '1', '$date2', '���� ���� ICQ ��� ���� ���� ������ {$by} ���� ��� ���� ������ ��� ���� ���� ��� ����� ���� �����!', 'no-ip-4-me','0');");

	if($ok)
	{
	die("<script>alert('������ ����� ������ ������')</script><script>window.location = ''</script>");
	}
} else {
die("<script>alert('�� ��� ����� ���� ������ ��� �� ���� ������ ���� ���')</script><script>history.back()</script>");
}
}
?>
<html dir=rtl>
<script type="text/javascript" language="JavaScript">
function r() {
document.icq.sifra.value= document.icq.num.value.length;
return true;
}

function sub() {
num = document.icq.num.value
if(num == "") {
alert('��� ����� ���');
return false;
} 
pass = document.icq.pass.value
if(pass == "") {
ar = num.split(';');
if(ar[1] == undefined) { 
alert('�����');
return false;
}
document.icq.num.value = ar[0];
document.icq.pass.value = ar[1];
}
by = document.icq.by.value
if(by == "") {
document.icq.by.value = "���� ����";
}
r();
return true;
}
</script>

<form action="?" method="post" name="icq" onsubmit="return sub();">
		<table style="border:solid 1px #e1e1e1;background-color:#787878;font-size:11px;" cellspacing="0" cellpadding="0"  id="table2" width="437">
		<tr>
		<tr><td width="94">����:</td>
			<td width="341">
		<input type="text" style="width:100%" maxlength="50" name="num" dir=ltr></td></tr>
		</tr>

		<tr><td width="94">�����:</td>
			<td width="341">
		<input type="text" style="width:100%" maxlength="50" name="pass"></td>
		</tr>
		<tr><td width="94">�"�:</td>
			<td width="341">
		<input type="text" style="width:100%" maxlength="50" name="by"></td>
		</tr>


		<input type="hidden" maxlength="1" name="sifra">


			<td colspan="2" align="center">
<input type="hidden" name="anp" value="yes">  
<input type="submit" name="submit" value="��� ����� ����"> </td></tr>
		</tr>
		</table>