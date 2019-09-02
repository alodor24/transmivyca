<?php
require_once '../models/class.viaticos.php';

$editar = new Viaticos();

// Saneamiento de variables
$id = htmlspecialchars($_POST['id_viaticos']);
$peaje = (double) htmlspecialchars($_POST['peaje']);
$comida = (double) htmlspecialchars($_POST['comida']);
$combustible = (double) htmlspecialchars($_POST['combustible']);
$otros = (double) htmlspecialchars($_POST['otros']);
$total = ($peaje + $comida + $combustible + $otros);


// Validacion de variables
if (($id == "") || ($peaje == "") || ($comida == "") || ($combustible == "") || ($otros == "")) {    
    echo "
    <div class='alert alert-danger alert-dismissable'>
        <a class='close' data-dismiss='alert' aria-label='close'>&times;</a>
        <div class='alert-body text-center'>No se puede actualizar registro</div>
    </div>";

// Ejecuta el metodo actualizar
} elseif ($editar->Actualizar($peaje, $comida, $combustible, $otros, $total, $id)) {
    echo "
    <script>
        swal({
        title: 'Actualizar Viático',
        text: 'Editado satisfactoriamente',
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
        <div class='alert-body text-center'>No se puede actualizar registro</div>
    </div>";
}