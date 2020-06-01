<Html dir=rtl>
<head>
<title>מערכת התראת סיסמאות חדשות</title>
<META NAME="language" CONTENT="hebrew">
<meta http-equiv="Content-Language" content="he"> 
<meta http-equiv="Content-Type" content="text/html; charset=windows-1255"> 
<script language="javascript" type="text/javascript">
function popitup() 
{
if(confirm("האם אתה מעוניין לפתוח את האתר?")) {
a=window.open( "http://www.freeff.co.il" )
a.focus()
}
}
function help() 
{
alert("מה שאני בעצם עושה זה בודק כל דקה אם יש סיסמא חדשה\nאם כן אני מקפיץ לך הודעה שם לך מוזיקה ופותח לך את האתר\nסיסמא חדשה הכוונה שלא לקחו אותה מקסימום אנשים\nאולי הסיסמאות באדום עובדות אבל זה לא תפקידי לבדוק זה תפקידך\nאז פשוט תשאיר את זה פתוח ככה תעשה את זה הכי קטן\nזה לא יפריע לך בגלישה אל תדאג");
}

function help2() 
{
alert("שימו לב, שאתם משתמשים בie7 עם הכרטיסיות ופתחתם אותי,\nאני אציג לכם את האלרט רק בכרטיסיה שממנה פתחת אותי!\nשים לב לזה!!! אבל אני בכל מקרה אנגן לך ");
}
</script>

<?
include("banlist.php");
if(!($_GET["do"] == "true")) { die("התגלתה בעיה"); }
if($_POST["check"] != "checku" || $_POST["checked2"] != "another") { die("התגלתה בעיה חמורה"); }
//if($_SERVER["HTTP_REFERER"] != "http://www.freeff.co.il/tol2.php?where=tool") { die("התגלתה בעיה חמורה מאוד"); }

$password = mysql_query("SELECT * FROM `RSS` WHERE `vip` = '0' ORDER BY `RSS`.`id` DESC LIMIT 0 , 6");  
$rows = mysql_num_rows($password);
while($row = @mysql_fetch_array($password)) {
if ($row['Top'] == 1) { $true=1; }
}
if ( $true==1) {
echo <<<EOF

<EMBED name="musicpass" src="{$voice}" width=0 height=0 PLAYCOUNT=2 type=application/x-mplayer2 VOLUME=100 AUTOSTART=true>
<meta http-equiv="Refresh" content="300; URL=tol2.php">
<script>alert("נוספה סיסמא חדשה! כנס לאתר ותפוס אותה!");</script>
<body onload="popitup();">
נוספה סיסמא חדשה לאתר! תמהר לתפוס אותה!<Br>
אני אמשיך לבדוק עבורך סיסמאות חדשות בעוד 5 דקות!
</body>

EOF;
} else {
echo <<<EOF
<meta http-equiv="Refresh" content="50; URL=tol2.php?where=tool">
</head>
אין כרגע סיסמאות חדשות, אולי יש אדומות שעובודת, אבל לא בשביל זה אני פה :)<br>
<a onclick="help();"><u><font color=blue>מה בעצם החלון הזה עושה?</font></u></a><Br>
<a onclick="help2();"><u><font color=blue>זה לא ממש עובד לי</font></u></a><Br>
<a href=http://www.freeff.co.il target=_blank><u><font color=blue>כניסה לאתר</font></u></a><Br>
<iframe src="http://www.freeff.co.il/index.php?err=8"></iframe>
EOF;
}

?>