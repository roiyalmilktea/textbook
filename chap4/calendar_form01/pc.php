<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>カレンダー予約フォーム</title>

<!--　▼▼▼既存のページ等に表示させる場合、CSSも必要に応じてコピペ下さい（必要に応じてパスも変更下さい）▼▼▼　-->
<link href="calendar_form/style.css" rel="stylesheet" type="text/css" />
<!-- ▲▲▲コピペここまで▲▲▲ -->

</head>
<body id="index">

<!--　▼▼▼既存のページ等に表示させるにはここからコピペ下さい▼▼▼　-->
<?php require_once('calendar_form/admin/config.php');//設定ファイルインクルード（config.phpへの相対パス）※設置箇所が変わる場合は要変更?>

<?php if(!isset($_POST["reservSubmit"]) && empty($_GET['mode'])){//▼カレンダーを表示（フォームは非表示）▼ ?>

<!--　▼以下休業日、定休日テキスト箇所。すべて削除してしまってオリジナルでももちろんOKです▼　-->
<p class="holidayText"><?php if($closedText) echo $closedText ;//定休日テキスト（オリジナルも可）?><span class="holidayCube" style="background:<?php echo $holidayBg ;?>"></span>休業日</p>
<!--　▲休業日、定休日テキスト箇所ここまで▲　-->

<?php if(!$copyright) exit($warningMesse); else{ echo scheduleCalenderPc($ym,$timeStamp,$copyright);//カレンダー出力（カレンダー自体のタグ等を変更したい場合はfunction.php内を変更下さい）?>

<!--　▼以下休業日、定休日テキスト箇所。すべて削除してしまってオリジナルでももちろんOKです▼　-->
<p class="holidayText"><?php if($closedText) echo $closedText ;//定休日テキスト（オリジナルも可）?><span class="holidayCube" style="background:<?php echo $holidayBg ;?>"></span>休業日</p>
<!--　▲休業日、定休日テキスト箇所ここまで▲　-->

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
<p><input type="button" value="前画面に戻る" onClick="history.back()" class="submit-button"></p>


  <h2>予約フォーム</h2>
  <p>下記フォームに必要事項を入力後、確認ボタンを押してください。</p>
<form action="calendar_form/mail/mail.php" method="post">
<table class="formTable">
  <tr>
    <th><?php echo $selectDateText;?></th>
    <td>
    <?php echo $dspDate;?> <input type="hidden" name="reserv[date]" value="<?php echo $date;?>" /><input type="hidden" name="reserv[time]" value="<?php echo $time;?>" />
      </td>
  </tr>
  <tr>
    <th>お名前</th>
    <td><input size="20" type="text" name="お名前" />
      ※必須</td>
  </tr>
  <tr>
    <th>電話番号（半角）</th>
    <td><input size="30" type="text" name="電話番号" /></td>
  </tr>
  <tr>
    <th>メールアドレス（半角）</th>
    <td><input size="30" type="text" name="メールアドレス" />
      ※必須</td>
  </tr>
  <tr>
    <th>性別</th>
    <td><input type="radio" name="性別" value="男" /> 男　
      <input type="radio" name="性別" value="女" /> 女 
    </td>
  </tr>
  <tr>
    <th>サイトを知ったきっかけ</th>
    <td><input name="サイトを知ったきっかけ[]" type="checkbox" value="友人・知人" /> 友人・知人　
      <input name="サイトを知ったきっかけ[]" type="checkbox" value="検索エンジン" /> 検索エンジン
    </td>
  </tr>
  <tr>
    <th>お問い合わせ内容</th>
    <td><textarea name="お問い合わせ内容" cols="50" rows="5"></textarea></td>
  </tr>
</table>
<p align="center">
  <input type="submit" value="　 確認 　" />
  <input type="reset" value="リセット" />
</p>
</form>
</div>

<?php Uqa4h78r();}//著作権表記リンク無断削除禁止（削除すると全機能、または一部機能が失われることがあります）?>

<!-- ▲▲▲コピペここまで▲▲▲ -->

</body>
</html>
