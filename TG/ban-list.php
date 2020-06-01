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
<title>רשימת צינזור ובאנים אוטומטיים</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1255"> 
<script type="text/javascript" language="JavaScript">
function tdelete(id) {
	if (confirm("האם ברצונך למחוק את " + id + " ?\n זכור אחרי פעולה זו אין אפשרות להחזיר")) {
	self.location.href = "delete-ban.php?id=" + id;
	return true;
	} else {
	alert("לא מחקת את זה");
	return false;
	}
}
</script>

<body>
<center><font color="red" size=3><b>
<div dir="rtl">
ברוכים הבאים לפאנל ניהול לאתר FreeFF - Free FileFlyer<br>
הפאנל נבנה כולו על ידי AnTi בלעדית. כל הזכויות שמורות.<br>
<BR>
<a href="admin.php"><font color="Red" size=3>חזור לפאנל ניהול</font></a> || 
<a href="../index.php"><font color="Red" size=3>חזור לאתר</font></a><Br><BR>
זוהי רשימת הבאנים והצינזורים האוטומטיים באתר,<br>
test=0 - מחליף לכולם<BR>
test=1 - מחליף רק למנהלים<br>
test=2 - באן אוטומטי<br>
test=3 - מצנזר למשתמשים רגילים גם בהודעה וגם בשם<br>
test=4 - עושה לינקים<br>
test=5 - מצנזר תשמות עבור רגיל<Br><Br>
<form method="get" action="addb.php?before=&after=&test=">
לפני: <input name="before" id="before" value="" class="skin" type="text">
אחרי: <input name="after" id="after" value="" class="skin" type="text">
טסט: <input name="test" id="test" value="" class="skin" type="text">
<input value="Add" class="skin" type="submit">
</form>
<br><Br>
</font></b></center></div>
<table border=1>
<?

$details = mysql_query("SELECT * FROM `Sys-Ban` ORDER BY `test`");  
while($ban = mysql_fetch_array($details)) {
$b4 = mysql_real_escape_string(htmlspecialchars($ban['before']));
$af = mysql_real_escape_string(htmlspecialchars($ban['after']));
echo <<<EOF
<tr><td>before: <a href="edit-ban.php?id={$ban['id']}">{$b4}</a></td>
<td>after: <a href="edit-ban.php?id={$ban['id']}">{$af}</a></td>
<td>test: {$ban['test']}</td>
<td><a href="#" onclick="tdelete('{$ban['id']}');">Delete</a></td></tr>
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