(function(){
    "use strict";

    gobPuebla = gobPuebla ? gobPuebla : {};
    gobPuebla.avanceEstudiantes = gobPuebla.avanceEstudiantes ? gobPuebla.avanceEstudiantes : {};

    const elements = gobPuebla.avanceEstudiantes.elements = {
        $tablaAlumnos: $("#tablaReporteAvance"),
        $btnBuscar: $("#buscarAlumno"),
        $selectLength: $("#selectLenght"),
        $selectCurso: $("#selectCursoAdmin")
    };

    const uris = gobPuebla.avanceEstudiantes.uris = {
        historialAlumnos: gobPuebla.base.url + "AvanceEstudiantes/HistorialReporteAlumnosByCurso",
    };

    var tabla = elements.$tablaAlumnos.DataTable({
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
            "url":uris.historialAlumnos,
            "type":"POST"
        },
        columnDefs:[{
            targets: [-1]
        }],
        "scrollX": true,
        'columns':[
            {
                data: 'id_alumno',
                "order": true,
                render: function(data, type, row){
                    return row.id_alumno;
                }
            },
            {
                data: 'nombre_alumno',
                render: function(data, type, row){
                    return row.nombre_alumno;
                }
            },
            {
                data: 'apellido_paterno_alumno',
                render: function (data, type, row) {
                    return row.apellido_paterno_alumno;
                }
            },
            {
                data: 'apellido_materno_alumno',
                render: function(data, type, row){
                    return row.apellido_materno_alumno;
                }
            },
            {
                data: 'avance',
                render: function(data, type, row){
                    return `<strong style='color:#f57c20;'>${row.avance} %</strong>`;
                }
            },
            {
                data: 'correo',
                render: function(data, type, row){
                    return row.correo;
                }
            },
            {
                data: 'telefono_alumno',
                render: function(data, type, row){
                    return row.telefono_alumno;
                }
            },
            {
                data: 'ocupacion_alumno',
                render: function(data, type, row){
                    return row.ocupacion_alumno;
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

    elements.$selectCurso.on("change", function(){
        var data = this.value;
        tabla.column(0).search(data).draw();
    });

    elements.$selectLength.on("change", function(){
        var lengh = $(this).val();
        tabla.page.len(lengh).draw();
    });

    elements.$btnBuscar.on("input", function() { 
        tabla.search(this.value).draw();
    });

}());