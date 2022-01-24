<?php //▼▼▼ 既存ページヘ埋め込み時はまるっとコピペ下さい （この行も含みページ最上部に）※.phpでかつUTF-8のページのみ可▼▼▼
//※逆にこのページに対して既存のページのhtmlを記述する形でももちろんOKですし、このページをiframeで読み込んでもOKです。
//【それぞれの投票項目に投票ボタンが付いているバージョンのファイル】（ラジオボタンでの投票を希望の場合はvote_radio.phpを使用下さい）
//----------------------------------------------------------------------
// 設定ファイルの読み込みとページ独自設定（START）必要に応じて変更下さい。
//----------------------------------------------------------------------
include_once("./pkobo_vote/admin/include/config.php");//（必要に応じてパスは適宜変更下さい）
$img_updir = './pkobo_vote/upload';//画像保存ディレクトリのパス（必要に応じてパスは適宜変更下さい）

/* ▽オプション設定▽ */

//このページで表示する投票、アンケートのID番号（ID番号は管理画面で確認できます）
//パラメータでも指定可能です。（例「vote.php?id=18」であればIDが18の投票データが表示されます）
//パラメータで指定された場合、この設定値は無視されます。（パラメータが優先されるということです）
$voteID = 1;

//このページの文字コード（埋め込み先ページの文字コードに合わせてください　※大文字小文字は区別されません）
$config['encodingType'] = 'UTF-8';//Shift_JISの場合は「SJIS」として下さい。

//----------------------------------------------------------------------
// 設定ファイルの読み込みとページ独自設定（END）
//----------------------------------------------------------------------

//以下変更不可
$id = (!empty($_GET['id'])) ? h($_GET['id']) : $voteID;
$getFormatDataArr = getLines2DspData($file_path,$img_updir,$config,$id);
$data = (!empty($getFormatDataArr)) ? $getFormatDataArr : array();
$vote_file_path = str_replace('__id__',$id,$vote_file_path);//投票データ保存先ファイルパス
$getCount = getExixtsVoteCount($maxCommentCount,$data);

//投票保存設定
$messe = '';
if(isset($_POST['data']['vote'])){
	$messe = voteCheck($data,$vote_file_path,$dataSeparateStr,$voteMesse,$cookiedays,$usecookie);
}elseif(isset($_POST['data']['vote_count'])){
	$messe = $voteMesse['empty'];
}
$voteArr = getVoteCount($vote_file_path,$dataSeparateStr);//投票数セット
//▲▲▲ コピペここまで ▲▲▲（この行も含む）?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja" lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo h($data['title']);//タイトルを表示（必要に応じてコピペ下さい）?>｜サイト名</title>
<meta http-equiv="Content-Style-Type" content="text/css" />
<meta name="Keywords" content="" />
<meta name="Description" content="<?php echo h($data['title']);//タイトルを表示（必要に応じてコピペ下さい）?>" />
<meta http-equiv="Content-Script-Type" content="text/javascript" />

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
	height:180px;/*テキストのみの場合にはこの値を変更下さい*/
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
.submitBtn{
	position:absolute;
	left: 0;
	right: 0;
	bottom: 0;
	margin: auto;	
	width:100px;
	height:30px;
}
</style>
<?php if(!empty($messe)){ //投票ボタンを押した際にアラートを表示（システムとは無関係のため不要な場合は削除下さい）?>
<script>
alert('<?php echo encode2str($messe,$config['encodingType']);?>');
</script>
<?php } ?>
<!--▲▲▲既存ページヘの埋め込み時　コピペここまで（head部分に）▲▲▲-->

</head>
<body>

<!--▼▼▼埋め込み時はここから以下をコピーして任意の場所に貼り付けてください（html部は自由に編集可）▼▼▼-->
<?php if(!$copyright){echo $warningMesse;exit;}else{if(empty($data)){ ?>

<!--　▼表示期間が設定されている場合で期間外の場合、及び非表示設定時に表示する内容 ここから▼-->

現在表示期間外か該当アンケートデータが存在しませんです。

<!--　▲表示期間が設定されている場合で期間外の場合、及び非表示設定時に表示する内容 ここまで▲-->


<?php }else{ //投票データ表示（以下で表示不要なものがあればまるっと削除してOKです。すべてにclassまたはid振ってるのでCSSで非表示でもOK。移動もOKです。見た目もCSSで自由に調整下さい）?>

<h2><?php echo h($data['title']);//タイトル表示?></h2>
<div id="description"><?php echo strip_tags($data['description'],'<br /><br>');//説明文表示?></div>
<div id="termYmd">期間：<?php echo ($data['term'] != 0) ? date2FormatDateTerm(h($data['term_start'])).' ～ '.date2FormatDateTerm(h($data['term_end'])) : '無期限';//期間表示?></div>
<ul id="voteArea" class="clearfix">
<?php for($i=0;$i<$getCount;$i++){ ?>
<li>
<form action="" method="post">
<input type="hidden" name="data[vote]" value="<?php echo $i;?>" id="vote<?php echo $i;?>" />

<div class="voteCount">投票数：<?php echo (isset($voteArr[$i])) ? $voteArr[$i] : '0';//投票数表示（不要なら削除OKです）?></div>

<?php if(!empty($data['link_url'][$i])) echo '<a href="'.$data['link_url'][$i].'" target="_blank">';//リンク設定されていたらリンクタグを出力（開始タグ）?>

<div class="detailUpfile"><?php echo (!empty($data['upfile_path'][$i])) ? '<img src="'.$data['upfile_path'][$i].'?'.uniqid().'" />' : '';//画像タグ（「upfile_path」を「upfile_path_thumb」とすればサムネイル表示可）?></div>

<div class="detailText"><?php echo (!empty($data['comment'][$i])) ? strip_tags($data['comment'][$i],'<br /><br>') : '';//項目表示?></div>

<?php if(!empty($data['link_url'][$i])) echo '</a>';//リンク設定されていたらリンクタグを出力（閉じタグ）?>

<p class="submitBtn"><input type="hidden" name="data[vote_count]" value="<?php echo $getCount;?>" /><input type="submit" value="　投票　" /></p>
</form>
</li>
<?php } ?>
</ul>
<?php } cpyright();}//著作権表記削除不可?>
<!--▲▲▲埋め込み時　コピーここまで▲▲▲-->

</body>
</html>