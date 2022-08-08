<!DOCTYPE html>
<html lang="es-MX">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="Panel administrativo gob. puebla" />
        <meta name="author" content="Mario Alberto Santos Cruz" />
        <link rel="shortcut icon" href="<?= base_url('static/principal/img/favicon.ico') ?>">
        <title>Gob. Puebla | <?= isset($title) ? $title : ""; ?></title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
        <link href="<?= base_url('static/plugins/bootstrap-5.1.3-dist/css/bootstrap.min.css') ?>" rel="stylesheet">
        <link href="<?= base_url('static/principal/css/styles.css') ?>" rel="stylesheet" />
        <link href="<?= base_url('static/principal/css/custom.css') ?>" rel="stylesheet" />
        <link href="<?= base_url('static/plugins/fontawesome-free-5.15.4-web/css/all.css') ?>" rel="stylesheet">
        <link href="<?= base_url('static/plugins/OwlCarousel2-2.3.4/dist/assets/owl.carousel.min.css') ?>" rel="stylesheet">
        <link href="<?= base_url('static/plugins/OwlCarousel2-2.3.4/dist/assets/owl.theme.default.min.css') ?>" rel="stylesheet">
        <?php if (isset($linkDatatable)){ echo $linkDatatable; }  ?>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-light border-bottom">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="<?= base_url('Main') ?>">
                <!-- <img src="<?=base_url('static/principal/img/logoEmtech.svg')?>" style="width: 150px;"> -->
                <img src="<?=base_url('static/principal/img/logo.svg')?>" style="width: 4rem;">
                <span class="fs-4">
                    <img class="imglogos" src="<?= base_url('static/principal/img/letrasGobPuebla.svg') ?>" alt="logo" style="width: 5rem;">
                </span>
            </a>
        </nav>
                <main style="background-color: #EDEFF2;">
                    <section class="banner-area-inscripcion wow  animate__animated animate__fadeIn animate__slow" style="background-image: url('<?= base_url('static/principal/img/bannerHome.jpg') ?>');background-color:#F7F8FA;background-size: cover;margin-top: 5%;">
                        <div class="container" style="z-index: 1;">
                            <div class="carousel-caption text-start animate__animated animate__slideInLeft animate__slow" style="padding-bottom: 13% !important;">
                                <h1><b>Formación de Programación<br> WEB para Jóvenes</b></h1>
                            </div>
                        </div>
                    </section>
                    <section class="pt-5">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <h2 class="text-center titulo-cafe"><b>Bienvenido(a)</b></h1>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <p class="descripcionEstudiantes lead text-center">El propósito de este formulario es que selecciones el horario del grupo al que asistirás a las sesiones en línea. Por favor registra SOLO UNA RESPUESTA.
                                    </p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <p class="descripcionEstudiantes lead text-center">Te presentamos las opciones de horarios de acuerdo a los grupos generados. Te sugerimos elegir la que mejor se alinee a tus actividades para asegurar tu asistencia a todas las sesiones. Tienes hasta el día ..... para seleccionar tu horario.
                                    </p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <p class="descripcionEstudiantes lead text-center">Todos los grupos tienen cierta disponibilidad, te sugerimos tomar la decisión comprometidamente, ya que no será posible realizar cambios de grupo y deberás asistir a todas las sesiones en los horarios programados.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section class="pt-5">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12" >
                                    <div class="card card-emtech" style="margin-bottom: 55px;margin-left: 90px;margin-right: 90px;">
                                        <form id="formInscripcion" class="form" style="margin: 40px">
                                            <div class="mb-3">
                                                <label for="selectAlumno" class="form-label" style="color: #AEB0B3;">Selecciona tu nombre</label>
                                                <select class="form-select" aria-label="select alumno" id="selectAlumno">
                                                    <option value="0">Selecciona un participante</option>
                                                    <?php foreach ($listaParticipantes as $participante) { ?>
                                                        <option value="<?= $participante['participante_id'] ?>" data-id="<?= $participante['resultado_id_curso'] ?>"><?= $participante['participante_apellido_paterno']." ".$participante['participante_apellido_materno']." ".$participante['participante_nombre'] ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="selectHorario" class="form-label" style="color: #AEB0B3;">Selecciona tu horario</label>
                                                <select class="form-select" aria-label="select horario" id="selectHorario">
                                                <!-- <?php foreach ($horarios as $horario) { ?>
                                                        <option value="<?= $horario['grupo_id']; ?>"><?= $horario['horario_descripcion']; ?></option>
                                                    <?php } ?> -->
                                                </select>
                                            </div>
                                            <div class="mb-3 form-check">
                                                <input type="checkbox" class="form-check-input" id="checkConfirmar">
                                                <label class="form-check-label" for="checkConfirmar" style="color: #AEB0B3;"><small>Estoy seguro sobre la elección del horario de mi grupo, por lo que confirmo mi decisión.</small></label>
                                            </div>
                                            <div class="text-center pt-2">
                                                <button type="submit" class="btn btn-rounded text-uppercase btn-alt-primary text-center btnEntrar" id="btnEntrar" disabled="disabled">Confirmar</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </main>
                <footer class="py-4 bg-white mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                        <img src="<?=base_url('static/principal/img/logoEmtech.svg')?>" style="width: 8rem;">
                        <div class="text-muted">
                                <span>Emerging Technologies Institute | All Rights Reserved</span>
                            </div>
                        </div>
                    </div>
                </footer>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
        <script src="<?= base_url('static/plugins/bootstrap-5.1.3-dist/js/bootstrap.min.js') ?>"></script>
        <script src="<?= base_url('static/plugins/jquery/js/query-3.6.0.min.js') ?>"></script>
        <script src="<?= base_url('static/principal/js/wow.min.js') ?>"></script>
        <script src="<?= base_url('static/principal/js/scripts.js') ?>"></script>
        <script src="<?= base_url('static/plugins/circle-progress-master/dist/jquery.circle-progress.js') ?>"></script>
        <script src="<?= base_url('static/plugins/OwlCarousel2-2.3.4/dist/owl.carousel.min.js') ?>"></script>
        <script>
            new WOW().init();
        </script>
        <script>
            var gobPuebla = {};

            gobPuebla.base = {
                url : '<?= base_url(); ?>'
            };
        </script>
        <script src="<?= base_url('static/plugins/sweetalert/sweetalert2.all.min.js') ?>"></script>
        <script src="<?= base_url('static/plugins/moment/moment.js') ?>"></script>
        <script src="<?= base_url('static/principal/js/inscripcion/inscripcion.js') ?>"></script>
    </body>
</html>