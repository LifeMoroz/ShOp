<?
// если комментировали статью, то заполняется $article_id, а $good_id = 0
// и наоборот, если комментировали товар
function add_new_comment_for_admin($author_info, $article_id, $good_id, $text, $date)
{
    $text = htmlspecialchars($text, ENT_QUOTES);
    $text = str_replace('  ', '&nbsp; ', $text);
    $text = str_replace('  ', '&nbsp; ', $text);
    $text = nl2br($text);
    $text = addslashes($text);

	$query = "INSERT INTO comments SET
		author_info = '$author_info',
		article_id = '$article_id',
		good_id = '$good_id',
		text =  '$text',
		date = '$date'
	";
	mysql_query($query);
}


function add_new_comment($article_id, $good_id, $text, $date)
{
	add_new_comment_for_admin($_SESSION['name'], $article_id, $good_id, $text, get_current_time_int());
}


function delete_comment($id)
{
	$query = "DELETE FROM comments WHERE id = $id";
	mysql_query($query);
}

function get_comments_by_article_id($article_id)
{
	$query = "SELECT * FROM comments WHERE article_id = '$article_id'";

    $comments = get_norm_mysql_rows($query);

    if ($comments)
        for ($i = 0; $i<count($comments); $i++)
            $comments[$i]['date'] = int_to_date($comments[$i]['date']);

    return $comments;
}

function get_comments_by_good_id($good_id)
{
	$query = "SELECT * FROM comments WHERE good_id = '$good_id' ORDER BY date";

    $comments = get_norm_mysql_rows($query);

    if ($comments)
        for ($i = 0; $i<count($comments); $i++)
            $comments[$i]['date'] = int_to_date($comments[$i]['date']);

    return $comments;
}


function print_add_comment_form_for_admin($hidden_input_name, $object_id)
{
    $form = '
        <form method="post" action="">
            <h3>Добавление нового комментария:</h3>

            Информация о авторе:<br>
            <input type="text" name="author_info" maxlength="100" id="text_input"/><br><br>
            Текст комментария:<br>
            <textarea name="text" id="textarea_input" class="mini_textarea"></textarea>
            <br><br>
            Дата <span>(формат: "дд.мм.гг". Неправильный формат даты может вызвать ошибку при выводе информации)</span>:<br>
            <input type="text" name="date" maxlength="100" id="mini_text_input"/><br><br>

            <input type="hidden" name="'.$hidden_input_name.'" value="'.$object_id.'">

            <input type="submit" value="Добавить" name="comment-reg-button" id="button" class="normal_button">
        </form>
	';

    echo $form;
}
?>