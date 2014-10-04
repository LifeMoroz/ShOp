<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title><?echo SITE_NAME ?></title>
    <LINK REL=stylesheet TYPE="text/css" HREF="css/style.css"/>
    <script type="text/javascript" src="jquery-2.1.1.js"></script>
    <script type="text/javascript" src="js/header.js"></script>
    <script type="text/javascript" src="js/goods.js"></script>
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
        <?
        $main_categories = get_main_categories_list(); // см. первые 4 категории в базе - они из тз. почти константы
        $category_data = get_category_data($subcategories[0]['id']);
        ?>
        <div class="menu_wrapper">
            <div class="panel-group" id="accordion">
            <? for ($i=0;$i<count($main_categories); $i++) { ?>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <img class="panel_heading_img" src="<?echo $main_categories[$i]['img'] ?>">
                        <a data-toggle="collapse" data-parent="#accordion" href="#mcat-<?echo $main_categories[$i]['id'] ?>">
                            <?echo $main_categories[$i]['title'] ?>
                        </a>
                    </h4>
                </div>
                <div id="mcat-<?echo $main_categories[$i]['id'] ?>" class="panel-collapse collapse in">
                    <? $subcategories = get_categories_list_by_parent_id($main_categories[$i]['id']); ?>
                    <? foreach ($subcategories as $s) { ?>
                    <div class="panel-body">
                        <a class="panel_menu_link" href="goods.php/<?$s['id']?>"><?echo $s['title'] ?></a>
                    </div>
                    <? } ?>
                </div>
            </div>
            <? } ?>
        </div>
        </div>
        <div class="goods_slider">
            <? $slides = get_slider_data(2); // слайдер на главной ?>
            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                <!-- Indicators -->
                <ol class="carousel-indicators">
                    <? for ($i = 0; $i < count($slides); $i++) {?>
                        <li data-target="#carousel-example-generic" data-slide-to="<?echo $i?>" class="active"></li>
                    <? } ?>
                </ol>
                <!-- Wrapper for slides -->
                <div class="carousel-inner">
                    <? $first_slide = array_shift($slides)?>
                    <div class="item active">
                        <img src="<?echo  $first_slide['img'] ?>" alt="<?echo  $first_slide['alt'] ?>">

                        <div class="carousel-caption">
                        </div>
                    </div>
                    <? foreach ($slides as $slide) { ?>
                        <div class="item active">
                            <img src="<?echo  $slide['img'] ?>" alt="<?echo  $slide['alt'] ?>">

                            <div class="carousel-caption">
                            </div>
                        </div>
                    <? } ?>
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
    <h1 class="line"><? echo $value=(isset($_GET['value']))? get_category_data($_GET['value'])['title'] : 'ТОВАРЫ'; ?></h1>
    <div class="goods_container">
        <?
        $goods = get_goods_list_by_category_id((isset($_GET['value']))? $_GET['value'] : 0 );
        foreach ($goods as $good) { ?>
        <div class="good">
            <div class="good_img_wrapper" data-toggle="modal" data-target="#<?echo $good['id']?>">
                <img class="good_img" src="<?echo $good['img']?>">
            </div>
            <a class="good_title" data-toggle="modal" data-target="#myModal"><?echo $good['title']?>/a>
                <br>
                <span class="good_price" data-toggle="modal" data-target="#myModal"><?echo $good['price']?> р.</span>
                <button class="green_button" data-id='id_<?echo $good['id']?>'>Купить</button>
        </div>
        <div class="modal fade" id="<?$good['id']?>" tabindex="-1" role="dialog" aria-labelledby="title-<?$good['id']?>"
             aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header modal-goods">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span>
                            <span class="sr-only">Close</span></button>
                        <h4 class="modal-title" id="title-<?$good['id']?>"><?$good['title']?></h4>
                    </div>
                    <div class="modal-body">
                        <div class="modal_good_wrapper">
                            <div class="modal_good_img_wrapper">
                                <img class="modal_good_img_main" src="<?$good['img']?>"/>
                            </div>
                            <div class="modal_good_main_description">Описание: <p> <?$good['description']?>
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
            <?}?>
        </div>
    </div>
</body>
</html>