// Login
$("#login").submit(function(e) {
    e.preventDefault();

    $.ajax({
        type: 'post',
        url: '/transmivyca/controllers/login.php',
        data: $(this).serialize(),
        success: function(data) {
            $("#respuesta").slideDown();
            $("#respuesta").html(data);
        }
    });
    return false;
});


// Registro usuario sistema
$("#registro-usuario").submit(function(e) {
    e.preventDefault();

    $.ajax({
        type: 'post',
        url: '/transmivyca/controllers/registro-usuario.php',
        data: $(this).serialize(),
        success: function(data) {
            $("#respuesta").slideDown();
            $("#respuesta").html(data);
        }
    });
    return false;
});


// Buscador cliente
$('#buscadorCliente').keyup(function(e) {
    var consulta = $('#buscadorCliente').val();
    
    if (consulta.length > 0) {
        
        $.ajax({
            type: 'post',
            url: '/transmivyca/controllers/buscador-cliente.php',
            data: 'consulta='+consulta,
            dataType: 'html',
            success: function(data) {
                $('#listado').hide();
                $('#resultado').show();
                $('#resultado').html(data);
            }
        });
    
    } else if (consulta.length == 0) {
        $('#resultado').hide();
        $('#listado').show();
    }
});


// Nuevo cliente
$("#nuevo-cliente").submit(function(e) {
    e.preventDefault();

    $.ajax({
        type: 'post',
        url: '/transmivyca/controllers/registro-cliente.php',
        data: $(this).serialize(),
        success: function(data) {
            $("#respuesta").slideDown();
            $("#respuesta").html(data);
        }
    });
    return false;
});


// Obtener cliente
function obtenerCliente(id) {
    var obj = {
        id: id
    };
    
    $.ajax({
        url: '/transmivyca/controllers/obtener-cliente.php',
        data: obj,
        type: 'post',
        dataType: 'json',
        
        // Escribe los datos obtenidos en los campos correspondientes
        success: function (response) {
            $("#id_cliente").val(response.id_cliente);
            $("#rif").val(response.rif);
            $("#razon_social").val(response.razon_social);
            $("#direccion").val(response.direccion);
            $("#telefono").val(response.telefono);
            $("#responsable").val(response.responsable);
            // Lanza la ventana modal
            $('#editarCliente').modal('show');
        }
    });
}


// Editar cliente
$("#editar-cliente").submit(function(e) {
    e.preventDefault();

    $.ajax({
        type: 'post',
        url: '/transmivyca/controllers/editar-cliente.php',
        data: $(this).serialize(),
        success: function(data) {
            $("#respuesta").slideDown();
            $("#respuesta").html(data);
        }
    });
    return false;
});


// Eliminar cliente
function eliminarCliente(id) {    
    swal({
      title: '¿Eliminar Cliente?',
      text: 'Cliente seleccionado será eliminado',
      type: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Aceptar',
      closeOnConfirm: false
    },
    function() {
        $.post('/transmivyca/controllers/eliminar-cliente.php', {
            id: id
        });
        swal({
            title: 'Eliminado!',
            text: 'Cliente eliminado satisfactoriamente',
            type: 'success',
            showCancelButton: false,
            confirmButtonText: 'OK',
            closeOnConfirm: false
            },
            function() {
                location.href = '/transmivyca/views/clientes.php';
            });
    });    
}


// Buscador chofer
$('#buscadorChofer').keyup(function(e) {
    var consulta = $('#buscadorChofer').val();
    
    if (consulta.length > 0) {
        
        $.ajax({
            type: 'post',
            url: '/transmivyca/controllers/buscador-chofer.php',
            data: 'consulta='+consulta,
            dataType: 'html',
            success: function(data) {
                $('#listado').hide();
                $('#resultado').show();
                $('#resultado').html(data);
            }
        });
    
    } else if (consulta.length == 0) {
        $('#resultado').hide();
        $('#listado').show();
    }
});


// Registro chofer
$("#nuevo-chofer").submit(function(e) {
    e.preventDefault();

    $.ajax({
        type: 'post',
        url: '/transmivyca/controllers/registro-chofer.php',
        data: $(this).serialize(),
        success: function(data) {
            $("#respuesta").slideDown();
            $("#respuesta").html(data);
        }
    });
    return false;
});


// Obtener chofer
function obtenerChofer(id) {
    var obj = {
        id: id
    }
    
    $.ajax({
        url: '/transmivyca/controllers/obtener-chofer.php',
        data: obj,
        type: 'post',
        dataType: 'json',
        
        // Escribe los datos obtenidos en los campos correspondientes
        success: function (response) {
            $("#id_chofer").val(response.id_chofer);
            $("#cedula").val(response.cedula);
            $("#nombre").val(response.nombre);
            $("#apellido").val(response.apellido);
            $("#direccion").val(response.direccion);
            $("#telefono").val(response.telefono);
            $("#fv_licencia").val(response.fv_licencia);
            $("#fv_certificado").val(response.fv_certificado);
            // Lanza la ventana modal
            $('#editarChofer').modal('show');
        }
    });
}


// Editar chofer
$("#editar-chofer").submit(function(e) {
    e.preventDefault();

    $.ajax({
        type: 'post',
        url: '/transmivyca/controllers/editar-chofer.php',
        data: $(this).serialize(),
        success: function(data) {
            $("#respuesta").slideDown();
            $("#respuesta").html(data);
        }
    });
    return false;
});


// Eliminar chofer
function eliminarChofer(id) {    
    swal({
      title: '¿Eliminar Chofer?',
      text: 'Chofer seleccionado será eliminado',
      type: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Aceptar',
      closeOnConfirm: false
    },
    function() {
        $.post('/transmivyca/controllers/eliminar-chofer.php', {
            id: id
        });
        swal({
            title: 'Eliminado!',
            text: 'Chofer eliminado satisfactoriamente',
            type: 'success',
            showCancelButton: false,
            confirmButtonText: 'OK',
            closeOnConfirm: false
            },
            function() {
                location.href = '/transmivyca/views/chofer.php';
            });
    });    
}


// Buscador chuto
$('#buscadorChuto').keyup(function(e) {
    var consulta = $('#buscadorChuto').val();
    
    if (consulta.length > 0) {
        
        $.ajax({
            type: 'post',
            url: '/transmivyca/controllers/buscador-chuto.php',
            data: 'consulta='+consulta,
            dataType: 'html',
            success: function(data) {
                $('#listado').hide();
                $('#resultado').show();
                $('#resultado').html(data);
            }
        });
    
    } else if (consulta.length == 0) {
        $('#resultado').hide();
        $('#listado').show();
    }
});


// Registro chuto
$("#nuevo-chuto").submit(function(e) {
    e.preventDefault();

    $.ajax({
        type: 'post',
        url: '/transmivyca/controllers/registro-chuto.php',
        data: $(this).serialize(),
        success: function(data) {
            $("#respuesta").slideDown();
            $("#respuesta").html(data);
        }
    });
    return false;
});


// Obtener chuto
function obtenerChuto(id) {
    var obj = {
        id: id
    }
    
    $.ajax({
        url: '/transmivyca/controllers/obtener-chuto.php',
        data: obj,
        type: 'post',
        dataType: 'json',
        
        // Escribe los datos obtenidos en los campos correspondientes
        success: function (response) {
            $("#id_chuto").val(response.id_chuto);
            $("#matricula_chuto").val(response.matricula_chuto);
            $("#serial_motor").val(response.serial_motor);
            $("#serial_carroceria").val(response.serial_carroceria);
            // Lanza la ventana modal
            $('#editarChuto').modal('show');
        }
    });
}


// Editar chuto
$("#editar-chuto").submit(function(e) {
    e.preventDefault();

    $.ajax({
        type: 'post',
        url: '/transmivyca/controllers/editar-chuto.php',
        data: $(this).serialize(),
        success: function(data) {
            $("#respuesta").slideDown();
            $("#respuesta").html(data);
        }
    });
    return false;
});


// Eliminar chuto
function eliminarChuto(id) {    
    swal({
      title: '¿Eliminar Chuto?',
      text: 'Chuto seleccionado será eliminado',
      type: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Aceptar',
      closeOnConfirm: false
    },
    function() {
        $.post('/transmivyca/controllers/eliminar-chuto.php', {
            id: id
        });
        swal({
            title: 'Eliminado!',
            text: 'Chuto eliminado satisfactoriamente',
            type: 'success',
            showCancelButton: false,
            confirmButtonText: 'OK',
            closeOnConfirm: false
            },
            function() {
                location.href = '/transmivyca/views/chutos.php';
            });
    });    
}


// Buscador destino
$('#buscadorDestino').keyup(function(e) {
    var consulta = $('#buscadorDestino').val();
    
    if (consulta.length > 0) {
        
        $.ajax({
            type: 'post',
            url: '/transmivyca/controllers/buscador-destino.php',
            data: 'consulta='+consulta,
            dataType: 'html',
            success: function(data) {
                $('#listado').hide();
                $('#resultado').show();
                $('#resultado').html(data);
            }
        });
    
    } else if (consulta.length == 0) {
        $('#resultado').hide();
        $('#listado').show();
    }
});


// Registro destino
$("#nuevo-destino").submit(function(e) {
    e.preventDefault();

    $.ajax({
        type: 'post',
        url: '/transmivyca/controllers/registro-destino.php',
        data: $(this).serialize(),
        success: function(data) {
            $("#respuesta").slideDown();
            $("#respuesta").html(data);
        }
    });
    return false;
});


// Obtener destino
function obtenerDestino(id) {
    var obj = {
        id: id
    }
    
    $.ajax({
        url: '/transmivyca/controllers/obtener-destino.php',
        data: obj,
        type: 'post',
        dataType: 'json',
        
        // Escribe los datos obtenidos en los campos correspondientes
        success: function (response) {
            $("#id_destino").val(response.id_destino);
            $("#destino").val(response.destino);
            $("#distancia").val(response.distancia);
            $("#peaje").val(response.peaje);
            $("#comida").val(response.comida);
            $("#combustible").val(response.combustible);
            $("#otros").val(response.otros);
            // Lanza la ventana modal
            $('#editarDestino').modal('show');
        }
    });
}


// Editar destino
$("#editar-destino").submit(function(e) {
    e.preventDefault();

    $.ajax({
        type: 'post',
        url: '/transmivyca/controllers/editar-destino.php',
        data: $(this).serialize(),
        success: function(data) {
            $("#respuesta").slideDown();
            $("#respuesta").html(data);
        }
    });
    return false;
});


// Eliminar destino
function eliminarDestino(id) {    
    swal({
      title: '¿Eliminar Destino?',
      text: 'Destino seleccionado será eliminado',
      type: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Aceptar',
      closeOnConfirm: false
    },
    function() {
        $.post('/transmivyca/controllers/eliminar-destino.php', {
            id: id
        });
        swal({
            title: 'Eliminado!',
            text: 'Destino eliminado satisfactoriamente',
            type: 'success',
            showCancelButton: false,
            confirmButtonText: 'OK',
            closeOnConfirm: false
            },
            function() {
                location.href = '/transmivyca/views/destinos.php';
            });
    });    
}


// Buscador batea
$('#buscadorBatea').keyup(function(e) {
    var consulta = $('#buscadorBatea').val();
    
    if (consulta.length > 0) {
        
        $.ajax({
            type: 'post',
            url: '/transmivyca/controllers/buscador-batea.php',
            data: 'consulta='+consulta,
            dataType: 'html',
            success: function(data) {
                $('#listado').hide();
                $('#resultado').show();
                $('#resultado').html(data);
            }
        });
    
    } else if (consulta.length == 0) {
        $('#resultado').hide();
        $('#listado').show();
    }
});


// Registro batea
$("#nueva-batea").submit(function(e) {
    e.preventDefault();

    $.ajax({
        type: 'post',
        url: '/transmivyca/controllers/registro-batea.php',
        data: $(this).serialize(),
        success: function(data) {
            $("#respuesta").slideDown();
            $("#respuesta").html(data);
        }
    });
    return false;
});


// Obtener batea
function obtenerBatea(id) {
    var obj = {
        id: id
    }
    
    $.ajax({
        url: '/transmivyca/controllers/obtener-batea.php',
        data: obj,
        type: 'post',
        dataType: 'json',
        
        // Escribe los datos obtenidos en los campos correspondientes
        success: function (response) {
            $("#id_batea").val(response.id_batea);
            $("#matricula").val(response.matricula_batea);
            $("#serial").val(response.serial);
            // Lanza la ventana modal
            $('#editarBatea').modal('show');
        }
    });
}


// Editar batea
$("#editar-batea").submit(function(e) {
    e.preventDefault();

    $.ajax({
        type: 'post',
        url: '/transmivyca/controllers/editar-batea.php',
        data: $(this).serialize(),
        success: function(data) {
            $("#respuesta").slideDown();
            $("#respuesta").html(data);
        }
    });
    return false;
});


// Eliminar batea
function eliminarBatea(id) {    
    swal({
      title: '¿Eliminar Batea?',
      text: 'Batea seleccionada será eliminada',
      type: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Aceptar',
      closeOnConfirm: false
    },
    function() {
        $.post('/transmivyca/controllers/eliminar-batea.php', {
            id: id
        });
        swal({
            title: 'Eliminado!',
            text: 'Batea eliminada satisfactoriamente',
            type: 'success',
            showCancelButton: false,
            confirmButtonText: 'OK',
            closeOnConfirm: false
            },
            function() {
                location.href = '/transmivyca/views/bateas.php';
            });
    });    
}


// Crear asignacion de chuto
$("#nueva-asignacion").submit(function(e) {
    e.preventDefault();

    $.ajax({
        type: 'post',
        url: '/transmivyca/controllers/registro-asignar-chuto.php',
        data: $(this).serialize(),
        success: function(data) {
            $("#respuesta").slideDown();
            $("#respuesta").html(data);
        }
    });
    return false;
});


// Buscador asignacion chuto
$('#buscadorAsignacion').keyup(function(e) {
    var consulta = $('#buscadorAsignacion').val();
    
    if (consulta.length > 0) {
        
        $.ajax({
            type: 'post',
            url: '/transmivyca/controllers/buscador-asignacion.php',
            data: 'consulta='+consulta,
            dataType: 'html',
            success: function(data) {
                $('#listado').hide();
                $('#resultado').show();
                $('#resultado').html(data);
            }
        });
    
    } else if (consulta.length == 0) {
        $('#resultado').hide();
        $('#listado').show();
    }
});


// Eliminar asignacion chuto
function eliminarAsignacion(id) {    
    swal({
      title: '¿Eliminar Asignación?',
      text: 'Asignación seleccionada será eliminada',
      type: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Aceptar',
      closeOnConfirm: false
    },
    function() {
        $.post('/transmivyca/controllers/eliminar-asignacion.php', {
            id: id
        });
        swal({
            title: 'Eliminado!',
            text: 'Asignación eliminada satisfactoriamente',
            type: 'success',
            showCancelButton: false,
            confirmButtonText: 'OK',
            closeOnConfirm: false
            },
            function() {
                location.href = '/transmivyca/views/asignar-chuto.php';
            });
    });    
}


// Crear asignacion de viaje
$("#nuevo-viaje").submit(function(e) {
    e.preventDefault();

    $.ajax({
        type: 'post',
        url: '/transmivyca/controllers/registro-asignar-viaje.php',
        data: $(this).serialize(),
        success: function(data) {
            $("#respuesta").slideDown();
            $("#respuesta").html(data);
        }
    });
    return false;
});


// Obtener viaje
function obtenerViaje(id) {
    var obj = {
        id: id
    };
    
    $.ajax({
        url: '/transmivyca/controllers/obtener-viaje.php',
        data: obj,
        type: 'post',
        dataType: 'json',
        
        // Escribe los datos obtenidos en los campos correspondientes
        success: function (response) {
            $("#id_viaje").val(response.id_viaje);
            // Lanza la ventana modal
            $('#editarViaje').modal('show');
        }
    });
}


// Buscador viaje
$('#buscadorViaje').keyup(function(e) {
    var consulta = $('#buscadorViaje').val();
    
    if (consulta.length > 0) {
        
        $.ajax({
            type: 'post',
            url: '/transmivyca/controllers/buscador-viaje.php',
            data: 'consulta='+consulta,
            dataType: 'html',
            success: function(data) {
                $('#listado').hide();
                $('#resultado').show();
                $('#resultado').html(data);
            }
        });
    
    } else if (consulta.length == 0) {
        $('#resultado').hide();
        $('#listado').show();
    }
});


// Editar viaje
$("#editar-viaje").submit(function(e) {
    e.preventDefault();

    $.ajax({
        type: 'post',
        url: '/transmivyca/controllers/editar-viaje.php',
        data: $(this).serialize(),
        success: function(data) {
            $("#respuesta").slideDown();
            $("#respuesta").html(data);
        }
    });
    return false;
});


// Eliminar viaje
function eliminarViaje(id) {    
    swal({
      title: '¿Eliminar Viaje?',
      text: 'Viaje seleccionado será eliminado',
      type: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Aceptar',
      closeOnConfirm: false
    },
    function() {
        $.post('/transmivyca/controllers/eliminar-viaje.php', {
            id: id
        });
        swal({
            title: 'Eliminado!',
            text: 'Viaje eliminado satisfactoriamente',
            type: 'success',
            showCancelButton: false,
            confirmButtonText: 'OK',
            closeOnConfirm: false
            },
            function() {
                location.href = '/transmivyca/views/asignar-viaje.php';
            });
    });    
}


// Crear mantenimiento
$("#nuevo-mantenimiento").submit(function(e) {
    e.preventDefault();

    $.ajax({
        type: 'post',
        url: '/transmivyca/controllers/registro-mantenimiento.php',
        data: $(this).serialize(),
        success: function(data) {
            $("#respuesta").slideDown();
            $("#respuesta").html(data);
        }
    });
    return false;
});


// Buscador mantenimiento
$('#buscadorMantenimiento').keyup(function(e) {
    var consulta = $('#buscadorMantenimiento').val();
    
    if (consulta.length > 0) { 
        
        $.ajax({
            type: 'post',
            url: '/transmivyca/controllers/buscador-mantenimiento.php',
            data: 'consulta='+consulta,
            dataType: 'html',
            success: function(data) {
                $('#listado').hide();
                $('#resultado').show();
                $('#resultado').html(data);
            }
        });
    
    } else if (consulta.length == 0) {
        $('#resultado').hide();
        $('#listado').show();
    }
});


// Obtener mantenimiento
function obtenerMantenimiento(id) {
    var obj = {
        id: id
    };
    
    $.ajax({
        url: '/transmivyca/controllers/obtener-mantenimiento.php',
        data: obj,
        type: 'post',
        dataType: 'json',
        
        // Escribe los datos obtenidos en los campos correspondientes
        success: function (response) {
            $("#id_mantenimiento").val(response.id_mantenimiento);
            // Lanza la ventana modal
            $('#editarMantenimiento').modal('show');
        }
    });
}


// Editar mantenimiento
$("#editar-mantenimiento").submit(function(e) {
    e.preventDefault();

    $.ajax({
        type: 'post',
        url: '/transmivyca/controllers/editar-mantenimiento.php',
        data: $(this).serialize(),
        success: function(data) {
            $("#respuesta").slideDown();
            $("#respuesta").html(data);
        }
    });
    return false;
});


// Eliminar mantenimiento
function eliminarMantenimiento(id) {    
    swal({
      title: '¿Eliminar Mantenimiento?',
      text: 'Mantenimiento seleccionado será eliminado',
      type: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Aceptar',
      closeOnConfirm: false
    },
    function() {
        $.post('/transmivyca/controllers/eliminar-mantenimiento.php', {
            id: id
        });
        swal({
            title: 'Eliminado!',
            text: 'Mantenimiento eliminado satisfactoriamente',
            type: 'success',
            showCancelButton: false,
            confirmButtonText: 'OK',
            closeOnConfirm: false
            },
            function() {
                location.href = '/transmivyca/views/mantenimiento-chuto.php';
            });
    });    
}


// Buscador por fecha asignar viaje
$('#desde').on('change', function() {
    var desde = $('#desde').val();
    var hasta = $('#hasta').val();    
    
    $.ajax({
        type: 'post',
        url: '/transmivyca/controllers/buscar-viaje-fecha.php',
        data: 'desde='+desde+'&hasta='+hasta,
        dataType: 'html',
        success: function(data) {
            $('#listado').hide();
            $('#resultado').show();
            $('#resultado').html(data);
        }
    });
	return false;
});

	
$('#hasta').on('change', function() {
    var desde = $('#desde').val();
    var hasta = $('#hasta').val();
	
    $.ajax({
        type: 'post',
        url: '/transmivyca/controllers/buscar-viaje-fecha.php',
        data: 'desde='+desde+'&hasta='+hasta,
        dataType: 'html',
        success: function(data) {
            $('#listado').hide();
            $('#resultado').show();
            $('#resultado').html(data);
        }
    });
	return false;
});