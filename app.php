<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

<link
    href="https://fonts.googleapis.com/css2?family=Instrument+Serif:ital@0;1&family=Work+Sans:wght@400;500;600&family=IBM+Plex+Mono:wght@500&display=swap"
    rel="stylesheet"
>

<link rel="stylesheet" href="/src/assets/css/main.css">
<link rel="stylesheet" href="/src/assets/css/home.css">

<?php

require 'src/db/DBconnection.php';



$routes = [
    'home' => 'src/view/home.php',
     'login' => 'src/view/login.php',
];

$page = $_GET['page'] ?? '';

if (!is_string($page)) {
    $page = '';
}

if ($page !== '' && isset($routes[$page])) {
    $title = 'MS | ' . htmlspecialchars($page, ENT_QUOTES, 'UTF-8');
    include_once $routes[$page];
  
}else {
    $title = 'MS';
    include_once 'src/view/index.php';
}