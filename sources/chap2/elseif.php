<html>
<head>
<title>elseif.php</title>
</head>
<body>
<?php
// if～else
 $marks = 75;
 if ( $markas >= 80 )        // 第１の条件判定
 {
  print "ランクAです<br>";
 } 
 elseif ( $marks >= 70 )      // 第２の条件判定
 {
   print "ランクBです<br>";
 } 
 elseif ( $marks >= 60 )      // 第３の条件判定
 {
    print "ランクCです<br>";
 } 
 else                // その他の条件の場合
 {
    print "ランクDです<br>";
 } 
?>
</body>
</html>