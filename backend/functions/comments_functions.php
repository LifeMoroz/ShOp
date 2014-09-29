<?
// если комментировали статью, то заполняется $article_id, а $good_id = 0
// и наоборот, если комментировали товар
function add_new_comment($author_info, $article_id, $good_id, $text, $date)
{// проверить корректность составления user_info
	/*$user_data = get_user_data($user_id);
	$author_info = $user_data['name'].' ('.$user_data['email'].')'; // ?*/
	
	$query = "INSERT INTO comments SET
		author_info = '$author_info',
		article_id = '$article_id',
		good_id = '$good_id',
		text =  '$text',
		date = '$date'
	";
	mysql_query($query);
	
	return mysql_insert_id();
}

function delete_comment($id)
{
	$query = "DELETE FROM comments WHERE id = $id";
	mysql_query($query);
}

function get_comments_by_article_id($article_id)
{
	$query = "SELECT * FROM comments WHERE article_id = '$article_id' ORDER BY date";
	return get_norm_mysql_rows($query);
}

function get_comments_by_good_id($good_id)
{
	$query = "SELECT * FROM comments WHERE good_id = '$good_id' ORDER BY date";
	return get_norm_mysql_rows($query);
}
?>