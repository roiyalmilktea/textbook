<?php
    //データベースからデータを抽出する
    require 'db_connect.php';
    
	$id = $_POST["id"];

    //studentテーブルの指定の行を削除する
    $sql = "DELETE FROM student WHERE id = $id";
    //SQL文を発行する
    $rst = $mysqli->query($sql);
    
	 print "<h2>データを削除しました</h2>";
    //studentテーブルからデータをすべて抽出する
    require 'select_db.php';
    print "<p><a href='select_db3.php'>トップへ戻る</a></p>";
?>
