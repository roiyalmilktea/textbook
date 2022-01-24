<?php //▼▼ 既存ページヘ埋め込み時はまるっとコピペ下さい （この行も含みページ最上部に）※.phpでかつUTF-8のページのみ可▼▼
//※逆にこのページに対して既存のページのhtmlを記述する形でももちろんOKです。
//【一覧ページ用のファイルです】このページが必要なケースは少ないかと思います。使用しない場合は削除OKです。
//----------------------------------------------------------------------
// ページング付き一覧ページ（投稿がどんなに増えても自動でページングを調整します）
// 設定ファイルの読み込みとページ独自設定
//----------------------------------------------------------------------
include_once("./pkobo_vote/admin/include/config.php");//（必要に応じてパスは適宜変更下さい）
$img_updir = './pkobo_vote/upload';//画像保存パス（必要に応じてパスは適宜変更下さい）

/* ▽オプション設定▽ */

//このページの文字コード（埋め込み先ページの文字コードに合わせてください　※大文字小文字は区別されません）
$config['encodingType'] = 'UTF-8';//Shift_JISの場合は「SJIS」として下さい。

/*----------------------------------------------------------------------------
ページング用設定
-----------------------------------------------------------------------------*/

//1ページあたりの表示数
$pagelength = 20;

//ページングの表示数 ※数値は奇数のみ可（現在のページ番号の前後に均等数のナビを表示するため）
//ナビゲーション数が超えた場合デフォルトは省略文字「...」を表示。文字列は以下で変更可。
$pagerDispLength = 5;

//ナビゲーションの省略箇所のテキスト
$overPagerPattern = '...';

//ナビゲーションの「次へ」のテキスト
$pagerNext = 'Next &raquo;';

//ナビゲーションの「前へ」のテキスト
$pagerPrev = '&laquo; Prev';

//----------------------------------------------------------------------
// 設定ファイルの読み込みとページ独自設定
//----------------------------------------------------------------------
$getFormatDataArr = getLines2DspData($file_path,$img_updir,$config);//（変更不可）
$pagerRes = pager_dsp($getFormatDataArr,$pagelength,$pagerDispLength,$config['encodingType']);//ページャー生成（変更不可）
$pagerDsp = (count($getFormatDataArr) > $pagelength) ? '<p class="pager">'.$pagerRes['dsp'].'</p>' : '';//ページャー用タグセット（変更不可）
//▲▲ コピペここまで ▲▲（この行も含む）?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja" lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>一覧ページ</title>
<meta http-equiv="Content-Style-Type" content="text/css" />
<meta name="Keywords" content="" />
<meta name="Description" content="" />
<meta http-equiv="Content-Script-Type" content="text/javascript" />

<!--▼▼CSS。既存ページ埋め込み時　必要に応じてコピペ下さい（head部分）▼▼-->
<style type="text/css">
/* CSSは必要最低限しか指定してませんのでお好みで（もちろん外部化OK） */

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

a{color:#36F;text-decoration:underline;}
a:hover{color:#039;text-decoration:none;}

table.borderTable01{
	border-collapse:collapse;
	width:100%;
	margin:10px 0 25px;
}
table.borderTable01 td,table.borderTable01 th{ 
	font-size:	12px; 
	border:1px solid #666;
	color:#333;
	padding:10px;
	line-height:150%;
	vertical-align:top;
}
table.borderTable01 th{
	font-size:	13px; 
	text-align:left;
	font-weight:normal;
	width:25%;
	background:#efefef;
}
table.borderTable01 td a{
	font-size:14px;	
}

/* Pager style（外部化可） */
.pager{
	text-align:right;
	padding:10px;
	clear:both;
}
/*ページャーボタン*/
.pager a{
    border: 1px solid #999;
    border-radius: 5px 5px 5px 5px;
    color: #333;
    font-size: 12px;
    padding: 3px 7px 2px;
    text-decoration: none;
	margin:0 1px;
}

/*現在のページのボタン*/
.pager a.current{
    background: #999;
    border: 1px solid #999;
    border-radius: 5px 5px 5px 5px;
    color: #fff;
    font-size: 12px;
    padding: 3px 7px 2px;
	margin:0 1px;
    text-decoration: none;
}

.pager a:hover{
    background:#999;
    color: #fff;
}

.overPagerPattern{
	padding:0 2px ;	
}

/* /Pager style */
</style>

<!--▲▲CSS▲▲-->

</head>
<body>

<!--▼▼既存ページ埋め込み時はここから以下をコピーして任意の場所に貼り付けてください（希望に合わせて自由に変更、削除、移動OKです）▼▼-->
<h2>投票・アンケート一覧</h2>
<p>このページは一覧ページです。実際に必要になるケースは少ないかもしれません。<br />
使用しない場合は削除OKですし、公開せずURLの確認用でもいいかもしれません。自由に使ってください。</p>

<?php echo $pagerDsp;//ページャー表示?>

<table class="borderTable01">
<tr>
<th>タイトル</th>
<th>期間</th>
<th>投票</th>
</tr>

<?php if(!$copyright){echo $warningMesse;exit;}else{for($i = $pagerRes['index']; ($i-$pagerRes['index']) < $pagelength; $i++){if(!empty($getFormatDataArr[$i])){$data=$getFormatDataArr[$i];?>

<tr>
<td><?php echo h($data['up_ymd']);//日付表示?>　<?php echo h($data['title']);//タイトル表示?></td>
<td><?php echo ($data['term'] != 0) ? date2FormatDateTerm(h($data['term_start'])).' ～ '.date2FormatDateTerm(h($data['term_end'])) : '無期限';//期間表示?></td>
<td><a href="vote.php?id=<?php echo h($data['id']);?>">投票する</a></td>
</tr>

<?php } } ?>

</table>

<?php echo $pagerDsp;//ページャー表示?>
<?php cpyright();}//著作権表記削除不可?>

<!--▲▲既存ページ埋め込み時　コピーここまで▲▲-->

</body>
</html>