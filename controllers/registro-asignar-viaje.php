<?php
require_once '../models/class.asignar-viaje.php';

$crear = new AsignarViaje();

// Saneamiento de variables
$id_chofer = htmlspecialchars($_POST['chofer']);
$id_destino = htmlspecialchars($_POST['destino']);
$id_cliente = htmlspecialchars($_POST['cliente']);
$fecha = date('Y-m-d');
$salida = date('h:i:s a');
$status = 'EN PROGRESO';

// Validacion de variables
if (($id_chofer == "seleccione") || ($id_destino == "seleccione") || ($id_cliente == "seleccione")) {    
    echo "
    <div class='alert alert-danger alert-dismissable'>
        <a class='close' data-dismiss='alert' aria-label='close'>&times;</a>
        <div class='alert-body text-center'>No se puede realizar la asignación</div>
    </div>";

// Ejecuta el metodo registrar
} elseif ($crear->Crear($id_chofer, $id_destino, $id_cliente, $fecha, $salida, $status)) {
    echo "
    <script>
        swal({
        title: 'Nuevo Viaje',
        text: 'Registrado satisfactoriamente',
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
        <div class='alert-body text-center'>No se puede asignar viaje a este chofer</div>
    </div>";
}