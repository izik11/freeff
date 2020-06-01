<?php
include("db.php");

$id=htmlspecialchars($_GET['prob']);
$id = intval($id);
if(!($id > 1 && $id < 6)) { die("טעות"); }
$email=htmlspecialchars($_GET['email']);
$by=htmlspecialchars($_GET['by']);
$res=htmlspecialchars($_GET['res']);
$pas=htmlspecialchars($_GET['pas']);
$note=htmlspecialchars($_GET['note']);
echo <<<EOF
<html dir=rtl>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1255"> 
<title>הודעה מ FreeFF.Co.iL Free FileFlyer</title>
EOF;

if($id = "5") {
die("
נשלח עבור: {$email}<Br><br>
כותרת: תודה על תרומתך ל FreeFF אך..<Br><br>
אנו מתנצלים אך על הסיסמא ששלחת: {$pas} לא מקבלים VIP, אנא שלח סיסמא של FF על מנת לקבל VIP. <br> אנא שלח שוב סיסמא תקינה! הערות נוספות: {$note} נבדק על ידי המנהל: {$by} 
<BR><BR><Br>
<a href='../index.php'>חזור לאתר</a>
");
}


echo <<<EOF
נשלח עבור: {$email}<BR><Br>
כותרת: הסיסמא ששלחת: {$pas} אינה תקינה<BR><Br>
שלום לך, אנו מתנצלים אך התגלתה שגיאה בעת בדיקת סיסמתך, השגיאה שהתגלתה היא: {$res} הסיסמא המדוברת: {$pas} אנא שלח שוב סיסמא תקינה! הערות נוספות: {$note} נבדק על ידי המנהל: {$by}
<BR><BR><Br>
<a href="../index.php">חזור לאתר</a>

EOF;

?>