<?php
require_once '../models/class.viaticos.php';

$obtener = new Viaticos();

$id = $_POST['id'];

if (isset($id)) {
    $data = $obtener->Obtener($id);
    
    // Sirve para almacenar los datos recogidos
    $response = [
        'id_viaticos' => $data['id_viaticos'],
        'peaje' => $data['peaje'],
        'comida' => $data['comida'],
        'combustible' => $data['combustible'],
        'otros' => $data['otros'],
    ];
    echo json_encode($response);
    
}