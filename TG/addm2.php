<?php
include("db.php");

if($cban == "0") {
die("Error!");
}

if(!$cuser) {
die("Error Login!");
}
?>
<html><head>
<title>הוספת מולטי</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1255"> 

<body>


<?

$details = mysql_query("SELECT * FROM `multidown` WHERE `good`=1 ");  
while($ban = mysql_fetch_array($details)) {
	$code=$ban['code'];
	$homepage = file_get_contents('http://multidown.co.il/api.php?code='.$code);
	$pos = strpos($homepage,"this code is n");
	if($pos > 0) {
		$ok = mysql_query("UPDATE `multidown` SET `good` = '0' WHERE `id` ={$ban['id']} ;");
		die('אין חשבון זמין במערכת');
	}else {
		 $ok = mysql_query("UPDATE `multidown` SET `good` = '0' WHERE `id` ={$ban['id']} ;");
		$code="{$ban['code']};1;0;multidown";
$time66 = time();
$correct_time66 = $time66 + $badate;
$date2 = date("H:i , j.n.y", $correct_time66);
$date3 = date("j.n.y בשעה H:i", $correct_time66);
		$ok2 = mysql_query("INSERT INTO `RSS` (`id` ,`password` ,`by` ,`time` ,`max` ,`Top` ,`vip` ,`site` ,`date` )VALUES (NULL , '{$code}', 'AnTi', '{$date3}', '5', '1', '0', 'rapidshare', '{$time66}');");
		$ok3 = mysql_query("INSERT INTO `Sys-TG` (`id` ,`name` ,`email` ,`admin` ,`date` ,`post`,`ip`,`time` )VALUES ('0', 'AnTi', 'autopass@FreeFF.co.il', '1', '$date2', 'נוסף חשבון פרימיום חדש לMultiDown שתקף ליום שלם אחד! לאדם הראשון שיזכה לקחת אותו!<br>כל אדם זכאי לקופון אחד בלבד!', 'no-ip-4-me','0');");
		if($ok2) { die('החשבון נוסף בהצלחה'); }
	}

}
die('אין חשבון זמין במערכת');
?>

</body></html>