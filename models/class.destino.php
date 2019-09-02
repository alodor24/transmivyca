<?php
require_once '../config/connection.php';

class Destino {
    
    private $pdo;
    
    
    public function __CONSTRUCT() {
        
        $database = new Database();
		$db = $database->connection();
		$this->pdo = $db;        
    }
    
    // Muestra todos los registros
    public function Listar() {
        
        try {
            
            $sql = "SELECT * FROM destino ORDER BY id_destino DESC";
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            $data = $stm->fetchAll(PDO::FETCH_ASSOC);
            return $data;
                        
        } catch(PDOException $e) {
            die('ERROR: ' . $e->getMessage());
        }        
        
    }
    
    // Mostrar total de registros
    public function totalDestino() {
        
        try {
            
            $sql = "SELECT id_destino FROM destino";            
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            $row = $stm->rowCount();
            return $row;
                        
        } catch(PDOException $e) {
            die('ERROR: ' . $e->getMessage());
        }   
        
    }
    
    // Listar registros especificos
    public function ListarDestino() {
        
        try {
            
            $sql = "SELECT id_destino, destino FROM destino";            
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
            
            $sql = "SELECT * FROM destino WHERE 
                    destino LIKE '%".$valor."%' 
                    ORDER BY id_destino ASC";            
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
            
            $sql = "SELECT * FROM destino WHERE id_destino = ?";
            $stm = $this->pdo->prepare($sql);
            $stm->execute(array($id));
            $data = $stm->fetch(PDO::FETCH_ASSOC);
            return $data;
                        
        } catch(PDOException $e) {
            die('ERROR: ' . $e->getMessage());
        }        
        
    }
    
    // Crea un nuevo registro
    public function Crear($origen, $destino, $distancia, $peaje, $comida, $combustible, $otros, $total) {
        
        try {
            
            $sql = "SELECT destino FROM destino WHERE destino = ?";
            $stm = $this->pdo->prepare($sql);
            $stm->execute(array($destino));
            $row = $stm->fetch(PDO::FETCH_ASSOC);
            
            if ($row['destino'] != $destino) { 
            
                $sql = "INSERT INTO destino (
                                    origen,
                                    destino, 
                                    distancia,
                                    peaje,
                                    comida,
                                    combustible,
                                    otros,
                                    total) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
                $stm = $this->pdo->prepare($sql);
                $stm->execute(array(
                            $origen, 
                            $destino, 
                            $distancia, 
                            $peaje, 
                            $comida, 
                            $combustible, 
                            $otros, 
                            $total
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
    public function Actualizar($destino, $distancia, $peaje, $comida, $combustible, $otros, $total, $id) {
        
        try {
            
            $sql = "UPDATE destino SET 
                                destino = ?, 
                                distancia = ?,
                                peaje = ?,
                                comida = ?,
                                combustible = ?,
                                otros = ?,
                                total = ?
                                WHERE id_destino = ?";
            $stm = $this->pdo->prepare($sql);
            $stm->execute(array(
                        $destino,
                        $distancia,
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
            
            $sql = "DELETE FROM destino WHERE id_destino = ?";
            $stm = $this->pdo->prepare($sql);
            $stm->execute(array($id));
            
        } catch(PDOException $e) {
            die('ERROR: ' . $e->getMessage());
        }   
        
    }
    
}