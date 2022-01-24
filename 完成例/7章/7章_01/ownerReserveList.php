<?php
  require_once('./dbConfig.php');
  $link = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
  if ($link == null) {
    die( "接続に失敗しました：" . mysqli_connect_error() );
  }
  mysqli_set_charset($link, "utf8");

  $sql = "SELECT reserve_no, reserve_date, room_no, numbers, 
    checkin_time, message, customer_name, customer_telno
    FROM reserve, customer
    WHERE reserve.customer_id = customer.customer_id ";

  $result = mysqli_query($link, $sql);
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="./css/style.css" type="text/css">
  <title>JIKKYO PENSION</title>
</head>
<body>
  <!-- ヘッダー：開始-->
  <header id="header">
    <div id="pr">
      <p>部活・サークル等のグループ利用に最適！アットホームなペンション！</p>
    </div>
    <h1><a href="./index.php"><img src="./images/logo.png" alt=""></a></h1>
  </header>
  <!-- ヘッダー：終了 -->
  <!-- メニュー：開始 -->
  <nav id="menu">
    <ul>
  <li><a href="">本日</a></li>
  <li><a href="">本日以降</a></li>
  <li><a href="">過去</a></li>
    </ul>
  </nav>
  <!-- メニュー：終了 -->
  <!-- コンテンツ：開始 -->
  <div id="contents">
    <h2>予約管理画面（本日）</h2>
    <p>各行の削除ボタンを押すことで、予約情報を削除することができます。</p>
    <table class="host">
      <th>　宿泊日付　</th>
      <th>チェックイン<br>予定時間</th>
      <th>部屋番号</th>
      <th>顧　客　名</th>
      <th>代表者連絡先</th>
      <th>利用人数</th>
      <th>メッセージ</th>
      <th></th>
<?php
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
    echo "<tr>";
    $rdate = date('Y-m-d', strtotime($row['reserve_date']));
    echo "<td>{$rdate}</td>";
    echo "<td>{$row['checkin_time']}</td>";
    echo "<td>{$row['room_no']}</td>";
    echo "<td>{$row['customer_name']}</td>";
    echo "<td>{$row['customer_telno']}</td>";
    echo "<td>{$row['numbers']}人</td>";
    echo "<td>{$row['message']}</td>";
    echo "<td><a class='submit_a' href='./ownerReserveDelete.php?rno={$row['reserve_no']}'>削除</a></td>";
    echo "</tr>";
}
?>
    </table>
    <br>
    <a class="submit_a" href="ownerLogout.php">ログアウト</a>
  </div>
  <!-- コンテンツ：終了 -->
  <!-- フッター：開始 -->
  <footer id="footer">
    Copyright c 2016 Jikkyo Pension All Rights Reserved.
  </footer>
  <!-- フッター：終了 -->
<?php
  mysqli_free_result($result);
  mysqli_close($link);
?>
</body>
</html>
