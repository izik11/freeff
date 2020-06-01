<?php


mysql_connect("localhost", "anti_tvnet", "PppEuZm8") or die(mysql_error());
mysql_select_db("anti_tvnet")or die(mysql_error());


$cid = $_COOKIE['TG-Id'];
$cuser = $_COOKIE['TG-Username'];
$cpassword = $_COOKIE['TG-Password'];
$badate=4320;
$voice="http://up201.siz.co.il/file1/jynvzjki22yg.wma";
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
