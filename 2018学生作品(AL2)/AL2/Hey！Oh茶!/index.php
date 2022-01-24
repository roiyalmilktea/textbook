<!DOCTYPE html>
<html lang = "ja">
<head>
  <meta charset = "UTF-8">
  <title>入力フォーム</title>
  <link rel="stylesheet" type="text/css" href="web.css">
</head>
<body>
  <h1>レシピの登録</h1>
  <!-- googleカレンダーを埋め込む　-->
  <iframe src="https://calendar.google.com/calendar/embed?height=600&amp;wkst=1&amp;bgcolor=%23FFFFFF&amp;src=kisin0807%40gmail.com&amp;color=%231B887A&amp;ctz=Asia%2FTokyo"
    style="border-width:0" width="800" height="600" frameborder="0" scrolling="no" align="right"></iframe>
  <a href = "demo.html">レシピの新規登録</a>
  <!-- ランダムボタン作成　-->
  <form method="POST" action="">
  <input type="submit" value="ランダム" name="sub1">　
  </form>

  <!-- 検索機能作成　-->
  <?php
  require_once 'db_config.php';
   ini_set('display_errors',1);
   //require_once('index.php');

  if (isset($_GET['search'])) {
    $search = htmlspecialchars($_GET['search']);
    $search_value = $search;
  }else {
    $search = '料理名';
    $search_value = '料理名';
  }

   $dbh = new PDO('mysql:host=localhost;dbname=db1;charset=utf8', $user, $pass);
   $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

   //LINK句を用いて一致する'recipe_name'を検索する
   $sql = "SELECT * FROM recipes where recipe_name LIKE '%$search%'";
   $stmt = array();
   foreach ($dbh->query($sql) as $row) {
     array_push($stmt,$row);
   }
   ?>


   <form action="" method="get">
     <p>料理の検索</p>
     <input type="text" name="search" value="<?php echo $search_value ?>"><br>
     <input type="submit" name="" value="検索">
   </form>


   <!-- 検索した料理名とIDを出力　-->
   <?php foreach ($stmt as $key): ?>
     <p><strong>ID 料理名</strong><br>
       <?php echo $key['id'] ?>
       <?php echo $key['recipe_name'] ?><br>
   <?php endforeach; ?>
<?php

try {

  $sql = "SELECT * FROM recipes";
  $stmt = $dbh->query($sql);
  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
  echo "<table>\n";
  echo "<tr>\n";
  echo "<th>料理名</th><th>カテゴリ</th><th>予算</th><th>難易度</th>\n";
  echo "</tr>\n";

  foreach ($result as $row) {
    echo "<tr>\n";

    echo "<td>" . htmlspecialchars($row['recipe_name'], ENT_QUOTES, 'UTF-8') . "</td>\n";

               if(htmlspecialchars($row['category'], ENT_QUOTES, 'UTF-8') === '1') echo "<td>和食</td>";
               if(htmlspecialchars($row['category'], ENT_QUOTES, 'UTF-8') === '2') echo "<td>中華</td>";
               if(htmlspecialchars($row['category'], ENT_QUOTES, 'UTF-8') === '3') echo "<td>洋食</td>";

               echo "<td>" . htmlspecialchars($row['budget'], ENT_QUOTES, 'UTF-8') . "</td>\n";

               if(htmlspecialchars($row['difficulty'], ENT_QUOTES, 'UTF-8') === '1') echo "<td>簡単</td>";
               if(htmlspecialchars($row['difficulty'], ENT_QUOTES, 'UTF-8') === '2') echo "<td>普通</td>";
               if(htmlspecialchars($row['difficulty'], ENT_QUOTES, 'UTF-8') === '3') echo "<td>難しい</td>";
      echo "<td>\n";
      echo "<a href = detail.php?id=" . htmlspecialchars($row['id'], ENT_QUOTES, 'UTF-8') . ">詳細</a>\n";
      echo "<a href = edit.php?id=" . htmlspecialchars($row['id'], ENT_QUOTES, 'UTF-8') . ">変更</a>\n";
      echo "<a href = delete.php?id=" . htmlspecialchars($row['id'], ENT_QUOTES, 'UTF-8') . ">削除</a>\n";
      echo "</td>\n";
      echo "</tr>\n";
      //$weight_list = [$row['recipe_name'] =>10 ];
    }
    echo "</table>\n";


  //料理名のリスト作成＆重し付け
  $weight_list = [
      'カレーライス' => 25,
      'さんまの塩焼き' => 25,
      'チャーハン' => 25,
      'オムレツ' => 25,
      '肉まん' => 25,
      'ピザ' => 25,
      'カツカレー' => 25,
      '肉じゃが' => 25,
  ];
  //random_intで$result_numberに(1, array_sum($weight_list)の間の値を代入
  $result_number = random_int(1, array_sum($weight_list));
  $total_weight = 0;

  //$result_numberと適した料理名を表示
  foreach ($weight_list as $name => $weight)
  {
      $total_weight += $weight;
      if ($result_number <= $total_weight)
      {
          $result = $name;
          break;
      }
  }
  if (isset($_POST["sub1"])) {
      $kbn = htmlspecialchars($_POST["sub1"], ENT_QUOTES, "UTF-8");
          echo "<script>alert('$result');</script>";
  }


  ////////////////////////////////////////////////////////////////////////

  $dbh = null;
} catch (Exception $e) {
  echo "エラー発生： " . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8') . "<br>";
  die();
}
?>
</body>
</html>
