<?php
include("db.php");

/* if(!$cuser) {
die("Error Login!");
 } */
		$ip = $_SERVER['REMOTE_ADDR'];
		setcookie("tvnet_ip", 0, time() - (24 * 60 * 60)); 
		mysql_query("DELETE FROM `downloads` WHERE `ds_ip`='$ip'");
		setcookie("tvnet_vip", 1, time() - (24 * 60 * 60));
		setcookie("tvnet_vip_user_id", $id, time() - (24 * 60 * 60));

echo("<script>alert('נמחק')</script><script>window.location = 'admin.php'</script>");

?>