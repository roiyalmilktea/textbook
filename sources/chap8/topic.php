<?php 
require_once('Connections/localhost.php');

if (isset($_GET['entry_id']) && isset($_POST["MM_insert"]) && $_POST["MM_insert"] == "formComment") {
	$insertSQL = "INSERT INTO comment_table (entry_id, name, email, url, comment) VALUES (". $_POST['hiddenField'] .", '". $_POST['name'] ."', '". $_POST['email'] ."', '". $_POST['url'] ."', '". $_POST['comment'] ."')";

	$Result1 = $mysqli->query($insertSQL);
}

$colname_Recordset1 = "-1";
if (isset($_GET['entry_id'])) {
	$colname_Recordset1 = $_GET['entry_id'];
}

$query_Recordset1 = "SELECT * FROM entry_table WHERE entry_id = $colname_Recordset1";
$Recordset1 = $mysqli->query($query_Recordset1);

$row_Recordset1 = $Recordset1->fetch_assoc();

$colname_Recordset2 = "-1";
if (isset($_GET['entry_id'])) {
	$colname_Recordset2 = $_GET['entry_id'];
}

$query_Recordset2 = "SELECT * FROM comment_table WHERE entry_id = $colname_Recordset2 ORDER BY comment_id DESC";

$Recordset2 = $mysqli->query($query_Recordset2);

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="content-style-type" content="text/css">
<title>MyBlog</title>
<link href="style.css" rel="stylesheet" type="text/css" media="all" />
</head>
<body>
<div id="PAGETOP">

<div id="HEADER">
<h1>MyBlog</h1>
 <ul id="PAN">
   <li><a href="rss.php">RSS</a></li>
   <li><a href="admin/login.php">管理者</a></li>
 </ul>
</div>

<hr>
<?php
print "<h2>". $row_Recordset1['subject']. "</h2>". PHP_EOL;
print "<p>". $row_Recordset1['digest']. "</p>". PHP_EOL;
print "<p>". $row_Recordset1['document']. "</p>". PHP_EOL;
?>
<hr />
<h3>コメント</h3>
<?php 

while ($row_Recordset2 = $Recordset2->fetch_assoc()) {
	print "<dl class='comment'>";
	print "<dt><a href='mailto:". $row_Recordset2['email']. "'>". $row_Recordset2['name']. "</a>/". $row_Recordset2['url']. "</dt>";
    print "<dd>". $row_Recordset2['comment']. "</dd>";
	print "</dl>";
} 
?>
<h3>新しいコメント</h3>
<form id="formComment" name="formComment" method="POST" >
  <h4>名前：</h4>
  <p>
    <input name="name" type="text" id="name" size="35" />
</p>
  <h4>メールアドレス：</h4>
  <p>
    <input name="email" type="text" id="email" size="35" />
  </p>
  <h4>Webサイト：</h4>
  <p>
    <input name="url" type="text" id="url" size="50" />
  </p>
  <h4>コメント：</h4>
  <p>
    <textarea name="comment" cols="50" rows="5" id="comment"></textarea>
  </p>
  <p>
    <input type="submit" name="Submit" value="投稿する" />
  </p>
  <p>
    <input name="hiddenField" type="hidden" id="hiddenField" value="<?php echo $row_Recordset1['entry_id']; ?>" />
  </p>
  <input type="hidden" name="MM_insert" value="formComment" />
</form>

<hr />
<p><a href="index.php">リストにもどる</a></p>
</div>
</body>
</html>
<?php
mysqli_free_result($Recordset1);
mysqli_free_result($Recordset2);
?>