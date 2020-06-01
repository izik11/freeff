<html dir=rtl>
<?php
include("db.php");
if(!$cuser)
{
die("<script>alert('אתה לא מחובר כמנהל')</script><script>window.location = 'index.php'</script>");
}
$todaytime=time() + $badate;

echo "צפיה לפי משתמשים:<br>";
$select = mysql_query("SELECT * FROM `Sys-TG-Users`");
while($row = mysql_fetch_array($select)) {
echo "<a href='?u={$row['user']}'>{$row['user']}</a> || ";
}
echo "<Br><br><br>";

$u=$_GET['u'];
if($u) {
$count=0;
$select2 = mysql_query("SELECT * FROM `adminon` WHERE `name` ='{$u}'");
while($row = mysql_fetch_array($select2)) {
$count++;
echo $row['date']; echo " || <a href=del-adminon.php?id={$row['time']}>מחק</a> <Br> ";
}
echo  "<br><BR> total: {$count}";
}
?>