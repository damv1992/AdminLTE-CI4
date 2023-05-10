<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?=$pagina['Nombre'].' - '.$titulo?></title>
    <link rel="icon" type="image/x-icon" href="<?=base_url($pagina['Logo'])?>">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?=base_url('AdminLTE-3.2.0/plugins/fontawesome-free/css/all.min.css')?>">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?=base_url('AdminLTE-3.2.0/dist/css/adminlte.min.css')?>">
</head>

<body class="hold-transition login-page">

    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
        <img class="animation__shake" src="<?=base_url($pagina['Imagen'])?>" alt="AdminLTELogo" height="60" width="60">
    </div>
    
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="<?=base_url()?>" class="h1"><b><?=$pagina['Nombre']?></b>&copy;</a>
            </div>
            <div class="card-body">
                <!--<p class="login-box-msg">Inicia sesión para iniciar tu sesión</p>-->

                <form class="form">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Usuario" name="usuario">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Contraseña" name="contraseña">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                </form>

                <div class="row">
                    <div class="col-12">
                        <button class="btnLogin btn btn-primary btn-block">Iniciar Sesión</button>
                    </div>
                    <!-- /.col -->
                </div>

                <p class="mb-0">
                    <a href="https://wa.me/59173354006" class="text-center">Olvidé mi contraseña</a>
                </p>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="<?=base_url('AdminLTE-3.2.0/plugins/jquery/jquery.min.js')?>"></script>
    <!-- Bootstrap 4 -->
    <script src="<?=base_url('AdminLTE-3.2.0/plugins/bootstrap/js/bootstrap.bundle.min.js')?>"></script>
    <!-- AdminLTE App -->
    <script src="<?=base_url('AdminLTE-3.2.0/dist/js/adminlte.min.js')?>"></script>

    <input type="hidden" class="site_url" value="<?=site_url()?>">
    <script src="<?=base_url('custom/js/ajax.js')?>"></script>
</body>

</html>