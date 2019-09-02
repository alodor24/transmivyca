<?php
require_once '../models/class.mantenimiento.php';

$crear = new Mantenimiento();

// Saneamiento de variables
$id_chuto = htmlspecialchars($_POST['chuto']);
$kilometraje = htmlspecialchars($_POST['kilometraje']);
$falla = htmlspecialchars($_POST['falla']);
$tipo_mantenimiento = htmlspecialchars($_POST['tipo_mantenimiento']);
$fecha_ingreso = date("Y-m-d");
$status = 'INACTIVO';

// Validacion de variables
if (($id_chuto == "seleccione") || ($kilometraje == "")) {    
    echo "
    <div class='alert alert-danger alert-dismissable'>
        <a class='close' data-dismiss='alert' aria-label='close'>&times;</a>
        <div class='alert-body text-center'>No se puede realizar el registro</div>
    </div>";

// Ejecuta el metodo registrar
} elseif ($crear->Crear($id_chuto, $kilometraje, $falla, $tipo_mantenimiento, $fecha_ingreso, $status)) {
    echo "
    <script>
        swal({
        title: 'Nuevo Mantenimiento',
        text: 'Registrado satisfactoriamente',
        type: 'success',
        showCancelButton: false,
        confirmButtonText: 'OK',
        closeOnConfirm: false
        },
        
        function() {
            location.href = '/transmivyca/views/mantenimiento-chuto.php';
        });
    </script>";
    

} else {
    echo "
    <div class='alert alert-danger alert-dismissable'>
        <a class='close' data-dismiss='alert' aria-label='close'>&times;</a>
        <div class='alert-body text-center'>Este chuto ya se encuentra en mantenimiento</div>
    </div>";
}