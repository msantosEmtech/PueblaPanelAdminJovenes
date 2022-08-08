<!DOCTYPE html>
<html lang="es-MX">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Mario Alberto Santos Cruz">
    <link rel="shortcut icon" href="<?= base_url('static/principal/img/favicon.ico') ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gob. Puebla | <?= isset($title) ? $title : ""; ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
        <link href="<?= base_url('static/plugins/bootstrap-5.1.3-dist/css/bootstrap.min.css') ?>" rel="stylesheet">
        <link rel="stylesheet" href="<?= base_url('static/principal/css/custom.css') ?>">
        <link rel="stylesheet" href="<?= base_url('static/principal/css/footers.css') ?>">
        <link rel="stylesheet" href="<?= base_url('static/principal/css/features.css') ?>">
</head>
<body style="background-color: rgba(237, 237, 238, 0.2);">
    <header>
        <nav class="navbar navbar-expand-md navbar-dark fixed-top">
            <div class="container-fluid">
                <a class="navbar-brand" href="<?= base_url('Home') ?>">
                    <img src="<?=base_url('static/principal/img/logo.svg')?>" style="width: 4rem;">
                    <span class="fs-4">
                        <img class="imglogos" src="<?= base_url('static/principal/img/letrasGobPuebla.svg') ?>" alt="logo" style="width: 4rem;">
                    </span>
                </a>
                <div class="float-right">
                    <a class="navbar-brand">
                    <img src="<?=base_url('static/principal/img/logoEmtech.svg')?>" style="width: 10rem;">
                    </a>
                </div>
            </div>
        </nav>
    </header>
    <main>
        <div class="limiter">
            <div class="container-login100">
                <div class="wrap-login100">
                        <div class="login100-form">
                            <div class="card" style="border-radius: 0.75rem;border: none;box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);">
                                <div class="card-body">
                                    <span class="login100-form-title p-b-59"><b>Inicio de sesión</b></span>
                                    <?php if(isset($mensaje)){ ?>
                                        <div class="row text-center">
                                            <div class="col-12">
                                                <div class="alert <?=$classAlert; ?>" role="alert">
                                                <?=$mensaje; ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                    <form class="form">
                                        <div class="mb-3">
                                        <label class="form-label" for="txtCorreo" style="color: #AEB0B3;">Correo Electronico</label>
                                        <input type="text" name="correo" class="form-control" id="txtCorreo" required="required">
                                    </div>
                                    <div class="mb-3">
                                        <label for="txtContrasenia" class="form-label" style="color: #AEB0B3;">Contraseña</label>
                                        <input type="password" name="contrasenia" class="form-control" id="txtContrasenia" required="required" autocomplete="TRUE">
                                    </div>
                                    <div class="mb-3 form-check">
                                        <input type="checkbox" class="form-check-input" id="checkRecordar">
                                        <label class="form-check-label" for="checkRecordar" style="color: #414142;">Recordar mi cuenta</label>
                                    </div>
                                    <div class="text-center pt-2">
                                        <button type="submit" class="btn btn-rounded text-uppercase btn-alt-primary text-center btnEntrar" id="btnEntrar">Iniciar sesión</button>
                                    </div>
                                    <div class="text-center py-5">
                                        <p>¿Olvidaste tu contraseña? Haz <a href="<?=base_url('Login/RecuperarContrasenia')?>" style="color: #9A2840;cursor: pointer;">click aquí</a> para restablecerla</p>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <div class="login100-more" style="background-color: #D9D9D9;background-image: url('<?= base_url('static/principal/img/bannerProgramacionWeb.png') ?>')";>
                        <div class="container">
                            <div class="carousel-caption-admin text-center">
                                <h1 style="padding-top: 30%;color: white;"><b>Bienvenido al portal de registro<br>de estudiantes del programa<br>“Desarrolla tus competencias<br>en Tecnologías Emergentes del<br>Gobierno de Puebla.</b></h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="<?= base_url('static/plugins/bootstrap-5.1.3-dist/js/bootstrap.min.js') ?>"></script>
    <script src="<?= base_url('static/plugins/jquery/js/query-3.6.0.min.js') ?>"></script>
    <script src="<?= base_url('static/plugins/jquery-validation-1.19.3/dist/jquery.validate.min.js') ?>"></script>
    <script src="<?= base_url('static/plugins/jquery-validation-1.19.3/dist/localization/messages_es.js') ?>"></script>
    <script src="<?= base_url('static/plugins/sweetalert/sweetalert2.all.min.js') ?>"></script>
    <script>
        var gobPuebla = {};

        gobPuebla.base = {
            url : '<?= base_url(); ?>'
        };
    </script>
    <script src="<?= base_url('static/principal/js/login/login.js') ?>"></script>
</body>
</html>