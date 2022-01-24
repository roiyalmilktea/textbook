html>
<head>
<title>form_check2.php</title>
<!-- form:チェックボックスデータの受信 -->
</head>
<body>
<?php
 $arr_data = $_POST["arr_data"];      /* POSTメソッドでの
                       フォームデータの受信．
                       配列型のデータとなる． */
 print "入力データは以下です．<br>";
 foreach ( $arr_data as $key => $val ) {
   print "[$key]=$val<br>"; 
 }
?>
</body>
</html>