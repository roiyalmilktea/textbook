<html>
<head>
<meta http-equiv="content-type" content="text/html;charset=utf-8" >
<title>BBS1</title>
</head>
<body>
<?php

require_once('./Connections/localhost.php');

// 「送信」の場合
if(isset($_POST['command'])&&$_POST['command'] == "送信")
{
 // データの受信
 $str_name   = $_POST['name'];
 $str_title  = $_POST['title'];
 $str_message = $_POST['message'];

 // 改行コードを改行タグに変換
 $str_message = preg_replace( "/(\r\n|\r|\n)/", "<br />", $str_message);

 // 現在日時の取得
 $str_date = date("Y-m-d H:i:s",time());

 // 「message_id」の生成
 // データベースへの接続
$mysqli = new mysqli($hostname, $username, $password, $database);
 
 //クライアント文字コードの通知（文字化け防止）
 $str_sql = "set names utf8;";
 $rs = $mysqli->query($str_sql); 

 // tbl_bbs1テーブルのmessage_idの最大値の取得
 $str_sql 
   = "select max(message_id) as max_id from tbl_bbs1;";
 $rs = $mysqli->query($str_sql);

 $arr_record = array();
 $arr_record = $rs->fetch_assoc();
 $max_id = $arr_record['max_id'];

 if($max_id > 0)
 {
  $new_id = $max_id + 1;
 }
 else
 {
  $new_id = 1;
 }

 // データのテーブルへの保存
 $str_sql = "insert into tbl_bbs1 "
      . "(message_id,name,title,message,date)"
      . "values("
      . $new_id   . ",'" . $str_name   . "','" 
      . $str_title . "','" . $str_message . "','" 
      . $str_date . "');";

 $mysqli->query($str_sql);

 // テーブルのデータの一覧取得
 $str_sql = "select * from tbl_bbs1 order by message_id desc;";

 $rs = $mysqli->query($str_sql);

 // データの表示
 while($arr_record = $rs->fetch_assoc())
 {
  $message_id = $arr_record['message_id'];
  $str_name  = $arr_record['name'];
  $str_title  = $arr_record['title'];
  $str_message = $arr_record['message'];
  $str_date  = $arr_record['date'];

?>
  <p align=center>
  <table border="1" cellpadding="3" cellspacing="0" width="600">
  <tr>
   <td width="60">No.</td><td width="440"><?=$message_id?></td>
  </tr>
  <tr>
   <td>氏名</td><td><?=$str_name?></td>
  </tr>
  <tr>
   <td>タイトル</td><td><?=$str_title?></td>
  </tr>
  <tr>
   <td>記事</td><td><?=$str_message?></td>
  </tr>
  <tr>
   <td>日時</td><td><?=$str_date?></td>
  </tr>
  </table>
  </p>
  <br>
<?php
 }
 //結果セットを破棄し，接続を閉じる
 mysqli_free_result($rs);
 $mysqli->close();
}
?>
 <p align=center>
 <table border="0">
 <form method="post">
 <tr>
  <td> </td><td>BBS1</td>
 </tr>
 <tr>
  <td>氏名</td><td><input name="name" size="30"></td>
 </tr>
 <tr>
  <td>タイトル</td><td><input name="title" size="60"></td>
 </tr>
 <tr>
  <td>記事</td>
  <td><textarea name="message" rows="5" cols="60"></textarea></td>
 </tr>
 <tr>
  <td> </td>
  <td><input type=submit name="command" value="送信"></td>
 </tr>
 </form>
 </table>
 </p>
</body>
</html>