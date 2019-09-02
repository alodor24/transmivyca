<?php

// Se definen las constantes de conexion
define('HOST','localhost');
define('USER','root');
define('PASSWORD','');
define('DB','transmivyca');

class Database {
    
    public $pdo;
    
    public function connection() {
        
        $this->pdo = null;
        
        try {

            $dsn = 'mysql:host=' . HOST . ';dbname=' . DB;
            $this->pdo = new PDO($dsn, USER, PASSWORD);
            $this->pdo->setAttribute(
                    PDO::ATTR_ERRMODE, 
                    PDO::ERRMODE_EXCEPTION
            );

        } catch(PDOException $e) {

            die('ERROR: ' . $e->getMessage());
        }
        return $this->pdo;
    }    
}
