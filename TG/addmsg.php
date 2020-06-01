<?php
include("db.php");


if(!$cuser)
{
die("<script>alert('אתה לא מחובר כמנהל')</script><script>window.location = 'tg.php'</script>");
}

$id = $_GET['id'];
$message = $_GET['message'];
$from = $_GET['from'];


$details = mysql_query("SELECT * FROM `Sys-TG` WHERE id='$id'") or die("Error!");  
	while($row = mysql_fetch_array($details)) {

		$name = str_replace( "&#39;"   , "'", $name );
		$name = str_replace( "&#33;"   , "!", $name );
		$name = str_replace( "&#036;"   , "$", $name );
		$name = str_replace( "&#124;"  , "|", $name );
		$name = str_replace( "&amp;"   , "&", $name );
		$name = str_replace( "&gt;"    , ">", $name );
		$name = str_replace( "&lt;"    , "<", $name );
		$name = str_replace( "&quot;"  , '"', $name );
		$post = str_replace( "&#39;"   , "'", $post );
		$post = str_replace( "&#33;"   , "!", $post );
		$post = str_replace( "&#036;"   , "$", $post );
		$post = str_replace( "&#124;"  , "|", $post );
		$post = str_replace( "&amp;"   , "&", $post );
		$post = str_replace( "&gt;"    , ">", $post );
		$post = str_replace( "&lt;"    , "<", $post );
		$post = str_replace( "&quot;"  , '"', $post );
$a=explode($message,$row["post"]);
if($a[1] != "") { die("<script>window.location='../tg.php';</script>"); } 
		$msg = $row["post"] . "\n<br><b><font color=darkred>תגובה מאת {$from}: {$message}.</font></b>";
		$ok = mysql_query("UPDATE `Sys-TG` SET `post` = '{$msg}' WHERE `Sys-TG`.`id` ={$id} ;");
		die("<script>alert('התגובה {$id} עודכנה בהצלחה');window.location='../tg.php';</script>");
	}

?>