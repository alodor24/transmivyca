<?php
require_once '../models/class.chuto.php';

$obtener = new Chuto();

$id = $_POST['id'];

if (isset($id)) {
    $data = $obtener->Obtener($id);
    
    // Sirve para almacenar los datos recogidos
    $response = [
        'id_chuto' => $data['id_chuto'],
        'matricula_chuto' => $data['matricula_chuto'],
        'serial_motor' => $data['serial_motor'],
        'serial_carroceria' => $data['serial_carroceria'],
    ];
    echo json_encode($response);
    
}