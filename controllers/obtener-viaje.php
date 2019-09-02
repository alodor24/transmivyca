<?php
require_once '../models/class.asignar-viaje.php';

$obtener = new AsignarViaje();

$id = $_POST['id'];

if (isset($id)) {
    $data = $obtener->Obtener($id);
    
    // Sirve para almacenar los datos recogidos
    $response = [
        'id_viaje' => $data['id_viaje'],
    ];
    echo json_encode($response);
    
}