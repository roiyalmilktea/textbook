<?php
// 3人分の正しいユーザー IDの配列
$ar_id = array("taro","hanako","satoshi");
// 3人分の正しいパスワードの配列
$ar_pass = array("foofoo","barbar","hogehoge");
// 受け取ったID
$c_id = $_GET["login_id"];
//受け取ったパスワード
$c_pass = $_GET["login_pass"];
// フラグ
$flg = 0;
// インデックス取得用変数
$i = 0;
// 配列の全要素とユーザー IDを比較
foreach($ar_id as $x) {
//idが配列のいずれかと合致
    if($c_id == $x) {
        $flg++;
        break;
    }
    $i++;
}
// ユーザー IDが合致したインデックスの配列内の値とパスワードを比較
if($c_pass == $ar_pass[$i]) {
    $flg++;
}
// ユーザー IDもパスワードも合致していれば$flgは2
if($flg == 2) {
    echo "ログイン成功！";
}
// どちらか一方しか合致していないと1
// どちらも合致していないと0
if($flg < 2) { //$flgが2より小さければ
    echo "IDまたはパスワードが違います";
}
?>