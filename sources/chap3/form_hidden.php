<html>
<head>
<title>form_hidden.php</title>
<!-- form:隠しコントロール -->
</head>
<body>
 <form action="form_hidden2.php" method="post">
   入力：<br>
   <input type="text" name="data" size="20">
   <?php $str_date = date("Y-m-d"); ?>   <!-- date関数の呼び出し -->
   <input type="hidden" name="access_date" value="<?=$str_date?>">
                       <!-- 隠しコントロール -->
   <input type="submit" value=" OK "> 
 </form>
</body>
</html>