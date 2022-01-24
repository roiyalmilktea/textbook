<?php
  $kousui = rand(0,100);  //0-100までの乱数を生成
  $color  = "black";	    //仮の色指定 
  //条件分岐処理を記述（※複数行）
  if($kousui >= 80){
      $color = "blue";
  }elseif($kousui >= 50){
      $color = "skyblue";
  }elseif($kousui >= 20){
      $color = "orange";
  }else{
      $color = "red";
  }
  echo "降水確率は <font color='"
    .$color."'>"
    .$kousui."</font>パーセントです！";
?>