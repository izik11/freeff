<?php
include("db.php");

@session_start();
if($_GET['act'] == "Logout")
{
setcookie("TG-Id","",time()-3600);
setcookie("TG-Username","",time()-3600);
setcookie("TG-Password","",time()-3600);  
setcookie("TG-G","",time()-3600);  
setcookie("TG-Banned","",time()-60*60*24*31*12);  
die("<script>alert('You are logout now.')</script><script>history.back()</script>");
}

if($_POST['secCode'] != $_SESSION['sec1']) {
die("<script>alert('Error!2')</script><script>history.back()</script>");
}

if(!$_POST['GoLogin']) {
die("<script>alert('Error!')</script><script>history.back()</script>");
}

$user = $_POST['user'];
$pass = md5($_POST['password']);

$user = mysql_real_escape_string(htmlspecialchars($user));
$pass = mysql_real_escape_string(htmlspecialchars($pass));

$details = mysql_query("SELECT * FROM `Sys-TG-Users` WHERE user='$user'");  
while($row = mysql_fetch_array($details))
if($user == $row['user'] && $pass == $row['password']) {  
setcookie("TG-Id","$row[id]",time()+360000);
setcookie("TG-Username","$row[user]",time()+360000);
setcookie("TG-Password","$row[password]",time()+360000);  
die("<script>alert('You are login at $row[user].')</script><script>history.back()</script>");
} else {
die("<script>alert('פרטים שגויים, אם אתה לא מנהל ותנסה. \n אתה יכול לקבל באן מהאתר.')</script><script>history.back()</script>");
}
?>