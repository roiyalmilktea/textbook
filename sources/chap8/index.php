<?php require_once('Connections/localhost.php');

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
while ($row_Recordset1 = $Recordset1->fetch_assoc()){  
	print "<h2>".$row_Recordset1['subject']."</h2>";
    print "<p>".$row_Recordset1['digest']."</p>"; 
    print "<p><a href='topic.php?entry_id=". $row_Recordset1['entry_id']."'>もっと読む</a></p>";
    print "<ul class='modori'>";
	print "<li><a href='#PAGETOP'>TOP</a></li></ul><hr>";
}

print "<p style='text-align:center'>";

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
