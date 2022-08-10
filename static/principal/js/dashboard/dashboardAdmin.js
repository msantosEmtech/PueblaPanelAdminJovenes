(function(){
    "use strict";

    gobPuebla = gobPuebla ? gobPuebla : {};
    gobPuebla.panel = gobPuebla.panel ? gobPuebla.panel : {};

    const elements = gobPuebla.panel.elements = {
        $circleProgressTotalAvance: $(".circuloTotalAvance"),
        $selectCurso: $("#selectCursoAdmin"),
        $txtAvanceEsperado: $("#txtAvanceEsperadoAdmin"),
        $txtAvanceDeficiente: $("#txtAvanceDeficienteAdmin"),
        $txtSinAvance: $("#txtSinAvanceAdmin"),
        $txtBajas: $("#txtBajasAdmin"),
        $contenedorCursos: $(".contenedor-cursos")
    };

    const uris = gobPuebla.panel.uris = {
        obtenerTotalAvanceCirculo: gobPuebla.base.url + "PanelMaestro/ObtenerTotalCirculoCurso",
        obtenerAvancesUniversidad: gobPuebla.base.url + "PanelMaestro/ObtenerAvancesAdmin",
        avanceCursosUniversidad: gobPuebla.base.url + "PanelMaestro/ObtenerAvancePorCursoAdmin"
    };

    elements.$selectCurso.on("change", function(){
        let idCurso = this.value;
        ObtenerTotalCirculo(idCurso);
    });

    function ObtenerTotalCirculo(curso){

        if(curso === undefined || curso === null || curso === 0 || curso === ""){
            elements.$circleProgressTotalAvance.circleProgress({
                max: 100,
                value: 0,
                textFormat: function(value, max) {
                    return value + ' %';
                }
            });
        }else{
            var model = {
                'curso': curso
            }
            $.post(uris.obtenerTotalAvanceCirculo, model)
            .done(function(resultado){
                var totales = JSON.parse(resultado);

                if(totales.total === null || totales.total === undefined || totales.total === ""){
                    elements.$circleProgressTotalAvance.circleProgress({
                        max: 100,
                        value: 0,
                        textFormat: function(value, max) {
                            return value + ' %';
                        }
                    });
                }else{
                    elements.$circleProgressTotalAvance.circleProgress({
                        max: 100,
                        value: parseFloat(totales.total),
                        textFormat: function(value, max) {
                            return value + ' %';
                        }
                    });
                }
                
            });
        }
        
    };

}());