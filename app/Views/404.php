<?php
  use App\Models\ModelPagina;

  $paginas = new ModelPagina();

  $pagina = $paginas->first();
?>
<?= $this->extend('plantilla') ?>

<?= $this->section('estilos') ?>
  <title><?=$pagina['Nombre'].' - '.$titulo?></title>
<?= $this->endSection() ?>

<?= $this->section('contenidoCabecera') ?>
  <div class="col-sm-6">
    <h1><?=$titulo?></h1>
  </div>
  <div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
      <li class="breadcrumb-item"><a href="<?=base_url()?>">Inicio</a></li>
      <li class="breadcrumb-item active"><?=$titulo?></li>
    </ol>
  </div>
<?= $this->endSection() ?>

<?= $this->section('contenido') ?>
  <div class="error-page">
    <h2 class="headline text-warning"> 404</h2>
    <div class="error-content">
      <h3><i class="fas fa-exclamation-triangle text-warning"></i> ¡Ups! Página no encontrada.</h3>
      <p>
        No pudimos encontrar la página que estabas buscando. Mientras tanto, puedes
        <a href="<?=base_url()?>">volver al inicio</a>.
      </p>
    </div>
    <!-- /.error-content -->
  </div>
  <!-- /.error-page -->
<?= $this->endSection() ?>