<?
include_once('../include/config.php');
include_once('include/admin_config.php');

include_once('../include/db_functions.php');

include_once('../functions/all_functions.php');

include_once('functions/work_admin_functions.php');
include_once('functions/admin_user_functions.php');


define('FROM_INDEX', true);

$db = db_connect();



if ($_POST['admin-log-out-button']) log_out_admin();


if (!is_admin_logged_in())
{
	include_once('auth.php');
	
	if (!is_admin_logged_in()) 
		exit_index($db);
}
// ======

	$act_array = get_admin_acts();
	$act_index = find_act($_GET['act'], $act_array);
	
	if ($act_index < 0) $act_index = 0;
	
	$act = $act_array[$act_index]['short'];
	
	// далее - костыль =(
	if (strstr($act, 'info_'))
	{
		$text_id = $act[5];
		
		if ($text_id != 1 and $text_id != 2 and $text_id != 3)
			go_to_error404_page();
			
		$act = 'act_texts';
	}
	else if (strstr($act, 'fbm_'))
	{
		$messages_type = $act[4]; 
		
		if ($messages_type != 1 and $messages_type != 2)
			go_to_error404_page();
		
		$act = 'act_feedback_messages';
	}
	else $act = 'act_'.$act;
	//	конец костыля =)
	
	// еще один костыль: связан с тем, что "супер текстареа" требует определенную версию jquery
	$include_editor = '
		<script type="text/javascript" src="include/js/jquery-1.6.4.min.js"></script> 
		<script type="text/javascript" src="editor/editor.js"></script>
		<link rel="stylesheet" href="editor/css/editor.css" type="text/css"/>
		';
		
	$include_bootstrap = '
		<script type="text/javascript" src="./include/js/jquery-2.1.1.js"></script>

        <link rel="stylesheet" type="text/css" href="include/bootstrap/css/bootstrap.css"/>
        <script type="text/javascript" src="include/bootstrap/js/bootstrap.js"></script>
		';
	
	if ($act == 'act_texts' or ($act == 'act_articles' and isset($_GET['id'])))
		$include = $include_editor;
	else $include = $include_bootstrap;
	//	конец костыля
	
	?>
	<!DOCTYPE html PUBLIC  "-//W3C//DTD XHTML 1.0 Strict//EN" "www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <link type="text/css" rel="stylesheet" href="style/style.css"/>

		<?=$include?>

		<title><?=$act_array[$act_index]['full']?></title>
	</head>
	
	<body>
		<br>
		<div style="position: absolute; left: 40px;">
			Добро пожаловать в панель администратора, <b><?=$_SESSION['admin']['name']?></b>!<br>
			Ваш e-mail: <b><?=$_SESSION['admin']['email']?></b>
			<br>
			<div style="margin-top: 5px; margin-bottom: 9px"><b><a href="<?=URI_PATH?>" target="blank">Перейти на сайт</a></b></div>
			<form method="post" action="">
				<input type="submit" value="Выйти" name="admin-log-out-button" id="button" class="mini_button">				
			</form>
		</div>
		
		
		<br><br><br><br><br><br><br>
		<table width="100%"><tr valign="top">
			<td width="40"></td>
			<td width="200">
				<h3>Навигация:</h3>
				
				<?
					for ($i = 0; $i < count($act_array); $i++)
					{
						if ($i == 4 or $i == 5 or $i == 6 or $i == 8) echo '<br>';
						
						echo '
							<div>
								<a href="'.ADMIN_URI_PATH.'/?act='.$act_array[$i]['short'].'"> 
									'.$act_array[$i]['full'].' 
								</a>
							</div>
							<br>
						';
					}
				?>
				
				<br><br><br>
				<b><a href="">Обновить страницу</a></b>
				<br><br><br><br>
			</td>
			<td width="5%"></td>
			<td width="*">
				
				<? include_once($act.'.php'); ?>
				
				<br><br><br><br>
				
			</td>
			<td width="2%"></td>
		</tr></table>
	</body>
	</html>
	<?
	
// ======
exit_index($db);


// ===
function exit_index($db)
{
	db_disconnect($db);
	exit();
}
?>