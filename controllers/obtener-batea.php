<?php
require_once '../models/class.batea.php';

$obtener = new Batea();

$id = $_POST['id'];

if (isset($id)) {
    $data = $obtener->Obtener($id);
    
    // Sirve para almacenar los datos recogidos
    $response = [
        'id_batea' => $data['id_batea'],
        'matricula_batea' => $data['matricula_batea'],
        'serial' => $data['serial'],
    ];
    echo json_encode($response);
    
}