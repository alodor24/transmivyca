<?php
session_start();
require_once '../models/class.asignar-viaje.php';

$listar = new AsignarViaje();
$desde = $_POST['desde'];
$hasta = $_POST['hasta'];

$salida = "";

if (isset($desde) == false) {
    $desde = $hasta;
}

if (isset($hasta) == false) {
    $hasta = $desde;
}
    
    
    $data = $listar->BuscarFecha($desde, $hasta);
    
    $salida .= "
    <table class='table table-striped'>
        <thead>
            <tr>
                <th>Id</th>
                <th>Número Guía</th>
                <th>Chofer</th>
                <th>Origen</th>
                <th>Destino</th>
                <th>Cliente</th>
                <th>Fecha</th>
                <th>Salida</th>
                <th>Llegada</th>
                <th>Status</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody class='text-center'>";
    
        foreach ($data as $row) {
        
        $salida .= "
            <tr>
                <td>" .$row['id_viaje']. "</td>
                <td>" .$row['numero_guia']. "</td>
                <td>" .$row['nombre']. " " .$row['apellido']. "</td>
                <td>" .$row['origen']. "</td>
                <td>" .$row['destino']. "</td>
                <td>" .$row['razon_social']. "</td>
                <td>" .$row['fecha']. "</td>
                <td>" .$row['salida']. "</td>
                <td>" .$row['llegada']. "</td>
                <td>" .$row['status']. "</td>
                <td>";
                                       
        if ($_SESSION['privilegio'] == "administrador") {
            
        $salida .= "                                
            <a class='btn btn-primary' data-toggle='tooltip' data-placement='bottom' title='Editar' onclick='obtenerViaje(" .$row['id_viaje']. ")'>
                <span class='glyphicon glyphicon-edit'></span>
            </a>
            
            <a class='btn btn-danger' data-toggle='tooltip' data-placement='bottom' title='Eliminar' onclick='eliminarViaje(" .$row['id_viaje']. ")'>
                <span class='glyphicon glyphicon-trash'></span>
            </a>";
            
        } else {
            
        $salida .= "
            <a class='btn btn-primary' data-toggle='tooltip' data-placement='bottom' title='Editar' onclick='obtenerViaje(" .$row['id_viaje']. ")'>
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