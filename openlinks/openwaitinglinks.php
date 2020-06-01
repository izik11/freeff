<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="he" xmlns="http://www.w3.org/1999/xhtml" xml:lang="he">
<head>
   <meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
   <title>FileFlyer </title>
</head>
<body style="direction:rtl;">
אנא המתן! - פותח לינקים!<br>
<?php
include("db.php");
$count1=0;
if($pass==0){ die("אין סיסמא פעילה"); }
$details = mysql_query("SELECT * FROM `link` WHERE `stat`='0'") or die("Error!");  
while($row = mysql_fetch_array($details)) {
$k11=$row['id2'];


	$target = "http://www.fileflyer.com/view/{$k11}"; 
	$useragent = "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.1) Gecko/20065204 Firefox/2.33";
$arik=1;
$ari=1;
while($arik!=0 && $arik < 3) {
	$ch = @curl_init();
	@curl_setopt($ch, CURLOPT_URL, $target);
	@curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	@curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	@curl_setopt($ch, CURLOPT_POST, 1);
	@curl_setopt($ch, CURLOPT_USERAGENT, $useragent);
	$res1 = curl_exec($ch);

	$con1=explode('id="__VIEWSTATE" value="',$res1);
	$con2=explode('" />',$con1[1]);
	$con3=explode('id="__EVENTVALIDATION" value="',$res1);
	$con4=explode('" />',$con3[1]);
	$kk1=urlencode($con2[0]);
	$kk2=urlencode($con4[0]);

	$postfields =   "__VIEWSTATE=".$kk1."&__EVENTVALIDATION=".$kk2."&ItemsList%24ctl00%24SMSButton=Go&ItemsList%24ctl00%24Password=".$pass."&ItemsList%24ctl00%24TextBox1=";
	curl_close($ch);

	$ch2 = @curl_init();
	@curl_setopt($ch2, CURLOPT_URL, $target);
	@curl_setopt($ch2, CURLOPT_RETURNTRANSFER, 1);
	@curl_setopt($ch2, CURLOPT_FOLLOWLOCATION, 1);
	@curl_setopt($ch2, CURLOPT_POST, 1);
	@curl_setopt($ch2, CURLOPT_USERAGENT, $useragent);
	@curl_setopt($ch2, CURLOPT_POSTFIELDS, $postfields);
	$resk = curl_exec($ch2);

if($resk== "") { $ari=1; } else { $ari=0; }

if($ari==0) { 
	if(stristr($resk, '<span id="ItemsList_ctl00_BadPassText" class="badpassword">') === FALSE) {


	$new1=explode('class="handlink" href="',$resk);
	$new2=explode('" target="_blank">',$new1[1]);


	$link=$new2[0];
		if($link!="") {
		
			$add = mysql_query("UPDATE `link` SET `stat`='1' ,`openlink` ='{$link}' WHERE `id` ={$row['id']} ;"); 
			if($add) { $count1++;$arik=0; } 
		} 
	} else { 
		if(stristr($resk, 'Expired') === TRUE) {
		echo "בעיה בלינק, הוא פג תוקף!";$ari=0;
		}
	}    
	
}


echo '<br />';
 curl_close($ch2);
}
}

echo "<br>נפתחו סך הכל {$count1} לינקים";
?>

</body>
</html> 