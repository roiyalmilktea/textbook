<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>GETで届いたデータ</title>
    <link rel="stylesheet" href="css/foo.css">
</head>
<body>
<h1>GETで取得したデータ</h1>
<p>
    <?php
    echo "login_idは";
    echo $_GET["login_id"];
    echo "<br>";
    echo "login_passは";
    echo $_GET["login_pass"];
    ?>
</p>
</body>
</html>