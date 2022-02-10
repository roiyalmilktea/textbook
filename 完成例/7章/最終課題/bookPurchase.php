<?php

  session_start();
  $dnameErr = "";
  if (isset($_SESSION['errMsg']['dname'])) {
    $dnameErr = "<span style='color: red;'>" . $_SESSION['errMsg']['dname'] ."</span>";
  }
  unset($_SESSION['errMsg']); // すべてのエラーメッセージをクリア
  // require_once('./dbConfig.php');
  // $link = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
  // if ($link == null) {
  //   die("接続に失敗しました：" . mysqli_connect_error());
  // }
  // mysqli_set_charset($link, "utf8");


  $dname = "";
  if (isset($_SESSION['reserve']['dname']) == true) {
      $dname = $_SESSION['reserve']['dname'];
  }
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
      <p>Web上に希望図書が無ければ購入できます。</p>
    </div>
    <h1><a href="./index.php"><img src="./images/logo.png" alt=""></a></h1>
    <div id="contact">
   
    </div>
  </header>
  <!-- ヘッダー：終了 -->
  <!-- メニュー：開始 -->
  <nav id="menu">
    <ul>
      <li><a href="./index.php">ホーム</a></li>
      <li><a href="./bookList.php">分野別紹介</a></li>
      <li><a href="./bookReserveDetail.php">予約</a></li>
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
    <h2>ご予約（詳細情報の入力）</h2>

    </table><br />
    <h3>代表者情報</h3>
    <form method="post" action="bookPurchaseCheck.php" >
      <table class="input">
        <tr>
          <th>タイトル</th>
          <td><input type="text" name="dname" value="<?php echo $dname; ?>" /><?php echo $dnameErr; ?></td></tr>
        <tr>
          <th>著者名</th>
          <td><input type="text" name="dtelno" value="" /></td></tr>
        <tr>
          <th>出版社</th>
          <td><input type="text" name="dmail" value="" /></td></tr>
      </table><br />
    <h3>予約書籍詳細</h3>

     
    
          <th>連絡事項</th><td><textarea name="message" cols="40" rows="4"></textarea></td>
        </tr>
      </table><br />
    <p>まだ予約は確定しておりません。次の画面で確定させてください。</p>
    <input class="submit_a" type="submit" value="予約確認" />
    <input class="submit_a" type="button" value="前の画面に戻る" onclick="history.back();" />
    </form>
  </section>
      </article>
    </main>
    <!-- メイン：終了 -->
    <!-- サイド：開始 -->
    <aside id="side">
      <section>
       
      </section>
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
  //mysqli_free_result( $result );
  // mysqli_close( $link );
?>
</body>
</html>
