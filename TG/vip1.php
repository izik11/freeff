<?php
include("db.php");
include("functions.php");
include("../banlist.php");
?>
<html dir="rtl">
<head>
<title>Free FileFlyer</title>
<meta http-equiv="content-type" content="text/html;charset=windows-1255" />
<script type="text/javascript" src="../js.js"></script>

	<style>
	BODY{
		background-color: #1c1c1c;
		color: #ffffff;
		margin: auto;
		text-align: center;
		font-family: Tahoma;
	}
	.content{
		width: 800px;
		margin: auto;
		text-align: center;
		}
	.header{
		height: 100px;
		padding: 15px 0 10px 0;
		font-size: 11px;
		font-weight: Bold;
	}
	.right{
		float: right;
		display: inline;
		text-align: right;
	}
	.center{
		float: center;
		display: inline;
		text-align: center;
	}
	.left{
		float: left;
		display: inline;
		text-align: left;
	}
	.language{
		width: 500px;
		height: 30px;
		}
	.menu{
		height: 30px;
		font-size: 11px;
		font-weight: Bold;
		text-align: left;
	}
	.texts{
		font-size: 11px;
	}
	.inline{
		display: inline;
	}
	.passwordsblock{
		background-image: url('../images/passblock.jpg');
		width: 258px;
		height: 91px;
		color: #1c1c1c;
	}
	.t_block{
		text-align: center;
		padding: 7px 0 22px 0;
		font-size: 14px;
		font-weight: bold;
	}
	.c_block{
		padding: 0 0 0 30px;
		font-size: 12px;
	}
	.chatplace{
		background-color: #2c2c2c;
		display: inline;
		text-align: left;
	}
	.chatroom{
		height: 600px;
		width: 400px;
		overflow: auto;
		color: #ffffff;
		text-align: left;
		padding: 2px 0 0 0;
		background-color: #2c2c2c;
	}
	.chat_showname{
		background-color: #b1d66b;
		color: #1c1c1c;
		font-size: 10px;
		width: 200px;
		height: 21px;
		text-align: left;
		padding: 4px 0 0 10px;
	}
	.chat_showcomment{
		color: #ffffff;
		padding: 5px 0 0 10px;
		font-size: 10px;
	}
	.chat_addcoment{
		padding: 5px 0 5px 10px;
		background-color: #2c2c2c;
		text-align: left;
		font-size: 11px;
	}
	INPUT{
		font-size: 13px;
		font-family: Tahoma;
		background-color: #1c1c1c;
		color: #ffffff;
		border: 0px;
		width: 131px;
		height: 20px;
	}
	TEXTAREA{
		font-size: 13px;
		font-family: Tahoma;
		background-color: #1c1c1c;
		color: #ffffff;
		border: 0px;
		width: 165px;
		height: 60px;
	}

#topbar{
position:absolute;
border: 1px solid black;
padding: 2px;
background-color: white;
width: 500px;
visibility: hidden;
z-index: 200;
}

.button
{
border: 1px solid #E1E1E1;
background-color: #F1F1F1;
width: 120px;
}
	</style>
<script type="text/javascript" language="JavaScript">
function anti2()
{
	win3 = window.open("vip.html", "AnTi", "top=" + ((screen.height) ? (screen.height-500)/2 : 0) + ",left="+((screen.width) ? (screen.width-567)/2 : 0)+"toolbar=0,location=0,directories=0,status=0,menubar=0,scrollbars=1,resizeable=1,width=567,height=500");
}
</script>
</head>
<body><b>
<center>
<font color="red"  size="7" face="David"><u>
Free FileFlyer ViP</font></u>
<BR><br>
<?php

if(getUserVip($_COOKIE['TG-Vip'], 1) == 0)
{
echo <<<EOF
אינך משתמש VIP
EOF;
} else {
$query = mysql_query("SELECT count(*) as total FROM `RSS`");
$row = mysql_fetch_array($query, MYSQL_ASSOC);
$total = $row['total'];

echo <<<EOF
\n			<table>
				<tr>\n
EOF;

$password = mysql_query("SELECT * FROM `RSS` WHERE `Top` = '1' AND `vip` = '1' ORDER BY `RSS`.`id` DESC LIMIT 0 , 10");  
$set=0;
while($row = @mysql_fetch_array($password)) {
$set = $set + 1;
$date = $row['time'];
$by = $row['by'];
$site = $row['site'];
$normal = str_replace( ' ', '', $row['password'] );
echo <<<EOF
\n					<td style="padding: 0 20px 15px 0;">
						<div class="passwordsblock">
							<div class="t_block">

								{$normal}
							</div>
							<div class="c_block">
								<b>&nbsp;&nbsp; ע"י:</b> {$by} <b>לאתר</b>: {$site}<br />
								<b>&nbsp;&nbsp; תאריך:</b> {$date}
							</div>
						</div>
					</td>
\n				</tr>
				<tr>\n
EOF;
}
echo <<<EOF
				</tr>
			</table>
		</div>
EOF;
}
if(($cuser != "") && ($cvip == 1)) {
$query = mysql_query("SELECT count(*) as total FROM `RSS`");
$row = mysql_fetch_array($query, MYSQL_ASSOC);
$total = $row['total'];

echo <<<EOF
\n			<table>
				<tr>\n
EOF;

$password = mysql_query("SELECT * FROM `RSS` WHERE `Top` = '1' AND `vip` = '1' ORDER BY `RSS`.`id` DESC LIMIT 0 , 10");  
$set=0;
while($row = @mysql_fetch_array($password)) {
$set = $set + 1;
$date = $row['time'];
$by = $row['by'];
$site = $row['site'];
$normal = str_replace( ' ', '', $row['password'] );
echo <<<EOF
\n					<td style="padding: 0 20px 15px 0;">
						<div class="passwordsblock">
							<div class="t_block">

								{$normal}
							</div>
							<div class="c_block">
								<b>&nbsp;&nbsp; ע"י:</b> {$by} <b>לאתר</b>: {$site}<br />
								<b>&nbsp;&nbsp; תאריך:</b> {$date}
							</div>
						</div>
					</td>
\n				</tr>
				<tr>\n
EOF;
}
echo <<<EOF
				</tr>
			</table>
		</div>
EOF;
}
?>

<BR><BR>
<a href="index.php"><font color="white"  size="5" face="David">חזור לאתר</a>

<BR><BR>

רוצה לדעת מה מקבלים חברי הVIP. תוכל לקרוא הכל
<a href="vip.html" target="_blank"><font color="white"  size="5" face="David">כאן</font></a>
<BR><BR><BR>

שאלות / תלונות / הערות  / הצעות יש לפנות אלינו <a href="../connect.html" target="blank"><font color="white" size="5" face="David">דרך טופס זה</font></a>


<br><Br>
<input style="font-family: David; font-size: 10pt;" type="button" onclick="window.close()" value="סגור חלון" />


</center>
</body>
</html>



