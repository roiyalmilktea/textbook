<?php
// セッションの開始
session_start();
?>
<html>
<head>
<title>session_start6.php</title>
<!-- セッションの開始:セッション変数の登録 -->
</head>
<body>
<?php
    print "session_id = " . session_id() . "<br>"; // セッションIDの出力
    print '<br>$_POST[] の内容の確認；<br>';
    print_r($_POST);
    print "<br>";
    print '<br>$_COOKIE[] の内容の確認；<br>';
    print_r($_COOKIE);
    print "<br>";
    if (isset($_POST["name"])) {
        $name = $_POST["name"];
        $_SESSION["s_name"]=$name; // セッション変数の登録
        print "ようこそ！" . $_SESSION["s_name"] . "さん。<br>";
        print '$_SESSION[]の内容の確認；<br>';
        print_r($_SESSION); // セッション変数の出力
        print "<br>"; 
?>
<!-- hiddenコントロールによるセッションIDの引渡し -->
<form action="session_start6a.php" method="post">
<input type="hidden" name="<?=session_name()?>"
value="<?=session_id()?>">
<input type="submit" value="次ページ">
</form>
<?php
    } else {
?>
<form method="post">
氏名を記入してください。<br>
氏名：<input size="30" type="text" name="name"><br>
<input type="submit" value="登録">
</form>
<?php
    }
?>
</body>
</html>