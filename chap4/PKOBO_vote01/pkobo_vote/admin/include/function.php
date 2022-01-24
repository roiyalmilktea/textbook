<?php
//----------------------------------------------------------------------
// 　関数定義 (START)　
//----------------------------------------------------------------------

//HTMLエスケープ
if(!function_exists('h')){
	function h($string) {
		global $config;
		return htmlspecialchars($string, ENT_QUOTES,$config['encodingType']);
	}
}
//数値チェック
function is_num($str) {
	if(preg_match("/^[0-9]+$/",$str)) {
		return true;   
	}else{
		return false;
	}
}
//本文丸め
function str2Format($sentence,$length = 170,$encodingType = 'UTF-8'){
	if(is_array($sentence)){
		$sentenceRes = '';
		foreach($sentence as $val){
			$sentenceRes .= $val;
		}
		$sentence = $sentenceRes;
	}
	if($length != 0){
		$sentence = strip_tags($sentence);
		$sentence = mb_strimwidth($sentence, 0, $length, "...", $encodingType);
		$sentence = str_replace(array("\n","\r"),"",$sentence);
	}
	return $sentence;
}
//NULLバイト除去//
function sanitize02($arr){
	if(is_array($arr)){
		return array_map('sanitize02',$arr);
	}
	return str_replace("\0","",$arr);
}
if(isset($_GET)) $_GET = sanitize02($_GET);//NULLバイト除去//
if(isset($_POST)) $_POST = sanitize02($_POST);//NULLバイト除去//
if(isset($_COOKIE)) $_COOKIE = sanitize02($_COOKIE);//NULLバイト除去//

//カンマのエスケープを戻す
function TextToKanma($str){
	return str_replace("__kanma__",",",$str);
}

//パラメータチェック
function is_param($str) {
	if(preg_match("/^[a-zA-Z0-9]+$/",$str)) {
		return true;   
	}else{
		return false;   
	}
}
//NEWマーク表示処理
function newmark($base_date,$dspday=''){
	global $new_mark_dsp;
	$newDspDay = (empty($dspday)) ? 10 : $dspday;
	$now = strtotime(date('Y-m-d'));
	$set_time = strtotime("{$base_date} +{$newDspDay} day");
	if($new_mark_dsp == 1 && $now <= $set_time){
		return true;
	}else{
		return false;
	}
}
//日付フォーマットの反映
function date2FormatDate($dateType,$date){
	return date($dateType,strtotime($date));
}
//期間フォーマットの反映
function date2FormatDateTerm($date){
	global $weekDsp,$weekArray,$termDateType,$termTimeType,$config;
	$res1 = date($termDateType,strtotime($date));
	$res2 = date($termTimeType,strtotime($date));
	
	$week = encode2str('（'.$weekArray[date('w',strtotime($date))].'）',$config['encodingType']);
	
	return ($weekDsp == 1) ? $res1.$week.$res2 : $res1.' '.$res2;
	
}

//データファイルから該当データのみ抽出
function ID2Data($file_path,$id){
	if(!is_num($id)) exit('パラメータエラー');
	$lines = file($file_path);
	$existsFlag = '';
	foreach($lines as $val){
		$linesArray = explode(",",$val);
		if($id == $linesArray[0]){
			$existsFlag = 1;
			break;
		}
	}
	return ($existsFlag == 1) ? $linesArray : exit('指定IDのデータがありません');
}

//データの並び順変更（日付順）ユーザ閲覧ページ用
function listSortUser($lines){
	$linesTempArray=array();
	$index=array();
	$index2=array();
	$jj = 0;
	
	foreach($lines as $lineVal){
		$linesArray = explode(",",$lineVal);
		if($linesArray[2] == 1 && strtotime($linesArray[1]) <= strtotime(date('Y-m-d'))){//公開設定でかつ未来日付ではない場合のみ
			$linesTempArray[] = $lineVal;
		}
	}
	
	foreach($linesTempArray as $val){
		$linesArray = explode(",",$val);
		$index[] = strtotime($linesArray[1]);
		$index2[] = $jj++;
	}
	
	array_multisort($index,SORT_DESC,SORT_NUMERIC,$index2,SORT_ASC,SORT_NUMERIC,$linesTempArray);
	return $linesTempArray;
	
}

//ページャー関数（HTML部は変更可）
function pager($totalPage, $pageid, $pagerDispLength,$encodingType){
	global $pagerNext,$pagerPrev,$overPagerPattern;
	
	//カテゴリパラメータをセット
	$addParam = (isset($_GET['cat'])) ? '&cat='.h($_GET['cat']) : '';
	if(isset($_GET['cat']) && !is_num($_GET['cat'])) exit('パラメータ不正');
	
	$pager = '';
	$next = $pageid+1;
	$prev = $pageid-1;
	$startPage =  ($pageid-floor($pagerDispLength/2)> 0) ? ($pageid-floor($pagerDispLength/2)) : 1;
	$endPage =  ($startPage> 1) ? ($pageid+floor($pagerDispLength/2)) : $pagerDispLength;
	$startPage = ($totalPage <$endPage)? $startPage-($endPage-$totalPage):$startPage;
	if($pageid != 1 ) {
		 $pager .= '<a href="?page='.$prev.$addParam.'">'.$pagerPrev.'</a>';
	}
	if($startPage>= 2){
		$pager .= '<a href="?page=1'.$addParam.'" class="btnFirst">1</a>';
		if($startPage>= 3) $pager .= '<span class="overPagerPattern">'.$overPagerPattern.'</span>'; //ドットの表示
	}
	for($i=$startPage; $i <= $endPage ; $i++){
		$class = ($pageid == $i) ? ' class="current"':"";//現在のページ番号にclass追加
		if($i <= $totalPage && $i> 0 )//1以上最大ページ数以下の場合
			$pager .= '<a href="?page='.$i.$addParam.'"'.$class.'>'.$i.'</a>';//ページ番号リンク表示
	}
	if($totalPage> $endPage){
		if($totalPage-1> $endPage ) $pager .= '<span class="overPagerPattern">'.$overPagerPattern.'</span>'; //ドットの表示
		$pager .= '<a href="?page='.$totalPage.$addParam.'" class="btnLast">'.$totalPage.'</a>';
	}
	if($pageid <$totalPage){
		$pager .= '<a href="?page='.$next.$addParam.'">'.$pagerNext.'</a>';
	}
	//if($encodingType!='UTF-8') $pager = mb_convert_encoding($pager,$encodingType,'UTF-8');
	return $pager;
}
//ページャー取得とページャー用カウント取得
function pager_dsp($lines,$pagelength,$pagerDispLength,$encodingType="UTF-8"){
	$totalPage = ceil(count($lines)/$pagelength);// 合計ページ数
	$pageid = (isset($_GET['page'])) ? h($_GET['page']) : 1;// 現在のページを取得
	if(!is_num($pageid)) exit('パラメータが不正です');
    $pagerRes['dsp'] = pager($totalPage, $pageid,$pagerDispLength,$encodingType);//ページャー部出力
	$pagerRes['index'] = ($pageid - 1) * $pagelength;//for文用カウント
	return  $pagerRes;//連想配列で返るので注意
}
//データを最適化したフォーマットに整える
function getLines2DspData($file_path,$img_updir,$config,$id='',$dsppage = ''){
	global $dataSeparateStr,$maxCommentCount,$extensionList,$weekDsp,$weekArray,$dateType,$new_mark_days;
	
	if(!empty($id) && !is_num($id)) exit('パラメータ不正');//インジェクション対策
	$dspTag = array();
	
	$lines = ($dsppage == 'admin') ? listSortAdmin(file($file_path)) : listSortUser(file($file_path));
	
	foreach($lines as $key => $val){
		if(isset($config['dspNum']) && ($key+1) > $config['dspNum']) break;
		$linesArray = explode(",",$val);
		
		//期間外の場合はスキップ(管理画面の場合は無効化)
		if($dsppage != 'admin' && !termDspFlag($linesArray[3])) continue;
		
		if(!empty($id) && $id != $linesArray[0]) continue;//ID指定の場合には処理速度を考慮し無駄なループはスキップ
		
		//カンマを置換
		$linesArray[4] = TextToKanma($linesArray[4]);
		$linesArray[5] = TextToKanma($linesArray[5]);
		$linesArray[6] = TextToKanma($linesArray[6]);
		$linesArray[7] = TextToKanma($linesArray[7]);
		
		//生データをセット
		$dspTag[$key]['id'] = $linesArray[0];
		$dspTag[$key]['term'] = $linesArray[3];
		
		//期間のセット
		$dspTag[$key]['term_start'] = '';
		$dspTag[$key]['term_end'] = '';
		if($dspTag[$key]['term'] != 0){
			$termArr = explode($dataSeparateStr,$dspTag[$key]['term']);
			$dspTag[$key]['term_start'] = $termArr[0];
			$dspTag[$key]['term_end'] = $termArr[1];
		}
		
		$dspTag[$key]['title'] = $linesArray[4];
		$dspTag[$key]['description'] = $linesArray[5];
		$dspTag[$key]['up_ymd_data'] = $linesArray[1];
		
		
		//画像パスもセットしておく（画像があった場合には強制的に詳細ページを開くため初めに処理）
		$dspTag[$key]['upfile_path'] = array();
		$dspTag[$key]['upfile_path_thumb'] = array();
		$dspTag[$key]['file_type'] = array();
		$dspTag[$key]['extension'] = array();
		
		for($i=0;$i<=$maxCommentCount;$i++){
			foreach($extensionList as $val){
				$upFilePath = $img_updir.'/'.$linesArray[0].'-'.$i.'.'.$val;
				$upFilePathThumb = $img_updir.'/'.$linesArray[0].'-'.$i.'s.'.$val;
				if(file_exists($upFilePath)){
					$dspTag[$key]['upfile_path'][$i] = $upFilePath;
					$dspTag[$key]['upfile_path_thumb'][$i] = $upFilePathThumb;
					$dspTag[$key]['extension'][$i] = $val;
					
					if($val == 'jpg' || $val == 'png' || $val == 'gif'){
						$dspTag[$key]['file_type'][$i] = 'img';
					}else{
						$dspTag[$key]['file_type'][$i] = 'file';
					}
					break;
				}
			}
		}
		
		//日付セット
		$dspTag[$key]['up_ymd'] = date2FormatDate($dateType,$linesArray[1]);
		$dspTag[$key]['up_ymd'] .= ($weekDsp == 1) ?  '（'.$weekArray[date('w',strtotime($linesArray[1]))].')' : '';//曜日をセット
		
		$dspTag[$key]['week'] = '（'.$weekArray[date('w',strtotime($linesArray[1]))].')';
		
		//Newマーク
//		$dspTag[$key]['newmark'] = 0;
//		$dspTag[$key]['newmark'] = (newmark($linesArray[1],$new_mark_days)) ? 1 : 0;
		
		//項目名
		$dspTag[$key]['comment'] = array();
		$commentArr = explode($dataSeparateStr,$linesArray[6]);
		foreach($commentArr as $commentArrKey => $commentArrVal){
			$commentArrVal = str_replace('<a href=','<a target="_blank" href=',$commentArrVal);//本文内のaタグにblankを付与
			$dspTag[$key]['comment'][] = ($config['encodingType'] != 'UTF-8') ? mb_convert_encoding($commentArrVal,$config['encodingType'],'UTF-8') : $commentArrVal;
		}
		
		//リンク
		$dspTag[$key]['link_url'] = array();
		$linkArr = explode($dataSeparateStr,$linesArray[7]);
		foreach($linkArr as $linkArrVal){
			$linkArrVal = trim($linkArrVal);//下位互換性用
			$dspTag[$key]['link_url'][] = ($config['encodingType'] != 'UTF-8') ? mb_convert_encoding($linkArrVal,$config['encodingType'],'UTF-8') : $linkArrVal;
		}
		
		//文字エンコード変更
		if($config['encodingType'] != 'UTF-8'){
			$dspTag[$key]['title'] = mb_convert_encoding($dspTag[$key]['title'],$config['encodingType'],'UTF-8');
			$dspTag[$key]['up_ymd'] = mb_convert_encoding($dspTag[$key]['up_ymd'],$config['encodingType'],'UTF-8');
			$dspTag[$key]['term'] = mb_convert_encoding($dspTag[$key]['term'],$config['encodingType'],'UTF-8');
			$dspTag[$key]['term_start'] = mb_convert_encoding($dspTag[$key]['term_start'],$config['encodingType'],'UTF-8');
			$dspTag[$key]['term_end'] = mb_convert_encoding($dspTag[$key]['term_end'],$config['encodingType'],'UTF-8');
			$dspTag[$key]['description'] = mb_convert_encoding($dspTag[$key]['description'],$config['encodingType'],'UTF-8');
			$dspTag[$key]['week'] = mb_convert_encoding($dspTag[$key]['week'],$config['encodingType'],'UTF-8');
		}
		
		//詳細ページ表示用データをセット
		if(!empty($id) && $id == $linesArray[0]){
			$dspTag = $dspTag[$key];
			break;
		}
	}
	
	return $dspTag;
}
function cffs2g($warningMesse02,$cfilePath){
	if(filesize($cfilePath) != 415 && filesize($cfilePath) != 410 && filesize($cfilePath) != 122 && filesize($cfilePath) != 117) exit($warningMesse02);//ASCIIモードでの転送にも対応
}

//表示期間であるかどうかチェック
function termDspFlag($term){
	global $dataSeparateStr;
	$termDsp = 0;
	if($term == 0){
		$termDsp = 1;
	}
	else{
		$now = strtotime(date('Y-m-d H:i:s'));
		$termArr = explode($dataSeparateStr,$term);
		
		$termStart = strtotime($termArr[0]);
		$termEnd = strtotime($termArr[1]);
		
		if($now >= $termStart && $now < $termEnd){
			$termDsp = 1;
		}
	}
	return ($termDsp == 1) ? true : false;
}
function cpyright(){
	global $copyright,$config;
	echo ($config['encodingType'] != 'UTF-8') ? mb_convert_encoding($copyright,$config['encodingType'],'UTF-8') : $copyright;	
}
//投票済みユーザーかチェックする
function voteCheck($data,$vote_file_path,$dataSeparateStr,$voteMesse,$cookiedays,$usecookie){	
	if(!isset($_COOKIE['pvote_'.$data['id']])){
		
			//投票処理実行
			$voteNum = h($_POST['data']['vote']);
			$voteid = h($data['id']);
			$voteCount = h($_POST['data']['vote_count']);
			if(!is_num($voteNum) || !is_num($voteid) || !is_num($voteCount)) exit('不正な入力');//数値のみかチェック
			
			//ファイルに保存
			$fp = fopen($vote_file_path, "r+b") or die("ファイルオープンエラー");
			
			if (flock($fp, LOCK_EX)) {
				
				$line = fgets($fp);
				$lineArr = explode(',',$line);
				
				$voteArr = explode($dataSeparateStr,$lineArr[1]);
				
				$writeData = '';
				$writeData .= $voteid. ",";
				
				for($i=0;$i<$voteCount;$i++){
					
					$voteArr[$i] = (isset($voteArr[$i])) ? $voteArr[$i] : 0;
					
					if($voteNum == $i){
						$voteArr[$i]++;
					}
					$writeData .= $voteArr[$i];
					$writeData .= $dataSeparateStr;
					
				}
				$writeData = rtrim($writeData,$dataSeparateStr);
				
				ftruncate($fp,0);
				rewind($fp);
				fwrite($fp, $writeData);
			}
			fflush($fp);
			flock($fp, LOCK_UN);
			fclose($fp);
			
			if($usecookie == 1){
				//クッキーに保存して再投票不可とする
				setcookie("pvote_".$data['id'],'finished', time()+$cookiedays);
			}
			
			$messe = $voteMesse['complete'];
			
	}else{
		$messe = $voteMesse['finished'];
	}
	return $messe;
}
//投票数セット
function getVoteCount($vote_file_path,$dataSeparateStr){
	if(file_exists($vote_file_path)){
		$line = file($vote_file_path);
		$lineArr = explode(',',$line[0]);
		$voteArr = explode($dataSeparateStr,$lineArr[1]);
		return $voteArr;
	}
}
//投票項目数の取得（表示側の実際のカウント数）
function getExixtsVoteCount($maxCommentCount,$data){
	$count = 0;
	for($i=0;$i<=$maxCommentCount;$i++){
		if(!empty($data['comment'][$i]) || !empty($data['upfile_path'][$i])){ 
			$count++;
		}
	}
	return $count;
}
//文字エンコードの変換
function encode2str($str,$encoding){
	if($encoding != 'UTF-8'){
		return mb_convert_encoding($str,$encoding,'UTF-8');
	}else{
		return $str;	
	}
}

//----------------------------------------------------------------------
// 　関数定義 (END)
//----------------------------------------------------------------------
?>