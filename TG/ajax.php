<?php
header("Content-type: text/html; charset=windows-1255");
include("db.php");

if(!$cuser)
{
echo("<script>alert('אתה לא מחובר כמנהל')</script><script>window.location = 'index.php'</script>");
die();
}

$id = $_GET['id'];

if($id)
{
$details = mysql_query("SELECT * FROM `banlist` WHERE `banlist`.`id` = '{$id}'") or die("Error!");  
while($ban = mysql_fetch_array($details)) {
echo <<<EOF
<div dir=rtl>
{$ban['post']}
<br>
<a href="javascript:void();" onclick="la('{$id}tr');">סגור</a>
</div>
EOF;
}
} else {
die("שגיאה אין אידי!");
}


?> 