<html>
<head>
<title>form_radio_r.php</title>
<!-- form:ラジオボタン -->
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
  <?php ( isset($_POST['data'])&&$_POST["data"] == "男" ) ? $val = "checked" : $val = "" ; ?>
              <!-- ３項演算子による初期値の設定 -->
  <input type="radio" name="data" value="男" <?= $val?>>１，男
  <br>
  <?php ( isset($_POST['data'])&&$_POST["data"] == "女" ) ? $val = "checked" : $val = "" ; ?>
  <input type="radio" name="data" value="女" <?= $val?>>２，女
  <br>
  <input type="submit" value=" OK ">
</form>
</body>
</html>