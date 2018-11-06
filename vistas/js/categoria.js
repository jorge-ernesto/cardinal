var tabla;

function init() {
    limpiarForm();
    mostrarForm(false);
    listar();
}
init();

function listar() {
    tabla = $('#table_id').dataTable({
        'aProcessing': true,
        'aServerSide': true,
        ajax: {
            method: 'get',
            url: '../controlador/controladorCategoria.php?action=listar',
            dataType: 'json',
            error: function(e) {
                console.log(e.responseText);
            }
        },
        'iDisplayLength': 5,
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5', 'csvHtml5', 'excelHtml5', 'pdf'
        ],
    });
}

function mostrar(id) {
    $.post('../controlador/controladorCategoria.php?action=mostrar', {idCategoria:id}, function(data) {
        data = JSON.parse(data);

        mostrarForm(true);
        $('#id').val(data.idcat);
        $('#nombre').val(data.nom_cat);
        $('#descripcion').val(data.des_cat);
    });
}

$('#formulario').on('submit', function() {
    guardar();
});

function guardar() {
    $('#btn-enviar').attr('disabled', true); // Si usamos boolean no usar comillas simples
    var formData = new FormData($('#formulario')[0]);

    $.ajax({
        data: formData,
        method: 'post',
        url: '../controlador/controladorCategoria.php?action=guardar',
        contentType: false,
        processData: false,
        success: function(datos) {
            limpiarForm();
            bootbox.alert(datos);
            mostrarForm(false);
            tabla.api().ajax.reload();
        }
    });
}

function desactivar(id) {
    bootbox.confirm('¿Está seguro de desactivar la categoría?',
    function(result){
        $.post('../controlador/controladorCategoria.php?action=desactivar', {idCategoria:id}, function(data) {
            bootbox.alert(data);
            tabla.api().ajax.reload();
        });
    });
}

function activar(id) {
    bootbox.confirm('¿Está seguro de activar la categoría?', function(result) {
        if (result) {
            $.post('../controlador/controladorCategoria.php?action=activar', {idCategoria:id}, function(data) {
                bootbox.alert(data);
                tabla.api().ajax.reload();
            });
        }
    });
}

/*************** weas ***************/

function limpiarForm() {
    $('#id').val('');
    $('#nombre').val('');
    $('#descripcion').val('');
}

function mostrarForm(posta) {
    if (posta == true) {
        $('#listado-registros').hide();
        $('#formulario-registros').show();
        $('#btn-enviar').attr('disabled', false);
    } else {
        $('#listado-registros').show();
        $('#formulario-registros').hide();
        $('#btn-enviar').attr('disabled', true);
    }
}

function cancelarForm() {
    limpiarForm();
    mostrarForm(false);
}
