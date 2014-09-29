<?
if (!defined('FROM_INDEX')) go_to_error404_page();


if ($_POST['delete-writer-button'])
{
	delete_writer($_POST['writer_id']);
	unset($_POST);
}
else if ($_POST['writer-reg-button'])
{
	$add_new_writer_message = register_writer($_POST['name'], $_POST['link']);
	
	if (!$add_new_writer_message) unset($_POST);
}
else if ($_POST['update-writer-button'])
{
	update_writer($_POST['writer_id'], $_POST['name'], $_POST['link']);
	unset($_POST);
	show_success_message();
}


$writers = get_writers_list();
//print_r($writers);

if (count($writers) > 0)
	echo '<h3>Список писателей:</h3>';

for ($i = 0; $i < count($writers); $i++)
{
	$id = $writers[$i]['id'];
	$name = $writers[$i]['name'];
	$link = $writers[$i]['link'];
	

	?>
		<form method="post" action="">
			Имя:<br>
			<input type="text" name="name" value="<?=$name?>" maxlength="40" id="text_input"/><br>
			Ссылка:<br>
			<input type="text" name="link" value="<?=$link?>" maxlength="200" id="text_input"/><br>
			<a href="?act=articles&writer_id=<?=$id?>">Перейти к списку статей этого автора</a><br>
			
			<input type="hidden" name="writer_id" value="<?=$id?>">
			
			<input type="submit" value="Сохранить" name="update-writer-button" id="button" class="mini_button">
			<input type="submit" value="Удалить" name="delete-writer-button" id="button" class="mini_button">
		</form>
		<br><br>
	<?
}


if ($add_new_writer_message) 
	$add_new_writer_message = '<h4 style="color: red;">'.$add_new_writer_message.'</h4>';
else $add_new_writer_message = '<h3>Добавление нового писателя:</h3>';

?>
<br><br>

<form method="post" action="">
	<?=$add_new_writer_message?>
	Имя:<br>
	<input type="text" name="name" value="<?=$_POST['name']?>" maxlength="40" id="text_input"/><br><br>
	Ссылка:<br>
	<input type="text" name="link" value="<?=$_POST['link']?>" maxlength="200" id="text_input"/>
	<br><br><br>
	<input type="submit" value="Создать" name="writer-reg-button" id="button" class="normal_button">
</form>