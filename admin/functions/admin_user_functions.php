<?function is_admin_logged_in(){	if (!isset($_SESSION['admin']))		return false;	else return true;}function log_in_admin($email, $password){	if (!is_email_valid($email)) return 'Некорректный адрес электронной почты';		if (strlen($password) < 6) return 'Пароль должен быть длинне 6 символов!';			$password = md5($email.SALT.$password); // !!!!!	$query = "SELECT * FROM administrators WHERE email = '$email' and password = '$password'";	$query = mysql_query($query);	$r = mysql_fetch_assoc($query);			if (!$r) return 'Неправильно введен адрес электронной почты или пароль!';			$_SESSION['admin']['id'] = $r['id'];	$_SESSION['admin']['email'] = $r['email'];	$_SESSION['admin']['name'] = $r['name'];	$_SESSION['admin']['rights'] = $r['rights'];}function log_out_admin(){	unset($_SESSION['admin']);}// Создает запись в таблице administrators о новом администраторе и высылает письмо на указанную почту,// если все поля формы проходят проверку. Иначе - возвращается сообщение об ошибкеfunction register_admin($email, $name, $rights){	if ($name == '') return 'Поле "Имя" должно быть заполнено!';		if (!is_email_valid($email)) return 'Некорректный адрес электронной почты';			$query = "SELECT * FROM administrators WHERE email = '".$email."'";	$query = mysql_query($query);	$r = mysql_fetch_assoc($query);		if ($r) return 'Администратор с такой электронной почтой уже зарегистрирован!';		// ----------------------------------------------------------------------------------	$password = generate_password(6); 	//echo $password;	$m_password = md5($email.SALT.$password); // !!!!!		$query = "INSERT INTO administrators SET email = '$email', password = '$m_password', 		name = '$name', rights = '$rights'";			mysql_query($query);		// высылаем письмо}function restore_admin($login){	if (!is_email_valid($email)) return 'Некорректный адрес электронной почты';			$query = "SELECT * FROM administrators WHERE email = '".$email."'";	$query = mysql_query($query);	$r = mysql_fetch_assoc($query);		if (!$r) return 'Администратор с такой электронной почтой не зарегистрирован!';		// ----------------------------------------------------------------------------------	$password = generate_password(6); 	//echo $password;	$m_password = md5($email.SALT.$password); // !!!!!		$query = "UPSATE administrators SET password = '$m_password' WHERE email = '$email'";	mysql_query($query);		// высылаем письмо}function delete_admin($id){	$query = "DELETE FROM administrators WHERE id = $id";	mysql_query($query);}function up_admin($id){	$query = "UPDATE administrators SET rights = '1' WHERE id = $id";	mysql_query($query);}function down_admin($id){	$query = "UPDATE administrators SET rights = '0' WHERE id = $id";	mysql_query($query);}function get_administrators_list(){	$query = "SELECT * FROM administrators";	return get_norm_mysql_rows($query);}?>