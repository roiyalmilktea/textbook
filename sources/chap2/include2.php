<head>
<title>include2.php</title>
</head>
<body>
<?php
	//include文
	include 'user.php';//'user.inc'ファイルをこの位置に読み込みます
	if(_DEBUG){
		/*定数_DEBUGの値は、user.incの中で定義されている
		デバグを行う場合は、_DEBUG=1としておく。
		たとえば、必要な環境変数の値をモニタする。*/
		foreach($HTTP_SERVER_VARS as $key=>$value){
			print"$key=$value<br>";
	}
}
?>
</body>
</html>
