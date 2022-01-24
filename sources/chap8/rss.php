<?php 

require_once('Connections/localhost.php'); 

$maxRows_Recordset1 = 10;
$startRow_Recordset1 = 0;


$query_limit_Recordset1 = "SELECT * FROM entry_table ORDER BY entry_id DESC LIMIT $startRow_Recordset1, $maxRows_Recordset1";

$Recordset1 = $mysqli->query($query_limit_Recordset1);

print "<?xml version='1.0' encoding='UTF-8'?>";

?>
<rss version="2.0">
<channel>
<title >My Blogの RSS</title>
<link>
http://localhost/
</link>
<description>このRSSは、MyBlogの RSSです</description>
<language>ja</language>
<copyright></copyright>
<managingEditor></managingEditor>
<webMaster></webMaster>
<pubDate></pubDate>
<lastBuildDate></lastBuildDate>
<?php 
while ($row_Recordset1 = $Recordset1->fetch_assoc()){
	print "<item>".PHP_EOL."<title>". $row_Recordset1['subject'] ."</title>".PHP_EOL;
	print "<link>http://localhost/topic.php?entry_id=". $row_Recordset1['entry_id'] ."</link>".PHP_EOL;
	print "<description>". $row_Recordset1['digest'] ."</description>".PHP_EOL;
	print "<pubDate>". date("D, d M Y H:i:s +0900", strtotime($row_Recordset1['post_date'])) ."</pubDate>".PHP_EOL."</item>".PHP_EOL;
}  
mysqli_free_result($Recordset1);  
?>
</channel>
</rss>
