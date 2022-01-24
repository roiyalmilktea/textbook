<?php 

require_once('../Connections/localhost.php'); 

// *** Validate request to login to this site.
if (!isset($_SESSION)) {
  session_start();
}

if (isset($_POST['admin_id'])) {

	$loginUsername=$_POST['admin_id'];
	$password=$_POST['password'];
	$MM_fldUserAuthorization = "";
	$MM_redirectLoginSuccess = "index.php";
	$MM_redirectLoginFailed = "login_error.php";
	$MM_redirecttoReferrer = false;
  
	$LoginRS_query = "SELECT admin_id, password FROM login_table WHERE admin_id='$loginUsername' AND password='$password'";
   
	$LoginRS = $mysqli->query($LoginRS_query);
    
	$loginFoundUser = $LoginRS->num_rows;

	if ($loginFoundUser) {
    
		$_SESSION['MM_Username'] = $loginUsername;     

		if (isset($_SESSION['PrevUrl']) && false) {
			$MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
		}
			header("Location: " . $MM_redirectLoginSuccess );
	}
	else {
		header("Location: ". $MM_redirectLoginFailed );
	}
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="content-style-type" content="text/css">
<title>MyBlog</title>
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
        <a class="navbar-brand" href="../index.php">MyBlog</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="../index.php">ブログ</a>
                </li>
            </ul>
        </div>
    </nav>  
<div id="PAGETOP">

</div>

<hr />

<h2>Blogシステム管理画面</h2>
<h3>ログイン</h3>
<p style="text-align:center">
<form id="formLogin" name="formLogin" method="POST" action="login.php">
  <div class="container">
  <table class="table" border="0" cellspacing="0" cellpadding="3">
    <tr>
      <th scope="row">ID:</th>
      <td><input name="admin_id" type="text" class="form-control" id="admin_id" size="25" /></td>
    </tr>
    <tr>
      <th scope="row">Password:</th>
      <td><input name="password" type="text" class="form-control" id="password" size="25" /></td>
    </tr>
    <tr>
      <th scope="row">&nbsp;</th>
      <td><input type="submit" class="btn btn-primary" name="Submit" value="ログイン" /></td>
    </tr>
  </table>
  </div>
</form>
</p>
</div>
</body>
</html>
