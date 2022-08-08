<main style="background-color: rgba(237, 237, 238, 0.2);">
    <section class="py-5" style="margin-top: 2rem;">
        <img src="<?= base_url('static/principal/img/bannerRegistroParticipantes.jpg') ?>" width="100%" style="background-size: contain;margin-top: -6rem;background-position: center;background-repeat: no-repeat;">
    </section>
    <section class="container pt-5 seccion-subtitulo-encabezado">
        <div class="row">
            <div class="col-md-12">
                <p class="lead text-center" style="color: #000000;"><b>En este apartado del portal podrás visualizar el avance de los estudiantes por curso</b>
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
                                    <div class="form-floating mb-3 mb-md-0">
                                        <div class="d-grid">
                                            <a id="btnDescargarReporte" class="btn btn-alt-primary btndescargarReporte" data-bs-toggle="tooltip" data-bs-placement="bottom" title="descargar reporte de participantes"><i class="fas fa-file-download" ></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-floating mb-3 mb-md-0">
                                        <input class="form-control" id="buscarAlumno" type="search" placeholder="Buscar.." />
                                        <label for="buscarAlumno">Buscar..</label>
                                    </div>
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
                        <table class="table text-center table-hover" id="tablaReporteAvance">
                            <thead>
                                <tr>
                                    <th>Identificador</th>
                                    <th>Nombre</th>
                                    <th>Apellido paterno</th>
                                    <th>Apellido materno</th>
                                    <th>Avance</th>
                                    <th>Correo</th>
                                    <th>Telefono</th>
                                    <th>Ocupación</th>
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
