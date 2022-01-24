<head>
<title>switch.php</title>
</head>
<body>
<?php
// switch文
 $menu = "メニューC";
 switch ( $menu )              //$menuの値によって分岐します
 {
   case "メニューA" :           // １回目の値の判定による分岐
     print "メニューAを実行します";
     break;               // switch文を抜け出す
   case "メニューB" :           // ２回目の値の判定による分岐
     print "メニューBを実行します";
     break;
   case "メニューC" :          // ３回目の値の判定による分岐
     print "メニューCを実行します";
     break;
   default :               // 一致する値がない場合の分岐（省略可能）
     print "該当するメニューはありません";
     break;
}
?>
</body>
</html>