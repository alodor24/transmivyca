<?php
session_start();
require_once '../models/class.cliente.php';

$listar = new Cliente();
$valor = $_POST['consulta'];

$salida = "";

if (isset($valor)) {
    $data = $listar->Buscar($valor);
    
    $salida .= "
    <table class='table table-striped'>
        <thead>
            <tr>
                <th>Id</th>
                <th>Rif</th>
                <th>Razón Social</th>
                <th>Dirección</th>
                <th>Teléfono</th>
                <th>Responsable</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody class='text-center'>";
    
        foreach ($data as $row) {
        
        $salida .= "
            <tr>
                <td>" .$row['id_cliente']. "</td>
                <td>" .$row['rif']. "</td>
                <td>" .$row['razon_social']. "</td>
                <td>" .$row['direccion']. "</td>
                <td>" .$row['telefono']. "</td>
                <td>" .$row['responsable']. "</td>
                <td>";
                                       
        if ($_SESSION['privilegio'] == "administrador") {
            
        $salida .= "
            <a class='btn btn-primary' data-toggle='tooltip' data-placement='bottom' title='Editar' onclick='obtenerCliente(" .$row['id_cliente']. ")'>
                <span class='glyphicon glyphicon-edit'></span>
            </a>
                                
            <a class='btn btn-danger' data-toggle='tooltip' data-placement='bottom' title='Eliminar' onclick='eliminarCliente(" .$row['id_cliente']. ")'>
                <span class='glyphicon glyphicon-trash'></span>
            </a>";
            
        } else {
            
        $salida .= "
            <a class='btn btn-primary' data-toggle='tooltip' data-placement='bottom' title='Editar' onclick='obtenerCliente(" .$row['id_cliente']. ")'>
                <span class='glyphicon glyphicon-edit'></span>
            </a>";             
        }
            
        $salida .= "
                </td>
            </tr>";
        }
    
        $salida .= "</tbody>
        </table>";
    
    echo $salida;
    
}