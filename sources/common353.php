<?php
// include file(common.php)
// インクルードファイルの読み込み
include "user.php";

// -------------------------------------
// ユーザ定義関数
/*
disp_arr          // 配列のダンプ表示（デバグ用）
disp_func         // 関数名の表示（デバグ用）
disp_mes          // メッセージの表示（デバグ用）
disp_var          // 変数の表示（デバグ用）
disp_var_hex      // 変数の16進数表示（デバグ用)
nl_rep_br         // 改行コードを改行タグ「<br />」に変換
tag_entity_input  // メソッドによる入力データ変換処理
tag_entity_form   // フォーム表示データの変換処理
*/

// ----------------------------------------------
// 配列のダンプ表示（デバグ用）
function disp_arr($disp,&$arr,$arr_name)
{
/*
$disp     = 表示モード
            (=0:非表示、=1:黒文字で表示、=2:赤文字で表示、=3:青文字で表示
             =4:ライム色で表示、=5:アクア色で表示)
$arr      = 配列の値
$arr_name = 配列名
DEBUG     = デバグモード指定定数（インクルードファイルuser.php内で定義）
            (=0:非デバグモード、=1:デバグモード)
*/
   if(DEBUG == 0){return;}
   if($disp == 0) {return;}
   if($disp == 1)
   {
      $color = "black";
   }
   elseif($disp == 2)
   {
      $color = "red";
   }
   elseif($disp == 3)
   {
      $color = "blue";
   }
   elseif($disp == 4)
   {
      $color = "lime";
   }
   elseif($disp == 5)
   {
      $color = "aqua";
   }

   print "<span style='color:" .$color . "'>";

   // 配列でない場合
   if(!is_array($arr))
   {
      print $arr_name . "= [" . $arr . "] is not array<br>\n";
      return;
   }

   if(count($arr) < 1 )
   {
      print $arr_name . "[] is empty<br>\n";
      return;
   }

   print "<br>\n";
   foreach($arr as $key => $value) 
   {
      if(is_array($value)) 
      {
         foreach($value as $key2 => $value2) 
         {
            if(is_array($value2)) 
            {
               foreach($value2 as $key3 => $value3)
               {
                  if(is_array($value3)) 
                  {
                     foreach($value3 as $key4 => $value4)
                     {
                        print $arr_name . "[" . $key . "][". $key2 . "][" . 
                              $key3 . "][". $key4 . "]=" . $value4 . "<br>\n";
                     }
                  } 
                  else 
                  {
                     print $arr_name . "[" . $key . "][". $key2 . "][" . 
                                      $key3 . "]=" . $value3 . "<br>\n";
                  }
               }
            } 
            else 
            {
               print $arr_name . "[" . $key . "][". $key2 . "]=" . 
                                                 $value2 . "<br>\n";
            }
         }
         print "<br>\n";
      }else
      {
         print $arr_name . "[" . $key . "]=" . $value . "<br>\n";
      }
   }
   print "</span>\n";
}

// ----------------------------------------------
// 関数名の表示（デバグ用）
function disp_func($on,$f_name,$mess) 
{
/*
$on       = 表示モード
            (=0:非表示、=1:黒文字で表示、=2:赤文字で表示、=3:青文字で表示
             =4:ライム色で表示、=5:アクア色で表示)
$f_name   = 関数名
$mess     = 表示メッセージ（入口："Hi"、出口："Bye"）
DEBUG     = デバグモード指定定数（インクルードファイルuser.php内で定義）
            (=0:非デバグモード、=1:デバグモード)
*/
   if(DEBUG == 0){return;}

   if($on == 1)
   {
      $color = "black";
   }
   elseif($on == 2)
   {
      $color = "red";
   }
   elseif($on == 3)
   {
      $color = "blue";
   }
   elseif($on == 4)
   {
      $color = "lime";
   }
   elseif($on == 5)
   {
      $color = "aqua";
   }

   if($on != 0) 
   {
      print "<span style='color:" .$color . "'>";

      print "<br>【" . $mess . " ! " . $f_name . "】<br>\n";

      print "</span>\n";
   }
}

// ----------------------------------------------
// メッセージの表示（デバグ用）
function disp_mes($disp,$str_mes)
{
/*
$disp     = 表示モード
            (=0:非表示、=1:黒文字で表示、=2:赤文字で表示、=3:青文字で表示
             =4:ライム色で表示、=5:アクア色で表示)
$str_mes  = メッセージ
DEBUG     = デバグモード指定定数（インクルードファイルuser.php内で定義）
             (=0:非デバグモード、=1:デバグモード)
*/
$on = 1;
disp_func($on,'disp_mes','Hi');
   if(DEBUG == 0){return;}
   if($disp == 0) {return;}

   if($disp == 1)
   {
      $color = "black";
   }
   elseif($disp == 2)
   {
      $color = "red";
   }
   elseif($disp == 3)
   {
      $color = "blue";
   }
   elseif($disp == 4)
   {
      $color = "lime";
   }
   elseif($disp == 5)
   {
      $color = "aqua";
   }
   print "<span style='color:" .$color . "'>" 
         . $str_mes . "</span><br>\n";
disp_func($on,'disp_mes','Bye');
}

// ----------------------------------------------
// 変数の表示（デバグ用）
function disp_var($disp,$var,$var_name){
/*
$disp     = 表示モード
            (=0:非表示、=1:黒文字で表示、=2:赤文字で表示、=3:青文字で表示
             =4:ライム色で表示、=5:アクア色で表示)
$var      = 変数の値
$var_name = 変数名
DEBUG     = デバグモード指定定数（インクルードファイルuser.php内で定義）
               (=0:非デバグモード、=1:デバグモード)
*/
   if(DEBUG == 0){return;}
   if($disp == 0) {return;}
   if($disp == 1)
   {
      $color = "black";
   }
   elseif($disp == 2)
   {
      $color = "red";
   }
   elseif($disp == 3)
   {
      $color = "blue";
   }
   elseif($disp == 4)
   {
      $color = "lime";
   }
   elseif($disp == 5)
   {
      $color = "aqua";
   }


   elseif(is_null($var))
   {
      $var = "NULL";
   }

   elseif($var === FALSE)
   {
      $var = "FALSE";
   }
   elseif($var === TRUE)
   {
      $var = "TRUE";
   }

   print "<span style='color:" .$color . "'>" 
             . $var_name . "=" . $var . "</span><br>\n";
}
// ----------------------------------------------
// 変数の16進数表示（デバグ用）
function disp_var_hex($disp,$var,$var_name)
{
/*
$disp     = 表示モード
            (=0:非表示、=1:黒文字で表示、=2:赤文字で表示、=3:青文字で表示
             =4:ライム色で表示、=5:アクア色で表示)
$var      = 変数の値
$var_name = 変数名
DEBUG     = デバグモード指定定数（インクルードファイルuser.php内で定義）
            (=0:非デバグモード、=1:デバグモード)
*/
   if(DEBUG == 0){return;}
   if($disp == 0) {return;}
   if($disp == 1)
   {
      $color = "black";
   }
   elseif($disp == 2)
   {
      $color = "red";
   }
   elseif($disp == 3)
   {
      $color = "blue";
   }
   elseif($disp == 4)
   {
      $color = "lime";
   }
   elseif($disp == 5)
   {
      $color = "aqua";
   }

   $var = "【" . bin2hex($var). "】";

   print "<span style='color:" .$color . "'>" 
             . $var_name . "=" . $var . "</span><br>\n";

}

// -------------------------------------
// 改行コードを改行タグ「<br />」に変換
function nl_rep_br($str)
{
/*
$string = 入力文字列
戻り値  = 変換後文字列
*/
  // 改行コードを改行タグに変換
  $str = preg_replace( "/(\r\n|\r|\n)/", "<br />", $str);
  return $str;
}

// -------------------------------------
// GETメソッド、POSTメソッドによる入力データ変換処理
// (HTMLタグ等をHTML実体参照に変換するモードの場合)
function tag_entity_input($string)
{
/*
$string = 入力文字列
戻り値  = 変換後文字列
*/
  if(empty($string)) {return "";}

  // 「'」,「"」,「\」のエスケープ処理された文字を元にもどす
  $string = stripslashes($string);

  // 「<」,「>」,「&」,「"」をHTML実体参照に変換する
  $string = htmlspecialchars($string);

  // 改行コードを改行タグ「<br>」に変換する。
  $string = nl_rep_br($string);
  return $string;
}

// -------------------------------------
// HTMLフォームのテキストエリアにデータを表示する直前のデータ変換処理
// (HTMLタグ等をHTML実体参照に変換するモードの場合)
function tag_entity_form($string)
{
/*
$string = 入力文字列
戻り値  = 変換後文字列
*/
  if(empty($string)) {return "";}

  // 改行タグを改行コードに変換
  $string = preg_replace( "/(<br>|<br \/>)/", "\n", $string);
  return $string;
}
