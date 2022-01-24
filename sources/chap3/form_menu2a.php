<html>
<head>
<title>form_menu2a.php</title>
<!-- form:複数選択メニューの受信 -->
</head>
<body>
<?php
  $arr_data = $_POST["data"];   /* POSTメソッドでの
                    フォームデータの受信．
                    配列型のデータとなる． */
  print "入力データは以下です．<br>";
  foreach ( $arr_data as $key => $val ) 
  {
    print "[$key]=$val<br>"; 
  }
?>
</body>
</html>