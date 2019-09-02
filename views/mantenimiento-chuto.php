<?php

include 'session.php';
require_once '../models/class.mantenimiento.php';
require_once '../models/class.chuto.php';

$listar = new Mantenimiento();
$chuto = new Chuto();

?>
<!Doctype html>
<html lang="es">
    <?php include '../assets/head.php'; ?>
    
    <body>
        <!-- Navbar -->
        <?php include 'navbar.php'; ?>
        <!-- /Navbar -->
        
        <!-- Encabezado -->
        <h1 class="titulo text-center">Mantenimiento de Chuto</h1>
        <!-- /Encabezado -->
        
        <div class="container">
            <div class="text-right">
                <!-- Buscador -->
                <input id="buscadorMantenimiento" class="buscador" type="text" placeholder="Buscador" onKeyUp="this.value=this.value.toUpperCase()" onpaste="return false" autocomplete="off">
                <!-- /Buscador -->
               
                <!-- Nuevo -->
                <a class="btn btn-success btn-lg" data-toggle="modal" data-target="#nuevo"><span class="glyphicon glyphicon-new-window"></span> Nuevo</a>
                <!-- /Nuevo -->
                
                <!-- Reporte -->
                <a id="reporte" class="btn btn-primary btn-lg" onclick="reporteMantenimiento()"><span class="glyphicon glyphicon-print"></span> Generar Reporte</a>
                <!-- /Reporte -->
            </div>
            
            <!-- Tabla clientes -->
            <div id="resultado" class="table-responsive" style="display: none"></div>
            
            <div id="listado" class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Matrícula</th>
                            <th>Kilometraje</th>
                            <th>Falla</th>
                            <th>Tipo Mantenimiento</th>
                            <th>Fecha Ingreso</th>
                            <th>Fecha Egreso</th>
                            <th>Status</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        <?php                        
                        $data = $listar->Listar();
                        foreach ($data as $valor) { ?>
                        <tr>
                            <td><?php echo $valor['id_mantenimiento']; ?></td>
                            <td><?php echo $valor['matricula_chuto']; ?></td>
                            <td><?php echo $valor['kilometraje']; ?> Km</td>
                            <td><?php echo $valor['falla']; ?></td>
                            <td><?php echo $valor['tipo_mantenimiento']; ?></td>
                            <td><?php echo $valor['fecha_ingreso']; ?></td>
                            <td><?php echo $valor['fecha_egreso']; ?></td>
                            <td><?php echo $valor['status']; ?></td>
                            <td>
                                <?php 
                                if ($_SESSION['privilegio'] == "administrador") { ?>
                                
                                <a class="btn btn-primary" data-toggle="tooltip" data-placement="bottom" title="Editar" onclick="obtenerMantenimiento(<?php echo $valor['id_mantenimiento']; ?>)">
                                    <span class="glyphicon glyphicon-edit"></span>
                                </a>
                                
                                <a class="btn btn-danger" data-toggle="tooltip" data-placement="bottom" title="Eliminar" onclick="eliminarMantenimiento(<?php echo $valor['id_mantenimiento']; ?>)">
                                    <span class="glyphicon glyphicon-trash"></span>
                                </a>
                                
                                <?php
                                } else { ?>
                                
                                <a class="btn btn-primary" data-toggle="tooltip" data-placement="bottom" title="Editar" onclick="obtenerMantenimiento(<?php echo $valor['id_mantenimiento']; ?>)">
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
            <!-- /Tabla clientes -->
            
            <!-- Modal nuevo -->
            <div id="nuevo" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h3 class="modal-title">Nuevo Mantenimiento</h3>
                        </div>
                        <div class="modal-body">
                            <!-- Formulario -->
                            <form id="nuevo-mantenimiento">
                                <div class="form-group input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-object-align-right"></i></span>
                                    <select class="form-control" name="chuto" data-toggle="tooltip" data-placement="right" title="Chuto">
                                        <option value="seleccione">Seleccione</option>
                                        <?php
                                        $data = $chuto->ListarChutoMantenimiento();
                                        foreach ($data as $valor) { ?>
                                            <option value="<?php echo $valor['id_chuto']; ?>"><?php echo $valor['matricula_chuto']; ?></option>
                                        <?php                        
                                        }                        
                                        ?>  
                                    </select>
                                </div>
                                <!-- ****************************** -->
                                <div class="form-group input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-dashboard"></i></span>
                                    <input type="text" class="form-control" name="kilometraje" placeholder="Kilometraje" onkeypress="return onlyNumber(event)" onpaste="return false" autocomplete="off" required>
                                </div>
                                <!-- ****************************** -->
                                <div class="form-group input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-asterisk"></i></span>
                                    <select class="form-control" name="falla" data-toggle="tooltip" data-placement="right" title="Falla">
                                        <option value="seleccione">Seleccione</option>
                                        <option value="CIGUEÑAL">Cigueñal</option>
                                        <option value="TRANSMISION">Transmisión</option>
                                        <option value="MOTOR">Motor</option>
                                        <option value="EMBRAGUE">Embrague</option>
                                        <option value="ALTERNADOR">Alternador</option>
                                    </select>
                                </div>
                                <!-- ****************************** -->
                                <div class="form-group input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-wrench"></i></span>
                                    <select class="form-control" name="tipo_mantenimiento" data-toggle="tooltip" data-placement="right" title="Tipo Mantenimiento">
                                        <option value="seleccione">Seleccione</option>
                                        <option value="PREDICTIVO">Predictivo</option>
                                        <option value="PREVENTIVO">Preventivo</option>
                                        <option value="CORRECTIVO">Correctivo</option>
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
            <div id="editarMantenimiento" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h3 class="modal-title">Editar Mantenimiento</h3>
                        </div>
                        <div class="modal-body">
                            <!-- Formulario -->
                            <form id="editar-mantenimiento">
                               <div class="form-group input-group">
                                    <input id="id_mantenimiento" name="id_mantenimiento" type="hidden">
                                    
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                    <select class="form-control" name="status" data-toggle="tooltip" data-placement="right" title="status" required>
                                        <option value="seleccione">Seleccione</option>
                                        <option value="ACTIVO">Activo</option>
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