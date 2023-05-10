<?= $this->extend('plantilla') ?>

<?= $this->section('estilos') ?>
<title><?=$pagina['Nombre'].' - '.$titulo?></title>
<?= $this->endSection() ?>

<?= $this->section('contenido') ?>
<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title">DATOS DE <?=mb_strtoupper($perfil['Usuario'])?></h3>
    </div>

    <div class="card-body">
        <form class="form">
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Contraseña</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control" name="contraseña"
                        placeholder="No escribir para mantener la misma contraseña">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Imagen</label>
                <div class="col-sm-10">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" name="imagen">
                        <?php
                        $cadena = $perfil['Imagen'];
                        $separador = '/';
                        $separada = explode($separador, $cadena);
                        ?>
                        <label class="custom-file-label"><?=$separada[count($separada)-1]?></label>
                    </div>
                    <img id="verImagen" width="160" <?php if ($perfil['Imagen']) { ?>
                        src="<?=base_url($perfil['Imagen'])?>" <?php } ?>>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Teléfono</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" name="telefono" value="<?=$perfil['Telefono']?>"
                        placeholder="Código país y número sin espacios">
                </div>
            </div>

            <a href="<?=base_url()?>" class="btn btn-info"><i class="fas fa-undo"></i> Volver</a>
            <a class="btnGuardar btn btn-success float-right"><i class="fas fa-save"></i> Guardar</a>
        </form>
    </div>
</div>

<div class="alert alert-info alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h5><i class="icon fas fa-info"></i> <span class="titulo"></span></h5>
    <p class="mensaje"></p>
</div>
<!-- /.tab-pane -->
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    let controlador = '/perfil';
    let redireccion = site_url;
    $('.btnGuardar').click(function () {
        let datos = new FormData($('.form')[0]);
        datos.set('imagen', $("[name=imagen]").prop('files')[0]);
        guardar(controlador, datos, redireccion);
        return false;
    });
</script>
<?= $this->endSection() ?>