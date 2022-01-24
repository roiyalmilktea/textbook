<?php
  $a1 = array(1,2,3,4,5);
  $sum = 0;               //合計用変数
  foreach($a1 as $value){ //配列の要素数分ループ（＝5回）
    $sum = $sum + $value; //配列の要素が順番に$valueに代入
                          //されるので、その値を$sumに加算
  }
  echo "合計は{$sum}です！";//画面に出力
?>