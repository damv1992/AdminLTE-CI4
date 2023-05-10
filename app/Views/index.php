<?= $this->extend('plantilla') ?>

<?= $this->section('estilos') ?>
<title><?=$pagina['Nombre'].' - '.$titulo?></title>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    $(".active").not(".inicio").removeClass("active");
    $(".inicio").addClass("active");
</script>
<?= $this->endSection() ?>