<?php
  session_start();
  //login.htmlから"username"と"pass"を受け取る
  $_SESSION["loginname"] = $_POST["username"];
  $_SESSION["pass"] = $_POST["pass"];

  //"username"と"pass"が一致すればログイン成功画面に移行する
  if($_SESSION["loginname"] != "bl16031" || $_SESSION["pass"] != "pass"){
      ?>
      ログインに失敗しました。<br />
      <a href="login.html">ログイン画面へ</a>
      <?php

      echo "<script>alert('ログイン失敗');</script>";

      exit;
  }
  if(isset($_POST["username"])) setcookie("username", $_POST["username"], time()+120);
?>
<link rel="stylesheet" type="text/css" href="web.css">
ログイン認証に成功しました。<br />
現在ログインしている状態です。<br />
<a href="index.php">マイページへ</a>
