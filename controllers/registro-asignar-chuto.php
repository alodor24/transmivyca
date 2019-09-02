<?php
require_once '../models/class.asignar-chuto.php';

$crear = new AsignarChuto();

// Saneamiento de variables
$id_chofer = htmlspecialchars($_POST['chofer']);
$id_chuto = htmlspecialchars($_POST['chuto']);
$id_batea = htmlspecialchars($_POST['batea']);

// Validacion de variables
if (($id_chofer == "seleccione") || ($id_chuto == "seleccione") || ($id_batea == "seleccione")) {    
    echo "
    <div class='alert alert-danger alert-dismissable'>
        <a class='close' data-dismiss='alert' aria-label='close'>&times;</a>
        <div class='alert-body text-center'>No se puede realizar la asignación</div>
    </div>";

// Ejecuta el metodo registrar
} elseif ($crear->Crear($id_chofer, $id_chuto, $id_batea)) {
    echo "
    <script>
        swal({
        title: 'Nueva Asignación',
        text: 'Registrada satisfactoriamente',
        type: 'success',
        showCancelButton: false,
        confirmButtonText: 'OK',
        closeOnConfirm: false
        },
        
        function() {
            location.href = '/transmivyca/views/asignar-chuto.php';
        });
    </script>";
    

} else {
    echo "
    <div class='alert alert-danger alert-dismissable'>
        <a class='close' data-dismiss='alert' aria-label='close'>&times;</a>
        <div class='alert-body text-center'>Chuto se encuentra en mantenimiento</div>
    </div>";
}