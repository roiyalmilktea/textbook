<?php 

require_once('../Connections/localhost.php');

//セッション処理ここから

if (!isset($_SESSION)) {
  session_start();
}

if ((isset($_GET['doLogout'])) &&($_GET['doLogout']=="true")){
	//to fully log out a visitor we need to clear the session varialbles
	$_SESSION['MM_Username'] = NULL;
	$_SESSION['PrevUrl'] = NULL;
	unset($_SESSION['MM_Username']);
	unset($_SESSION['PrevUrl']);
	
	header("Location: login.php");
}

if (!isset($_SESSION['MM_Username'])) {   
  header("Location: login.php"); 
}

//セッション処理ここまで

if ((isset($_GET['entry_id'])) && ($_GET['entry_id'] != "")) {
  $deleteSQL = "DELETE FROM entry_table WHERE entry_id=". $_GET['entry_id'];

  $Result1 = $mysqli->query($deleteSQL);

  header("Location: index.php");
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="content-style-type" content="text/css">
<title>MyBlog管理画面</title>
<link href="../style.css" rel="stylesheet" type="text/css" media="all" />
<link href="../bootstrap-4.3.1-dist/css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="../bootstrap-4.3.1-dist/js/bootstrap.min.js"></script>
</head>
<body>
<nav id="PAGETOP" class="navbar navbar-expand-sm navbar-dark bg-primary mt-3 mb-3">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav4" aria-controls="navbarNav4" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="index.php">Blogシステム管理画面</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">管理トップ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php print $_SERVER['PHP_SELF']."?doLogout=true"; ?>">ログアウト</a>
                </li>
            </ul>
        </div>
    </nav> 
<div id="PAGETOP">


<hr />

<div class="container">
<h3>この画面は記事削除画面です</h3>
</div>
    
</div>
</body>
</html>
