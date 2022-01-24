<?PHP

/*
enchantからのscoreの値を取得しログファイルに保存する。
*/

//ajaxで取得した値
$score = $_POST["score"];

//書き込むログファイル名
$filename = "log.txt";

//書き込み
file_put_contents($filename,$score);
