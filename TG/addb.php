<?php
include("db.php");
if($cban == "0")
{
die("אין לך גישות לתת באן");
}

if(!$cuser)
{
die("<script>alert('אתה לא מחובר כמנהל')</script><script>window.location = 'index.php'</script>");
}

$before = $_GET['before'];
$after = $_GET['after'];
$test = $_GET['test'];

if($before != "" || $after != "" || $test != "")
{

$add = $add = mysql_query("INSERT INTO `Sys-Ban` (`id` ,`before` ,`after` ,`test` )VALUES ('0', '{$before}', '{$after}', '{$test}');")or die(mysql_error()); 

	if($add != "")
	{
	die("<script>alert('נוסף בהצלחה!')</script><script>history.back()</script>");
	}

} else {
die("<script>alert('לא הכנסת IP')</script><script>history.back()</script>");
}
?>