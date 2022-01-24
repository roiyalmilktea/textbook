<?php
include "system02c.php";
include "common.php";
const THIS_FILE = EDIT_FILE;
include COMMON_BBS_FILE;
$str_charset = "UTF-8";
// ページサイズ
$page_size = 5;
?>
<html>
<head>
<meta http-equiv="content-type" content="text/html;charset=utf-8" >
<title>BBS2</title>
<meta http-equiv="Content-Style-Type" content="text/css">
<link rel="stylesheet" type="text/css" href="common.css">
</head>
<body class="b_ffff99">
<?php
 // データベースへの接続と選択
 require_once('./Connections/localhost.php');
  //var_dump($_post);
 $mysqli = new mysqli($hostname, $username, $password, $database);
 
 //クライアント文字コードの通知（文字化け防止）
 $str_sql = "set names utf8;";
 $rs = $mysqli->query($str_sql);
?>
<!-- 「記事入力」，「全記事表示」のハイパーリンクの表示 -->
<p class="ac">
<a href="<?=MAIN_FILE?>">記事入力</a> ｜ 
<a href="<?=MAIN_FILE?>?page=all">全記事表示</a><br><br>
</p>
<?php
 // 「削除」リンクをクリックした場合
 if(isset($_GET['command'])&&$_GET['command'] == "del")
 {
  // 記事番号の受信
  $message_id = $_GET['id'];

  if($message_id > 0)
  {
   // 当該記事の検索
   $str_sql = "select * from tbl_bbs2"
        . " where message_id = {$message_id};";
   $rs = $mysqli->query($str_sql);

   if($rs->num_rows === 1)
   {
    $arr_record = $rs->fetch_assoc();

    // 記事データの配列への格納
    $arr_message = array();
    $arr_message['id']    = $arr_record['message_id'];
    $arr_message['name']   = $arr_record['name'];
    $arr_message['title']  = $arr_record['title'];
    $arr_message['message'] = $arr_record['message'];
    $arr_message['date']   = $arr_record['date'];
    $arr_message['url']   = $arr_record['url'];

    print "<p class='ac'>";
    print "パスワードを記入し，「削除」ボタンをクリックしてください<br>\n";
    // 1個の記事本文の表示
    message_show($arr_message);

    $message_id = $arr_message['id'];
    print "<form action='".THIS_FILE."' method='post'>\n";
    print "パスワード<input type='password' name='pwd'>\n";
    print "<input type='hidden' name='id' value='{$message_id}'>\n";
    print "<input type='submit' name='command' value='削除'>\n";
    print "<input type='submit' name='command' value='キャンセル'>\n";
    print "</form>\n";
    print "</p>\n";
    print "<br>\n";

   }
   mysqli_free_result($rs);
   $mysqli->close(); 
  }
 }
// 「更新」リンクをクリックした場合
else if(isset($_GET['command'])&&$_GET['command'] == "update")
{
	// 記事番号の受信
	$message_id = $_GET['id'];
	if($message_id > 0)
	{
		// 当該記事の検索
		$str_sql = "select * from tbl_bbs2"
		. " where message_id = {$message_id};";
		$rs = $mysqli->query($str_sql);
		if($rs->num_rows == 1)
		{
			$arr_record = $rs->fetch_assoc();

			// 記事データの配列への格納
			$arr_message = array();
			$arr_message['id'] = $arr_record['message_id'];
			$arr_message['name'] = $arr_record['name'];
			$arr_message['title'] = $arr_record['title'];
			$arr_message['message'] = $arr_record['message'];
			$arr_message['date'] = $arr_record['date'];
			$arr_message['url'] = $arr_record['url'];
			print "<p class='ac'>";
			print "パスワードを記入し，「更新」ボタンをクリックしてください<br>\n";
			// 1個の記事本文の表示
			message_show($arr_message);
			$message_id = $arr_message['id'];
			print "<form action='" . THIS_FILE . "' method='post'>\n";
			print "パスワード<input type='password' name='pwd'>\n";
			print "<input type='hidden' name='id' value='{$message_id}'>\n";
			print "<input type='submit' name='command' value='更新'>\n";
			print "<input type='button' value=戻る' "
			. "onClick='history.back()'>\n";
			print "</form>\n";
			print "</p>\n";
			print "<br>\n";
		}
		mysqli_free_result($rs);
		$mysqli->close();
	}
}

 if(isset($_POST['command'])&&$_POST['command'] == "削除")
 {
  // データの受信
  $message_id = $_POST['id'];
  $str_pwd   = $_POST['pwd'];

  $str_pwd  = trim($str_pwd);
  print "<p class='ac'>\n";
  if(preg_match(MATCH_PWD,$str_pwd))
  {
   // パスワードの暗号化
   $enc_pwd = "";
   if($str_pwd != "")
   { 
    $enc_pwd = crypt($str_pwd,SALT);
   } 
   // 削除用SQL文
   $str_sql = "delete from tbl_bbs2 "
        . "where message_id = {$message_id} and pwd = '{$enc_pwd}';";

   $rs = $mysqli->query($str_sql);
   // 削除されたレコード数の取得
   $del_rows = $mysqli->affected_rows;

   if($del_rows > 0)
   {
    print "記事を削除しました．<br><br>\n";
   }
   else
   {
    print "記事は削除できませんでした．<br><br>\n";
    print "<input type='button' value='戻る' "
      . "onclick='history.back()'><br>\n";
   }
  }
  else
  {
   print "記事は削除できませんでした．<br><br>\n";
   print "<input type='button' value='戻る' "
         . "onClick='history.back()'><br>\n";
  }
  print "</p>\n";
 }
// 「更新」実行の場合
elseif(isset($_POST['command'])&&$_POST['command'] == "更新")
{
	// データの受信
	$message_id = $_POST['id'];
	$str_pwd = $_POST['pwd'];

	$str_pwd = trim($str_pwd);
	if(preg_match(MATCH_PWD,$str_pwd))
	{
		// パスワードの暗号化
		$enc_pwd = "";
		if($str_pwd != "")
		{ 
			$enc_pwd = crypt($str_pwd,SALT);
			// 更新用SQL文
			$str_sql = "select * from tbl_bbs2 "
			. "where message_id = {$message_id} and pwd = '{$enc_pwd}';";
			
			$rs = $mysqli->query($str_sql);
			// 検索されたレコード数の取得
			$select_rows = $rs->num_rows; 
			 if($select_rows > 0)
			{
				// 検索結果リソースの連想配列への格納
				$arr_record = $rs->fetch_assoc();
				// 記事データの変数への格納
				$str_name = $arr_record['name'];
				$str_title = $arr_record['title'];
				$str_message = $arr_record['message'];
				$str_date = $arr_record['date'];
				$str_url = $arr_record['url'];
				$str_update = $arr_record['date_update'];
				// 記事更新画面の表示
				update_form_disp($message_id,$str_name,$str_title,$str_message
				,$str_date,$str_update,$str_url,$str_pwd);
			}
			else
			{
				print "記事は更新できません．<br><br>\n";
				print "<input type='button' value='戻る' "
				. "onclick='history.back()'><br>\n";
			}
		}
	}
}
	// 「送信」の場合
	elseif(isset($_POST['command'])&&$_POST['command'] == "送信")
	{
		// 受信データのチェック
		$str_error_message = data_check($str_name,$str_title,$str_message
		,$str_url,$str_pwd);
		if($str_error_message == "")
		{
			// 記事データの配列への格納
			$message_id = $_POST['id'];
			$str_date = $_POST['date'];
			$str_update = $_POST['update'];

			$arr_message = array();
			$arr_message['id'] = $message_id;
			$arr_message['name'] = $str_name;
			$arr_message['title'] = $str_title;
			$arr_message['message'] = $str_message;
			$arr_message['date'] = $str_date;
			$arr_message['url'] = $str_url;

			print "内容を確認し，「OK」ボタンをクリックしてください<br>\n";
			// 1個の記事本文の表示
			message_show($arr_message);

			// 改行タグの改行コードへの変換
			$str_message = tag_entity_form($str_message);
			if($str_url == "")
			{
				$str_url = "http://";
			}
			print "<form action='" . THIS_FILE . "' method='post'>\n";
			print "<input type='hidden' name='id' value='{$message_id}'>\n";
			print "<input type='hidden' name='name' value='{$str_name}'>\n";
			print "<input type='hidden' name='title' value='{$str_title}'>\n";
			print "<input type='hidden' name='message' value='{$str_message}'>\n";
			print "<input type='hidden' name='url' value='{$str_url}'>\n";
			print "<input type='hidden' name='pwd' value='{$str_pwd}'>\n";
			print "<input type='submit' name='command' value='OK'>\n";
			print "<input type='button' value='戻る' "
			. "onClick='history.back()'>\n";
			print "</form>\n";
			print "<br>\n";
		}
	}
	// 「OK」の場合
	elseif(isset($_POST['command'])&&$_POST['command'] == "OK")
	{
		// 受信データのチェック
		$str_error_message = data_check($str_name,$str_title,$str_message
		,$str_url,$str_pwd);
		if($str_error_message == "")
		{
			// データの受信
			$message_id = $_POST['id'];
			// 現在日時の取得
			$str_update = date("Y-m-d H:i:s",time());
			$str_name = $mysqli->real_escape_string($str_name);
			$str_title = $mysqli->real_escape_string($str_title);
			$str_message = $mysqli->real_escape_string($str_message);

			if($str_pwd !="")
			{
				// パスワードの暗号化
				$enc_pwd = crypt($str_pwd,SALT);
				// データのテーブルへの保存
				$str_sql = "update tbl_bbs2 "
				. "set name = '" . $str_name . "',"
				. " title = '" . $str_title . "',"
				. " message = '" . $str_message . "',"
				. "date_update = '" . $str_update . "',"
				. " url = '" . $str_url . "',"
				. " pwd = '" . $enc_pwd . "'"
				. " where message_id = " . $message_id . ";";
				if(!$mysqli->query($str_sql))
				{
					print "<br>ERROR_NO=" . mysqli_errno($mysqli) . ":"
					. mysqli_error($mysqli) . "<br>}";
				}
			}
			// テーブルのデータの一覧取得（最後に「;」をつけない）
			$str_sql = "select * from tbl_bbs2 order by message_id desc";
			 // 第１ページ目の設定
			$page = 1;
			 // ページ単位表示
			page_disp($str_sql,$page,$page_size,$mysqli);

			$mysqli->close();
		}
		else
		{
			print "<font style='color:red'>{$str_error_message}</font><br>\n";
			// 更新画面の再表示
			update_form_disp($message_id,$str_name,$str_title,$str_message
			,$str_date,$str_update,$str_url,$str_pwd);
		}
	}

 
?>