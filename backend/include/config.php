<?php
session_start();

define("URI_PATH", "http://{$_SERVER['HTTP_HOST']}");
define("ADMIN_URI_PATH", "http://{$_SERVER['HTTP_HOST']}/admin");

define("SALT", "dd_shop");
?>