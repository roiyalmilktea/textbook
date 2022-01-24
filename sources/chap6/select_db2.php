<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<html>
<head>
<title>データの閲覧</title>
</head>
<body>
<?php
    //データベースからデータを抽出する
    require 'db_connect.php';
    //studentテーブルからデータをすべて抽出する
    $sql = "SELECT * FROM student";
    //SQL文を発行する
    $rst = $mysqli->query($sql);
    //出力結果をテーブルで表示する
    print "<h1>トップページ</h1>";
    printf("<table border='1'>");
    printf("<tr><td>id</td><td>名前</td><td>学部</td><td>テストデータ</td><td>オプション</td><tr>");
    //mysql_fetch_array関数を用いて発行したSQL文の結果レコードを一行ずつ取得する
    //whileは結果レコードをすべて取得するまで繰り返す        
    while($col = $rst->fetch_array(MYSQLI_ASSOC)){
        printf("<tr><td>$col[id]</td><td>$col[name]</td>
                    <td>$col[major]</td><td>$col[data]</td><td><a href='form_update.php?id=$col[id]'>更新する</a></td></tr>");
    }
    printf("</table>");
?>
</body>
</html>
