<?php
define('DB_SERVER', 'sql364.main-hosting.eu');
define('DB_USERNAME', 'u949344532_starflix');
define('DB_PASSWORD', 'x0K??+5K');
define('DB_NAME', 'u949344532_starflix');

/* Attempt to connect to MySQL database */
try {
$pdo = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_NAME, DB_USERNAME, DB_PASSWORD);
// Set the PDO error mode to exception
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e){
die("ERROR: Could not connect. " . $e->getMessage());
}
?>