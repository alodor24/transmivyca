<?php
require_once '../models/class.cliente.php';

$editar = new Cliente();

// Saneamiento de variables
$id = htmlspecialchars($_POST['id_cliente']);
$rif = htmlspecialchars($_POST['rif']);
$razon_social = htmlspecialchars($_POST['razon_social']);
$direccion = htmlspecialchars($_POST['direccion']);
$telefono = htmlspecialchars($_POST['telefono']);
$responsable = htmlspecialchars($_POST['responsable']);


// Validacion de variables
if (($id == "") || ($rif == "") || ($razon_social == "") || ($direccion == "") || ($telefono == "") || ($responsable == "")) {    
    echo "
    <div class='alert alert-danger alert-dismissable'>
        <a class='close' data-dismiss='alert' aria-label='close'>&times;</a>
        <div class='alert-body text-center'>No se puede actualizar registro</div>
    </div>";

// Ejecuta el metodo actualizar
} elseif ($editar->Actualizar($rif, $razon_social, $direccion, $telefono, $responsable, $id)) {
    echo "
    <script>
        swal({
        title: 'Actualizar Cliente',
        text: 'Editado satisfactoriamente',
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
        <div class='alert-body text-center'>No se puede actualizar registro</div>
    </div>";
}