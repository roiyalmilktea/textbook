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
</head>
<body>
<div id="PAGETOP">

<div id="HEADER">
<h1>MyBlog</h1>
 <ul id="PAN">
   <li><a href="../index.php">ブログ</a></li>
 </ul>
</div>

<hr />

<h2>Blogシステム管理画面</h2>
<h3>ログイン</h3>
<p style="text-align:center">
<form id="formLogin" name="formLogin" method="POST" action="login.php">
  <table border="0" cellspacing="0" cellpadding="3">
    <tr>
      <th scope="row">ID:</th>
      <td><input name="admin_id" type="text" id="admin_id" size="25" /></td>
    </tr>
    <tr>
      <th scope="row">Password:</th>
      <td><input name="password" type="text" id="password" size="25" /></td>
    </tr>
    <tr>
      <th scope="row">&nbsp;</th>
      <td><input type="submit" name="Submit" value="ログイン" /></td>
    </tr>
  </table>
</form>
</p>
</div>
</body>
</html>
