<html dir="rtl">
<head>
<title>Free FileFlyer Redirect</title>
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<script type="text/javascript" src="../js.js"></script>
	<style>
	BODY{
		background-color: #1c1c1c;
		color: #ffffff;
		margin: auto;
		text-align: center;
		font-family: Tahoma;
	}
</style>
<script type="text/javascript" language="JavaScript">
		 function sub () {
		     document.forms[0].submit();
		 }
function anti2()
{
	win3 = window.open("vip.html", "AnTi", "top=" + ((screen.height) ? (screen.height-500)/2 : 0) + ",left="+((screen.width) ? (screen.width-567)/2 : 0)+"toolbar=0,location=0,directories=0,status=0,menubar=0,scrollbars=1,resizeable=1,width=567,height=500");
}
</script>
</head>

<?php
$selected_Item=$_REQUEST['selectedItem'];
if(isset($selected_Item))
	{
?>
<body onload="sub()">
<center>
<font color="red"  size="7" face="David"><u>המתן אתה מועבר...</font></u>
<div style="display:none">
<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
	<input type="hidden" name="cmd" value="_s-xclick">
	<input type="hidden" name="hosted_button_id" value="28K2UPA68SB74">
	<table>
	<tr><td><input type="hidden" name="on0" value="רכישת VIP">רכישת VIP</td></tr><tr><td><select name="os0">
	<?php if($selected_Item==0){
		echo "<option value='VIP ל7 ימים' selected>VIP ל 7 ימים ₪7.00 ILS</option>\n";
	 }
	else { 
		echo "<option value='VIP ל7 ימים'>VIP ל 7 ימים ₪7.00 ILS</option>\n";
	}
   if($selected_Item==1){
		echo "<option value='VIP ל14 ימים' selected>VIP ל 14 ימים ₪12.00 ILS</option>\n";
	}
	else {
		echo "<option value='VIP ל14 ימים'>VIP ל 14 ימים ₪12.00 ILS</option>\n";
	}
    if($selected_Item==2){
		echo "<option value='VIP ל30 ימים' selected>VIP ל 30 ימים ₪20.00 ILS</option>\n";
	}
    else {
		echo "<option value='VIP ל30 ימים'>VIP ל 30 ימים ₪20.00 ILS</option>\n";
	}
    if($selected_Item==3){
		echo "<option value='VIP ל90 ימים' selected>VIP ל 90 ימים ₪50.00 ILS</option>\n";
	}
    else {
		echo "<option value='VIP ל90 ימים'>VIP ל 90 ימים ₪50.00 ILS</option>\n";
	}?>
	</select> </td></tr>
	</table>
	<input type="hidden" name="currency_code" value="ILS">
	<input type="image" src="btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal - הדרך הקלה והבטוחה לשלם באופן מקוון!">
	<img alt="" border="0" src="https://www.paypalobjects.com/he_IL/i/scr/pixel.gif" width="1" height="1">
</form>
</div>
</center>
</body>
<?
	}
	else{
?>
	<body>
	<center>
	<font color="red"  size="7" face="David"><u>אין לך גישה לדף זה</font></u>
	</center>
	</body>
<?
	}
?>
</html>