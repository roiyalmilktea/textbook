<?php
// インクルードファイルの読み込み
include "common_mysql.php";
 
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>avg.php</title>
</head>
<body>
<?php
 
 require_once('./Connections/localhost.php');
 
 // データベースサーバへの接続・データベースの選択
 $mysqli = new mysqli($db_host, $db_user, $db_passwd, $db_name);
 
 //クライアント文字コードの通知（文字化け防止）
 $str_sql = "set names utf8;";
 $rs = $mysqli->query($str_sql); 
 
 // 処理対象テーブル
 $tbl_name = "tbl_shouhin_hyou3";
 show_records($db_name,$tbl_name,$mysqli);
 print "<br>\n";
 
 // 集約関数
 // 平均値の計算（AVG()関数）
 $fld_name = 'tanka';
 $str_sql = "SELECT AVG({$fld_name}) FROM {$tbl_name} ;";
 $rs = $mysqli->query($str_sql);
 print "\"{$str_sql}\";<br>\n";
 
 // 計算結果の参照
 $flt_average = mysqli_result($rs,0,0);
 
 // 計算結果の表示
 print "{$fld_name}の平均値<br>\n";
 print "AVG({$fld_name}) = {$flt_average}<br><br>\n";
 
 // 一時変数「average」の使用
 $str_sql = "SELECT AVG({$fld_name}) AS average "
      . " FROM {$tbl_name} ;";
 $rs2 = $mysqli->query($str_sql);
 print "\"{$str_sql}\";<br>\n";
 
 // 計算結果の参照
 $arr_results = array();
 $arr_results = $rs2->fetch_assoc();
 $flt_average = $arr_results['average'];
 
 // 計算結果の表示
 print "{$fld_name}の平均値<br>\n";
 print "average = {$flt_average}<br><br>\n";
 
 // レコード数と最大値，最小値の計算
 $str_sql = "SELECT COUNT({$fld_name}) AS レコード数, "
      . " MIN({$fld_name}) AS min_単価, "
      . " MAX({$fld_name}) AS max_単価"
      . " FROM {$tbl_name} ;";
 $rs3 = $mysqli->query($str_sql);
 print "\"{$str_sql}\";<br>\n";
 
 // 計算結果の参照
 $arr_results = array();
 $arr_results = $rs3->fetch_assoc();
 $num_records = $arr_results['レコード数'];
 $min_price  = $arr_results['min_単価'];
 $max_price  = $arr_results['max_単価'];
 print "<table border=1 cellpadding=0 cellspacing=0>\n";
 print "<tr>\n";
 print "<td>レコード数</td>";
 print "<td align=right>{$num_records}</td>\n";
 print "</tr>\n";
 print "<tr>\n";
 print "<td>最小値</td>";
 print "<td align=right>{$min_price}</td>\n";
 print "</tr>\n";
 print "<tr>\n";
 print "<td>最大値</td>";
 print "<td align=right>{$max_price}</td>\n";
 print "</tr>\n";
 print "</table>\n";
 
 // 結果セット（結果ID）の開放
 mysqli_free_result($rs);
 mysqli_free_result($rs2);
 mysqli_free_result($rs3);
 
 // データベースサーバの切断
 $mysqli->close();
 
    
function mysqli_result($res,$row=0,$col=0){ 
    $numrows = mysqli_num_rows($res); 
    if ($numrows && $row <= ($numrows-1) && $row >=0){
        mysqli_data_seek($res,$row);
        $resrow = (is_numeric($col)) ? mysqli_fetch_row($res) : mysqli_fetch_assoc($res);
        if (isset($resrow[$col])){
            return $resrow[$col];
        }
    }
    return false;
}
?>
</body>
</html>