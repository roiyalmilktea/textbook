<?php
session_start();
if (isset($_SESSION['reserveNo']) == false) {
    header("location: ./index.php");
    exit;
}
$reserveNo = $_SESSION['reserveNo'];
unset($_SESSION['reserveNo']);
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
      <p>さっそく読んでみよう！</p>
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
      <li><a href="./bookList.php">お部屋紹介</a></li>
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
          <h2>予約完了</h2>
          <p>予約が完了しました。以下の予約番号を控えておいてください。</p>
          <h3>予約情報</h3>
          <table class="input">
            <tr><th>予約番号</th><td><?php echo $reserveNo; ?></td></tr>
          </table>
          <br>
          <p>予約完了です。</p>
          <a class="submit_a" href="./index.php">トップページへ</a>
        </section>
      </article>
    </main>
    <!-- メイン：終了 -->
    <!-- サイド：開始 -->
    <aside id="side">
      <section>
        
      <section>
        
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
</body>
</html>
