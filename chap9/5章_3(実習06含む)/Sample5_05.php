<html>
<head><title>Sample5_05</title></head>
<body>
  <form method="post" action="./Sample5_03.php">
    <p>入力値をSample5_03.phpへPOST送信します</p>
    <p>名前を入力してください（テキストボックス）
    <input type="text" name="param" value="jikkyo"></p>
    <p>性別を入力してください（ラジオボタン）
    <input type="radio" name="gender" value="man">男
    <input type="radio" name="gender" value="woman">女</p>
    <p>年齢層を指定してください（セレクトボックス）
    <select name="age">
      <option value="10">～19</option>
      <option value="20">20～29</option>
      <option value="30">30～39</option>
    </select></p>
    <p>誕生日を入力してください（日付入力：対応ブラウザーのみ）
    <input type="date" name="birth">
    </p>
    <input type="submit">
    <input type="reset">
  </form>
</body>
</html>