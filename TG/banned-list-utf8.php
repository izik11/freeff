<?php
include("db.php");

if($cban == "0") {
die("Error!");
}

if(!$cuser) {
die("Error Login!");
}
?>
<html><head>
<title>רשימת באנים</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 


<script type="text/javascript" language="JavaScript">
function tdelete(id) {
	if (confirm("האם ברצונך למחוק את באן מספר " + id + " ?\n זכור אחרי פעולה זו אין אפשרות להחזיר")) {
	self.location.href = "delete-banned.php?id=" + id;
	return true;
	} else {
	alert("לא מחקת את הבאן הזה");
	return false;
	}
}
function la(id) {
	Object = document.getElementById(id);
	Object.style.display = Object.style.display == "none" ? "" : "none";
}

</script>
<script type="text/javascript" src="ajax.js"></script>
</head>
<body>
<center><font color="red" size=3><b>
<div dir="rtl">
ברוכים הבאים לפאנל ניהול לאתר Tv-NeT - Free FileFlyer<br>
הפאנל נבנה כולו על ידי AnTi בלעדית. כל הזכויות שמורות.<br>
<BR>
<a href="admin.php"><font color="Red" size=3>חזור לפאנל ניהול</font></a> || 
<a href="../index.php"><font color="Red" size=3>חזור לאתר</font></a><Br><BR>
זוהי רשימת הבאנים באתר,<br>
לחיצה על שם הסיבה תביא אותכם לעמוד עריכת הבאן<br>
לחיצה על כפתור הDelete תמחק את הבאן<BR>
המשתמשים מסודרים מהישן לחדש<Br><Br>
<form method="get" action="addban.php?ip=&post=&from=&reason=">
ip: <input name="ip" id="ip" value="" class="skin" type="text">
ההודעה: <input name="post" id="post" value="" class="skin" type="text">
<?
echo <<<EOF
<input name="from" id="from" value="{$cuser}" class="skin" type="hidden">
EOF;
?>
סיבה : <input name="reason" id="reason" class="skin" type="text">
<input value="Add Ban" class="skin" type="submit">
</form>
<br><Br>
</font></b></center></div>
<table border=1>
<?
$ip = $_SERVER["REMOTE_ADDR"];
$details = mysql_query("SELECT * FROM `banlist` ORDER BY `id` DESC");  
while($ban = mysql_fetch_array($details)) {
if($ban['reason'] == "") {
$res = "לחץ כאן אין סיבה לבאן"; 
} else {
$res = $ban['reason'];
}
$id=$ban['id'];
echo <<<EOF
<tr><td>Id: {$ban['id']}</td><td>IP: {$ban['ip']}</td>
<td>Reason: <a href="edit-banned.php?id={$ban['id']}">{$res}</a></td>
<td>from: {$ban['from']}</td><td>
<a href="#" onclick="send('{$id}');">Show Post</a>
<td><a href="#" onclick="tdelete('{$id}');">Delete</a>
</td></tr>
<tr style="display:none;" id="{$id}tr"> <td COLSPAN=6 id="{$id}td"> </td></tr>

EOF;
}
?>

</table>
<center><font color="Red" size=3><b>
<div dir="rtl"><Br><BR>
<a href="admin.php"><font color="Red" size=3>חזור לפאנל ניהול</font></a> || 
<a href="../index.php"><font color="Red" size=3>חזור לאתר</font></a><Br><BR>
פאנל ניהול לאתר Tv-NeT - Free FileFlyer<br>
הפאנל נבנה כולו על ידי <a href="../connect.html"><font color="Red" size=3><b>AnTi</font></b></a> בלעדית. כל הזכויות שמורות.
</font></b></div></center></body></html>