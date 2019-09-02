<?php
require_once '../models/class.asignar-viaje.php';

$editar = new AsignarViaje();

// Saneamiento de variables
$id = htmlspecialchars($_POST['id_viaje']);
$status = htmlspecialchars($_POST['status']);
$llegada = date('h:i:s a');

// Validacion de variables
if (($id == "") || ($status == "seleccione")) {    
    echo "
    <div class='alert alert-danger alert-dismissable'>
        <a class='close' data-dismiss='alert' aria-label='close'>&times;</a>
        <div class='alert-body text-center'>No se puede realizar la asignación</div>
    </div>";

// Ejecuta el metodo registrar
} elseif (($status == "EN PROGRESO") || ($status == "DETENIDO")) {
    
    $editar->ActualizarFast($status, $id);
    echo "
    <script>
        swal({
        title: 'Editar Viaje',
        text: 'Editado satisfactoriamente',
        type: 'success',
        showCancelButton: false,
        confirmButtonText: 'OK',
        closeOnConfirm: false
        },
        
        function() {
            location.href = '/transmivyca/views/asignar-viaje.php';
        });
    </script>";
    
} elseif ($status == "ENTREGADO") {
    
    $editar->Actualizar($llegada, $status, $id);
    echo "
    <script>
        swal({
        title: 'Editar Viaje',
        text: 'Editado satisfactoriamente',
        type: 'success',
        showCancelButton: false,
        confirmButtonText: 'OK',
        closeOnConfirm: false
        },
        
        function() {
            location.href = '/transmivyca/views/asignar-viaje.php';
        });
    </script>";    

} else {
    echo "
    <div class='alert alert-danger alert-dismissable'>
        <a class='close' data-dismiss='alert' aria-label='close'>&times;</a>
        <div class='alert-body text-center'>No se puede editar el viaje</div>
    </div>";
}