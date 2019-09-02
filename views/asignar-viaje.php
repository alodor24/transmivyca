<?php

include 'session.php';
require_once '../models/class.chofer.php';
require_once '../models/class.destino.php';
require_once '../models/class.cliente.php';
require_once '../models/class.asignar-viaje.php';

$chofer = new Chofer();
$destino = new Destino();
$cliente = new Cliente();
$listar = new AsignarViaje();

?>
<!Doctype html>
<html lang="es">
    <?php include '../assets/head.php'; ?>
    
    <body>
        <!-- Navbar -->
        <?php include 'navbar.php'; ?>
        <!-- /Navbar -->
        
        <!-- Encabezado -->
        <h1 class="titulo text-center">Asignación de Viaje</h1>
        <!-- /Encabezado -->
        
        <div class="container">
            <div class="text-right">
                <!-- Buscador -->
                <input id="desde" class="buscador" type="date" data-toggle="tooltip" data-placement="bottom" title="Desde">
                <input id="hasta" class="buscador" type="date" data-toggle="tooltip" data-placement="bottom" title="Hasta" max="<?php $hoy = date('Y-m-d'); echo $hoy; ?>">
                
                <input id="buscadorViaje" class="buscador" type="text" placeholder="Buscador" onKeyUp="this.value=this.value.toUpperCase()" onpaste="return false" autocomplete="off">
                <!-- /Buscador -->
                
                <!-- Nuevo -->
                <a class="btn btn-success btn-lg" data-toggle="modal" data-target="#nuevo"><span class="glyphicon glyphicon-new-window"></span> Nuevo</a>
                <!-- /Nuevo -->
                
                <!-- Reporte -->
                <a id="reporte" class="btn btn-primary btn-lg" onclick="reporteViaje()"><span class="glyphicon glyphicon-print"></span> Generar Reporte</a>
                <!-- /Reporte -->
            </div>
            
            <!-- Tabla asignar -->
            <div id="resultado" class="table-responsive" style="display: none"></div>
            
            <div id="listado" class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Número Guía</th>
                            <th>Chofer</th>
                            <th>Cédula</th>
                            <th>Origen</th>
                            <th>Destino</th>
                            <th>Cliente</th>
                            <th>Fecha</th>
                            <th>Salida</th>
                            <th>Llegada</th>
                            <th>Status</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        <?php                        
                        $row = $listar->Listar();
                        foreach ($row as $campo) { ?>
                        <tr>
                            <td><?php echo $campo['id_viaje']; ?></td>
                            <td><?php echo $campo['numero_guia']; ?></td>
                            <td><?php echo $campo['nombre'] ." ". $campo['apellido']; ?></td>
                            <td><?php echo $campo['cedula']; ?></td>
                            <td><?php echo $campo['origen']; ?></td>
                            <td><?php echo $campo['destino']; ?></td>
                            <td><?php echo $campo['razon_social']; ?></td>
                            <td><?php echo $campo['fecha']; ?></td>
                            <td><?php echo $campo['salida']; ?></td>
                            <td><?php echo $campo['llegada']; ?></td>
                            <td><?php echo $campo['status']; ?></td>
                            <td>
                                <?php 
                                if ($_SESSION['privilegio'] == "administrador") { ?>
                                
                                <a class="btn btn-primary" data-toggle="tooltip" data-placement="bottom" title="Editar" onclick="obtenerViaje(<?php echo $campo['id_viaje']; ?>)">
                                    <span class="glyphicon glyphicon-edit"></span>
                                </a>
                                
                                <a class="btn btn-danger" data-toggle="tooltip" data-placement="bottom" title="Eliminar" onclick="eliminarViaje(<?php echo $campo['id_viaje']; ?>)">
                                    <span class="glyphicon glyphicon-trash"></span>
                                </a>
                                
                                <?php
                                } else { ?>
                                
                                <a class="btn btn-primary" data-toggle="tooltip" data-placement="bottom" title="Editar" onclick="obtenerViaje(<?php echo $campo['id_viaje']; ?>)">
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
            <!-- /Tabla asignar -->
            
            <!-- Modal nuevo -->
            <div id="nuevo" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h3 class="modal-title">Nuevo Viaje</h3>
                        </div>
                        <div class="modal-body">
                            <!-- Formulario -->
                            <form id="nuevo-viaje">
                                <div class="form-group input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                    <select class="form-control" name="chofer" data-toggle="tooltip" data-placement="right" title="Chofer">
                                        <option value="seleccione">Seleccione</option>
                                        <?php
                                        $data = $chofer->ListarChoferViaje();
                                        foreach ($data as $valor) { ?>
                                            <option value="<?php echo $valor['id_chofer']; ?>"><?php echo $valor['nombre'] ." ". $valor['apellido'] ." ". $valor['cedula']; ?></option>
                                        <?php                        
                                        }                        
                                        ?>  
                                    </select>
                                </div>
                                <!-- ****************************** -->
                                <div class="form-group input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-road"></i></span>
                                    <select class="form-control" name="destino" data-toggle="tooltip" data-placement="right" title="Destino">
                                        <option value="seleccione">Seleccione</option>
                                        <?php
                                        $data = $destino->ListarDestino();
                                        foreach ($data as $valor) { ?>
                                            <option value="<?php echo $valor['id_destino']; ?>"><?php echo $valor['destino']; ?></option>
                                        <?php                        
                                        }                        
                                        ?>  
                                    </select>
                                </div>
                                <!-- ****************************** -->
                                <div class="form-group input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-briefcase"></i></span>
                                    <select class="form-control" name="cliente" data-toggle="tooltip" data-placement="right" title="Cliente">
                                        <option value="seleccione">Seleccione</option>
                                        <?php
                                        $data = $cliente->ListarCliente();
                                        foreach ($data as $valor) { ?>
                                            <option value="<?php echo $valor['id_cliente']; ?>"><?php echo $valor['razon_social']; ?></option>
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
            
            <!-- Modal editar -->
            <div id="editarViaje" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h3 class="modal-title">Editar Viaje</h3>
                        </div>
                        <div class="modal-body">
                            <!-- Formulario -->
                            <form id="editar-viaje">
                                <div class="form-group input-group">
                                    <input id="id_viaje" name="id_viaje" type="hidden">
                                    
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-th-list"></i></span>
                                    <select class="form-control" name="status" data-toggle="tooltip" data-placement="right" title="Status">
                                        <option value="seleccione">Seleccione</option>
                                        <option value="EN PROGRESO">En progreso</option>
                                        <option value="ENTREGADO">Entregado</option>
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