$('#formularioLogin').on('submit', function(e) {
    e.preventDefault();
    username = $('#username').val();
    password = $('#password').val();

    $.post('../controlador/controladorUsuario.php?action=login', {username:username, password:password}, function(data) {
        data = JSON.parse(data);

        if (data == null) {
            swal('Login', 'Error en el login: Nombre de usuario o contraseña incorrecta, por favor vuelva a intentarlo', 'error')
        } else {
            // swal('Login', 'Hola ' + data.nombre + ' haz iniciado sesión con éxito', 'success')
            // $(location).attr('href', 'listarCategoria.php')

            swal({
                title: 'Hola ' + data.nombre + ' haz iniciado sesión con éxito',
                width: 600,
                padding: '3em',
                background: '#fff url(vendors/img/trees.png)',
                backdrop: `
                rgba(0,0,123,0.4)
                url("vendors/img/nyan-cat.gif")
                center left
                no-repeat
                `
            }).then((result) => {
                if (result.value) {
                    $(location).attr('href', 'listarCategoria.php');
                    // location.href='listarCategoria.php';
                }
            })
        }
    });
});
