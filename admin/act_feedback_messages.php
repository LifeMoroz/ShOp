<?
if (!defined('FROM_INDEX')) go_to_error404_page();


if (isset($_GET['id']) and true /*это число*/)
{
	$mode = 'by_id'; 
	$id = $_GET['id'];  // article id
}
else $mode = 'none';


if ($_POST['delete-fb_message-button'])
{
	delete_fb_message($_POST['id']);
	
	$url = '?act='.$act_array[$act_index]['short'];
	?> <script>document.location.href="<?=$url?>";</script> <?
}
else if ($_POST['update-fb_message-button'])
{
	update_fb_message($_POST['id'], $_POST['comments']);
	show_success_message();
}


// -----
if ($mode == 'none')
{
	if ($messages_type == 1)
	{
		$messages = get_all_call_me_messages_list();
		$messages_title = '<h3>Список писем категории "Перезвоните мне":</h3><br>';
	}
	else
	{
		$messages = get_all_about_us_messages_list();
		$messages_title = '<h3>Список писем категории "О нас":</h3><br>';
	}
	
	
	if (!$messages)
		echo '<h3>Нет писем!</h3>';
	else
	{
		echo $messages_title;

		for ($i = 0; $i < count($messages); $i++)
		{		
			$url = '?act='.$act_array[$act_index]['short'].'&id='.$messages[$i]['id'];
			
			?>
				<b>№<?=$messages[$i]['id']?></b>.
				Имя отправителя: <b><?=$messages[$i]['author_name']?></b><br>
				Данные отправителя: <b><?=$messages[$i]['author_data']?></b><br>
				Дата: <b><?=$messages[$i]['date']?></b><br>
				Комментарий: <b><?=$messages[$i]['comments']?></b><br>
				<h3><a href="<?=$url?>">Подробнее</a></h3>
				<br><br><br>
			<?
		}
	}
}
else if ($mode == 'by_id')
{
	$data = get_full_fbm_data($id);
	
	if ($messages_type == 1) $messages_title = '"Перезвоните мне"';
	else $messages_title = 'Категория "О нас"';
	
	?>
	<h3>Подробная информация о письме №<?=$data['message']['id']?> (<?=$messages_title?>):</h3>
	<br>
	Дата отправки: <b><?=$data['message']['date']?></b><br>
	<br><br>
					
	Имя отправителя: <b><?=$messages[$i]['author_name']?></b><br>
	Данные отправителя: <b><?=$messages[$i]['author_data']?></b><br>
	Дата: <b><?=$messages[$i]['date']?></b><br>
	Комментарий: <b><?=$messages[$i]['comments']?></b><br>
	<h3><a href="<?=$url?>">Подробнее</a></h3>
	
	<br><br><br><br>
	<b>Текст:</b><br>
	<?=$data['message']['text']?>
	
	<br><br><br><br><br><br>
	<form method="post" action="">
		<input type="hidden" name="id" value="<?=$data['message']['id']?>">

		Комментарии менеджера:<br>
		<textarea name="comments" id="textarea_input" class="mini_textarea"><?=$data['message']['comments']?></textarea>
		<br><br>
		<input type="submit" value="Сохранить" name="update-fb_message-button" id="button" class="normal_button">
		<input type="submit" value="Удалить письмо" name="delete-fb_message-button" id="button" class="normal_button">
	</form>
	<?
}
?>