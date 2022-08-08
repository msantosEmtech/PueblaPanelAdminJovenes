<main style="background-color: #EDEFF2;">
    <section class="banner-area" style="background-image: url('<?= base_url('static/principal/img/bannerDashboard.jpg') ?>');background-color:#F7F8FA;background-size: cover;">
    </section>
    <div class="container-fluid px-4" >
        <div class="pt-5 row">
            <div class="col-lg-12">
                <div class="card mb-4" style="border-radius: 0.75rem;border: none;">
                    <div class="card-body">
                        <h5 class="card-title text-center">Cursos disponibles</h5>
                        <div class="row">
                            <div class="col-md-12">
                                <select class="form-select" aria-label="select cursos" id="selectCursoAdmin">
                                    <option value="0" selected>Selecciona un curso</option>
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
            <div class="col-lg-3">
                <div class="card mb-4" style="border-radius: 0.75rem;border: none;">
                    <div class="card-body">
                        <div class="row">
                            <h5 class="card-title">Avance global</h5>
                            <div class="col-md-12 circle-progress circuloTotalAvance" style="padding-left: 60px;">
                            
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card mb-4" style="border-radius: 0.75rem;border: none;">
                    <div class="card-body pl-2">
                        <div class="row">
                            <div class="col-md-12" style="padding-left: 60px;">
                                <div class="row mt-3">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <span class="titulosAvances">Avance esperado</span>
                                            </div>
                                        </div>
                                        <div class="row centrado-y">
                                            <div class="col-2">
                                                <i class="fas fa-circle" style="color: #35B50E;"></i>
                                            </div>
                                            <div class="col-10 pl-0">
                                                <h3 style="margin-bottom:0px" id="txtAvanceEsperadoAdmin"></h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr style="width:60%;color:#cad9e3">
                                <div class="row mt-3">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <span class="titulosAvances">Avance debajo de lo esperado</span>
                                            </div>
                                        </div>
                                        <div class="row centrado-y">
                                            <div class="col-2">
                                                <i class="fas fa-circle" style="color:#F5E413;"></i>
                                            </div>
                                            <div class="col-10 pl-0">
                                                <h3 style="margin-bottom:0px" id="txtAvanceDeficienteAdmin"></h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr style="width:60%;color:#cad9e3">
                                <div class="row mt-3">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <span class="titulosAvances">Muy debajo de lo esperado</span>
                                            </div>
                                        </div>
                                        <div class="row centrado-y">
                                            <div class="col-2">
                                            <i class="fas fa-circle" style="color:#CE1818;"></i>
                                            </div>
                                            <div class="col-10 pl-0">
                                                <h3 style="margin-bottom:0px" id="txtSinAvanceAdmin"></h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr style="width:60%;color:#cad9e3">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <span class="titulosAvances">Bajas</span>
                                            </div>
                                        </div>
                                        <div class="row centrado-y">
                                            <div class="col-2">
                                                <i class="fas fa-circle" style="color:#E9EAEB;"></i>
                                            </div>
                                            <div class="col-10 pl-0">
                                                <h3 style="margin-bottom:0px" id="txtBajasAdmin"></h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card mb-4" style="border-radius: 0.75rem;border: none;">
                    <div class="card-body pl-2">
                        <div class="row">
                            <h5 class="card-title">Avance por curso</h5>
                            <div class="contenedor-cursos">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
