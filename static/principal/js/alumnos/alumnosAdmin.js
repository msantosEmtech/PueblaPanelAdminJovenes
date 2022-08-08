(function(){
    "use strict";

    gobPuebla = gobPuebla ? gobPuebla : {};
    gobPuebla.alumnosAdmin = gobPuebla.alumnosAdmin ? gobPuebla.alumnosAdmin : {};

    gobPuebla.alumnosAdmin.elements = {
        $tablaAlumnos: $("#tablaAlumnos"),
        $selectCursosAdmin : $("#selectCursoAdmin"),
        $btnBuscar: $("#buscarAlumno"),
        $btnSeleccionAutomatica: $("#btnSeleccionarAut"),
        $btnValidar: $("#btnValidar"),
        $btnDescargarPlantilla: $("#btnDescargarPlantilla"),
        $selectEstadoInscrito: $("#selectEstadoInscrito"),
        $selectAll: $("#selectAll"),
        $btnModalCargarArchivo: $("#btnCargarRegistroAlumno"),
        $modalRegistroAlumnos: $("#modal-dialog-custom"),
        $btnCargarRegistroAlumnos: $("#inputCargarAlumnos"),
        $selectLength: $("#selectLenght"),
        $btnDescargarReporte: $("#btnDescargarReporte")
    };

    gobPuebla.alumnosAdmin.uris = {
        historialAlumnos: `${gobPuebla.base.url}RegistroAlumnosAdmin/HistorialAlumnosByCurso`,
        enviarAInscripcion: `${gobPuebla.base.url}RegistroAlumnosAdmin/ActualizarEstatusInscripcion`,
        descargarPlantilla: `${gobPuebla.base.url}RegistroAlumnosAdmin/DescargarPlantilla`,
        guardarArchivoAlumnos: `${gobPuebla.base.url}RegistroAlumnosAdmin/LecturaPreviaExcel`,
        descargarReporte: `${gobPuebla.base.url}descargarReporte`
    };

    initTooltip();

    const tabla = gobPuebla.alumnosAdmin.elements.$tablaAlumnos.DataTable({
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
            "url":gobPuebla.alumnosAdmin.uris.historialAlumnos,
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
                    var disable = row.resultado_estatus_inscripcion == 1 || row.resultado_estatus_inscripcion == "" || row.resultado_estatus_inscripcion == null  ? "disabled" : "";
                    return `<div class="form-check"><input class="form-check-input checkAlumno" type="checkbox" data-id="${row.participante_id}" value="" width="20px" ${disable}></div>`;
                    // return `<div class=\"form-check\"><input class=\"form-check-input checkAlumno\" type=\"checkbox\" data-id=\"${row.participante_id}\" value=\"\" width=\"20px\" ${disable}></div>`;
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
        ],
        drawCallback: verificarChecked
    });

    tabla.column(0).search(0).draw();
    tabla.column(1).search(1).draw();
    tabla.columns.adjust().draw();

    $("body").on("click", ".checkAlumno", verificarChecked);

    gobPuebla.alumnosAdmin.elements.$selectCursosAdmin.on("change", function(){
        let data = this.value;
        tabla.column(0).search(data).draw();
    });

    gobPuebla.alumnosAdmin.elements.$btnBuscar.on("input", function() { 
        tabla.search(this.value).draw();
    });

    gobPuebla.alumnosAdmin.elements.$btnSeleccionAutomatica.on("click", function(e){
        e.preventDefault();
        $(".checkAlumno").prop("checked", false);
        if(gobPuebla.alumnosAdmin.elements.$selectEstadoInscrito.val() == 0){
            $(".checkAlumno").each(function(index, value){
                let datos = getDataByElement({ element: $(value) });
                if(datos.resultado_resultado == "Avanzado"){
                    $(this).prop('checked', true);
                    verificarChecked();
                }
            });
        }else{
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: '¡debe seleccionar el estado inactivos en inscripción!'
            });
        }
        
    });

    gobPuebla.alumnosAdmin.elements.$selectAll.on("click", function(){
        let valor = gobPuebla.alumnosAdmin.elements.$selectEstadoInscrito.val();
        if(valor == 0){
            if($(this).is(":checked")) {
                $(".checkAlumno").each(function(index, value){
                    let datos = getDataByElement({ element: $(value) });
                    if(datos.resultado_estatus_inscripcion == 0){
                        $(this).prop('checked', true);
                        verificarChecked();
                    }
                });        
            }else{
                $(".checkAlumno").prop("checked", false);
                verificarChecked();
            }
        }else{
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: '¡estos participantes ya estan inscritos o solo son aspirantes!'
            });
            $(this).prop('checked', false);

            return false;
        }
        
    });

    gobPuebla.alumnosAdmin.elements.$btnValidar.on("click", function(e){
        e.preventDefault();
        let ids = [];
        $(".checkAlumno:checked").each(function(index, value){
            let datos = getDataByElement({ element: $(value) });
            var model = {participante_id: datos.participante_id, curso_id: datos.curso_id};
            ids.push(model);
        });

        if(ids.length > 0){
            $.post(gobPuebla.alumnosAdmin.uris.enviarAInscripcion, { ids: ids })
            .done(function (resultado) {
                let result = JSON.parse(resultado);

                if(result > 0){
                    Swal.fire(
                        'Actualizado',
                        'los registros han sido actualizados correctamente',
                        'success'
                        );
                    tabla.ajax.reload();
                    tabla.column(0).search($("#selectCursoAdmin").val()).draw();
                }
            });
        }else{
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: '¡No existe ninguna seleccion a validar!'
            });
            return false;
        }
        
    });

    gobPuebla.alumnosAdmin.elements.$btnDescargarPlantilla.on("click", function(){
        let href = gobPuebla.alumnosAdmin.elements.$btnDescargarPlantilla.attr("href",gobPuebla.alumnosAdmin.uris.descargarPlantilla);
        window.location.href = href;
    });

    gobPuebla.alumnosAdmin.elements.$selectEstadoInscrito.on("change", function(){
        var data = this.value;
        tabla.column(1).search(data).draw();
    });

    gobPuebla.alumnosAdmin.elements.$btnModalCargarArchivo.on("click", function(e){
        e.preventDefault();

        gobPuebla.alumnosAdmin.elements.$modalRegistroAlumnos.modal('show');
    });

    gobPuebla.alumnosAdmin.elements.$btnCargarRegistroAlumnos.on("change", function(){
        let file = $(this)[0].files[0];

        let formdataXml = new FormData();
        formdataXml.append('file', file);

        $.ajax({
            url: gobPuebla.alumnosAdmin.uris.guardarArchivoAlumnos,
            type: "POST",
            data:formdataXml,
            processData: false,
            contentType: false
        }).done(function(result){
            
            gobPuebla.alumnosAdmin.elements.$modalRegistroAlumnos.modal('hide');
            
            var resultado = JSON.parse(result);
            
            if(resultado == 1){

                let timerInterval
                
                Swal.fire({
                title: 'Cargar registros',
                html:
                    'Cargando.. <strong></strong> seconds.',
                timer: 10000,
                didOpen: () => {
                    const content = Swal.getHtmlContainer()
                    const $ = content.querySelector.bind(content)
                
                    Swal.showLoading()
                
                    timerInterval = setInterval(() => {
                    Swal.getHtmlContainer().querySelector('strong')
                        .textContent = (Swal.getTimerLeft() / 1000)
                        .toFixed(0)
                    }, 100)
                },
                willClose: function() {
                    clearInterval(timerInterval);
                    $('#formCargaArchivo').trigger("reset");
                    tabla.ajax.reload();
                    }
                })
            }else if(resultado == -1){
                $('#formCargaArchivo').trigger("reset");
                Swal.fire({
                    position: 'center',
                    icon: 'error',
                    title: 'El archivo que intentas cargar esta vacio',
                    showConfirmButton: false,
                    timer: 5000
                });
            }else if(resultado == -2){
                $('#formCargaArchivo').trigger("reset");
                Swal.fire({
                    position: 'center',
                    icon: 'error',
                    title: 'alguna fila tiene un curso que no existe o está mal escrito',
                    showConfirmButton: false,
                    timer: 5000
                });
            }else if(resultado == -2){
                $('#formCargaArchivo').trigger("reset");
                Swal.fire({
                    position: 'center',
                    icon: 'error',
                    title: 'alguna fila tiene un curso que no existe o está mal escrito',
                    showConfirmButton: false,
                    timer: 5000
                });
            }else if(resultado == -3){
                $('#formCargaArchivo').trigger("reset");
                Swal.fire({
                    position: 'center',
                    icon: 'error',
                    title: 'alguno de los registros no tiene un resultado del assessment',
                    showConfirmButton: false,
                    timer: 5000
                });
            }else{
                $('#formCargaArchivo').trigger("reset");
                Swal.fire({
                    position: 'center',
                    icon: 'error',
                    title: 'uno de los registro tiene un correo incorrecto',
                    showConfirmButton: false,
                    timer: 5000
                });
            }

        }).fail(function(xhr, status, error){
            $('#formCargaArchivo').trigger("reset");
            Swal.fire({
                position: 'center',
                icon: 'error',
                title: 'Ocurrio un error, favor de revisar que los participantes que intenta cargar existan',
                showConfirmButton: false,
                timer: 2500
            });
        });
    });

    gobPuebla.alumnosAdmin.elements.$selectLength.on("change", function(){
        var lengh = $(this).val();
        tabla.page.len(lengh).draw();
    });

    gobPuebla.alumnosAdmin.elements.$btnDescargarReporte.on("click", function(){

        var selectEstatus = parseInt(gobPuebla.alumnosAdmin.elements.$selectEstadoInscrito.val());
        if(selectEstatus == -1){
            selectEstatus = 0;
        }
        var href = gobPuebla.alumnosAdmin.elements.$btnDescargarReporte.attr("href", gobPuebla.alumnosAdmin.uris.descargarReporte + "/" + gobPuebla.alumnosAdmin.elements.$selectCursosAdmin.val() + "/" + selectEstatus);
        window.location.href = href;
    });

    const getDataByElement = (object) =>{
        object = object ? object: {};

        let $element = object.element;
        let $fila = $element.closest("tr");
        let datos = tabla.row($fila).data();

        return datos;
    };

    function verificarChecked(){
        var checks = $(".checkAlumno:checked");
        
        if(checks.length > 0){
            gobPuebla.alumnosAdmin.elements.$btnValidar.prop('disabled', false);
        }else{
            gobPuebla.alumnosAdmin.elements.$btnValidar.prop('disabled', true);
        }
    };

    function initTooltip(){
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    
        tooltipTriggerList.map(function (result) {
            return new bootstrap.Tooltip(result)
        });
    };

}());