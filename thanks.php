<?
if($_GET['ok'] == "1") {
?>
<html dir=rtl>
<script> alert('���� �� �� ������, ���� �� ������� �� � VIP ��� 24 ����!');</script>
���� �� �� ������, ���� �� ������� �� � VIP ��� 24 ����!
<script>
setTimeout("window.location='http://www.freeff.co.il'",5000);</script>
<?
die();
}

if($_GET['ok']=="0") {
?>
<script>window.location='https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=TFAWSLX4MFTD2';</script>
<?
die();
}

?>