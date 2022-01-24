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

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja" lang="ja">
<head>
<meta name="robots" content="noindex,nofollow" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>新規登録</title>
<link rel="stylesheet" type="text/css" href="./css/style.css">
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script type="text/javascript" src="./js/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="./js/common.js"></script>
</head>
<body>
<div id="container" class="clearfix">
  <div id="logoutBtn" class="linkBtn"><a href="?logout=true">ログアウト</a></div>
  <div id="toPage" class="linkBtn"><a href="./">一覧へ</a></div>
  <h1>投票・アンケート管理画面</h1>
  <h2>新規登録</h2>
  <form method="post" action="put.php" enctype="multipart/form-data" class="validateForm">
  
<?php
//トークンセット
$token = sha1(uniqid(mt_rand(), true));
$_SESSION['token'] = $token;
?>
<input type="hidden" name="token" value="<?php echo $token;//トークン発行?>" />
<input type="hidden" name="data[category]" value="" />
  
    <table class="borderTable01">
      <tr>
        <th>登録年月日</th>
        <td><?php echo registYmdList();//日付プルダウン表示?> </td>
      </tr>
      <tr>
        <th> 公開・非公開</th>
        <td><input type="hidden" name="data[public_flag]" value="0" />
          <input type="checkbox" name="data[public_flag]" value="1" checked="checked" />
          （チェックで「公開」になります）</td>
      </tr>
      <tr>
        <th>タイトル</th>
        <td><input type="text" size="40" name="data[title]" value="" /></td>
      </tr>
      
      <tr>
        <th>説明文</th>
        <td><textarea name="data[description]" rows="3" cols="60"></textarea></td>
      </tr>
      <tr>
        <th>表示期間</th>
        <td>
        <input type="radio" name="data[term]" value="0" checked="checked" id="term01" /><label for="term01"> 無期限</label>　
        <input type="radio" name="data[term]" value="1" id="term02" /><label for="term02"> 期限を設定</label>

        <div id="termYmdList" style="display:none" class="mt5">
        <?php echo termYmdList();//日付プルダウン表示?>～<?php echo termYmdList();//日付プルダウン表示?><div class="mt5">※実際には存在しない日付を設定した場合、そこから近く存在する日付が適当に自動設定されますので注意下さい。</div>
       </div>
        
        </td>
      </tr>
    </table>

<h3>項目設定・画像アップロード（MAX<?php echo $maxCommentCount;?>まで）</h3>

<p></p>

<?php echo $detailText;?>
<?php     
//挿入するhtmlを定義
$tempHTML = <<<EOF
<tr class="lines'+arInput+'">
<th>'+arInput+'.項目名</th>
<td><textarea name="data[comment][]" rows="2" cols="60"></textarea></td>
<td rowspan="3" style="vertical-align:middle"><input type="button" onclick="delLine('+arInput+'); return false;" value=" × 削除 " class="addAndDelBtn" /></td>
</tr>
<tr class="lines'+arInput+'">
<th>'+arInput+'.ファイル（5MB以内）</th>
<td><input type="file" name="data[upfile][]" /></td>
</tr>
<tr class="lines'+arInput+'">
<th>'+arInput+'.リンクURL</th>
<td><input type="text" name="data[link_url][]" size="60" /><br />設定した場合のみ項目名とアップファイルにリンク設定されます。（別ウインドウで開きます）</td>
</tr>
<tr class="lines'+arInput+'">
<td colspan="3" style="border:0;height:10px;padding:0"></td>
</tr>
EOF;
$tempHTML = str_replace(array("\n","\r",'"'),array('','','\"'),$tempHTML);
?>

<script type="text/javascript">
var arInput = 1; //初期化
function addInput() {
	arInput ++;
	if(arInput <= <?php echo $maxCommentCount;?>){
		$("#lineList").append('<?php echo $tempHTML;?>\n');
		cleditorExe();
	}else{
		$('#addBtn').prop('disabled',true);
	}
}

function delLine(str) { //削除処理
	if (confirm("このセットを削除してよろしいですか？")) {
		$("tr.lines"+str).fadeOut('fast', function() { $(this).remove(); });
	} else {
		alert("キャンセルしました");
	}
}
</script>

<table id="lineList" class="borderTable01 mb5">
<tbody>
      <tr class="lines1">
        <th>1.項目名</th>
        <td><textarea name="data[comment][]" rows="2" cols="60"></textarea></td>
        <td rowspan="3" style="vertical-align:middle"><input type="button" onclick="delLine(1); return false;" value=" × 削除 " /></td>
      </tr>
      <tr class="lines1">
        <th>1.ファイル（5MB以内）</th>
        <td><input type="file" name="data[upfile][]" /></td>
      </tr>
      <tr class="lines1">
        <th>1.リンクURL</th>
        <td><input type="text" name="data[link_url][]" size="60" /><br />設定した場合のみ項目名とアップファイルにリンク設定されます。（別ウインドウで開きます）</td>
      </tr>
      <tr class="lines1">
      <td colspan="3" style="border:0;height:10px;padding:0"></td>
      </tr>
</tbody>
</table>

<p class="taC mb20 mt5"><input type="button" onclick="addInput()" value="　項目を追加　" class="addAndDelBtn submitBtn" id="addBtn" /></p>

<table class="borderTable01">
<tfoot> 
      <tr>
        <td colspan="2" align="center" valign="middle">アップロードと縮小処理を同時に行いますので、時間がかかることもありますが、そのままで待ってください。<br />
          <br />
          <input type="hidden" name="data[mode]" value="shinki" />
          <input type="submit" value="登録" class="submitBtn" /></td>
      </tr>
      
</tfoot>      
</table>
    <br />
  </form>
 <p class="pagetop linkBtn taR"><a href="#container">PAGE TOP▲</a></p>
</div>
</body>
</html>