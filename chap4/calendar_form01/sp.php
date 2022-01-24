<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8" />
<title>予約・応募フォーム連動 営業日カレンダー</title>
<meta name="Keywords" content="" />
<meta name="Description" content="" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
<meta name="format-detection" content="telephone=no">
<link rel="stylesheet" href="//code.jquery.com/mobile/1.3.1/jquery.mobile-1.3.1.min.css" />
<script src="//code.jquery.com/jquery-1.9.1.min.js"></script>
<script src="//code.jquery.com/mobile/1.3.1/jquery.mobile-1.3.1.min.js"></script>
<style>
h2{
	background:#333;
	border-radius:6px;
	color:#fff;
	text-align:center;
	padding:2px;
	text-shadow:none;
	font-size:120%;
	margin:3px;
}
/*土曜の文字色*/
.youbi_6{
	color:#36F;
}
/*祝日と日曜の文字色*/
.youbi_0,.shukujitu{
	color:red;
}
/*本日の背景色　※ただし設定ファイルでの設定が優先されます*/
.today{
	background:#FF9;
}
/*休業日設定した日の背景色　※ただし設定ファイルでの設定が優先されます*/
.holiday{
	background:#FDD;	
}
/*定休日設定した日の背景色　※ただし設定ファイルでの設定が優先されます*/
.closed{
	background:#FDD;	
}
.hidden{
	display:none;	
}
/*休業日テキスト部の左側の四角*/
.holidayCube{
	display:inline-block;
	width:13px;
	height:13px;
	margin:3px 3px 0 3px;
	position:relative;
	top:2px;
}
/*定休日テキスト部の左側の四角*/
.closedCube{
	display:inline-block;
	width:13px;
	height:13px;
	margin:3px 3px 0 3px;
	position:relative;
	top:2px;
}
.scheduleComment{
	font-size:80%;
	font-weight:normal;
	color:#333;
}
.schedulePulldownList{
	font-size:90%;
	font-weight:normal;
	color:#333;
	padding:5px 0 5px;
	border-bottom:2px dotted #aaa;
}
#formWrap{
	margin:0 10px;	
}
.borderless{border:0!important}
</style>
</head>
<body>
<div id="index" data-role="page" data-theme="d">
<?php require_once('calendar_form/admin/config.php');//設定ファイルインクルード（config.phpへの相対パス）※設置箇所が変わる場合は要変更?>

<?php if(!isset($_POST["reservSubmit"]) && empty($_GET['mode'])){//▼カレンダーを表示（フォームは非表示）▼ ?>

<?php if(!$copyright) exit($warningMesse); else {$scheduleCalender = scheduleCalenderSp($ym,$timeStamp);?>
<h2 style="background:<?php echo $headerBgColor;?>;color:<?php echo $headerColor;?>"><?php echo $scheduleCalender['calnderHeaderYm'];?></h2>

<div data-role="controlgroup" data-type="horizontal" style="text-align:center">
<?php if(!empty($scheduleCalender['dspPrev'])){ ?>
<a data-ajax="false" data-role="button" href="?ym=<?php echo $scheduleCalender['dspPrev'];?>">&laquo; 前月へ</a>
<?php } ?>

<?php if(!empty($scheduleCalender['dspNext'])){ ?>
<a data-ajax="false" data-role="button" href="?ym=<?php echo $scheduleCalender['dspNext'];?>">翌月へ &raquo;</a>
<?php } ?>
</div><!-- /controlgroup -->

<!--　▼以下休業日、定休日テキスト箇所。すべて削除してしまってオリジナルでももちろんOKです▼　-->
<p class="small"><?php if($closedText) echo $closedText ;//定休日テキスト（オリジナルも可）?><span class="holidayCube" style="background:<?php echo $holidayBg ;?>"></span>休業日</p>
<!--　▲休業日、定休日テキスト箇所ここまで▲　-->

<ul data-role="listview" data-theme="d">
<?php echo $scheduleCalender['body'];//カレンダー出力（カレンダー自体のタグ等を変更したい場合はfunction.php内を変更下さい）?>
</ul>

<div data-role="controlgroup" data-type="horizontal" style="text-align:center">
<?php if(!empty($scheduleCalender['dspPrev'])){ ?>
<a data-ajax="false" data-role="button" href="?ym=<?php echo $scheduleCalender['dspPrev'];?>">&laquo; 前月へ</a>
<?php } ?>

<?php if(!empty($scheduleCalender['dspNext'])){ ?>
<a data-ajax="false" data-role="button" href="?ym=<?php echo $scheduleCalender['dspNext'];?>">翌月へ &raquo;</a>
<?php } ?>
</div><!-- /controlgroup -->

<?php Uqa4h78r();}//著作権表記リンク無断削除禁止（削除すると全機能、または一部機能が失われます）?>


<?php }else{//▼申し込みフォームを表示（カレンダーは非表示）▼ ?>



<?php
//予約日時をカレンダーから取得（変更不可）
$date = (isset($_GET["date"])) ? calf_h($_GET["date"]) : exit('日付が選択されていません。戻って選択しなおして下さい<br /><a href="javascript:history.back()">戻る&raquo;<a>');
$time = (isset($_GET["time"])) ? calf_h($_GET["time"]) : '';
$dateArray = explode("-",$date);
$dspDate = $dateArray[0]."年".$dateArray[1]."月".$dateArray[2]."日";//日付フォーマットの変更
$dspDate .= ($weekDsp == 1) ? '（'.$weekArray[date('w',strtotime($date))].'）' : '';//曜日を表示する（設定ファイルでONの場合のみ）
$dspDate .= " ".$timeArray[$time];//時間リストの反映
?>

<!-- ▼予約フォーム表示▼ ※デフォルトを参考に項目などは自由に変更下さい。全項目を自動で取得、送信します。（PC（pc.php）、スマホ（sp.php）、ガラケー（i.php）それぞれ変更下さい ※使うデバイスのみでOKです） -->

<div id="formWrap">
<a data-ajax="false" data-role="button" href="?page=back">前画面に戻る</a>

<h2>予約フォーム</h2>
<p>下記フォームに必要事項を入力後、確認ボタンを押してください。</p>
  
  
<form action="calendar_form/mail/sp.php" method="post" data-ajax="false">

<div data-role="fieldcontain">
<?php echo $selectDateText;?> <br />
<?php echo $dspDate;?> <input type="hidden" name="reserv[date]" value="<?php echo $date;?>" /><input type="hidden" name="reserv[time]" value="<?php echo $time;?>" />
</div>


<div data-role="fieldcontain">
お名前 <span class="col19">*</span><br /><input size="20" type="text" name="お名前" />
</div>


<div data-role="fieldcontain">
電話番号（半角） <br /><input size="30" type="text" name="電話番号" />
</div>

<div data-role="fieldcontain">
メールアドレス（半角）<span class="col19">*</span><br /> <input size="30" type="text" name="メールアドレス" />
</div>

<div data-role="fieldcontain">
性別<br>
<fieldset data-role="controlgroup">
<input name="性別" id="men" type="radio" value="男" />
<label for="men">男</label>
<input name="性別" type="radio" value="女" id="female" />
<label for="female">女</label> 
</fieldset>

</div>

<div data-role="fieldcontain">
サイトを知ったきっかけ <br />
<fieldset data-role="controlgroup">
<input name="サイトを知ったきっかけ[]" type="checkbox" value="友人・知人" id="checkbox01" /><label for="checkbox01">友人・知人　</label> 
<input name="サイトを知ったきっかけ[]" type="checkbox" value="検索エンジン" id="checkbox02" /><label for="checkbox02">検索エンジン</label>
</fieldset>

</div>

<div data-role="fieldcontain">
お問い合わせ内容 <br /><textarea name="お問い合わせ内容" cols="50" rows="5"></textarea>
</div>

<div data-role="fieldcontain">
<input type="submit" value="　 確認 　" />
</div>

</form>

</div>
<?php Uqa4h78r();}//著作権表記リンク無断削除禁止（削除すると全機能、または一部機能が失われます）?>



</div>
</body>
</html>
