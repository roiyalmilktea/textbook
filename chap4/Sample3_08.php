<?php
  $a1 = array("赤","青","黄");
  echo $a1[0];		//１個目（0番目）の要素を画面表示
  echo $a1[1]; 		//２個目（1番目）の要素を画面表示
  echo $a1[2]; 		//３個目（2番目）の要素を画面表示
  echo "<br>";		//改行コードを出力

  $a1[3] = "緑";		//４個目（3番目）の要素を追加
  $a1[]  = "紫";		//最後（今回は４番目）の要素を追加

  var_dump($a1);		//配列の要素全体を画面表示する関数
?>