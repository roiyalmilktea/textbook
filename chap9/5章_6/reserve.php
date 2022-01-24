<?php
  if (empty($_GET["tid"]) == true) {
      $tid = "";
  } else {
      $tid = htmlspecialchars($_GET["tid"]);
  }
  $link = mysqli_connect("localhost" ,"jikkyo" ,"pass", "jikkyo_pension");
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
  <nav id="menu">
    <ul>
      <li><a href="./index.php">ホーム</a></li>
      <li><a href="./roomList.php">お部屋紹介</a></li>
      <li><a href="./reserve.php">ご予約</a></li>
    </ul>
  </nav>
  <!-- メニュー：終了 -->
  <!-- コンテンツ：開始 -->
  <div id="contents">
    <!-- メイン：開始 -->
    <main id="main">
      <article>
        <section>
          <h2>お部屋の予約</h2>

<?php
  if (empty($tid) == true) {
    $sql = "SELECT reserve, type_name, dayfee, main_image, room_no
      FROM room, room_type 
      WHERE room.type_id = room_type.type_id";
  } else {
    $sql = "SELECT room_name, type_name, dayfee, main_image, room_no
      FROM room, room_type 
      WHERE room.type_id = room_type.type_id
      AND room.type_id = {$tid}"; 
  }
  
?>

<form method="GET" action="reserved.php">
  <select>
	  お部屋を選択ください。
    <option value="subscribe">和室</option>
    <option value="subscribe">洋室</option>
    <option value="subscribe">特別室</option> 
    <option value="subscribe">野宿（夏限定）</option>
    <option value="subscribe">当日決める</option>
  </select>
  <button type="subscribe">送信</button>
  
</form>
  
  
   


