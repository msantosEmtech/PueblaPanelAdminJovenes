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
            <a class="navbar-brand ps-3" href="index.html">
                <!-- <img src="<?=base_url('static/principal/img/logoEmtech.svg')?>" style="width: 150px;"> -->
                <img src="<?=base_url('static/principal/img/logo.svg')?>" style="width: 4rem;">
                <span class="fs-4">
                    <img class="imglogos" src="<?= base_url('static/principal/img/letrasGobPuebla.svg') ?>" alt="logo" style="width: 5rem;">
                </span>
            </a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-alt-primary btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item">
                    <a class="btn btn-rounded text-uppercase btn-alt-secondary btnCerrarSesion" href="<?= base_url('Login/DestroySession')?>">Cerrar sesión</a>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-light" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">
                                <div class="d-flex no-block">
                                    <div class="col-md-4">
                                        <img src="<?= base_url('static/principal/img/logoUsuario.png') ?>" alt="" width="62" height="62" class="rounded-circle" style="background-color: #992740;">
                                    </div>
                                    <div class="col-md-6 nombreRol">
                                        <span class="font-Novbold" style="color: #000;"><?= $nombre; ?></span>
                                        <?= $nombreRol; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="sb-sidenav-menu-heading">Panel</div>
                            <?php if($idRol == 1){ ?>
                                <a class="nav-link <?= $title == "Dashboard" ? "active" : "" ?>" href="<?= base_url('PanelMaestro') ?>">
                                    <div class="sb-nav-link-icon"><i><img src="<?= base_url('static/principal/img/iconoDashboard.svg') ?>"></i></div>
                                    Dashboard
                                </a>
                                <a class="nav-link <?= $title == "Registro alumnos" ? "active" : "" ?>" href="<?= base_url('RegistroAlumnosAdmin') ?>">
                                    <div class="sb-nav-link-icon"><i><img src="<?= base_url('static/principal/img/iconoRegistro.svg') ?>"></i></div>
                                    Registro
                                </a>
                            <?php }else{ ?>
                                <a class="nav-link <?= $title == "Dashboard" ? "active" : "" ?>" href="<?= base_url('PanelMaestro') ?>">
                                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                    Tablero de seguimiento
                                </a>
                                <a class="nav-link <?= $title == "Registro alumnos" ? "active" : "" ?>" href="<?= base_url('RegistroAlumnosAdmin') ?>">
                                    <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                                    Registro de estudiantes
                                </a>
                            <?php } ?>
                            <div class="sb-sidenav-menu-heading">Informes</div>
                            <a class="nav-link collapsed <?= $title == "Avance de estudiantes" ? "active" : "" ?>" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i><img src="<?= base_url('static/principal/img/iconoAnalytics.svg') ?>"></i></div>
                                Reportes
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link <?= $title == "Avance de estudiantes" ? "active" : "" ?>" href="<?= base_url('AvanceEstudiantes') ?>">Avance de estudiantes</a>
                                </nav>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">