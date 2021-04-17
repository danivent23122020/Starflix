<?php 
/**
 * Connexion à la base de données.
 */
define('DB_SERVER', 'sql364.main-hosting.eu');
define('DB_USERNAME', 'u949344532_starflix');
define('DB_PASSWORD', 'x0K??+5K');
define('DB_NAME', 'u949344532_starflix');

function getPDO() {
    try{
        $pdo = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_NAME, DB_USERNAME, DB_PASSWORD);
// Set the PDO error mode to exception
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch(PDOException $e){
        die("ERROR: Could not connect. " . $e->getMessage());
    }
}

// fonction recherche doublon dans la BDD pour l'inscription et les modifications sur la page infos utilisateur
function countDatabaseValue($connexionBDD, $key, $value) {
$request = "SELECT * FROM users WHERE $key = ?";
$rowCount = $connexionBDD->prepare($request);
$rowCount->execute(array($value));
return $rowCount->rowCount();
}
?>