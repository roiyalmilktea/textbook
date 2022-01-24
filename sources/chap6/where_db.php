<?php
    //データベースからデータを抽出する
    require 'db_connect.php';
    //studentテーブルからmajorが情報学部のデータをすべて抽出する
    $sql = "SELECT * FROM student where major = '情報学部'";
    //SQL文を発行する
    $rst = $mysqli->query($sql);
    //出力結果をテーブルで表示する
    printf("<table border='1'>");
    printf("<tr><td>id</td><td>名前</td><td>学部</td><td>テストデータ</td><tr>");
    //mysql_fetch_array関数を用いて発行したSQL文の結果レコードを一行ずつ取得する
    //whileは結果レコードをすべて取得するまで繰り返す        
    while($col = $rst->fetch_array(MYSQLI_ASSOC)){
        printf("<tr><td>$col[id]</td><td>$col[name]</td>
                    <td>$col[major]</td><td>$col[data]</td></tr>");
    }
    printf("</table>");
?>
