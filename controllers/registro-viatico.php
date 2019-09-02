<?php
require_once '../models/class.viaticos.php';

$crear = new Viaticos();

// Saneamiento de variables
$peaje = (double) htmlspecialchars($_POST['peaje']);
$comida = (double) htmlspecialchars($_POST['comida']);
$combustible = (double) htmlspecialchars($_POST['combustible']);
$otros = (double) htmlspecialchars($_POST['otros']);
$total = ($peaje + $comida + $combustible + $otros);


// Validacion de variables
if (($peaje == "") || ($comida == "") || ($combustible == "") || ($otros == "")) {    
    echo "
    <div class='alert alert-danger alert-dismissable'>
        <a class='close' data-dismiss='alert' aria-label='close'>&times;</a>
        <div class='alert-body text-center'>Viático no puede ser registrado</div>
    </div>";

// Ejecuta el metodo registrar
} elseif ($crear->Crear($peaje, $comida, $combustible, $otros, $total)) {
    echo "
    <script>
        swal({
        title: 'Nuevo Viático',
        text: 'Registrado satisfactoriamente',
        type: 'success',
        showCancelButton: false,
        confirmButtonText: 'OK',
        closeOnConfirm: false
        },
        
        function() {
            location.href = '/transmivyca/views/viaticos.php';
        });
    </script>";
    

} else {
    echo "
    <div class='alert alert-danger alert-dismissable'>
        <a class='close' data-dismiss='alert' aria-label='close'>&times;</a>
        <div class='alert-body text-center'>Viático no puede ser registrado</div>
    </div>";
}