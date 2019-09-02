<?php
require_once '../models/class.batea.php';

$editar = new Batea();

// Saneamiento de variables
$id = htmlspecialchars($_POST['id_batea']);
$matricula = htmlspecialchars($_POST['matricula']);
$serial = htmlspecialchars($_POST['serial']);
$eje = htmlspecialchars($_POST['eje']);


// Validacion de variables
if (($id == "") || ($matricula == "") || ($serial == "")) {    
    echo "
    <div class='alert alert-danger alert-dismissable'>
        <a class='close' data-dismiss='alert' aria-label='close'>&times;</a>
        <div class='alert-body text-center'>No se puede actualizar registro</div>
    </div>";

// Ejecuta el metodo actualizar
} elseif ($editar->Actualizar($matricula, $serial, $eje, $id)) {
    echo "
    <script>
        swal({
        title: 'Actualizar Batea',
        text: 'Editado satisfactoriamente',
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
        <div class='alert-body text-center'>No se puede actualizar registro</div>
    </div>";
}