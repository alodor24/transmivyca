<?php
require_once '../models/class.destino.php';

$crear = new Destino();

// Saneamiento de variables
$origen = 'BARCELONA';
$destino = htmlspecialchars($_POST['destino']);
$distancia = htmlspecialchars($_POST['distancia']);
$peaje = (double) htmlspecialchars($_POST['peaje']);
$comida = (double) htmlspecialchars($_POST['comida']);
$combustible = (double) htmlspecialchars($_POST['combustible']);
$otros = (double) htmlspecialchars($_POST['otros']);
$total = ($peaje + $comida + $combustible + $otros);

// Validacion de variables
if (($destino == "") || ($distancia == "") || ($peaje == "") || ($comida == "") || ($combustible == "") || ($otros == "")) {    
    echo "
    <div class='alert alert-danger alert-dismissable'>
        <a class='close' data-dismiss='alert' aria-label='close'>&times;</a>
        <div class='alert-body text-center'>Destino no puede ser registrado</div>
    </div>";

// Ejecuta el metodo registrar
} elseif ($crear->Crear($origen, $destino, $distancia, $peaje, $comida, $combustible, $otros, $total)) {
    echo "
    <script>
        swal({
        title: 'Nuevo Destino',
        text: 'Registrado satisfactoriamente',
        type: 'success',
        showCancelButton: false,
        confirmButtonText: 'OK',
        closeOnConfirm: false
        },
        
        function() {
            location.href = '/transmivyca/views/destinos.php';
        });
    </script>";
    

} else {
    echo "
    <div class='alert alert-danger alert-dismissable'>
        <a class='close' data-dismiss='alert' aria-label='close'>&times;</a>
        <div class='alert-body text-center'>Destino ya se encuentra registrado</div>
    </div>";
}