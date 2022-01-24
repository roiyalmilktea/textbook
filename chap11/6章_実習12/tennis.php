<!DOCTYPE html>
<html>
	<head>
		 <link rel="stylesheet" href="./css/style.css" type="text/css">
		 <title>tennis</title>
		
	</head>
	<body>
		<h1>こちらはテニスコートの予約サイトです。</h1>
		<h1>オムニコートとクレーコート両方あります。<br></h1>
		<h3>要望があれば当日窓口で相談して下さい。<br></h3>

		<section>
    <h2>ご予約（詳細情報の入力）</h2>
    <p>詳細情報を入力後、予約確認ボタンを押してください。<br />
    （※がついている項目は入力必須項目です）</p>
         
    <h3>代表者情報</h3>
    <form method="post" action="./reserved_tennis.php" >
      <select name="ok">
      <table class="input">
        <tr>
          <th>代表者氏名（※）</th>
          <td><input type="text" name="dname" value="" /></td></tr>
        <tr>
          <th>連絡先電話番号（※）</th>
          <td><input type="text" name="dtelno" value="" /></td></tr>
        <tr>
          <th>メールアドレス</th>
          <td><input type="text" name="dmail" value="" /></td></tr>
      </table><br />
      </select>
		<input type="submit" value="送信">
	</body>
</html>