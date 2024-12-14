<?php
if (preg_match('/\.(?:png|jpg|jpeg|gif|css|js)$/', $_SERVER["REQUEST_URI"])) {
    return false;
} else {
    $route = trim($_SERVER['REQUEST_URI'], '/');
    parse_str('route=' . $route, $_GET);
    
    require __DIR__ . '/index.php';
}