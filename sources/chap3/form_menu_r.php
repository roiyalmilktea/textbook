<html>
<head>
<title>form_menu_r.php</title>
<!-- form:選択メニューの再表示 -->
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
 選択してください：<br>
 <select name="data">
  <?php ( isset($_POST["data"])&&$_POST["data"] == "1" ) ? $val = "selected" : $val = "" ; ?>
                   <!-- ３項演算子による初期値の設定 -->
  <option value="1" <?= $val?>>PHP</option>
  <?php ( isset($_POST["data"])&&$_POST["data"] == "2" ) ? $val = "selected" : $val = "" ; ?>
  <option value="2" <?= $val?>>Perl</option>
  <?php ( isset($_POST["data"])&&$_POST["data"] == "3" ) ? $val = "selected" : $val = "" ; ?>
  <option value="3" <?= $val?>>C++</option>
 </select>
 <input type="submit" value=" OK ">
</form>
</body>
</html>