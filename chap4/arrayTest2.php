<?php
  //商品名、単価を持つ連想配列itemArrayを作成
  $itemArray = array("鉛筆" => 120,
                     "消しゴム" => 100, 
                     "はさみ" => 400);

  //tableタグで表を作成
  echo "<table border='1'>";
  echo "<th>商品名</th><th>単　価</th>";
  //itemArrayより項目を取得して表示
  foreach($itemArray as $key => $value){	//foreachの開始{
    echo "<tr>";													//trの開始
    echo "<td>".$key."</td>";							//td..td
    echo "<td>".$value."</td>";						//td..td
    echo "</tr>";													//trの終了
  }																				//foreachの終了}
  echo "</table>";
?>