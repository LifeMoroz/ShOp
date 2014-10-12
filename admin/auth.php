<?
include_once('../include/config.php');
include_once('include/admin_config.php');

include_once('../functions/work_functions.php');

include_once('functions/work_admin_functions.php');
include_once('functions/admin_user_functions.php');


if (is_admin_logged_in()) header('location: index.php');


?>
<!DOCTYPE html PUBLIC  "-//W3C//DTD XHTML 1.0 Strict//EN" "www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<link type="text/css" rel="stylesheet" href="style/style.css"/>

	<script type="text/javascript" src="./include/js/jquery-2.1.1.js"></script>

	<link rel="stylesheet" type="text/css" href="include/bootstrap/css/bootstrap.css"/>
	<script type="text/javascript" src="include/bootstrap/js/bootstrap.js"></script>

	<title>Вход в панель администратора</title>
</head>

<body>
	<?php
	if ($_POST['admin-login-button'])
	{
		log_in_admin($_POST['email'], $_POST['password']);
		
		if (is_admin_logged_in())
		{ 
			?> <script> document.location.href="index.php" </script> <?
			unset($_POST);
		}
	}
	else if ($_POST['admin-restore-button'])
	{
		restore_admin($_POST['email']);
	}
	?>
	
	<table width="100%" height="100%">
	<tr align="center"><td>
		<br><br><br>
		
		<h3>Вход в панель администратора</h3>
		<form method="post" action="">
			E-mail: <br>
			<input type="text" name="email" value="<?=$_POST['email']?>" maxlength="25" id="auth_input">
			<br><br>
			Пароль: <br>
			<input type="password" name="password" maxlength="25" id="auth_input">
			<br><br>
			<input type="submit" value="Войти" name="admin-login-button" id="auth_button">
		</form>
		
		<br><br><br>
		
		<h3>Забыли пароль?</h3>
		<form method="post" action="">
			E-mail: <br>
			<input type="text" name="login" maxlength="25" id="auth_input">
			<br><br>
			<input type="submit" value="Восстановить" name="admin-restore-button" id="auth_button">
		</form>
	</td></tr>
	</table>
	
	<br><br><br><br><br>
</body>
</html>