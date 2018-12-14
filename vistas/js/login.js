$('#formulario').on('submit', function(e) {
    e.preventDefault();
    username = $('#username').val();
    password = $('#password').val();

    $.post('../controlador/controladorUsuario.php?action=login', {username:username, password:password}, function(data) {
        data = JSON.parse(data);

        if (data == null) {
            swal('Login', 'Error en el login: Nombre de usuario o contraseña incorrecta, por favor vuelva a intentarlo', 'error')
        } else {
            // $(location).attr('href', 'listarCategoria.php')
            swal('Login', 'Hola ' + data.nombre + ' haz iniciado sesión con éxito', 'success')
        }
    });
});
