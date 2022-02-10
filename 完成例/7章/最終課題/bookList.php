<?php
  if (empty($_GET["tid"]) == true) {
      $tid = "";
  } else {
      $tid = htmlspecialchars($_GET["tid"]);
  }
  require_once('./dbConfig.php');
  $link = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
  if ($link == null) {
    die("接続に失敗しました");
  }
  mysqli_set_charset($link, "utf8");
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <link href="./css/style.css" rel="stylesheet" type="text/css">
  <title>bookList</title>
</head>
<body>
  <!-- ヘッダー：開始-->
  <header id="header">
    <div id="pr">
      <p>書籍を選択する！</p>
    </div>
    <h1><a href="./index.php"><img src="./images/logo.png" alt=""></a></h1>
    <div id="contact">
      
    </div>
  </header>
  <!-- ヘッダー：終了 -->
  <!-- メニュー：開始 -->
<?php include("./topmenu.php"); ?>
  <!-- メニュー：終了 -->
  <!-- コンテンツ：開始 -->
  <div id="contents">
    <!-- メイン：開始 -->
    <main id="main">
      <article>
        <section>
          <h2>分野別紹介</h2>
<!-- お手本のデータベースはroomといデータベースのroom_nameからroom_noまでを取ってきた-->
<?php
  if (empty($tid) == true) {
    $sql = "SELECT category, title_name, main_image, book_value
      FROM book, book_type 
      WHERE book.type_id = book_type.book_id";
  } else {
    $sql = "SELECT category, title_name, main_image,book_value
      FROM book, book_type
      WHERE book.type_id= book_type.book_id
      AND book.type_id = {$tid}"; 
  }
  $result = mysqli_query($link, $sql);
  $cnt = mysqli_num_rows($result);
  if ($cnt == 0) {
    echo "<b>not found...</b>";  
  } else {
?>
          <h3>書籍のご紹介</h3>
          <p>
            Webapplication,Binary,Networkから興味がある分野を選んで下さい。
          </p>
          
          <table>
            <th>書籍名</th>
            <th>分野</th>
            <th>料金<br>（税込み）</th>
            <th colspan="3">表紙</th>
<!-- ここにPHPスクリプトを埋め込む -->          
<?php
    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
      echo "<tr>";
      echo "<td>{$row['title_name']}</td>";
      echo "<td>{$row['category']}</td>";
      $bookfee = number_format($row['book_value']);
      echo "<td class='number'>&yen; {$bookfee}</td>";
      echo "<td><img class='small' src='./images/{$row['main_image']}'></td>";
      echo "<td><a href='./bookDetail.php?bno={$row['category']}'>詳細</a></td>";
      echo "</tr>";
    }
  }
?>
          </table>
        </section>
      </article>
    </main>
    <!-- メイン：終了 -->
    <!-- サイド：開始 -->
    <aside id="side">
      <section>
       
      <section>
        <h2>分野別紹介</h2>
<?php include("./sideList.php"); ?>
      </section>
    </aside>
    <!-- サイド：終了 -->
    <!-- ページトップ：開始 -->
    <div id="pageTop">
      <a href="#top">ページのトップへ戻る</a>
    </div>
    <!-- ページトップ：終了 -->
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
