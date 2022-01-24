<?php
// 受け取ったユーザー ID
$c_id = $_GET["login_id"];
//受け取ったパスワード
$c_pass = $_GET["login_pass"];
// データファイル名
$fname = "data.csv";
// ファイルを開く
$fp = fopen($fname,"r");
// ファイルを読み込む
$data = fread($fp,filesize($fname));
// ファイルを閉じる
fclose($fp);
// ファイルの内容を表示する
// ブラウザの表示では改行は無視されます
echo $data."<hr>";
// データを改行で切り分けて、1データごとに分解して配列に格納
$l_data = explode("\r\n",$data);
// 配列の中身を見る
print_r($l_data);
echo "<hr>";
// 空の連想配列を作成
$ar_idpass = array();
// 配列のデータをカンマで分解して、ユーザー IDとパスワードを取得
foreach($l_data as $x) {
    if($x) { // 空改行だけのデータがありえるので中身のあるものだけ
        $csv_id = explode(",",$x); // カンマで分割
// カンマの前をキー、後ろを値として空の連想配列に追加
        $ar_idpass[$csv_id[0]] = $csv_id[1];
    }
}
// 中身を見てみる
print_r($ar_idpass);
echo "<hr>";
// フラグ
$flg = 0;
// 配列の要素とユーザー IDを比較
foreach($ar_idpass as $x => $y) {
// idが配列のいずれかと合致
    if($c_id == $x && $c_pass == $y) {
        $flg = $flg + 2;
        break;
    }
}
// パスもIDも合致していれば$flgは2
if($flg == 2) {
    echo "ログイン成功！";
}
// どちらか一方しか合致していないと1
// どちらも合致していないと0
if($flg < 2) { // $flgが2より小さければ
    echo "IDまたはパスワードが違います";
}
?>