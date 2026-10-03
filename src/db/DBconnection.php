<?php



$host     = getenv('DB_HOST');
$username = getenv('DB_USER');
$password = getenv('DB_PASSWORD');
$port     = (int) getenv('DB_PORT');
$dbname   = getenv('DB_NAME');

$conn = mysqli_init();

// Aiven requires SSL. Download ca.pem from your service's Overview page
// and add "ca.pem" to .gitignore or keep it outside the repo.
mysqli_ssl_set($conn, null, null, __DIR__ . '/ca.pem', null, null);

if (!mysqli_real_connect($conn, $host, $username, $password, $dbname, $port, null, MYSQLI_CLIENT_SSL)) {
    echo "Cannot connect to database";
} else {
    echo "connected successfully";
}