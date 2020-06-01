<?
define('POSTVARS', 'url=http://upload4.fileflyer.com/view/A946JX0FET1MCT');
$ch = curl_init("http://passflyer.cz.cc/fileflyer2.class.php");
 curl_setopt($ch, CURLOPT_POST      ,1);
 curl_setopt($ch, CURLOPT_POSTFIELDS    ,POSTVARS);
 curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,0);
 curl_setopt($ch, CURLOPT_HEADER      ,0);  // DO NOT RETURN HTTP HEADERS
 curl_setopt($ch, CURLOPT_RETURNTRANSFER  ,1);  // RETURN THE CONTENTS OF THE CALL
 $Rec_Data = curl_exec($ch);

echo $Rec_Data;
curl_close($ch);
/*
$a=explode('<a href="',$Rec_Data);
if($a[2] !="" ) { 
$b=explode('">',$a[2]); } else { die("קרתה שגיאה - נסה שוב מאוחר יותר"); }
if($b[0] !="") { 
echo <<<EOF
<a href="{$b[0]}" target="_blank">לחץ כאן להורדת הקישור שלך!</a>
EOF;
die(); } else { die("קרתה שגיאה - נסה שוב מאוחר יותר"); }
*/
exit;
?>