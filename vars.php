<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<style type="text/css">
<!--
body {
	font-family:Verdana, Arial, Helvetica, sans-serif;
	font-size:11px;
	background:#FFF;
	color:#000;
}
span {
	color:#666;
}
-->
</style>
</head>

<body>
<p>This is a simple test to check if the variables are actually posted</p>
<p>&nbsp;</p>
<?php
echo("<p><span>email:</span> ".$_POST['email']."</p>");
echo("<p><span>password:</span> ".$_POST['password']."</p>");
echo("<p><span>gender:</span> ".$_POST['gender']."</p>");
echo("<p><span>dobMonth:</span> ".$_POST['dobMonth']."</p>");
echo("<p><span>dobDay:</span> ".$_POST['dobDay']."</p>");
echo("<p><span>dobYear:</span> ".$_POST['dobYear']."</p>");
echo("<p><span>color:</span> ".$_POST['color']."</p>");
if(isset($_POST['interests'])) {foreach ($_POST['interests'] as $key => $val) {echo("<p><span>interest".$key.":</span> ".$val."</p>");}}
if(isset($_POST['languages'])) {foreach ($_POST['languages'] as $key => $val) {echo("<p><span>language".$key.":</span> ".$val."</p>");}}
echo("<p><span>comments:</span> ".$_POST['comments']."</p>");
?>
</body>
</html>
