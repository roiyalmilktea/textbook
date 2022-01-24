<html>
<head>
<title>form_textarea_r.php</title>
<!-- form:テキストエリアの再表示 -->
</head>
<body>
<?php
 if ( $_POST['data'] =="" )
 {
   print "データが入力されていません<br>";
 } 
 else
 {
   print "以下のデータが入力されました<br>";
 }
?>
<form action="form_textarea2.php" method="post">
 入力：<br>
 <textarea name="data" rows="5" cols="40"><?= $_POST['data'] ?></textarea>
                     <!-- 初期値の表示 -->
 <br>
 <input type="submit" value=" OK ">
</form>
</body>
</html>