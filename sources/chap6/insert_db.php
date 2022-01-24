<?php
    //データベースからデータを抽出する
    require 'db_connect.php';
    //studentテーブルにデータを追加する
    //$sql = "INSERT INTO student (id, name, major, data) VALUE (1,'環境次郎','環境学部',70)";
    $sql = "INSERT INTO student (name, major, data) VALUE ('環境次郎','環境学部',70)";
    print "<h2>データ挿入しました</h2>";
    //SQL文を発行する
    $rst = $mysqli->query($sql);
    //studentテーブルからデータをすべて抽出する
    require 'select_db.php';
?>
