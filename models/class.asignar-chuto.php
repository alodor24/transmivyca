<?php
require_once '../config/connection.php';

class AsignarChuto {
    
    private $pdo;
    
    
    public function __CONSTRUCT() {
        
        $database = new Database();
		$db = $database->connection();
		$this->pdo = $db;        
    }
    
    // Registro nuevo
    public function Crear($id_chofer, $id_chuto, $id_batea) {
        
        try {
            
            $sql = "SELECT id_chuto FROM mantenimiento_chuto WHERE id_chuto = ?";
            $stm = $this->pdo->prepare($sql);
            $stm->execute(array($id_chuto));
            $row = $stm->fetch(PDO::FETCH_ASSOC);
            
            if ($row['id_chuto'] != $id_chuto) { 
            
                $sql = "INSERT INTO asignar_chuto (
                                    id_chofer, 
                                    id_chuto, 
                                    id_batea) VALUES (?, ?, ?)";
                $stm = $this->pdo->prepare($sql);
                $stm->execute(array(
                            $id_chofer,
                            $id_chuto,
                            $id_batea
                ));
                return true;    
            
            } else {
                return false;
            }
            
        } catch(PDOException $e) {
            die('ERROR: ' . $e->getMessage());
        }   
        
    }
        
    // Listar tablas relacionadas
    public function Listar() {
        
        try {
            
            $sql = "SELECT a.id_asignar, o.nombre, o.apellido, u.matricula_chuto, b.matricula_batea
                    FROM asignar_chuto a INNER JOIN chofer o ON a.id_chofer = o.id_chofer
                    INNER JOIN chuto u ON a.id_chuto = u.id_chuto
                    INNER JOIN batea b ON a.id_batea = b.id_batea
                    ORDER BY id_asignar ASC";            
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            $data = $stm->fetchAll(PDO::FETCH_ASSOC);
            return $data;
            
        } catch(PDOException $e) {
            die('ERROR: ' . $e->getMessage());
        }   
        
    }
    
    // Buscador registro
    public function Buscar($valor) {
        
        try {
            
            $sql = "SELECT a.id_asignar, o.nombre, o.apellido, u.matricula_chuto, b.matricula_batea
                    FROM asignar_chuto a INNER JOIN chofer o ON a.id_chofer = o.id_chofer
                    INNER JOIN chuto u ON a.id_chuto = u.id_chuto
                    INNER JOIN batea b ON a.id_batea = b.id_batea
                    WHERE matricula_chuto LIKE '%".$valor."%' 
                    ORDER BY id_asignar ASC";            
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            $data = $stm->fetchAll(PDO::FETCH_ASSOC);
            return $data;
                        
        } catch(PDOException $e) {
            die('ERROR: ' . $e->getMessage());
        }   
        
    }   
    
    // Eliminar registro
    public function Eliminar($id) {
        
        try {
            
            $sql = "DELETE FROM asignar_chuto WHERE id_asignar = ?";
            $stm = $this->pdo->prepare($sql);
            $stm->execute(array($id));
            
        } catch(PDOException $e) {
            die('ERROR: ' . $e->getMessage());
        }   
        
    }
    
}