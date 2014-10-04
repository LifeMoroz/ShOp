<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title><?echo SITE_NAME ?></title>
    <LINK REL=stylesheet TYPE="text/css" HREF="css/style.css"/>
    <script type="text/javascript" src="jquery-2.1.1.js"></script>
    <script type="text/javascript" src="js/blog.js"></script>
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
        <a class="header_menu_link" href="index.php">Главная</a>
        <a class="header_menu_link" href="goods.php">Товары</a>
        <a class="header_menu_link active" href="blog.php">Блог</a>
        <a class="header_menu_link" href="contact.php">Контакты</a>

        <form class="header_menu_search">
            <input class="header_menu_search_input">
            <button class="header_menu_search_icon"></button>
        </form>
    </div>
</div>
<div style="position: relative">
    <h1 class="line">БЛОГ</h1>
    <form class="blog_search">
        <input class="blog_search_input">
        <button class="blog_search_icon"></button>
    </form>
    <div class="button-blog_write">Написать</div>
    <div class="post_preview_container">
        <?
        $articles = get_articles_list();
        foreach ($articles as $article) { ?>
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
</div>

</body>
</html>