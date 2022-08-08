(function(){
    "use strict";

    gobPuebla = gobPuebla ? gobPuebla : {};
    gobPuebla.seleccion = gobPuebla.seleccion ? gobPuebla.seleccion : {};

    const elementos = gobPuebla.seleccion.elements = {
        $selectCursos: $("#selectCurso"),
        $tablaAlumnos: $("#tablaAlumnos"),
        $selectLength: $("#selectLenght"),
        $btnDescargarReporte: $("#btnDescargarReporte")
    };

    const uris = gobPuebla.seleccion.uris = {
        getHistorialSeleccionados: `${gobPuebla.base.url}Seleccionados/HistorialAlumnosByCurso`,
        descargarReporte: `${gobPuebla.base.url}descargarReporteSeleccionados`
    };

    const tabla = elementos.$tablaAlumnos.DataTable({
        'language': {
            "decimal":        "",
            "emptyTable":     "Ningún dato disponible en esta tabla",
            "info":           "Mostrando _START_ a _END_ de _TOTAL_ registros",
            "infoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
            "infoFiltered":   "(filtrado total de _MAX_ registros)",
            "infoPostFix":    "",
            "thousands":      ",",
            "lengthMenu":     "Mostrar _MENU_ registros",
            "loadingRecords": "Cargando...",
            "processing":     "Procesando...",
            "search":         "Buscar:",
            "zeroRecords":    "No se encontraron resultados",
            "paginate": {
                "first":      "Primero",
                "last":       "Ultimo",
                "next":       "Siguiente",
                "previous":   "Anterior"
            },
            "aria": {
                "sortAscending":  ": Activar para ordenar la columna de manera ascendente",
                "sortDescending": ": Activar para ordenar la columna de manera descendente"
            }
        },
        'lengthMenu': [10, 25, 50,100],
        'paging': true,
        'info':true,
        'filter':true,
        'stateSave':true,
        "dom":"<'row'<'col-sm-6'><'col-sm-6'>>" +
        "<'row'<'col-sm-12'tr>>" +
        "<'row'<'col-sm-5'i><'col-sm-7'p>>",
        'processing': true,
        'serverSide':true,
        'ajax':{
            "url":uris.getHistorialSeleccionados,
            "type":"POST"
        },
        columnDefs:[
            {"targets": -1 },//ocultar para columna 0
            // { "orderable": false, "targets": 0 },//ocultar para columna 1
        ],
        "scrollX": true,
        'columns':[
            {
                data: 'id_alumno',
                render: function(data, type, row){
                    return row.participante_id;
                },
                className: "noVis"
            },
            {
                data: 'participante_nombre',
                "order": true,
                render: function(data, type, row){
                    return row.participante_nombre;
                }
            },
            {
                data: 'participante_apellido_paterno',
                render: function(data, type, row){
                    return row.participante_apellido_paterno;
                }
            },
            {
                data: 'participante_apellido_materno',
                render: function (data, type, row) {
                    return row.participante_apellido_materno;
                }
            },
            {
                data: 'participante_lugar_nacimiento',
                render: function(data, type, row){
                    return row.participante_lugar_nacimiento;
                }
            },
            {
                data: 'participante_lugar_residencia',
                render: function(data, type, row){
                    return row.participante_lugar_residencia;
                }
            },
            {
                data: 'participante_correo',
                render: function(data, type, row){
                    return row.participante_correo;
                }
            },
            {
                data: 'participante_telefono',
                render: function(data, type, row){
                    return row.participante_telefono;
                }
            },
            {
                data: 'participante_edad',
                render: function(data, type, row){
                    return row.participante_edad;
                }
            },
            {
                data: 'participante_genero',
                render: function(data, type, row){
                    return row.participante_genero;
                }
            },
            {
                data: 'participante_ocupacion',
                render: function(data, type, row){
                    return row.participante_ocupacion;
                }
            },
            {
                data: 'tipo_participante_descripcion',
                render: function(data, type, row){
                    return row.tipo_participante_descripcion;
                }
            },
            {
                data: 'resultado_resultado',
                render: function(data, type, row){
                    return row.resultado_resultado;
                }
            },
            {
                data: 'resultado_fecha',
                render: function(data, type, row){
                    let fechaResult = row.resultado_fecha == "" || row.resultado_fecha == null ? "" :  moment(row.resultado_fecha).format('DD/MM/YYYY');
                    return fechaResult;
                }
            },
            {
                data: 'curso_descripcion',
                render: function(data, type, row){
                    return row.curso_descripcion;
                }
            }
        ]
    });

    tabla.column(0).search(0).draw();
    tabla.column(1).search(1).draw();
    tabla.columns.adjust().draw();

    initTooltip();

    elementos.$selectLength.on("change", function(){
        var lengh = $(this).val();
        tabla.page.len(lengh).draw();
    });

    elementos.$selectCursos.on("change", function(){
        let data = this.value;
        tabla.column(0).search(data).draw();
    });

    elementos.$btnDescargarReporte.on("click", function(){

        var href = elementos.$btnDescargarReporte.attr("href", uris.descargarReporte + "/" + elementos.$selectCursos.val());
        window.location.href = href;
    });

    function initTooltip(){
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    
        tooltipTriggerList.map(function (result) {
            return new bootstrap.Tooltip(result)
        });
    };

}());