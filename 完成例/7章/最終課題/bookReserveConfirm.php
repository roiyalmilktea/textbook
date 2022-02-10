<?php
  session_start();
  require_once('./dbConfig.php');
  $link = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
  if ($link == null) {
    die("接続に失敗しました：" . mysqli_connect_error());
  }
  mysqli_set_charset($link, "utf8");
 
  $dname   = $_SESSION['reserve']['dname'];
  $dtelno  = $_SESSION['reserve']['dtelno'];
  $dmail   = $_SESSION['reserve']['dmail'];

  $message = $_SESSION['reserve']['message'];
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="./css/style.css" type="text/css">
  <title>LIBRARY</title>
</head>
<body>
  <!-- ヘッダー：開始-->
  <header id="header">
    <div id="pr">
      <p>記載事項の最終確認をして予約してください。</p>
    </div>
    <h1><a href="./index.php"></a></h1>
    <div id="contact">
    
    </div>
  </header>
  <!-- ヘッダー：終了 -->
  <!-- メニュー：開始 -->
  <nav id="menu">
    <ul>
      <li><a href="./index.php">ホーム</a></li>
      <li><a href="./bookList.php">分野別紹介</a></li>
      <li><a href="./bookReserveDetail.php">ご予約</a></li>
      <li><a href="./bookPurchase.php">購入</a></li>
    </ul>
  </nav>
  <!-- メニュー：終了 -->
  <!-- コンテンツ：開始 -->
  <div id="contents">
    <!-- メイン：開始 -->
    <main id="main">
      <article>
<!-- 各ページスクリプト挿入場所 -->
      <section>
        <form action="./bookReserveInsert.php" method="post">
        <h2>ご予約（最終確認）</h2>
        <p>予約内容をご確認後、よろしければ予約確定ボタンを押してください。</p>
        <h3>予約情報</h3>

          
        <br>
        <h3>利用者情報</h3>
        <table class="input">
          <tr><th>代表者氏名</th><td><?php echo $dname; ?></td></tr>
          <tr><th>連絡先</th><td><?php echo $dtelno; ?></td></tr>
          <tr><th>書籍名</th><td><?php echo $dmail; ?></td></tr>
        </table>
        <br>
        <h3>詳細情報</h3>
        <table class="input">
          
          <tr><th>連絡事項</th><td><?php echo $message; ?></td></tr>
        </table>
        <br>
        <input class="submit_a" type="submit" value="予約確定">
        <input class="submit_a" type="button" value="前の画面に戻る" onclick="history.back();">
        </form>
      </section>
      </article>
    </main>
    <!-- メイン：終了 -->
    <!-- サイド：開始 -->
    <aside id="side">
     
      <section>
        <h2>分野別紹介</h2>
<?php require_once("./sideList.php"); ?>
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
  //mysqli_free_result($result);
  //mysqli_close($link);
?>
</body>
</html>