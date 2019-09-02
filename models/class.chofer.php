<?php
require_once '../config/connection.php';

class Chofer {
    
    private $pdo;
    
    
    public function __CONSTRUCT() {
        
        $database = new Database();
		$db = $database->connection();
		$this->pdo = $db;        
    }
    
    // Muestra todos los registros
    public function Listar() {
        
        try {
            
            $sql = "SELECT * FROM chofer ORDER BY id_chofer ASC";
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            $data = $stm->fetchAll(PDO::FETCH_ASSOC);
            return $data;
                        
        } catch(PDOException $e) {
            die('ERROR: ' . $e->getMessage());
        }        
        
    }
    
    // Mostrar total de registros
    public function totalChofer() {
        
        try {
            
            $sql = "SELECT id_chofer FROM chofer";            
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            $row = $stm->rowCount();
            return $row;
                        
        } catch(PDOException $e) {
            die('ERROR: ' . $e->getMessage());
        }   
        
    }
    
    // Listar registros especificos
    public function ListarChofer() {
        
        try {
            
            $sql = "SELECT id_chofer, nombre, apellido, cedula FROM chofer WHERE id_chofer NOT IN (SELECT id_chofer FROM asignar_chuto)";            
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            $data = $stm->fetchAll(PDO::FETCH_ASSOC);
            return $data;
                        
        } catch(PDOException $e) {
            die('ERROR: ' . $e->getMessage());
        }   
        
    }
    
    public function ListarChoferViaje() {
        
        try {
                        
            $sql = "SELECT a.id_chofer, a.id_chuto, c.nombre, c.apellido, c.cedula 
                    FROM asignar_chuto a 
                    INNER JOIN chofer c 
                    ON a.id_chofer = c.id_chofer 
                    INNER JOIN chuto ch 
                    ON a.id_chuto = ch.id_chuto 
                    WHERE a.id_chuto 
                    NOT IN (SELECT id_chuto FROM mantenimiento_chuto WHERE status = 'INACTIVO') 
                    ORDER BY id_chofer";            
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
            
            $sql = "SELECT * FROM chofer WHERE 
                    cedula LIKE '%".$valor."%' 
                    OR nombre LIKE '%".$valor."%' 
                    OR apellido LIKE '%".$valor."%' 
                    ORDER BY id_chofer ASC";            
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
            
            $sql = "SELECT * FROM chofer WHERE id_chofer = ?";
            $stm = $this->pdo->prepare($sql);
            $stm->execute(array($id));
            $data = $stm->fetch(PDO::FETCH_ASSOC);
            return $data;
                        
        } catch(PDOException $e) {
            die('ERROR: ' . $e->getMessage());
        }        
        
    }
    
    // Crea un nuevo registro
    public function Crear($cedula, $nombre, $apellido, $direccion, $telefono, $fv_licencia, $fv_certificado, $fecha_ingreso) {
        
        try {
            
            $sql = "SELECT cedula FROM chofer WHERE cedula = ?";
            $stm = $this->pdo->prepare($sql);
            $stm->execute(array($cedula));
            $row = $stm->fetch(PDO::FETCH_ASSOC);
            
            if ($row['cedula'] != $cedula) {
                
                $sql = "INSERT INTO chofer (
                                    cedula, 
                                    nombre, 
                                    apellido, 
                                    direccion, 
                                    telefono,
                                    fecha_vencimiento_licencia,
                                    fecha_vencimiento_certificado_medico,
                                    fecha_ingreso) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
                $stm = $this->pdo->prepare($sql);
                $stm->execute(array(
                            $cedula,
                            $nombre,
                            $apellido,                        
                            $direccion,
                            $telefono,
                            $fv_licencia,
                            $fv_certificado,
                            $fecha_ingreso
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
    public function Actualizar($cedula, $nombre, $apellido, $direccion, $telefono, $fv_licencia, $fv_certificado, $id) {
        
        try {
            
            $sql = "UPDATE chofer SET
                                cedula = ?, 
                                nombre = ?, 
                                apellido = ?, 
                                direccion = ?, 
                                telefono = ?,
                                fecha_vencimiento_licencia = ?,
                                fecha_vencimiento_certificado_medico = ?
                                WHERE id_chofer = ?";
            $stm = $this->pdo->prepare($sql);
            $stm->execute(array(                        
                        $cedula,
                        $nombre,
                        $apellido,                        
                        $direccion,                        
                        $telefono,  
                        $fv_licencia,
                        $fv_certificado,
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
            
            $sql = "DELETE FROM chofer WHERE id_chofer = ?";
            $stm = $this->pdo->prepare($sql);
            $stm->execute(array($id));
            
        } catch(PDOException $e) {
            die('ERROR: ' . $e->getMessage());
        }   
        
    }
    
}