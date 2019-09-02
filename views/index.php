<?php
session_start();
require_once '../models/class.usuario.php';

$login = new Usuario();

// Si el usuario ya se encuentra logeado, entonces es redirigido a la pantalla principal
if ($login->Loggedin() != "") {
    header('location: administrator.php');
}
?>
<!Doctype html>
<html lang="es">
    <?php include '../assets/head.php'; ?>
    
    <body>
        <!-- Navbar -->
        <?php include '../assets/navbar.php'; ?>
        <!-- /Navbar -->
        
        <!-- Formulario login -->        
        <div class="container">
            <div class="col-md-6 col-md-offset-3">
                <form id="login" class="container-form">
                    <h2 class="text-center">Login de Acceso</h2>
                    <div class="form-group input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                        <input type="text" class="form-control" name="user" placeholder="Usuario" autocomplete="off" required>
                    </div>
                    <!-- *************************** -->
                    <div class="form-group input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                        <input type="password" class="form-control" name="password" placeholder="Contraseña" required>
                    </div>
                    <!-- *************************** -->
                    <button type="submit" class="btn btn-primary btn-lg center-block"><span class="glyphicon glyphicon-ok"></span> Ingresar</button>
                    <!-- Respuesta -->
                    <div id="respuesta" style="display: none"></div>
                    <!-- /Respuesta -->
                </form>                
            </div>
        </div>
        <!-- /Formulario login -->
        
        <?php include '../assets/footer.php'; ?>
    </body>
</html>