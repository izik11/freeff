<?php 
function auth() { 
   header('WWW-Authenticate: Basic realm="AnTi Rulez"'); 
   header('HTTP/1.0 401 Unauthorized'); 
   echo "<script>alert('מדוע אתה ליימר שמנסה לפרוץ לנו לאתר ללא הצלחה?')</script><script>window.location = 'index.php'</script>"; 
   exit; 
} 
if (isset($_GET['logout'])) { 
auth(); 
} 
if ($_SERVER['PHP_AUTH_USER'] == "alonalala" && $_SERVER['PHP_AUTH_PW'] == "koksexkok") { 
    echo ("<script>alert('התחברת בהצלחה לפאנל הניהול - שים לב כי פאנל זה נבנה על ידי AnTi')</script>"); 
} 
else { 
  auth(); 
  } 
?> 
<?php
include("db.php");

if(!$cuser) {
die("<script>alert('אתה לא מחובר כמנהל - התחבר דרך עמוד זה')</script><script>window.location = 'index.php'</script>");
}
?>
<html dir="rtl">
<title>פאנל ניהול לאתר, נבנה על ידי AnTi</title>
<Center>
<font color="red" size="7"><B><u>
פאנל ניהול אתר </u></font><br><BR><Br>

<a href="banned-list.php"><font color="green" size="4">
צפיה, מחיקה, ועריכת באנים</font></a><Br><BR>

<a href="pass-list.php"><font color="green" size="4">
צפיה, מחיקה, ועריכת סיסמאות</font></a><Br><BR>

<a href="vip-list.php"><font color="green" size="4">
צפיה, מחיקה, ועריכת חברי vip</font></a><Br><BR>

<a href="ban-list.php"><font color="green" size="4">
צפיה, מחיקה, ועריכת צינזור/באן</font></a><Br><BR>

<a href="mail-list.php"><font color="green" size="4">
רשימת מיילים</font></a><Br><BR><br>

<a href="../checklog.php"><font color="green" size="4">
מחיקת עוגית סיסמאות</font></a><Br><BR><br>

<center><font color="Red" size=3><b>
<a href="../index.php"><font color="green" size=4>חזור לאתר</font></a><Br><BR>
פאנל ניהול לאתר FreeFF - Free FileFlyer<br>
הפאנל נבנה כולו על ידי <a href="../connect.html"><font color="Red" size=3><b>AnTi</font></b></a> בלעדית. כל הזכויות שמורות.
</font></b></center></body></html>