<?php
require_once '../models/class.chofer.php';

$crear = new Chofer();

// Saneamiento de variables
$cedula = htmlspecialchars($_POST['cedula']);
$nombre = htmlspecialchars($_POST['nombre']);
$apellido = htmlspecialchars($_POST['apellido']);
$direccion = htmlspecialchars($_POST['direccion']);
$telefono = htmlspecialchars($_POST['telefono']);
$fv_licencia = $_POST['fv_licencia'];
$fv_certificado = $_POST['fv_certificado'];
$fecha_ingreso = date('Y-m-d');


// Validacion de variables
if (($cedula == "") || ($nombre == "") || ($apellido == "") || ($direccion == "") || ($telefono == "")) {    
    echo "
    <div class='alert alert-danger alert-dismissable'>
        <a class='close' data-dismiss='alert' aria-label='close'>&times;</a>
        <div class='alert-body text-center'>Chofer no puede ser registrado</div>
    </div>";
    
} elseif (strlen($telefono) < 11) {
    echo "
    <div class='alert alert-danger alert-dismissable'>
        <a class='close' data-dismiss='alert' aria-label='close'>&times;</a>
        <div class='alert-body text-center'>Número de teléfono inválido</div>
    </div>";
    
} elseif (strlen($cedula) < 7) {
    echo "
    <div class='alert alert-danger alert-dismissable'>
        <a class='close' data-dismiss='alert' aria-label='close'>&times;</a>
        <div class='alert-body text-center'>Número de cédula inválido</div>
    </div>";

// Ejecuta el metodo registrar
} elseif ($crear->Crear($cedula, $nombre, $apellido, $direccion, $telefono, $fv_licencia, $fv_certificado, $fecha_ingreso)) {
    echo "
    <script>
        swal({
        title: 'Nuevo Chofer',
        text: 'Registrado satisfactoriamente',
        type: 'success',
        showCancelButton: false,
        confirmButtonText: 'OK',
        closeOnConfirm: false
        },
        
        function() {
            location.href = '/transmivyca/views/chofer.php';
        });
    </script>";
    

} else {
    echo "
    <div class='alert alert-danger alert-dismissable'>
        <a class='close' data-dismiss='alert' aria-label='close'>&times;</a>
        <div class='alert-body text-center'>Chofer ya se encuentra registrado</div>
    </div>";
}