<?php
@session_start();
 
echo <<<EOF
<form action="sl-sendlogin.php" method="post">
<table border=0 cellspacing=5 cellpadding=0 bgcolor="#4682B4">
<tr>
<td width=100>
<b>�� �����:</b>
</td>
<td width=300>
<input type="text" name="user">
</td>
</tr>
<tr>
<td width=100>
<b>�����:</b>
</td>
<td width=300>
<input type="password" name="password">
</td>
</tr>
<tr>
<td width=100>
<b>��� �����:</b>
</td>
<td width=300>
<span dir="rtl">
<img src="SecCode.php" width="71" height="21" align="absmiddle"> <b>�</b><br /><input type="text" name="secCode">
</span>
</td>
</tr>
<tr>
<td colspan=2>
<table width=100% border=0 cellspacing=0 cellpadding=3>
<tr>
<td width=100% align="center">
<input type="hidden" name="GoLogin" value="1">  
<input type="submit" value="�����!"> 
</td>
</tr>
</table>
</td>
</tr>
</table>
</form>
</body>  
</html>  
EOF;
?>