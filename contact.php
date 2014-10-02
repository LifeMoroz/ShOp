<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="utf-8">
    <title>Open Smile</title>
    <LINK REL=stylesheet TYPE="text/css" HREF="css/style.css"/>
    <script type="text/javascript" src="jquery-2.1.1.js"></script>
    <script type="text/javascript" src="js/header.js"></script>
    <script type="text/javascript" src="js/contacts.js"></script>
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
        <a class="header_menu_link" href="blog.php">Блог</a>
        <a class="header_menu_link active" href="contact.html">Контакты</a>

        <form class="header_menu_search">
            <input class="header_menu_search_input">
            <button class="header_menu_search_icon"></button>
        </form>
    </div>
</div>
<h1 class="line">КОНТАКТЫ</h1>
<div class="contact__text">
    <!--<strong>8(495)123-32-35</strong> пн-пт 1000 -1730<br>
    <br>
    г.Москва, Малый Толмачевский переулок, дом 8, стр.1.<br>
    <br>
    Как нас найти?
    Пешком от метро «Третьяковская»: выход из метро на станции «Третьяковская» в сторону Третьяковской галереи, поворот
    налево. На зеленый сигнал светофора переходите улицу по пешеходному переходу. Оказавшись в Ордынском тупике или в
    Большом Толмачевском переулке, идите прямо, минуя здание Третьяковской галереи (по правую руку). Далее, направо –
    Малый Толмачевский переулок, проходите чуть дальше – дом №8, строение 1 – наш пункт самовывоза, вход с улицы, третий
    подъезд от метро. Время в пути от метро: 4 минуты. <br>
    <img src="img/map.png" style="margin-left: 305px"> -->
    <? get_text_data(2); ?>
</div>
</body>
</html>