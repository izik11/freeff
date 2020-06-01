<?php
ob_start();
session_start();
include("../banlist.php");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" >
<html dir="rtl">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1255">
<title>Free FileFlyer - מערכת התגובות של האתר</title>
<link rel="stylesheet" type="text/css" href="css.css">
<script type="text/javascript" src="js.js"></script>
<script type="text/javascript" language="JavaScript">
<?php
//include("date.php");
?>
</script>
<meta http-equiv="Refresh" content="300; URL=index.php">
</head>
<body style="font-family:Arial, Helvetica, sans-serif;font-size:11px;" bgcolor="black" alink="white" vlink="white" link="white">
<?php
@session_start();
include("db.php");

$page = (int) $_GET['page'];

if($page>2000000000 || $page<1)
{
$page=1;
}


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
<div align="center"><table bgcolor="white"><tr><td align="center"><a href='JavaScript:ShowHide("Admin")'><font size="2" color="black"><b>התחברות מנהלים</b></font></a> <font size="2">::</font> <a onclick='ShowHide("Admin4")' href="#Vip"><font size="2" color="darkblue"><b>התחברות VIP</b></font></a> <font size="2">::</font>  <a href="#Send"><font size="1" color="#1346AC">שלח תגובה</font></a>{$checkvip}<br><!--<b>שעון אמיתי : </b><span id="time"></span><br><b>שעון שרת : </b><span id="time2"></span><br><font size="1"><b>השעון בתגובות מאחר ב7 דקות</b></font><br>-->
<!--<a href="index-old.php"><font color="green"><b>למעבר לעיצוב התגובות הישן לחצו כאן</b></font></a><br>-->
<a href="javascript:void(0);" onclick="vip();"><font size="2" color="orange"><b>VIP Zone</b></font></a><br><font size="1" color="blue"><b>סך הכל תגובות במערכת : {$total_num}</b></font></td></tr></table></div>
EOF;
}
if($cuser)
{
echo <<<EOF
<div align="center"><table bgcolor="white"><tr><td align="center">
<a onclick='ShowHide("Admin2")' href="#Logout"><font size="2" color="black"><b>התנתקות</b></font></a> <font size="2">::</font> 
<a href='admin.php' target='_blank'><font size="2" color="blue">פאנל ניהול</font></a> :: 
<!--<a onclick='ShowHide("Admin4")' href="#Vip"><font size="2" color="darkblue"><b>התחברות VIP</b></font></a> <font size="2">::</font>--> 
<a href="#Send"><font size="2" style="color:#1346AC;cursor:pointer">שלח תגובה</font></a> :: 
<a onclick='ShowHide("Admin3")' href="#Add"><font size="2" color="red">הוסף סיסמא</font></a> :: <a href="" onclick="vip();"><font size="2" color="orange">ViP Zone</font></a><br><!--<b>שעון אמיתי : </b><span id="time"></span><br><b>שעון שרת : </b><span id="time2"></span><br><font size="2"><b>השעון בתגובות מאחר ב7 דקות | <a href="index.php"><font color="black">רענן עמוד זה!</font></a></b></font><br>-->
<!--<a href="index-old.php"><font color="green"><b>למעבר לעיצוב התגובות הישן לחצו כאן</b></font></a><br>-->
<font color="blue"><b>סך הכל תגובות במערכת : {$total_num}</b></font> &nbsp; &nbsp; <a href="to.php"><font color="green" size="2"><b>תומך</b></font></a></div></td></tr></table></div>
EOF;
}
?>
<table style="border:0" cellspacing="0" cellpadding="0" class="table2" id="table1">
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
	$color = "\"#e2e2e2\"";
	$line['1'] = "";
	$line['2'] = "";
	$donkey = "";
	} else if(@mysql_num_rows($passwords) == 1){
		while($iper = mysql_fetch_array($passwords)) {
		$color = "darkgreen";
		$line['1'] = "";
		$line['2'] = "";
		$donkey = "<div align=\"center\"><font color=darkgreen><b>משתמש זה תרם סיסמא לאתר בעבר</b></font><br><font color=black><b>הסיסמא שהוא תרם: {$iper['donate']}. </b><font color=darkred><b>לאתר {$iper['site']}</font></font></div>";
		}
	} else if(@mysql_num_rows($passwords) >= 2 && @mysql_num_rows($passwords) <= 5){
		$color = "orange";
		$donkey = "<div align=\"center\"><font color=orange><b>משתמש זה תרם יותר מסיסמא אחת לאתר בעבר</b></font><br><font color=black><b>הסיסמאות שהוא תרם: ";
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
		$donkey = "<div align=\"center\"><font color=#d1d1d1><b>משתמש זה תרם יותר מ5 סיסמאות לאתר בעבר</b></font><br><font color=black><b>הסיסמאות שהוא תרם: ";
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
	$color = "\"#787878\"";
	$line['1'] = "<s>";
	$line['2'] = "</s>";
	}
if($cedit == "1")
{
$edit =  "<a href=\"edit.php?id={$row['id']}\">Edit</a>";
$addmsg = ":: <a href='JavaScript:ShowHide(\"M-{$row['id']}\")'>Add Message</a>";
$adms = "<form method=\"get\" action=\"addmsg.php?id={$row['id']}&from={$cuser}&message=\">
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
$showip = " :: האיפי : {$row['ip']} ";
$showemail = " {$row['email']} ";
}
if($cban == "1")
{
$addban = ":: <a href='JavaScript:ShowHide(\"B-{$row['id']}\")'>Add Ban</a>";
$adban = "<form method=\"get\" action=\"addban.php?ip={$row['ip']}&nick={$row['name']}&from=&reason=&post={$row['post']}\">
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
$advip = "<form method=\"get\" action=\"addvip.php?username=&password=&email=&donate=\">Username: <input name=\"username\" id=\"username\" value=\"\" class=\"skin\" type=\"text\"><br>Password : <input name=\"password\" id=\"password\" class=\"skin\" type=\"text\"><br>Email : <input name=\"email\" id=\"email\" class=\"skin\" type=\"text\"><br>Donate: <input name=\"donate\" id=\"donate\" class=\"skin\" type=\"text\"><br>
<input value=\"Add Vip\" class=\"skin\" type=\"submit\">
</form>";
}
if($row['admin'] == "2") {
echo <<<END
<tr>
<td valign="top" nowrap="nowrap" style="color:white;padding-top:2px;padding-bottom:2px;font-size:11px;">{$row['id']}
.&nbsp;</td>
<td style="padding-top:2px;padding-bottom:2px; font-size:11px;" valign="top" width="100%"><div style="color:white;"><b>
שם: </b><a href='JavaScript:ShowHide("{$row['id']}")'>
<span dir="rtl"><b><font color="blue">{$row['name']}</font></b></span></a> 
<span dir="ltr" style="color:white;">{$row['date']} ::</span>
<span dir="rtl" style="color:white;">{$edit}{$delete}</span>
<div dir="rtl" style="color:black;border:solid 2px #cdcdcd;background-color:#404040;margin-bottom:3px;padding:3px; font-size:11px;" id="{$row['id']}">
<b>{$row['post']}</b>
<br>
<b>הודעה זאת רשמית מטכנאי האתר.</b>
</div>
</div>
</td>
</tr>
END;
} else if($row['admin'] == "1") {
echo <<<END
<tr>
<td valign="top" nowrap="nowrap" style="color:white;padding-top:2px;padding-bottom:2px;font-size:11px;">{$row['id']}
.&nbsp;</td> 
<td style="padding-top:2px;padding-bottom:2px; font-size:11px;" valign="top" width="100%"><div style="color:white;"><b>
שם: </b><a href='JavaScript:ShowHide("{$row['id']}")'>
<span dir="rtl"><b><font color="red">{$row['name']}</font></b></span></a>
</a> 
<span dir="ltr" style="color:white;">{$row['date']} ::</span>
<span dir="rtl" style="color:white;">{$edit}{$delete}</span>
<div class="admin" dir="rtl" style="color:#cdcdcd;border:solid 2px #cdcdcd;background-color:#404040;margin-bottom:3px;padding:3px; font-size:11px;" id="{$row['id']}">
{$row['post']}
<br><div align="center">
<!--
<a href="http://www.fav.co.il/index.php?dir=app_sites&page=new&outlink=66695" target="_blank">
<font color="green" size="3"  face="David"><b>רוצה לבנות אתר כמו זה בחינם? מעכשיו זה אפשרי</b></font></a> | 
<a href="http://sms.fav.co.il/index.php?dir=app_pub/cellular&page=index&outlink=66695" target="_blank">
<font color="green" size="3"  face="David"><b>הורדות מגניבות לסלולארי</b></font></a><br>
-->
<b>הודעה זאת רשמית מהנהלת האתר.</b>
</div>
</div>
</td>
</tr>
END;
} else {
echo <<<END
<tr>
<td valign="top" nowrap="nowrap" style="color:white;padding-top:2px;padding-bottom:2px;font-size:11px;">{$row['id']}
.&nbsp;</td>
<td class="showname" style="padding-top:2px;padding-bottom:2px; font-size:11px;" valign="top" width="100%"><div style="color:white;"><b>
שם: </b><a href='JavaScript:ShowHide("{$row['id']}")'>
<span dir="rtl"><b>{$line["1"]}<font color={$color}>{$row['name']}</font>{$line["2"]}</a></b></span>
</a> 
<span dir="ltr" style="color:white;">{$row['date']} :: {$showemail}</span>
<span dir="rtl" style="color:white;">{$edit}{$delete}{$addmsg}{$showip}{$addban}{$addvip}{$addvipever}</span>
<table>
<tr align="center">
<td align="right">
<span dir="rtl" style="display:none; color:white;padding-top:2px;padding-bottom:2px;font-size:11px;" id="V-{$row['id']}">{$advip}</span>
<span dir="rtl" style="display:none; color:white;padding-top:2px;padding-bottom:2px;font-size:11px;" id="M-{$row['id']}">{$adms}</span>
<span dir="rtl" style="display:none; color:white;padding-top:2px;padding-bottom:2px;font-size:11px;" id="VEver-{$row['id']}">{$advipever}</span>
</td>
<td align="left">
<span dir="ltr" style="display:none; color:white;font-size:11px;" id="B-{$row['id']}">{$adban}</span>
</td>
</tr>
</table>
<div dir="rtl" style="color:black;border:solid 1px #2c2c2c;background-color:#b1d66b;margin-bottom:3px;padding:3px; font-size:11px;" id="{$row['id']}">
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
<td valign=\"top\" nowrap=\"nowrap\" style=\"padding-top:2px;padding-bottom:2px;font-size:11px;\"><td style=\"padding-top:2px;padding-bottom:2px; font-size:11px;\" valign=\"top\" width=\"100%\">בבסיס הנתונים אין נתונים :(</td></tr>"); 
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
die("<script>alert('ההודעה שלך ארוכה מידי')</script><script>window.location = ''</script>");
}
if (strlen($name) > 30 && !$cuser) {
die("<script>alert('הכינוי שלך ארוך מידי')</script><script>window.location = ''</script>");
}
/* 
if(ord($text) == 10) { 
ie("<script>alert('רק בודקים')</script><script>window.location = ''</script>");
}
for($f=0; $f<strlen($text) ; $f++) {
if( ord($text) > 401) {
die("<script>alert('ניסיון נחמד')</script><script>window.location = ''</script>");
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
		$ban=mysql_query("INSERT INTO `banlist` (`id` ,`ip` ,`from` ,`reason` ,`post` )VALUES ('', '{$ip}', 'AnTi', 'bye gay - {$sname}', '{$text}');"); 
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
	die("<script>alert('אתה לא יכול להכניס כינוי/הודעה רק עם רווחים!')</script><script>window.location = ''</script>");
	}

	$swit5 = mysql_query("SELECT * FROM `Sys-Ban` WHERE `test`= '5'");
	while($row5 = mysql_fetch_array($swit5)) {
		$name = str_replace($row5['before'], $row5['after'], $name );
	}


/*
	$check = mysql_query("SELECT * FROM Sys-TG WHERE ip = '$ip' AND );
	if(mysql_num_rows($check) >= 0){
	die("<script>alert('שגיאה כללית: אנא חכה 5 דקות לשליחת התגובה הבאה')</script><script>window.location = ''</script>");
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

$check7 = mysql_query("SELECT * FROM `Sys-TG` ORDER BY `Sys-TG`.`id` DESC LIMIT 0,1");  
while($row = mysql_fetch_array($check7)) { 
	if($ip == $row['ip']) {
		die("<script>alert('אינך יכול להגיב פעמיים ברצף.')</script><script>window.location = ''</script>");
	}
}




$check8 = mysql_query("SELECT * FROM `Sys-TG` ORDER BY `Sys-TG`.`id` DESC LIMIT 1,2");  
$check9 = mysql_query("SELECT * FROM `Sys-TG` ORDER BY `Sys-TG`.`id` DESC LIMIT 0,1");
while($row4 = mysql_fetch_array($check8)) { 
	while($row2 = mysql_fetch_array($check9)) { 
		if($row2['name'] == "AnTi-BoT") 
		{
			if($ip == $row4['ip']) {
				die("<script>alert('אינך יכול להגיב פעמיים ברצף.')</script><script>window.location = ''</script>");
			}
		}
	}
}

}


	if($_POST['secCode'] != $_SESSION['secCode'] && !$cuser) {
	$Error['msg'] = "<script>alert('קוד אבטחה שגוי')</script><font color=\"black\"><b>קוד אבטחה שגוי</b></font>";
	}
	$funtime = time();
	if(!$name || !$text)
	{
	die("<script>alert('עליך להכניס כינוי ותוכן להודעה לפני פירסומה')</script><script>window.location = ''</script>");
	}
	if($_COOKIE['TG-Id'] == "3")
	{
	$cid = "2";
	$name = $_COOKIE['TG-Username'];
	$ok = mysql_query("INSERT INTO `tvnetc_tvnetdb`.`Sys-TG` (`id` ,`name` ,`email` ,`admin` ,`date` ,`post`,`ip`,`time` )VALUES ('', '$name', '$email', '2', '$date', '$text', '$ip','$funtime');");
	}
	if($_COOKIE['TG-Id'] == "1")
	{
	$cid = "2";
	$name = $_COOKIE['TG-Username'];
	$ok = mysql_query("INSERT INTO `tvnetc_tvnetdb`.`Sys-TG` (`id` ,`name` ,`email` ,`admin` ,`date` ,`post`,`ip`,`time` )VALUES ('', '$name', '$email', '2', '$date', '$text', '$ip','$funtime');");
	}
	else if($_COOKIE['TG-Id'] == "0")
	{
	$name = $_COOKIE['TG-Username'];
	$ok = mysql_query("INSERT INTO `tvnetc_tvnetdb`.`Sys-TG` (`id` ,`name` ,`email` ,`admin` ,`date` ,`post`,`ip`,`time` )VALUES ('', '$name', '$email', '1', '$date', '$text', 'no-ip-4-me','$funtime');");
	} else if($Error['msg'] == ""){
	$ok = mysql_query("INSERT INTO `tvnetc_tvnetdb`.`Sys-TG` (`id` ,`name` ,`email` ,`admin` ,`date` ,`post`,`ip`,`time` )VALUES ('', '$name', '$email', '0', '$date', '$text', '$ip','$funtime');");

		if((!stristr($stext, 'unlimit') === FALSE) || (!stristr($stext, 'אנלימיט') === FALSE) || (!stristr($stext, 'ifile') === FALSE) || (!stristr($stext, 'אןלימיט') === FALSE)) {
		$automsg=mysql_query("INSERT INTO `tvnetc_tvnetdb`.`Sys-TG` (`id` ,`name` ,`email` ,`admin` ,`date` ,`post`,`ip`,`time` )VALUES ('', 'AnTi-BoT', 'im@anti.bot', '1', '$date', 'סיסמאות לUnLimit ול ifile ניתן למצוא רק באיזור הVIP ואין לפרסם אותם בתגובות.<Br>
<br><b>זוהי הודעה אוטומטית ממערכת האתר.</b>', 'no-ip-4-me','0');");
		}
		elseif((!stristr($stext, 'אפשרסיסמ') === FALSE) || (!stristr($stext, 'צריךסיסמ') === FALSE) || 
		(!stristr($stext, 'חייבסיסמ') === FALSE) || (!stristr($stext, 'מתימביאיםסיסמ') === FALSE) || 
		(!stristr($stext, 'מתימוסיפיםסיסמ') === FALSE) || (!stristr($stext, 'לאעובד') === FALSE) || 
		(!stristr($stext, 'תביאוסיסמ') === FALSE) || (!stristr($stext, 'תביאסיסמ') === FALSE) || 
		(!stristr($stext, 'אפשרססמ') === FALSE) || (!stristr($stext, 'תוסיפוססמ') === FALSE) || 
		(!stristr($stext, 'שלחוסיסמ') === FALSE) || (!stristr($stext, 'שלחוססמ') === FALSE) || 
		(!stristr($stext, 'עודסיסמ') === FALSE) || (!stristr($stext, 'עודססמו') === FALSE) ||
		(!stristr($stext, 'שימועוד') === FALSE) || (!stristr($stext, 'תוסיפועוד') === FALSE) ||
		(!stristr($stext, 'מתייהיה') === FALSE) || (!stristr($stext, 'מתיתיהיה') === FALSE) ||
		(!stristr($stext, 'תנוסיסמ') === FALSE) || (!stristr($stext, 'מתיתהיה') === FALSE) ||
		(!stristr($stext, 'חייבסיסמ') === FALSE) || (!stristr($stext, 'חייבססמא') === FALSE) ||
		(!stristr($stext, 'בקשהססמ') === FALSE) || (!stristr($stext, 'בקשהסיס') === FALSE) ||
		(!stristr($stext, 'דחוףססמ') === FALSE) || (!stristr($stext, 'דחוףסיס') === FALSE) ||
		(!stristr($stext, 'מתיססמ') === FALSE) || (!stristr($stext, 'מתיסיס') === FALSE) ||
		(!stristr($stext, 'חייבסיס') === FALSE) || (!stristr($stext, 'חייבססמ') === FALSE)) {
		$automsg=mysql_query("INSERT INTO `tvnetc_tvnetdb`.`Sys-TG` (`id` ,`name` ,`email` ,`admin` ,`date` ,`post`,`ip`,`time` )VALUES ('', 'AnTi-BoT', 'im@anti.bot', '1', '$date', 'אין כרגע סיסמאות, כשיהיה נוסיף.<Br>שים לב, יכול להיות כי הסיסמא באדום עדיין פועלת, האם ניסית אותה? אם לא, רוץ תנסה!</font></a><br><b>זוהי הודעה אוטומטית ממערכת האתר.</b>', 'no-ip-4-me','0');");
		/* }  elseif((!stristr($stext, 'אפשראתהשיר') === FALSE) || (!stristr($stext, 'תשימואתהשיר') === FALSE) || (!stristr($stext, 'תשימושיר') === FALSE) || (!stristr($stext, 'רדיו') === FALSE) || (!stristr($stext, 'שירים') === FALSE) || (!stristr($stext, 'שיר') === FALSE)) {
		$automsg=mysql_query("INSERT INTO `tvnetc_tvnetdb`.`Sys-TG` (`id` ,`name` ,`email` ,`admin` ,`date` ,`post`,`ip`,`time` )VALUES ('', 'Radio-BOT', 'info@yuri198.co.il', '2', '$date', 'אהלן אני הבוט רדיו החדש:)<br>אם אתם מבקשים שירים תראו אותי :)<br>כששדרן, יראה הודעה זאת.<Br>עוד כמה דקות תשמע את השיר ברדיו :)<br><br><b>זוהי הודעה אוטומטית מרדיו האתר.</b>', 'no-ip-4-me','0');"); */
	}		

	}
	if($ok)
	{
	die("<script>alert('התגובה נשלחה')</script><script>window.location = ''</script>");
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
$date3 = date("j.n.y בשעה H:i", $correct_time66);
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
	$by="צוות האתר";
	if($email != "" && $email != " " && $email != NULL) {
	$em2 = explode("@", $email);
	$by = $em2[0];
	} else {
	$by="צוות האתר";
	}
}*/

if(!($by != NULL && $by != "" && $email != NULL && $email != "")) {
	if(($by == "" || $by == " " || $by == NULL)) {
		if($email == "" || $email == " " || $email == NULL) {
		$by="צוות האתר";
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
	die("<script>alert('קיים כבר חשבון שנושא את השם משתמש הזה')</script><script>history.back()</script>");
	}
	if($password22[1] == $password23[1]) {
	die("<script>alert('קיים כבר חשבון עם הסיסמא הזאת')</script><script>history.back()</script>");
	}
} 
} */
if(@mysql_num_rows($check2) == 0) {
	$ok = mysql_query("INSERT INTO `RSS` (`id` ,`password` ,`by` ,`time` ,`max` ,`Top` ,`vip` ,`site` ,`date` )VALUES (NULL , '{$password}', '{$by}', '{$date3}', '{$max}', '{$Top}', '{$vip}', '{$site}', '{$time66}');");
	if($vip == 1)
	{
	$ok2 = mysql_query("INSERT INTO `tvnetc_tvnetdb`.`Sys-TG` (`id` ,`name` ,`email` ,`admin` ,`date` ,`post`,`ip`,`time` )VALUES ('', '{$name}', 'autopass@tv-net.co.il', '{$aid}', '$date2', 'נוספה סיסמא חדשה לאתר {$site} לחברי הVIP בלבד תהנו! :D', 'no-ip-4-me','0');");
		if($by != "" && $pw2 != "" && $email != "" && $password != "")
		{
		if($site == "fileflyer") {
			if(@mysql_num_rows($check22) == 0) {
			$add = mysql_query("INSERT INTO `Sys-User-Vip` (`user_id` ,`username` ,`password` ,`date` ,`email` ,`donate` ,`site` )VALUES ('', '{$by}', '{$pw2}', '{$time2}', '{$email}', 'vip', '{$site}');"); 
				if($add != "")
				{		
				mail($email, "VIP at TV-NeT.Co.iL - Free FileFlyer", "UserName: {$by}\n\rPassWord: {$pw2}\nEnJoY! Free FileFlyer Team.", "From: Free FileFlyer <anti.release@gmail.com>");
				die("<script>alert('הסיסמא נוספה בהצלחה והמשתמש קיבל VIP')</script><script>window.location = 'index.php'</script>");
				}
			} else {
			$add = mysql_query("UPDATE `Sys-User-Vip` SET `date` = '{$newdate}' WHERE `Sys-User-Vip`.`user_id` ={$idvip} ;");
				if($add != "")
				{		
				mail($email, "VIP at TV-NeT.Co.iL - Free FileFlyer", "Your User Got More 1 ViP Week \n\r to remind you, here is your details:\r\n UserName: {$by}\n\rPassWord: {$pw2}\nEnJoY! Free FileFlyer Team.", "From: Free FileFlyer <anti.release@gmail.com>");
				die("<script>alert('הסיסמא נוספה בהצלחה ולמשתמש נוסף שבוע VIP נוסף!')</script><script>window.location = 'index.php'</script>");
				}
			}
		} else { 
		die("<script>alert('נכון לעכשיו לא ניתן לקבל VIP על סיסמאות שהן לא לFF - אך הסיסמא נוספה לאתר')</script><script>history.back()</script>"); 
		}
		}
	}
	else
	{
	$ok2 = mysql_query("INSERT INTO `tvnetc_tvnetdb`.`Sys-TG` (`id` ,`name` ,`email` ,`admin` ,`date` ,`post`,`ip`,`time` )VALUES ('', '{$name}', 'autopass@tv-net.co.il', '{$aid}', '$date2', 'נוספה סיסמא חדשה לאתר {$site} ,תודה למשתמש {$by} ששלח לנו אותה בלעדית דרך עמוד הצור קשר שבאתר תהנו חברים!', 'no-ip-4-me','0');");
	/* $ok3 = mysql_query("INSERT INTO `tvnetc_tvnetdb`.`Sys-TG-en` (`id` ,`name` ,`email` ,`admin` ,`date` ,`post`,`ip`,`time` )VALUES ('', '{$name}', 'autopass@tv-net.co.il', '{$aid}', '$date2', 'New pw added :) to site {$site} thanks to {$by} who sent us exclusive pw by the connect us page :D enjoy! :D', 'no-ip-4-me','0');"); */

		if($by != "" && $pw2 != "" && $email != "" && $password != "")
		{
		if($site == "fileflyer") {
			if(@mysql_num_rows($check22) == 0) {
			$add = mysql_query("INSERT INTO `Sys-User-Vip` (`user_id` ,`username` ,`password` ,`date` ,`email` ,`donate` ,`site` )VALUES ('', '{$by}', '{$pw2}', '{$time2}', '{$email}', '{$password}', '{$site}');"); 
				if($add != "")
				{		
				mail($email, "VIP at TV-NeT.Co.iL - Free FileFlyer", "UserName: {$by}\n\rPassWord: {$pw2}\nEnJoY! Free FileFlyer Team.", "From: Free FileFlyer <anti.release@gmail.com>");
				die("<script>alert('הסיסמא נוספה בהצלחה והמשתמש קיבל VIP')</script><script>window.location = 'index.php'</script>");
				}
			} else {
			$add = mysql_query("UPDATE `Sys-User-Vip` SET `date` = '{$newdate}' WHERE `Sys-User-Vip`.`user_id` ={$idvip} ;");
				if($add != "")
				{		
				mail($email, "VIP at TV-NeT.Co.iL - Free FileFlyer", "Your User Got More 1 ViP Week \n\r to remind you, here is your details:\r\n UserName: {$by}\n\rPassWord: {$pw2}\nEnJoY! Free FileFlyer Team.", "From: Free FileFlyer <anti.release@gmail.com>");
				die("<script>alert('הסיסמא נוספה בהצלחה ולמשתמש נוסף שבוע VIP נוסף!')</script><script>window.location = 'index.php'</script>");
				}
			}
		} else { 
		die("<script>alert('נכון לעכשיו לא ניתן לקבל VIP על סיסמאות שהן לא לFF - אך הסיסמא נוספה לאתר')</script><script>history.back()</script>"); 
		}
		}
	}

	if($ok)
	{
	die("<script>alert('הסיסמא נוספה בהצלחה למערכת')</script><script>window.location = ''</script>");
	}
} else {
die("<script>alert('יש כבר סיסמא כזאת במערכת אתה לא יכול להוסיף אותה שוב')</script><script>history.back()</script>");
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
echo " [<a href=\"page1.html\">1</a>] .... "; 
}

if(($page > 100)&&($pageb4100 != 1))
{
echo " [<a href=\"page$pageb4100.html\">$pageb4100</a>] ... "; 
}

if(($page > 10)&&($pageb410 != 1)) 
{
echo " [<a href=\"page$pageb410.html\">$pageb410</a>] ... "; 
}



if($page > 2) {
echo " [<a href=\"page$pageb42.html\">$pageb42</a>]"; }
if($page > 1) 
{
echo " [<a href=\"page$pageb4.html\">$pageb4</a>]"; 
}

echo " [<u>$page</u>]";
if($page<$total_num) 
{
echo " [<a href=\"page$pageafter.html\">$pageafter</a>]";
}
if($page<$total_num-1) 
{
echo " [<a href=\"page$pageafter2.html\">$pageafter2</a>]";
}

if (($total_num > 10)&&($total_num-10>$page)) 
{
echo " .. [<a href=\"page$pageafter10.html\">$pageafter10</a>]"; 
}
if (($total_num >100)&&($total_num-100>$page))
{
echo " ... [<a href=\"page$pageafter100.html\">$pageafter100</a>]"; 
}

if($page<$total_num-2)
{
echo " .... [<a href=\"page$total_num.html\">$total_num</a>]";
}


/*
for($I = 1; $I<= $total_num; $I++)
{
   if($page != $I)
        echo " [<a href=\"page$I.html\">$I</a>]";
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
echo("<div align=\"center\"><b style=\"color:#1346AC;cursor:pointer\">אסור לך להגיב,<br>אתה צריך להמתין 5 דקות.</b></div>");
}*/
?>
	<b style="color:#1346AC;cursor:pointer" onclick="ShowHide('Write')">שלח תגובה</b>
	</td>
	</tr>
	<tr style="display:; font-size:11px;" id="Write">
	<td style="padding-top:2px;padding-bottom:2px" colspan="2" style="border:0;margin-top;margin-bottom:3px;padding:3px;font-size:11px;">
<a name="Send"></a>

<?php
if($Error['msg'] != "") {
$errors = <<<EOF
<tr>
	<td width="94"><span lang="he">שגיאה: </span></td>
	<td width="341">{$Error['msg']}</td>
</tr>
EOF;
}


if($_COOKIE['TG-Id'] == "0" || $_COOKIE['TG-Id'] == "1")
{
echo <<<EOF
<form method="post" name="postform" onsubmit="submitonce(this)">
<input type="hidden" name="posted" value="1"> 
		<table style="border:solid 1px #e1e1e1;background-color:#787878;font-size:11px;" cellspacing="0" cellpadding="0"  id="table2" width="437">
		<tr>
			<td width="94"><span lang="he">שם השולח*: </span></td>
			<td width="341">
		<input style="width:88%" maxlength="20" name="name" readonly="readonly" value="{$_COOKIE['TG-Username']}"></td>
		</tr>
		<tr>
			<td width="94"><span lang="he">אימייל*: </span></td>
			<td width="341">
		<input style="width:88%" maxlength="20" name="email" readonly="readonly" value="{$cemail}"></td>
		</tr>
		<tr><td width="94">תוכן</td>
		<td width="341">	<textarea rows="5" name="text" cols="40" id="replytext" onkeydown="textCounter(document.postform.text,document.postform.remLen1,15000)" onkeyup="textCounter(document.postform.text,document.postform.remLen1,15000)"></textarea></td>
		</tr>
		<tr><td align="center" width="94">
		<p align="right">BBCode And <br>Smilies</td>
			<td align="center" width="341">
<img src="emoticons/ninja.gif" alt="[ninja]" title="[ninja]" onclick="emoticon('ninja')" onkeypress="emoticonp('ninja')">
<img src="emoticons/clap.gif" alt="[כל הכבוד]" title="[clap]" onclick="emoticon('clap')" onkeypress="emoticonp('clap')">
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
		* נותרו עוד <input type="text" class="te4" readonly="readonly" name="remLen1" size="4" maxlength="4" value="15000"/> תווים</font>
		</td>
		</tr>
		<tr>
			<td colspan="2" align="center">
<input type="submit" name="submit" class="Text" value="הוסף תגובה"></td>
		</tr>
		</table>
		</form>
EOF;
} else if($_COOKIE['TG-Id'] == "3"){
echo <<<EOF
<form method="post" name="postform" onsubmit="submitonce(this)">
<input type="hidden" name="posted" value="1"> 
		<table style="border:solid 1px #e1e1e1;background-color:#787878;font-size:11px;" cellspacing="0" cellpadding="0"  id="table2" width="437">
		<tr>
			<td width="94"><span lang="he">שם השולח*: </span></td>
			<td width="341">
		<input style="width:88%" maxlength="20" name="name" readonly="readonly" value="{$_COOKIE['TG-Username']}"></td>
		</tr>
		<tr>
			<td width="94"><span lang="he">אימייל*: </span></td>
			<td width="341">
		<input style="width:88%" maxlength="20" name="email" readonly="readonly" value="{$vemail}"></td>
		</tr>
		<tr><td width="94">תוכן</td>
		<td width="341">	<textarea rows="5" name="text" cols="40" id="replytext" onkeydown="textCounter(document.postform.text,document.postform.remLen1,500)" onkeyup="textCounter(document.postform.text,document.postform.remLen1,500)"></textarea></td>
		</tr>
		<tr><td align="center" width="94">
		<p align="right">BBCode And <br>Smilies</td>
			<td align="center" width="341">
<img src="emoticons/ninja.gif" alt="[ninja]" title="[ninja]" onclick="emoticon('ninja')" onkeypress="emoticonp('ninja')">
<img src="emoticons/clap.gif" alt="[כל הכבוד]" title="[clap]" onclick="emoticon('clap')" onkeypress="emoticonp('clap')">
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
		* נותרו עוד <input type="text" class="te4" readonly="readonly" name="remLen1" size="4" maxlength="4" value="500"/> תווים</font>
		</td>
		</tr>
		<tr>
			<td colspan="2" align="center">
<input type="submit" name="submit" class="Text" value="הוסף תגובה"></td>
		</tr>
		</table>
		</form>
EOF;
} else {
echo <<<EOF
<form method="post" name="postform" onsubmit="submitonce(this)">
<input type="hidden" name="posted" value="1"> 
		<table style="border:solid 1px #e1e1e1;background-color:#787878;font-size:11px;" cellspacing="0" cellpadding="0"  id="table2" width="437">
		{$errors}
		<tr>
			<td width="94"><span lang="he">שם השולח*: </span></td>
			<td width="341">
		<input style="width:88%" maxlength="25" name="name"></td>
		</tr>
		<tr>
			<td width="94"><span lang="he">אימייל: </span><br /><font color="darkred"><b>שדה זה אינו חובה אבל מומלץ.</b></font></td>
			<td width="341">
		<input style="width:88%" maxlength="40" name="email"></td>
		</tr>
		<tr><td width="94">תוכן</td>
		<td width="341">	<textarea rows="6" name="text" cols="40" id="replytext" onkeydown="textCounter(document.postform.text,document.postform.remLen1,300)" onkeyup="textCounter(document.postform.text,document.postform.remLen1,300)">{$_POST['text']}</textarea></td>
		</tr>
		<tr><td width="26">קוד אבטחה:</td>
			<td width="341">
		<img src="SecCode.php" width="71" height="21" align="absmiddle"> <b>»</b><br><input type="text" name="secCode">
		</td>
		<tr><td align="center" width="94">
		<p align="right">BBCode And <br>Smilies</td>
			<td align="center" width="341">
<img src="emoticons/ninja.gif" alt="[ninja]" title="[ninja]" onclick="emoticon('ninja')" onkeypress="emoticonp('ninja')">
<img src="emoticons/clap.gif" alt="[כל הכבוד]" title="[clap]" onclick="emoticon('clap')" onkeypress="emoticonp('clap')">
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
		* נותרו עוד <input type="text" class="te4" readonly="readonly" name="remLen1" size="4" maxlength="4" value="300"/> תווים</font>
		</td>
		</tr>
		<tr>
			<td colspan="2" align="center">
<input type="submit" name="submit" class="Text" value="הוסף תגובה"></td>
		</tr>
		</table>
		</form>
<a name="Vip"></a>
<table style="border:0;" cellspacing="0" cellpadding="0" id="table2">
	<tr style="display:none; font-size:11px;" id="Admin4">
	<td style="padding-top:2px;padding-bottom:2px" colspan="2" style="border:0;margin-top;margin-bottom:3px;padding:3px;font-size:11px;">
<form action="login-vip.php" method="post">
		<table style="border:solid 1px #e1e1e1;background-color:#787878;font-size:11px;" cellspacing="0" cellpadding="0"  id="table2" width="437">
		<tr>
		<tr><td width="94">שם משתמש:</td>
			<td width="341">
		<input type="text" style="width:100%" maxlength="50" name="username"></td></tr>
		</tr>
		<tr><td width="94">סיסמה:</td>
			<td width="341">
		<input type="password" style="width:100%" maxlength="50" name="password"></td>
		</tr>
		<tr><td width="26">קוד אבטחה:</td>
			<td width="341">
		<img src="SecCode.php" width="71" height="21" align="absmiddle"> <b>»</b><br><input type="text" name="secCode">
		</td>
			<td colspan="2" align="center">
<input type="hidden" name="GoLogin" value="1">  
<input type="submit" value="התחבר!"> </td></tr>
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
		<table style="border:solid 1px #e1e1e1;background-color:#787878;font-size:11px;" cellspacing="0" cellpadding="0"  id="table2" width="435">
		<tr>
		<tr>
			<td colspan="2" align="center">
<a href="sl-sendlogin.php?act=Logout"><span style="color:#1346AC;cursor:pointer">התנתק</span></a> </td></tr>
		</tr>
		</table>
		</form>
</table>
<a name="Add"></a>
<table style="border:0;" cellspacing="0" cellpadding="0" id="table2">
	<tr style="display:none; font-size:11px;" id="Admin3">
	<td style="padding-top:2px;padding-bottom:2px" colspan="2" style="border:0;margin-top;margin-bottom:3px;padding:3px;font-size:11px;">
<form action="?" method="post" name="tgo">
		<table style="border:solid 1px #e1e1e1;background-color:#787878;font-size:11px;" cellspacing="0" cellpadding="0"  id="table2" width="437">
		<tr>
		<tr><td width="94">הסיסמא:</td>
			<td width="341">
		<input type="text" style="width:100%" maxlength="50" name="password"></td></tr>
		</tr>
		<tr><td width="94">ע"י:</td>
			<td width="341">
		<input type="text" style="width:70%" maxlength="50" name="by"> מקס לקיחות: 
		<input type="text" style="width:8%" maxlength="3" name="max" value="100"></td>
		</tr>
<!--
		<tr><td width="94">שעה:</td>
			<td width="341">
		<input type="text" style="width:100%" maxlength="50" name="time"></td>
		</tr>
-->
		<tr><td width="94">email:</td>
			<td width="341">
		<input type="text" style="width:100%" maxlength="50" name="email"></td>
		</tr>
		<tr><td width="94">התחברות:</td>
			<td width="341">
		<input type="text" style="width:80%" maxlength="50" name="pw2">
		<input type="button" style="width:19%" name="rand" onclick="rando();" value="rand"></td>
		</tr>
		<tr><td width="94">לקיחה:</td>
			<td width="341">
		<input type="radio" name="Top" value="0"> = לא | 
		<input type="radio" name="Top" value="1" checked> = כן</td>

</td>
		</tr>
		<tr><td width="94">סיסמא לVIP:</td>
			<td width="341">
		<input type="radio" name="vip" value="0" checked> = לא | 
		<input type="radio" name="vip" value="1"> = כן</td>
		</tr>
		<tr><td width="94">אתר:</td>
			<td width="400" dir=ltr>
		<input type="radio" name="site" value="runningfile">=RF
		<input type="radio" name="site" value="letitbit">=LB
		<input type="radio" name="site" value="rapidshare">=RS
		<input type="radio" name="site" value="vipfile">=VF
		<input type="radio" name="site" value="unlimit">=UL
		<input type="radio" name="site" value="sex">=sex
		<input type="radio" name="site" value="fileflyer" checked>= FF</td>
		</tr>
			<td colspan="2" align="center">
<input type="hidden" name="anp" value="yes">  
<input onclick="rando2();" type="submit" name="submit" value="שלח סיסמא חדשה"> </td></tr>
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
<form action="sl-sendlogin.php" method="post">
		<table style="border:solid 1px #e1e1e1;background-color:#787878;font-size:11px;" cellspacing="0" cellpadding="0"  id="table2" width="437">
		<tr>
		<tr><td width="94">שם משתמש:</td>
			<td width="341">
		<input type="text" style="width:100%" maxlength="50" name="user"></td></tr>
		</tr>
		<tr><td width="94">סיסמה:</td>
			<td width="341">
		<input type="password" style="width:100%" maxlength="50" name="password"></td>
		</tr>
		<tr><td width="26">קוד אבטחה:</td>
			<td width="341">
		<img src="SecCode.php" width="71" height="21" align="absmiddle"> <b>»</b><br><input type="text" name="secCode">
		</td>
			<td colspan="2" align="center">
<input type="hidden" name="GoLogin" value="1">  
<input type="submit" value="התחבר!"> </td></tr>
		</tr>
		</table>
		</form>
</table>
</body>
</html>
