<?php

include 'session.php'; 

if ($_SESSION['privilegio'] == "OPERADOR") {
    
    header('location: administrator.php');
}
?>
<!Doctype html>
<html lang="es">
    <?php include '../assets/head.php'; ?>
    
    <body>
        <!-- Navbar -->
        <?php include 'navbar.php'; ?>
        <!-- /Navbar -->
        
        <!-- Formulario registro -->       
        <div class="container">
            <div class="col-md-6 col-md-offset-3">
                <form id="registro-usuario" class="container-form">
                    <h2 class="text-center">Registro de Usuario</h2>
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
                    <div class="form-group input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
                        <select class="form-control" name="privilegio" data-toggle="tooltip" data-placement="right" title="Privilegio">
                            <option value="seleccione">Seleccione</option>
                            <option value="OPERADOR">Operador</option>
                        </select>
                    </div>
                    <!-- *************************** -->
                    <button type="submit" class="btn btn-primary btn-lg center-block"><span class="glyphicon glyphicon-ok"></span> Aceptar</button>
                    <!-- Respuesta -->
                    <div id="respuesta" style="display: none"></div>
                    <!-- /Respuesta -->
                </form>                
            </div>
        </div>
        <!-- /Formulario registro --> 
        
        <?php include '../assets/footer.php'; ?>
    </body>
</html>