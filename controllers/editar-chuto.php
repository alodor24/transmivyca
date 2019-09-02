<?php
require_once '../models/class.chuto.php';

$editar = new Chuto();

// Saneamiento de variables
$id = htmlspecialchars($_POST['id_chuto']);
$matricula_chuto = htmlspecialchars($_POST['matricula_chuto']);
$serial_motor = htmlspecialchars($_POST['serial_motor']);
$serial_carroceria = htmlspecialchars($_POST['serial_carroceria']);


// Validacion de variables
if (($id == "") || ($serial_motor == "") || ($serial_carroceria == "")) {    
    echo "
    <div class='alert alert-danger alert-dismissable'>
        <a class='close' data-dismiss='alert' aria-label='close'>&times;</a>
        <div class='alert-body text-center'>No se puede actualizar registro</div>
    </div>";

// Ejecuta el metodo actualizar
} elseif ($editar->Actualizar($matricula_chuto, $serial_motor, $serial_carroceria, $id)) {
    echo "
    <script>
        swal({
        title: 'Actualizar Chuto',
        text: 'Editado satisfactoriamente',
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
        <div class='alert-body text-center'>No se puede actualizar registro</div>
    </div>";
}