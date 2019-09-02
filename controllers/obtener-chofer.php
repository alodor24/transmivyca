<?php
require_once '../models/class.chofer.php';

$obtener = new Chofer();

$id = $_POST['id'];

if (isset($id)) {
    $data = $obtener->Obtener($id);
    
    // Sirve para almacenar los datos recogidos
    $response = [
        'id_chofer' => $data['id_chofer'],
        'cedula' => $data['cedula'],
        'nombre' => $data['nombre'],
        'apellido' => $data['apellido'],
        'direccion' => $data['direccion'],
        'telefono' => $data['telefono'],
        'fv_licencia' => $data['fecha_vencimiento_licencia'],
        'fv_certificado' => $data['fecha_vencimiento_certificado_medico'],
    ];
    echo json_encode($response);
    
}