<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<html>
<head>
	<title>フォームサンプル</title>
</head>
<body>
<?php
    //データベースからデータを抽出する
    require 'db_connect.php';
    $id = $_GET["id"];
    $sql = "SELECT * FROM student where id = '$id'";
    $rst = $mysqli->query($sql);
	$col = $rst->fetch_array(MYSQLI_ASSOC);
?>
<font size="5">
<form method="post" action="form_post_update.php">
	    <b>データの更新</b><br><br>
	    name <input type="text" name="name" value="<?php print $col["name"]; ?>" size="20"><br><br>
	    major <input type="text" name="major" value="<?php print $col["major"]; ?>" size="20"><br><br>
	    data <input type="text" name="data" value="<?php print $col["data"]; ?>" size="20"><br><br>
		<input type="hidden" name="id" value="<?php print $id; ?>">
	    <input type="submit" value="送信" >
	    </form>
	</font>
</body>
</html>