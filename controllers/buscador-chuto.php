<?php
session_start();
require_once '../models/class.chuto.php';

$listar = new Chuto();
$valor = $_POST['consulta'];

$salida = "";

if (isset($valor)) {
    $data = $listar->Buscar($valor);
    
    $salida .= "
    <table class='table table-striped'>
        <thead>
            <tr>
                <th>Id</th>
                <th>Matrícula</th>
                <th>Marca</th>
                <th>Modelo</th>
                <th>Color</th>
                <th>Año</th>
                <th>Serial Motor</th>
                <th>Serial Carrocería</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody class='text-center'>";
    
        foreach ($data as $row) {
        
        $salida .= "
            <tr>
                <td>" .$row['id_chuto']. "</td>
                <td>" .$row['matricula_chuto']. "</td>
                <td>" .$row['marca']. "</td>
                <td>" .$row['modelo']. "</td>
                <td>" .$row['color']. "</td>
                <td>" .$row['annio']. "</td>
                <td>" .$row['serial_motor']. "</td>
                <td>" .$row['serial_carroceria']. "</td>
                <td>";
                                       
        if ($_SESSION['privilegio'] == "administrador") {
            
        $salida .= "
            <a class='btn btn-primary' data-toggle='tooltip' data-placement='bottom' title='Editar' onclick='obtenerChuto(" .$row['id_chuto']. ")'>
                <span class='glyphicon glyphicon-edit'></span>
            </a>
                                
            <a class='btn btn-danger' data-toggle='tooltip' data-placement='bottom' title='Eliminar' onclick='eliminarChuto(" .$row['id_chuto']. ")'>
                <span class='glyphicon glyphicon-trash'></span>
            </a>";
            
        } else {
            
        $salida .= "
            <a class='btn btn-primary' data-toggle='tooltip' data-placement='bottom' title='Editar' onclick='obtenerChuto(" .$row['id_chuto']. ")'>
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