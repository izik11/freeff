<?php
include("db.php");

if($cedit == "0")
{
die("אין לך גישה לעריכת הודעות");
}

if(!$cuser)
{
die("<script>alert('אתה לא מחובר כמנהל')</script><script>window.location = '../tg.php'</script>");
}

$id = $_GET['id'];
$name = $_POST['name'];
$post = $_POST['post'];

if($id)
{
$details = mysql_query("SELECT * FROM `Sys-TG` WHERE id='$id'") or die("Error!");  
	while($row = mysql_fetch_array($details)) {
	if($_POST['submit'] == " עדכן ") {

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
                $post = str_replace( "<link>"  , '<a href=http://FreeFF.co.il target=_blank>', $post );


		$ok = mysql_query("UPDATE `Sys-TG` SET `name` = '{$name}',`post` = '{$post}' WHERE `Sys-TG`.`id` ={$id} ;");
		if($ok != "") {
		die("<script>alert('התגובה {$id} עודכנה בהצלחה')</script><script>window.location = '../tg.php'</script>");
		}
	}
	$row['name'] = str_replace( "'"   , "&#39;", $row['name'] );
	$row['name'] = str_replace( "!"   , "&#33;", $row['name'] );
	$row['name'] = str_replace( "$"   , "&#036;", $row['name'] );
	$row['name'] = str_replace( "|"  , "&#124;", $row['name'] );
	$row['name'] = str_replace( "&"   , "&amp;", $row['name'] );
	$row['name'] = str_replace( ">"    , ">", $row['name'] );
	$row['name'] = str_replace( "<"    , "&lt;", $row['name'] );
	$row['name'] = str_replace( '"'  , "&quot;", $row['name'] );
	$row['post'] = str_replace( "'"   , "&#39;", $row['post'] );
	$row['post'] = str_replace( "!"   , "&#33;", $row['post'] );
	$row['post'] = str_replace( "$"   , "&#036;", $row['post'] );
	$row['post'] = str_replace( "|"  , "&#124;", $row['post'] );
	$row['post'] = str_replace( "&"   , "&amp;", $row['post'] );
	$row['post'] = str_replace( ">"    , ">", $row['post'] );
	$row['post'] = str_replace( "<"    , "&lt;", $row['post'] );
	$row['post'] = str_replace( '"'  , "&quot;", $row['post'] );
	$row['post'] = str_replace( '<br />'  , "\n", $row['post'] );
	echo <<<EOF
	<div align="center" dir="rtl">
	<form action="edit.php?id={$row['id']}" method="post">
	<table border=0 cellspacing=5 cellpadding=0 bgcolor="#000000">
	<tr>
	<td width=100>
	<b><font color="white">שם:</font></b>
	</td>
	<td width=300>
	<input type="text" name="name" value="{$row['name']}">
	</td>
	</tr>
	<tr>
	<td width=100>
	<b><font color="white">תוכן:</font></b>
	</td>
	<td width=300>
	<textarea width="300" name="post" rows="20" cols="50" dir="ltr">{$row['post']}</textarea>
	</td>
	</tr>
	<tr>
	<td colspan=2>
	<table width=100% border=0 cellspacing=0 cellpadding=3>
	<tr>
	<td width=100% align="center">
	<input type="submit" name="submit" value=" עדכן "></td>
	<input type="reset" name="reset" value=" בטל שינוים "></td>
	</tr>
	</table>
	</td>
	</tr>
	</table>
	</form>
	</div>
EOF;
	}
} else {
die("שגיאה אין אידי!");
}
?>