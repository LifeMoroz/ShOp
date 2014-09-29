<?
include_once('include/config.php');

include_once('include/db_functions.php');


include_once('functions/work_functions.php');

define('FROM_INDEX', true);

$db = db_connect();
echo '1';

// ======================================================================================
// ======================================================================================
$email = 'dragondi@inbox.ru';


// ----------------------------------------------------------------------------------
//$password = generate_password(6); 
$password = '123123'; 

$m_password = md5($email.SALT.$password); // !!!!!

$query = "INSERT INTO administrators SET email = '$email', password = '$m_password', 
		name = 'DD', rights = '1'";
	
mysql_query($query);

// ======================================================================================
// ======================================================================================

echo 'DONE';

?>