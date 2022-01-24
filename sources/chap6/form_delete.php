<?php
    //データベースからデータを抽出する
    require 'db_connect.php';

	$id = $_GET["id"];
	print "<h3>削除して良いのですか？</h3>";
    //studentテーブルからmajorが情報学部のデータをすべて抽出する
    $sql = "SELECT * FROM student where id = $id";
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
<form method="post" action="form_post_delete.php">
	<input type="hidden" name="id" value="<?php print $id; ?>">
	<input type="submit" value="送信" >
</form>
