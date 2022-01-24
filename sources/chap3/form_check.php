<html>
<head>
<title>form_check.php</title>
<!-- form:チェックボックス -->
</head>
<body>
<form action="form_check2.php" method="post">
使用中のOSを選択してください（複数可能）．<br>
<input type="checkbox" name="arr_data[0]" value="1">１，Windows
<input type="checkbox" name="arr_data[1]" value="2">２，UNIX
<input type="checkbox" name="arr_data[2]" value="3">３，LINUX
  <br>
<input type="submit" value=" OK ">
</form>
</body>
</html>