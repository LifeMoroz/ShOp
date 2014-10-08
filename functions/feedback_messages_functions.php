<?
// Типы сообщений обратной связи: 
$call_me_type = 'call_me';
$about_us_type = 'about_us';



function add_new_call_me_message($author_name, $author_data, $text)
{
	add_new_fbm($author_name, $author_data, $text, $call_me_type);
}

function add_new_about_us_message($author_name, $author_data, $text)
{
	add_new_fbm($author_name, $author_data, $text, $about_us_type);
}

function add_new_fbm($author_name, $author_data, $text, $type)
{// добавить отправку писем админам?
	$now = get_current_time_int();
	$query = "INSERT INTO feedback_messages SET 
		author_name = '$author_name', 
		author_data = '$author_data', 
		text = '$text',
		type = '$type',
		date = '$now'
	";
	mysql_query($query);
}



function get_all_call_me_messages_list()
{
	return get_all_fbm_list($call_me_type);
}

function get_all_about_us_messages_list()
{
	return get_all_fbm_list($about_us_type);
}

function get_all_fbm_list($type)
{
	$query = "SELECT * FROM feedback_messages WHERE type = '$type' ORDER BY date";
	$data = get_norm_mysql_rows($query);
	
	if (!$data) return null;
	
	for ($i = 0; $i < count($data); $i++)
	{	
		if ($data[$i]['comments'] == '') $data[$i]['comments'] = 'Нет комментариев';
		
		$data[$i]['date'] = int_to_date($data[$i]['date']);
	}
	
	return $data;
}



function get_full_fbm_data($id)
{
	$query = "SELECT * FROM feedback_messages WHERE id = '$id'";
	$query = mysql_query($query);
	$data = mysql_fetch_assoc($query);
	
	$data['date'] = int_to_date($data['date']);
	
	return $data;
}



function delete_fbm($id)
{
	$query = "DELETE FROM feedback_messages WHERE id = '$id'";
	mysql_query($query);
}


function update_fbm($id, $comments)
{
	$query = "UPDATE feedback_messages SET comments = '$comments' WHERE id = '$id'";
	mysql_query($query);
}
?>