<?php


mysql_connect("localhost", "freeff_db", "3ww7cLKt") or die(mysql_error());
mysql_select_db("freeff_db")or die(mysql_error());

$ip=$_SERVER['REMOTE_ADDR'];

if(!stristr($ip, "65.49.14.") === FALSE) {
die("לא ניתן להתחבר עם פרוקסי");
}


$agent = $_SERVER['HTTP_USER_AGENT'];
if(!stristr($ip, "proxy") === FALSE) {
die("לא ניתן להתחבר עם פרוקסי");
}

if(!stristr($ip, "anon") === FALSE) {
die("לא ניתן להתחבר עם פרוקסי");
}


$cid = $_COOKIE['TG-Id'];
$cuser = $_COOKIE['TG-Username'];
$cpassword = $_COOKIE['TG-Password'];
$badate=10780;
$voice="http://up203.siz.co.il/file1/2nmy2mvxmzih.wma";
$details = mysql_query("SELECT * FROM `Sys-TG-Users` WHERE user='$cuser'");  
while($row = mysql_fetch_array($details)) {
$cvip = $row['vip'];
$cemail = $row['email'];
$cedit = $row['edit'];
$cdelete = $row['delete'];
$cban = $row['ban'];
$cip = $row['seeip'];
$cadmin = $row['adm'];
$max2=5;
if($cuser != $row['user'] && $cpassword != $row['password']) 
{
die("<html dir=\"rtl\">\n<h1>\n<div align=\"center\">\nשם משתמש או סיסמה לא נכונים\n</div>\n</h1>");
}
elseif($cuser == $row['user'] && $cpassword != $row['password'])
{
die("<h1><center>הסיסמה לא נכונה</center></h1>");
}
}
?>