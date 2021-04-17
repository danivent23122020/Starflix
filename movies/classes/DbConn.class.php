

<?php


class DbConn {
    
    // private $host = 'sql364.main-hosting.eu';
    // private $user = 'u949344532_starflix';
    // private $pwd = 'x0K??+5K';
    // private $dbName = 'u949344532_starflix';


    // protected function connect() {

    //     try {
            
    //         $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbName;
    //         $pdo = new PDO($dsn, $this->user, $this->pwd);
    //         $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    
    //         return $pdo;
            
    //     } catch (PDOException $e) {

    //         die("ERROR: Could not connect. " . $e->getMessage());
    //     }
    // }


    // ::///////////

    // private $host = 'localhost';
    // private $user = 'root';
    // private $pwd = '';
    // private $dbName = 'u949344532_starflix';

    protected function connect() {

        static $pdo = null;

        if ($pdo === null) {         
            // $host = 'localhost';
            // $user = 'root';
            // $pwd = '';
            // $dbName = 'u949344532_starflix';
             $host = 'sql364.main-hosting.eu';
             $user = 'u949344532_starflix';
             $pwd = 'x0K??+5K';
             $dbName = 'u949344532_starflix';
    
            $pdo = new PDO("mysql:host=$host;dbname=$dbName", 
            $user, $pwd); 
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
            $pdo->exec('SET NAMES utf8');
        }

        return $pdo;

        // $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbName;
        // $pdo = new PDO($dsn, $this->user, $this->pwd);
        // $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

        // return $pdo;
    }


}

?>

