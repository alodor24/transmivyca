<?php
require_once '../config/connection.php';

class Batea {
    
    private $pdo;
    
    
    public function __CONSTRUCT() {
        
        $database = new Database();
		$db = $database->connection();
		$this->pdo = $db;        
    }
    
    // Muestra todos los registros
    public function Listar() {
        
        try {
            
            $sql = "SELECT * FROM batea ORDER BY id_batea ASC";
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            $data = $stm->fetchAll(PDO::FETCH_ASSOC);
            return $data;
                        
        } catch(PDOException $e) {
            die('ERROR: ' . $e->getMessage());
        }        
        
    }
    
    // Mostrar total de registros
    public function totalBatea() {
        
        try {
            
            $sql = "SELECT id_batea FROM batea";            
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            $row = $stm->rowCount();
            return $row;
                        
        } catch(PDOException $e) {
            die('ERROR: ' . $e->getMessage());
        }   
        
    }
    
    // Listar registros especificos
    public function ListarBatea() {
        
        try {
            
            $sql = "SELECT id_batea, matricula_batea FROM batea WHERE id_batea NOT IN (SELECT id_batea FROM asignar_chuto)";            
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            $data = $stm->fetchAll(PDO::FETCH_ASSOC);
            return $data;
                        
        } catch(PDOException $e) {
            die('ERROR: ' . $e->getMessage());
        }   
        
    }
    
    // Lista registro e incluye un buscador
    public function Buscar($valor) {
        
        try {
            
            $sql = "SELECT * FROM batea WHERE 
                    matricula_batea LIKE '%".$valor."%'    
                    ORDER BY id_batea ASC";            
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
            
            $sql = "SELECT * FROM batea WHERE id_batea = ?";
            $stm = $this->pdo->prepare($sql);
            $stm->execute(array($id));
            $data = $stm->fetch(PDO::FETCH_ASSOC);
            return $data;
                        
        } catch(PDOException $e) {
            die('ERROR: ' . $e->getMessage());
        }        
        
    }
    
    // Crea un nuevo registro
    public function Crear($matricula, $serial, $eje, $fecha_registro) {
        
        try {
            
            $sql = "SELECT matricula_batea FROM batea WHERE matricula_batea = ?";
            $stm = $this->pdo->prepare($sql);
            $stm->execute(array($matricula));
            $row = $stm->fetch(PDO::FETCH_ASSOC);
            
            if ($row['matricula'] != $matricula) { 
            
                $sql = "INSERT INTO batea (
                                    matricula_batea, 
                                    serial, 
                                    eje, 
                                    fecha_registro) VALUES (?, ?, ?, ?)";
                $stm = $this->pdo->prepare($sql);
                $stm->execute(array(
                            $matricula,
                            $serial,
                            $eje,                        
                            $fecha_registro
                ));
                return true;    
            
            } else {
                return false;
            }
            
        } catch(PDOException $e) {
            die('ERROR: ' . $e->getMessage());
        }   
        
    }
    
    // Realiza una actualizacion del registro seleccionado
    public function Actualizar($matricula, $serial, $eje, $id) {
        
        try {
            
            $sql = "UPDATE batea SET
                                matricula_batea = ?, 
                                serial = ?,
                                eje = ?
                                WHERE id_batea = ?";
            $stm = $this->pdo->prepare($sql);
            $stm->execute(array(                        
                        $matricula,
                        $serial,
                        $eje,
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
            
            $sql = "DELETE FROM batea WHERE id_batea = ?";
            $stm = $this->pdo->prepare($sql);
            $stm->execute(array($id));
            
        } catch(PDOException $e) {
            die('ERROR: ' . $e->getMessage());
        }   
        
    }
    
}