<?php
include("db.php");

if(!$cuser)
{
die("<script>alert('אתה לא מחובר כמנהל')</script><script>window.location = 'index.php'</script>");
}

$name="תומך כלכלית";
$email="idonthave";
$funtime = time();
$time66 = time();
$correct_time66 = $time66 + $badate;
$date = date("H:i , j.n.y", $correct_time66);
$ip="no-ip-4-me";
/*
$text="חברים, תלחצו על הפרסומות באתר!!! שיהיה להם כסף לקנות לנו סיסמאות חדשות!!<BR>
חברים תעזרו קצת למנהלים ותנו קליקים על הפרסומות שלהם... זה יכניס להם קצת כסף שהם יוכלו לקנות באמצעותו סיסמאות!! <br>
כבר תמכתם בהם היום? כי אני כן! אז קדימה, תמשיכו לתמוך בהם והם יביאו לנו יותר סיסמאות!!!<BR>
כמו כן אל תשכחו לפרסם את האתר בפורומים ואתרים אחרים ולחברים באיסי ובמסן :)

<b><center>
<script type= "text/javascript" language="javascript" src="http://live.sekindo.com/live/liveView.php?s=2659"></script>
<br>
</b></center>

";*/

$text="חברים, אם אתם רוצים לעזור לאתר, זה פשוט מאוד, תלחצו על הפרסומות שאתם רואים!<br>
תירשמו שם לכל הדברים, זה מכניס להם כסף, תפרסמו את האתר לחברים, זה עוזר!<br>
הם לא עושים עלינו שקל רווח, כל הכסף הולך על תחזוקת השרתים (תקראו בשאלות ותשובות)<br>
אז.. כבר תמכתם בהם היום? אם לא, למה אתם מחכים?! ותפרסמו אותם בכל האינטרנט!!";

$text2='
<center>
<script type="text/javascript" language="javascript" src="http://live.sekindo.com/live/liveView.php?s=9337"></script><br> 
</center>
';
if($_GET['who'] == 2) { 
	$ok2 = mysql_query("INSERT INTO `Sys-TG` (`id` ,`name` ,`email` ,`admin` ,`date` ,`post`,`ip`,`time` )VALUES ('0', 'AnTi-BoT', '$email', '1', '$date', '$text2', '$ip','$funtime');");
} else { 
	if($_GET['who']==1) {
		echo " <script>window.location='delban.php?bot=1';</script>";
	} else {
		if($_GET['who']==3) { 
			$ok = mysql_query("INSERT INTO `Sys-TG` (`id` ,`name` ,`email` ,`admin` ,`date` ,`post`,`ip`,`time` )VALUES ('0', '$name', '$email', '0', '$date', '$text', '$ip','$funtime');");
		}
	}
}

if($ok != "" || $ok2 != "")
{
die("<script>alert('ההודעה נוספה בהצלחה')</script><script>window.location='../tg.php'</script>");
}


?>