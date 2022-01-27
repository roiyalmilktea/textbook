<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <link href="./css/style.css" rel="stylesheet" type="text/css">
  <title>library</title>
</head>
<body>
  <!-- ヘッダー：開始-->
  <header id="header">
    <div id="pr">
      <p></p>
    </div>
    <h1><a href="./index.php"><img src="./images/welcome.png" alt=""></a></h1>
    <div id="contact">
      <h2>ご予約／お問い合わせ</h2>
      <span class="tel">☎0120-000-000</span>
    </div>
  </header>
  <!-- ヘッダー：終了 -->
  <!-- メニュー：開始 -->
<?php include("./topmenu.php"); ?>
  <!-- メニュー：終了 -->
  <!-- アイキャッチ：開始 -->
  <div id="icatch">
    <img src="./images/background.jpg" alt="">
  </div>
  <!-- アイキャッチ：終了 -->
  <!-- コンテンツ：開始 -->
  <div id="contents">
    <!-- メイン：開始 -->
    <main id="main">
      <article>
        <section>
          <h2><img class="small" src="./images/new.png"><br>更新情報</h2>
          <dl class="information">
            <dt>2016-02-15</dt>
            <dd>
              サイトオープンしました。
            </dd>
          </dl>
        </section>
        <section>
          <h2><img class="small" src="./images/about.png"><br>サイトの目的について</h2>
          <h3>読んできた中でおすすめの本を紹介</h3>
          <p>
            主にWeb、serverなどの技術書を中心に紹介します。
            <br>分野ごとに細分化しているので、参考になれば幸いです。
          </p>
          <h3>Webアプリケーションセキュリティ</h3>
          <p>
            Webアプリケーションは今や誰もが恩恵を受けています。しかし、その一方で自分の利用するアプリケーション、Webサイトの
            <br> セキュリティに対する知識は知らないと危険です。そこで、Webセキュリティの概念から専門的な技術書を紹介します。
          </p>
          <h3>ローレイヤーセキュリティ</h3>
          <p>
            自分の好きな分野のセキュリティ技術です。Linuxの基礎からリバースエンジニアリングの技術を紹介します。
            <br>マニアックな部分なので利用数は少ないと思います。
          </p>
          <h3>職業・進路</h3>
          <p>
            就職活動で使う本やキャリアに参考になる書籍を集めました。
          </p>
        </section>
      </article>
    </main>
    <!-- メイン：終了 -->
    <!-- サイド：開始 -->
    <aside id="side">
      <section>
        <h2>一日貸し切りサービス</h2>
        <ul>
          <li><a href="#">利用日入力</a></li>
        </ul>
      </section>
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
    this website desinged for beginner.
  </footer>
  <!-- フッター：終了 -->
</body>
</html>