<?php 

include 'session.php'; 
require_once '../models/class.chofer.php';

$listar = new Chofer();

?>
<!Doctype html>
<html lang="es">
    <?php include '../assets/head.php'; ?>
    
    <body>
        <!-- Navbar -->
        <?php include 'navbar.php'; ?>
        <!-- /Navbar -->
        
        <!-- Encabezado -->
        <h1 class="titulo text-center">Gestionar Choferes</h1>
        <!-- /Encabezado -->
        
        <div class="container">
            <div class="text-right">
               <!-- Buscador -->
                <input id="buscadorChofer" class="buscador" type="text" placeholder="Buscador" onKeyUp="this.value=this.value.toUpperCase()" onpaste="return false" autocomplete="off">
                <!-- /Buscador -->
              
               <!-- Nuevo -->
                <a class="btn btn-success btn-lg" data-toggle="modal" data-target="#nuevo"><span class="glyphicon glyphicon-new-window"></span> Nuevo</a>
                <!-- /Nuevo -->
                
                <!-- Reporte -->
                <a id="reporte" class="btn btn-primary btn-lg" onclick="reporteChofer()"><span class="glyphicon glyphicon-print"></span> Generar Reporte</a>
                <!-- /Reporte -->
            </div>
            
            <!-- Tabla chofer -->
            <div id="resultado" class="table-responsive" style="display: none"></div>
            
            <div id="listado" class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Cédula</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Dirección</th>
                            <th>Teléfono</th>
                            <th>F.V. Licencia</th>
                            <th>F.V. Certificado</th>
                            <th>Fecha Ingreso</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        <?php                        
                        $data = $listar->Listar();
                        foreach ($data as $valor) { ?>
                        <tr>
                            <td><?php echo $valor['id_chofer']; ?></td>
                            <td><?php echo $valor['cedula']; ?></td>
                            <td><?php echo $valor['nombre']; ?></td>
                            <td><?php echo $valor['apellido']; ?></td>
                            <td><?php echo $valor['direccion']; ?></td>
                            <td><?php echo $valor['telefono']; ?></td>
                            <td><?php echo $valor['fecha_vencimiento_licencia']; ?></td>
                            <td><?php echo $valor['fecha_vencimiento_certificado_medico']; ?></td>
                            <td><?php echo $valor['fecha_ingreso']; ?></td>
                            <td>
                                <?php 
                                if ($_SESSION['privilegio'] == "administrador") { ?>
                                
                                <a class="btn btn-primary" data-toggle="tooltip" data-placement="bottom" title="Editar" onclick="obtenerChofer(<?php echo $valor['id_chofer']; ?>)">
                                    <span class="glyphicon glyphicon-edit"></span>
                                </a>
                                
                                <a class="btn btn-danger" data-toggle="tooltip" data-placement="bottom" title="Eliminar" onclick="eliminarChofer(<?php echo $valor['id_chofer']; ?>)">
                                    <span class="glyphicon glyphicon-trash"></span>
                                </a>
                                
                                <?php
                                } else { ?>
                                
                                <a class="btn btn-primary" data-toggle="tooltip" data-placement="bottom" title="Editar" onclick="obtenerChofer(<?php echo $valor['id_chofer']; ?>)">
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
            <!-- /Tabla chofer -->
            
            <!-- Modal nuevo -->
            <div id="nuevo" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h3 class="modal-title">Nuevo Chofer</h3>
                        </div>
                        <div class="modal-body">
                            <!-- Formulario -->
                            <form id="nuevo-chofer">
                                <div class="form-group input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-asterisk"></i></span>
                                    <input type="text" class="form-control" name="cedula" placeholder="Cédula: 19316181" maxlength="8" onkeypress="return onlyNumber(event)" onpaste="return false" autocomplete="off" required>
                                </div>
                                <!-- ****************************** -->
                                <div class="form-group input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                    <input type="text" class="form-control" name="nombre" placeholder="Nombre" onKeyUp="this.value=this.value.toUpperCase()" onkeypress="return onlyText(event)" onpaste="return false" autocomplete="off" required>
                                </div>
                                <!-- ****************************** -->
                                <div class="form-group input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                    <input type="text" class="form-control" name="apellido" placeholder="Apellido" onKeyUp="this.value=this.value.toUpperCase()" onkeypress="return onlyText(event)" onpaste="return false" autocomplete="off" required>
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
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                    <input type="date" class="form-control" name="fv_licencia" data-toggle="tooltip" data-placement="right" title="Vencimiento Licencia" min="<?php $hoy = date('Y-m-d'); echo $hoy; ?>" required>
                                </div>
                                <!-- ****************************** -->
                                <div class="form-group input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                    <input type="date" class="form-control" name="fv_certificado" data-toggle="tooltip" data-placement="right" title="Vencimiento Certificado" min="<?php $hoy = date('Y-m-d'); echo $hoy; ?>" required>
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
            <div id="editarChofer" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h3 class="modal-title">Editar Chofer</h3>
                        </div>
                        <div class="modal-body">
                            <!-- Formulario -->
                            <form id="editar-chofer">
                                <div class="form-group input-group">
                                    <input id="id_chofer" name="id_chofer" type="hidden">
                                    
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-asterisk"></i></span>
                                    <input id="cedula" type="text" class="form-control" name="cedula" placeholder="Cédula: 19316181" maxlength="8" onkeypress="return onlyNumber(event)" onpaste="return false" autocomplete="off" required>
                                </div>
                                <!-- ****************************** -->
                                <div class="form-group input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                    <input id="nombre" type="text" class="form-control" name="nombre" placeholder="Nombre" onKeyUp="this.value=this.value.toUpperCase()" onkeypress="return onlyText(event)" onpaste="return false" autocomplete="off" required>
                                </div>
                                <!-- ****************************** -->
                                <div class="form-group input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                    <input id="apellido" type="text" class="form-control" name="apellido" placeholder="Apellido" onKeyUp="this.value=this.value.toUpperCase()" onkeypress="return onlyText(event)" onpaste="return false" autocomplete="off" required>
                                </div>
                                <!-- ****************************** -->
                                <div class="form-group input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-map-marker"></i></span>
                                    <input id="direccion" type="text" class="form-control" name="direccion" placeholder="Dirección" onKeyUp="this.value=this.value.toUpperCase()" onpaste="return false" autocomplete="off" required>
                                </div>
                                <!-- ****************************** -->
                                <div class="form-group input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
                                    <input id="telefono" type="text" class="form-control" name="telefono" placeholder="Teléfono" maxlength="11" onKeyUp="this.value=this.value.toUpperCase()" onkeypress="return onlyNumber(event)" onpaste="return false" autocomplete="off" required>
                                </div>
                                <!-- ****************************** -->
                                <div class="form-group input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                    <input id="fv_licencia" type="date" class="form-control" name="fv_licencia" data-toggle="tooltip" data-placement="right" title="Vencimiento Licencia" min="<?php $hoy = date('Y-m-d'); echo $hoy; ?>" required>
                                </div>
                                <!-- ****************************** -->
                                <div class="form-group input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                    <input id="fv_certificado" type="date" class="form-control" name="fv_certificado" data-toggle="tooltip" data-placement="right" title="Vencimiento Certificado" min="<?php $hoy = date('Y-m-d'); echo $hoy; ?>" required>
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