<?php
  $s_link = mysqli_connect("localhost" ,"jikkyo" ,"pass", "jikkyo_pension");
  if ($s_link == null) {
    die("接続に失敗しました：" . mysqli_connect_error());
  }
  mysqli_set_charset($s_link, "utf8");
  $s_result = mysqli_query($s_link, "SELECT * FROM room_type");
  echo "<ul>";
  while($s_row = mysqli_fetch_array( $s_result, MYSQLI_ASSOC )) {
    echo "<li><a href='./roomList.php?tid=" . 
        $s_row['type_id'] . "'>" . $s_row['type_name'] . "</a></li>";
  }
  echo "</ul>";
  mysqli_free_result($s_result);
  mysqli_close($s_link);
?>