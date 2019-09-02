<?php
require_once '../models/class.usuario.php';

$login = new Usuario();

// Saneamiento de variables
$user = htmlspecialchars($_POST['user']);
$password = htmlspecialchars($_POST['password']);


// Validacion de variables
if (($user == "") || ($password == "")) {
    echo "
    <div class='alert alert-danger alert-dismissable'>
        <a class='close' data-dismiss='alert' aria-label='close'>&times;</a>
        <div class='alert-body text-center'>Uno o ambos campos se encuentran vacíos</div>
    </div>";

// Ejecuta el metodo ingresar
} elseif ($login->Ingresar($user, $password)) {
    echo "
    <script>
        location.href = '/transmivyca/views/administrator.php';    
    </script>";

} else {
    echo "
    <div class='alert alert-danger alert-dismissable'>
        <a class='close' data-dismiss='alert' aria-label='close'>&times;</a>
        <div class='alert-body text-center'>Usuario o Contraseña incorrecta</div>
    </div>";
}