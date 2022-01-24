<?php
session_start();
?>
<html><head>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
</head><body>
<?php
error_reporting(E_ALL);
echo "あなたの名前は ".$_SESSION[name]." ですね？";

?>
</body></html>