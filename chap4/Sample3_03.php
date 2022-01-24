<?php
  $color = "青";
  switch ($color){
   case "赤":
     echo "止まってください！";    //$colorが赤ならば実行
     break;                     //switch文から抜ける
   case "青":
   case "緑":
     echo "進んでください！";     //$colorが青または緑ならば実行
     break;                    //switch文から抜ける
   default;
      echo "左右の確認を！";     //$colorが赤、青、緑以外ならば実行
  }
?>