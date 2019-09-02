<?php
require_once '../config/connection.php';

class AsignarViaje {
    
    private $pdo;
    
    
    public function __CONSTRUCT() {
        
        $database = new Database();
		$db = $database->connection();
		$this->pdo = $db;        
    }
    
    // Registro nuevo
    public function Crear($id_chofer, $id_destino, $id_cliente, $fecha, $salida, $status) {
        
        try {
            
            $sql = "SELECT status FROM asignar_viaje 
                    WHERE id_chofer = ?
                    ORDER BY id_viaje DESC
                    LIMIT 1";
            $stm = $this->pdo->prepare($sql);
            $stm->execute(array($id_chofer));
            $row = $stm->fetch();
            
            if ($row['status'] != $status) {
                    
                $query = "SELECT MAX(numero_guia) as ultimo FROM asignar_viaje";
                $stm2 = $this->pdo->prepare($query);
                $stm2->execute();
                $row2 = $stm2->fetch();
                $numero_guia = $row2['ultimo'];
                $numero_guia++;

                $sql = "INSERT INTO asignar_viaje (
                                    numero_guia,
                                    id_chofer, 
                                    id_destino, 
                                    id_cliente,
                                    fecha,
                                    salida,
                                    status) VALUES (?, ?, ?, ?, ?, ?, ?)";
                $stm = $this->pdo->prepare($sql);
                $stm->execute(array(
                            $numero_guia,
                            $id_chofer,
                            $id_destino,
                            $id_cliente,
                            $fecha,
                            $salida,
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
    
    // Obtener viaje
    public function Obtener($id) {
        
        try {
            
            $sql = "SELECT * FROM asignar_viaje WHERE id_viaje = ?";
            $stm = $this->pdo->prepare($sql);
            $stm->execute(array($id));
            $data = $stm->fetch(PDO::FETCH_ASSOC);
            return $data;
                        
        } catch(PDOException $e) {
            die('ERROR: ' . $e->getMessage());
        }        
        
    }
        
    // Listar tablas relacionadas
    public function Listar() {
        
        try {
            
            $sql = "SELECT v.id_viaje, v.numero_guia, v.fecha, v.salida, v.llegada, v.status,
                        ch.nombre, ch.apellido, ch.cedula,
                        d.origen, d.destino, 
                        c.razon_social
                        FROM asignar_viaje v INNER JOIN chofer ch ON v.id_chofer = ch.id_chofer
                        INNER JOIN destino d ON v.id_destino = d.id_destino
                        INNER JOIN cliente c ON v.id_cliente = c.id_cliente
                        ORDER BY id_viaje ASC";            
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
            
            $sql = "SELECT v.id_viaje, v.numero_guia, v.fecha, v.salida, v.llegada, v.status,
                        ch.nombre, ch.apellido, ch.cedula, 
                        d.origen, d.destino, 
                        c.razon_social
                        FROM asignar_viaje v INNER JOIN chofer ch ON v.id_chofer = ch.id_chofer
                        INNER JOIN destino d ON v.id_destino = d.id_destino
                        INNER JOIN cliente c ON v.id_cliente = c.id_cliente
                        WHERE numero_guia LIKE '%".$valor."%'
                        OR nombre LIKE '%".$valor."%'
                        ORDER BY id_viaje ASC";            
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            $data = $stm->fetchAll(PDO::FETCH_ASSOC);
            return $data;
            
        } catch(PDOException $e) {
            die('ERROR: ' . $e->getMessage());
        }   
        
    }
    
    // Buscador por fecha
    public function BuscarFecha($desde, $hasta) {
        
        try {
            
            $sql = "SELECT v.id_viaje, v.numero_guia, v.fecha, v.salida, v.llegada, v.status,
                        ch.nombre, ch.apellido, 
                        d.origen, d.destino, 
                        c.razon_social
                        FROM asignar_viaje v INNER JOIN chofer ch ON v.id_chofer = ch.id_chofer
                        INNER JOIN destino d ON v.id_destino = d.id_destino
                        INNER JOIN cliente c ON v.id_cliente = c.id_cliente
                        WHERE fecha BETWEEN '".$desde."' AND '".$hasta."'
                        ORDER BY id_viaje ASC";            
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            $data = $stm->fetchAll(PDO::FETCH_ASSOC);
            return $data;
            
        } catch(PDOException $e) {
            die('ERROR: ' . $e->getMessage());
        }   
        
    }
    
    // Realiza una actualizacion del registro seleccionado
    public function ActualizarFast($status, $id) {
        
        try {
            
            $sql = "UPDATE asignar_viaje SET 
                                status = ?
                                WHERE id_viaje = ?";
            $stm = $this->pdo->prepare($sql);
            $stm->execute(array(
                        $status,
                        $id
            ));
            return true;
            
        } catch(PDOException $e) {
            die('ERROR: ' . $e->getMessage());
        }   
        
    }
    
    // Realiza una actualizacion del registro seleccionado
    public function Actualizar($llegada, $status, $id) {
        
        try {
            
            $sql = "UPDATE asignar_viaje SET
                                llegada = ?, 
                                status = ?
                                WHERE id_viaje = ?";
            $stm = $this->pdo->prepare($sql);
            $stm->execute(array(
                        $llegada,
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
            
            $sql = "DELETE FROM asignar_viaje WHERE id_viaje = ?";
            $stm = $this->pdo->prepare($sql);
            $stm->execute(array($id));
            
        } catch(PDOException $e) {
            die('ERROR: ' . $e->getMessage());
        }   
        
    }
}