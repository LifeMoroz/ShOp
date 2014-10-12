<?php
session_start();

define("URI_PATH", "http://{$_SERVER['HTTP_HOST']}");
define("ADMIN_URI_PATH", "http://{$_SERVER['HTTP_HOST']}/admin");

// пути к изображениям из корня сайта -----------------------------------------
define("GALLERY_PATH", "/gallery/");

define("GOODS_GALLERY_PATH", GALLERY_PATH."goods/");
define("ARTICLES_GALLERY_PATH", GALLERY_PATH."articles/");

define("SLIDER1_GALLERY_PATH", GALLERY_PATH."slider1/");
define("SLIDER2_GALLERY_PATH", GALLERY_PATH."slider2/");


define("FULL_GALLERY_PATH", $_SERVER['DOCUMENT_ROOT']."/gallery/");

define("FULL_GOODS_GALLERY_PATH", FULL_GALLERY_PATH."goods/");
define("FULL_ARTICLES_GALLERY_PATH", FULL_GALLERY_PATH."articles/");

define("FULL_SLIDER1_GALLERY_PATH", FULL_GALLERY_PATH."slider1/");
define("FULL_SLIDER2_GALLERY_PATH", FULL_GALLERY_PATH."slider2/");
// ----------------------------------------------------------------------------

define("SALT", "dd_shop");
?>