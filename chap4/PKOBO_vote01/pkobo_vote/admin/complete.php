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
//----------------------------------------------------------------------
//  ページ独自処理 (START)
//----------------------------------------------------------------------
	
	$id = (!empty($_GET['id'])) ? h($_GET['id']) : exit('パラメータがありません');
	$resDataArr = ID2Data($file_path,$id);
	
	$termArr = explode($dataSeparateStr,$resDataArr[3]);
	
//----------------------------------------------------------------------
//  ページ独自処理 (END)
//----------------------------------------------------------------------
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja" lang="ja">
<head>
<meta name="robots" content="noindex,nofollow" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>登録完了画面</title>
<link rel="stylesheet" type="text/css" href="./css/style.css">
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
<script type="text/javascript" src="./js/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="./js/common.js"></script>
</head>
<body>
<div id="container">
<div id="logoutBtn" class="linkBtn"><a href="?logout=true">ログアウト</a></div>
<div id="toPage" class="linkBtn"><a href="./">一覧へ</a></div>
<h1>登録完了画面</h1>
  
<h3 style="font-size:20px"><font color="red">以下の内容で登録が完了しました</font></h3>
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

</div>
</body>
</html>