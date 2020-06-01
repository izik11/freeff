<?php
@ob_start();
@session_start();

include("db.php");
include("functions.php");

if($_GET["go"] == "wellcome.php") {
die("<script>window.location = 'wellcome.php'</script>");
}
echo '<meta http-equiv="Content-Type" content="text/html; charset=windows-1255"> ';
if($_GET['act'] == "Logout")
{
setcookie("TG-Vip","",time()-60*60*24*31*12);  
die("<script>alert('התנתקת בהצלחה.')</script><script>window.location = '../tg.php'</script>");
} else if($_GET['act'] == "LogoutClient") {
setcookie("TG-Vip","",time()-60*60*24*31*12);
die("<script>alert('You are logout now.')</script><script>window.location = 'program-vip.php'</script>");
}

$mode = $_GET["mode"];

if($_POST['secCode'] != $_SESSION['sec1'] && $mode != "client") {
die("<script>alert('קוד אבטחה שגוי')</script><script>window.location = '../tg.php'</script>");
}

if(!$_POST['GoLogin'] && $mode != "client") {
die("<script>alert('Error!')</script><script>window.location = 'tg.php'</script>");
}

$user = ($_POST['username'] ? $_POST['username'] : $_GET['username']);
$pass = ($_POST['password'] ? $_POST['password'] : $_GET['password']);

$details = mysql_query("SELECT * FROM `Sys-User-Vip` WHERE `username`='{$user}' AND `password`='{$pass}'");  
while($row = mysql_fetch_array($details))
if($pass == $row['password']) {  
if($_GET["ajax"] == "1") {
echo "1";
die();
}
$cco = cookie_encrypt("UserID={$row['user_id']}&Username={$row['username']}&Password={$row['password']}&site=ok");
/*echo <<<EOF
{$row['user_id']}<br />
{$row['username']}<br />
{$row['password']}<br />
{$cco}
EOF;*/
setcookie("TG-Vip",$cco,time()+360000);
setcookie("TG-Vip",$cco,time()+360000,"/");
$_SESSION["TG-Vip"] = $cco;
if($mode == "client") {
die("<script>alert('התחברת בהצלחה למערכת ה-Vip הרשמית')</script><script>window.location = 'program-vip.php'</script>");
} else {
die("<script>alert('התחברת בהצלחה למערכת ה-Vip הרשמית')</script><script>window.location = '../tg.php'</script>");
}
} else {
die("<script>alert('פרטים שגויים, אם אתה לא מנהל ותנסה \n אתה יכול לקבל באן מהאתר')</script><script>window.location = '../tg.php'</script>");
}

?>

שם משתמש / סיסמא שגויים נסה שוב