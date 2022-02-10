<?php
  session_start();
  require_once('./dbConfig.php');
  $link = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
  if ($link == null) {
     die("接続に失敗しました：" . mysqli_connect_error());
  }
  mysqli_set_charset($link, "utf8");
// 新しいbook_orderIDを取得****************************************
  $maxsql = "SELECT MAX(order_id) AS maxid FROM book_order";
  $result = mysqli_query($link, $maxsql);
  $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
  $newid = $row['maxid'] + 1;
  
// book_order表に挿入****************************************
  $dname   = $_SESSION['reserve']['dname'];
  $dtelno  = $_SESSION['reserve']['dtelno'];
  $dmail   = $_SESSION['reserve']['dmail'];
  $sql = "INSERT INTO book_order (order_id, order_title, author, publisher) VALUES (?,?,?,?)";
  if ($stmt = mysqli_prepare($link, $sql)) {
     mysqli_stmt_bind_param($stmt, "isss", $newid, $dname, $dtelno, $dmail);
     mysqli_stmt_execute($stmt);
     mysqli_stmt_close($stmt);
  }
// 新しいreserve_noを取得****************************************
  $reserveDay = $_SESSION['reserve']['day'];
  $newsql = "SELECT MAX(reserve_no) AS maxno FROM reserve WHERE date(reserve_date) = '" . $reserveDay . "'";
  $result = mysqli_query($link, $newsql);
  $row = mysqli_fetch_array( $result, MYSQLI_ASSOC );
  $maxno = $row['maxno'];
  
  if (empty($maxno)) {	// その日初めての予約No
     $reserve = date('Ymd', strtotime($reserveDay));
     $reserveNo = $reserve . "01";
  } else {				// 他に予約がある場合
     $reserveNo = $maxno + 1;
  }

  mysqli_free_result($result);
  mysqli_close($link);
  unset($_SESSION['reserve']);	//予約情報を破棄
  $_SESSION['reserveNo'] = $reserveNo;	//予約番号を次画面へ
  header("location: ./bookPurchaseFinish.php");
?>