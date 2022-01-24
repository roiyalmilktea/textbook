<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<html>
    <head>
        <title>get form</title>
    </head>
    <body>
        <?php

		require 'db_connect.php';

            $id = $_POST["id"];
		
		$sql = "delete from student  where id = $id";

		$rst = $mysqli->query($sql);

#            printf("id = %s<br>",$id);
#            printf("name = %s<br>",$name);
#            printf("major = %s<br>",$major);
#            printf("data = %s<br>",$deta);
        ?>
    </body>
</html>
