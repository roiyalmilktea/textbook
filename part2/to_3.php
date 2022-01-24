<html><head>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
</head><body>
<?php
//$_GET[キー名]の値を、$キー名という変数に代入しつつ
//strip_tags関数でHTMLタグを除去する
foreach($_GET AS $key => $value) {
    ${$key} = strip_tags($value);
}

//name=txt_bの欄から受け取ったデータ（タグ除去後）
echo "名前は".$txt_a."です<br />";
//name=txt_bの欄から受け取ったデータ（タグ除去後）
echo "住所は".$txt_b."です<br />";
//ラジオボタンから受け取ったデータ（タグ除去後）
echo "性別は".$rd_a."です<br />";

?>
<p>内容が正しければ送信ボタンを押してください</p>
<!--ここから見えないフォーム-->
<form action="reg.php" method="GET">
<!--valueにはタグ除去後のデータをセットする-->
<input type="hidden" name="txt_a" value="<?php echo $txt_a;?>">
<input type="hidden" name="txt_b" value="<?php echo $txt_b;?>">
<input type="hidden" name="rd_a" value="<?php echo $rd_a;?>">
<input type="submit">
</form>
</body></html>
