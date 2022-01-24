<?php
	require_once('./include/admin_inc.php');
	require_once('./include/config.php');
	require_once('./include/admin_function.php');
//----------------------------------------------------------------------
//  ログイン認証処理 (START)
//----------------------------------------------------------------------
	session_name($session_name);
	session_start();
	authAdmin($userid,$password);
//----------------------------------------------------------------------
//  ログイン認証処理 (END)
//----------------------------------------------------------------------
	
	$id = (!empty($_GET['id'])) ? h($_GET['id']) : exit('パラメータがありません');//IDをセット
	
	if(isset($_POST['del_submit'])){
		
		//トークンチェック（CSRF対策）
		if(empty($_SESSION['token']) || ($_SESSION['token'] !== $_POST['token'])){
			exit('ページ遷移エラー(トークン)');
		}
		//トークン破棄
		$_SESSION['token'] = '';
		
		$id = (!empty($_POST['id'])) ? h($_POST['id']) : exit('パラメータがありません');	
		if(!is_num($id)) exit;
		
		$lines = file($file_path);
		$fp = fopen($file_path, "r+b") or die("ファイルオープンエラー");
		
		// 俳他的ロック
		if (flock($fp, LOCK_EX)) {
			ftruncate($fp,0);
			rewind($fp);
			foreach($lines as $val){
				$lines_array = explode(",",$val);
				if($lines_array[0] != $id){
				  fwrite($fp, $val);
				}
			}
		}
		  
		fflush($fp);
		flock($fp, LOCK_UN);
		fclose($fp);
	
		//アップファイル削除
		for($i=0;$i<$maxCommentCount;$i++){
			foreach($extensionList as $val){
				$upFilePath = $img_updir.'/'.$id.'-'.$i.'.'.$val;
				$upFilePathThumb = $img_updir.'/'.$id.'-'.$i.'s.'.$val;
				
				if(file_exists($upFilePath)){
					unlink($upFilePath);
				}
				if(file_exists($upFilePathThumb)){
					unlink($upFilePathThumb);
				}
			}
		}
		
		//投票データファイルを削除
		$vote_file_path = str_replace('__id__',$id,$vote_file_path);//投票データ保存先ファイルパス
		if(file_exists($vote_file_path)) unlink($vote_file_path);
		
	
	}else{
		$resDataArr = ID2Data($file_path,$id);
		$termArr = explode($dataSeparateStr,$resDataArr[3]);
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja" lang="ja">
<head>
<meta name="robots" content="noindex,nofollow" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>データ削除</title>
<link rel="stylesheet" type="text/css" href="./css/style.css">
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
<script type="text/javascript" src="./js/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="./js/common.js"></script>
</head>
<body>
<div id="container">
<div id="logoutBtn" class="linkBtn"><a href="?logout=true">ログアウト</a></div>
<div id="toPage" class="linkBtn"><a href="./">一覧へ</a></div>
  <h1>データ削除</h1>

<?php if(isset($_POST['del_submit'])){ ?>
<?php if(!empty($messe)) echo $messe; ?>
<p class="col19 big taC">削除が完了しました。</p> 
<p class="col19 taC"><a href="./">一覧へ</a></p>
<?php }else{ ?>

<form method="post" action="">
<?php
//トークンセット
$token = sha1(uniqid(mt_rand(), true));
$_SESSION['token'] = $token;
?>
<input type="hidden" name="token" value="<?php echo $token;//トークン発行?>" />
<p class="taC">このデータを削除するにはクリックしてください。（投票データも削除されます）</p>
<p class="taC"><input type="submit" name="del_submit" value="　このデータを削除する" class="submitBtn" /></p>
<input type="hidden" name="id" value="<?php echo $id;?>" />
</form>
  <table class="borderTable01">
    <tr>
      <th>登録年月日</th>
      <td align="left"><?php echo date('Y年n月j日',strtotime($resDataArr[1]));?></td>
      </tr>
  <tr>
	<th style="width:20%">公開・非公開</th><td><?php echo $resDataArr[2] == 1 ? '公開':'非公開';?></td>
  </tr>
    
    <tr>
      <th>タイトル</th>
      <td><?php echo TextToKanma($resDataArr[4]);?></td>
    </tr>
    
      <tr>
        <th>説明文</th>
        <td><?php echo TextToKanma($resDataArr[5]);?></td>
      </tr>
    <tr>
      <th>表示期間</th>
      <td>
	  <?php echo ($resDataArr[3] != 0) ? date2FormatDateTerm($termArr[0]).' ～ '.date2FormatDateTerm($termArr[1]) : '無期限';?>
	 </td>
    </tr>
</table>

<table class="borderTable01">
<?php 
$commentArr = explode($dataSeparateStr,$resDataArr[6]);
$linkArr = explode($dataSeparateStr,$resDataArr[7]);
for($i=0;$i<=$maxCommentCount;$i++){
	
	//ファイル存在判定と存在したらセット
	$upfileTag = '';
	foreach($extensionList as $val){
		$upFilePath = $img_updir.'/'.$resDataArr[0].'-'.$i.'.'.$val;
		if(file_exists($upFilePath)){
			
			if($val == 'jpg' || $val == 'png' || $val == 'gif'){
				$upfileTag .= "<img src=\"{$upFilePath}?".uniqid()."\">\n";
			}else{
				$upfileTag .= "<a href=\"{$upFilePath}\" target=\"_blank\">アップファイル</a>\n";
			}
			
			break;
		}
	}
	if(!empty($commentArr[$i]) || !empty($upfileTag)){
?>
<tr>
<th><?php echo $i + 1;?>.項目名</th>
<td><?php echo (!empty($commentArr[$i])) ? TextToKanma($commentArr[$i]) : '';?></td>
</tr>
<tr>
<th><?php echo $i + 1;?>.ファイル</th>
<td><?php echo $upfileTag;?></td>
</tr>
<tr>
<th><?php echo $i + 1;?>.リンクURL</th>
<td><?php echo (!empty($linkArr[$i])) ? '<a href="'.$linkArr[$i].'" target="_blank">'.TextToKanma($linkArr[$i]).'</a>' : '';?></td>
</tr>
<tr>
<td colspan="3" style="border:0;height:10px;padding:0"></td>
</tr>
<?php 
	} 
}
?>   
</table>
<p class="pagetop linkBtn taR"><a href="#container">PAGE TOP▲</a></p>
<?php } ?>
</div> 
</body>
</html>