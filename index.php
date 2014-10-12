<?
include_once('include/config.php');

include_once('include/constants.php');

include_once('include/db_functions.php');
include_once('functions/all_functions.php');

define('FROM_INDEX', true);

$db = db_connect();


if ($_POST['add-call-me-message-button'])
{
	if ($_POST['name'] and $_POST['phone'] and $_POST['text'])
		add_new_call_me_message($_POST['name'], 'Телефон: '.$_POST['phone'], $_POST['text']);
}
else if ($_POST['add-about-us-message-button'])
{
	if ($_POST['name'] and $_POST['email'] and $_POST['text'])
		add_new_about_us_message($_POST['name'], 'E-mail: '.$_POST['email'], $_POST['text']);
}

	
$slides = get_slider_data(1);

?>
<!DOCTYPE html PUBLIC  "-//W3C//DTD XHTML 1.0 Strict//EN" "www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
	
    <title><?=SITE_NAME?></title>
	
    <link rel=stylesheet type="text/css" href="css/style.css"/>
	
    <script type="text/javascript" src="include/js/jquery-2.1.1.js"></script>
	
    <script type="text/javascript" src="js/main.js"></script>
    <script type="text/javascript" src="js/header.js"></script>
	
    <link rel=stylesheet type="text/css" href="css/bootstrap.css"/>
    <script type="text/javascript" src="js/bootstrap.js"></script>
</head>

<body style="width: 1260px">
<?php
print_r($_POST);
?>
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
        <a class="header_menu_link active" href="index.php">Главная</a>
        <a class="header_menu_link" href="goods.php">Товары</a>
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
	
        <div class="box_container">
            <div class="box_wrapper">
                <a class="box_delivery" data-toggle="modal" data-target="#Delivery">Информация о доставке</a>
            </div>
            <div class="box_wrapper">
                <a class="box_redial" data-toggle="modal" data-target="#Recall">Перезвоните нам</a>
            </div>
            <div class="box_wrapper">
                <div class="box_review" data-toggle="modal" data-target="#Opinion">Ваше мнение важно для нас</div>
            </div>
        </div>
		
        <div class="carousel_container">
            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                <!-- Indicators -->
                <ol class="carousel-indicators">
                    <? 
					for ($i = 0; $i < count($slides); $i++) 
					{
						?>
						<li data-target="#carousel-example-generic" data-slide-to="<?=$i?>" class="active"></li>
						<? 
					} 
					?>
                </ol>
                <!-- Wrapper for slides -->
                <div class="carousel-inner" style="height: 510px;">                   
					<div class="item active">
                        <img src="<?=$slides[0]['img']?>" alt="" style="width: 100%; height: 100%;">

                        <div class="carousel-caption">
                        </div>
                    </div>
                    
					<? 
					for ($i = 0; $i < count($slides); $i++)
					{ 
						?>
						<div class="item">
							<img src="<?=$slides[$i]['img']?>" alt="" style="width: 100%; height: 100%;">

							<div class="carousel-caption">
							</div>
						</div>
						<? 
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
    
	<?php
    $goods = get_top_goods(2);
	
    if ($goods) 
	{
		?>
		<h1 class="line">ХИТЫ ПРОДАЖ</h1>

		<div class="goods_container">
		
			<?php
			for ($i = 0; $i < count($goods); $i++) 
			{ 
				$good = $goods[$i];
				
				?>
				<div class="good">
					<div class="good_img_wrapper" data-toggle="modal" data-target="#<?=$good['id']?>">
						<img class="good_img" src="<?=$good['img']?>">
					</div>
					
					<a class="good_title" data-toggle="modal" data-target="#myModal"><?=$good['title']?>/a>
					<br>
					<span class="good_price" data-toggle="modal" data-target="#myModal"><?=$good['cost']?> р.</span>
					
					<button class="green_button" data-id='id_<?=$good['id']?>'>Купить</button>
				</div>
				
				<div class="modal fade" id="<?echo $good['id']?>" tabindex="-1" role="dialog" aria-labelledby="title-<?=$good['id']?>" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header modal-goods">
								
								<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span>
									<span class="sr-only">Close</span>
								</button>
								
								<h4 class="modal-title" id="title-<?=$good['id']?>"><?=$good['title']?></h4>
							</div>
							
							<div class="modal-body">
								<div class="modal_good_wrapper">
									<div class="modal_good_img_wrapper">
										<img class="modal_good_img_main" src="<?=$good['img']?>"/>
										<img class="modal_good_img_small" src="<?=$good['img']?>"/>
										<img class="modal_good_img_small" src="<?=$good['img']?>"/>
										<img class="modal_good_img_small" src="<?=$good['img']?>"/>
									</div>
									<div class="modal_good_main_description">Описание: <p><?=$good['info']?></p></div>
								</div>
							</div>
							<div class="modal-footer">
								<span class="good_price"><?echo $good['price']?> р.</span>
								<button type="button" class="red_button_modal" data-dismiss="modal">Close</button>
								<button type="button" class="green_button_modal">Save changes</button>
							</div>
						</div>
					</div>
				</div>
				<?php
			}
			?>
			
		</div>
	<?php
	}
   
	$articles = get_top_articles(1);
	
    if ($articles) 
	{
		?>
		<h1 class="line">ОБСУЖДАЕМОЕ</h1>
		
		<div class="post_preview_container">
		
			<?php
			for ($i = 0; $i < count($articles); $i++) 
			{ 
				$article = $articles[$i];
				$url = ''; //!!!
				
				?>
				<div class="post_preview" style="width: 1150px">
					<div class="post_preview_datetime">
						<?=$article['date']?>
					</div>
					<div class="post_preview_title">
						<?=$article['title']?>
					</div><br>
					<div class="post_preview_img"></div>
					<div class="post_preview_text">
						<?=$article['short_text']?>
					</div>
					<div class="post_preview_watches">
						Просмотров: <?=$article['views_count']?>
					</div>
					<div class="post_preview_comments_counter">
						Комментариев: <?=$article['comments_count']?>
					</div>
					<div class="post_preview_author_wrapper">
						Автор: <p class="post_preview_author"><?=$article['author']?></p>
					</div>
					<a href='<?=$url?>' class="post_preview_button_read">Читать</a>
				</div>
				<?php 
			} 
			?>
			
		</div>
    <?php 
	} 
?>

</div>



<div class="modal fade" id="Delivery" tabindex="-1" role="dialog" aria-labelledby="delivery" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content modal-delivery">
            <div class="modal-header modal-delivery">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                        class="sr-only">Close</span></button>
                <h4 class="modal-title modal-delivery_title"><?=$data['title']?></h4>
            </div>
            <div class="modal-body modal-delivery">
                <?php 
					$data = get_text_data(3); 
					echo $data['text'];
				?>
            </div>
            <div class="modal-footer modal-delivery">
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="Recall" tabindex="-1" role="dialog" aria-labelledby="recall" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content modal-recall">
            <div class="modal-header modal-delivery">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span>
                        class="sr-only">Close</span></button>
                <h4 class="modal-title modal-recall_title">ПЕРЕЗВОНИТЕ МНЕ</h4>
            </div>
            <div class="modal-body modal-delivery">
                <label class="modal-recall_label">
                    Имя
                    <input class="modal-recall_input"/>
                </label>
                <label class="modal-recall_label">
                    Телефон
                    <input class="modal-recall_input"/>
                </label>
                <label class="modal-recall_label" style="margin-top: 15px">
                    Комментарий
                    <input class="modal-recall_input" style="height: 100px; vertical-align: top; margin-top: -5px"/>
                </label>
            </div>
            <div class="modal-footer modal-delivery">
                <button type="button" class="green_button_modal" data-dismiss="modal">Отправить</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="Opinion" tabindex="-1" role="dialog" aria-labelledby="opinion" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content modal-recall">
			<form method="post" action="">
				<div class="modal-header modal-delivery">
					<button type="button" class="close" data-dismiss="modal">
						<span aria-hidden="true">&times;</span>
						<span class="sr-only">Close</span>
					</button>
					<h4 class="modal-title modal-recall_title">ОСТАВЬТЕ СООБЩЕНИЕ</h4>
				</div>
				<div class="modal-body modal-delivery">
					<label class="modal-recall_label">
						Имя:
						<input type="text" name="name" class="modal-recall_input"/>
					</label>
					<label class="modal-recall_label">
						E-mail:
						<input type="text" name="email" class="modal-recall_input"/>
					</label>
					<label class="modal-recall_label" style="margin-top: 15px">
						Комментарий:
						<textarea type="text" name="text" class="modal-recall_input" style="height: 100px; margin-top: -5px"></textarea>
					</label>
					<label class="modal-recall_label" style="margin-top: 15px">
						Внимание! Все поля должны быть заполнены!
					</label>
				</div>
				<div class="modal-footer modal-delivery">
					<button type="submit" name="add-about-us-message-button" class="green_button_modal" data-dismiss="modal">Отправить</button>
				</div>
			</form>
        </div>
    </div>
</div>

</body>
</html>