<?php
require_once '../config/connection.php';

class Viaticos {
    
    private $pdo;
    
    
    public function __CONSTRUCT() {
        
        $database = new Database();
		$db = $database->connection();
		$this->pdo = $db;        
    }
    
    // Muestra todos los registros
    public function Listar() {
        
        try {
            
            $sql = "SELECT * FROM viaticos ORDER BY id_viaticos DESC";
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            $data = $stm->fetchAll(PDO::FETCH_ASSOC);
            return $data;
                        
        } catch(PDOException $e) {
            die('ERROR: ' . $e->getMessage());
        }        
        
    }
    
    // Obtener valor
    public function Obtener($id) {
        
        try {
            
            $sql = "SELECT * FROM viaticos WHERE id_viaticos = ?";
            $stm = $this->pdo->prepare($sql);
            $stm->execute(array($id));
            $data = $stm->fetch(PDO::FETCH_ASSOC);
            return $data;
                        
        } catch(PDOException $e) {
            die('ERROR: ' . $e->getMessage());
        }        
        
    }
    
    // Crea un nuevo registro
    public function Crear($peaje, $comida, $combustible, $otros, $total) {
        
        try {
            
            $sql = "INSERT INTO viaticos (
                                    peaje, 
                                    comida, 
                                    combustible, 
                                    otros, 
                                    total) VALUES (?, ?, ?, ?, ?)";
            $stm = $this->pdo->prepare($sql);
            $stm->execute(array(
                        $peaje,
                        $comida,
                        $combustible,                        
                        $otros,
                        $total
            ));
            return true;    
            
        } catch(PDOException $e) {
            die('ERROR: ' . $e->getMessage());
        }   
        
    }
    
    // Realiza una actualizacion del registro seleccionado
    public function Actualizar($peaje, $comida, $combustible, $otros, $total, $id) {
        
        try {
            
            $sql = "UPDATE viaticos SET 
                                peaje = ?, 
                                comida = ?, 
                                combustible = ?, 
                                otros = ?, 
                                total = ?
                                WHERE id_viaticos = ?";
            $stm = $this->pdo->prepare($sql);
            $stm->execute(array(
                        $peaje,
                        $comida,
                        $combustible,                        
                        $otros,
                        $total,
                        $id
            ));
            return true;
            
        } catch(PDOException $e) {
            die('ERROR: ' . $e->getMessage());
        }   
        
    }
    
    // Elimina el registro seleccionado
    public function Eliminar($id) {
        
        try {
            
            $sql = "DELETE FROM viaticos WHERE id_viaticos = ?";
            $stm = $this->pdo->prepare($sql);
            $stm->execute(array($id));
            
        } catch(PDOException $e) {
            die('ERROR: ' . $e->getMessage());
        }   
        
    }
    
}