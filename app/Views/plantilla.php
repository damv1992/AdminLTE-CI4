<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= $this->renderSection('estilos') ?>
    <link rel="icon" type="image/x-icon" href="<?=base_url($pagina['Imagen'])?>">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?=base_url('AdminLTE-3.2.0/plugins/fontawesome-free/css/all.min.css')?>">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?=base_url('AdminLTE-3.2.0/dist/css/adminlte.min.css')?>">
    <!-- DataTables -->
    <link rel="stylesheet"
        href="<?=base_url('AdminLTE-3.2.0/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')?>">
    <link rel="stylesheet"
        href="<?=base_url('AdminLTE-3.2.0/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')?>">
    <link rel="stylesheet"
        href="<?=base_url('AdminLTE-3.2.0/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')?>">
</head>

<body class="hold-transition sidebar-mini">
    <input type="hidden" class="site_url" value="<?=site_url()?>">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="<?=base_url()?>" class="nav-link">Inicio</a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="<?=base_url()?>" class="brand-link">
                <img src="<?=base_url($pagina['Imagen'])?>" alt="AdminLTE Logo"
                    class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light"><?=$pagina['Nombre']?></span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">

                <!-- Sidebar user (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <?php if ($_SESSION['Imagen']) { ?>
                    <div class="image">
                        <a href="<?=site_url('perfil')?>">
                            <img src="<?=base_url($_SESSION['Imagen'])?>" class="img-circle elevation-2"
                                alt="User Image">
                        </a>
                    </div>

                    <div class="info">
                        <a href="<?=site_url('usuario/desconectar')?>" class="d-block">DESCONECTAR</a>
                    </div>
                    <?php } else { ?>

                    <div class="info">
                        <a href="<?=site_url('perfil')?>" class="d-block"><?=mb_strtoupper($_SESSION['Usuario'])?></a>
                        <a href="<?=site_url('usuario/desconectar')?>" class="d-block">DESCONECTAR</a>
                    </div>
                    <?php } ?>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
                        <li class="nav-item">
                            <a href="<?=base_url()?>" class="inicio nav-link">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>Inicio</p>
                            </a>
                        </li>

                        <?php if ($_SESSION['RolAsignado'] == 'Administrador') { ?>
                        <li class="nav-header">ADMINISTRADOR</li>
                        <li class="nav-item">
                            <a href="<?=site_url('pagina')?>" class="pagina nav-link">
                                <i class="nav-icon fas fa-cog"></i>
                                <p>Página</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?=site_url('usuario')?>" class="usuario nav-link">
                                <i class="nav-icon fas fa-users"></i>
                                <p>Usuarios</p>
                            </a>
                        </li>
                        <?php } ?>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <?= $this->renderSection('contenidoCabecera') ?>
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <?= $this->renderSection('contenido') ?>
                <!-- <div class="container-fluid"></div> -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer">
            <strong>Copyright &copy; <a href="https://wa.me/59173354006">Daniel Alejandro Miranda Villalta</a>.</strong>
            Reservados todos los derechos.
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 3.2.0
            </div>
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="<?=base_url('AdminLTE-3.2.0/plugins/jquery/jquery.min.js')?>"></script>
    <!-- Bootstrap 4 -->
    <script src="<?=base_url('AdminLTE-3.2.0/plugins/bootstrap/js/bootstrap.bundle.min.js')?>"></script>
    <!-- AdminLTE App -->
    <script src="<?=base_url('AdminLTE-3.2.0/dist/js/adminlte.min.js')?>"></script>
    <!-- DataTables  & Plugins -->
    <script src="<?=base_url('AdminLTE-3.2.0/plugins/datatables/jquery.dataTables.min.js')?>"></script>
    <script src="<?=base_url('AdminLTE-3.2.0/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')?>"></script>
    <script src="<?=base_url('AdminLTE-3.2.0/plugins/datatables-responsive/js/dataTables.responsive.min.js')?>"></script>
    <script src="<?=base_url('AdminLTE-3.2.0/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')?>"></script>
    <script src="<?=base_url('AdminLTE-3.2.0/plugins/datatables-buttons/js/dataTables.buttons.min.js')?>"></script>
    <script src="<?=base_url('AdminLTE-3.2.0/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')?>"></script>
    <script src="<?=base_url('AdminLTE-3.2.0/plugins/datatables-buttons/js/buttons.html5.min.js')?>"></script>
    <script src="<?=base_url('AdminLTE-3.2.0/plugins/datatables-buttons/js/buttons.print.min.js')?>"></script>
    <script src="<?=base_url('AdminLTE-3.2.0/plugins/datatables-buttons/js/buttons.colVis.min.js')?>"></script>

    <script src="<?=base_url('custom/js/ajax.js')?>"></script>
    <?= $this->renderSection('scripts') ?>
</body>

</html>