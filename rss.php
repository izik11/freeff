<?php
$Config['limit'] = "10";
$Config['charset'] = "windows-1255";
$Config['time'] = gmdate('r');


include("banlist.php");
if($ip=="192.118.11.118") { die("��� �� ���� ������ � RSS"); }

if($_SERVER["HTTP_REFERER"] == "mu8.110mb.com" || $_SERVER["HTTP_REFERER"] == "down4me.info" || $_SERVER["HTTP_REFERER"] == "passflyer.cz.cc") { die ('gay'); }
$ip = $_SERVER['REMOTE_ADDR'];
if($ip=="216.108.239.51") { die("gay"); }
if($ip=="141.8.241.73") { die("gay"); }



$agent = $_SERVER['HTTP_USER_AGENT'];
if($agent==""){ die("������ ��� ����"); }


header("Content-Type: text/xml; charset=".$Config['charset']);
header("Cache-Control: no-cache");



$rss = <<<EOF
<?xml version='1.0' encoding='{$Config['charset']}' ?>

		<rss version='2.0'>

			<channel>

				<title>Free FileFlyer Passwords RSS</title>

				<link>http://www.freeff.co.il</link>

				<generator>Free FileFlyer Passwords RSS</generator>
				<language>he</language>
				<lastBuildDate>{$Config['time']}</lastBuildDate>

				<description>New Passwords</description>
EOF;



$item = "";
$query = mysql_query("SELECT * FROM `RSS` WHERE `vip` = 0 ORDER BY `RSS`.`id` DESC LIMIT 0 , 10");
while($row = mysql_fetch_array($query)) {
$time = $row['time'];
$time = str_replace( '����', ',', $time );
$date = $row['date'] + $badate;

if($row['site'] == "rapidshare" || $row['site'] == "sex")
{
if($row['site'] == "sex") { $string = "������� ���� ��� ���"; 
} elseif ($row['site'] == "rapidshare") { 
$string = "��� ��� ����� ������ ��������";
 }
$item .= "
				<item>

		          			<pubDate>".gmdate('r', $date)."</pubDate>

		            			<title>{$string}</title>

					<description><![CDATA[ ����� �''� {$row['by']},<br />������ {$row['time']} .<br />����� ���� <site>{$row['site']}</site> ]]></description>
		            					<link>http://www.freeff.co.il/download.php?id={$row['id']}</link>

		         		</item>
";
} else {


if($row['Top']=="1")
{

$item .= "
				<item>

		          			<pubDate>".gmdate('r', $date)."</pubDate>

		            			<title>��� ��� ����� ������</title>

					<description><![CDATA[ ����� �''� {$row['by']},<br />������ {$row['time']} .<br />������ ���� <site>{$row['site']}</site> ]]></description>
		            					<link>http://www.freeff.co.il/download.php?id={$row['id']}</link>

		         		</item>
";


}else{


$item .= "
				<item>

		          			<pubDate>".gmdate('r', $date)."</pubDate>

		            			<title>{$row['password']}</title>

					<description><![CDATA[ ����� �''� {$row['by']},<br />������ {$row['time']} .<br />������ ���� <site>{$row['site']}</site> ]]></description>
		            					<link>http://www.freeff.co.il/index.php#pass{$row['id']}</link>

		         		</item>
";
}
}
}

$footer = <<<EOF
			</channel>
		</rss>
EOF;

echo <<<EOF
{$rss}
{$item}
{$footer}
EOF;
?>