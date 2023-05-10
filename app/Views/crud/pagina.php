<?= $this->extend('plantilla') ?>

<?= $this->section('estilos') ?>
<title><?=$pagina['Nombre'].' - '.$titulo?></title>
<?= $this->endSection() ?>

<?= $this->section('contenido') ?>
<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title"><?=$titulo?></h3>
    </div>

    <div class="card-body">
        <form class="form">
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Página</label>
                <div class="col-sm-10">
                    <input name="nombre" value="<?=$pagina['Nombre']?>" class="form-control" type="text">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Logo</label>
                <div class="col-sm-10">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" name="imagen">
                        <?php
                        $cadena = $pagina['Imagen'];
                        $separador = '/';
                        $separada = explode($separador, $cadena);
                        ?>
                        <label class="custom-file-label"><?=$separada[count($separada)-1]?></label>
                    </div>
                    <img id="verImagen" width="128"
                        <?php if ($pagina['Imagen']) { ?>src="<?=base_url($pagina['Imagen'])?>" <?php } ?>>
                </div>
            </div>

            <a href="<?=base_url()?>" class="btn btn-info"><i class="fas fa-undo"></i> Volver</a>
            <a class="btnGuardar btn btn-success float-right"><i class="fas fa-save"></i> Guardar</a>
    </div>
    </form>
</div>

<div class="alert alert-info alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h5><i class="icon fas fa-info"></i> <span class="titulo"></span></h5>
    <p class="mensaje"></p>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script src="<?= base_url() ?>/custom/js/pagina.js"></script>
<?= $this->endSection() ?>