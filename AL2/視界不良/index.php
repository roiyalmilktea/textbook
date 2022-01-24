<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>index.php</title>
    </head>
    <body>
        <h3>お題一覧</h3><br>
        
        <?php
        $user = "root";
        $pass = "root";
        $dbh = new PDO('mysql:host=localhost;dbname=redkun_hello;chaeset=utf8', $user, $pass);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pid = $_GET['id'];
        $sql = "select * from questiondata";
        $stmt = $dbh->query($sql);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result as $item) {
            echo "<a href=show.php?id=" . $item['id'] . ">".$item['value']."</a><br>\n";
        }
        ?>
        <br>
        <br>
        <a href="inputq.php">お題作成</a>
        
    </body>
</html>