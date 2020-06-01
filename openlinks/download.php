<?
include("db.php");
$id=mysql_real_escape_string(htmlspecialchars($_GET['id']));

$sql = mysql_query("SELECT * FROM `link` WHERE `link`.`id` = {$id}") or die("Error!");  
while($row = mysql_fetch_array($sql)) {
if($row['stat']=="2"){
header("Location: {$row['openlink']}"); } 
}

?>
