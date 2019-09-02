<?php
require_once '../config/connection.php';

class Usuario {
    
    private $pdo;
    
    
    public function __CONSTRUCT() {
        
        $database = new Database();
		$db = $database->connection();
		$this->pdo = $db;        
    }
    
    // Registrar nuevo usuario
    public function Registrar($user, $password, $privilegio) {
        
        try {
            
            $sql = "SELECT usuario FROM usuario_sistema WHERE usuario = ?";
            $stm = $this->pdo->prepare($sql);
            $stm->execute(array($user));
            $row = $stm->fetch(PDO::FETCH_ASSOC);
            
            if ($row['usuario'] != $user) {
                
                $sql = "INSERT INTO usuario_sistema (usuario, password, privilegio) VALUES (?, ?, ?)";
                $stm = $this->pdo->prepare($sql);
                $stm->execute(array(
                            $user,
                            $password,
                            $privilegio
                ));
                return true;
                
            } else {
                return false;
            }
            
        } catch(PDOException $e) {
            die('ERROR: ' . $e->getMessage());
        }
    }
    
    // Login de acceso
    public function Ingresar($user, $password) {
        
        try {
            
            $sql = "SELECT * FROM usuario_sistema WHERE usuario = ?";
            $stm = $this->pdo->prepare($sql);
            $stm->execute(array($user));
            $row = $stm->fetch(PDO::FETCH_ASSOC);
            
            if ($stm->rowCount() == 1) {
                
				if (password_verify($password, $row['password'])) {  
                                        
                    session_start();
                    $_SESSION['user_session'] = $row['usuario'];
                    $_SESSION['privilegio'] = $row['privilegio'];
                    return true;
                    
				} else {                 
					return false;
				}
			}
        
        } catch(PDOException $e) {            
            die('ERROR: ' . $e->getMessage());
        }
    }
    
    // Verificar si ya existe una sesion establecida
    public function Loggedin() {
		
        if (isset($_SESSION['user_session']) && isset($_SESSION['privilegio'])) {
			return true;
		}
	}
    
    // Cerrar la sesion establecida
    public function Logout() {
        
        session_destroy();
        return true;
    }
}