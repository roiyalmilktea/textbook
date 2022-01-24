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

if (isset($_POST["MM_update"]) && $_POST["MM_update"] == "formMain") {
  $updateSQL = "UPDATE entry_table SET subject='". $_POST['subject'] ."', digest='". $_POST['digest'] ."', `document`='". $_POST['document'] ."' WHERE entry_id='". $_POST['hiddenField'] ."'";

  $Result1 = $mysqli->query($updateSQL);

  header("Location: index.php");
}

$colname_Recordset1 = "-1";
if (isset($_GET['entry_id'])) {
	$colname_Recordset1 = $_GET['entry_id'];
}

$query_Recordset1 = "SELECT * FROM entry_table WHERE entry_id = $colname_Recordset1";
$Recordset1 = $mysqli->query($query_Recordset1);
$row_Recordset1 =$Recordset1->fetch_assoc();

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

<h2>記事編集画面</h2>
<p>記事の内容を編集して、[更新]ボタンをクリックしてください。</p>
<form action="<?php print $_SERVER['PHP_SELF']; ?>" id="formMain" name="formMain" method="POST">
  <h3>タイトル</h3>
  <p>
    <input name="subject" type="text" id="subject" value="<?php print $row_Recordset1['subject']; ?>" size="50" maxlength="255" />
  </p>
  <h3>内容</h3>
  <p>
    <textarea name="digest" cols="50" rows="5" id="digest"><?php print $row_Recordset1['digest']; ?></textarea>
  </p>
  <h3>続き</h3>
  <p>
    <textarea name="document" cols="50" rows="20" id="document"><?php print $row_Recordset1['document']; ?></textarea>
  </p>
  <p>
    <input type="submit" name="Submit" value="更新" />
    <input name="hiddenField" type="hidden" id="hiddenField" value="<?php print $row_Recordset1['entry_id']; ?>" />
  </p>
  <input type="hidden" name="MM_update" value="formMain" />
</form>
</div>
</body>
</html>
<?php
mysqli_free_result($Recordset1);
?>
