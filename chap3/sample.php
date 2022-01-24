<!doctype html>
<head>
<link rel="stylesheet" herf="css/foo.css">
</head>


<body>
	<h1>
		login
        </h1>
	<form method="GET" action="login chk.php">
		ID<input type="text" name="login_id"><br>
		pass<input type="text" name="login_pass"><br>
		<input type="submit" value="login">
        </form>
	<?php
		echo "hello";
	?>
</body>
</html>