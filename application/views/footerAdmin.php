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
            </div>
        </div>
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
        <?php if (isset($scriptAlert)){ echo $scriptAlert; }  ?>
        <?php if (isset($scriptDatatable)){ echo $scriptDatatable; }  ?>
        <?php if (isset($scriptMoment)){ echo $scriptMoment; }  ?>
        <?php if (isset($scriptVista)){ echo $scriptVista; }  ?>
    </body>
</html>