<html>
<head>
<title>form_menu2.php</title>
<!-- form:複数選択型選択メニュー -->
</head>
<body>
<form action="form_menu2a.php" method="post">
  選択してください（複数可能）：<br>
  <select name="data[]" multiple size="3"> <!-- multipleを記述 -->
    <option value="1">PHP</option>
    <option value="2">Perl</option>
    <option value="3">C++</option>
  </select>
  <input type="submit" value=" OK ">
</form>
</body>
</html>