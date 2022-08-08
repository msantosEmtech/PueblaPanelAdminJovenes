<main style="background-color: rgba(237, 237, 238, 0.2);">
    <section class="py-5" style="margin-top: 2rem;">
        <img src="<?= base_url('static/principal/img/bannerRegistroParticipantes.jpg') ?>" width="100%" style="background-size: contain;margin-top: -6rem;background-position: center;background-repeat: no-repeat;">
        <!-- <div class="centered text-center div-texto-banner-alumnos">
            <h1 class="banner-admin-registro-alumno">
                <b>Registro de estudiantes</b>
            </h1>
        </div> -->
    </section>
    <section class="container pt-5 seccion-subtitulo-encabezado">
        <div class="row">
            <div class="col-md-12">
                <p class="lead text-center" style="color: #000000;"><b>En este apartado del portal podrás validar la información de tus estudiantes registrados, así como buscar, editar o eliminar el registro de información de los mismos.</b>
                </p>
            </div>
        </div>
    </section>
    <div class="container-fluid px-4" >
        <div class="pt-5 pb-5 row">
            <div class="col-lg-12">
                <div class="card mb-4" style="border-radius: 0.75rem;border: none;">
                    <div class="card-body">
                        <h5 class="card-title text-center">Cursos disponibles</h5>
                        <div class="row">
                            <div class="col-md-12">
                                <select class="form-select" aria-label="select cursos" id="selectCursoAdmin">
                                    <option value="0" selected>todos</option>
                                    <?php foreach ($cursos as $curso) { ?>
                                        <option value="<?= $curso['Id']; ?>"><?= $curso['Descripcion']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <br>
                        <h5 class="card-title text-center">Estado de inscripcion</h5>
                        <div class="row">
                            <div class="col-md-12">
                                <select class="form-select form-control" id="selectEstadoInscrito">
                                    <option value="1">Activos en inscripción</option>
                                    <option value="0">Inactivos en inscripción</option>
                                    <option value="-1">participantes</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card mb-4" style="border-radius: 0.75rem;border: none;">
                    <div class="card-body">
                        <form>
                            <div class="row mb-3">
                                <div class="col-md-2">
                                    <div class="form-floating mb-3 mb-md-0">
                                        <div class="d-grid">
                                            <button type="submit" class="btn btn-rounded btn-primary btn-alt-primary btnCargarRegistro" id="btnCargarRegistroAlumno" data-bs-toggle="tooltip" data-bs-placement="bottom" title="cargar archivo de participantes a inscripción"><i class="fas fa-upload"></i><span>Cargar Registro</span></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-floating mb-3 mb-md-0">
                                        <div class="d-grid">
                                            <button type="submit" class="btn btn-rounded btn-primary btn-alt-primary" id="btnSeleccionarAut" data-bs-toggle="tooltip" data-bs-placement="bottom" title="selección automática de participantes para inscripción"><i class="fas fa-magic"></i><span> Selección</span></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-floating mb-3 mb-md-0">
                                        <div class="d-grid">
                                            <button type="submit" class="btn btn-rounded btn-primary btn-alt-primary" id="btnValidar" ><i class="fas fa-check"></i><span> Validar</span></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-floating mb-3 mb-md-0">
                                        <div class="d-grid">
                                            <a class="btn btn-rounded btn-primary btn-descargar" id="btnDescargarPlantilla" data-bs-toggle="tooltip" data-bs-placement="bottom" title="descarga la plantilla para poder cargar registros" ><i class="fas fa-file-excel"></i><span> Descargar</span></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-floating mb-3 mb-md-0">
                                        <input class="form-control" id="buscarAlumno" type="search" placeholder="Buscar.." />
                                        <label for="buscarAlumno">Buscar..</label>
                                    </div>
                                </div>
                                <!-- <div class="col-md-2">
                                    <div class="form-floating mb-3 mb-md-0">
                                        <div class="d-grid">
                                            <select class="form-select form-control" id="selectEstadoInscrito">
                                                <option value="1">Inscritos</option>
                                                <option value="0">No inscritos</option>
                                                <option value="-1">posibles aspirantes</option>
                                            </select>
                                        </div>
                                    </div>
                                </div> -->
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card" style="border-radius: 0.75rem;border: none;">
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
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card mb-4" style="border-radius: 0.75rem;border: none;">
                
                    
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
</main>

<div class="modal fade" tabindex="-1" id="modal-dialog-custom" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <!-- <h5 class="modal-title">Cargar registro de alumnos</h5> -->
                <button type="button" class="btn-close closeModalArchivo" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container row text-center">
                    <h3 style="color: rgba(187, 159, 121, 1);"><b>Cargar registro</b></h3>
                    <muted><small>Sube la plantilla en excel</small></muted>
                    <div class="container text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" style="width: 80px;height: 60px;">
                            <path d="M224 136V0H24C10.7 0 0 10.7 0 24v464c0 13.3 10.7 24 24 24h336c13.3 0 24-10.7 24-24V160H248c-13.2 0-24-10.8-24-24zm60.1 106.5L224 336l60.1 93.5c5.1 8-.6 18.5-10.1 18.5h-34.9c-4.4 0-8.5-2.4-10.6-6.3C208.9 405.5 192 373 192 373c-6.4 14.8-10 20-36.6 68.8-2.1 3.9-6.1 6.3-10.5 6.3H110c-9.5 0-15.2-10.5-10.1-18.5l60.3-93.5-60.3-93.5c-5.2-8 .6-18.5 10.1-18.5h34.8c4.4 0 8.5 2.4 10.6 6.3 26.1 48.8 20 33.6 36.6 68.5 0 0 6.1-11.7 36.6-68.5 2.1-3.9 6.2-6.3 10.6-6.3H274c9.5-.1 15.2 10.4 10.1 18.4zM384 121.9v6.1H256V0h6.1c6.4 0 12.5 2.5 17 7l97.9 98c4.5 4.5 7 10.6 7 16.9z"/>
                        </svg>
                    </div>
                </div>

                <form id="formCargaArchivo">
                    <div class="container row text-center" style="padding-top: 40px;">
                        <input type="file" class="form-control" name="cargarRegistro" id="inputCargarAlumnos">
                    </div>
                </form>
                
            </div>
        </div>
    </div>
</div>
