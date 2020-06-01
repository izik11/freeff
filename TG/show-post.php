<?php
include("db.php");

if(!$cuser)
{
die("<script>alert('אתה לא מחובר כמנהל')</script><script>window.location = 'index.php'</script>");
}

$id = $_GET['id'];

if($id)
{
$details = mysql_query("SELECT * FROM `banlist` WHERE `banlist`.`id` = '{$id}'") or die("Error!");  
while($ban = mysql_fetch_array($details)) {
echo <<<EOF
<tr><td>Id: {$ban['id']}</td><td> | </td>
<td>Post: {$ban['post']}</td>
</tr>
<tr><td><a href="#" onclick="history.back();">Go Back</a></td></tr>
EOF;
}
} else {
die("שגיאה אין אידי!");
}
?>