<?php
require_once '../config/connection.php';

class Chuto {
    
    private $pdo;
    
    
    public function __CONSTRUCT() {
        
        $database = new Database();
		$db = $database->connection();
		$this->pdo = $db;        
    }
    
    // Muestra todos los registros
    public function Listar() {
        
        try {
            
            $sql = "SELECT * FROM chuto ORDER BY id_chuto ASC";
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            $data = $stm->fetchAll(PDO::FETCH_ASSOC);
            return $data;
                        
        } catch(PDOException $e) {
            die('ERROR: ' . $e->getMessage());
        }        
        
    }
    
    // Mostrar total de registros
    public function totalChuto() {
        
        try {
            
            $sql = "SELECT id_chuto FROM chuto";            
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            $row = $stm->rowCount();
            return $row;
                        
        } catch(PDOException $e) {
            die('ERROR: ' . $e->getMessage());
        }   
        
    }
    
    // Listar registros especificos
    public function ListarChuto() {
        
        try {
            
            $sql = "SELECT id_chuto, matricula_chuto FROM chuto WHERE id_chuto 
                    NOT IN (SELECT id_chuto FROM asignar_chuto)";            
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            $data = $stm->fetchAll(PDO::FETCH_ASSOC);
            return $data;
                        
        } catch(PDOException $e) {
            die('ERROR: ' . $e->getMessage());
        }   
        
    }
    
    public function ListarChutoMantenimiento() {
        
        try {
            
            $sql = "SELECT a.id_chuto, ch.matricula_chuto
                    FROM asignar_chuto a INNER JOIN chuto ch
                    ON a.id_chuto = ch.id_chuto";            
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
            
            $sql = "SELECT * FROM chuto WHERE 
                    matricula_chuto LIKE '%".$valor."%' 
                    OR marca LIKE '%".$valor."%' 
                    OR modelo LIKE '%".$valor."%'
                    OR color LIKE '%".$valor."%'
                    OR serial_motor LIKE '%".$valor."%'
                    OR serial_carroceria LIKE '%".$valor."%'    
                    ORDER BY id_chuto ASC";            
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
            
            $sql = "SELECT * FROM chuto WHERE id_chuto = ?";
            $stm = $this->pdo->prepare($sql);
            $stm->execute(array($id));
            $data = $stm->fetch(PDO::FETCH_ASSOC);
            return $data;
                        
        } catch(PDOException $e) {
            die('ERROR: ' . $e->getMessage());
        }        
        
    }
    
    // Crea un nuevo registro
    public function Crear($matricula, $marca, $modelo, $color, $eje, $annio, $serial_motor, $serial_carroceria) {
        
        try {
            
            $sql = "SELECT matricula_chuto FROM chuto WHERE matricula_chuto = ?";
            $stm = $this->pdo->prepare($sql);
            $stm->execute(array($matricula));
            $row = $stm->fetch(PDO::FETCH_ASSOC);
            
            if ($row['matricula'] != $matricula) {
                
                $sql = "INSERT INTO chuto (
                                    matricula_chuto, 
                                    marca, 
                                    modelo, 
                                    color,
                                    eje,
                                    annio, 
                                    serial_motor, 
                                    serial_carroceria) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
                $stm = $this->pdo->prepare($sql);
                $stm->execute(array(
                            $matricula,
                            $marca,
                            $modelo,                        
                            $color,
                            $eje,
                            $annio,
                            $serial_motor,
                            $serial_carroceria
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
    public function Actualizar($matricula_chuto, $serial_motor, $serial_carroceria, $id) {
        
        try {
            
            $sql = "UPDATE chuto SET
                                matricula_chuto = ?,
                                serial_motor = ?, 
                                serial_carroceria = ?
                                WHERE id_chuto = ?";
            $stm = $this->pdo->prepare($sql);
            $stm->execute(array(
                        $matricula_chuto,
                        $serial_motor,
                        $serial_carroceria,
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
            
            $sql = "DELETE FROM chuto WHERE id_chuto = ?";
            $stm = $this->pdo->prepare($sql);
            $stm->execute(array($id));
            
        } catch(PDOException $e) {
            die('ERROR: ' . $e->getMessage());
        }   
        
    }
    
}