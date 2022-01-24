<?php
// include file(common.php)
 
// -------------------------------------
// ユーザ定義関数
/*
tag_entity_input
tag_entity_form
*/
 
// -------------------------------------
// 改行コードを改行タグ「<br />」に変換
function nl_rep_br($str)
{
/*
 $string = 入力文字列
 戻り値 = 変換後文字列
*/
 // 改行コードを改行タグに変換
 $str = preg_replace( "/(\r\n|\r|\n)/", "<br />", $str);
 return $str;
}
 
// -------------------------------------
// GETメソッド，POSTメソッドによる入力データ変換処理
// (HTMLタグ等をHTML実体参照に変換するモードの場合)
function tag_entity_input($string)
{
/*
 $string = 入力文字列
 戻り値 = 変換後文字列
*/
 if(empty($string)) {return "";}
  
 // 「'」,「"」,「\」のエスケープ処理された文字を元にもどす
 $string = stripslashes($string);
  
 // 「<」,「>」,「&」,「"」をHTML実体参照に変換する
 $string = htmlspecialchars($string);
  
 // 改行コードを改行タグ「<br />」に変換する．
 $string = nl_rep_br($string);
 return $string;
}
 
// -------------------------------------
// HTMLフォームのテキストエリアにデータを表示する直前の
// データ変換処理
// (HTMLタグ等をHTML実体参照に変換するモードの場合)
function tag_entity_form($string)
{
/*
 $string = 入力文字列
 戻り値 = 変換後文字列
*/
 if(empty($string)) {return "";}
  
 // 改行タグを改行コードに変換
 $string = preg_replace( "/(<br>|<br \/>)/", "\n", $string);
 return $string;
} 