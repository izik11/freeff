<meta http-equiv="Content-Type" content="text/html; charset=windows-1255"> 
<script type="text/javascript" language="JavaScript">
function la(id) {
	Object = document.getElementById(id);
	Object.style.display = Object.style.display == "none" ? "" : "none";
}
</script>
<script type="text/javascript" language="JavaScript">
function fo(ema) {
var f1=document.getElementById('msgg').innerHTML;
if(f1 == "" || f1 == " ") {
var f3=ema.split('@');
var k=f3[0];
} else {
var f3 = f1.split('name:');
var k=f3[1];
} 
k=k.replace(/ /gi,"");
document.getElementById('nam').value=k;
}
</script>
<script type="text/javascript" src="ajax.js"></script>
<?php
include("../TG/db.php");
if(!$cuser)
{
die("<script>alert('אתה לא מחובר כמנהל')</script><script>window.location = 'index.php'</script>");
}
echo "<a href=http://upload7.fileflyer.com/view/JW3PRJ2YYHFCDa target=_blank>קישור חדש חובה להשתמש בו!!!!</a><br><br>";
$query2 = mysql_query("SELECT count(*) as total FROM `Sys-Mail`");
$mail = mysql_fetch_array($query2, MYSQL_ASSOC);
$total = $mail['total'];
if($total == 0) { die("אין מכתבים חדשים"); }
echo "<title>מערכת אימיילים ({$total})</title>";
$id4=$_GET['note'];
if($id4 > 0) {
if($id4 != $_POST['id']) {die("שגיאת ID");}
$note = $_POST['notes'];
$readby = "{$_POST['readby']}-note"; 
$up2 = mysql_query("UPDATE `Sys-Mail` SET `note` = '{$note}', `readby` = '{$readby}' WHERE `Sys-Mail`.`id` ={$id4}");
if($up2 != "") {
echo "<script>alert('ההערה עודכנה בהצלחה');</script>";
die ("<script>window.location = 'mail-list.php?show={$id4}'</script>");
}
}

$id4=$_GET['read'];
if($id4 > 0) {
if($id4 != $_POST['id']) {die("שגיאת ID");}
$readby = "{$_POST['readby']}-unread"; 
$up2 = mysql_query("UPDATE `Sys-Mail` SET `read` = '1', `readby` = '{$readby}' WHERE `Sys-Mail`.`id` ={$id4}");
if($up2 != "") {
echo "<script>alert('ההודעה סומנה כלא נקראה');</script>";
die ("<script>window.location = 'mail-list.php'</script>");
}
}

$id99=$_GET['added'];
if($id99 > 0) {
$kk1=$_GET['kk'];
$readby = "{$kk1}-added"; 
$up2 = mysql_query("UPDATE `Sys-Mail` SET `read` = '9', `readby` = '{$readby}' WHERE `Sys-Mail`.`id` ={$id99}");
$dt2 = time() + $badate;
$dt1 = date("j.n.y בשעה H:i", $dt2);
$ok5 = mysql_query("INSERT INTO `adminon` (`name` ,`date` ,`time` )VALUES ('{$cuser}', '{$dt1}', '{$dt2}');");
if($up2 != "") {
echo "<script>alert('ההודעה סומנה כנוספה');</script>";
die ("<script>window.location = 'mail-list.php'</script>");
}
}

$id66=$_GET['ad'];
$mail1=$_POST['ema'];
$name=$_POST['nam'];
$pa=$_POST['pa'];
$site=$_POST['sit'];
$max=$_POST['max'];
$vip=$_POST['vip'];
if($vip=="1" && $cuser!="AnTi") { die("רק אנטי יכול להוסיף סיסמאות ל VIP"); }
$rd=$_POST['readby'];
$pw2 = mt_rand();
if($id66>0) {
if ($mail1 == "" || $name=="" || $pa=="" || $site=="" || $max=="" || $vip=="") {die("שגיאה");} else {
$time66 = time();
$correct_time66 = $time66 + $badate;
$date2 = date("H:i , j.n.y", $correct_time66);
$date3 = date("j.n.y בשעה H:i", $correct_time66);

$check2 = mysql_query("SELECT * FROM `RSS` WHERE `password`='{$pa}'");  
$check22 = mysql_query("SELECT * FROM `Sys-User-Vip` WHERE `email`='{$mail1}'");  
if(@mysql_num_rows($check22) > 0) {
	while($ro44 = mysql_fetch_array($check22)) {
		$datevip = $ro44['date'];
		$idvip = $ro44['user_id'];
		$oldp=$ro44['password'];
	}
}
$newdate = $datevip+604800;
if(@mysql_num_rows($check2) == 0) {
	$ok = mysql_query("INSERT INTO `RSS` (`id` ,`password` ,`by` ,`time` ,`max` ,`Top` ,`vip` ,`site` ,`date` )VALUES (NULL , '{$pa}', '{$name}', '{$date3}', '{$max}', '1', '{$vip}', '{$site}', '{$time66}');");
	if($vip == 1)
	{
	$ok2 = mysql_query("INSERT INTO `Sys-TG` (`id` ,`name` ,`email` ,`admin` ,`date` ,`post`,`ip`,`time` )VALUES ('0', '{$cuser}', 'autopass@freeff.co.il', '1', '$date2', 'נוספה סיסמא חדשה לאתר {$site} לחברי הVIP בלבד תהנו! :D', 'no-ip-4-me','0');");
		if($site == "fileflyer") {
			if(@mysql_num_rows($check22) == 0) {
			$add = mysql_query("INSERT INTO `Sys-User-Vip` (`user_id` ,`username` ,`password` ,`date` ,`email` ,`donate` ,`site` )VALUES ('0', '{$name}', '{$pw2}', '{$time66}', '{$mail1}', 'vip', '{$site}');"); 
				if($add != "")
				{		
				mail($mail1, "VIP at FreeFF.Co.iL - Free FileFlyer", "UserName: {$name}\n\rPassWord: {$pw2}\nEnJoY! Free FileFlyer Team.", "From: Free FileFlyer <anti.release@gmail.com>");
				die("<script>alert('הסיסמא נוספה בהצלחה והמשתמש קיבל VIP')</script><script>window.location='mail-list.php?added={$id66}&kk={$rd}';</script>");
				}
			} else {
			$add = mysql_query("UPDATE `Sys-User-Vip` SET `date` = '{$newdate}' WHERE `Sys-User-Vip`.`user_id` ={$idvip} ;");
				if($add != "")
				{		
				mail($mail1, "VIP at FreeFF.Co.iL - Free FileFlyer", "Your User Got More 1 ViP Week \n\r to remind you, here is your details:\r\n UserName: {$name}\n\rPassWord: {$oldp}\nEnJoY! Free FileFlyer Team.", "From: Free FileFlyer <anti.release@gmail.com>");
				die("<script>alert('הסיסמא נוספה בהצלחה ולמשתמש נוסף שבוע VIP נוסף!')</script><script>window.location='mail-list.php?added={$id66}&kk={$rd}';</script>");
				}
			}
		} else { 
		die("<script>alert('נכון לעכשיו לא ניתן לקבל VIP על סיסמאות שהן לא לFF - אך הסיסמא נוספה לאתר')</script><script>window.location='mail-list.php?added={$id66}&kk={$rd}';</script>"); 
		}
		
	}
	else
	{
	$ok2 = mysql_query("INSERT INTO `Sys-TG` (`id` ,`name` ,`email` ,`admin` ,`date` ,`post`,`ip`,`time` )VALUES ('0', '{$cuser}', 'autopass@FreeFF.co.il', '1', '$date2', 'נוספה סיסמא חדשה לאתר {$site} ,תודה למשתמש {$name} ששלח לנו אותה בלעדית דרך עמוד הצור קשר שבאתר תהנו חברים!', 'no-ip-4-me','0');");
		if($site == "fileflyer") {
			if(@mysql_num_rows($check22) == 0) {
			$add = mysql_query("INSERT INTO `Sys-User-Vip` (`user_id` ,`username` ,`password` ,`date` ,`email` ,`donate` ,`site` )VALUES ('0', '{$name}', '{$pw2}', '{$time66}', '{$mail1}', '{$pa}', '{$site}');"); 
				if($add != "")
				{		
				mail($mail1, "VIP at FreeFF.Co.iL - Free FileFlyer", "UserName: {$name}\n\rPassWord: {$pw2}\nEnJoY! Free FileFlyer Team.", "From: Free FileFlyer <anti.release@gmail.com>");
				die("<script>alert('הסיסמא נוספה בהצלחה והמשתמש קיבל VIP')</script><script>window.location='mail-list.php?added={$id66}&kk={$rd}';</script>");
				}
			} else {
			$add = mysql_query("UPDATE `Sys-User-Vip` SET `date` = '{$newdate}' WHERE `Sys-User-Vip`.`user_id` ={$idvip} ;");
				if($add != "")
				{		
				mail($mail1, "VIP at FreeFF.Co.iL - Free FileFlyer", "Your User Got More 1 ViP Week \n\r to remind you, here is your details:\r\n UserName: {$name}\n\rPassWord: {$oldp}\nEnJoY! Free FileFlyer Team.", "From: Free FileFlyer <anti.release@gmail.com>");
				die("<script>alert('הסיסמא נוספה בהצלחה ולמשתמש נוסף שבוע VIP נוסף!')</script><script>window.location='mail-list.php?added={$id66}&kk={$rd}';</script>");
				}
			}
		} else { 
		die("<script>alert('נכון לעכשיו לא ניתן לקבל VIP על סיסמאות שהן לא לFF - אך הסיסמא נוספה לאתר')</script><script>window.location='mail-list.php?added={$id66}&kk={$rd}';</script>"); 
		}
		
	}

	if($ok)
	{
	die("<script>alert('הסיסמא נוספה בהצלחה למערכת')</script><script>window.location='mail-list.php?added={$id66}&kk={$rd}';</script>");
	}
} else {
die("<script>alert('יש כבר סיסמא כזאת במערכת אתה לא יכול להוסיף אותה שוב')</script><script>window.location='mail-list.php';</script>");
}

}
}


$id4=$_GET['not'];
if($id4 > 0 && $_POST['email'] != "" && $_POST['res'] != "" && $_POST['pas'] != "") {
if($id4 != $_POST['id']) {die("שגיאת ID");}
$readby = "{$_POST['readby']}-unwork-{$_POST['res']}"; 
$sendFrom = "anti.release@gmail.com";
$note = $_POST['note'];
if($_POST['note2'] != "") { die("הערות למנהל חיבות להיות ריקות בשביל זה, חזור ונסה שוב"); }
if($note == "") { $note = "אין הערות"; }
switch($_POST['res']) {
	case "הסיסמא שגויה":
		$r = "2";
		break;
	case "עברה את המכסה":
		$r = "3";
		break;
	case "תוקף הסיסמא פג":
		$r = "4";
		break;
	case "notvip":
		$r = "5";
		break;
}

$up2 = mysql_query("UPDATE `Sys-Mail` SET  `note` = '{$note}' , `read` = '{$r}' , `readby` = '{$readby}' WHERE `Sys-Mail`.`id` ={$id4}");
if($_POST['res'] == "notvip") {
mail("{$_POST['email']}", "תודה על תרומתך ל FreeFF אך..", "אנו מתנצלים אך על הסיסמא ששלחת: {$_POST['pas']} לא מקבלים VIP, אנא שלח סיסמא של FF על מנת לקבל VIP. \n\r אנא שלח שוב סיסמא תקינה! הערות נוספות: {$note} נבדק על ידי המנהל: {$cuser} \n\r\n\r if you cant read this email go on:\n http://www.FreeFF.co.il/TG/cantread.php?prob={$r}&email={$_POST['email']}&res={$_POST['res']}&pas={$_POST['pas']}&by={$cuser}&note={$note}", "From:".$sendFrom); 
die("<script>alert('האימייל נשלח');</script><script>window.location = 'mail-list.php'</script>");
}
mail("{$_POST['email']}", "הסיסמא ששלחת: {$_POST['pas']} אינה תקינה", "שלום לך, אנו מתנצלים אך התגלתה שגיאה בעת בדיקת סיסמתך, השגיאה שהתגלתה היא: {$_POST['res']} הסיסמא המדוברת: {$_POST['pas']} אנא שלח שוב סיסמא תקינה! הערות נוספות: {$note} נבדק על ידי המנהל: {$cuser} \n\r\n\r if you cant read this email go on:\n http://www.FreeFF.co.il/TG/cantread.php?prob={$r}&email={$_POST['email']}&res={$_POST['res']}&pas={$_POST['pas']}&by={$cuser}&note={$note}", "From:".$sendFrom); 
if($up2 != "") {
echo "<script>alert('האימייל נשלח');</script>";
die ("<script>window.location = 'mail-list.php'</script>");
}
}


$id2=$_GET['delete'];
if($id2 > 0) {
if($cuser!="AnTi") { die("<script>alert('רק אנטי יכול למחוק מכתבים');</script><script>window.location = 'mail-list.php'</script>"); }
$del = mysql_query("DELETE FROM `Sys-Mail` WHERE `Sys-Mail`.`id` = '{$id2}'") or die("Error!");  
if($del) { die("<script>alert('נמחק בהצלחה');</script><script>window.location = 'mail-list.php'</script>"); }
}

$id3=$_GET['show'];
if($id3 > 0) {
$select = mysql_query("SELECT * FROM `Sys-Mail` WHERE `Sys-Mail`.`id` ={$id3}");
while($row = mysql_fetch_array($select)) {
$msg = $row['msg'];
$sub = $row['subject'];
$ip = $row['ip'];
$time66 = $row['date'];
$correct_time66 = $time66 + $badate;
$date = date("H:i , j.n.y", $correct_time66);
$email = $row['email'];
$readby = $row['readby'];
$notes = $row['note'];
$r2 = $row['read'];
}
$readby = "{$readby} ; {$cuser}"; 
if($r2 == "1") { $sql ="`read` = '0' , "; } else { $sql="";} 
$up = mysql_query("UPDATE `Sys-Mail` SET {$sql} `readby` = '{$readby}' WHERE `Sys-Mail`.`id` ={$id3}");
if($up != "") {
echo <<<EOF
Id: {$id3} | Date: {$date} | IP: {$ip} <br>
From: {$email} <br>
Subject: {$sub} 
<div id=msgg>
msg: {$msg} 
</div>
read by: {$readby} <Br>
<form action="mail-list.php?note={$id3}" method="post" name="lala">
<input type=hidden value="{$readby}" name=readby>
<input type=hidden value="{$id3}" name=id>
notes 4 admins: <textarea name=notes cols="50" rows="5">{$notes}</textarea><br>
<a href="javascript:document.lala.submit();">עדכן הערות</a></form>

<form action="mail-list.php?read={$id3}" method="post" name="lala2">
<input type=hidden value="{$readby}" name=readby>
<input type=hidden value="{$id3}" name=id>
 <a href="javascript:document.lala2.submit();"><font color=black>סמן כלא נקרא</font></a> || <a href="mail-list.php?added={$id3}&kk={$readby}"><font color=darkgreen>סמן כסיסמא שנוספה לאתר (FF בלבד)</font></a>  </form>
<div id=wrong>
<a href="javascript:la('wrong');" onclick="la('wrong2');">סיסמא שגויה/עברה מכסה/פג תוקף/לא זכאי VIP</a>
</div>
<div style="display:none;" id="wrong2">
<a href="javascript:la('wrong')" onclick="la('wrong2');">סגור סיסמא שגויה וכו'</a>
<form action="mail-list.php?not={$id3}" method="post" name="lala3">
<input type=hidden value="{$readby}" name=readby>
<input type=hidden value="{$id3}" name=id>
<input type=hidden value="{$notes}" name=note2>
<input type=hidden value="{$email}" name=email>
<input type=text value="הכנס את הסיסמא השגויה" name=pas onFocus="javascript:this.value=''">
<SELECT NAME="res">
<option value="הסיסמא שגויה" selected>שגויה</option>
<option value="עברה את המכסה">עבר מכסה</option>
<option value="תוקף הסיסמא פג">פג תוקף</option>
<option value="notvip">לא לFF</option>
</select>
notes 4 not workin: <textarea name=note cols="50" rows="3">{$notes}</textarea><br>
<a href="javascript:document.lala3.submit();">שלח אימייל על בעיה עם הסיסמא</a></form>
</div>
<br><br>
<div id=ad>
<a href="#" onclick="la('ad');la('ad2');fo('1');">להוספה מהירה לחץ כאן</a>
</div>
<div id=ad2 style="display:none;">
<form method=post action="mail-list.php?ad={$id3}">
<input value="{$email}" name=ema onclick="this.select()">
<input value="הכנס שם" name=nam id=nam onclick="this.select()" id=nam>
<input value="הכנס סיסמא" name=pa onclick="this.select()">
<input value="fileflyer" name=sit onclick="this.select()">
<input value="0" name=vip onclick="this.select()">
<input value="100" name=max onclick="this.select()">
<input type=hidden value="{$readby}" name=readby>
<BR>
<input type=submit name=submit value=שלח>
</form>
</div>

<br><Br>
<a href="mail-list.php">סגור את המכתב הזה</a>
<br><BR>
EOF;
}
}
?>
<html><head>
<title>רשימת מיילים</title>
<script type="text/javascript" language="JavaScript">
function tdelete(id) {
	if (confirm("האם ברצונך למחוק את הודעה מספר " + id + " ?\n זכור אחרי פעולה זו אין אפשרות להחזיר")) {
	//self.location.href = "mail-list.php?delete=" + id;
	delAjax(id,'Sys-Mail');
var t=document.title.split('(');
var t2 = t[1].split(')');
var b=parseInt(t2[0]);
b=b-1;
document.title=t[0]+"("+b+")";
	la(id+"general");

	return true;
	} else {
	alert("לא מחקת את ההודעה הזאת");
	return false;
	}
}
</script>

<body>
<table border=1>

<?
$details = mysql_query("SELECT * FROM `Sys-Mail` ORDER BY `id` DESC");  
while($ban = mysql_fetch_array($details)) {
$b = "";
$b2 = "";
$b3 = "<td></td>";
switch($ban['read']) {
	case 0:
		$b3 = "<td>{$b}נקרא{$b2}</td>";
		break;
	case 1:
		$b = "<b>";
		$b2 = "</b>";
		$b3 = "<td>{$b}לא נקרא{$b2}</td>";
		break;
	case 2:
		$b = "<font color=red>";
		$b2 = "</font>";
		$b3 = "<td>{$b}שגוי{$b2}</td>";
		break;
	case 3:
		$b = "<font color=pink>";
		$b2 = "</font>";
		$b3 = "<td>{$b}עבר מכסה{$b2}</td>";
		break;
	case 4:
		$b = "<font color=orange>";
		$b2 = "</font>";
		$b3 = "<td>{$b}פג תוקף{$b2}</td>";
		break;
	case 5:
		$b = "<font color=green>";
		$b2 = "</font>";
		$b3 = "<td>{$b}לא מקבל VIP{$b2}</td>";
		break;
	case 9:
		$b = "<font color=darkgreen>";
		$b2 = "</font>";
		$b3 = "<td>{$b}נוסף לאתר{$b2}</td>";
		break;
}
$time6 = $ban['date'];
$correct_time6 = $time6 + $badate;
$date = date("H:i , j.n.y", $correct_time6);

if($ban['subject'] == "") {
$sub = "לחץ כאן אין כותרת"; 
} else {
$sub = $ban['subject'];
}
echo <<<EOF
{$b}
<tr id="{$ban['id']}general"><td>{$b}Date: {$date}{$b2}</td>
<td>{$b}IP: {$ban['ip']}{$b2}</td>
<td>{$b}From: {$ban['email']}{$b2}</td>
<td>{$b}Subject: <a href="mail-list.php?show={$ban['id']}">{$b}{$sub}{$b2}</a>{$b2}</td>
{$b3}
<td>{$b}<a href="javascript:void(0);" onclick="tdelete('{$ban['id']}');">{$b}Delete{$b2}</a>{$b2}</td>
</tr>
{$b2}
EOF;
}
?>

</table><Br>
<?
echo "There Are Total {$total} Emails";
?>
