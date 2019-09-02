<?php
require_once '../models/class.cliente.php';

$obtener = new Cliente();

$id = $_POST['id'];

if (isset($id)) {
    $data = $obtener->Obtener($id);
    
    // Sirve para almacenar los datos recogidos
    $response = [
        'id_cliente' => $data['id_cliente'],
        'rif' => $data['rif'],
        'razon_social' => $data['razon_social'],
        'direccion' => $data['direccion'],
        'telefono' => $data['telefono'],
        'responsable' => $data['responsable'],
    ];
    echo json_encode($response);
    
}