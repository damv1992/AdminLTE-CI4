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
        <div class="form-group row">
            <a href="<?=site_url('usuario/agregar')?>" class="btn btn-success"><i class="fa fa-plus"></i> Agregar</a>
            <select name="rol" class="col-sm-4">
                <option value="">Todos los roles</option>
                <?php foreach ($roles as $rol) { ?>
                <option value="<?=$rol['RolAsignado']?>"><?=$rol['RolAsignado']?></option>
                <?php } ?>
            </select>
        </div>
        <div class="form-group">
            <table class="tabla table table-hover dataTable dtr-inline">
                <thead>
                    <tr>
                        <th style="width: 1%;">#</th>
                        <th>Usuario</th>
                        <th>Imagen</th>
                        <th>Telefono</th>
                        <th>Rol</th>
                        <th style="width: 1%;">Acciones</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script src="<?= base_url() ?>/custom/js/usuario.js"></script>
<?= $this->endSection() ?>