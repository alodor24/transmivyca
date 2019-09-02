<?php
require_once '../models/class.chofer.php';

$editar = new Chofer();

// Saneamiento de variables
$id = htmlspecialchars($_POST['id_chofer']);
$cedula = htmlspecialchars($_POST['cedula']);
$nombre = htmlspecialchars($_POST['nombre']);
$apellido = htmlspecialchars($_POST['apellido']);
$direccion = htmlspecialchars($_POST['direccion']);
$telefono = htmlspecialchars($_POST['telefono']);
$fv_licencia = $_POST['fv_licencia'];
$fv_certificado = $_POST['fv_certificado'];


// Validacion de variables
if (($id == "") || ($cedula == "") || ($nombre == "") || ($apellido == "") || ($direccion == "") || ($telefono == "")) {    
    echo "
    <div class='alert alert-danger alert-dismissable'>
        <a class='close' data-dismiss='alert' aria-label='close'>&times;</a>
        <div class='alert-body text-center'>No se puede actualizar registro</div>
    </div>";

// Ejecuta el metodo actualizar
} elseif ($editar->Actualizar($cedula, $nombre, $apellido, $direccion, $telefono, $fv_licencia, $fv_certificado, $id)) {
    echo "
    <script>
        swal({
        title: 'Actualizar Chofer',
        text: 'Editado satisfactoriamente',
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
        <div class='alert-body text-center'>No se puede actualizar registro</div>
    </div>";
}