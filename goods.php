<?
include_once('include/config.php');

include_once('include/constants.php');

include_once('include/db_functions.php');
include_once('functions/all_functions.php');

define('FROM_INDEX', true);

$db = db_connect();


$slides = get_slider_data(2);


if (isset($_GET['id'] /* and это число*/))
	$category_id = $_GET['id'];
else $category_id = 0;

$category_data = get_category_data($category_id);
	
$title = $category_data['title'];
if ($category_id == 0) $title = 'Товары';
	
$goods = get_goods_list_by_category_id($category_id);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title><?=SITE_NAME?></title>
	
    <link rel="stylesheet" type="text/css" href="css/style.css"/>
	
    <script type="text/javascript" src="include/js/jquery-2.1.1.js"></script>
	
    <script type="text/javascript" src="js/header.js"></script>
    <script type="text/javascript" src="js/goods.js"></script>
	
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
			<a class="header_menu_link active" href="goods.php">Товары</a>
			<a class="header_menu_link" href="blog.php">Блог</a>
			<a class="header_menu_link" href="contact.php">Контакты</a>

			<form class="header_menu_search">
				<input class="header_menu_search_input">
				<button class="header_menu_search_icon"></button>
			</form>
		</div>
	</div>
	
	<div class="wrapper">
		<div class="container">
			<?php
			$main_categories = get_main_categories_list(); // см. первые 4 категории в базе - они из тз. почти константы
			$category_data = get_category_data($subcategories[0]['id']);
			
			?>
			<div class="menu_wrapper">
				<div class="panel-group" id="accordion">
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">
								<img class="panel_heading_img" src="./<?=$main_categories[0]['img']?>">
								<a data-toggle="collapse" data-parent="#accordion" href="#mcat-<?=$main_categories[0]['id']?>">
										<?=$main_categories[0]['title']?>
								</a>
							</h4>
						</div>
						<div id="mcat-<?=$main_categories[0]['id']?>" class="panel-collapse collapse in">
							<?php
							$subcategories = get_categories_list_by_parent_id($main_categories[0]['id']);
							
							foreach ($subcategories as $s) 
							{ 
								?>
								<div class="panel-body">
									<a class="panel_menu_link" href="goods.php?id=<?=$s['id']?>"><?=$s['title']?></a>
								</div>
								<?php
							} 
							?>
						</div>
					</div>
					<?php
					for ($i = 1; $i < count($main_categories); $i++) 
					{ 
						?>
						<div class="panel panel-default">
							<div class="panel-heading">
								<h4 class="panel-title">
									<img class="panel_heading_img" src="<?=$main_categories[$i]['img']?>">
									<a data-toggle="collapse" data-parent="#accordion" href="#mcat-<?=$main_categories[$i]['id']?>">
										<?=$main_categories[$i]['title']?>
									</a>
								</h4>
							</div>
							<div id="mcat-<?=$main_categories[$i]['id']?>" class="panel-collapse collapse">
								<?php
								$subcategories = get_categories_list_by_parent_id($main_categories[$i]['id']);
								
								foreach ($subcategories as $s) 
								{ 
									?>
									<div class="panel-body">
										<a class="panel_menu_link" href="goods.php?id=<?=$s['id']?>"><?=$s['title']?></a>
									</div>
									<?php
								} 
								?>
							</div>
						</div>
					<?php
					}
					?>
				</div>
			</div>
			<div class="goods_slider">
				<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
					<!-- Indicators -->
					<ol class="carousel-indicators">
						<?php
						for ($i = 0; $i < count($slides); $i++) 
						{
							?>
							<li data-target="#carousel-example-generic" data-slide-to="<?=$i?>" class="active"></li>
							<?php
						} 
						?>
					</ol>
					<!-- Wrapper for slides -->
					<div class="carousel-inner" style="height: 350px">
						<div class="item active">
							<img src="<?=$slides[0]['img']?>" alt="" style="width: 100%; height: 100%;">
							<div class="carousel-caption"></div>
						</div>
						
						<?php
						for ($i = 0; $i < count($slides); $i++)
						{ 
							?>
							<div class="item">
								<img src="<?=$slides[$i]['img']?>" alt="" style="width: 100%; height: 100%;">
								<div class="carousel-caption"></div>
							</div>
							<?php
						} 
						?>	
					</div>

					<!-- Controls -->
					<a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
						<span class="glyphicon glyphicon-chevron-left"></span>
					</a>
					<a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
						<span class="glyphicon glyphicon-chevron-right"></span>
					</a>
				</div>
			</div>
		</div>
		
		<h1 class="line"><?=$title?></h1>
		<div class="goods_container">
			<?php
			if ($goods)
				foreach ($goods as $good) 
				{ 
					?>
					<div class="good">
						<div class="good_img_wrapper" data-toggle="modal" data-target="#<?=$good['id']?>">
							<img class="good_img" src="<?=$good['img']?>">
						</div>
						<a class="good_title" data-toggle="modal" data-target="#myModal"><?=$good['title']?></a>
							<br>
							<span class="good_price" data-toggle="modal" data-target="#myModal"><?=$good['cost']?> р.</span>
							<button class="green_button" data-id='id_<?=$good['id']?>'>Купить</button>
						</a>
					</div>
					
					<div class="modal fade" id="<?=$good['id']?>" tabindex="-1" role="dialog" aria-labelledby="title-<?=$good['id']?>"
						 aria-hidden="true">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header modal-goods">
									<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span>
										<span class="sr-only">Close</span></button>
									<h4 class="modal-title" id="title-<?=$good['id']?>"><?=$good['title']?></h4>
								</div>
								<div class="modal-body">
									<div class="modal_good_wrapper">
										<div class="modal_good_img_wrapper">
											<img class="modal_good_img_main" src="<?=$good['img']?>"/>
										</div>
										<div class="modal_good_main_description">Описание: <p> <?=$good['description']?>
										</div>
									</div>
									<div class="modal-footer">
										<span class="good_price"><?=$good['cost']?> р.</span>
										<button type="button" class="red_button_modal" data-dismiss="modal">Close</button>
										<button type="button" class="green_button_modal">Save changes</button>
									</div>
								</div>
							</div>
						</div>
					</div>
					<?php
				}
			else echo '<h4>Нет товаров!</h4>';
			?>
		</div>
	</div>
</body>
</html>