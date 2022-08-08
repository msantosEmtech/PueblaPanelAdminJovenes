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
        <link href="<?= base_url('static/plugins/DataTables/datatables.min.css') ?>" rel="stylesheet">
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
                    <section class="banner-area-inscripcion wow  animate__animated animate__fadeIn animate__slow" style="background-image: url('<?= base_url('static/principal/img/bannerPuebla3.png') ?>');background-color:#F7F8FA;background-size: cover;margin-top: 5%;">
                        <div class="container" style="z-index: 1;">
                            <div class="carousel-caption text-start animate__animated animate__slideInLeft animate__slow" style="padding-bottom: 13% !important;">
                                <h1><b>Formación de Programación<br> WEB para Jóvenes</b></h1>
                            </div>
                        </div>
                    </section>
                    <section class="pt-5">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-12" >
                                    <div class="card card-emtech" style="margin-bottom: 55px;margin-left: 90px;margin-right: 90px;">
                                        <form id="formCurso" class="form" style="margin: 40px">
                                            <div class="mb-3">
                                                <label for="selectCurso" class="form-label" style="color: #AEB0B3;">Selecciona tu curso</label>
                                                <select class="form-select" aria-label="select curso" id="selectCurso">
                                                    <?php foreach ($listaCursos as $curso) { ?>
                                                        <option value="<?= $curso['Id'] ?>"><?= $curso['Descripcion'] ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section>
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card card-emtech" style="margin-bottom: 55px;margin-left: 90px;margin-right: 90px;">
                                        <div class="card-body">
                                            <form>
                                                <div class="row">
                                                    <div class="col-md-2">
                                                        <select class="form-select" id="selectLenght">
                                                            <option value="10" selected>10</option>
                                                            <option value="25">25</option>
                                                            <option value="50">50</option>
                                                            <option value="100">100</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <a id="btnDescargarReporte" class="btn btn-alt-primary btndescargarReporte" data-bs-toggle="tooltip" data-bs-placement="bottom" title="descargar reporte de participantes"><i class="fas fa-file-download" ></i></a>
                                                    </div>
                                                </div>
                                            </form>  
                                            <div class="table-responsive">
                                                <table class="table text-center table-hover" id="tablaAlumnos">
                                                    <thead>
                                                        <tr>
                                                            <th>
                                                                <!-- selecciona todo
                                                                <input class="form-check-input" type="checkbox" value="" id="selectAll" title="Selecciona todos"> -->
                                                            &nbsp;
                                                            </th>
                                                            <th>Nombre</th>
                                                            <th>Apellido paterno</th>
                                                            <th>Apellido materno</th>
                                                            <th>nacimiento</th>
                                                            <th>residencia</th>
                                                            <th>Correo</th>
                                                            <th>Telefono</th>
                                                            <th>Edad</th>
                                                            <th>Género</th>
                                                            <th>Ocupación</th>
                                                            <th>Tipo</th>
                                                            <th>Resultado</th>
                                                            <th>Fecha</th>
                                                            <th>Curso</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="tablaAlumnos">
                                                        
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
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
        <script src="<?= base_url('static/plugins/DataTables/datatables.min.js') ?>"></script>
        <script src="<?= base_url('static/principal/js/seleccion/seleccion.js') ?>"></script>
    </body>
</html>