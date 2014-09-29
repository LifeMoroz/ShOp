<?
include_once('user_functions.php');



function go_to_error404_page()
{
	//header('Location: error404.php');
	echo "<script>document.location.href = '".URI_PATH."/error404.php';</script>";
}


function is_email_valid($email)
{
	if (!preg_match("/(?:[a-z0-9]+(?:[-_.]?[a-z0-9]+)?@[a-z0-9_.-]+(?:\.?[a-z0-9]+)?\.[a-z]{2,5})$/i", trim($email)))
		return false;
	else return true;
}

function generate_password($length)
{
	$alphabet = array('a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','r','s','t','u','v','x','y','z','1','2','3','4','5','6','7','8','9','0','_');
	
	$password = '';
	for ($i = 0; $i < $length; $i++)
	{
		$index = rand(0, count($alphabet) - 1);
		$password .= $alphabet[$index];
	}
	
	return $password;
}
?>