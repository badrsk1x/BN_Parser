<?php

if (!isset($_COOKIE['js'])) {
    $hash = md5($_SERVER['HTTP_USER_AGENT'] . 'is Javascriptable');
    setcookie('js', $hash);
    $_COOKIE['js'] = $hash;
}