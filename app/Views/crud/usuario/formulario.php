<?= $this->extend('plantilla') ?>

<?= $this->section('estilos') ?>
<title><?=$pagina['Nombre'].' - '.$titulo?></title>
<?= $this->endSection() ?>

<?= $this->section('contenido') ?>
<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title">DATOS</h3>
    </div>

    <div class="card-body">
        <form class="form">
            <input type="hidden" name="id" value="<?=$usuario['IdUsuario']?>">

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Usuario</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="usuario" value="<?=$usuario['Usuario']?>">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Contraseña</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control" name="contraseña" placeholder="Vacio para mantener">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Rol</label>
                <div class="col-sm-10">
                    <select name="rol" class="form-control">
                        <option value="">Seleccionar rol</option>
                        <option value="Administrador" <?php if ($usuario['RolAsignado'] == 'Administrador') { ?>selected <?php } ?>>Administrador</option>
                        <option value="Cliente" <?php if ($usuario['RolAsignado'] == 'Cliente') { ?>selected <?php } ?>>Cliente</option>
                    </select>
                </div>
            </div>

            <a href="<?=site_url('usuario')?>" class="btn btn-info"><i class="fas fa-undo"></i> Volver</a>
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
<script src="<?= base_url() ?>/custom/js/usuario.js"></script>
<?= $this->endSection() ?>