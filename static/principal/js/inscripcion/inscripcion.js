(function(){
    "use strict";

    gobPuebla = gobPuebla ? gobPuebla : {};
    gobPuebla.inscripcion = gobPuebla.inscripcion ? gobPuebla.inscripcion : {};

    const elementos = gobPuebla.inscripcion.elements = {
        $checkConfirmar: $("#checkConfirmar"),
        $selectAlumnos: $("#selectAlumno"),
        $selectHorario: $("#selectHorario"),
        $btnGuardar: $("#btnEntrar")
    };

    const uris = gobPuebla.inscripcion.uris = {
        getHorariosPorCurso: `${gobPuebla.base.url}Inscripcion/ObtenerListaHorariosPorCurso`,
        add: `${gobPuebla.base.url}Inscripcion/AgregarInscripcion`
    };

    elementos.$checkConfirmar.on("click", function(){verificarChecked(this)});
    elementos.$selectAlumnos.on("change", function(){
        elementos.$selectHorario.find('option').remove();
        let curso = parseInt($(this).find(':selected').attr('data-id'));
        getHorarios(curso);
    });
    elementos.$btnGuardar.on("click", function(e){
        e.preventDefault();
        var alumnos = elementos.$selectAlumnos.val();
        var horario = elementos.$selectHorario.val();

        var validarAlumno = validarSeleccionAlumno(alumnos);
        var validarHorario = validarSeleccionHorario(horario);

        if(validarAlumno == false){
            return false;
        };

        if(validarHorario == false){
            return false;
        };

        var model = {
            'idAlumno': alumnos,
            'idGrupo': horario
        };

        AgregarInscripcion(model);
    });


    function verificarChecked($check){
        elementos.$btnGuardar.attr("disabled", $check.checked ? false : true);
    };

    function getHorarios(curso) {
        $.post(uris.getHorariosPorCurso, {'idCurso': curso}, "JSON").done(function(result){
            var horarios = JSON.parse(result);
            if(horarios.length > 0){
                elementos.$selectHorario.prop("disabled", false);
                elementos.$selectHorario.append('<option value="0">Selecciona un horario</option>');
                horarios.forEach(p => {
                    let idGrupo = p.grupo_id;
                    let horarioDescripcion = p.horario_descripcion;
                    elementos.$selectHorario.append(`<option value="${idGrupo}">${horarioDescripcion}</option>`);
                });
            }else{
                elementos.$selectHorario.prop("disabled", true);
                elementos.$selectHorario.append('<option value="0">No hay horarios registrados</option>');
            }
        });
    };

    function validarSeleccionAlumno(alumno){
        var ret = false;
        if(alumno == "" || alumno == null || alumno == undefined || alumno == 0){
            Swal.fire({
                position: 'center',
                icon: 'error',
                title: 'debe seleccionar un alumno',
                showConfirmButton: false,
                timer: 2000
            });
            ret = false;
        }else{
            ret = true;
        }
        return ret;
    };

    function validarSeleccionHorario(horario){
        var result = false;
        if(horario == "" || horario == null || horario == undefined || horario == 0){
            Swal.fire({
                position: 'center',
                icon: 'error',
                title: 'debe seleccionar un horario',
                showConfirmButton: false,
                timer: 2000
            });
            result = false;
        }else{
            result = true;
        }
        return result;
    };

    function AgregarInscripcion(datos){
        $.post(uris.add, datos, "JSON").done(function(result){
            var dato = JSON.parse(result);
            if(parseInt(dato.resultado) == 1){
                var titulo = "Has quedado correctamente inscrito!!";
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: titulo,
                    confirmButtonColor: '#9A2840 ',
                    text: 'Pronto serás agregado a un grupo de WhatsApp para recibir información sobre tu primera sesión.',
                    showClass: {
                        popup: 'animate__animated animate__zoomInDown'
                    },
                    hideClass: {
                        popup: 'animate__animated animate__zoomOutUp'
                    }
                }).then(result => {
                    if(result.isConfirmed){
                        location.reload();
                    }
                });
            }else{
                Swal.fire({
                    position: 'center',
                    icon: 'error',
                    title: 'El horario seleccionado ha alcanzado el maximo de inscripciones',
                    text: 'selecciona otro horario',
                    confirmButtonColor: '#9A2840',
                    showClass: {
                        popup: 'animate__animated animate__zoomInDown'
                    },
                    hideClass: {
                        popup: 'animate__animated animate__zoomOutUp'
                    }
                })
            }
        });
    };

}());