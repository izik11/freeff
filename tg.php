<?php
//ob_start();
//session_start();
include("banlist.php");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" >
<html dir="rtl">
<head>
<?php
//@session_start();
include("db.php");

$page = (int) $_GET['page'];

if($page>2000000000 || $page<1)
{
$page=1;
}
?>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1255">
<title>Free FileFlyer - ����� ������� �� ���� ���� <? echo $page; ?></title>
<link rel="stylesheet" type="text/css" href="css.css">
<script type="text/javascript" src="tg.js"></script>
<script type="text/javascript" language="JavaScript">
<?php
//include("date.php");
?>
</script>
<meta http-equiv="Refresh" content="300; URL=tg.php">
</head>
<body style="font-family:Arial, Helvetica, sans-serif;font-size:11px; background-color: #C7D985" alink="black" vlink="black" link="black">

<?
$per_page = 15;
$pr_page = 15;
$pr_start = $pr_page * $pr_page;
$start = ($page-1) * $per_page;

$query = mysql_query("SELECT count(*) as total FROM `Sys-TG`") or die(mysql_error());
$row = mysql_fetch_array($query, MYSQL_ASSOC);
$total_num = $row['total'];

$vipcheck = mysql_query("SELECT * FROM `Sys-Passwords` WHERE `ip`='{$ip}'");  
if(@mysql_num_rows($vipcheck) >= 1)
{
$checkvip = "<br><a href=\"javascript:void(0);\" onclick=\"vip();\"><font size=\"2\" color=\"orange\"><b>VIP Zone</b></font></a>";
}

if(!$cuser)
{
echo <<<EOF
<div align="center"><table bgcolor="white"><tr><td align="center"><a href='JavaScript:ShowHide("Admin")'><font size="2" color="black"><b>������� ������</b></font></a> <font size="2">::</font> <a onclick='ShowHide("Admin4")' href="#Vip"><font size="2" color="darkblue"><b>������� VIP</b></font></a> <font size="2">::</font>  <a href="#Send"><font size="1" color="#1346AC">��� �����</font></a>{$checkvip}<br><!--<b>���� ����� : </b><span id="time"></span><br><b>���� ��� : </b><span id="time2"></span><br><font size="1"><b>����� ������� ���� �7 ����</b></font><br>-->
<!--<a href="index-old.php"><font color="green"><b>����� ������ ������� ���� ���� ���</b></font></a><br>-->
<a href="javascript:void(0);" onclick="vip();"><font size="2" color="orange"><b>VIP Zone</b></font></a><br><font size="1" color="blue"><b>�� ��� ������ ������ : {$total_num}</b></font></td></tr></table></div>
EOF;
}
if($cuser)
{
echo <<<EOF
<div align="center"><table bgcolor="white"><tr><td align="center">
<a onclick='ShowHide("Admin2")' href="#Logout"><font size="2" color="black"><b>�������</b></font></a> <font size="2">::</font> 
<a href='TG/admin.php' target='_blank'><font size="2" color="blue">���� �����</font></a> :: 
<!--<a onclick='ShowHide("Admin4")' href="#Vip"><font size="2" color="darkblue"><b>������� VIP</b></font></a> <font size="2">::</font>--> 
<a href="#Send"><font size="2" style="color:#1346AC;cursor:pointer">��� �����</font></a> :: 
<a onclick='ShowHide("Admin3")' href="#Add"><font size="2" color="red">���� �����</font></a> :: <a href="javascript:void(0)" onclick="vip();"><font size="2" color="orange">ViP Zone</font></a><br><!--<b>���� ����� : </b><span id="time"></span><br><b>���� ��� : </b><span id="time2"></span><br><font size="2"><b>����� ������� ���� �7 ���� | <a href="index.php"><font color="black">���� ���� ��!</font></a></b></font><br>-->
<!--<a href="index-old.php"><font color="green"><b>����� ������ ������� ���� ���� ���</b></font></a><br>-->
<font color="blue"><b>�� ��� ������ ������ : {$total_num}</b></font> &nbsp; &nbsp; <a href="TG/to.php?who=1"><font color="green" size="2"><b>����</b></font></a> | <a href="TG/to.php?who=2"><font color="green" size="2"><b>������</b></font></a></div></td></tr></table></div>
EOF;
}
?>
<table style="border:0;width: 100%" cellspacing="0" cellpadding="0" class="table2" id="table1">
<?php
/*if($cuser)
{
$details = mysql_query("SELECT * FROM `Sys-Passwords` WHERE user='$cuser'");  
while($user = mysql_fetch_array($details))
}*/

$query = mysql_query("SELECT * FROM `Sys-TG` ORDER BY `Sys-TG`.`id` DESC LIMIT $start, $per_page");
while($row = mysql_fetch_array($query)) {
	$passwords = mysql_query("SELECT * FROM `Sys-User-Vip` WHERE username='{$row[name]}' AND email='{$row[email]}'");  
	if(@mysql_num_rows($passwords) == 0)
	{
	$color = "\"#000\"";
	$line['1'] = "";
	$line['2'] = "";
	$donkey = "";
	} else if(@mysql_num_rows($passwords) == 1){
		while($iper = mysql_fetch_array($passwords)) {
		$color = "darkgreen";
		$line['1'] = "";
		$line['2'] = "";
		$donkey = "<div align=\"center\"><font color=darkgreen><b>����� �� ��� ����� ���� ����</b></font><br><font color=black><b>������ ���� ���: {$iper['donate']}. </b><font color=darkred><b>���� {$iper['site']}</font></font></div>";
		}
	} else if(@mysql_num_rows($passwords) >= 2 && @mysql_num_rows($passwords) <= 5){
		$color = "orange";
		$donkey = "<div align=\"center\"><font color=orange><b>����� �� ��� ���� ������ ��� ���� ����</b></font><br><font color=black><b>�������� ���� ���: ";
		$c = 0;
		while($iper = mysql_fetch_array($passwords)) {
		if($c != 0) {
		$donkey .= ", ";
		$c = 0;
		}
		$donkey .= "{$iper['donate']}";
		$c = $c + 1;
		}
		$donkey .= ".</font></b></div>";
	} else if(@mysql_num_rows($passwords) >= 5){
		$color = "#d1d1d1";
		$line['1'] = "";
		$line['2'] = "";
		$donkey = "<div align=\"center\"><font color=#d1d1d1><b>����� �� ��� ���� �5 ������� ���� ����</b></font><br><font color=black><b>�������� ���� ���: ";
		$d = 0;
		while($iper = mysql_fetch_array($passwords)) {
		if($d != 0) {
		$donkey .= ", ";
		$d = 0;
		}
		$donkey .= "{$iper['donate']}";
		$d = $d + 1;
		}
		$donkey .= ".</font></b></div>";
	}
	$checkbanned = mysql_query("SELECT * FROM `banlist` WHERE ip='{$row[ip]}'");  
	if(@mysql_num_rows($checkbanned) >= 1)
	{
	$color = "\"#005408\"";
	$line['1'] = "<s>";
	$line['2'] = "</s>";
	}
if($cedit == "1")
{
$adfs=$row['id'];
$edit =  "<a href=\"TG/edit.php?id={$row['id']}\">Edit</a>";
$addmsg = ":: <a href='JavaScript:ShowHide(\"M-{$row['id']}\")'>Add Message</a>";
$adms = "<form method=\"get\" action=\"TG/addmsg.php?id={$row['id']}&from={$cuser}&message=\">
<input name=\"id\" id=\"id\" value=\"{$row['id']}\" class=\"skin\" type=\"hidden\">
<input name=\"from\" id=\"from\" value=\"{$cuser}\" class=\"skin\" type=\"hidden\">
Message : <input name=\"message\" id=\"message\" class=\"skin\" type=\"text\">
<input value=\"Add Message\" class=\"skin\" type=\"submit\">
</form>
";
}
if($cdelete == "1")
{
$delete = ":: <a href=\"#\" onclick=\"tdelete('{$row['id']}');\">Delete</a>";
}
if($cip == "1")
{
$showip = " :: ����� : {$row['ip']} ";
$showemail = " {$row['email']} ";
}
if($cban == "1")
{
$addban = ":: <a href='JavaScript:ShowHide(\"B-{$row['id']}\")'>Add Ban</a>";
$adban = "<form method=\"get\" action=\"TG/addban.php?ip={$row['ip']}&nick={$row['name']}&from=&reason=&post={$row['post']}\">
<input name=\"ip\" id=\"ip\" value=\"{$row['ip']}\" class=\"skin\" type=\"hidden\">
<input name=\"post\" id=\"post\" value=\"{$row['post']}\" class=\"skin\" type=\"hidden\">
<input name=\"from\" id=\"from\" value=\"{$cuser}\" class=\"skin\" type=\"hidden\">
<input name=\"nick\" id=\"nick\" value=\"{$row['name']}\" class=\"skin\" type=\"hidden\">
Reason : <input name=\"reason\" id=\"reason\" class=\"skin\" type=\"text\">
<input value=\"Add Ban\" class=\"skin\" type=\"submit\">
</form>
";
}
if($cvip == "1")
{
$addvip = ":: <a href='JavaScript:ShowHide(\"V-{$row['id']}\")'>Add Vip</a>";
$advip = "<form method=\"get\" action=\"TG/addvip.php?username=&password=&email=&donate=\">Username: <input name=\"username\" id=\"username\" value=\"\" class=\"skin\" type=\"text\"><br>Password : <input name=\"password\" id=\"password\" class=\"skin\" type=\"text\"><br>Email : <input name=\"email\" id=\"email\" class=\"skin\" type=\"text\"><br>Donate: <input name=\"donate\" id=\"donate\" class=\"skin\" type=\"text\"><br>
<input value=\"Add Vip\" class=\"skin\" type=\"submit\">
</form>";
}
if($row['admin'] == "2") {
echo <<<END
<tr>
<td style="padding-top:2px;padding-bottom:2px; font-size:11px;" valign="top" width="100%"><div style="color: black"><b>
{$row['id']}. 
��: </b><a href='JavaScript:ShowHide("{$row['id']}")'>
<span dir="rtl"><b><font color="blue">{$row['name']}</font></b></span></a> 
<span dir="ltr" style="color:black;">{$row['date']} ::</span>
<span dir="rtl" style="color:black;">{$edit}{$delete}</span>
<div dir="rtl" style="color:black;border:solid 2px #cdcdcd;background-color:#116580;margin-bottom:3px;padding:3px; font-size:11px;" id="{$row['id']}">
<b>{$row['post']}</b>
<br>
<b>����� ��� ����� ������ ����.</b>
</div>
</div>
</td>
</tr>
END;
} else if($row['admin'] == "1") {
echo <<<END
<tr>
<td style="padding-top:2px;padding-bottom:2px; font-size:11px;" valign="top" width="100%"><div style="color:black;">
{$row['id']}. <b>
��: </b><a href='JavaScript:ShowHide("{$row['id']}")'>
<span dir="rtl"><b><font color="red">{$row['name']}</font></b></span></a>
</a> 
<span dir="ltr" style="color:black;">{$row['date']} ::</span>
<span dir="rtl" style="color:black;">{$edit}{$delete}</span>
<div class="admin" dir="rtl" style="color:#cdcdcd;border:solid 2px #cdcdcd;background-color:#116580;margin-bottom:3px;padding:3px; font-size:11px;" id="{$row['id']}">
{$row['post']}
<br><div align="center">
<b>����� ��� ����� ������ ����.</b>
</div>
</div>
</td>
</tr>
END;
} else {
echo <<<END
<tr>
<td class="showname" style="padding-top:2px;padding-bottom:2px; font-size:11px;" valign="top" width="100%"><div style="color:black;">
{$row['id']}. <b>
��: </b><a href='JavaScript:ShowHide("{$row['id']}")'>
<span dir="rtl"><b>{$line["1"]}<font color={$color}>{$row['name']}</font>{$line["2"]}</a></b></span>
</a> 
<span dir="ltr" style="color:black;">{$row['date']} :: {$showemail}</span>
<span dir="rtl" style="color:black;">{$edit}{$delete}{$addmsg}{$showip}{$addban}{$addvip}{$addvipever}</span>
<table>
<tr align="center">
<td align="right">
<span dir="rtl" style="display:none; color:black;padding-top:2px;padding-bottom:2px;font-size:11px;" id="V-{$row['id']}">{$advip}</span>
<span dir="rtl" style="display:none; color:black;padding-top:2px;padding-bottom:2px;font-size:11px;" id="M-{$row['id']}">{$adms}</span>
<span dir="rtl" style="display:none; color:black;padding-top:2px;padding-bottom:2px;font-size:11px;" id="VEver-{$row['id']}">{$advipever}</span>
</td>
<td align="left">
<span dir="ltr" style="display:none; color:black;font-size:11px;" id="B-{$row['id']}">{$adban}</span>
</td>
</tr>
</table>
<div dir="rtl" style="color:black;border:solid 1px #2c2c2c;background-color:#6FAA00;margin-bottom:3px;padding:3px; font-size:11px;" id="{$row['id']}">
{$row['post']}
{$donkey}
</div>
</td>
</tr>
END;
}
}

if(mysql_num_rows($query) == 0) 
{ 
echo("<tr>
<td valign=\"top\" nowrap=\"nowrap\" style=\"padding-top:2px;padding-bottom:2px;font-size:11px;\"><td style=\"padding-top:2px;padding-bottom:2px; font-size:11px;\" valign=\"top\" width=\"100%\">����� ������� ��� ������ :(</td></tr>"); 
}
if ($_POST['title'] = "") {
die("error");
} else {
}
if($_POST['submit'] && $_POST['anp'] != "yes")
{

	/* $date = date("H:i , j.n.y"); */
$time66 = time();
$correct_time66 = $time66 + $badate;
$date = date("H:i , j.n.y", $correct_time66);
	$name = mysql_real_escape_string(htmlspecialchars($_POST['name']));
	$email = mysql_real_escape_string(htmlspecialchars($_POST['email']));
	$text = mysql_real_escape_string(htmlspecialchars($_POST['text']));
if (strlen($text) > 501 && !$cuser) {
die("<script>alert('������ ��� ����� ����')</script><script>history.back()</script>");
}
if (strlen($name) > 30 && !$cuser) {
die("<script>alert('������ ��� ���� ����')</script><script>history.back()</script>");
}
/* 
if(ord($text) == 10) { 
ie("<script>alert('�� ������')</script><script>history.back()</script>");
}
for($f=0; $f<strlen($text) ; $f++) {
if( ord($text) > 401) {
die("<script>alert('������ ����')</script><script>history.back()</script>");
} */


	$ip = $_SERVER["REMOTE_ADDR"];



	if($cuser) {
$swit = mysql_query("SELECT * FROM `Sys-Ban` WHERE `test`= '1'");
while($row = mysql_fetch_array($swit)) {
$text = str_replace( $row['before'], $row['after'], $text );
}
	
	}
$swit = mysql_query("SELECT * FROM `Sys-Ban` WHERE `test`= '0'");
while($row = mysql_fetch_array($swit)) {
$text = str_replace( $row['before'], $row['after'], $text );
}
$text = str_replace( '\n', '', $text );

	if(!$cuser) {

	$stext = str_replace( ' ', '', $text );
	$stext = str_replace( '*', '', $stext );
$stext = str_replace( "\\\'", '', $stext );
$stext = str_replace( "\\", '', $stext );
$stext = str_replace( "\\\\", '', $stext );
	$stext = str_replace( '.', '', $stext );
	$stext = str_replace( '#', '', $stext );
	$stext = str_replace( ',', '', $stext );
	$stext = str_replace( '-', '', $stext );
	$stext = str_replace( '`', '', $stext );
	$stext = str_replace( '\n', '', $stext );
	$stext = str_replace( '/', '', $stext );
	$stext = str_replace( '!', '', $stext );
	$stext = str_replace( '@', '', $stext );
	$stext = str_replace( '$', '', $stext );
	$stext = str_replace( '%', '', $stext );
	$stext = str_replace( '^', '', $stext );
	$stext = str_replace( ')', '', $stext );
	$stext = str_replace( '(', '', $stext );
	$stext = str_replace( '+', '', $stext );
	$stext = str_replace( '=', '', $stext );
	$stext = str_replace( '_', '', $stext );
	$stext = str_replace( '"', '', $stext );
	$stext = str_replace( "'", '', $stext );
	$stext = str_replace( '?', '', $stext );
	$stext = str_replace( '<', '', $stext );
	$stext = str_replace( '>', '', $stext );
	$stext = str_replace( '|', '', $stext );
	$stext = str_replace( '}', '', $stext );
	$stext = str_replace( '{', '', $stext );
	$stext = str_replace( '[', '', $stext );
	$stext = str_replace( ']', '', $stext );
	$stext = str_replace( ':', '', $stext );
	$stext = str_replace( ';', '', $stext );
	$stext = str_replace( '~', '', $stext );
	//$stext = str_replace( "\\\", '', $stext );
	$stext = str_replace( ' ', '', $stext );

	$sname = str_replace(' ', '', $name );
	$sname = str_replace( '*', '', $sname );
	$sname = str_replace( '.', '', $sname );
	$sname = str_replace( '#', '', $sname );
	$sname = str_replace( ',', '', $sname );

	$sname = str_replace( '-', '', $sname );
	$sname = str_replace( '`', '', $sname );
	$switt = mysql_query("SELECT * FROM `Sys-Ban` WHERE `test`= '2'");
	while($roww = mysql_fetch_array($switt)) {
		if((!stristr($stext, $roww['before']) === FALSE) || (!stristr($sname, $roww['before']) === FALSE)) {
		$ban=mysql_query("INSERT INTO `banlist` (`id` ,`ip` ,`from` ,`reason` ,`post` )VALUES ('0', '{$ip}', 'AnTi', ' - {$sname}', '{$text}');"); 
			if($ban) {
				echo "1";
				die();
			}
		}
	}
	$swit3 = mysql_query("SELECT * FROM `Sys-Ban` WHERE `test`= '3'");
	while($row3 = mysql_fetch_array($swit3)) {
		$text = str_replace($row3['before'], $row3['after'], $text );
		$name = str_replace( $row3['before'], $row3['after'], $name );
	}
/*$text=explode(' ', stripslashes(strtolower(str_replace('abc', 'aav', $text)))); */

	}

	$swit4 = mysql_query("SELECT * FROM `Sys-Ban` WHERE `test`= '4'");
	while($row4 = mysql_fetch_array($swit4)) {
		$text = str_replace($row4['before'], $row4['after'], $text );
	}

	if(($sname=="" || $sname ==" " || $stext=="" || $stext==" ") && (!$cuser))
	{
	die("<script>alert('��� �� ���� ������ �����/����� �� �� ������!')</script><script>history.back()</script>");
	}

	$swit5 = mysql_query("SELECT * FROM `Sys-Ban` WHERE `test`= '5'");
	while($row5 = mysql_fetch_array($swit5)) {
		$name = str_replace($row5['before'], $row5['after'], $name );
	}


/*
	$check = mysql_query("SELECT * FROM Sys-TG WHERE ip = '$ip' AND );
	if(mysql_num_rows($check) >= 0){
	die("<script>alert('����� �����: ��� ��� 5 ���� ������ ������ ����')</script><script>history.back()</script>");
	}
*/
/*	while($row = mysql_fetch_array($check7)) { 
	echo "{$row['$ip']}";
	if($row['funtime'] > $tim)]
SELECT * FROM `Sys-TG` ORDER BY `Sys-TG`.`id` DESC LIMIT $start, $per_page
*/

/*	if(@mysql_num_rows($check3) != 0) {   	*/

/* $tim = time() - 60*2; */

if(!($cuser))
{


$check27 = mysql_query("SELECT * FROM `Sys-TG` ORDER BY `Sys-TG`.`id` DESC LIMIT 0,1");
while($row55 = mysql_fetch_array($check27)) { 

if((stristr($text, $row55['post'])=== true) OR (stristr($row55['post'], $text)=== true)) {
  
	$ban=mysql_query("INSERT INTO `banlist` (`id` ,`ip` ,`from` ,`reason` ,`post` )VALUES ('0', '{$ip}', 'AnTi', '{$sname}', '{$text}');"); 
		if($ban) {
			echo "1";
			die();
		}
	}
}

$check7 = mysql_query("SELECT * FROM `Sys-TG` ORDER BY `Sys-TG`.`id` DESC LIMIT 0,1");  
while($row = mysql_fetch_array($check7)) { 
	if($ip == $row['ip']) {
		die("<script>alert('���� ���� ����� ������ ����.')</script><script>history.back()</script>");
	}
}

/*
//$stext17 = str_replace( '!', '', $text );
$check17 = mysql_query("SELECT * FROM `Sys-TG`  WHERE ip = '$ip' ORDER BY `Sys-TG`.`id` DESC LIMIT 0,1");  
while($row55 = mysql_fetch_array($check17)) { 
	if((!stristr($text, $row55['post'] === FALSE)) OR (!stristr($row55['post'],$text === FALSE))) {
	$ban=mysql_query("INSERT INTO `banlist` (`id` ,`ip` ,`from` ,`reason` ,`post` )VALUES ('0', '{$ip}', 'AnTi', '{$sname}', '{$text}');"); 
	$delpost = mysql_query("DELETE FROM `Sys-TG` WHERE `Sys-TG`.`id` = '{$row55['id']}'") or die("Error!");  
		if($ban && $delpost) {
			//echo "1";
			die("<script>window.location='http://www.freeff.co.il';</script>");
		}
	}
}
*/


/*
	while($roww = mysql_fetch_array($switt)) {
		if((!stristr($stext17, $row55['post'] === FALSE)) {
		$ban=mysql_query("INSERT INTO `banlist` (`id` ,`ip` ,`from` ,`reason` ,`post` )VALUES ('0', '{$ip}', 'AnTi', ' - {$sname}', '{$text}');"); 
			if($ban) {
				echo "1";
				die();
			}
		}
	}
//$stext177 = str_replace( '!', '', $row55['post'] );
//	if($stext17 == $stext177) {
//		die("<script>alert('���� ���� ����� �� ���� ����� ������.')</script><script>history.back()</script>");
//	}
*/


//$stext177 = str_replace( '!', '', $row['post'] );
/*
$check27 = mysql_query("SELECT * FROM `Sys-TG` WHERE email != 'im@anti.bot' and  ORDER BY `Sys-TG`.`id` DESC LIMIT 0,1");
while($row8 = mysql_fetch_array($check27)) { 
echo $text;
echo "<br>problam<br>";
echo $row8['id'];
	if(!stristr($text, $row8['post'] === FALSE)) {
	$ban=mysql_query("INSERT INTO `banlist` (`id` ,`ip` ,`from` ,`reason` ,`post` )VALUES ('0', '{$ip}', 'AnTi', ' - {$sname}', '{$text}');"); 
		if($ban) {
			echo "1";
			die();
		}
	}
}
*/




$check8 = mysql_query("SELECT * FROM `Sys-TG` ORDER BY `Sys-TG`.`id` DESC LIMIT 1,2");  
$check9 = mysql_query("SELECT * FROM `Sys-TG` ORDER BY `Sys-TG`.`id` DESC LIMIT 0,1");
while($row4 = mysql_fetch_array($check8)) { 
	while($row2 = mysql_fetch_array($check9)) { 
		if($row2['name'] == "AnTi-BoT") 
		{
			if($ip == $row4['ip']) {
				die("<script>alert('���� ���� ����� ������ ����.')</script><script>history.back()</script>");
			}
		}
	}
}

}


	/*if(

(
	($_POST['secCode2'] != $_SESSION['secu']) 
		|| 
	($_POST['sec'] != $_SESSION['sec'])
)  
&& 
!$cuser  
) {
	$Error['msg'] = "<script>alert('��� ����� ����')</script><font color=\"black\"><b>��� ����� ����</b></font>";
	}*/
$ip=$_SERVER['REMOTE_ADDR'];

$file2 = file_get_contents('http://geoip.wtanaka.com/cc/'.$ip);
if(($file2 != "il") && ($file2 != "IL") && ($file2 != "israel") && ($file2 != "Israel") && ($file2 != "ISRAEL") && ($file2 != "Il")  && ($file2 != "" ) && ($file2 != NULL))  {  
	die("<script>alert('����� �� ���� ����� �����')</script><script>history.back()</script>");
}

	$funtime = time();
	if(!$name || !$text)
	{
	die("<script>alert('���� ������ ����� ����� ������ ���� �������')</script><script>history.back()</script>");
	}
	if($_COOKIE['TG-Id'] == "3")
	{
	$cid = "2";
	$name = $_COOKIE['TG-Username'];
	$ok = mysql_query("INSERT INTO `Sys-TG` (`id` ,`name` ,`email` ,`admin` ,`date` ,`post`,`ip`,`time` )VALUES ('0', '$name', '$email', '2', '$date', '$text', '$ip','$funtime');") or die(mysql_error());
	}
	if($_COOKIE['TG-Id'] == "1")
	{
	$cid = "2";
	$name = $_COOKIE['TG-Username'];
	$ok = mysql_query("INSERT INTO `Sys-TG` (`id` ,`name` ,`email` ,`admin` ,`date` ,`post`,`ip`,`time` )VALUES ('0', '$name', '$email', '2', '$date', '$text', '$ip','$funtime');") or die(mysql_error());
	}
	else if($_COOKIE['TG-Id'] == "0")
	{
	$name = $_COOKIE['TG-Username'];
	$ok = mysql_query("INSERT INTO `Sys-TG` (`id` ,`name` ,`email` ,`admin` ,`date` ,`post`,`ip`,`time` )VALUES ('0', '$name', '$email', '1', '$date', '$text', 'no-ip-4-me','$funtime');") or die(mysql_error());
	} else if($Error['msg'] == ""){
	$ok = mysql_query("INSERT INTO `Sys-TG` (`id` ,`name` ,`email` ,`admin` ,`date` ,`post`,`ip`,`time` )VALUES ('0', '$name', '$email', '0', '$date', '$text', '$ip','$funtime');")or die(mysql_error());

/*		if((!stristr($stext, 'unlimit') === FALSE) || (!stristr($stext, '�������') === FALSE) || (!stristr($stext, '�������') === FALSE)) {
		$automsg=mysql_query("INSERT INTO `Sys-TG` (`id` ,`name` ,`email` ,`admin` ,`date` ,`post`,`ip`,`time` )VALUES ('0', 'AnTi-BoT', 'im@anti.bot', '1', '$date', '������� �UnLimit ���� ����� �� ������ � VIP ���� ����� ���� �������.<Br>
<br><b>���� ����� �������� ������ ����.</b>', 'no-ip-4-me','0');");
		}*/
		if((!stristr($stext, '��������') === FALSE) || (!stristr($stext, '��������') === FALSE) || 
		(!stristr($stext, '��������') === FALSE) || (!stristr($stext, '�������������') === FALSE) || 
		(!stristr($stext, '��������������') === FALSE) || (!stristr($stext, '������') === FALSE) || 
		(!stristr($stext, '���������') === FALSE) || (!stristr($stext, '��������') === FALSE) || 
		(!stristr($stext, '�������') === FALSE) || (!stristr($stext, '���������') === FALSE) || 
		(!stristr($stext, '��������') === FALSE) || (!stristr($stext, '�������') === FALSE) || 
		(!stristr($stext, '�������') === FALSE) || (!stristr($stext, '�������') === FALSE) ||
		(!stristr($stext, '�������') === FALSE) || (!stristr($stext, '���������') === FALSE) ||
		(!stristr($stext, '�������') === FALSE) || (!stristr($stext, '��������') === FALSE) ||
		(!stristr($stext, '�������') === FALSE) || (!stristr($stext, '�������') === FALSE) ||
		(!stristr($stext, '��������') === FALSE) || (!stristr($stext, '��������') === FALSE) ||
		(!stristr($stext, '�������') === FALSE) || (!stristr($stext, '�������') === FALSE) ||
		(!stristr($stext, '�������') === FALSE) || (!stristr($stext, '�������') === FALSE) ||
		(!stristr($stext, '������') === FALSE) || (!stristr($stext, '������') === FALSE) ||
		(!stristr($stext, '�������') === FALSE) || (!stristr($stext, '�������') === FALSE)) {
		$automsg=mysql_query("INSERT INTO `Sys-TG` (`id` ,`name` ,`email` ,`admin` ,`date` ,`post`,`ip`,`time` )VALUES ('0', 'AnTi-BoT', 'im@anti.bot', '1', '$date', '��� ���� �������, ������ �����.<Br>��� ��, ���� ����� �� ������ ����� ����� �����, ��� ����� ����? �� ��, ��� ����!</font></a><br><b>���� ����� �������� ������ ����.</b>', 'no-ip-4-me','0');");
		/* }  elseif((!stristr($stext, '����������') === FALSE) || (!stristr($stext, '�����������') === FALSE) || (!stristr($stext, '��������') === FALSE) || (!stristr($stext, '����') === FALSE) || (!stristr($stext, '�����') === FALSE) || (!stristr($stext, '���') === FALSE)) {
		$automsg=mysql_query("INSERT INTO `Sys-TG` (`id` ,`name` ,`email` ,`admin` ,`date` ,`post`,`ip`,`time` )VALUES ('0', 'Radio-BOT', 'info@yuri198.co.il', '2', '$date', '���� ��� ���� ���� ����:)<br>�� ��� ������ ����� ���� ���� :)<br>������, ���� ����� ���.<Br>��� ��� ���� ���� �� ���� ����� :)<br><br><b>���� ����� �������� ����� ����.</b>', 'no-ip-4-me','0');"); */
	}		

	}
	if($ok)
	{
if($_POST['abs'] == "1") {
	die("<script>alert('������ �����')</script><script>window.location = 'index.php'</script>");
} else {
	die("<script>alert('������ �����')</script><script>history.back()</script>");
}
	}
}

if($_POST['submit'] && $_POST['anp'] == "yes")
{
	if($cuser == "Yuri198") {
	$aid=2;
	} else {
	$aid=1;
	}
	$password = mysql_real_escape_string(htmlspecialchars($_POST['password']));
	$password = str_replace( ' | ', '<Br>', $password );
	$time2 = time();
	/* $date2 = date("H:i , j.n.y"); */
$time66 = time();
$correct_time66 = $time66 + $badate;
$date2 = date("H:i , j.n.y", $correct_time66);
$date3 = date("j.n.y ���� H:i", $correct_time66);
	$name = $_COOKIE['TG-Username'];
	$by = mysql_real_escape_string(htmlspecialchars($_POST['by']));
	$max = mysql_real_escape_string(htmlspecialchars($_POST['max']));
	$site = mysql_real_escape_string(htmlspecialchars($_POST['site']));
	$time = mysql_real_escape_string(htmlspecialchars($_POST['time']));
	$email = mysql_real_escape_string(htmlspecialchars($_POST['email']));
	$pw2 = mysql_real_escape_string(htmlspecialchars($_POST['pw2']));
	$Top = mysql_real_escape_string(htmlspecialchars($_POST['Top']));
	$vip = mysql_real_escape_string(htmlspecialchars($_POST['vip']));

/*if($by == "" || $by == " " || $by == NULL) {
	$by="���� ����";
	if($email != "" && $email != " " && $email != NULL) {
	$em2 = explode("@", $email);
	$by = $em2[0];
	} else {
	$by="���� ����";
	}
}*/

if(!($by != NULL && $by != "" && $email != NULL && $email != "")) {
	if(($by == "" || $by == " " || $by == NULL)) {
		if($email == "" || $email == " " || $email == NULL) {
		$by="���� ����";
		} else {
		$em2 = explode("@", $email);
		$by = $em2[0];
		} 
	} 
}


$check2 = mysql_query("SELECT * FROM `RSS` WHERE `password`='{$password}'");  
$check22 = mysql_query("SELECT * FROM `Sys-User-Vip` WHERE `email`='{$email}'");  
if(@mysql_num_rows($check22) > 0) {
while($ro44 = mysql_fetch_array($check22)) {
$datevip = $ro44['date'];
$idvip = $ro44['user_id'];
}
}
$newdate = $datevip+604800;

/*
while($ro4 = mysql_fetch_array($check2)) {
if($site == "rapidshare" && $ro4['site'] == "rapidshare") {
$password22 = explode(";", $password);
$password23 = explode(";", $ro4['password']);
	if($password22[0] == $password23[0]) {
	die("<script>alert('���� ��� ����� ����� �� ��� ����� ���')</script><script>history.back()</script>");
	}
	if($password22[1] == $password23[1]) {
	die("<script>alert('���� ��� ����� �� ������ ����')</script><script>history.back()</script>");
	}
} 
} */
if(@mysql_num_rows($check2) == 0) {
	$ok = mysql_query("INSERT INTO `RSS` (`id` ,`password` ,`by` ,`time` ,`max` ,`Top` ,`vip` ,`site` ,`date` )VALUES (NULL , '{$password}', '{$by}', '{$date3}', '{$max}', '{$Top}', '{$vip}', '{$site}', '{$time66}');");
	if($vip == 1)
	{
	$ok2 = mysql_query("INSERT INTO `Sys-TG` (`id` ,`name` ,`email` ,`admin` ,`date` ,`post`,`ip`,`time` )VALUES ('0', '{$name}', 'autopass@freeff.co.il', '{$aid}', '$date2', '����� ����� ���� ���� {$site} ����� �VIP ���� ����! :D', 'no-ip-4-me','0');");
		if($by != "" && $pw2 != "" && $email != "" && $password != "")
		{
		if($site == "fileflyer") {
			if(@mysql_num_rows($check22) == 0) {
			$add = mysql_query("INSERT INTO `Sys-User-Vip` (`user_id` ,`username` ,`password` ,`date` ,`email` ,`donate` ,`site` )VALUES ('0', '{$by}', '{$pw2}', '{$time2}', '{$email}', 'vip', '{$site}');"); 
				if($add != "")
				{		
				mail($email, "VIP at FreeFF.Co.iL - Free FileFlyer", "UserName: {$by}\n\rPassWord: {$pw2}\nEnJoY! Free FileFlyer Team.", "From: Free FileFlyer <anti.release@gmail.com>");
				die("<script>alert('������ ����� ������ ������� ���� VIP')</script><script>history.back()</script>");
				}
			} else {
			$add = mysql_query("UPDATE `Sys-User-Vip` SET `date` = '{$newdate}' WHERE `Sys-User-Vip`.`user_id` ={$idvip} ;");
				if($add != "")
				{		
				mail($email, "VIP at FreeFF.Co.iL - Free FileFlyer", "Your User Got More 1 ViP Week \n\r to remind you, here is your details:\r\n UserName: {$by}\n\rPassWord: {$pw2}\nEnJoY! Free FileFlyer Team.", "From: Free FileFlyer <anti.release@gmail.com>");
				die("<script>alert('������ ����� ������ ������� ���� ���� VIP ����!')</script><script>history.back()</script>");
				}
			}
		} else { 
		die("<script>alert('���� ������ �� ���� ���� VIP �� ������� ��� �� �FF - �� ������ ����� ����')</script><script>history.back()</script>"); 
		}
		}
	}
	else
	{
$password22 = explode(";", $password);
if($password22[3] != "" && $site=="rapidshare") { $site4=$password22[3]; } else { $site4=$site; }
	$ok2 = mysql_query("INSERT INTO `Sys-TG` (`id` ,`name` ,`email` ,`admin` ,`date` ,`post`,`ip`,`time` )VALUES ('0', '{$name}', 'autopass@FreeFF.co.il', '{$aid}', '$date2', '����� ����� ���� ���� {$site4} ,���� ������ {$by} ���� ��� ���� ������ ��� ���� ���� ��� ����� ���� �����!', 'no-ip-4-me','0');");
	/* $ok3 = mysql_query("INSERT INTO `Sys-TG-en` (`id` ,`name` ,`email` ,`admin` ,`date` ,`post`,`ip`,`time` )VALUES ('0', '{$name}', 'autopass@FreeFF.co.il', '{$aid}', '$date2', 'New pw added :) to site {$site} thanks to {$by} who sent us exclusive pw by the connect us page :D enjoy! :D', 'no-ip-4-me','0');"); */

		if($by != "" && $pw2 != "" && $email != "" && $password != "")
		{
		if($site == "fileflyer") {
			if(@mysql_num_rows($check22) == 0) {
			$add = mysql_query("INSERT INTO `Sys-User-Vip` (`user_id` ,`username` ,`password` ,`date` ,`email` ,`donate` ,`site` )VALUES ('0', '{$by}', '{$pw2}', '{$time2}', '{$email}', '{$password}', '{$site}');"); 
				if($add != "")
				{		
				mail($email, "VIP at FreeFF.Co.iL - Free FileFlyer", "UserName: {$by}\n\rPassWord: {$pw2}\nEnJoY! Free FileFlyer Team.", "From: Free FileFlyer <anti.release@gmail.com>");
				die("<script>alert('������ ����� ������ ������� ���� VIP')</script><script>history.back()</script>");
				}
			} else {
			$add = mysql_query("UPDATE `Sys-User-Vip` SET `date` = '{$newdate}' WHERE `Sys-User-Vip`.`user_id` ={$idvip} ;");
				if($add != "")
				{		
				mail($email, "VIP at FreeFF.Co.iL - Free FileFlyer", "Your User Got More 1 ViP Week \n\r to remind you, here is your details:\r\n UserName: {$by}\n\rPassWord: {$pw2}\nEnJoY! Free FileFlyer Team.", "From: Free FileFlyer <anti.release@gmail.com>");
				die("<script>alert('������ ����� ������ ������� ���� ���� VIP ����!')</script><script>history.back()</script>");
				}
			}
		} else { 
		die("<script>alert('���� ������ �� ���� ���� VIP �� ������� ��� �� �FF - �� ������ ����� ����')</script><script>history.back()</script>"); 
		}
		}
	}

	if($ok)
	{
	die("<script>alert('������ ����� ������ ������')</script><script>history.back()</script>");
	}
} else {
die("<script>alert('�� ��� ����� ���� ������ ��� �� ���� ������ ���� ���')</script><script>history.back()</script>");
}
}
?>
<tr>

	<td style="padding-top:2px;padding-bottom:2px" colspan="2">
<?php
$total_num = $total_num / $per_page;
if(intval($total_num) != $total_num)
{
    $total_num = intval($total_num) + 1;
}
//pager!!!
echo <<<EOF
<div align="center"><b style="color:#1346AC;cursor:pointer"><font size="1" face="arial">
EOF;

	$url = $_SERVER["HTTP_HOST"];
	if($url == "93.190.140.209") {
$start2="?page=";
$end2="";
	} else {
	$http = 1;
	$suf = "html";
$start2="page";
$end2=".html";
	}


$pageb4 =  intval($page) - 1;
$pageb42 = intval($page) - 2;
$pageafter = $page+1;
$pageafter2 = $page+2;
$pageafter10 = $page+10;
$pageafter100 = $page+100;
$pageb410 = $page-10;
$pageb4100 = $page-100;
if($page > 3) 
{
echo " [<a href=\"{$start2}1{$end2}\">1</a>] .... "; 
}

if(($page > 100)&&($pageb4100 != 1))
{
echo " [<a href=\"$start2$pageb4100$end2\">$pageb4100</a>] ... "; 
}

if(($page > 10)&&($pageb410 != 1)) 
{
echo " [<a href=\"$start2$pageb410$end2\">$pageb410</a>] ... "; 
}



if($page > 2) {
echo " [<a href=\"$start2$pageb42$end2\">$pageb42</a>]"; }
if($page > 1) 
{
echo " [<a href=\"$start2$pageb4$end2\">$pageb4</a>]"; 
}

echo " [<u>$page</u>]";
if($page<$total_num) 
{
echo " [<a href=\"$start2$pageafter$end2\">$pageafter</a>]";
}
if($page<$total_num-1) 
{
echo " [<a href=\"$start2$pageafter2$end2\">$pageafter2</a>]";
}

if (($total_num > 10)&&($total_num-10>$page)) 
{
echo " .. [<a href=\"$start2$pageafter10$end2\">$pageafter10</a>]"; 
}
if (($total_num >100)&&($total_num-100>$page))
{
echo " ... [<a href=\"$start2$pageafter100$end2\">$pageafter100</a>]"; 
}

if($page<$total_num-2)
{
echo " .... [<a href=\"$start2$total_num$end2\">$total_num</a>]";
}


/*
for($I = 1; $I<= $total_num; $I++)
{
   if($page != $I)
        echo " [<a href=\"$start2$I$end2\">$I</a>]";
    else
echo "[<u>$I</u>]";
    if($I != $per_page)
        echo " ";
} */
echo <<<EOF
</b></div></font>
EOF;

/*$check = mysql_query("SELECT * FROM Sys-TG WHERE ip = '$ip' AND ".time()." - time > '300'");
if(@mysql_num_rows($check) >= 0) {
echo("<div align=\"center\"><b style=\"color:#1346AC;cursor:pointer\">���� �� �����,<br>��� ���� ������ 5 ����.</b></div>");
}*/
?>
	<b style="color:#1346AC;cursor:pointer" onclick="ShowHide('Write')">��� �����</b>
	</td>
	</tr>
	<tr style="display:; font-size:11px;" id="Write">
	<td style="padding-top:2px;padding-bottom:2px" colspan="2" style="border:0;margin-top;margin-bottom:3px;padding:3px;font-size:11px;">
<a name="Send"></a>

<?php
if($Error['msg'] != "") {
$errors = <<<EOF
<tr>
	<td width="94"><span lang="he">�����: </span></td>
	<td width="341">{$Error['msg']}</td>
</tr>
EOF;
}


if($_COOKIE['TG-Id'] == "0" || $_COOKIE['TG-Id'] == "1")
{
echo <<<EOF
<form method="post" name="postform" onsubmit="return checkTg('','name1','replytext');submitonce(this)">
<input type="hidden" name="posted" value="1"> 
		<table style="border:solid 1px #black;background-color:#005408;font-size:11px;" cellspacing="0" cellpadding="0"  id="table2" width="100%">
		<tr>
			<td width="94"><span lang="he">�� �����*: </span></td>
			<td width="341">
		<input style="width:88%" id="name1" maxlength="20" name="name" readonly="readonly" value="{$_COOKIE['TG-Username']}"></td>
		</tr>
		<tr>
			<td width="94"><span lang="he">������*: </span></td>
			<td width="341">
		<input style="width:88%" maxlength="20" name="email" readonly="readonly" value="{$cemail}"></td>
		</tr>
		<tr><td width="94">����</td>
		<td width="341">	<textarea rows="5" name="text" cols="40" id="replytext" onkeydown="textCounter(document.postform.text,document.postform.remLen1,15000)" onkeyup="textCounter(document.postform.text,document.postform.remLen1,15000)"></textarea></td>
		</tr>
		<tr><td align="center" width="94">
		<p align="right">BBCode And <br>Smilies</td>
			<td align="center" width="341">
<img src="emoticons/ninja.gif" alt="[ninja]" title="[ninja]" onclick="emoticon('ninja')" onkeypress="emoticonp('ninja')">
<img src="emoticons/clap.gif" alt="[�� �����]" title="[clap]" onclick="emoticon('clap')" onkeypress="emoticonp('clap')">
<img src="emoticons/XDemoticon.gif" alt="[XD]" title="[XD]" onclick="emoticon('XD')" onkeypress="emoticonp('XD')">
<img src="emoticons/1eye.gif" alt="[1eye]" title="[1eye]" onclick="emoticon('1eye')" onkeypress="emoticonp('1eye')">
<img src="emoticons/biggrin.gif" alt="[biggrin]" title="[biggrin]" onclick="emoticon('biggrin')" onkeypress="emoticonp('biggrin')">
<img src="emoticons/blink.gif" alt="[blink]" title="[blink]" onclick="emoticon('blink')" onkeypress="emoticonp('blink')">
<img src="emoticons/king.gif" alt="[king]" title="[king]" onclick="emoticon('king')" onkeypress="emoticonp('king')">
<img src="emoticons/rolleyes.gif" alt="[rolleyes]" title="[rolleyes]" onclick="emoticon('rolleyes')" onkeypress="emoticonp('rolleyes')">
	<br>
<img src="emoticons/Adore.png" alt="[Adore]" title="[Adore]" onclick="emoticon('Adore')" onkeypress="emoticonp('Adore')">
<img src="emoticons/Cool.png" alt="[Coool]" title="[Coool]" onclick="emoticon('Coool')" onkeypress="emoticonp('Coool')">
<img src="emoticons/Cry.png" alt="[Cry]" title="[Cry]" onclick="emoticon('Cry')" onkeypress="emoticonp('Cry')">
<img src="emoticons/Furious.png" alt="[Furious]" title="[Furious]" onclick="emoticon('Furious')" onkeypress="emoticonp('Furious')">
<img src="emoticons/Laugh.png" alt="[Laugh]" title="[Laugh]" onclick="emoticon('Laugh')" onkeypress="emoticonp('Laugh')">
<img src="emoticons/Pudently.png" alt="[Pudently]" title="[Pudently]" onclick="emoticon('Pudently')" onkeypress="emoticonp('Pudently')">
<img src="emoticons/Struggle.png" alt="[Struggle]" title="[Struggle]" onclick="emoticon('Struggle')" onkeypress="emoticonp('Struggle')">
<img src="emoticons/Study.png" alt="[Study]" title="[Study]" onclick="emoticon('Study')" onkeypress="emoticonp('Study')">
<img src="emoticons/Sweet-angel.png" alt="[Sweet-angel]" title="[Sweet-angel]" onclick="emoticon('Sweet-angel')" onkeypress="emoticonp('Sweet-angel')"><br />
<input type="button" value="[B]" onclick="emoticon('b')">
<input type="button" value="[/B]" onclick="emoticon('/b')">
<input type="button" value="[s]" onclick="emoticon('s')">
<input type="button" value="[/s]" onclick="emoticon('/s')">
<input type="button" value="[u]" onclick="emoticon('u')">
<input type="button" value="[/u]" onclick="emoticon('/u')"></td></tr>
		<tr><td colspan="2" align="center"><p align="center">
		* ����� ��� <input type="text" class="te4" readonly="readonly" name="remLen1" size="4" maxlength="4" value="15000"/> �����</font>
		</td>
		</tr>
		<tr>
			<td colspan="2" align="center">
<input type="submit" name="submit" class="Text" value="���� �����"></td>
		</tr>
		</table>
		</form>
EOF;
} else if($_COOKIE['TG-Id'] == "3"){
echo <<<EOF
<form method="post" name="postform" onsubmit="return checkTg('','name1','replytext');submitonce(this)">
<input type="hidden" name="posted" value="1"> 
		<table style="border:solid 1px #black;background-color:#005408;font-size:11px;" cellspacing="0" cellpadding="0"  id="table2" width="100%">
		<tr>
			<td width="94"><span lang="he">�� �����*: </span></td>
			<td width="341">
		<input style="width:88%" maxlength="20" id=name1 name="name" readonly="readonly" value="{$_COOKIE['TG-Username']}"></td>
		</tr>
		<tr>
			<td width="94"><span lang="he">������*: </span></td>
			<td width="341">
		<input style="width:88%" maxlength="20" name="email" readonly="readonly" value="{$vemail}"></td>
		</tr>
		<tr><td width="94">����</td>
		<td width="341">	<textarea rows="5" name="text" cols="40" id="replytext" onkeydown="textCounter(document.postform.text,document.postform.remLen1,500)" onkeyup="textCounter(document.postform.text,document.postform.remLen1,500)"></textarea></td>
		</tr>
		<tr><td align="center" width="94">
		<p align="right">BBCode And <br>Smilies</td>
			<td align="center" width="341">
<img src="emoticons/ninja.gif" alt="[ninja]" title="[ninja]" onclick="emoticon('ninja')" onkeypress="emoticonp('ninja')">
<img src="emoticons/clap.gif" alt="[�� �����]" title="[clap]" onclick="emoticon('clap')" onkeypress="emoticonp('clap')">
<img src="emoticons/XDemoticon.gif" alt="[XD]" title="[XD]" onclick="emoticon('XD')" onkeypress="emoticonp('XD')">
<img src="emoticons/1eye.gif" alt="[1eye]" title="[1eye]" onclick="emoticon('1eye')" onkeypress="emoticonp('1eye')">
<img src="emoticons/biggrin.gif" alt="[biggrin]" title="[biggrin]" onclick="emoticon('biggrin')" onkeypress="emoticonp('biggrin')">
<img src="emoticons/blink.gif" alt="[blink]" title="[blink]" onclick="emoticon('blink')" onkeypress="emoticonp('blink')">
	<br>
<img src="emoticons/Adore.png" alt="[Adore]" title="[Adore]" onclick="emoticon('Adore')" onkeypress="emoticonp('Adore')">
<img src="emoticons/Cool.png" alt="[Coool]" title="[Coool]" onclick="emoticon('Coool')" onkeypress="emoticonp('Coool')">
<img src="emoticons/Cry.png" alt="[Cry]" title="[Cry]" onclick="emoticon('Cry')" onkeypress="emoticonp('Cry')">
<img src="emoticons/Furious.png" alt="[Furious]" title="[Furious]" onclick="emoticon('Furious')" onkeypress="emoticonp('Furious')">
<img src="emoticons/Laugh.png" alt="[Laugh]" title="[Laugh]" onclick="emoticon('Laugh')" onkeypress="emoticonp('Laugh')">
<img src="emoticons/Pudently.png" alt="[Pudently]" title="[Pudently]" onclick="emoticon('Pudently')" onkeypress="emoticonp('Pudently')">
<img src="emoticons/Struggle.png" alt="[Struggle]" title="[Struggle]" onclick="emoticon('Struggle')" onkeypress="emoticonp('Struggle')">
<img src="emoticons/Study.png" alt="[Study]" title="[Study]" onclick="emoticon('Study')" onkeypress="emoticonp('Study')">
<img src="emoticons/Sweet-angel.png" alt="[Sweet-angel]" title="[Sweet-angel]" onclick="emoticon('Sweet-angel')" onkeypress="emoticonp('Sweet-angel')"><br />
<input type="button" value="[B]" onclick="emoticon('b')">
<input type="button" value="[/B]" onclick="emoticon('/b')">
<input type="button" value="[s]" onclick="emoticon('s')">
<input type="button" value="[/s]" onclick="emoticon('/s')">
<input type="button" value="[u]" onclick="emoticon('u')">
<input type="button" value="[/u]" onclick="emoticon('/u')"></td></tr>
		<tr><td colspan="2" align="center"><p align="center">
		* ����� ��� <input type="text" class="te4" readonly="readonly" name="remLen1" size="4" maxlength="4" value="500"/> �����</font>
		</td>
		</tr>
		<tr>
			<td colspan="2" align="center">
<input type="submit" name="submit" class="Text" value="���� �����"></td>
		</tr>
		</table>
		</form>
EOF;
} else {
echo <<<EOF
<form method="post" name="postform" onsubmit="return checkTg('sec4','name1','replytext');submitonce(this)">
<input type="hidden" name="posted" value="1"> 
		<table style="border:solid 1px #black;background-color:#005408;font-size:11px;" cellspacing="0" cellpadding="0"  id="table2" width="100%">
		{$errors}
		<tr>
			<td width="94"><span lang="he">�� �����*: </span></td>
			<td width="341">
		<input style="width:88%" maxlength="25" name="name" id=name1></td>
		</tr>
		<tr>
			<td width="94"><span lang="he">������: </span><br /><font color="darkred"><b>��� �� ���� ���� ��� �����.</b></font></td>
			<td width="341">
		<input style="width:88%" maxlength="40" name="email"></td>
		</tr>
		<tr><td width="94">����</td>
		<td width="341">	<textarea rows="6" name="text" cols="40" id="replytext" onkeydown="textCounter(document.postform.text,document.postform.remLen1,300)" onkeyup="textCounter(document.postform.text,document.postform.remLen1,300)">{$_POST['text']}</textarea></td>
		</tr>
		<tr><td width="26">��� �����:</td>
			<td width="341">
		<img src="SecCode.php" width="71" height="21" align="absmiddle"> <b>�</b><br><input type="text" id=sec4 name="secCode">
		</td>
		<tr><td align="center" width="94">
		<p align="right">BBCode And <br>Smilies</td>
			<td align="center" width="341">
<img src="emoticons/ninja.gif" alt="[ninja]" title="[ninja]" onclick="emoticon('ninja')" onkeypress="emoticonp('ninja')">
<img src="emoticons/clap.gif" alt="[�� �����]" title="[clap]" onclick="emoticon('clap')" onkeypress="emoticonp('clap')">
<img src="emoticons/XDemoticon.gif" alt="[XD]" title="[XD]" onclick="emoticon('XD')" onkeypress="emoticonp('XD')">
<img src="emoticons/1eye.gif" alt="[1eye]" title="[1eye]" onclick="emoticon('1eye')" onkeypress="emoticonp('1eye')">
<img src="emoticons/biggrin.gif" alt="[biggrin]" title="[biggrin]" onclick="emoticon('biggrin')" onkeypress="emoticonp('biggrin')">
<img src="emoticons/blink.gif" alt="[blink]" title="[blink]" onclick="emoticon('blink')" onkeypress="emoticonp('blink')">
<img src="emoticons/king.gif" alt="[king]" title="[king]" onclick="emoticon('king')" onkeypress="emoticonp('king')">
<img src="emoticons/rolleyes.gif" alt="[rolleyes]" title="[rolleyes]" onclick="emoticon('rolleyes')" onkeypress="emoticonp('rolleyes')">	<br>
<img src="emoticons/Adore.png" alt="[Adore]" title="[Adore]" onclick="emoticon('Adore')" onkeypress="emoticonp('Adore')">
<img src="emoticons/Cool.png" alt="[Coool]" title="[Coool]" onclick="emoticon('Coool')" onkeypress="emoticonp('Coool')">
<img src="emoticons/Cry.png" alt="[Cry]" title="[Cry]" onclick="emoticon('Cry')" onkeypress="emoticonp('Cry')">
<img src="emoticons/Furious.png" alt="[Furious]" title="[Furious]" onclick="emoticon('Furious')" onkeypress="emoticonp('Furious')">
<img src="emoticons/Laugh.png" alt="[Laugh]" title="[Laugh]" onclick="emoticon('Laugh')" onkeypress="emoticonp('Laugh')">
<img src="emoticons/Pudently.png" alt="[Pudently]" title="[Pudently]" onclick="emoticon('Pudently')" onkeypress="emoticonp('Pudently')">
<img src="emoticons/Struggle.png" alt="[Struggle]" title="[Struggle]" onclick="emoticon('Struggle')" onkeypress="emoticonp('Struggle')">
<img src="emoticons/Study.png" alt="[Study]" title="[Study]" onclick="emoticon('Study')" onkeypress="emoticonp('Study')">
<img src="emoticons/Sweet-angel.png" alt="[Sweet-angel]" title="[Sweet-angel]" onclick="emoticon('Sweet-angel')" onkeypress="emoticonp('Sweet-angel')">
	</td></tr>
		<tr><td colspan="2" align="center"><p align="center">
		* ����� ��� <input type="text" class="te4" readonly="readonly" name="remLen1" size="4" maxlength="4" value="300"/> �����</font>
		</td>
		</tr>
		<tr>
			<td colspan="2" align="center">
<input type="submit" name="submit" class="Text" value="���� �����"></td>
		</tr>
		</table>
		</form>
<a name="Vip"></a>
<table style="border:0;" cellspacing="0" cellpadding="0" id="table2">
	<tr style="display:none; font-size:11px;" id="Admin4">
	<td style="padding-top:2px;padding-bottom:2px" colspan="2" style="border:0;margin-top;margin-bottom:3px;padding:3px;font-size:11px;">
<form action="TG/login-vip.php" method="post" onsubmit="return checkTg('sec5');">
		<table style="border:solid 1px #black;background-color:#005408;font-size:11px;" cellspacing="0" cellpadding="0"  id="table2" width="100%">
		<tr>
		<tr><td width="94">�� �����:</td>
			<td width="341">
		<input type="text" style="width:100%" maxlength="50" name="username"></td></tr>
		</tr>
		<tr><td width="94">�����:</td>
			<td width="341">
		<input type="password" style="width:100%" maxlength="50" name="password"></td>
		</tr>
		<tr><td width="26">��� �����:</td>
			<td width="341">
		<img src="SecCode.php"  width="71" height="21" align="absmiddle"> <b>�</b><br><input type="text" id=sec5 name="secCode">
		</td>
			<td colspan="2" align="center">
<input type="hidden" name="GoLogin" value="1">  
<input type="submit" value="�����!"> </td></tr>
		</tr>
		</table>
		</form>
</table>
EOF;
}

if($cuser)
{
echo <<<EOF
<a name="Logout"></a>
<table style="border:0;" cellspacing="0" cellpadding="0" id="table2">
	<tr style="display:none; font-size:11px;" id="Admin2">
	<td style="padding-top:2px;padding-bottom:2px" colspan="2" style="border:0;margin-top;margin-bottom:3px;padding:3px;font-size:11px;">
		<table style="border:solid 1px #black;background-color:#005408;font-size:11px;" cellspacing="0" cellpadding="0"  id="table2" width="100%">
		<tr>
		<tr>
			<td colspan="2" align="center">
<a href="sl-sendlogin.php?act=Logout"><span style="color:#1346AC;cursor:pointer">�����</span></a> </td></tr>
		</tr>
		</table>
		</form>
</table>
<a name="Add"></a>
<table style="border:0;" cellspacing="0" cellpadding="0" id="table2">
	<tr style="display:none; font-size:11px;" id="Admin3">
	<td style="padding-top:2px;padding-bottom:2px" colspan="2" style="border:0;margin-top;margin-bottom:3px;padding:3px;font-size:11px;">
<form action="?" method="post" name="tgo">
		<table style="border:solid 1px #black;background-color:#005408;font-size:11px;" cellspacing="0" cellpadding="0"  id="table2" width="100%">
		<tr>
		<tr><td width="94">������:</td>
			<td width="341">
		<input type="text" size=50 maxlength="500" name="password"></td></tr>
		</tr>
		<tr><td width="94">�"�:</td>
			<td width="341">
		<input type="text" style="width:70%" maxlength="50" name="by" dir=ltr> ��� ������: 
		<input type="text" style="width:8%" maxlength="3" name="max" value="100" ></td>
		</tr>
<!--
		<tr><td width="94">���:</td>
			<td width="341">
		<input type="text" style="width:100%"  maxlength="50" name="time" dir=ltr></td>
		</tr>
-->
		<tr><td width="94">email:</td>
			<td width="341">
		<input type="text" style="width:100%" maxlength="50" name="email" dir=ltr></td>
		</tr>
		<tr><td width="94">�������:</td>
			<td width="341">
		<input type="text" style="width:80%" maxlength="50" name="pw2" dir=ltr>
		<input type="button" style="width:19%" name="rand" onclick="rando();" value="rand"></td>
		</tr>
		<tr><td width="94">�����:</td>
			<td width="341">
		<input type="radio" name="Top" value="0"> = �� | 
		<input type="radio" name="Top" value="1" checked> = ��</td>

</td>

		</tr>
		<tr><td width="94">����� �VIP:</td>
			<td width="341">
		<input type="radio" name="vip" value="0" checked> = �� | 
EOF;

if($cuser=="AnTi") { 
?>
		<input type="radio" name="vip" value="1"> = ��</td>
<?
}
echo <<<EOF
		</tr>
		<tr><td width="94">���:</td>
			<td width="400" dir=ltr>
		<input type="radio" name="site" value="ShareFlare">=SF
		<input type="radio" name="site" value="uploadil">=uli
		<input type="radio" name="site" value="rapidshare">=rs
		<input type="radio" name="site" value="vipfile">=VF
		<input type="radio" name="site" value="unlimit">=UL
		<input type="radio" name="site" value="steam">=steam
		<input type="radio" name="site" value="fileflyer" checked>= FF</td>
		</tr>
			<td colspan="2" align="center">
<input type="hidden" name="anp" value="yes">  
<input onclick="rando2();" type="submit" name="submit" value="��� ����� ����"> </td></tr>
		</tr>
		</table>
	</form>
</table>
EOF;
}
?>
		<script language=javascript>document.body.onkeydown=function(){if(event.keyCode==13&&event.ctrlKey)document.getElementById('postform').submit()}</script></td></tr></table>
<table style="border:0;" cellspacing="0" cellpadding="0" id="table2">
	<tr style="display:none; font-size:11px;" id="Admin">
	<td style="padding-top:2px;padding-bottom:2px" colspan="2" style="border:0;margin-top;margin-bottom:3px;padding:3px;font-size:11px;">
<form action="sl-sendlogin.php" method="post" onsubmit="return checkTg('sec6');">
		<table style="border:solid 1px #black;background-color:#005408;font-size:11px;" cellspacing="0" cellpadding="0"  id="table2" width="100%">
		<tr>
		<tr><td width="94">�� �����:</td>
			<td width="341">
		<input type="text" style="width:100%" maxlength="50" name="user"></td></tr>
		</tr>
		<tr><td width="94">�����:</td>
			<td width="341">
		<input type="password" style="width:100%" maxlength="50" name="password"></td>
		</tr>
		<tr><td width="26">��� �����:</td>
			<td width="341">
		<img src="SecCode.php" width="71" height="21" align="absmiddle"> <b>�</b><br><input type="text" id=sec6 name="secCode">
		</td>
			<td colspan="2" align="center">
<input type="hidden" name="GoLogin" value="1">  
<input type="submit" value="�����!"> </td></tr>
		</tr>
		</table>
		</form>
</table>
</body>
</html>
