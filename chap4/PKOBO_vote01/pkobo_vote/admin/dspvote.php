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


$id = (!empty($_GET['id'])) ? h($_GET['id']) : exit();
$getFormatDataArr = getLines2DspData($file_path,$img_updir,$config,$id,'admin');
$data = (!empty($getFormatDataArr)) ? $getFormatDataArr : exit('データが存在しません');
$vote_file_path = str_replace('__id__',$id,$vote_file_path);//投票データ保存先ファイルパス
$getCount = getExixtsVoteCount($maxCommentCount,$data);

//帳票クリア
if(isset($_POST['vote_clear'])){

	$line = file($vote_file_path);
	$lineArr = explode(',',$line[0]);
	
	$writeData = $lineArr[0].','.str_repeat('0'.$dataSeparateStr,$getCount);
	$writeData = rtrim($writeData,$dataSeparateStr);
	
	$fp = fopen($vote_file_path, "r+b") or die("ファイルオープンエラー");
	flock($fp, LOCK_EX);
	ftruncate($fp,0);
	rewind($fp);
	fwrite($fp, $writeData);
	fflush($fp);
	flock($fp, LOCK_UN);
	fclose($fp);
}

$voteArr = getVoteCount($vote_file_path,$dataSeparateStr);//投票数セット
//----------------------------------------------------------------------
//  ページ独自処理 (END)
//----------------------------------------------------------------------
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja" lang="ja">
<head>
<meta name="robots" content="noindex,nofollow" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>一覧画面</title>
<link rel="stylesheet" type="text/css" href="./css/style.css">
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
<script type="text/javascript" src="./js/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="./js/common.js"></script>
<!--▼▼▼既存ページヘの埋め込み時はコピペ下さい（head部分に）▼▼▼-->
<style type="text/css">
/* CSSは必要最低限しか指定してませんのでお好みで（もちろん外部化OK） */

/* clearfix */
.clearfix:after { content:"."; display:block; clear:both; height:0; visibility:hidden; }
.clearfix { display:inline-block; }

/* for macIE \*/
* html .clearfix { height:1%; }
.clearfix { display:block; }

body{
	font-family:"メイリオ", Meiryo, Osaka, "ＭＳ Ｐゴシック", "MS PGothic", sans-serif;
	font-size:13px;
}
h2{
	font-size:16px;
	color:#369;
	margin:10px 0px 10px 0;
	font-weight:normal;
	border-bottom:3px solid #3D79B6;
	padding:0px;
}
ul#voteArea{
	margin:10px 0;
	padding:0;
}
ul#voteArea li{
	width:150px;
	height:180px;
	float:left;
	margin:0 5px 5px 0;
	overflow:hidden;
	border:1px solid #ccc;
	padding:10px;
	text-align:center;
	list-style-type:none;
	position:relative;
}
.detailText{
	font-size:11px;	
}
.detailUpfile img{
	max-width:100%;
	height:auto;
	margin:0 0 5px;
}
#termYmd{
	margin:5px 0;
}
.borderGraph{
	background:#F00;
	display:inline-block;
	height:20px;
	max-width:600px;
}
</style>
<script>
$(function(){
	$('#vote_clear').click(function(){
		if(!confirm('投票をクリアします。よろしいですか？')){
			return false;
		}else{
			return true;
		}
	});
});
</script>

</head>
<body>
<div id="container">
<div id="logoutBtn" class="linkBtn"><a href="?logout=true">ログアウト</a></div>
<div id="toRegist" class="linkBtn"><a href="regist.php">新規登録</a></div>
<div id="toPHPINI" class="linkBtn"><a href="./">管理画面トップ</a></div>

<h1>投票結果確認ページ</h1>

<form method="post" action="">
<p class="taC"><input type="submit" name="vote_clear" value="この投票データをクリアする（すべて「0」にする）" class="submitBtn" id="vote_clear" /></p>
</form>


<?php if(!$copyright){echo $warningMesse;exit;}else{ ?>


<h2 class="mt10"><?php echo h($data['title']);//タイトル表示?></h2>
<div id="description"><?php echo strip_tags($data['description'],'<br /><br>');//説明文表示?></div>
<div id="termYmd">期間：<?php echo ($data['term'] != 0) ? date2FormatDateTerm(h($data['term_start'])).' ～ '.date2FormatDateTerm(h($data['term_end'])) : '無期限';//期間表示?></div>


<table class="borderTable01">
<tr>
<th>項目名</th>
<th>画像</th>
<th style="width:50%;">投票数（簡易グラフ付き）</th>
</tr>

<?php for($i=0;$i<$getCount;$i++){ ?>
<tr>
<td><div class="detailText"><?php echo (!empty($data['comment'][$i])) ? strip_tags($data['comment'][$i],'<br /><br>') : '';//項目表示?></div></td>
<td>
<div class="detailUpfile"><?php echo (!empty($data['upfile_path_thumb'][$i])) ? '<img src="'.$data['upfile_path_thumb'][$i].'?'.uniqid().'" width="100" />' : '';//画像タグ（「upfile_path」を「upfile_path_thumb」とすればサムネイル表示します）?></div>
</td>
<td>
<?php echo (!empty($voteArr[$i])) ? $voteArr[$i] : '0';?> <span class="borderGraph" style="width:<?php echo (!empty($voteArr[$i])) ? $voteArr[$i] : '0';?>px">　</span>
</td>
</tr>
<?php } ?>
</table>



<p class="pagetop linkBtn taR"><a href="#container">PAGE TOP▲</a></p>
<?php cpyright();}//著作権表記削除不可?>

</div>
</body>
</html>