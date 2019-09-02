<?php 

include 'session.php'; 
require_once '../models/class.cliente.php';

$listar = new Cliente();

?>
<!Doctype html>
<html lang="es">
    <?php include '../assets/head.php'; ?>
    
    <body>
        <!-- Navbar -->
        <?php include 'navbar.php'; ?>
        <!-- /Navbar -->
        
        <!-- Encabezado -->
        <h1 class="titulo text-center">Clientes</h1>
        <!-- /Encabezado -->
        
        <div class="container">
            <div class="text-right">
                <!-- Buscador -->
                <input id="buscadorCliente" class="buscador" type="text" placeholder="Buscador" onKeyUp="this.value=this.value.toUpperCase()" onpaste="return false" autocomplete="off">
                <!-- /Buscador -->
                
                <!-- Nuevo -->
                <a class="btn btn-success btn-lg" data-toggle="modal" data-target="#nuevo"><span class="glyphicon glyphicon-new-window"></span> Nuevo</a>
                <!-- /Nuevo -->
                
                <!-- Reporte -->
                <a id="reporte" class="btn btn-primary btn-lg" onclick="reporteCliente()"><span class="glyphicon glyphicon-print"></span> Generar Reporte</a>
                <!-- /Reporte -->
            </div>            
            
            <!-- Tabla clientes -->
            <div id="resultado" class="table-responsive" style="display: none"></div>
            
            <div id="listado" class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Rif</th>
                            <th>Razón Social</th>
                            <th>Dirección</th>
                            <th>Teléfono</th>
                            <th>Responsable</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    
                    <tbody class="text-center">
                        <?php                        
                        $data = $listar->Listar();
                        foreach ($data as $valor) { ?>
                        <tr>
                            <td><?php echo $valor['id_cliente']; ?></td>
                            <td><?php echo $valor['rif']; ?></td>
                            <td><?php echo $valor['razon_social']; ?></td>
                            <td><?php echo $valor['direccion']; ?></td>
                            <td><?php echo $valor['telefono']; ?></td>
                            <td><?php echo $valor['responsable']; ?></td>
                            <td>
                                <?php 
                                if ($_SESSION['privilegio'] == "administrador") { ?>
                                
                                <a class="btn btn-primary" data-toggle="tooltip" data-placement="bottom" title="Editar" onclick="obtenerCliente(<?php echo $valor['id_cliente']; ?>)">
                                    <span class="glyphicon glyphicon-edit"></span>
                                </a>
                                
                                <a class="btn btn-danger" data-toggle="tooltip" data-placement="bottom" title="Eliminar" onclick="eliminarCliente(<?php echo $valor['id_cliente']; ?>)">
                                    <span class="glyphicon glyphicon-trash"></span>
                                </a>
                                
                                <?php
                                } else { ?>
                                
                                <a class="btn btn-primary" data-toggle="tooltip" data-placement="bottom" title="Editar" onclick="obtenerCliente(<?php echo $valor['id_cliente']; ?>)">
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
                            <h3 class="modal-title">Nuevo Cliente</h3>
                        </div>
                        <div class="modal-body">
                            <!-- Formulario -->
                            <form id="nuevo-cliente">
                                <div class="form-group input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-asterisk"></i></span>
                                    <input type="text" class="form-control" name="rif" placeholder="Rif: J-404271864" maxlength="11" onKeyUp="this.value=this.value.toUpperCase()" onpaste="return false" autocomplete="off" required>
                                </div>
                                <!-- ****************************** -->
                                <div class="form-group input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
                                    <input type="text" class="form-control" name="razon_social" placeholder="Razón Social" onKeyUp="this.value=this.value.toUpperCase()" onpaste="return false" autocomplete="off" required>
                                </div>
                                <!-- ****************************** -->
                                <div class="form-group input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-map-marker"></i></span>
                                    <input type="text" class="form-control" name="direccion" placeholder="Dirección" onKeyUp="this.value=this.value.toUpperCase()" onpaste="return false" autocomplete="off" required>
                                </div>
                                <!-- ****************************** -->
                                <div class="form-group input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
                                    <input type="text" class="form-control" name="telefono" placeholder="Teléfono" maxlength="11" onkeypress="return onlyNumber(event)" onpaste="return false" autocomplete="off" required>
                                </div>
                                <!-- ****************************** -->
                                <div class="form-group input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                    <input type="text" class="form-control" name="responsable" placeholder="Responsable" onKeyUp="this.value=this.value.toUpperCase()" onkeypress="return onlyText(event)" onpaste="return false" autocomplete="off" required>
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
            <div id="editarCliente" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h3 class="modal-title">Editar Cliente</h3>
                        </div>
                        <div class="modal-body">
                            <!-- Formulario -->
                            <form id="editar-cliente">
                                <div class="form-group input-group">
                                    <input id="id_cliente" name="id_cliente" type="hidden">
                                    
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-asterisk"></i></span>
                                    <input id="rif" type="text" class="form-control" name="rif" maxlength="11" placeholder="Rif: J-404271864" onKeyUp="this.value=this.value.toUpperCase()" onpaste="return false" autocomplete="off" required>
                                </div>
                                <!-- ****************************** -->
                                <div class="form-group input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
                                    <input id="razon_social" type="text" class="form-control" name="razon_social" placeholder="Razón Social" onKeyUp="this.value=this.value.toUpperCase()" onpaste="return false" autocomplete="off" required>
                                </div>
                                <!-- ****************************** -->
                                <div class="form-group input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-map-marker"></i></span>
                                    <input id="direccion" type="text" class="form-control" name="direccion" placeholder="Dirección" onKeyUp="this.value=this.value.toUpperCase()" onpaste="return false" autocomplete="off" required>
                                </div>
                                <!-- ****************************** -->
                                <div class="form-group input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
                                    <input id="telefono" type="text" class="form-control" name="telefono" placeholder="Teléfono" maxlength="11" onkeypress="return onlyNumber(event)" onpaste="return false" autocomplete="off" required>
                                </div>
                                <!-- ****************************** -->
                                <div class="form-group input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                    <input id="responsable" type="text" class="form-control" name="responsable" placeholder="Responsable" onKeyUp="this.value=this.value.toUpperCase()" onkeypress="return onlyText(event)" onpaste="return false" autocomplete="off" required>
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
        
        <?php include "../assets/footer.php"; ?>
    </body>
</html>