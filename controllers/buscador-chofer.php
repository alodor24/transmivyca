<?php
session_start();
require_once '../models/class.chofer.php';

$listar = new Chofer();
$valor = $_POST['consulta'];

$salida = "";

if (isset($valor)) {
    $data = $listar->Buscar($valor);
    
    $salida .= "
    <table class='table table-striped'>
        <thead>
            <tr>
                <th>Id</th>
                <th>Cédula</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Dirección</th>
                <th>Teléfono</th>
                <th>F.V. Licencia</th>
                <th>F.V. Certificado</th>
                <th>Fecha Ingreso</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody class='text-center'>";
    
        foreach ($data as $row) {
        
        $salida .= "
            <tr>
                <td>" .$row['id_chofer']. "</td>
                <td>" .$row['cedula']. "</td>
                <td>" .$row['nombre']. "</td>
                <td>" .$row['apellido']. "</td>
                <td>" .$row['direccion']. "</td>
                <td>" .$row['telefono']. "</td>
                <td>" .$row['fecha_vencimiento_licencia']. "</td>
                <td>" .$row['fecha_vencimiento_certificado_medico']. "</td>
                <td>" .$row['fecha_ingreso']. "</td>
                <td>";
                                       
        if ($_SESSION['privilegio'] == "administrador") {
            
        $salida .= "
            <a class='btn btn-primary' data-toggle='tooltip' data-placement='bottom' title='Editar' onclick='obtenerChofer(" .$row['id_chofer']. ")'>
                <span class='glyphicon glyphicon-edit'></span>
            </a>
                                
            <a class='btn btn-danger' data-toggle='tooltip' data-placement='bottom' title='Eliminar' onclick='eliminarChofer(" .$row['id_chofer']. ")'>
                <span class='glyphicon glyphicon-trash'></span>
            </a>";
            
        } else {
            
        $salida .= "
            <a class='btn btn-primary' data-toggle='tooltip' data-placement='bottom' title='Editar' onclick='obtenerChofer(" .$row['id_chofer']. ")'>
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