<html><head>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
</head><body>
<?php
//--------デバッグ用表示-------------------
echo "<h1>GETで受け取ったデータ配列の一覧</h1>";
//フォームからGETで来たデータの配列一覧
print_r($_GET);

echo "<h1>POSTで受け取ったデータ配列の一覧</h1>";
//フォームからPOSTで来たデータの配列一覧
print_r($_POST);
echo "<hr />";
//--------デバッグ用表示ここまで-----------

//POSTの場合は$_GETの部分を$_POSTに書き換える
//name=txt_aの欄から受け取ったデータ
echo "名前は".$_GET[txt_a]."です<br />";
//name=txt_bの欄から受け取ったデータ
echo "住所は".$_GET[txt_b]."です<br />";
//ラジオボタンから受け取ったデータ
echo "性別は".$_GET[rd_a]."です<br />";
?>
<p>内容が正しければ送信ボタンを押してください</p>
<!--ここから見えないフォーム-->
<form action="reg.php" method="GET">
<input type="hidden" name="txt_a" value="<?php echo $_GET[txt_a];?>">
<input type="hidden" name="txt_b" value="<?php echo $_GET[txt_b];?>">
<input type="hidden" name="rd_a" value="<?php echo $_GET[rd_a];?>">
<input type="submit">
</form>
</body></html>
