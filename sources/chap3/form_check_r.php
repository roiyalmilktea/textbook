<head>
<title>form_check_r.php</title>
<!-- form:チェックボックスの再表示 -->
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
 使用中のOSを選択してください（複数可能）．<br>
 <?php ( isset($_POST["data"][0])&&$_POST["data"][0] == "1" ) ? $val = "checked" : $val = "" ; ?>
                 <!-- ３項演算子による初期値の設定 -->
 <input type="checkbox" name="data[0]" value="1" <?= $val?>>１，Windows
 <?php ( isset($_POST["data"][1])&&$_POST["data"][1] == "2" ) ? $val = "checked" : $val = "" ; ?>
 <input type="checkbox" name="data[1]" value="2" <?= $val?>>２，UNIX
 <?php ( isset($_POST["data"][2])&&$_POST["data"][2] == "3" ) ? $val = "checked" : $val = "" ; ?>
 <input type="checkbox" name="data[2]" value="3" <?= $val?>>３，LINUX
 <br>
 <input type="submit" value=" OK ">
</form>
</body>
</html>