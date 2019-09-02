<?php 

include 'session.php'; 
require_once '../models/class.destino.php';

$listar = new Destino();

?>
<!Doctype html>
<html lang="es">
    <?php include '../assets/head.php'; ?>
    
    <body>
        <!-- Navbar -->
        <?php include 'navbar.php'; ?>
        <!-- /Navbar -->
        
        <!-- Encabezado -->
        <h1 class="titulo text-center">Destinos</h1>
        <!-- /Encabezado -->
        
        <div class="container">
            <div class="text-right">
                <!-- Buscador -->
                <input id="buscadorDestino" class="buscador" type="text" placeholder="Buscador" onKeyUp="this.value=this.value.toUpperCase()" onpaste="return false" autocomplete="off">
                <!-- /Buscador -->
              
                <!-- Nuevo -->
                <a class="btn btn-success btn-lg" data-toggle="modal" data-target="#nuevo"><span class="glyphicon glyphicon-new-window"></span> Nuevo</a>
                <!-- /Nuevo -->
                
                <!-- Reporte -->
                <a id="reporte" class="btn btn-primary btn-lg" onclick="reporteDestino()"><span class="glyphicon glyphicon-print"></span> Generar Reporte</a>
                <!-- /Reporte -->
            </div>
            
            <!-- Tabla destinos -->
            <div id="resultado" class="table-responsive" style="display: none"></div>
            
            <div id="listado" class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Origen</th>
                            <th>Destino</th>
                            <th>Distancia</th>
                            <th>Peaje</th>
                            <th>Comida</th>
                            <th>Combustible</th>
                            <th>Otros</th>
                            <th>Total</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        <?php                        
                        $data = $listar->Listar();
                        foreach ($data as $valor) { ?>
                        <tr>
                            <td><?php echo $valor['id_destino']; ?></td>
                            <td><?php echo $valor['origen']; ?></td>
                            <td><?php echo $valor['destino']; ?></td>
                            <td><?php echo $valor['distancia']; ?> Km</td>
                            <td><?php echo $valor['peaje']; ?> Bs.</td>
                            <td><?php echo $valor['comida']; ?> Bs.</td>
                            <td><?php echo $valor['combustible']; ?> Bs.</td>
                            <td><?php echo $valor['otros']; ?> Bs.</td>
                            <td><?php echo $valor['total']; ?> Bs.</td>
                            <td>
                                <?php 
                                if ($_SESSION['privilegio'] == "administrador") { ?>
                                
                                <a class="btn btn-primary" data-toggle="tooltip" data-placement="bottom" title="Editar" onclick="obtenerDestino(<?php echo $valor['id_destino']; ?>)">
                                    <span class="glyphicon glyphicon-edit"></span>
                                </a>
                                
                                <a class="btn btn-danger" data-toggle="tooltip" data-placement="bottom" title="Eliminar" onclick="eliminarDestino(<?php echo $valor['id_destino']; ?>)">
                                    <span class="glyphicon glyphicon-trash"></span>
                                </a>
                                
                                <?php
                                } else { ?>
                                
                                <a class="btn btn-primary" data-toggle="tooltip" data-placement="bottom" title="Editar" onclick="obtenerDestino(<?php echo $valor['id_destino']; ?>)">
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
            <!-- /Tabla destinos -->
            
            <!-- Modal nuevo -->
            <div id="nuevo" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h3 class="modal-title">Nuevo Destino</h3>
                        </div>
                        <div class="modal-body">
                            <!-- Formulario -->
                            <form id="nuevo-destino">
                                <div class="form-group input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-road"></i></span>
                                    <input type="text" class="form-control" name="destino" placeholder="Destino" onKeyUp="this.value=this.value.toUpperCase()" onkeypress="return onlyText(event)" onpaste="return false" autocomplete="off" required>
                                </div>
                                <!-- ****************************** -->
                                <div class="form-group input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-dashboard"></i></span>
                                    <input type="text" class="form-control" name="distancia" placeholder="Distancia" onkeypress="return onlyNumber(event)" onpaste="return false" autocomplete="off" required>
                                </div>
                                <!-- ****************************** -->
                                <div class="form-group input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-usd"></i></span>
                                    <input type="text" class="form-control" name="peaje" placeholder="Peaje" onkeypress="return onlyNumber(event)" onpaste="return false" autocomplete="off" required>
                                </div>
                                <!-- ****************************** -->
                                <div class="form-group input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-cutlery"></i></span>
                                    <input type="text" class="form-control" name="comida" placeholder="Comida" onkeypress="return onlyNumber(event)" onpaste="return false" autocomplete="off" required>
                                </div>
                                <!-- ****************************** -->
                                <div class="form-group input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-oil"></i></span>
                                    <input type="text" class="form-control" name="combustible" placeholder="Combustible" onkeypress="return onlyNumber(event)" onpaste="return false" autocomplete="off" required>
                                </div>
                                <!-- ****************************** -->
                                <div class="form-group input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-piggy-bank"></i></span>
                                    <input type="text" class="form-control" name="otros" placeholder="Otros" onkeypress="return onlyNumber(event)" onpaste="return false" autocomplete="off" required>
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
            <div id="editarDestino" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h3 class="modal-title">Editar Destino</h3>
                        </div>
                        <div class="modal-body">
                            <!-- Formulario -->
                            <form id="editar-destino">
                                <div class="form-group input-group">
                                    <input id="id_destino" name="id_destino" type="hidden">
                                    
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-road"></i></span>
                                    <input id="destino" type="text" class="form-control" name="destino" placeholder="Destino" onKeyUp="this.value=this.value.toUpperCase()" onkeypress="return onlyText(event)" onpaste="return false" autocomplete="off" required>
                                </div>
                                <!-- ****************************** -->
                                <div class="form-group input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-dashboard"></i></span>
                                    <input id="distancia" type="text" class="form-control" name="distancia" placeholder="Distancia" onkeypress="return onlyNumber(event)" onpaste="return false" autocomplete="off" required>
                                </div>
                                <!-- ****************************** -->                                
                                <div class="form-group input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-usd"></i></span>
                                    <input id="peaje" type="text" class="form-control" name="peaje" placeholder="Peaje" onkeypress="return onlyNumber(event)" onpaste="return false" autocomplete="off" required>
                                </div>
                                <!-- ****************************** -->
                                <div class="form-group input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-cutlery"></i></span>
                                    <input id="comida" type="text" class="form-control" name="comida" placeholder="Comida" onkeypress="return onlyNumber(event)" onpaste="return false" autocomplete="off" required>
                                </div>
                                <!-- ****************************** -->
                                <div class="form-group input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-oil"></i></span>
                                    <input id="combustible" type="text" class="form-control" name="combustible" placeholder="Combustible" onkeypress="return onlyNumber(event)" onpaste="return false" autocomplete="off" required>
                                </div>
                                <!-- ****************************** -->
                                <div class="form-group input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-piggy-bank"></i></span>
                                    <input id="otros" type="text" class="form-control" name="otros" placeholder="Otros" onkeypress="return onlyNumber(event)" onpaste="return false" autocomplete="off" required>
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