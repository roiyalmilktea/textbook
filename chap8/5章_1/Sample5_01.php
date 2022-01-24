<?php
  $link = mysqli_connect("localhost", "jikkyo", "pass", "jikkyo_pension");
  if ($link == null) {
    die("接続に失敗しました".mysqli_connect_error());
  }

  mysqli_set_charset($link, "utf8");
  $result = mysqli_query($link, "SELECT * FROM room_type");
  echo "[データ件数]:" . mysqli_num_rows($result) . "件<br />";
  while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
    echo $row['type_name'] . "<br>";
  }

  $result = mysqli_query($link, "SELECT * FROM cnt");
  
  echo "[過去の利用者]:" . mysqli_num_rows($result) . "件<br />";
  
  while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
    echo $row['names'] . "<br>";
  }

  $result = mysqli_query($link, "SELECT * FROM cnt");
  echo "[ユーザランク]:" . mysqli_num_rows($result) ."（過去の利用者順に表記） <br />";
  while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
    echo $row['status'] . "<br>";
  }

  
  
  mysqli_free_result($result);
  mysqli_close($link);
?>

