<?php
require_once '../models/class.usuario.php';

$registrar = new Usuario();

// Saneamiento de variables
$user = htmlspecialchars($_POST['user']);
$password = password_hash(htmlspecialchars($_POST['password']), PASSWORD_DEFAULT);
$privilegio = htmlspecialchars($_POST['privilegio']);


// Validacion de variables
if (($user == "") || ($password == "") || ($privilegio == "") || ($privilegio == "seleccione")) {    
    echo "
    <div class='alert alert-danger alert-dismissable'>
        <a class='close' data-dismiss='alert' aria-label='close'>&times;</a>
        <div class='alert-body text-center'>Usuario no puede ser registrado</div>
    </div>";

// Ejecuta el metodo registrar
} elseif ($registrar->Registrar($user, $password, $privilegio)) {
    echo "
    <div class='alert alert-success alert-dismissable'>
        <a class='close' data-dismiss='alert' aria-label='close'>&times;</a>
        <div class='alert-body text-center'>Usuario registrado satisfactoriamente</div>
    </div>";

} else {
    echo "
    <div class='alert alert-danger alert-dismissable'>
        <a class='close' data-dismiss='alert' aria-label='close'>&times;</a>
        <div class='alert-body text-center'>Usuario ya se encuentra registrado</div>
    </div>";
}