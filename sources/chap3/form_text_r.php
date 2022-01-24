<html>
<head>
<title>form_text_r.php</title>
<!-- form:テキスト -->
</head>
<body>
<?php
 if ( !isset($_POST['data']) ) 
 {
   print "データが入力されていません<br>";
 } 
 else
 {
   print "以下のデータが入力されました<br>";
 }
?>
<form action="" method="post">
  入力：<input name="data" size=20 value="<?php if(isset($_POST['data']))echo $_POST['data']; ?>">
                       <!-- 初期値の設定 -->
  <input type="submit" value=" OK ">
</form>
</body>
</html>