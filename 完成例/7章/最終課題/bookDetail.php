<?php
  $bno = htmlspecialchars($_GET["bno"]);
  echo '<script>';
  echo 'console.log('.json_encode($bno).')';
  echo '</script>';
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
    <div id="contact">
      <h2>ご予約／お問い合わせ</h2>
      <span class="tel">☎0120-000-000</span>
    </div>
  </header>
  <!-- ヘッダー：終了 -->
  <!-- メニュー：開始 -->
<?php include("./topmenu.php"); ?>
  <!-- メニュー：終了 -->
  <!-- コンテンツ：開始 -->
  <div id="contents">
    <!-- メイン：開始 -->
<?php
  $sql = "SELECT title_name, imformation, main_image, image_1, image_2,image_3, book_name, book_value FROM book, book_type  
        WHERE book.type_id = book_type.book_id";
	// ここにAND処理をすること
  $result = mysqli_query($link, $sql);
  $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
?>
    <main id="main">
      <article>
        <section>
          <h2>お部屋の詳細</h2>
          <h3>『<?php echo $row['title_name']; ?>』</h3>
          <p>
<?php echo $row['imformation']; ?>
          </p>
          <table>
            <tr>
              <td><img class="middle" src="./images/<?php echo $row['main_image']; ?>"></td>
              <td><img class="middle" src="./images/<?php echo $row['image_1']; ?>"></td>
            </tr>
            <tr>
              <td><img class="middle" src="./images/<?php echo $row['image_2']; ?>"></td>
              <td><img class="middle" src="./images/<?php echo $row['image_3']; ?>"></td>
            </tr>
          </table>
          <br>
          <table>
            <th>お部屋タイプ</th>
            <th>一泊料金<br>（部屋単位）</th>

            <tr>
              <td><?php echo $row['book_name']; ?></td>
              <td class="number">&yen;<?php echo number_format($row['book_value']); ?></td>
              
            </tr>
          </table>
          <br>
        </section>
      </article>
    </main>
    <!-- メイン：終了 -->
    <!-- サイド：開始 -->
    <aside id="side">
      <section>
        <h2>ご予約</h2>
        <ul>
          <li><a href="./index.html">宿泊日入力</a></li>
        </ul>
      </section>
      <section>
        <h2>お部屋紹介</h2>
<?php include("./sideList.php"); ?>
      </section>
    </aside>
    <!-- サイド：終了 -->
    <!-- ページトップ：開始 -->
    <div id="pageTop">
      <a href="./index.html#top">ページのトップへ戻る</a>
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
</html>>