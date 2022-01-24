<?php
// 共通用読み込みファイル(common.php)
// 関数
function disp_var($disp,$var,$var_name)
{
  if(DEBUG == 0){return;} /* 定数_DEBUGの値は，user.phpの
                中で定義されている */
  if($disp == 0){return;}
  print $var_name . " = " . $var . "<br>";
}
