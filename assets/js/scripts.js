$(document).ready(function() {
    // Tooltip
    $('[data-toggle="tooltip"]').tooltip();    
});


// Reporte cliente
function reporteCliente() {
    var obj = document.getElementById('reporte');
    var url = '/transmivyca/views/reporte-cliente.php';

    obj.target = '_blank';        
    obj.href = url; 
}


// Reporte chofer
function reporteChofer() {
    var obj = document.getElementById('reporte');
    var url = '/transmivyca/views/reporte-chofer.php';

    obj.target = '_blank';        
    obj.href = url; 
}


// Reporte asignacion de chuto
function reporteAsignacion() {
    var obj = document.getElementById('reporte');
    var url = '/transmivyca/views/reporte-asignacion.php';

    obj.target = '_blank';        
    obj.href = url; 
}


// Reporte chuto
function reporteChuto() {
    var obj = document.getElementById('reporte');
    var url = '/transmivyca/views/reporte-chuto.php';

    obj.target = '_blank';        
    obj.href = url; 
}


// Reporte batea
function reporteBatea() {
    var obj = document.getElementById('reporte');
    var url = '/transmivyca/views/reporte-batea.php';

    obj.target = '_blank';        
    obj.href = url; 
}


// Reporte destino
function reporteDestino() {
    var obj = document.getElementById('reporte');
    var url = '/transmivyca/views/reporte-destino.php';

    obj.target = '_blank';        
    obj.href = url; 
}


// Reporte mantenimiento
function reporteMantenimiento() {
    var obj = document.getElementById('reporte');
    var url = '/transmivyca/views/reporte-mantenimiento.php';

    obj.target = '_blank';        
    obj.href = url; 
}


// Reporte de viajes
function reporteViaje() {
    var obj = document.getElementById('reporte');
    var url = '/transmivyca/views/reporte-viaje.php';

    obj.target = '_blank';        
    obj.href = url; 
}


// Validar solo numero
function onlyNumber(e) {
    var key = window.Event ? e.which : e.keyCode;
    return (key >= 48 && key <= 57);
}


// Validar solo letras
function onlyText(e) {
    key = e.keyCode || e.which;
    tecla = String.fromCharCode(key).toLowerCase();
    letras = " áéíóúabcdefghijklmnñopqrstuvwxyz";
    especiales = "8-37-39-46";

    tecla_especial = false;

    for(var i in especiales) {
        if(key == especiales[i]) {
            tecla_especial = true;
            break;
        }
    }

    if (letras.indexOf(tecla) == -1 && !tecla_especial) {
        return false;
    }
}