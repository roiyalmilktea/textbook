<?php
  $param = $_POST['param'];
  if (empty($param) == true){
    echo "未入力です";
  } else {
    echo "前画面から送信されたデータは「{$param}」です";
  }
  // 実習６の解答＆ステップアップ
  echo "<br>";
  if (isset($_POST['gender']) == false) {
	  echo "性別の入力項目が未入力です";
  } else {
      $gender = $_POST['gender'];
  	  echo "入力された性別は「{$gender}」です";
  }
  echo "<br>";
  $age = $_POST['age'];
  if (empty($age) == true) {
	  echo "年齢の入力項目が未入力です";
  } else {
  	  echo "入力された年齢層は「{$age}」です";
  }
  echo "<br>";
  $birth = $_POST['birth'];
  if (empty($birth) == true) {
	  echo "誕生日の入力項目が未入力です";
  } else {
  	  echo "入力された誕生日は「{$birth}」です";
  }
?>