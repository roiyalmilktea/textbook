<?php 

require_once('../../Connections/localhost.php');

//セッション処理ここから

if (!isset($_SESSION)) {
  session_start();
}

if ((isset($_GET['doLogout'])) &&($_GET['doLogout']=="true")){
	//to fully log out a visitor we need to clear the session varialbles
	$_SESSION['MM_Username'] = NULL;
	$_SESSION['PrevUrl'] = NULL;
	unset($_SESSION['MM_Username']);
	unset($_SESSION['PrevUrl']);
	
	header("Location: login.php");
}

if (!isset($_SESSION['MM_Username'])) {   
	header("Location: login.php"); 
}

//セッション処理ここまで

$query_DetailRS1 = "SELECT * FROM comment_table WHERE comment_id = ". $_GET['recordID'] ." ORDER BY comment_id DESC";

$DetailRS1 = $mysqli->query($query_DetailRS1);
$row_DetailRS1 = $DetailRS1->fetch_assoc();

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="content-style-type" content="text/css">
<title>MyBlog管理画面</title>
<link href="../../style.css" rel="stylesheet" type="text/css" media="all" />
</head>
<body>
<div id="PAGETOP">

<div id="HEADER">
<h1>Blogシステム管理画面</h1>
 <ul id="PAN">
   <li><a href="index.php?entry_id=<?php print $row_DetailRS1['entry_id']; ?>">一覧画面に戻る</a></li>
 </ul>
</div>

<hr />

<h2>コメント管理画面</h2>
<h3>閲覧</h3>

<table border="1" align="center">
  <tr>
    <td>comment_id</td>
    <td><?php print $row_DetailRS1['comment_id']; ?> </td>
  </tr>
  <tr>
    <td>entry_id</td>
    <td><?php print $row_DetailRS1['entry_id']; ?> </td>
  </tr>
  <tr>
    <td>name</td>
    <td><?php print $row_DetailRS1['name']; ?> </td>
  </tr>
  <tr>
    <td>email</td>
    <td><?php print $row_DetailRS1['email']; ?> </td>
  </tr>
  <tr>
    <td>url</td>
    <td><?php print $row_DetailRS1['url']; ?> </td>
  </tr>
  <tr>
    <td>comment</td>
    <td><?php print $row_DetailRS1['comment']; ?> </td>
  </tr>
  <tr>
    <td>post_table</td>
    <td><?php print $row_DetailRS1['post_table']; ?> </td>
  </tr>
</table>
</p>
</div>
</body>
</html>
<?php
mysqli_free_result($DetailRS1);
?>
