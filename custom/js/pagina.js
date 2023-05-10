$(".active").not(".pagina").removeClass("active");
$(".pagina").addClass("active");
let controlador = '/pagina';
let redireccion = site_url;
$('#verImagen').show();

$('.btnGuardar').click(function () {
    let datos = new FormData($('.form')[0]);
    datos.set('imagen', $("[name=imagen]").prop('files')[0]);
    guardar(controlador, datos, redireccion);
    return false;
});