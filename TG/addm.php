<?php
include("db.php");
if($cban == "0")
{
die("אין לך גישות");
}

if(!$cuser)
{
die("<script>alert('אתה לא מחובר כמנהל')</script><script>window.location = 'index.php'</script>");
}

$code = $_GET['code'];

if($code != "")
{
$homepage = file_get_contents('http://multidown.co.il/api.php?code='.$code);
$pos = strpos($homepage,"this code is n");
if($pos > 0) {
 $work=0;
die("{$homepage}<script>alert('הקוד לא תקין')</script><script>history.back()</script>");
}
else {
 $work=1;
}
	$check = mysql_query("SELECT * FROM `multidown` WHERE `code`='{$code}'");  
	if(@mysql_num_rows($check) == 0)
	{

		$add = mysql_query("INSERT INTO `multidown` (`id` ,`code` ,`good` )VALUES ('0', '{$code}', '1');") or die(mysql_error()); 

		if($add != "")
		{
		die("<script>alert('הקוד נוסף בהצלחה למאגר!')</script><script>history.back()</script>");
		}
	} else {
		die("<script>alert('הקוד כבר קיים במאגר הנתונים')</script><script>history.back()</script>");	
	}
} else {
?>
<form method="get" action="addm.php">
Enter MultiDown Code: <input name="code" id="code" value="" class="skin" type="text">
<input value="Add" class="skin" type="submit">
</form>
<?
}
?>