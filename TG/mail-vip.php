<meta http-equiv="Content-Type" content="text/html; charset=windows-1255"> 
<?php
include("db.php");

if(!$cuser)
{
die("<script>alert('אתה לא מחובר כמנהל')</script><script>window.location = 'index.php'</script>");
}

$email = $_GET['email'];
$user = $_GET['user'];
$pass = $_GET['pass'];

if($email)
{
mail($email, "VIP at FreeFF.Co.iL - Free FileFlyer", "UserName: {$user}\n\rPassWord: {$pass}\nEnJoY! Free FileFlyer Team.", "From: Free FileFlyer <anti.release@gmail.com>");
die("<script>alert('האימייל נשלח בהצלחה')</script><script>window.location = 'vip-list.php'</script>");
} else {
die("שגיאה אין אימייל");
}
?>