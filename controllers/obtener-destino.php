<?php
require_once '../models/class.destino.php';

$obtener = new Destino();

$id = $_POST['id'];

if (isset($id)) {
    $data = $obtener->Obtener($id);
    
    // Sirve para almacenar los datos recogidos
    $response = [
        'id_destino' => $data['id_destino'],
        'destino' => $data['destino'],
        'distancia' => $data['distancia'],
        'peaje' => $data['peaje'],
        'comida' => $data['comida'],
        'combustible' => $data['combustible'],
        'otros' => $data['otros'],
    ];
    echo json_encode($response);
    
}