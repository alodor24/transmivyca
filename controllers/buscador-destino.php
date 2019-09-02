<?php
session_start();
require_once '../models/class.destino.php';

$listar = new Destino();
$valor = $_POST['consulta'];

$salida = "";

if (isset($valor)) {
    $data = $listar->Buscar($valor);
    
    $salida .= "
    <table class='table table-striped'>
        <thead>
            <tr>
                <th>Id</th>
                <th>Origen</th>
                <th>Destino</th>
                <th>Distancia</th>
                <th>Peaje</th>
                <th>Comida</th>
                <th>Combustible</th>
                <th>Otros</th>
                <th>Total</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody class='text-center'>";
    
        foreach ($data as $row) {
        
        $salida .= "
            <tr>
                <td>" .$row['id_destino']. "</td>
                <td>" .$row['origen']. "</td>
                <td>" .$row['destino']. "</td>
                <td>" .$row['distancia']. "</td>
                <td>" .$row['peaje']. "</td>
                <td>" .$row['comida']. "</td>
                <td>" .$row['combustible']. "</td>
                <td>" .$row['otros']. "</td>
                <td>" .$row['total']. "</td>
                <td>";
                                       
        if ($_SESSION['privilegio'] == "administrador") {
            
        $salida .= "
            <a class='btn btn-primary' data-toggle='tooltip' data-placement='bottom' title='Editar' onclick='obtenerDestino(" .$row['id_destino']. ")'>
                <span class='glyphicon glyphicon-edit'></span>
            </a>
                                
            <a class='btn btn-danger' data-toggle='tooltip' data-placement='bottom' title='Eliminar' onclick='eliminarDestino(" .$row['id_destino']. ")'>
                <span class='glyphicon glyphicon-trash'></span>
            </a>";
            
        } else {
            
        $salida .= "
            <a class='btn btn-primary' data-toggle='tooltip' data-placement='bottom' title='Editar' onclick='obtenerDestino(" .$row['id_destino']. ")'>
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