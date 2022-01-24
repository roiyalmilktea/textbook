<!DOCTYPE html>
<hmtl>
	<head>
		<link rel="stylesheet" href="./css/style.css" type="text/css">
		
	</head>
	<body>
		<h1>ここでは予約状況と施設の予約ができます。<br></h1>
		<h3>※テニスコートは8コート、ゴルフ場は3つあります。<br></h3>
	</body>
</hmtl>


<?php
  $link=mysqli_connect("localhost","jikkyo","pass","jikkyo_pension");
  if ($link==null){
	  die("接続に失敗しました");
  }
  mysqli_set_charset($link,"utf8");
  $result = mysqli_query($link,"SELECT * FROM rental");
  echo "現在予約されている施設" . mysqli_num_rows($result) . "件<br>";
  while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
	  echo $row['name'] . "<br>";
  }
  mysqli_free_result($result);
  mysqli_close($link);
?>

<!DOCTYPE html>
<html>
	<head>
		
		<link rel="stylesheet" href="./css/style.css" type="text/css">
		<title>rental</title>
	</head>
	<body>
	
		<table>
			<li>
				<a href="./tennis.php">テニスコートを利用する</a>
			</li>
			<li>
				<a href="./golf.php">ゴルフ場を利用する</a>
			</li>
			
		</table>
		
	</body>
</html>