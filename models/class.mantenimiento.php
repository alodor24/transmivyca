<?php
require_once '../config/connection.php';

class Mantenimiento {
    
    private $pdo;
    
    
    public function __CONSTRUCT() {
        
        $database = new Database();
		$db = $database->connection();
		$this->pdo = $db;        
    }
    
    // Registro nuevo
    public function Crear($id_chuto, $kilometraje, $falla, $tipo_mantenimiento, $fecha_ingreso, $status) {
        
        try {
            
            $sql = "SELECT status 
                    FROM mantenimiento_chuto 
                    WHERE id_chuto = ? 
                    ORDER BY id_mantenimiento DESC 
                    LIMIT 1";
            $stm = $this->pdo->prepare($sql);
            $stm->execute(array($id_chuto));
            $row = $stm->fetch();
            
            if ($row['status'] != $status) {
                
                $sql = "INSERT INTO mantenimiento_chuto (
                                id_chuto, 
                                kilometraje, 
                                falla, 
                                tipo_mantenimiento, 
                                fecha_ingreso,
                                status) VALUES (?, ?, ?, ?, ?, ?)";
                $stm = $this->pdo->prepare($sql);
                $stm->execute(array(
                            $id_chuto,
                            $kilometraje,
                            $falla,
                            $tipo_mantenimiento,
                            $fecha_ingreso,
                            $status
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
            
            $sql = "SELECT c.matricula_chuto, m.id_mantenimiento, m.kilometraje, m.falla, m.tipo_mantenimiento,
                    m.fecha_ingreso, m.fecha_egreso, m.status
                    FROM mantenimiento_chuto m INNER JOIN chuto c ON m.id_chuto = c.id_chuto
                    ORDER BY id_mantenimiento ASC";            
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            $data = $stm->fetchAll(PDO::FETCH_ASSOC);
            return $data;
            
        } catch(PDOException $e) {
            die('ERROR: ' . $e->getMessage());
        }   
        
    }
    
    // Buscador de registros
    public function Buscar($valor) {
        
        try {
            
            $sql = "SELECT c.matricula_chuto, m.id_mantenimiento, m.kilometraje, 
                    m.falla, m.tipo_mantenimiento, m.fecha_ingreso, m.fecha_egreso, m.status
                    FROM mantenimiento_chuto m INNER JOIN chuto c ON m.id_chuto = c.id_chuto
                    WHERE matricula_chuto LIKE '%".$valor."%'
                    ORDER BY id_mantenimiento ASC";            
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
            
            $sql = "SELECT * FROM mantenimiento_chuto WHERE id_mantenimiento = ?";
            $stm = $this->pdo->prepare($sql);
            $stm->execute(array($id));
            $data = $stm->fetch(PDO::FETCH_ASSOC);
            return $data;
                        
        } catch(PDOException $e) {
            die('ERROR: ' . $e->getMessage());
        }        
        
    }
    
    // Realiza una actualizacion del registro seleccionado
    public function Actualizar($fecha_egreso, $status, $id) {
        
        try {
            
            $sql = "UPDATE mantenimiento_chuto SET
                                fecha_egreso = ?,
                                status = ?
                                WHERE id_mantenimiento = ?";
            $stm = $this->pdo->prepare($sql);
            $stm->execute(array(
                        $fecha_egreso,
                        $status,
                        $id
            ));
            return true;
            
        } catch(PDOException $e) {
            die('ERROR: ' . $e->getMessage());
        }   
        
    }
    
    // Eliminar registro
    public function Eliminar($id) {
        
        try {
            
            $sql = "DELETE FROM mantenimiento_chuto WHERE id_mantenimiento = ?";
            $stm = $this->pdo->prepare($sql);
            $stm->execute(array($id));
            
        } catch(PDOException $e) {
            die('ERROR: ' . $e->getMessage());
        }   
        
    }
    
}