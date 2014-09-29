<?
function add_new_good($title, $category_id)
{
	$query = "INSERT INTO goods SET title = '$title', category_id = '$category_id'";
	mysql_query($query);
	
	return mysql_insert_id();
}

function get_goods_list_by_category_id($id)
{
	$query = "SELECT * FROM goods WHERE category_id = '$id'";
	return get_norm_mysql_rows($query);
}


function get_good_data($id)
{
	$query = "SELECT * FROM goods WHERE id = '$id'";
	$query = mysql_query($query);
	return mysql_fetch_assoc($query);
}



function update_good($id, $title, $info, $cost, $popularity, $description, $keywords)
{//доделать
	$query = "UPDATE goods SET 
		title = '$title', 
		info = '$info',
		cost = '$cost',
		popularity = '$popularity',
		description = '$description', 
		keywords = '$keywords'
		WHERE id = '$id'
	";		
	mysql_query($query);
}

function delete_good($id)
{
	$query = "DELETE FROM goods WHERE id = $id";
	mysql_query($query);
}
?>