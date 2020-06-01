<meta http-equiv="Content-Type" content="text/html; charset=windows-1255"> 
<script type="text/javascript" language="JavaScript">
function la(id) {
	Object = document.getElementById(id);
	Object.style.display = Object.style.display == "none" ? "" : "none";
}
</script>
<?php
include("../TG/db.php");
if(!$cuser)
{
die("<script>alert('אתה לא מחובר כמנהל')</script><script>window.location = 'index.php'</script>");
}
echo "<a href=http://www.fileflyer.com/view/QOXTOX4OFN1K2 target=_blank>קישור לבדיקת לינקים</a> או <a href=http://upload7.fileflyer.com/view/K0PFZT8BEDJ2CW target=_blank>קישור נוסף</a><br><br>";
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
mail("{$_POST['email']}", "תודה על תרומתך ל Tv-NeT אך..", "אנו מתנצלים אך על הסיסמא ששלחת: {$_POST['pas']} לא מקבלים VIP, אנא שלח סיסמא של FF על מנת לקבל VIP. \n\r אנא שלח שוב סיסמא תקינה! הערות נוספות: {$note} נבדק על ידי המנהל: {$cuser} \n\r\n\r if you cant read this email go on:\n http://www.tv-net.co.il/TG/cantread.php?prob={$r}&email={$_POST['email']}&res={$_POST['res']}&pas={$_POST['pas']}&by={$cuser}&note={$note}", "From:".$sendFrom); 
die("<script>alert('האימייל נשלח');</script><script>window.location = 'mail-list.php'</script>");
}
mail("{$_POST['email']}", "הסיסמא ששלחת: {$_POST['pas']} אינה תקינה", "שלום לך, אנו מתנצלים אך התגלתה שגיאה בעת בדיקת סיסמתך, השגיאה שהתגלתה היא: {$_POST['res']} הסיסמא המדוברת: {$_POST['pas']} אנא שלח שוב סיסמא תקינה! הערות נוספות: {$note} נבדק על ידי המנהל: {$cuser} \n\r\n\r if you cant read this email go on:\n http://www.tv-net.co.il/TG/cantread.php?prob={$r}&email={$_POST['email']}&res={$_POST['res']}&pas={$_POST['pas']}&by={$cuser}&note={$note}", "From:".$sendFrom); 
if($up2 != "") {
echo "<script>alert('האימייל נשלח');</script>";
die ("<script>window.location = 'mail-list.php'</script>");
}
}


$id2=$_GET['delete'];
if($id2 > 0) {
if($cuser!="AnTi" && $cuser!="Alona") { die("<script>alert('רק אנטי יכול למחוק מכתבים');</script><script>window.location = 'mail-list.php'</script>"); }
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
Subject: {$sub} <br>
msg: {$msg} <Br>
read by: {$readby} <Br>
<form action="mail-list.php?note={$id3}" method="post" name="lala">
<input type=hidden value="{$readby}" name=readby>
<input type=hidden value="{$id3}" name=id>
notes 4 admins: <textarea name=notes cols="50" rows="5">{$notes}</textarea><br>
<a href="javascript:document.lala.submit();">עדכן הערות</a></form>

<form action="mail-list.php?read={$id3}" method="post" name="lala2">
<input type=hidden value="{$readby}" name=readby>
<input type=hidden value="{$id3}" name=id>
<a href="javascript:document.lala2.submit();">סמן כלא נקרא</a></form>
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
	self.location.href = "mail-list.php?delete=" + id;
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
<tr><td>{$b}Date: {$date}{$b2}</td>
<td>{$b}IP: {$ban['ip']}{$b2}</td>
<td>{$b}From: {$ban['email']}{$b2}</td>
<td>{$b}Subject: <a href="mail-list.php?show={$ban['id']}">{$b}{$sub}{$b2}</a>{$b2}</td>
{$b3}
<td>{$b}<a href="#" onclick="tdelete('{$ban['id']}');">{$b}Delete{$b2}</a>{$b2}</td>
</tr>
{$b2}
EOF;
}
?>

</table><Br>
<?
echo "There Are Total {$total} Emails";
?>
