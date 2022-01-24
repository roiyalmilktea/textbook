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

if ((isset($_GET['comment_id'])) && ($_GET['comment_id'] != "")) {
	$query_Recordset1 = "DELETE FROM comment_table WHERE comment_id = ". $_GET['comment_id'];
	$mysqli->query($query_Recordset1);

  header("Location: ../index.php");
}
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
<h1>コメント管理画面</h1>
 <ul id="PAN">
   <li><a href="../index.php">一覧画面に戻る</a></li>
 </ul>
</div>

<hr />

<h3>この画面はコメント削除画面です</h3>

</div>
</body>
</html>
