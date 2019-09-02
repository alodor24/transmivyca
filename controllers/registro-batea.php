<?php
require_once '../models/class.batea.php';

$crear = new Batea();

// Saneamiento de variables
$matricula = htmlspecialchars($_POST['matricula']);
$serial = htmlspecialchars($_POST['serial']);
$eje = htmlspecialchars($_POST['eje']);
$fecha_registro = date('Y-m-d');

// Validacion de variables
if (($matricula == "") || ($serial == "") || ($eje == "")) {    
    echo "
    <div class='alert alert-danger alert-dismissable'>
        <a class='close' data-dismiss='alert' aria-label='close'>&times;</a>
        <div class='alert-body text-center'>Batea no puede ser registrada</div>
    </div>";
    
} elseif (strlen($matricula) < 7) {
    echo "
    <div class='alert alert-danger alert-dismissable'>
        <a class='close' data-dismiss='alert' aria-label='close'>&times;</a>
        <div class='alert-body text-center'>Matrícula inválida</div>
    </div>";
    
} elseif (strlen($serial) < 10) {
    echo "
    <div class='alert alert-danger alert-dismissable'>
        <a class='close' data-dismiss='alert' aria-label='close'>&times;</a>
        <div class='alert-body text-center'>Serial inválido</div>
    </div>";

// Ejecuta el metodo registrar
} elseif ($crear->Crear($matricula, $serial, $eje, $fecha_registro)) {
    echo "
    <script>
        swal({
        title: 'Nueva Batea',
        text: 'Registrada satisfactoriamente',
        type: 'success',
        showCancelButton: false,
        confirmButtonText: 'OK',
        closeOnConfirm: false
        },
        
        function() {
            location.href = '/transmivyca/views/bateas.php';
        });
    </script>";
    

} else {
    echo "
    <div class='alert alert-danger alert-dismissable'>
        <a class='close' data-dismiss='alert' aria-label='close'>&times;</a>
        <div class='alert-body text-center'>Batea ya se encuentra registrada</div>
    </div>";
}