<?php
    //データベースからデータを抽出する
    require 'db_connect.php';
    //studentテーブルのidが4のものをレコードを削除する
    $sql = "DELETE FROM student where id = 1";
    //SQL文を発行する
    $rst = $mysqli->query($sql);
    //studentテーブルからデータをすべて抽出する
    require 'select_db.php';
?>
