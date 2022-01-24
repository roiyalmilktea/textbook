<?php
    //データベースからデータを抽出する
    require 'db_connect.php';
    //studentテーブルのdateの値をすべて1.5倍する
    $sql = "UPDATE student SET deta = deta * 1.5 WHERE major = '環境学部'";
    //SQL文を発行する
    $rst = $mysqli->query($sql);
    //studentテーブルからデータをすべて抽出する
    require 'select_db.php';
?>
