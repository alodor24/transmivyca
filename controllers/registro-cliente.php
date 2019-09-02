<?php
require_once '../models/class.cliente.php';

$crear = new Cliente();

// Saneamiento de variables
$rif = htmlspecialchars($_POST['rif']);
$razon_social = htmlspecialchars($_POST['razon_social']);
$direccion = htmlspecialchars($_POST['direccion']);
$telefono = htmlspecialchars($_POST['telefono']);
$responsable = htmlspecialchars($_POST['responsable']);


// Validacion de variables
if (($rif == "") || ($razon_social == "") || ($direccion == "") || ($telefono == "") || ($responsable == "")) {    
    echo "
    <div class='alert alert-danger alert-dismissable'>
        <a class='close' data-dismiss='alert' aria-label='close'>&times;</a>
        <div class='alert-body text-center'>Cliente no puede ser registrado</div>
    </div>";
    
} elseif (strlen($telefono) < 11) {
    echo "
    <div class='alert alert-danger alert-dismissable'>
        <a class='close' data-dismiss='alert' aria-label='close'>&times;</a>
        <div class='alert-body text-center'>Número de teléfono inválido</div>
    </div>";
    
} elseif (strlen($rif) < 11) {
    echo "
    <div class='alert alert-danger alert-dismissable'>
        <a class='close' data-dismiss='alert' aria-label='close'>&times;</a>
        <div class='alert-body text-center'>RIF inválido</div>
    </div>";

// Ejecuta el metodo registrar
} elseif ($crear->Crear($rif, $razon_social, $direccion, $telefono, $responsable)) {
    echo "
    <script>
        swal({
        title: 'Nuevo Cliente',
        text: 'Registrado satisfactoriamente',
        type: 'success',
        showCancelButton: false,
        confirmButtonText: 'OK',
        closeOnConfirm: false
        },
        
        function() {
            location.href = '/transmivyca/views/clientes.php';
        });
    </script>";
    

} else {
    echo "
    <div class='alert alert-danger alert-dismissable'>
        <a class='close' data-dismiss='alert' aria-label='close'>&times;</a>
        <div class='alert-body text-center'>Cliente ya se encuentra registrado</div>
    </div>";
}