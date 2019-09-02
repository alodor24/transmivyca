<?php
session_start();
require_once '../models/class.batea.php';

$listar = new Batea();
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
                <th>Serial</th>
                <th>Eje</th>
                <th>Fecha Registro</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody class='text-center'>";
    
        foreach ($data as $row) {
        
        $salida .= "
            <tr>
                <td>" .$row['id_batea']. "</td>
                <td>" .$row['matricula_batea']. "</td>
                <td>" .$row['serial']. "</td>
                <td>" .$row['eje']. "</td>
                <td>" .$row['fecha_registro']. "</td>
                <td>";
                                       
        if ($_SESSION['privilegio'] == "administrador") {
            
        $salida .= "
            <a class='btn btn-primary' data-toggle='tooltip' data-placement='bottom' title='Editar' onclick='obtenerBatea(" .$row['id_batea']. ")'>
                <span class='glyphicon glyphicon-edit'></span>
            </a>
                                
            <a class='btn btn-danger' data-toggle='tooltip' data-placement='bottom' title='Eliminar' onclick='eliminarBatea(" .$row['id_batea']. ")'>
                <span class='glyphicon glyphicon-trash'></span>
            </a>";
            
        } else {
            
        $salida .= "
            <a class='btn btn-primary' data-toggle='tooltip' data-placement='bottom' title='Editar' onclick='obtenerBatea(" .$row['id_batea']. ")'>
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