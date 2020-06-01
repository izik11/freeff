<?
include("db.php");
include("functions.php");
		$time66 = time();
		$correct_time66 = $time66 + $badate;
		$save_log  = (fetch_ip() . " - ". date('H:i , j.n.y', $correct_time66) . "\n");
		$file = fopen('fuck.txt', 'a', 1);
		fwrite($file, $save_log); 
		fclose($file);
?>