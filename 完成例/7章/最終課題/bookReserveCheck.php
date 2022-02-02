<?php
  session_start();
  $dname   = htmlspecialchars($_POST["dname"]);
  $dtelno  = htmlspecialchars($_POST["dtelno"]);
  $dmail   = htmlspecialchars($_POST["dmail"]);
  $message = htmlspecialchars($_POST["message"]);
// 入力値をセッションに格納する
  $_SESSION['reserve']['dname'] = $dname;
  $_SESSION['reserve']['dtelno'] = $dtelno;
  $_SESSION['reserve']['dmail'] = $dmail;
  $_SESSION['reserve']['reserveNumber'] = $reserveNumber;
  $_SESSION['reserve']['checkin'] = $checkin;
  $_SESSION['reserve']['message'] = $message;
  
// エラーメッセージを格納する
  $errMsg = array();

  // 未入力チェック******************************
  if (empty($dname) == true) {
      $errMsg['dname'] = "名前が未入力です";
  }
  if (empty($dtelno) == true) {
      $errMsg['dtelno'] = "電話番号が未入力です";
  }

  if (count($errMsg) == 0) {    // エラーがなかった場合
      header("location: ./bookReserveConfirm.php");
      
  }else {             			  // 入力エラーがあった場合
      $_SESSION['errMsg'] = $errMsg;  // エラー内容をセッションに格納する
      header("location: ./bookReserveDetail.php?rno=". $_SESSION['reserve']['roomno']);
  }
  exit();
?>