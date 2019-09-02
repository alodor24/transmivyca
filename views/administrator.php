<?php 

include 'session.php';
require_once '../models/class.cliente.php';
require_once '../models/class.chofer.php';
require_once '../models/class.chuto.php';
require_once '../models/class.batea.php';
require_once '../models/class.destino.php';

$totalCliente = new Cliente();
$totalChofer = new Chofer();
$totalChuto = new Chuto();
$totalBatea = new Batea();
$totalDestino = new Destino();

?>
<!Doctype html>
<html lang="es">
    <?php include '../assets/head.php'; ?>
    
    <body>
        <!-- Navbar -->
        <?php include 'navbar.php'; ?>
        <!-- /Navbar -->
        
        <!-- Encabezado -->
        <h1 class="titulo text-center">Sistema Web de Logísta y Control</h1>
        <p class="text-center">Tablero Principal</p>
        <!-- /Encabezado -->
        
        <!-- Modulos -->
        <div class="container">
            <?php 
            if ($_SESSION['privilegio'] == "administrador") { ?>
            
            <div id="clientes" class="col-md-2 col-md-offset-1 panel panel-default">
                <a href="clientes.php">
                    <div class="panel-body">
                        <h2><?php echo $totalCliente->totalCliente(); ?></h2>
                        <h4>Clientes</h4>
                        <span class="glyphicon glyphicon-briefcase pull-right"></span>
                    </div>
                </a>
            </div>            
            <!-- ******************** -->
            <div id="choferes" class="col-md-2 panel panel-default">
                <a href="chofer.php">
                   <div class="panel-body">
                        <h2><?php echo $totalChofer->totalChofer(); ?></h2>
                        <h4>Choferes</h4>
                        <span class="glyphicon glyphicon-user pull-right"></span>
                    </div>
                </a>
            </div>
            <!-- ******************** -->
            <div id="chutos" class="col-md-2 panel panel-default">
                <a href="chutos.php">
                    <div class="panel-body">
                        <h2><?php echo $totalChuto->totalChuto(); ?></h2>
                        <h4>Chutos</h4>
                        <span class="glyphicon glyphicon-star pull-right"></span>
                    </div>
                </a>
            </div>
            <!-- ******************** -->
            <div id="bateas" class="col-md-2 panel panel-default">
                <a href="bateas.php">    
                    <div class="panel-body">
                        <h2><?php echo $totalBatea->totalBatea(); ?></h2>
                        <h4>Bateas</h4>
                        <span class="glyphicon glyphicon-asterisk pull-right"></span>
                    </div>
                </a>
            </div>
            <!-- ******************** -->
            <div id="destinos" class="col-md-2 panel panel-default">
                <a href="destinos.php">
                    <div class="panel-body">
                        <h2><?php echo $totalDestino->totalDestino(); ?></h2>
                        <h4>Destinos</h4>
                        <span class="glyphicon glyphicon-road pull-right"></span>
                    </div>
                </a>
            </div>
            
            <?php
            } else { ?>
            
            <div id="choferes" class="col-md-2 col-md-offset-3 panel panel-default">
                <a href="chofer.php">
                   <div class="panel-body">
                        <h2><?php echo $totalChofer->totalChofer(); ?></h2>
                        <h4>Choferes</h4>
                        <span class="glyphicon glyphicon-user pull-right"></span>
                    </div>
                </a>
            </div>
            <!-- ******************** -->
            <div id="chutos" class="col-md-2 panel panel-default">
                <a href="chutos.php">
                    <div class="panel-body">
                        <h2><?php echo $totalChuto->totalChuto(); ?></h2>
                        <h4>Chutos</h4>
                        <span class="glyphicon glyphicon-star pull-right"></span>
                    </div>
                </a>
            </div>
            <!-- ******************** -->
            <div id="bateas" class="col-md-2 panel panel-default">
                <a href="bateas.php">    
                    <div class="panel-body">
                        <h2><?php echo $totalBatea->totalBatea(); ?></h2>
                        <h4>Bateas</h4>
                        <span class="glyphicon glyphicon-asterisk pull-right"></span>
                    </div>
                </a>
            </div>
            
            <?php } ?>
        </div>
        <!-- /Modulos -->
        
        <?php include '../assets/footer.php'; ?>
    </body>
</html>