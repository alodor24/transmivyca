<?php 

include 'session.php'; 
require_once '../models/class.batea.php';

$listar = new Batea();

?>
<!Doctype html>
<html lang="es">
    <?php include '../assets/head.php'; ?>
    
    <body>
        <!-- Navbar -->
        <?php include 'navbar.php'; ?>
        <!-- /Navbar -->
        
        <!-- Encabezado -->
        <h1 class="titulo text-center">Gestionar Bateas</h1>
        <!-- /Encabezado -->
        
        <div class="container">
            <div class="text-right">
                <!-- Buscador -->
                <input id="buscadorBatea" class="buscador" type="text" placeholder="Buscador" onKeyUp="this.value=this.value.toUpperCase()" onpaste="return false" autocomplete="off">
                <!-- /Buscador -->
                                           
                <!-- Nuevo -->
                <a class="btn btn-success btn-lg" data-toggle="modal" data-target="#nuevo"><span class="glyphicon glyphicon-new-window"></span> Nuevo</a>
                <!-- /Nuevo -->
                
                <!-- Reporte -->
                <a id="reporte" class="btn btn-primary btn-lg" onclick="reporteBatea()"><span class="glyphicon glyphicon-print"></span> Generar Reporte</a>
                <!-- /Reporte -->
            </div>
            
            <!-- Tabla bateas -->
            <div id="resultado" class="table-responsive" style="display: none"></div>
            
            <div id="listado" class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Matrícula</th>
                            <th>Serial</th>
                            <th>Eje</th>
                            <th>Fecha Registro</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        <?php                        
                        $data = $listar->Listar();
                        foreach ($data as $valor) { ?>
                        <tr>
                            <td><?php echo $valor['id_batea']; ?></td>
                            <td><?php echo $valor['matricula_batea']; ?></td>
                            <td><?php echo $valor['serial']; ?></td>
                            <td><?php echo $valor['eje']; ?></td>
                            <td><?php echo $valor['fecha_registro']; ?></td>
                            <td>
                                <?php 
                                if ($_SESSION['privilegio'] == "administrador") { ?>
                                
                                <a class="btn btn-primary" data-toggle="tooltip" data-placement="bottom" title="Editar" onclick="obtenerBatea(<?php echo $valor['id_batea']; ?>)">
                                    <span class="glyphicon glyphicon-edit"></span>
                                </a>
                                
                                <a class="btn btn-danger" data-toggle="tooltip" data-placement="bottom" title="Eliminar" onclick="eliminarBatea(<?php echo $valor['id_batea']; ?>)">
                                    <span class="glyphicon glyphicon-trash"></span>
                                </a>
                                
                                <?php
                                } else { ?>
                                
                                <a class="btn btn-primary" data-toggle="tooltip" data-placement="bottom" title="Editar" onclick="obtenerBatea(<?php echo $valor['id_batea']; ?>)">
                                    <span class="glyphicon glyphicon-edit"></span>
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
            <!-- /Tabla bateas -->
            
            <!-- Modal nuevo -->
            <div id="nuevo" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h3 class="modal-title">Nueva Batea</h3>
                        </div>
                        <div class="modal-body">
                            <!-- Formulario -->
                            <form id="nueva-batea">
                                <div class="form-group input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-asterisk"></i></span>
                                    <input type="text" class="form-control" name="matricula" placeholder="Matrícula" maxlength="10" onKeyUp="this.value=this.value.toUpperCase()" onpaste="return false" autocomplete="off" required>
                                </div>
                                <!-- ****************************** -->
                                <div class="form-group input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-barcode"></i></span>
                                    <input type="text" class="form-control" name="serial" placeholder="Serial" maxlength="10" onKeyUp="this.value=this.value.toUpperCase()" onpaste="return false" autocomplete="off" required>
                                </div>
                                <!-- ****************************** -->
                                <div class="form-group input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-th-list"></i></span>
                                    <select class="form-control" name="eje" data-toggle="tooltip" data-placement="right" title="Eje">
                                        <option value="seleccione">Seleccione</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
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
            
            <!-- Modal editar -->
            <div id="editarBatea" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h3 class="modal-title">Editar Batea</h3>
                        </div>
                        <div class="modal-body">
                            <!-- Formulario -->
                            <form id="editar-batea">
                                <div class="form-group input-group">
                                    <input id="id_batea" name="id_batea" type="hidden">
                                    
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-asterisk"></i></span>
                                    <input id="matricula" type="text" class="form-control" name="matricula" placeholder="Matrícula" onKeyUp="this.value=this.value.toUpperCase()" onpaste="return false" autocomplete="off" maxlength="10" data-toggle="tooltip" data-placement="right" title="Matrícula" required>
                                </div>
                                <!-- ****************************** -->
                                <div class="form-group input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-barcode"></i></span>
                                    <input id="serial" type="text" class="form-control" name="serial" placeholder="Serial" onKeyUp="this.value=this.value.toUpperCase()" onpaste="return false" autocomplete="off" maxlength="10" data-toggle="tooltip" data-placement="right" title="Serial" required>
                                </div>
                                <!-- ****************************** -->
                                <div class="form-group input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-th-list"></i></span>
                                    <select class="form-control" name="eje" data-toggle="tooltip" data-placement="right" title="Eje">
                                        <option value="seleccione">Seleccione</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
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
            <!-- /Modal editar -->
        </div>
        
        <?php include '../assets/footer.php'; ?>
    </body>
</html>