(function(){
    "use strict";

    gobPuebla = gobPuebla ? gobPuebla : {};
    gobPuebla.login = gobPuebla.login ? gobPuebla.login : {};

    gobPuebla.login.elements = {
        btnEntrarLogin: $("#btnEntrar"),
        btnEnviarCorreoRecuperacion: $("#btnEnviarCorreoRecuperacion"),
        btnConfirmaRecuperacion: $("#btnConfirmarNuevaContrasenia"),
        $form: $("#formLogin"),
        $formRecuperar: $("#formRecuperarContrasenia"),
        $correoRecuperacion: $("#txtCorreoRecuperar"),
        $inputCodigo: $("#txtCodigoRecuperacion"),
        $inputContraseniaNueva: $("#txtNuevaContrasenia")

    };

    gobPuebla.login.uris = {
        inicioLogin :  gobPuebla.base.url + "Login/index",
        iniciarSesion :  gobPuebla.base.url + "Login/IniciarSesion",
        GenerarCodigo: gobPuebla.base.url + "Login/GenerarCodigo",
        vistaCodigo: gobPuebla.base.url + "Login/VistaCodigo",
        getUsuarioPorCodigo: gobPuebla.base.url + "Login/GetUserCodigo",
        ActualizarContrasenia: gobPuebla.base.url + "Login/UpdateContrasenia",
        eliminarCodigo: gobPuebla.base.url + "Login/EliminarCodigo"
    };

    var element = gobPuebla.login.elements;
    var uri = gobPuebla.login.uris;

    initForm();
    initFormRecuperar();

    element.btnEntrarLogin.click(function(e){
        e.preventDefault();

        var model = {
            'txtCorreo': $("#txtCorreo").val(),
            'txtContrasenia': $("#txtContrasenia").val()
        }

        $.post(uri.iniciarSesion,model)
        .done(function(result){
            var datos = JSON.parse(result);

            if(datos != false){
                var titulo = "Acceso Correcto";
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: titulo,
                    showConfirmButton: false,
                    timer: 1500
                }).then(result => {
                    if(result){
                        window.location.replace(gobPuebla.base.url);
                    }
                });
                
            }else{
                var titulo = "Usuario o contraseña incorrecta";
                alertaMensajeDenied(titulo);
                
            }
        });
    });

    element.btnEnviarCorreoRecuperacion.click(function(e){
        e.preventDefault();

        var correo = element.$correoRecuperacion.val();

        if (!element.$formRecuperar.valid()) {
            var titulo = "El campo no puede quedar vacio o no es un correo valido";
            alertaMensajeDenied(titulo);
            return false;
        }

        var model = {
            'correoRecuperacion': correo
        }
        $.post(uri.GenerarCodigo, model)
        .done(function(result){
            var datos = JSON.parse(result);
            if(datos == -1){
                var titulo = "El correo no existe, favor de verificarlo";
                alertaMensajeDenied(titulo);
            }else{
                var titulo = "Código de verificación enviado";
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: titulo,
                    showConfirmButton: false,
                    timer: 1500
                }).then(result => {
                    if(result){
                        window.location.replace(uri.vistaCodigo);
                    }
                });
            }
        });
    });

    element.btnConfirmaRecuperacion.click(function(e){
        e.preventDefault();

        var codigo = element.$inputCodigo.val();
        var contrasenia = element.$inputContraseniaNueva.val();
        if(codigo == ""){
            var titulo = "No puede quedar vacio el campo del codigo";
            alertaMensajeDenied(titulo);
            return false;
        }

        if(contrasenia == ""){
            var titulo = "No puede quedar vacio el campo de nueva contraseña";
            alertaMensajeDenied(titulo);
            return false;
        }

        getUserByCodigo(codigo).then(function(resultado){
            var idUsuario = resultado;

            if(idUsuario > 0){

                actualizarContrasenia(idUsuario, contrasenia);
            }else{
                var titulo = "El codigo es incorrecto";
                alertaMensajeDenied(titulo);
            }
        });
    });

    function initForm() {
        element.$form.validate({
            errorPlacement: function () {
                return true;
            }
        });
    };

    function initFormRecuperar(){
        element.$formRecuperar.validate({
            errorPlacement: function () {
                return true;
            }
        });
    };

    function alertaMensajeDenied(titulo){
        Swal.fire({
            position: 'center',
            icon: 'error',
            title: titulo,
            showConfirmButton: false,
            timer: 1500
        });
    };

    function getUserByCodigo(codigo){
        const promesa = $.Deferred();

        var model = {
            'codigo': codigo
        }

        $.post(uri.getUsuarioPorCodigo, model)
        .done(function(result){
            if(result != "" && result != "null" && result != null){
                var datos = JSON.parse(result);
                var idUsuario = datos.IdUsuario;

                promesa.resolve(idUsuario);
            }else{
                var idUsuario = 0;

                promesa.resolve(idUsuario);
            }
        });

        return promesa.promise();
    };

    function actualizarContrasenia(idUsuario, contrasenia){
        var model = {
            'id': idUsuario,
            'pass': contrasenia
        }
        $.post(uri.ActualizarContrasenia, model)
                .done(function(result){
                    var isTrueSet = (result === 'true');
                    if(isTrueSet){

                        var model2 = {
                            'id': idUsuario
                        }
                        $.post(uri.eliminarCodigo, model2)
                        .done(function(result){
                            var isTrueSet = (result === 'true');
                            if(isTrueSet){
                                var titulo = "Se actualizó correctamenta la contraseña";
                                Swal.fire({
                                    position: 'center',
                                    icon: 'success',
                                    title: titulo,
                                    showConfirmButton: false,
                                    timer: 1500
                                }).then(result => {
                                    if(result){
                                        window.location.replace(uri.inicioLogin);
                                    }
                                });
                            }
                        });
                    }else{
                        var titulo = "La contraseña no pudo ser actualizada";
                            alertaMensajeDenied(titulo);
                    }
                });
    };

}());