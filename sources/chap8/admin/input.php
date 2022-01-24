<?php 

require_once('../Connections/localhost.php');

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

if (isset($_POST["MM_insert"]) && $_POST["MM_insert"] == "formMain") {
	$insertSQL = "INSERT INTO entry_table (subject, digest, `document`) VALUES ('". $_POST['subject']. "', '". $_POST['digest'] ."', '". $_POST['document_text'] ."')";

	$Result1 = $mysqli->query($insertSQL);

	header("Location: index.php");
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="content-style-type" content="text/css">
<title>MyBlog管理画面</title>
<link href="../style.css" rel="stylesheet" type="text/css" media="all" />
</head>
<body>
<div id="PAGETOP">

<div id="HEADER">
<h1>Blogシステム管理画面</h1>
 <ul id="PAN">
   <li><a href="index.php">一覧画面に戻る</a></li>
 </ul>
</div>

<hr />

<h2>記事登録画面</h2>
<p>記事の内容を入力して、[登録]ボタンをクリックしてください。</p>
<form id="formMain" name="formMain" method="POST" action="input.php">
  <h3>タイトル</h3>
  <p>
    <input name="subject" type="text" id="subject" size="50" maxlength="255" />
  </p>
  <h3>内容</h3>
  <p>
    <textarea name="digest" cols="50" rows="5" id="digest"></textarea>
  </p>
  <h3>続き</h3>
  <p>
    <textarea name="document_text" id="document_text" cols="50" rows="20"></textarea>
  </p>
<p>
    <input type="submit" name="Submit" value="登録" />
  </p>
<input type="hidden" name="MM_insert" value="formMain" />
</form>
</div>
</body>
</html>