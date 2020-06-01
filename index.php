<?
ob_start();
@session_start();

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" >
<html dir=rtl>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1255"> 
<?
$siteurl="freeff.co.il";
$kod=7;
$word="k2k";
if($_POST['imnit'] == $kod) {
setcookie ('imno1t', $word, time() + (60*60*24*30*10));
echo <<<EOF
<script>window.location='index.php';</script>
EOF;
die();
}




$agent = $_SERVER['HTTP_USER_AGENT'];
$google=false;


$cc2=explode("Google",$agent);
if($cc2[1] != "") { $google=true; }
$cc3=explode("Bing",$agent);
if($cc3[1] != "") { $google=true; }


if($agent=="GoToFFF") { die(); }

        $time2 = microtime();
        $time2 = explode(" ", $time2);
        $phpLoadStart = $time2[1] + $time2[0];
        
	include("banlist.php");
	include("functions.php");
$max2=3;
	$GLOBALS["vip"] = 0;
	if(getUserVip2($_COOKIE['TG-Vip']) == 1 && $_COOKIE['TG-Vip'] != "" && isset($_COOKIE['TG-Vip']))
	{
		$GLOBALS["vip"] = 1;
		if(isset($_COOKIE['tvnet_ip']))
		{
			$ip = $_SERVER['REMOTE_ADDR'];
			setcookie("tvnet_ip", 0, time() - (24 * 60 * 60)); 
			mysql_query("DELETE FROM `downloads` WHERE `ds_ip`='$ip'");
			header('Location: index.php');
		}
		
	}
	
	$ip = $_SERVER['REMOTE_ADDR'];
	$query_ip  = mysql_query("SELECT * FROM `downloads` WHERE `ds_ip`='$ip'");	
	$array_ip = mysql_fetch_array($query_ip);
	$num_rows = mysql_num_rows($query_ip);
	$download_num = $num_rows;

	mysql_query("DELETE FROM `downloads` WHERE UNIX_TIMESTAMP() - `ds_time` > 86400");

	
	$url = $_SERVER["HTTP_HOST"];
	$url2 = explode(".", $url);
	if($url == "188.138.43.15") {
	$http = 0;
	$suf = "php";
$start1="?site=";
$end1="";
	} else {
	$http = 1;
	$suf = "html";
$start1="site-";
$end1=".html";
	}
	if($url2[0] != "www" && $http == 1)
	{
		header('Location: http://www.'.$url);
	}



?>
<?php
$site = mysql_real_escape_string(htmlspecialchars($_GET["site"]));
$err = mysql_real_escape_string(htmlspecialchars($_GET["err"]));
?>


<?
if($site == "") {
echo <<<EOF
<title>Free FileFlyer | סיסמאות לfileflyer חינם | פיילפלייר | פתיחת לינקים</title>
EOF;
} else {
echo <<<EOF
<title>Free {$site} | סיסמאות ל{$site} בחינם | פתיחת לינקים | סיסמא</title>
EOF;
}
?>

<?
/*
$refresh = mysql_real_escape_string(htmlspecialchars($_GET["refresh"]));

if(($refresh != "") && (($refresh < 30) || ($refresh > 999999))) {
die("<script>alert('אתה לא יכול להכניס מספר קטן מ-30 או גדול מידי')</script><script>window.location = ''</script>");
}

if($site == "") {
$refreshsite = "index.php";
} else {
$refreshsite = "site-{$site}.html";
}

if($refresh == "") {
echo <<<EOF
<meta http-equiv="Refresh" content="300; URL={$refreshsite}">
EOF;
} else {
echo <<<EOF
<meta http-equiv="Refresh" content="{$refresh}; URL={$refreshsite}?refresh={$refresh}">
EOF;

}
popup
http://ads.clickosmedia.com/freeff.php
*/

if($err=="8") {
echo ('<meta http-equiv="Refresh" content="300; URL=index.php?err=8">');
} else { 
echo ('<meta http-equiv="Refresh" content="300; URL=index.php">');
}
?>

<link rel="shortcut icon" href="favicon.ico">
<link type="application/rss+xml" rel="alternate" href="rss.php" title="עדכוני RSS">
<script type="text/javascript" src="js.js"></script>
<link rel="stylesheet" href="style.css" type="text/css">

<meta http-equiv="Content-Language" content="he"> 
<META NAME="description" CONTENT="אצלנו תוכלו למצוא סיסמאות לfileflyer ומגוון שרתים נוספים בחינם, וכמו כן מערכת לפתיחת לינקים איכותית בחינם ללא צורך בסיסמא">
<meta name="author" content="AnTi"> 
<meta name="copyright" content="2008-2012, AnTi Team"> 
<meta name="keywords" content="סיסמאות לfileflyer,פתיחת לינקים,fileflyer,free,סיסמאות,סיסמא,סיסמאות לff"> 
<META NAME="language" CONTENT="hebrew">
<META NAME="revisit-after" CONTENT="1">
<META NAME="robot" CONTENT="index,follow">
<meta name="google-site-verification" content="ZNnVL_R9gXS_fvQ2VbfOfST24L-U1G7yPgI3z2D1Gb4" />
<script type="text/javascript" src="https://apis.google.com/js/plusone.js"></script>
</head>
<body alink=white vlink=white link=white  topmargin="0" leftmargin="0" rightmargin="0" bottommargin="0" bgcolor=#E7E8E3>

<center>
<div id="divbody">

<table id="bar" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td id="bar-ad">
<center>
<? include('ads/468.php'); ?>
</center>
</td>
		<td>
			<img border="0" src="images/logo.png" width="285" height="75"></td>
	</tr>
	<tr>
		<td height="10" colspan="2"></td>
	</tr>
	</table>

<div id="shail"></div>

<table class="menu" id="bar-menu" width="100%" cellspacing="0" cellpadding="0">
	<tr> <? $suf="php"; ?>
		<td><a class="linkgreen" href="index.php">עמוד ראשי</a></td>
		<td> <a class="linkgreen" href="connect.<? echo $suf; ?>">שלח סיסמה</a></td>
		<td> <a class="linkgreen" href="#" onclick="vip();">אזור <span lang="en-us">ViP</span></a></td>
		<td> <a class="linkgreen" href="faq.<? echo $suf; ?>">שאלות ותשובות</a></td>
		<td> <a class="linkgreen" href="http://freefileflyer.ourtoolbar.com/" onmouseover="this.innerHTML='מערכת ההתראות נמצאת בסרגל'" onMouseOut="this.innerHTML='סרגל הכלים מערכת התראות'" target=_blank>סרגל הכלים מערכת התראות</a></td>
		<td> <a class="linkgreen" href="connect.<? echo $suf; ?>">צור קשר</a></td>
<td width=30% align=left>

<a class="linkgreen" href="javascript:CreateBookmarkLink();">
הוסף למועדפים
</a>
&nbsp; 
<a class="linkgreen" onClick="setHomepage();">
הפוך לדף הבית
</a>&nbsp; &nbsp;
</td>
		<!--<td  aligen=left>ששש</td>-->
	</tr>
</table>

<table id="lbar" border="0" cellspacing="0" cellpadding="0" width="100%" height="127">
	<tr>
		<td id="first-message" link=black alink=black vlink=black>
<?php

if($site == "") {
echo <<<EOF
			<B>ברוכים הבאים ל <a href="http://www.{$siteurl}"><font color=black>Free FileFlyer</font></a>.<br></b>
			באתר הזה תמצאו <a href="http://www.{$siteurl}"><font color=black>סיסמאות</a> למגוון <a href="http://www.{$siteurl}"><font color=black>שרתים</font></a> נוספים אשר יאפשרו לכם <a href="http://www.{$siteurl}"><font color=black>הורדה</font></a> ללא צורך בקניית <a href="http://www.{$siteurl}"><font color=black>סיסמא</font></a>.<br>
			רוצה את ה<a href="http://www.{$siteurl}"><font color=black>סיסמאות</font></a> הכי טובות? לחץ על ה<a href="http://www.{$siteurl}vip.html"><font color="black">ViP</font></a> בתפריט למעלה.<br>
			חברי ה<a href="http://www.{$siteurl}/vip.html"><font color="black">ViP</font></a> מקבלים את <a href="http://www.{$siteurl}"><font color=black>סיסמאות</font></a> הכי טובות, של ה7 ימים. כל מה שעליך לעשות הוא לשלוח לנו <a href="http://www.{$siteurl}"><font color=black>סיסמא</font></a> אחת ולהנות .<Br>
			כל ה<a href="http://www.{$siteurl}"><font color=black>סיסמאות</font></a> שלנו נקנות על ידי צוות האתר או על ידי המשתמשים באתר. אנחנו לא פורצים / גונבים אותם.
			<BR><B>באתר שלנו תמצאו גם <a href="http://multidown.co.il/" target=_blank><font color="RED"><u>מערכת לפתיחת לינקים</u></font></a>
EOF;
} else {
echo <<<EOF
			<div id="idcs"><br />
			<b>ברוכים הבאים ל <a href="http://www.{$siteurl}"><font color=black>Free {$site}</font></a>.</b><br>
			באתר הזה תמצאו <a href="http://www.{$siteurl}"><font color=black>סיסמאות</font></a> לאתר <a href="http://www.{$siteurl}"><font color=black><font color="black">{$site}</font></a> אשר יאפשרו לכם <a href="http://www.{$siteurl}"><font color=black>הורדה</font></a> ללא צורך בקניית <a href="http://www.{$siteurl}"><font color=black>סיסמא</font></a>.<br>
			רוצה את ה<a href="http://www.{$siteurl}"><font color=black>סיסמאות</font></a> הכי טובות? לחץ על ה<a href="http://www.{$siteurl}/vip.html"><font color="black">ViP</font></a> בתפריט למעלה.<br>
			חברי ה<a href="http://www.{$siteurl}vip.html"><font color="black">ViP</font></a> מקבלים את <a href="http://www.{$siteurl}"><font color=black><font color="black">סיסמאות</font></a> הכי טובות, של ה7 ימים. כל מה שעליך לעשות הוא לשלוח לנו <a href="http://www.{$siteurl}"><font color=black>סיסמא</font></a> אחת ולהנות .<Br>
			כל ה<a href="http://www.{$siteurl}"><font color=black>סיסמאות</font></a> שלנו נקנות על ידי צוות האתר או על ידי המשתמשים באתר. אנחנו לא פורצים / גונבים אותם.<br>
			אם חיפשתם <a href="http://www.{$siteurl}"><font color=black>סיסמאות ל{$site}</font></a> אז הגעתם למקום הנכון! רק כאן תקבלו <a href="http://www.{$siteurl}"><font color=black>סיסמאות לשרתים</font></a> בחינם!
</div>

EOF;
}

?>
<!--
<b><a href="http://live.sekindo.com/live/liveClick.php?id=2347028&subId=DEFAULT" target=_blank><font color=purple style="font-size: 15px;">בנה אתר כמו זה, לגמרי בחינם! ללא ידע מוקדם!</font></a>

</b> 
<br>
<BR><b><a href="http://live.sekindo.com/live/liveClick.php?id=2527214&subId=DEFAULT" target=_blank><font color=purple style="font-size: 18px;">בנה אתר כמו זה, לגמרי בחינם! ללא ידע מוקדם!</font></a></b>
	-->	
		</td>
		<td id="vip-login">
<? if($GLOBALS["vip"] == 1) { ?>
<center>אתה מחובר למערכת ! <Br>
<a href="#" onclick="vip();">לאיזור הVIP לחץ כאן</a>
</center>
<? } else { ?>
		<form action="login-vip.php" method="post">
		<input type="hidden" name="GoLogin" value="1">  
		<table border="0" width="165" style="font-size: 11px; color: #C0C0C0" cellspacing="0" cellpadding="0">
			<tr>
				<td rowspan="6" style="padding-right: 20px"></td>
				<td colspan="4" height="10">
				</td>
			</tr>
			<tr>
				<td colspan="4">
<input type="text" name="username" size="16" onclick="this.select();" style="font-size: 11px; color: #CCCCCC; width: 142; height: 22; border: 2px solid #333333; background-color: #333333; background-image: url('images/input-text.png'); font-family:Arial" value="שם משתמש"></td>
			</tr>
			<tr>
				<td colspan="4">
<input type="password" name="password" size="16" onclick="this.select();" style="font-size: 11px; color: #CCCCCC; width: 142; height: 22; border: 2px solid #333333; background-color: #333333; background-image: url('images/input-text.png'); font-family:Arial" value="סיסמה"></td>
			</tr>
			<tr>
				<td>
<input type="text" name="sec2" size="6" onclick="this.select();" style="font-size: 11px; color: #CCCCCC; width: 68; height: 22; border: 2px solid #333333; background-color: #333333; background-image: url('images/input-text.png'); font-family:Arial" value="קוד אימות"></td>
				<td colspan="2">
			</td>
				<td>
				<img border="0" id="ssss" src="SecCode2.php"></td>
			</tr>
			<tr>
				<td colspan="2" height="30"><u><font size="1">
				<!--<a class="linkwhite" href="javascript:alert('בקרוב')"">שכחתי סיסמה</a></font></u>--></td>
				<td colspan="2" height="30">
				<p align="center">
				<input type="submit" value="התחבר!" style="font-size: 11px; font-family: Arial; color: #97BF0D; border: 1px solid #333333; background-color: #515151; width:55; height:18; font-weight:bold"></td>
			</tr>
		</table>
		</form>
		</td>
<? } ?>
	</tr>
</table>

<div style="font-size: 14px;" align=center>
<center>
<!--
<table border='0' cellspacing='0' cellpadding='0'><tr><td>
</td></tr></table>


-->

</center>
</div>

<table border="0" width="789" cellspacing="0" cellpadding="0">
	<tr><td height="10"></td></tr>
	<tr>
		<td align=center>


<table border='0' cellspacing='0' cellpadding='0'><tr><td>
			
</td></tr></table>

</td>
	</tr>


</table><br>

<center><font size=5 color="orange"><b>עזרנו לכם? אהבתם את האתר? לחצו +1</b></font> <g:plusone></g:plusone> <iframe src="//www.facebook.com/plugins/like.php?href=https%3A%2F%2Fwww.facebook.com%2FMultiDown.co.il&amp;send=false&amp;layout=button_count&amp;width=150&amp;show_faces=true&amp;action=like&amp;colorscheme=light&amp;font=arial&amp;height=21" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:150px; height:21px;" allowTransparency="true"></iframe></center>
<center><Br><iframe src=333.php width=728 height=100 border=0 frameborder="0" scrolling=no></iframe></center>
<table border="0" width="100%" id="table1" cellspacing="0" cellpadding="0">
	<tr>
		<td height="20" colspan="8"></td>
	</tr>

<? 

echo <<<EOF



	<tr width="783" height="31" align="right">
		<td width="20" id="pass-bar"></td>
		<td id="pass-bar" width="113" height="31" background="images/T.png" align="center"><a href="index.php" class="linkblack">הצג הכל</a></td>
		<td id="pass-bar" width="100" height="31" background="images/menu-bg.png" align="center"><a href="{$start1}fileflyer{$end1}" class="linkblack">FileFlyer</a></td>
		<td id="pass-bar" width="90" height="31" background="images/menu-bg.png" align="center"><a href="{$start1}runningfile{$end1}" class="linkblack">RunningFile</a></td>
		<td id="pass-bar" width="80" height="31" background="images/menu-bg.png" align="center"><a href="{$start1}vipfile{$end1}" class="linkblack">VIP-File</a></td>
		<td id="pass-bar" width="80" height="31" background="images/menu-bg.png" align="center"><a href="{$start1}letitbit{$end1}" class="linkblack">LetitBit</a></td>
		<td id="pass-bar" width="80" height="31" background="images/menu-bg.png" align="center"><a href="{$start1}unlimit{$end1}" class="linkblack">UnLimit</a></td>
		<td id="pass-bar" width="96" height="31" background="images/menu-bg.png" align="center"><a href="{$start1}rapidshare{$end1}" class="linkblack">פרימיומים חינם</a></td>
		<td id="pass-bar" width="54" height="31" background="images/O.png" align="center"></td>
		<td width="176" style="height: 31px;font-weight: bold;font-size: 13px;" height="31" align=right><!--
		<a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=8Q8AUTSK395W2"><img src="https://www.paypal.com/en_US/i/btn/btn_donate_LG.gif" border=0></a>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=9VD7DWQ9CUK4Q"><img src="https://www.paypal.com/en_US/i/btn/btn_buynow_LG.gif" border=0></a> -->
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		</td>

<!-- 		<td id="pass-bar" width="61" height="31" background="images/O.png" align="center"><a href="{$start1}sex{$end1}" class="linkblack" onclick="return sex();" name=sex1>+18</a></td>
		<td width="106" style="height: 31px;font-weight: bold;font-size: 13px;" height="31" align=right><a href="javascript:se();" id="sex2">(הסתר)</a></td>-->
	</tr>
EOF;

?>
	</table>
<?

if($site=="sex" && $_COOKIE['tvsex'] == "1") {
die("<script>alert('אינך יכול לצפות בתכנים אלו')</script><script>window.location = 'index.php'</script>");
}


$text23="";
if($site == "") {
$sqls = "";
$sq = "";
/*

<a href=http://freefileflyer.ourtoolbar.com/'.$bro.' target=_blank><font color=brown>הורידו את סרגל הכלים שלנו חינם!</font></a>

include("browser.php");
$bro="";
if(is_browser('firefox')) {
$bro="xpi"; }
if(is_browser('ie')) {
$bro="ie"; }
if(is_browser('safari')) {
$bro="sf"; }
*/


$text23='<div style="width:600px;height:20px;border:2px dotted blue;">
<a href="http://multidown.co.il/?r=6cab55353" target="_blank"><span style="color: red;">רוצה להוריד מ- Fileflyer, Shareflare, Letitbit ועוד הרבה אחרים? לחץ כאן</span></a><BR>
</div>';
} else {
$sqls = "AND `site` = '{$site}' ";
$sq = "WHERE `site` = '{$site}' ";
$text23="אתה צופה כעת באתה צופה כעת ב <a href=site-{$site}.html><font color=black>סיסמאות ל{$site}</font></a>";
if($site=="steam") {
 $text23="לקניית סטימים במחירים זולים צרו קשר: tamirmoney@gmail.com"; }
}


$query = mysql_query("SELECT count(*) as total FROM `RSS` {$sq}");
$row = mysql_fetch_array($query, MYSQL_ASSOC);
$total = $row['total'];

$query2 = mysql_query("SELECT count(*) as total FROM `downloads`");
$row3 = mysql_fetch_array($query2, MYSQL_ASSOC);
$totaltake = $row3['total'];

$password = mysql_query("SELECT * FROM `RSS` WHERE `vip` = '0' {$sqls} ORDER BY `RSS`.`id` DESC LIMIT 0 , 6");  
?>
<table border="0" width="100%" id="pass-table" cellspacing="0" cellpadding="0">
	<tr>
		<td  id="pass-block" rowspan="5">
		<table border="0" width="100%" cellspacing="0" cellpadding="0" style="text-align: center">
			<tr>
				<td colspan="3" id="pass-block-info">
				<b>
				<? echo $text23; ?>
				</b>
				</td>
			</tr>
			<tr>
<?
$i = 1;
while($pass = @mysql_fetch_array($password)) {
	if ($i % 3 == 0)
	{
		$j = "</tr><tr>";
	} else  {
		$j = "";
	}
$id = $pass['id'];
$ap = $pass['password'];
$time = $pass['time'];
$author = $pass['by'];
$date = $pass['date'];
$site2 = $pass['site'];
$time2 = str_replace( 'בשעה', '&nbsp;', $time );
$max = $pass['max'];
if($max == NULL || $max == "" || $max == " ") {
$max = 50;
}
$active = 1;

$query_userDownload = mysql_query("SELECT * FROM `downloads` WHERE `ds_passId`='$id'");
$num_userDownload = mysql_num_rows($query_userDownload);
if(($pass['date'] + 60*10) <= time() || $num_userDownload >= $max)
{
	mysql_query("UPDATE `RSS` SET `Top`='0' WHERE `id`='$id'") or die(mysql_error());
	$active = 0;
}

$query_getPass = mysql_query("SELECT * FROM `downloads` WHERE `ds_ip`='$ip' and `ds_passId`='$id'");
$array_getPass = mysql_fetch_array($query_getPass);
$num_getPass = mysql_num_rows($query_getPass);

if($site2 == "sex") { 
$pass2 = explode(";", $ap);
$site3 = $pass2[1];
$al= "onclick='return sex();' id='sex3'";
$al2= "onclick='return sex();' id='sex4'";
$text = "מבוגרים בלבד ישראלי"; 
} elseif ($site2 =="rapidshare") { 
$text = "קח חשבון פרימיום";
$pass22 = explode(";", $ap);
$site3 = $pass22[3];

} elseif ($site2 =="uploadil") { 
$text = "קח חשבון upload-il";$site3="upload-il"; 
}
$site22=strtolower($site2);

if($site2 == "rapidshare" || $site2 == "sex" || $site2=="uploadil") {
	if($num_userDownload < $max && $active == 1) { $music = 1; }
?>
				<td>
				<table border="0" width="100%" id="pass-on" cellspacing="0" cellpadding="0">
					<tr>
						<td id="pass-pass-on" colspan="2"><a href="site-<? echo $site22; ?>.html" <? echo $al2; ?>><font color=#008000>סיסמאות ל<? echo $site3; ?></font></a><br>
						<font size="3"><a href="download.php?id=<? echo $id; echo '"'; echo $al; ?> ><? echo $text; ?></a></font></td>
					</tr>
					<tr>
						<td id="pass-info">
						נלקח: 
						<? echo "$max"; ?> / <? echo $num_userDownload; ?>
						<br>
						ע"י: 
						<? echo $author; ?></td>
						<td id="pass-time"><? echo $time2; ?>
						</td>
					</tr>
				</table>
				</td>
<?
} elseif($pass["Top"] == 0 || $active == 0) {
?>
				<td>
				<table border="0" width="100%" id="pass-on" cellspacing="0" cellpadding="0">
					<tr>
						<td id="pass-pass-off" colspan="2"><a href="site-<? echo $site22; ?>.html"><font color=#CC0000>סיסמא ל<? echo $site2; ?></font></a><br>
						<font size="3"><a name="<? echo $id; ?>" onclick="window.clipboardData.setData('text','<? echo $ap; ?>');"><? echo $ap; ?></a></font></td>
					</tr>
					<tr>
						<td id="pass-info">
						נלקח: 
						<? echo "$max"; ?> / <? echo $num_userDownload; ?>
						<br>
						ע"י: 
						<? echo $author; ?></td>
						<td id="pass-time"><? echo $time2; ?>
						</td>
					</tr>
				</table>
				</td>
<?
} elseif($num_getPass > 0 || $GLOBALS["vip"] == 1) { 
?>
				<td>
				<table border="0" width="100%" id="pass-on" cellspacing="0" cellpadding="0">
					<tr>
						<td id="pass-pass-on" colspan="2"><a href="site-<? echo $site22; ?>.html"><font color=#008000>סיסמאות ל<? echo $site2; ?></font></a><br>
						<font size="3"><a name="<? echo $id; ?>" onclick="window.clipboardData.setData('text','<? echo $ap; ?>');"><? echo $ap; ?></a></font></td>
					</tr>
					<tr>
						<td id="pass-info">
						נלקח: 
						<? echo "$max"; ?> / <? echo $num_userDownload; ?>
						<br>
						ע"י: 
						<? echo $author; ?></td>
						<td id="pass-time"><? echo $time2; ?>
						</td>
					</tr>
				</table>
				</td>
<?
 } else { 
$music = 1;
?>
				<td>
				<table border="0" width="100%" id="pass-on" cellspacing="0" cellpadding="0">
					<tr>
						<td id="pass-pass-on" colspan="2"><a href="site-<? echo $site22; ?>.html"><font color=#008000>סיסמאות ל<? echo $site2; ?></font></a><br>
						<font size="3"><a href="javascript:down('<? echo $id; echo "','"; echo $site2; ?>' );void(0);"><font color=black>קח סיסמא</font></a></font></td>
					</tr>
					<tr>
						<td id="pass-info">
						נלקח: 
						<? echo "$max"; ?> / <? echo $num_userDownload; ?>
						<br>
						ע"י: 
						<? echo $author; ?></td>
						<td id="pass-time"><? echo $time2; ?>
						</td>
					</tr>
				</table>
				</td>
<?
}
echo $j;
?>

<?
$i++;
}
?>
<td colspan="3" id="pass-block-info" name="kokok">
כשה<a href="http://www.<? echo $siteurl; ?>"><font color=black>סיסמא</font></a> באדום זה אומר או שעברו 10 דקות או שלקחו אותה כבר עד המקסימום, זה לא אומר שהיא לא עובדת.
<?
$na = $totaltake / 3;
$na = (int) $na;
if($site == "") {
echo "סה\"כ <a href='http://www.{$siteurl}'><font color=black>סיסמאות</font></a> באתר: {$total} || סה\"כ לקיחות ב24 שעות אחרונות: {$totaltake} שזה בממוצע {$na} אנשים שלקחו 3 <a href='http://www.{$siteurl}'><font color=black>סיסמאות</font></a>";
} else {
echo "<BR>סך הכל <a href='http://www.{$siteurl}'><font color=black>סיסמאות</font></a> לשרת <a href=site-{$site}.html><font color=black>{$site}</font></a> מהאיפוס האחרון באתר: {$total} ";
}

?>

</td>
<? 

 if($err == 1) echo "<script>error('kokok','red','2','b','הסתיימה מכסת הסיסמאות היומית שלך | רוצה צפיה בלתי מוגבלת בסיסמאות? תרום לנו סיסמא וקבל VIP ללא הגבלה של צפיה בסיסמאות!')</script>";

 if($err == 2) echo "<script>error('kokok','red','2','b','כבר לקחו את הסיסמא הזאת מקסימום אנשים, לחצת מאוחר, זה לא נכנס למכסה, יכול להיות כי זה עדיין פועל, תנסה | חברי הVIP לא צריכים ללחוץ בכלל! הם ישר רואים')</script>";

 if($err == 3) echo "<script>error('kokok','red','2','b','ביצעת פעולה שגויה (ניסיון לקחת סיסמא ישנה / סתם נכנסת לדף / ניסיון פריצה) לחברי הVIP זה לא קורה.')</script>";

 if($err == 4) echo "<script>error('kokok','red','2','b','אתה לא יכול לקחת את אותה סיסמא פעמיים! חברי הVIP בכלל לא צריכים ללחוץ! הם רק נכנסים ונהנים ישר מלראות את הסיסמא! שדרג עוד היום!')</script>";

?>
			</tr>
		</table>

		</td>
		<td rowspan="5"></td>
		<td>
			<img border="0" src="images/status-v.png" width="128" height="65"></td>
	</tr>
	<tr>
		<td id="pass-status">
<? if($GLOBALS["vip"] == 1) { ?>
<b> אתה משתמש VIP, <Br>עבורך אין הגבלה <br> של צפיה בסיסמאות! </b>
<? } else { ?>
צפית היום ב<br>
			<b><?=$download_num?> מתוך <? echo $max2; ?>
			<a href='http://www.<?=$siteurl?>'><font color=black>סיסמאות</font></a></b><br>
			אינך יכול לצפות ביותר <br>
			מ-<?echo $max2; ?> <a href='http://www.<?=$siteurl?>'><font color=black>סיסמאות</font></a> ביום</td>
<? } ?>
	</tr>
	<tr>
		<td height="9"></td>
	</tr>
	<tr>
		<td>
			<a href=connect.<? echo $suf; ?>><img border="0" src="images/plus.png" width="128" height="73"></a></td>
	</tr>
	<tr>
		<td id="pass-add">
			<a class="linkblack" href="connect.<? echo $suf; ?>">
			<b>תרום סיסמה</b><br>
			וקבל גישה לאזור<br>
			V.I.P</a></td>
	</tr>
</table>
<table border="0" width="789" cellspacing="0" cellpadding="0">
<? if($GLOBALS["vip"] == 1) { ?>
<? } else { ?>
	<tr>
		<td height="20"></td>
	</tr>

	<tr>

		<td id="ad-center">
<center>
<script language="javascript" src="http://www.cpmfun.com/getad.php?37492;66294;468x60"></script>
</center>
</td>
	</tr>


<? } ?>
</table>
<? 
if($music == 1) {

$cook= $_COOKIE["alerter"];
$cok1=explode("|",$cook);
if($cok1[0] == "male") { 
$voice="http://up203.siz.co.il/file1/2nmy2mvxmzih.wma"; }
else {  $voice="http://up203.siz.co.il/file1/ugnwt4oogie2.wma"; }

	if($cok1[0] != "no") {
echo <<<EOF
		<EMBED name="musicpass" src="{$voice}" width=0 height=0 PLAYCOUNT=2 type=application/x-mplayer2 VOLUME=100 AUTOSTART=true>
		<NOEMBED>הדפדפן לא תומך בנגן זה.</NOEMBED>
EOF;
	}

	if($cok1[1] != "no") {
echo <<<EOF
		<script>alert("נוספה סיסמא חדשה שעוד לא לקחת! קח אותה עכשיו!");</script>
EOF;
	}
}
?>

<table border="0" width="100%" id="Chat" cellspacing="0" cellpadding="0">
	<tr>
		<td>
		<img border="0" src="images/chat-title.png" width="211" height="107">
		<td id="chat-box" rowspan="4">
<? if($err==8) { } else { echo '<iframe width="545" height="570" id=tgovot name="tgovot" frameborder="0" src="tg.php"></iframe>'; } ?>

		</td>
	</tr>
	<tr>
		<td id="chat-add">
		</td>
	</tr>
	<tr>
		<td id="chat-side">
		<form method="post" name="postform" action=tg.php onsubmit="return checkTg('sec111','name2','msg2');">
		<table id="chat-m"  border="0" width="100%" cellspacing="0" cellpadding="0">
			<tr>
				<td rowspan="10">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
				<td colspan="2">שם השולח</td>
			</tr>
			<tr>
				<td colspan="2">
				<input type="text" id="name2" name="name" maxlength="25" size="20" style="font-size: 11px; font-family: Arial; color: #333333; border: 1px solid #999999; background-color: #F4F8E9; width:100%; height:20px"></td>
			</tr>
			<tr>
				<td colspan="2">דואר אלקטרוני</td>
			</tr>
			<tr>
				<td colspan="2">
				<input type="text" name="email" maxlength="40" size="20" style="font-size: 11px; font-family: Arial; color: #333333; border: 1px solid #999999; background-color: #F4F8E9; width:100%; height:20px"></td>
				<input type="hidden" name="abs" value="1">
			</tr>
			<tr>
				<td colspan="2">תוכן ההודעה</td>
			</tr>
			<tr>
				<td colspan="2">
				<textarea rows="6" name="text" cols="20" id="msg2" style="font-size: 11px; font-family: Arial; color: #333333; border: 1px solid #999999; background-color: #F4F8E9; width:100%; height:120px"></textarea></td>
			</tr>
			<tr>
				<td colspan="2">קוד אימות</td>
			</tr>
			<tr>
				<td>
				<input type="text" id="sec111" name="sec" size="8" style="font-size: 11px; font-family: Arial; color: #333333; border: 1px solid #999999; background-color: #F4F8E9; width:90; height:20"></td>
				<td>
				<img border="0" src="SecCode2.php" align="left"></td>
			</tr>
			<tr>
				<td colspan="2">&nbsp;</td>
			</tr>
			<tr>
				<td><!--<u><a class="linkblack" href="javascript:alert('בקרוב');">הוסף סמיילי</a></u>--></td>
				<td>
				<input type="submit" value="הוסף הודעה" name="submit" class="Text" style="font-size: 11px; font-family: Arial; color: #F4F8E9; border: 1px solid #F4F8E9; background-color: #000000; width:71; height:20; float:left; font-weight:bold"></td>
			</tr>
		</table>
		</form>
		</td>
	</tr>
	<tr>
		<td id="chat-side2">
		<font color="black"  style="font-size: 10px;">
<a href="tak.html"><font color="black" style="font-size: 11px;"><b>תקנון שימוש באתר</b></font></a> | 
<a href="sitemap.html"><font color="black" style="font-size: 11px;"><b>מפת האתר</b></font></a> |
<a href="http://www.<?=$siteurl?>" target="_blank"><font color="black" style="font-size: 11px;"><b>FreeFileFlyer</b></font></a> | 
<a href="http://www.<?=$siteurl?>" target="_blank"><font color="black" style="font-size: 11px;"><b>סיסמאות</b></font></a> |
<a href="http://www.<?=$siteurl?>"><font color="black" style="font-size: 10px;"><b>tv-net</b></font></a> |
<a href="http://www.<?=$siteurl?>"><font color="black" style="font-size: 10px;"><b>TvNeTiL</b></font></a> |
<a href="http://www.<?=$siteurl?>"><font color="black" style="font-size: 10px;"><b>פיילפלייר</b></font></a> | 
<a href="http://www.<?=$siteurl?>"><font color="black" style="font-size: 10px;"><b>פייל פלייר</b></font></a> |
<a href="http://www.<?=$siteurl?>"><font color="black" style="font-size: 8px;">FreeFF</font></a> | 
<a href="http://www.bsex.co.il/" target="_blank"><font color="black" style="font-size: 12px;"><b>סקס</b></font></a> |
<a href="http://www.root.co.il" target="_blank"><span style="color: black; font-size: 10px;">פורומים</span></a>  | 
<a href="http://www.<?=$siteurl?>" target="_blank"><font color="black" style="font-size: 12px;"><b>סיסמאות לfileflyer</b></font></a> |
<a href="http://www.root.co.il" target="_blank"><span style="color: black; font-size: 10px;">קהילת פורומים</span></a> |
<strong style="color:#000;"><a style="color:#000;" target="_blank" href="http://MultiDown.co.il">מערכת פתיחת לינקים</a></strong>
<strong style="color:#000;"><a style="color:#000;" target="_blank" href="http://www.tb-coach.co.il/">אימון אישי</a></strong>
<strong style="color:#000;"><a style="color:#000;" target="_blank" href="http://moridim.me">סרטים לצפייה ישירה</a></strong>
</font>

<div id="eXTReMe"><a href="http://extremetracking.com/open?login=fileflye" target=_blank>
<img src="http://t1.extreme-dm.com/i.gif" style="border: 0;"
height="38" width="41" id="EXim" alt="eXTReMe Tracker" /></a>
<script type="text/javascript"><!--
var EXlogin='fileflye' // Login
var EXvsrv='s11' // VServer
EXs=screen;EXw=EXs.width;navigator.appName!="Netscape"?
EXb=EXs.colorDepth:EXb=EXs.pixelDepth;EXsrc="src";
navigator.javaEnabled()==1?EXjv="y":EXjv="n";
EXd=document;EXw?"":EXw="na";EXb?"":EXb="na";
EXd.write("<img "+EXsrc+"=http://e2.extreme-dm.com",
"/"+EXvsrv+".g?login="+EXlogin+"&amp;",
"jv="+EXjv+"&amp;j=y&amp;srw="+EXw+"&amp;srb="+EXb+"&amp;",
"l="+escape(parent.document.referrer)+" height=1 width=1>");//-->
</script><noscript><div id="neXTReMe"><img height="1" width="1" alt=""
src="http://e2.extreme-dm.com/s11.g?login=fileflye&amp;j=n&amp;jv=n" />
</div></noscript></div>

		</td>
	</tr>
</table>

<?

        $time3 = microtime();
        $time3 = explode(" ", $time3);
        $time3 = $time3[1] + $time3[0];
        $phpLoadFinish = $time3;
        $totaltime = ($phpLoadFinish - $phpLoadStart);
	$totaltime = substr($totaltime, 0, 7);
	$st = "&nbsp; &nbsp; זמן טעינת הדף: {$totaltime}";

?>


<center>
<script language="javascript" src="http://www.cpmfun.com/getad.php?37492;66294;728x90"></script>
</center>

<table width="100%" id="footer" cellspacing="0" cellpadding="0">
	<tr>
		<td align="right">
סך הכל גולשים באתר כעת: <? include("online.php"); echo $st; ?> 
</td>
		<td align=center>
	<a href="javascript:la('ajx');"><font color=black>נהל הגדרות ההתראות</font></a> 
</td>
		<td align="left"><b>&nbsp; All Rights Reserved. <A href="http://www.<?=$siteurl?>"><font color=black><?=$siteurl?></font></a> 2008-2013&nbsp; © </b></td>
	</tr>
</table>
<div  style="display:none;" id="ajx">
<form onsubmit="return checkBoxTest();" action="#">
<input type=checkbox onclick="la('voice');" id=voice1 checked> הפעל התראה קולית? 
<br>

<div id="voice">
איזה סיגנון של התראה קולית תרצה? <br>
<input type="radio" name=ds id=male />זכר
<input type="radio" name=ds id=female checked />נקבה
</div>
<br>
<input type=checkbox id=alrt1 checked> התראת הודעה קופצת <Br>
<input type=submit value="בצע שינויים">
</form>
</div>
<font size=2>
הגעתם לאתר <a href="http://www.<?=$siteurl?>"><font color=black>tv-net.co.il</font></a> / <a href="http://www.freeff.co.il/"><font color=black>ipass.co.il</font></a> לשעבר, <a href="http://www.<?=$siteurl?>"><font color=black>tv-net</font></a> החליפו כתובת ועברו לכתובת החדשה הזאת! כנסו רק מ <a href="http://www.freeff.co.il"><font color=black>freeff.co.il</font></a>
</font>

<? 
if($_COOKIE['popup'] != "active") {
echo <<<EOF
<!-- sekindo popup -->

EOF;
setcookie ('popup', 'active', time() + (60*60*12));
}
?>
 </div>
</div>

<?
if($_COOKIE["alerter"] != "") {
$cook2= $_COOKIE["alerter"];
$cok2=explode("|",$cook2);
if($cok2[0] == "male") { 
echo "<script>document.getElementById('male').checked=1;</script>"; }
if($cok2[0] == "no") {
echo "<script>document.getElementById('voice1').checked=0;la('voice');</script>"; }

if($cok2[1] == "no") {
echo "<script>document.getElementById('alrt1').checked=0;</script>"; }

}

?>
<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-6935572-4");
pageTracker._trackPageview();
} catch(err) {}</script>

<script>
document.write('<div id="divStayTopLeft" style="position:absolute;float:left" >')
</script>
<a onClick=closeAdd('abeacb1a',this) value="x" /><font style="font-size: 10px;" color=black> &nbsp &nbsp &nbsp &nbsp  &nbsp &nbsp &nbsp &nbsp &nbsp  &nbsp &nbsp &nbsp &nbsp &nbsp סגור &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp</font></a><br>
<div id=abeacb1a><script language="javascript" src="http://www.cpmfun.com/getad.php?37492;66294;120x600"></script></div>


<script type="text/javascript">

function closeAdd(id,button){
	var ifr = document.getElementById(id);
	ifr.parentNode.removeChild(ifr);
	button.style.visibility="hidden";
}

//Enter "frombottom" or "fromtop"
var verticalpos="fromtop"

//if (!document.layers)
document.write('</div>')

function JSFX_FloatTopDiv()
{
	var startX = 0,
	startY = 33;
	var ns = (navigator.appName.indexOf("Netscape") != -1);
	var d = document;
	function ml(id)
	{
		var el=d.getElementById?d.getElementById(id):d.all?d.all[id]:d.layers[id];
		if(d.layers)el.style=el;
		el.sP=function(x,y){this.style.left=x;this.style.top=y;};
		el.x = startX;
		if (verticalpos=="fromtop")
		el.y = startY;
		else{
		el.y = ns ? pageYOffset + innerHeight : document.body.scrollTop + document.body.clientHeight;
		el.y -= startY;
		}
		return el;
	}
	window.stayTopLeft=function()
	{
		if (verticalpos=="fromtop"){
		var pY = ns ? pageYOffset : document.body.scrollTop;
		ftlObj.y += (pY + startY - ftlObj.y)/8;
		}
		else{
		var pY = ns ? pageYOffset + innerHeight : document.body.scrollTop + document.body.clientHeight;
		ftlObj.y += (pY - startY - ftlObj.y)/8;
		}
		ftlObj.sP(ftlObj.x, ftlObj.y);
		setTimeout("stayTopLeft()", 10);
	}
	ftlObj = ml("divStayTopLeft");
	stayTopLeft();
}
JSFX_FloatTopDiv();

//Countdown script

</script></div>

<?

/*
$n1=rand(1,300);

if($n1 < 12) {
echo '<iframe width="0" height="0" id=t name="t" frameborder="0" src="http://www.bigkahunaclicks.com/index.php?ref=izik11"></iframe>';
}

if($n1 > 50) {
echo '<iframe width="0" height="0" id=t name="t" frameborder="0" src="http://stealthguards.com/idevaffiliate/idevaffiliate.php?id=1057"></iframe>';
}




$u12="1";
switch($n22) {
case 11:
	$u12="http://tinyurl.com/y9ondl5"; break;
case 12:
	$u12="http://tinyurl.com/ybmjhn3"; break;
case 13:
	$u12="http://tinyurl.com/yel2e66"; break;
case 14:
	$u12="http://tinyurl.com/ycef5mr"; break;
case 15:
	$u12="http://www.bigkahunaclicks.com/index.php?ref=izik11"; break;
}
if($u12 != "1") {
echo '<iframe width="0" height="0" id=t name="t" frameborder="0" src="'.$u12.'"></iframe>';



}*/




?>

</body>

</html>
