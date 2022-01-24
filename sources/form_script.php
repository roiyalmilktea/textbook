<?php
// インクルードファイルの読み込み
include "common347.php";
?>
<html>
<head>
<title>form_script.php</title>
<!-- form:スクリプト -->
</head>
<body>
<?php
// データの受信
$title = $_POST['title'];
$script = $_POST['script'];

// 入力データの変換
$title = tag_entity_input($title);
$script = tag_entity_input($script);

// テキストエリア用出力データの変換
$script2 = tag_entity_form($script);
?>
フォームでの入出力
<form action="form_script.php" method="post">
タイトル：<br>
<input name="title" size="60"value="<?=$title?>"><br>
スクリプト：<br>
<textarea name="script" rows="5" cols="60"><?=$script2?></textarea>
<br>
<input type="submit" value=" OK ">
</form>
print文での表示<br>
<?php
print '$title=[' . $title . "]<br>\n";
print '$script=' . "<br>\n";
print $script;
?>
</body>
</html>