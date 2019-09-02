<?php

include 'session.php';
require_once '../models/class.chofer.php';
require_once '../models/class.chuto.php';
require_once '../models/class.batea.php';
require_once '../models/class.asignar-chuto.php';

$chofer = new Chofer();
$chuto = new Chuto();
$batea = new Batea();
$listar = new AsignarChuto();

?>
<!Doctype html>
<html lang="es">
    <?php include '../assets/head.php'; ?>
    
    <body>
        <!-- Navbar -->
        <?php include 'navbar.php'; ?>
        <!-- /Navbar -->
        
        <!-- Encabezado -->
        <h1 class="titulo text-center">Asignación de Chuto</h1>
        <!-- /Encabezado -->
        
        <div class="container">
            <div class="text-right">
                <!-- Buscador -->
                <input id="buscadorAsignacion" class="buscador" type="text" placeholder="Buscador" onKeyUp="this.value=this.value.toUpperCase()" onpaste="return false" autocomplete="off">
                <!-- /Buscador -->
              
                <!-- Nuevo -->
                <a class="btn btn-success btn-lg" data-toggle="modal" data-target="#nuevo"><span class="glyphicon glyphicon-new-window"></span> Nuevo</a>
                <!-- /Nuevo -->
                
                <!-- Reporte -->
                <a id="reporte" class="btn btn-primary btn-lg" onclick="reporteAsignacion()"><span class="glyphicon glyphicon-print"></span> Generar Reporte</a>
                <!-- /Reporte -->
            </div>
            
            <!-- Tabla asignar -->
            <div id="resultado" class="table-responsive" style="display: none"></div>
            
            <div id="listado" class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Chofer</th>
                            <th>Matrícula Chuto</th>
                            <th>Matrícula Batea</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        <?php                        
                        $data = $listar->Listar();
                        foreach ($data as $valor) { ?>
                        <tr>
                            <td><?php echo $valor['id_asignar']; ?></td>
                            <td><?php echo $valor['nombre'] ." ". $valor['apellido']; ?></td>
                            <td><?php echo $valor['matricula_chuto']; ?></td>
                            <td><?php echo $valor['matricula_batea']; ?></td>
                            <td>
                                <?php 
                                if ($_SESSION['privilegio'] == "administrador") { ?>
                                                                
                                <a class="btn btn-danger" data-toggle="tooltip" data-placement="bottom" title="Eliminar" onclick="eliminarAsignacion(<?php echo $valor['id_asignar']; ?>)">
                                    <span class="glyphicon glyphicon-trash"></span>
                                </a>
                                
                                <?php } ?>
                            </td>
                        </tr>
                        <?php                        
                        }                        
                        ?>                            
                    </tbody>
                </table>
            </div>
            <!-- /Tabla asignar -->
            
            <!-- Modal nuevo -->
            <div id="nuevo" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h3 class="modal-title">Nueva Asignación</h3>
                        </div>
                        <div class="modal-body">
                            <!-- Formulario -->
                            <form id="nueva-asignacion">
                                <div class="form-group input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                    <select class="form-control" name="chofer" data-toggle="tooltip" data-placement="right" title="Chofer">
                                        <option value="seleccione">Seleccione</option>
                                        <?php
                                        $data = $chofer->ListarChofer();
                                        foreach ($data as $valor) { ?>
                                            <option value="<?php echo $valor['id_chofer']; ?>"><?php echo $valor['nombre'] ." ". $valor['apellido'] ." ". $valor['cedula']; ?></option>
                                        <?php                        
                                        }                        
                                        ?>  
                                    </select>
                                </div>
                                <!-- ****************************** -->
                                <div class="form-group input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-object-align-right"></i></span>
                                    <select class="form-control" name="chuto" data-toggle="tooltip" data-placement="right" title="Chuto">
                                        <option value="seleccione">Seleccione</option>
                                        <?php
                                        $data = $chuto->ListarChuto();
                                        foreach ($data as $valor) { ?>
                                            <option value="<?php echo $valor['id_chuto']; ?>"><?php echo $valor['matricula_chuto']; ?></option>
                                        <?php                        
                                        }                        
                                        ?>  
                                    </select>
                                </div>
                                <!-- ****************************** -->
                                <div class="form-group input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-object-align-right"></i></span>
                                    <select class="form-control" name="batea" data-toggle="tooltip" data-placement="right" title="Batea">
                                        <option value="seleccione">Seleccione</option>
                                        <?php
                                        $data = $batea->ListarBatea();
                                        foreach ($data as $valor) { ?>
                                            <option value="<?php echo $valor['id_batea']; ?>"><?php echo $valor['matricula_batea']; ?></option>
                                        <?php                        
                                        }                        
                                        ?>  
                                    </select>
                                </div>
                                <!-- ****************************** -->
                                <button type="submit" class="btn btn-success btn-lg center-block"><span class="glyphicon glyphicon-ok"></span> Aceptar</button>
                            </form>
                            <!-- /Formulario -->
                            
                            <!-- Respuesta -->
                            <div id="respuesta" style="display: none"></div>
                            <!-- /Respuesta -->
                        </div>
                        <div class="modal-footer">                            
                            <button type="button" class="btn btn-danger btn-lg" data-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                    <!-- /Modal content-->
                </div>
            </div>
            <!-- /Modal nuevo -->
        </div>
        
        <?php include '../assets/footer.php'; ?>
    </body>
</html>