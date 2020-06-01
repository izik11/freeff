<?php
include("../db.php");
$pass=mysql_real_escape_string(htmlspecialchars($_GET['pass']));;


if(!$pass) {
die("no pass");
}

echo $pass;
?>
