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

$currentPage = $_SERVER["PHP_SELF"];

$maxRows_Recordset1 = 10;
$pageNum_Recordset1 = 0;
if (isset($_GET['pageNum_Recordset1'])) {
  $pageNum_Recordset1 = $_GET['pageNum_Recordset1'];
}
$startRow_Recordset1 = $pageNum_Recordset1 * $maxRows_Recordset1;


$query_Recordset1 = "SELECT * FROM comment_table where entry_id = ". $_GET['entry_id'] ." ORDER BY comment_id DESC";

$query_limit_Recordset1 = "$query_Recordset1 LIMIT $startRow_Recordset1, $maxRows_Recordset1";

$Recordset1 = $mysqli->query($query_limit_Recordset1);
$all_Recordset1 = $mysqli->query($query_Recordset1);

$totalRows_Recordset1 = $all_Recordset1->num_rows;
$totalPages_Recordset1 = ceil($totalRows_Recordset1/$maxRows_Recordset1)-1;

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
   <li><a href="../index.php">一覧画面に戻る</a></li>
 </ul>
</div>

<hr />

<h2>コメント管理画面</h2>

<h3>エントリーID<?php print $_GET['entry_id']; ?>の記事に対するコメント一覧</h3>

<table width="100%" border="1" cellpadding="0" cellspacing="0">
  <tr>
    <th scope="col">comment_id</th>
    <th scope="col">name</th>
    <th scope="col">編集</th>
    <th scope="col">削除</th>
  </tr>
  <?php while ($row_Recordset1 = $Recordset1->fetch_assoc()) { ?>
    <tr>
      <td><a href="detail.php?recordID=<?php print $row_Recordset1['comment_id']; ?>"> <?php print $row_Recordset1['comment_id']; ?>&nbsp; </a> </td>
      <td><?php print $row_Recordset1['name']; ?>&nbsp; </td>
      <td><a href="edit.php?comment_id=<?php print $row_Recordset1['comment_id']; ?>">編集</a></td>
      <td><a href="remove.php?comment_id=<?php print $row_Recordset1['comment_id']; ?>">削除</a></td>
    </tr>
    <?php }  ?>
</table>
<br />
<table border="0">
  <tr>
    <td><?php if ($pageNum_Recordset1 > 0) { // Show if not first page ?>
          <a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, 0); ?>">先頭</a>
          <?php } // Show if not first page ?>
    </td>
    <td><?php if ($pageNum_Recordset1 > 0) { // Show if not first page ?>
          <a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, max(0, $pageNum_Recordset1 - 1)); ?>">戻る</a>
          <?php } // Show if not first page ?>
    </td>
    <td><?php if ($pageNum_Recordset1 < $totalPages_Recordset1) { // Show if not last page ?>
          <a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, min($totalPages_Recordset1, $pageNum_Recordset1 + 1)); ?>">次へ</a>
          <?php } // Show if not last page ?>
    </td>
    <td><?php if ($pageNum_Recordset1 < $totalPages_Recordset1) { // Show if not last page ?>
          <a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, $totalPages_Recordset1); ?>">最終</a>
          <?php } // Show if not last page ?>
    </td>
  </tr>
</table>
<p style='text-align:center'>
<?php
print "レコード". ($startRow_Recordset1 + 1) ." ～ ". min($startRow_Recordset1 + $maxRows_Recordset1, $totalRows_Recordset1) ." 件 / 全 ". $totalRows_Recordset1;
mysqli_free_result($Recordset1);
?>
</p>
</div>
</body>
</html>