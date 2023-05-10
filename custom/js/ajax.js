let site_url = $('.site_url').val();

$('#verImagen').hide();
if ($('#verImagen').attr('src')) $('#verImagen').show();
$('[name=imagen]').change(function () {
    if (this.files && this.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#verImagen').show();
            $('#verImagen').attr('src', e.target.result);
        }
        reader.readAsDataURL(this.files[0]);
    } else $('#verImagen').hide();
});

limpiarFormulario();
function limpiarFormulario() {
    $('.text-danger').remove();
    $('.form-control').removeClass('is-invalid');
    $('.alert').removeClass('alert-info alert-warning alert-success alert-danger');
    $('.icon').removeClass('fa-info fa-exclamation-triangle fa-check fa-ban');
    $('.alert').hide();
}

function cargarTabla(controlador, datos, extra) {
    $(".tabla").DataTable().destroy();
    $(".tabla").DataTable({
        ajax: {
            url: site_url + controlador + '/listar',
            data: datos,
            method: "POST",
            dataType: 'json',
            cache: false,
        },
        "scrollX": true,
        //"responsive": true,
        "autoWidth": true,
        "processing": true,
        "language": {
            "sProcessing": "Procesando...",
            "sLengthMenu": "Mostrar _MENU_ registros",
            "sZeroRecords": "No se encontraron resultados",
            "sEmptyTable": "Ningún dato disponible en esta tabla",
            "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
            "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0",
            "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix": "",
            "sSearch": "Buscar:",
            "sUrl": "",
            "sInfoThousands": ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast": "Último",
                "sNext": "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
        },
        dom: 'Bflrtip',
        buttons: [{
            extend: 'print',
            text: '<i class="fa fa-print"></i> Imprimir',
            customize: function (win) {
                $(win.document.body).find('h1').css('text-align', 'center');
                if (extra) $(win.document.body).find('h1').append('<h6>' + extra + '</h6>');
            }
        }]
    });
}

function guardar(controlador, datos, redireccion) {
    $.ajax({
        url: site_url + controlador + '/validar',
        data: datos,
        method: 'POST',
        dataType: 'json',
        cache: false,
        contentType: false,
        processData: false,
        success: function (json) {
            limpiarFormulario();
            $('.alert').show();
            let mensaje;
            if (json.contador > 0) {
                mensaje = 'Por favor revise los datos marcados.';
                $('.alert').addClass('alert-warning');
                $('.icon').addClass('fa-exclamation-triangle');
                $('.titulo').html('Advertencia');
                $('.mensaje').html(mensaje);
                if ((json.campos) && (json.mensajes)) {
                    var camposs = json.campos.slice(0, -1).split(',');
                    var mensajess = json.mensajes.slice(0, -1).split(',');
                    for (var i = 0; i < camposs.length; i++) {
                        var elemento = $('[name=' + camposs[i] + ']');
                        $(elemento).addClass('is-invalid')
                        $(elemento).parent().append('<div class="text-danger">' + mensajess[i] + '</div>');
                    }
                }
            } else {
                $.ajax({
                    url: site_url + controlador + '/guardar',
                    data: datos,
                    method: 'POST',
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (respuesta) {
                        if (respuesta === 'success') {
                            mensaje = 'Datos guardados correctamente. Redireccionando...';
                            $('.alert').addClass('alert-success');
                            $('.icon').addClass('fa-check');
                            $('.titulo').html('Correcto');
                            $('.mensaje').html(mensaje);
                            setTimeout(function () {
                                location.href = redireccion;
                            }, 2000);
                        } else {
                            mensaje = 'Algo falló al guardar los datos.';
                            $('.alert').addClass('alert-danger');
                            $('.icon').addClass('fa-ban');
                            $('.titulo').html('Error');
                            $('.mensaje').html(mensaje);
                        }
                    }
                });
            }
        }
    });
}

function borrar(controlador, datos) {
    if (confirm('Desea borrar el registro?') == true) {
        $.ajax({
            url: site_url + controlador + '/borrar',
            data: datos,
            method: "POST",
            cache: false,
            contentType: false,
            processData: false,
            success: function (respuesta) {
                if (respuesta === "ok") {
                    $(".tabla").DataTable().ajax.reload();
                    alert('El registro ha sido borrado correctamente.');
                } else alert('Error al intentar borrar el registro.');
            }
        });
    }
}

$('.btnLogin').click(function () {
    let datos = new FormData($('.form')[0]);
    $.ajax({
        url: site_url + "/Usuario/conectar",
        method: "POST",
        data: datos,
        dataType: 'json',
        cache: false,
        contentType: false,
        processData: false,
        success: function (json) {
            limpiarFormulario();
            $('.mensaje').show();
            if (json.contador > 0) {
                let html =
                    '<div class="nk-info-box text-warning"><div class="nk-info-box-icon"><i class="ion-android-notifications-none"></i></div>';
                html += '<h3>Alerta!</h3>';
                html += '<em>Por favor revise los datos marcados.</em></div>';
                $('.mensaje').html(html);
                if ((json.campos) && (json.mensajes)) {
                    var camposs = json.campos.slice(0, -1).split(',');
                    var mensajess = json.mensajes.slice(0, -1).split(',');
                    for (var i = 0; i < camposs.length; i++) {
                        var elemento = $('[name=' + camposs[i] + ']');
                        $(elemento).addClass('is-invalid')
                        $(elemento).parent().before('<div class="text-danger">' + mensajess[
                                i] +
                            '</div>');
                    }
                }
            } else {
                location.reload();
            }
        }
    });
    return false;
});