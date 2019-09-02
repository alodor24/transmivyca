<?php
session_start();
require_once '../models/class.asignar-chuto.php';

$listar = new AsignarChuto();
$valor = $_POST['consulta'];

$salida = "";

if (isset($valor)) {
    $data = $listar->Buscar($valor);
    
    $salida .= "
    <table class='table table-striped'>
        <thead>
            <tr>
                <th>Id</th>
                <th>Chofer</th>
                <th>Matrícula Chuto</th>
                <th>Matrícula Batea</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody class='text-center'>";
    
        foreach ($data as $row) {
        
        $salida .= "
            <tr>
                <td>" .$row['id_asignar']. "</td>
                <td>" .$row['nombre']. " " .$row['apellido']. "</td>
                <td>" .$row['matricula_chuto']. "</td>
                <td>" .$row['matricula_batea']. "</td>
                <td>";
                                       
        if ($_SESSION['privilegio'] == "administrador") {
            
        $salida .= "                                
            <a class='btn btn-danger' data-toggle='tooltip' data-placement='bottom' title='Eliminar' onclick='eliminarAsignacion(" .$row['id_asignar']. ")'>
                <span class='glyphicon glyphicon-trash'></span>
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