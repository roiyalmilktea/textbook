<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>GETで届いたデータ</title>
    <link rel="stylesheet" href="css/foo.css">
</head>
<body>
<h1>ログイン確認</h1>
<p>
    <?php
    // 正しいユーザー ID
    $s_id = "taro@test.test";
    // 正しいパスワード
    $s_pass = "abc12345";
    // 受け取ったID
    $c_id = $_GET["login_id"];
    // 受け取ったパスワード
    $c_pass = $_GET["login_pass"];
    // フラグ
    $flg = 0;
    // idが合致
    if($c_id==$s_id){
        $flg++; // インクリメント
    }
    //パスワードが合致
    if($c_pass==$s_pass){
        $flg += 1; //インクリメントの別の書き方
    }
    // パスもIDも合致していれば$flgは2
    if($flg==2){
        echo "ログイン成功！";
    }
    //どちらか一方しか合致していないと1
    //どちらも合致していないと0
    if($flg < 2) { // $flgが2より小さければ
        echo "IDまたはパスワードが違います";
    }
    ?>
</p>
</body>
</html>