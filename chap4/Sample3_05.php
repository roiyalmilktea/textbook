<?php
  $cnt=3;    		          //$cntに3を代入
  do {
    echo "{$cnt}回目<br>";  //変数$cntと「回目」と改行タグを表示
    $cnt++;			           //$cntに１を加算
  }while($cnt < 5) 		     //$cntが5未満の間はループ
?>