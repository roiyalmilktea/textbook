<?php
 // インクルードファイルの読み込み
 include "common.php";
?>
<html>
<head>
<title>form_script.php</title>
<!-- form:スクリプト -->
</head>
<body>
<?php
if(isset($_POST['title'])){
 // 入力データの変換
 $title = tag_entity_input($_POST['title']);
}
else{
 $title = "";
}
if(isset($_POST['script'])){
 // 入力データの変換    
 $script = tag_entity_input($_POST['script']);
 // テキストエリア用出力データの変換
 $script2 = tag_entity_form($script);
}
else{
 $script = "";
 $script2 = "";
}
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