<?
$ip=$_SERVER['REMOTE_ADDR'];
$file = file_get_contents('http://geoip.wtanaka.com/cc/'.$ip);
echo $file;
if($file != "il") { die("сс"); } 
else { die("ok"); }
?>

