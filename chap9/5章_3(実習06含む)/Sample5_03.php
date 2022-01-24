<?php
  $param = $_POST['param'];
  if (empty($param) == true){
    echo "未入力です";
  } else {
    echo "前画面から送信されたデータは「{$param}」です";
  }
?>