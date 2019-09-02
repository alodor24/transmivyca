<?php
require_once '../models/class.mantenimiento.php';

$editar = new Mantenimiento();

// Saneamiento de variables
$id = htmlspecialchars($_POST['id_mantenimiento']);
$fecha_egreso = date('Y-m-d');
$status = htmlspecialchars($_POST['status']);

// Validacion de variables
if (($id == "") || ($status == "seleccione")) {    
    echo "
    <div class='alert alert-danger alert-dismissable'>
        <a class='close' data-dismiss='alert' aria-label='close'>&times;</a>
        <div class='alert-body text-center'>No se puede actualizar registro</div>
    </div>";   


// Ejecuta el metodo actualizar
} elseif ($editar->Actualizar($fecha_egreso, $status, $id)) {
    echo "
    <script>
        swal({
        title: 'Actualizar Mantenimiento',
        text: 'Editado satisfactoriamente',
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
        <div class='alert-body text-center'>No se puede actualizar registro</div>
    </div>";
}