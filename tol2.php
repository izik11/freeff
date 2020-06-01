<?
if(!($_GET["where"] == "tool")) { die("התגלתה בעיה"); }
include("banlist.php");
setcookie ('imnot', 'kkk', time() + (60*60*24*30*10));
?>

<SCRIPT language="JavaScript">
function sub()
{
  document.form.submit();
}
</SCRIPT> 

<form method=post action="tol.php?do=true" name=form onload="sub();" >
<input type=hidden value="checku" name="check">
<input type=hidden value="another" name="checked2">
</form>
<body onload="sub();"></body>
