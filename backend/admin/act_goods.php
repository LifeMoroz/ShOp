<?
if (!defined('FROM_INDEX')) go_to_error404_page();


if (isset($_GET['id']) and true /*это число*/)
{
	$mode = 'by_id';
	$id = $_GET['id']; // good id
}
else if (isset($_GET['supercategory_id']) and true /*это число*/)
{
	$mode = 'by_supercategory_id';
	$supercategory_id = $_GET['supercategory_id'];
}
else if (isset($_GET['category_id']) and true /*это число*/)
{
	$mode = 'by_category_id';
	$category_id = $_GET['category_id'];
}
else $mode = 'none';


if ($_POST['category-reg-button'])
{
	if ($_POST['title'])
		add_new_category($_POST['title'], $_POST['parent_id'], 2);
		
	unset($_POST);
}
else if ($_POST['delete-category-button'])
{
	delete_category($_POST['category_id']);
}
else if ($_POST['update-category-button'])
{
	update_category($_POST['id'], $_POST['title'], $_POST['description'], $_POST['keywords']);
	show_success_message();
}
else if ($_POST['good-reg-button'])
{
	if ($_POST['title'])
	{
		$id = add_new_good($_POST['title'], $_POST['category_id']);
		$mode = 'by_id';
	}
}
else if ($_POST['update-good-button'])
{//доделать
	update_good($_POST['id'], $_POST['title'], $_POST['info'], $_POST['cost'], 
		$_POST['popularity'], $_POST['description'], $_POST['keywords']);
	show_success_message();
}
else if ($_POST['delete-good-button'])
{
	delete_good($_POST['good_id']);
}
else if ($_POST['comment-reg-button'])
{
	add_new_comment($_POST['author_info'], 0, $_POST['good_id'], $_POST['text'], $_POST['date']);
}
else if ($_POST['delete-comment-button'])
{
	delete_comment($_POST['id']);
}

// -----
if ($mode == 'none')
{
	$categories = get_main_categories_list();

	if (!$categories)
		echo '<h3>Нет категорий!</h3>';
	else
	{
		echo '<h3>Список основных категорий:</h3>';
		
		for ($i = 0; $i < count($categories); $i++)
		{
			$id = $categories[$i]['id'];
			$title = $categories[$i]['title'];
			$url = '?act='.$act_array[$act_index]['short'].'&supercategory_id='.$id;

			?> <a href="<?=$url?>"><big><?=$id?>. <?=$title?></big></a><br><br> <?
		}
	}
}
else if ($mode == 'by_supercategory_id')
{
	$categories = get_categories_list_by_parent_id($supercategory_id);
	$supercategory_data = get_category_data($id);
	
	$category_data = get_category_data($supercategory_id);
	$url = '?act='.$act_array[$act_index]['short'];
	
	?> <h3>Список подкатегорий категории "<a href="<?=$url?>"><?=$category_data['title']?></a>":</h3> <?
	
	if (!$categories)
		echo '<h4>Нет категорий!</h4>';
	else
	{
		echo '<table>';
		
		for ($i = 0; $i < count($categories); $i++)
		{
			$id = $categories[$i]['id'];
			$title = $categories[$i]['title'];
			$url = '?act='.$act_array[$act_index]['short'].'&category_id='.$id;

			?>
			<tr valign="top">
				<td>
					<a href="<?=$url?>"><big><?=$title?></big></a>
				</td>
				<td width="40"></td>
				<td>
					<form method="post" action="">
						<input type="hidden" name="category_id" value="<?=$id?>">
						<input type="submit" value="Удалить" name="delete-category-button" id="button" class="mini_button">
					</form>
				<br>
				</td></tr>
			<?
		}
		
		echo '</table>';
	}
	
	?>
	<br><br><br><br>
	
	<form method="post" action="">
		<h3>Добавление новой категории:</h3>
		Название:<br>
		<input type="text" name="title" value="<?=$_POST['title']?>" maxlength="100" id="text_input"/><br><br>
		
		<input type="hidden" name="parent_id" value="<?=$supercategory_id?>">
		
		<input type="submit" value="Добавить" name="category-reg-button" id="button" class="normal_button">
	</form>
	
	<br><br><br><br>
	
	<? $data = get_category_data($supercategory_id); ?>
	
	<h3>Редакирование категории:</h3>
	<form method="post" action="">
		<input type="hidden" name="id" value="<?=$data['id']?>">

		Название:<br>
		<input type="text" name="title" value="<?=$data['title']?>" maxlength="200" id="text_input"/><br>
		<br>
		Тег "description":<br>
		<textarea name="description" id="textarea_input" class="mini_textarea"><?=$data['description']?></textarea>
		<br><br>
		Тег "keywords":<br>
		<textarea name="keywords" id="textarea_input" class="mini_textarea"><?=$data['keywords']?></textarea>
		<br><br>
		<input type="submit" value="Сохранить" name="update-category-button" id="button" class="normal_button">
	</form>
	<?
}
else if ($mode == 'by_category_id')
{
	$category_data = get_category_data($category_id);
	$goods = get_goods_list_by_category_id($category_id);

	$url = '?act='.$act_array[$act_index]['short'].'&supercategory_id='.$category_data['parent_id'];
	
	?> <h3>Список товаров категории "<a href="<?=$url?>"><?=$category_data['title']?></a>":</h3> <?
	
	if (!$goods)
		echo '<h4>Нет товаров!</h4>';
	else 
		for ($i = 0; $i < count($goods); $i++)
		{
			$id = $goods[$i]['id'];
			$title = $goods[$i]['title'];
			$url = '\?act='.$act_array[$act_index]['short'].'&id='.$id;

			?>
				Наименование: <b><?=$title?></b>
				<br>
				<table style="border-spacing: 0px;"><tr><td>
					<button onclick="document.location.href='<?=$url?>'" id="button" class="mini_button">
						Редактировать
					</button>
				</td><td>
					<form method="post" action="">
						<input type="hidden" name="good_id" value="<?=$id?>">
						<input type="submit" value="Удалить" name="delete-good-button" id="button" class="mini_button">
					</form>
				</td></tr></table>
				<br>
			<?
		}
		
	?>
	<br><br><br><br>
	
	<form method="post" action="">
		<h3>Добавление нового товара:</h3>
		Наименование:<br><br>
		<input type="text" name="title" maxlength="100" id="text_input"/><br><br>
		
		<input type="hidden" name="category_id" value="<?=$category_id?>">
		
		<input type="submit" value="Добавить" name="good-reg-button" id="button" class="normal_button">
	</form>
	
	<br><br><br><br>
	
	<? $data = get_category_data($category_id); ?>
	
	<h3>Редакирование категории:</h3>
	<form method="post" action="">
		<input type="hidden" name="id" value="<?=$data['id']?>">

		Название:<br>
		<input type="text" name="title" value="<?=$data['title']?>" maxlength="200" id="text_input"/><br>
		<br>
		Тег "description":<br>
		<textarea name="description" id="textarea_input" class="mini_textarea"><?=$data['description']?></textarea>
		<br><br>
		Тег "keywords":<br>
		<textarea name="keywords" id="textarea_input" class="mini_textarea"><?=$data['keywords']?></textarea>
		<br><br>
		<input type="submit" value="Сохранить" name="update-category-button" id="button" class="normal_button">
	</form>
	<?
}
else if ($mode == 'by_id')
{
	// добавить добавление картинок, форматтер текста !!!
	
	$data = get_good_data($id);
	
	$category_data = get_category_data($data['category_id']);
	$url = '?act='.$act_array[$act_index]['short'].'&category_id='.$data['category_id'];
	
	?>
	<h3>Редакирование товара (категория: <a href="<?=$url?>"><?=$category_data['title']?></a>):</h3>
	<form method="post" action="">
		<input type="hidden" name="id" value="<?=$data['id']?>">

		Наименование:<br>
		<input type="text" name="title" value="<?=$data['title']?>" maxlength="200" id="text_input"/><br>
		<br>
		Информация о товаре:<br>
		<textarea name="info" id="textarea_input" class="normal_textarea"><?=$data['info']?></textarea>
		<br><br>
		Цена <span>(цифра, в рублях)</span>:<br>
		<input type="text" name="cost" value="<?=$data['cost']?>" maxlength="200" id="mini_text_input"/><br>
		<br>
		Популярность <span>(цифра)</span>:<br>
		<input type="text" name="popularity" value="<?=$data['popularity']?>" maxlength="200" id="mini_text_input"/><br>
		<br>
		Тег "description":<br>
		<textarea name="description" id="textarea_input" class="mini_textarea"><?=$data['description']?></textarea>
		<br><br>
		Тег "keywords":<br>
		<textarea name="keywords" id="textarea_input" class="mini_textarea"><?=$data['keywords']?></textarea>
		<br><br>
		<input type="submit" value="Сохранить" name="update-good-button" id="button" class="normal_button">
	</form>
	
	<br><br><br><br><br><br>
	
	<h3>Коментарии к этому товару:</h3>
	
	<?
	// получаем все комментарии и выводим на экран с кнопками для удаления !!!!
	$comments = get_comments_by_good_id($id);

	if (!$comments)
		echo '<h4>Нет комментариев!</h4>';
	else
	{
		echo '<table width="90%">';
		
		for ($i = 0; $i < count($comments); $i++)
		{
			$comment_id = $comments[$i]['id'];
			$author_info = $comments[$i]['author_info'];
			$text = $comments[$i]['text'];
			$date = $comments[$i]['date'];

			?>
			<tr>
				<td>
					<p>Автор: <b><?=$author_info?></b></p>
					<p>Дата: <b><?=$date?></b></p>
					<p>Комментарий: <b><?=$text?></b></p>
				</td>
				<td width="*"></td>
				<td align="right">
					<form method="post" action="">
						<input type="hidden" name="id" value="<?=$comment_id?>">
						<input type="submit" value="Удалить" name="delete-comment-button" id="button" class="mini_button">
					</form>
				<br>
				</td></tr>
			<?
		}
		
		echo '</table>';
	}
	
	?>
	<br><br><br><br><br><br>
	
	<form method="post" action="">
		<h3>Добавление нового комментария:</h3>
		Информация о авторе:<br><br>
		<input type="text" name="author_info" maxlength="100" id="text_input"/><br><br>
		Комментарий:<br>
		<textarea name="text" id="textarea_input" class="mini_textarea"></textarea>
		<br><br>
		Дата <span>(формат: гггг-мм-дд):</span>:<br><br>
		<input type="text" name="date" maxlength="100" id="text_input"/><br><br>
		
		<input type="hidden" name="good_id" value="<?=$id?>">
		
		<input type="submit" value="Добавить" name="comment-reg-button" id="button" class="normal_button">
	</form>
	<?
}
?>