<?
include("db.php");
$count=0;
$subject="Your FileFlyer Link Is Ready";
$sendFrom="anti.release@gmail.com";
$sql = mysql_query("SELECT * FROM `link` WHERE `link`.`stat` = '1' AND `link`.`openlink` != ''") or die("Error!");  
while($row = mysql_fetch_array($sql)) {
$msg="Your FileFlyer link: http://www.fileflyer.com/view/{$row['id2']} is now ready, \n
you can download it from this link:\n
http://www.FreeFF.Co.iL/openlinks/download.php?id={$row['id']}\n\n
http://WwW.FreeFF.Co.iL\n
http://WwW.iPass.Co.iL";
mail($row['email'], $subject, $msg, "From:".$sendFrom);
$ok = mysql_query("UPDATE `link` SET `stat` = '2' WHERE `link`.`id` ={$row['id']} ;");
$count++;
}
echo "total send: {$count}";
$count=0;
echo "<br>";
$subject="Your FileFlyer Link Is Invalid";
$sql = mysql_query("SELECT * FROM `link` WHERE `link`.`stat` = '0' OR `link`.`openlink` = ''") or die("Error!");  
while($row = mysql_fetch_array($sql)) {
$msg="Error! your link: http://www.fileflyer.com/view/{$row['id2']} is invalid, \n
please go back to our site and try to enter this link one more time!\n\n
http://WwW.FreeFF.Co.iL\n
http://WwW.iPass.Co.iL";
mail($row['email'], $subject, $msg, "From:".$sendFrom);
$ok = mysql_query("UPDATE `link` SET `stat` = '0' WHERE `link`.`id` ={$row['id']} ;");
$count++;
}
echo "total send: {$count}";
?>
