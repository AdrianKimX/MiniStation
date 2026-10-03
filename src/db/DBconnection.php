<?php

// Load local config only if it exists (it won't on Vercel)
$local = __DIR__ . '/config.local.php';
if (file_exists($local)) {
    require_once $local;
}

function env($key) {
    $v = getenv($key);
    if ($v === false) {
        $v = $_ENV[$key] ?? $_SERVER[$key] ?? null;
    }
    return $v;
}

$host     = env('DB_HOST');
$username = env('DB_USER');
$password = env('DB_PASSWORD');
$port     = (int) env('DB_PORT');
$dbname   = env('DB_NAME');

$conn = mysqli_init();

// Aiven requires SSL
mysqli_ssl_set($conn, null, null, __DIR__ . '/ca.pem', null, null);

if (!mysqli_real_connect($conn, $host, $username, $password, $dbname, $port, null, MYSQLI_CLIENT_SSL)) {
    error_log('DB connection failed: ' . mysqli_connect_error());
    die('Cannot connect to database');
}