<?
include_once('include/config.php');

include_once('include/constants.php');

include_once('include/db_functions.php');
include_once('functions/all_functions.php');

define('FROM_INDEX', true);

$db = db_connect();


$articles = get_articles_list();

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title><?=SITE_NAME?></title>
	
    <link rel="stylesheet" type="text/css" href="css/style.css"/>
	
    <script type="text/javascript" src="include/js/jquery-2.1.1.js"></script>
	
    <script type="text/javascript" src="js/header.js"></script>
    <script type="text/javascript" src="js/contacts.js"></script>
	
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>
    <script type="text/javascript" src="js/bootstrap.js"></script>
</head>
<body style="width: 1260px">
	<div class="header">
		<div class="header_links_wrapper">
			<a class="header_link header_link_logo">
				<i class="header_link_logo_site_name"><?=SITE_NAME?></i>
				<br>
				<i class="header_link_logo_slogan"><?=SLOGAN?></i>
			</a>
			<a class="header_link header_no_link_phone"><?=PHONE_NUMBER?></a>
			<a class="header_link header_link_cart">Корзина(<?=count_goods_in_cart()?>)</a>
			<a class="header_link header_link_auth">
				<? if (!is_user_logged_in()) { ?> Войти <? } else { ?> Выйти <? } ?>
			</a>
		</div>
		<div class="header_menu">
			<a class="header_menu_link" href="index.php">Главная</a>
			<a class="header_menu_link" href="goods.php">Товары</a>
			<a class="header_menu_link" href="blog.php">Блог</a>
			<a class="header_menu_link active" href="contact.php">Контакты</a>

			<form class="header_menu_search">
				<input class="header_menu_search_input">
				<button class="header_menu_search_icon"></button>
			</form>
		</div>
	</div>
	
	<h1 class="line">КОНТАКТЫ</h1>
	<div class="contact_text">
		<?php 
		$data = get_text_data(2); 
		echo $data['text'];
		?>
	</div>
</body>
</html>