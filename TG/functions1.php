<?php

function cookie_encrypt($data_input)
{     
	if ($data_input != "")
	{
		$key = "tv|net96485";
		$td = mcrypt_module_open('cast-256', '', 'ecb', '');
		$iv = mcrypt_create_iv (mcrypt_enc_get_iv_size($td), MCRYPT_RAND);
		mcrypt_generic_init($td, $key, $iv);
		$encrypted_data = mcrypt_generic($td, $data_input);
		mcrypt_generic_deinit($td);
		mcrypt_module_close($td);
		$encoded_64 = base64_encode($encrypted_data);
		return $encoded_64;
	}
	else
		return "";
}   


function cookie_decrypt($encoded_64)
{
	if ($encoded_64 != "")
	{
		$decoded_64 = base64_decode($encoded_64);
		$key = "tv|net96485";
		$td = mcrypt_module_open('cast-256', '', 'ecb', '');
		$iv = mcrypt_create_iv (mcrypt_enc_get_iv_size($td), MCRYPT_RAND);
		mcrypt_generic_init($td, $key, $iv);
		$decrypted_data = mdecrypt_generic($td, $decoded_64);
		mcrypt_generic_deinit($td);
		mcrypt_module_close($td);

		return $decrypted_data;
	}
	else
		return "";
} 


function fetch_url()
{
	if( $_SERVER['REQUEST_URI'] || $_ENV['REQUEST_URI'] )
	{
		$url = $_SERVER['REQUEST_URI'] ? $_SERVER['REQUEST_URI'] : $_ENV['REQUEST_URI'];
	}
	else
	{
		if( $_SERVER['PATH_INFO'] || $_ENV['PATH_INFO'] )
		{
			$url = $_SERVER['PATH_INFO'] ? $_SERVER['PATH_INFO'] : $_ENV['PATH_INFO'];
		}
		elseif( $_SERVER['REDIRECT_URL'] || $_ENV['REDIRECT_URL'] )
		{
			$url = $_SERVER['REDIRECT_URL'] ? $_SERVER['REDIRECT_URL'] : $_ENV['REDIRECT_URL'];
		}
		else
		{
			$url = $_SERVER['PHP_SELF'] ? $_SERVER['PHP_SELF'] : $_ENV['PHP_SELF'];
		}

		if( $_SERVER['QUERY_STRING'] || $_ENV['QUERY_STRING'] )
		{
			$url .= '?'.( $_SERVER['QUERY_STRING'] ? $_SERVER['QUERY_STRING'] : $_ENV['QUERY_STRING'] );
		}
	}

	$url = preg_replace('/s=[a-z0-9]{32}?&?/', '', $url);
	$url = preg_replace('/&(?!#[0-9]+;)/si', '&amp;', $url);
	$url = str_replace(array('<','>','"'), array('&lt;','&gt;','&quot;'), $url);
	$url = preg_replace(array('#javascript#i','#vbscript#i'), array('java script','vb script'), $url);

	return $url;
}

function fetch_ip()
{
	$ip = $_SERVER['REMOTE_ADDR'];
	if( isset($_SERVER['HTTP_CLIENT_IP']) )
	{
		$ip = $_SERVER['HTTP_CLIENT_IP'];
	}
	elseif( isset($_SERVER['HTTP_X_FORWARDED_FOR']) && preg_match_all('#\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}#s', $_SERVER['HTTP_X_FORWARDED_FOR'], $match))
	{
		foreach( $match[0] as $v )
		{
			if( ! preg_match("#^(10|172\.16|192\.168)\.#", $v) )
			{
				$ip = $v;
				break;
			}
		}
	}
	elseif( isset($_SERVER['HTTP_FROM']) )
	{
		$ip = $_SERVER['HTTP_FROM'];
	}

	if( ! $ip || $ip == '...' )
	{
		print_error("לא ניתן היה לזהות את כתובת ה IP שלך.");
	}

	return $ip;
}


function get_gmdate($time="")
{
	$offset  = 7 * 3600; // GMT+02:00
	$timenow = $time ? $time : time();

	return gmdate("D d-M-Y H:i:s A", ($timenow - $offset));
}

function getUserVip($cook, $voip = 0)
{ 
/*	if($cook == "") {
	@header("Location: wellcome.php");
	}*/
	$realInfo = cookie_decrypt($cook);

	$info_a = explode("&", $realInfo);

	$temp_a = explode("=", $info_a[0]);
	$user_id = $temp_a[1];

	$temp_b = explode("=", $info_a[1]);
	$username = $temp_b[1];

	$temp_c = explode("=", $info_a[2]);
	$password = $temp_c[1];

	$limit = 604800;
	mysql_query("DELETE FROM `Sys-User-Vip` WHERE UNIX_TIMESTAMP() - date > $limit ") OR die ('#3');  

	$vip = mysql_query("SELECT * FROM `Sys-User-Vip` WHERE `user_id`='{$user_id}' AND `username`='{$username}' AND `password`='{$password}'");  
	if(mysql_num_rows($vip) == 0) {
	return 0;
	} else {
	while($row = mysql_fetch_array($vip)) {
	$tims = (time() - $row['date'] - 604800);
	$timeleft = ($row['date'] - time());
	$left = ($tims / 24 / 60 / 60);
	$new = substr($left, 1, 2);
	$new = str_replace( '.', '', $new );
	$minus = $new*24;
	$minus2 = $new*24;
	$left2 = ($tims / 3600 + $minus2);
	$new2 = substr($left2, 1, 2);
	$left3 = ($tims / 60);
	$new3 = substr($left3, 0, 0);
		if($voip == 1) {
		$idanti = $row['user_id'];
		$emailanti = $row['email'];
		echo <<<EOF
		<a href="editu.php?id={$idanti}&email={$emailanti}">שנה פרטים</a>
		<font color="lightblue" size="5" face="David">נשאר לך {$new} ימים לסיום ו{$new2} שעות לסיום המנוי</font>
EOF;
		$time66 = time();
		$correct_time66 = $time66 + 760;
		$save_log  = (fetch_ip() . " - ". date('H:i , j.n.y', $correct_time66) . " - " . $row['user_id'] . " - " . $row['username'] . "\n");
		$file = fopen('../vip.txt', 'a', 1);
		fwrite($file, $save_log); 
		fclose($file);
		} else if($voip == 2) {
		echo <<<EOF
		<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
		<HTML DIR="RTL">
		<HEAD>
		<TITLE>Wellcome</TITLE>
		<script language="javascript">
		document.oncontextmenu = function(){return false}
		if(document.layers) {
		window.captureEvents(Event.MOUSEDOWN);
		window.onmousedown = function(e){
		if(e.target==document)return false;
		}
		}
		else {
		document.onmousedown = function(){return false}
		}
		</script> 
		</HEAD>
		<BODY onSelectStart="return false" bgcolor="#1c1c1c" style="margin:0px;background-color:#1c1c1c1;overflow-y: hidden;overflow: -moz-scrollbars-vertical;border:none;" scroll="no">
		<font color="mediumred" size="3" face="Tahoma"><b>ברוך הבא {$username}.</b><br /><br />המנוי שלך יגמר בעוד {$new} ימים.</font>
		</BODY>
		</HTML>
EOF;
		}
	}
	}

	return 1;
	}
	

function getUserVip2($cook)
{ 
	$realInfo = cookie_decrypt($cook);
	$info_a = explode("&", $realInfo);

	$temp_a = explode("=", $info_a[0]);
	$user_id = $temp_a[1];

	$temp_b = explode("=", $info_a[1]);
	$username = $temp_b[1];

	$temp_c = explode("=", $info_a[2]);
	$password = $temp_c[1];


	$vip = mysql_query("SELECT * FROM `Sys-User-Vip` WHERE `user_id`='{$user_id}' AND `username`='{$username}' AND `password`='{$password}'");  
	if(mysql_num_rows($vip) == 0) {
		return 0;
	} else {
		return 1;
	}

	return 0;
}
?> 