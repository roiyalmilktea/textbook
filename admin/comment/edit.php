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


if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
	$updateSQL = sprintf("UPDATE comment_table SET entry_id=%s, name='%s', email='%s', url='%s', comment='%s', post_table='%s' WHERE comment_id=%s", $_POST['entry_id'], $_POST['name'], $_POST['email'], $_POST['url'], $_POST['comment'], $_POST['post_table'], $_POST['comment_id']);

  $Result1 = $mysqli->query($updateSQL);

  header("Location: ../index.php?entry_id=". $_POST['entry_id']);
}

$colname_Recordset1 = "-1";
if (isset($_GET['comment_id'])) {
  $colname_Recordset1 = $_GET['comment_id'];
}

$query_Recordset1 = "SELECT * FROM comment_table WHERE comment_id = $colname_Recordset1";

$Recordset1 = $mysqli->query($query_Recordset1);
$row_Recordset1 = $Recordset1->fetch_assoc();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="content-style-type" content="text/css">
<title>MyBlog管理画面</title>
<link href="../../style.css" rel="stylesheet" type="text/css" media="all" />
<link href="../../bootstrap-4.3.1-dist/css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="../../bootstrap-4.3.1-dist/js/bootstrap.min.js"></script> 
</head>
<body>
<nav id="PAGETOP" class="navbar navbar-expand-sm navbar-dark bg-primary mt-3 mb-3">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav4" aria-controls="navbarNav4" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="../index.php">Blogシステム管理画面</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="../index.php">一覧画面に戻る</a>
                </li>
            </ul>
        </div>
    </nav> 
<div id="PAGETOP">

<hr />
<div class="container">
<h2>コメント管理画面</h2>
<h3>編集</h3>

<form  method="post" name="form1" id="form1">
  <table align="center">
    <div class="form-group">
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Comment_id:</td>
      <td><?php print $row_Recordset1['comment_id']; ?></td>
    </tr>
    </div>
    <div class="form-group">
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Entry_id:</td>
      <td><input type="text" name="entry_id" class="form-control" value="<?php print $row_Recordset1['entry_id']; ?>" size="32" /></td>
    </tr>
    </div>
    <div class="form-group">
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Name:</td>
      <td><input type="text" name="name" class="form-control" value="<?php print $row_Recordset1['name']; ?>" size="32" /></td>
    </tr>
    </div>
    <div class="form-group">
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Email:</td>
      <td><input type="text" name="email" class="form-control" value="<?php print $row_Recordset1['email']; ?>" size="32" /></td>
    </tr>
    </div>
    <div class="form-group">
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Url:</td>
      <td><input type="text" name="url" class="form-control" value="<?php print $row_Recordset1['url']; ?>" size="32" /></td>
    </tr>
    </div>
    <div class="form-group">
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Comment:</td>
      <td><input type="text" name="comment" class="form-control" value="<?php print $row_Recordset1['comment']; ?>" size="32" /></td>
    </tr>
    </div>
    <div class="form-group">
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Post_table:</td>
      <td><input type="text" name="post_table" class="form-control" value="<?php print $row_Recordset1['post_table']; ?>" size="32" /></td>
    </tr>
    </div>
    <div class="form-group">
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="submit" class="btn btn-primary" value="レコードの更新" /></td>
    </tr>
    </div>
  </table>
  <input type="hidden" name="MM_update" value="form1" />
  <input type="hidden" name="comment_id" value="<?php print $row_Recordset1['comment_id']; ?>" /> 
</form>
</div>
</div>
</body>
</html>
<?php
mysqli_free_result($Recordset1);
?>
