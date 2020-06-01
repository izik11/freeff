<?php
include("db.php");

if(!$cuser)
{
die("<script>alert('אתה לא מחובר כמנהל')</script><script>window.location = 'index.php'</script>");
}

if($_GET['bot'] == "1") 
{

$details = mysql_query("SELECT * FROM `Sys-TG` WHERE `Sys-TG`.`name` = 'תומך כלכלית' AND `Sys-TG`.`ip`='no-ip-4-me' ") or die("Error!");  
while($row = mysql_fetch_array($details)) {
$idd=$row['id'];
$details2 = mysql_query("DELETE FROM `Sys-TG` WHERE `Sys-TG`.`id` = '{$idd}'") or die("Error!");  
}
echo "<script>window.location='to.php?who=3';</script>";
}

else {

for($i=1000;$i<=1200;$i++) {

//$details = mysql_query("DELETE FROM `Sys-TG` WHERE `Sys-TG`.`id` = '{$i}'") or die("Error!");  
$details = mysql_query("DELETE FROM `banlist` WHERE `banlist`.`id` = '{$i}'") or die("Error!");  

}

/*
//$details=mysql_query("TRUNCATE TABLE `Sys-TG` ") or die("Error!");  
//echo $details;
//$details = mysql_query("DELETE FROM `banlist` WHERE `banlist`.`id` = '{$i}'") or die("Error!");  
	
}*/


}
?>