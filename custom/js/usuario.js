let controlador = '/usuario';
let redireccion = site_url + controlador;
$('.active').not('.usuario').removeClass('active');
$('.usuario').addClass('active');

$('[name=rol]').change(function () {
    let datos = {
        rol: $('[name=rol]').val(),
    }
    cargarTabla(controlador, datos);
});

cargarTabla(controlador, '');

$('.btnGuardar').click(function () {
    let datos = new FormData($('.form')[0]);
    guardar(controlador, datos, redireccion);
    return false;
});

$(".tabla tbody").on("click", ".btnBorrar", function () {
    let id = $(this).attr("codigo");
    let datos = new FormData();
    datos.append("id", id);
    borrar(controlador, datos);
});