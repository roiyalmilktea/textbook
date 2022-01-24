<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<html>
    <head>
        <title>get form</title>
    </head>
    <body>
	<?php

		require 'db_connect.php';

            $name = $_POST["name"];
            $major = $_POST["major"];
            $data = $_POST["data"];
		
		$sql = "insert into student (name, major, data) value ('$name','$major','$data')";

		//echo $sql;

		$rst = $mysqli->query($sql);

		//printf("name = %s<br>",$name);
		//printf("major = %s<br>",$major);
		//printf("data = %s<br>",$deta);
		
		 print "<h2>データ挿入しました</h2>";
		//studentテーブルからデータをすべて抽出する
		require 'select_db.php';
	?>
    </body>
</html>
