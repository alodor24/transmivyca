<?php
require_once '../models/class.chuto.php';

$crear = new Chuto();

// Saneamiento de variables
$matricula = htmlspecialchars($_POST['matricula']);
$marca = htmlspecialchars($_POST['marca']);
$modelo = htmlspecialchars($_POST['modelo']);
$color = htmlspecialchars($_POST['color']);
$eje = htmlspecialchars($_POST['eje']);
$annio = htmlspecialchars($_POST['annio']);
$serial_motor = htmlspecialchars($_POST['serial_motor']);
$serial_carroceria = htmlspecialchars($_POST['serial_carroceria']);


// Validacion de variables
if (($matricula == "") || ($marca == "") || ($modelo == "") || ($color == "seleccione") || ($annio == "") || ($serial_motor == "") || ($serial_carroceria == "")) {    
    echo "
    <div class='alert alert-danger alert-dismissable'>
        <a class='close' data-dismiss='alert' aria-label='close'>&times;</a>
        <div class='alert-body text-center'>Chuto no puede ser registrado</div>
    </div>";
    
} elseif (strlen($matricula) < 7) {
    echo "
    <div class='alert alert-danger alert-dismissable'>
        <a class='close' data-dismiss='alert' aria-label='close'>&times;</a>
        <div class='alert-body text-center'>Matrícula inválida</div>
    </div>";
    
} elseif (strlen($annio) < 4) {
    echo "
    <div class='alert alert-danger alert-dismissable'>
        <a class='close' data-dismiss='alert' aria-label='close'>&times;</a>
        <div class='alert-body text-center'>Año inválido</div>
    </div>";
    
} elseif (strlen($serial_motor) < 10) {
    echo "
    <div class='alert alert-danger alert-dismissable'>
        <a class='close' data-dismiss='alert' aria-label='close'>&times;</a>
        <div class='alert-body text-center'>Serial Motor inválido</div>
    </div>";
    
} elseif (strlen($serial_carroceria) < 10) {
    echo "
    <div class='alert alert-danger alert-dismissable'>
        <a class='close' data-dismiss='alert' aria-label='close'>&times;</a>
        <div class='alert-body text-center'>Serial Carrocería inválido</div>
    </div>";

// Ejecuta el metodo registrar
} elseif ($crear->Crear($matricula, $marca, $modelo, $color, $eje, $annio, $serial_motor, $serial_carroceria)) {
    echo "
    <script>
        swal({
        title: 'Nuevo Chuto',
        text: 'Registrado satisfactoriamente',
        type: 'success',
        showCancelButton: false,
        confirmButtonText: 'OK',
        closeOnConfirm: false
        },
        
        function() {
            location.href = '/transmivyca/views/chutos.php';
        });
    </script>";
    

} else {
    echo "
    <div class='alert alert-danger alert-dismissable'>
        <a class='close' data-dismiss='alert' aria-label='close'>&times;</a>
        <div class='alert-body text-center'>Chuto ya se encuentra registrado</div>
    </div>";
}