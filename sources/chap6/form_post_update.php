<?php
    //データベースからデータを抽出する
    require 'db_connect.php';
    
	$id = $_POST["id"];
	$name = $_POST["name"];
	$major = $_POST["major"];
	$data = $_POST["data"];

    //studentテーブルのデータを更新する
    $sql = "UPDATE student SET name = '$name', major = '$major', data = $data WHERE id = $id";
    //SQL文を発行する
    $rst = $mysqli->query($sql);
    
	 print "<h2>データを更新しました</h2>";
    //studentテーブルからデータをすべて抽出する
    require 'select_db.php';
    print "<p><a href='select_db2.php'>トップへ戻る</a></p>";
?>
