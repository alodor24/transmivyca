<?php
require_once '../models/class.mantenimiento.php';

$obtener = new Mantenimiento();

$id = $_POST['id'];

if (isset($id)) {
    $data = $obtener->Obtener($id);
    
    // Sirve para almacenar los datos recogidos
    $response = [
        'id_mantenimiento' => $data['id_mantenimiento'],
    ];
    echo json_encode($response);
    
}