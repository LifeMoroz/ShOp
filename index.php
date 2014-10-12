<!DOCTYPE html>
<html>
<head>
    <?
    include_once('include/config.php');
    include_once('include/db_functions.php');
    include_once('functions/all_functions.php');
    ?>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <title><?echo SITE_NAME ?></title>
    <LINK REL=stylesheet TYPE="text/css" HREF="css/style.css"/>
    <script type="text/javascript" src="jquery-2.1.1.js"></script>
    <script type="text/javascript" src="js/main.js"></script>
    <script type="text/javascript" src="js/header.js"></script>
    <link rel=stylesheet type="text/css" href="css/bootstrap.css"/>
    <script type="text/javascript" src="js/bootstrap.js"></script>
</head>
<body style="width: 1260px">
<div class="header">
    <div class="header_links_wrapper">
        <a class="header_link header_link_logo">
            <i class="header_link_logo_site_name"><?echo SITE_NAME ?></i>
            <br>
            <i class="header_link_logo_slogan"><?echo SLOGAN ?></i>
        </a>
        <a class="header_link header_no_link_phone"><?echo PHONE_NUMBER ?></a>
        <a class="header_link header_link_cart">Корзина(7)</a>      <!-- Cюда циферку -->
        <a class="header_link header_link_auth"><? if (!is_user_logged_in()) { ?>Войти<? } else {?>Выйти <?}?></a>
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
                <a class="box_redial" data-toggle="modal" data-target="#Recall">перезвоните нам</a>
            </div>
            <div class="box_wrapper">
                <div class="box_review" data-toggle="modal" data-target="#Opinion">ваше мнение важно для нас</div>
            </div>
        </div>
        <div class="carousel_container">
            <? $slides = get_slider_data(1); // слайдер на главной ?>
            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                <!-- Indicators -->
                <ol class="carousel-indicators">
                    <? for ($i = 0; $i < count($slides); $i++) {?>
                    <li data-target="#carousel-example-generic" data-slide-to="<?echo $i?>" class="active"></li>
                    <? } ?>
                </ol>
                <!-- Wrapper for slides -->
                <div class="carousel-inner" style="height: 510px;">
                    <? $first_slide = array_shift($slides)?>
                    <div class="item active">
                        <img src="<?echo  $first_slide['img'] ?>" alt="<?echo  $first_slide['alt'] ?>" style="height: 100%;">

                        <div class="carousel-caption">
                        </div>
                    </div>
                    
					<? foreach ($slides as $slide) { ?>
                    <div class="item">
                        <img src="<?=$slider['img']?>" alt="х" style="height: 100%;">

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
    <?
    $goods = get_popular_goods();
    if ($goods) {?>
    <h1 class="line">ХИТЫ ПРОДАЖ</h1>
    <??>

    <div class="goods_container">
        <? foreach ($goods as $good) { ?>
        <div class="good">
            <div class="good_img_wrapper" data-toggle="modal" data-target="#<?echo $good['id']?>">
                <img class="good_img" src="<?echo $good['img']?>">
            </div>
            <a class="good_title" data-toggle="modal" data-target="#myModal"><?echo $good['title']?></a>
            <br>
            <span class="good_price" data-toggle="modal" data-target="#myModal"><?echo $good['price']?> р.</span>
            <button class="green_button" data-id='id_<?echo $good['id']?>'>Купить</button>
        </div>
        <div class="modal fade" id="<?echo $good['id']?>" tabindex="-1" role="dialog" aria-labelledby="title-<?echo $good['id']?>"
             aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header modal-goods">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span>
                                class="sr-only">Close</span></button>
                        <h4 class="modal-title" id="title-<?echo $good['id']?>"><?echo $good['title']?></h4>
                    </div>
                    <div class="modal-body">
                        <div class="modal_good_wrapper">
                            <div class="modal_good_img_wrapper">
                                <img class="modal_good_img_main" src="<?echo $good['img']?>"/>
                                <img class="modal_good_img_small" src="<?echo $good['img']?>"/>
                                <img class="modal_good_img_small" src="<?echo $good['img']?>"/>
                                <img class="modal_good_img_small" src="<?echo $good['img']?>"/>
                            </div>
                            <div class="modal_good_main_description">Описание: <p> <?echo $good['description']?></div>
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
    <?}}?>
    </div>
        <? $articles = get_popular_articles();
        if ($articles) {?>
    <h1 class="line">ОБСУЖДАЕМОЕ</h1>
    <div class="post_preview_container">
        <? foreach ($articles as $article) { ?>
        <div class="post_preview" style="width: 1150px">
            <div class="post_preview_datetime">
                <?echo  $article['date'] ?>
            </div>
            <div class="post_preview_title">
                <?echo  $article['title'] ?>
            </div><br>
            <div class="post_preview_img"></div>
            <div class="post_preview_text">
                <?echo  $article['description'] ?>
            </div>
            <div class="post_preview_watches">
                Просмотров: <?echo  $article['views_count'] ?>
            </div>
            <div class="post_preview_comments_counter">
                Комментариев: <?echo  $article['comments_count'] ?>
            </div>
            <div class="post_preview_author_wrapper">
                Автор: <p class="post_preview_author"><?echo  $article['author'] ?></p>
            </div>
            <a href='<?echo  $article['url'] ?>' class="post_preview_button_read">Читать</a>
        </div>
        <? } ?>
    </div>
    <? } ?>
</div>
<div class="modal fade" id="Delivery" tabindex="-1" role="dialog" aria-labelledby="delivery" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content modal-delivery">
            <div class="modal-header modal-delivery">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                        class="sr-only">Close</span></button>
                <h4 class="modal-title modal-delivery_title">ДОСТАВКА</h4>
            </div>
            <div class="modal-body modal-delivery">
                <!-- <div class="modal-delivery_subheader">Доставка курьером по Москве <i style="">Бесплатно!</i></div>
                <p class="modal-delivery_text">Доставка по Москве осуществляется собственными курьерами магазина Опен
                    Смайл, а так же внешней курьерской службой. Доставка заказа по Москве (в пределах МКАД)
                    осуществляется бесплатно . Доставка осуществляется с понедельника по пятницу с 10.00 до 21.00, в
                    субботу с 10:00 до 18:00.</p> -->
                <? get_text_data(3); ?>
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
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
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
            <div class="modal-header modal-delivery">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                        class="sr-only">Close</span></button>
                <h4 class="modal-title modal-recall_title">ОСТАВЬТЕ СООБЩЕНИЕ</h4>
            </div>
            <div class="modal-body modal-delivery">
                <label class="modal-recall_label">
                    Имя
                    <input class="modal-recall_input"/>
                </label>
                <label class="modal-recall_label">
                    E-mail
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

</body>
</html>