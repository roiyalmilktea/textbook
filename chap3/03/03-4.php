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
    $x = array ("ABC", "あいうえお",12345);
    print_r($x);
    ?>
</p>
</body>
</html>