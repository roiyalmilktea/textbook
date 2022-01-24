<?php
// 連想配列を使い「ID=>パスワード」という組み合わせで記録
$ar_idpass = array(
    "taro"=>"foofoo",
    "hanako"=>"barbar",
    "satoshi"=>"hogehoge"
);
$c_id = $_GET["login_id"];
// 受け取ったパスワード
$c_pass = $_GET["login_pass"];
// フラグ
$flg = 0;
// 配列の要素すべてとIDを比較する
foreach($ar_idpass as $x=>$y){
//idが配列のいずれかと合致
    if($c_id == $x) {
        $flg++;
// パスワードを比較
        if($c_pass == $y) {
            $flg++;
        }
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