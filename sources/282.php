<?php
// ユーザ定義関数の定義
function tags_convert($str) {
/* $str中の以下のHTMLタグ等に使う文字をおのおのHTML特殊文字に変換します．
「&」->「&amp;」
「<」->「&lt;」
「>」->「&gt;」
「"」->「&quot;」
*/
$str = str_replace("&","&amp;",$str);
$str = str_replace(">","&gt;",$str);
$str = str_replace("<","&lt;",$str);
$str = str_replace('"',"&quot;",$str);
return $str;//　戻り値の設定
}
?>
<html>
<head>
<title>tags_convert.php</title>
</head>
<body>
<?php
// ユーザ定義関数の使用例
$str_in = "<html><body>A&B</body></html>";
$str_out = tags_convert($str_in); // ユーザ定義関数の呼び出し
print $str_out; // 戻り値の表示
?>
</body>
</html> 