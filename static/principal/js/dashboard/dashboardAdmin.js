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
        obtenerAvancesByCurso: gobPuebla.base.url + "PanelMaestro/ObtenerAvancesAdmin",
        avanceCursosTodos: gobPuebla.base.url + "PanelMaestro/ObtenerAvancePorCursoAdmin"
    };

    elements.$selectCurso.on("change", function(){
        let idCurso = this.value;
        ObtenerTotalCirculo(idCurso);
        ObtenerAvances(idCurso);
        removeBars();
        AvancePorCurso();
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

    function ObtenerAvances(curso){
        if(curso === undefined || curso === null || curso === 0 || curso === ""){
            return false;
        }else{
            var model = {
                'curso': curso
            }
            $.post(uris.obtenerAvancesByCurso, model)
            .done(function(result){
                var totales = JSON.parse(result);
                if(totales === null || totales === undefined || totales === ""){
                    elements.$txtAvanceEsperado.text(0);
                    elements.$txtAvanceDeficiente.text(0);
                    elements.$txtSinAvance.text(0);
                    elements.$txtBajas.text(0);
                }else{
                    elements.$txtAvanceEsperado.text(totales.alumnos_avance);
                    elements.$txtAvanceDeficiente.text(totales.alumnos_deficiente);
                    elements.$txtSinAvance.text(totales.alumnos_sin_avance);
                    elements.$txtBajas.text(totales.alumnos_baja);
                }
            });
        }
    }

    function AvancePorCurso(){
        
        $.post(uris.avanceCursosTodos,{}, "JSON")
        .done(function(result){
            var data = JSON.parse(result);

            $.each(data, function(i, value){
                var $div = $(`<div class='row mt-4 contenedor-bar'><div class='col-md-12'><div class='row'><div class='col-md-12'><p>${value.Descripcion}</p></div></div><div class='row'><div class='col-md-8 my-auto'><div class='progress'><div class='progress-bar bg-info' role='progressbar' style='width: ${value.avance}%' aria-valuenow='${value.avance}' aria-valuemin='0' aria-valuemax='100'></div></div></div><div class='col-md-4'><span>${value.avance}%</span></div></div></div></div>`);

            elements.$contenedorCursos.append($div.prop("outerHTML"));
            });
        });
    }

    function removeBars(){
        elements.$contenedorCursos.find("div.contenedor-bar").remove();
    };

}());