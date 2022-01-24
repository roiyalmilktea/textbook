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

$maxRows_Recordset1 = 10;
$pageNum_Recordset1 = 0;
if (isset($_GET['pageNum_Recordset1'])) {
  $pageNum_Recordset1 = $_GET['pageNum_Recordset1'];
}

$startRow_Recordset1 = $pageNum_Recordset1 * $maxRows_Recordset1;


$query_Recordset1 = "SELECT * FROM entry_table ORDER BY entry_id DESC";
$query_limit_Recordset1 = "$query_Recordset1 LIMIT $startRow_Recordset1, $maxRows_Recordset1";

$Recordset1 = $mysqli->query($query_limit_Recordset1);

if (isset($_GET['totalRows_Recordset1'])) {
	$totalRows_Recordset1 = $_GET['totalRows_Recordset1'];
} else {
	$all_Recordset1 = $mysqli->query($query_Recordset1);
	$totalRows_Recordset1 = $all_Recordset1->num_rows;
}
$totalPages_Recordset1 = ceil($totalRows_Recordset1/$maxRows_Recordset1)-1;

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
   <li><a href="<?php print $_SERVER['PHP_SELF']."?doLogout=true"; ?>">ログアウト</a></li>
 </ul>
</div>

<hr />

<h3><a href="input.php">新しい記事を追加する</a></h3>
<h3><a href="comment/all.php">全てのコメントを見る</a></h3>

<h2>記事一覧</h2>
<table width="100%" border="1" cellpadding="0" cellspacing="0">
  <tr>
    <th scope="col">ID</th>
    <th scope="col">タイトル</th>
    <th scope="col">編集</th>
    <th scope="col">削除</th>
    <th scope="col">コメント</th>
  </tr>
<?php 

while ($row_Recordset1 = $Recordset1->fetch_assoc()) {
	print "<tr>". PHP_EOL ."<td style='text-align:center'>". $row_Recordset1['entry_id'] ."</td>". PHP_EOL;
    print "<td>". $row_Recordset1['subject'] ."</td>". PHP_EOL;
	print "<td style='text-align:center'><a href='edit.php?entry_id=". $row_Recordset1['entry_id'] ."'>編集</a></td>". PHP_EOL;
	print "<td style='text-align:center'><a href='remove.php?entry_id=". $row_Recordset1['entry_id'] ."'>削除</a></td>". PHP_EOL;
	print "<td style='text-align:center'><a href='comment/index.php?entry_id=". $row_Recordset1['entry_id'] ."'>コメント</a></td>". PHP_EOL ."</tr>";
} 

print "</table>";
print "<br><p style='text-align:center'>";

if ($pageNum_Recordset1 > 0) { // Show if not first page 
	print "<a href='index.php?pageNum_Recordset1=" .max(0, $pageNum_Recordset1 - 1)."'>前のページへ</a>"; 
} // Show if not first page 
if ($pageNum_Recordset1 < $totalPages_Recordset1) { // Show if not last page 
	print "<a href='index.php?pageNum_Recordset1=".min($totalPages_Recordset1, $pageNum_Recordset1 + 1)."'>次のページへ</a>";
} // Show if not last page 
mysqli_free_result($Recordset1);

?>
</div>
</body>
</html>