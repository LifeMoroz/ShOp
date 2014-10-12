<?
if (!defined('FROM_INDEX')) go_to_error404_page();


if ($_POST['delete-admin-button'])
{
	delete_admin($_POST['id']);
}
else if ($_POST['up-admin-button'])
{
	up_admin($_POST['id']);
}
else if ($_POST['down-admin-button'])
{
	down_admin($_POST['id']);
}
else if ($_POST['admin-reg-button'])
{
	if ($_POST['is_main']) $rights = 1;
	else $rights = 0;
	
	register_admin($_POST['email'], $_POST['name'], $rights);
}



$administrators = get_administrators_list();

if (count($administrators) > 1) 
{
	echo '<h3>Список администраторов:</h3>';

	for ($i = 0; $i < count($administrators); $i++)
	{
		$id = $administrators[$i]['id'];
		
		$email = $administrators[$i]['email'];
		$name = $administrators[$i]['name'];
		$rights = $administrators[$i]['rights'];
		
		if ($rights) $is_main_admin = ', Главный администратор';
		else $is_main_admin = '';
		
		
		if ($_SESSION['admin']['rights'] and $id != $_SESSION['admin']['id'])
		{
			if ($rights)
			{
				$b_v = 'Понизить';
				$b_n = 'down-admin-button';
			}
			else
			{
				$b_v = 'Сделать главным';
				$b_n = 'up-admin-button';
			}
			
			$up_form = '
				<form method="post" action="">
					<input type="hidden" name="id" value="'.$id.'">
					<input type="submit" value="'.$b_v.'" name="'.$b_n.'" id="button" class="mini_button">
                </form>
            ';
			
			$deleting_form = get_delete_smth_form($id, 'delete-admin-button');
		}

		echo '
            <table width="90%">
            <tr>
                <td width="400">
                    E-mail: <b>'.$email.'</b><br>
                    Имя: <b>'.$name.'</b>'.$is_main_admin.'
                </td>
                <td width="*">
                </td>
                <td width="130">
			        '.$up_form.'
                </td>
                <td width="130">
			        '.$deleting_form['button'].'
                </td>
            </tr>
            </table>
			<br>
		';

        echo $deleting_form['modal'];
	}
	
	echo '<br><br><br><br>';
}

if ($_SESSION['admin']['rights'])
{
	?>
	<form method="post" action="">
		<h3>Добавление нового администратора:</h3>
		E-mail:<br>
		<input type="text" name="email" value="<?=$_POST['email']?>" maxlength="40" id="text_input"/><br>
		<br>
		Имя:<br>
		<input type="text" name="name" value="<?=$_POST['name']?>" maxlength="100" id="text_input"/>
		<br><br>
		<input type="checkbox" name="is_main"> Главный администратор</input>
		<br><br>
		<input type="submit" value="Добавить" name="admin-reg-button" id="button" class="normal_button">
	</form>
	<?
}
?>