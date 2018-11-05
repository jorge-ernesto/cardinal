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
        'dom': 'Bfrtip',
        'buttons': [
            'copyHtml5', 'csvHtml5', 'excelHtml5', 'pdf'
        ],
    });
}

$('#formulario').on('submit', function() {
    guardar();
});

function guardar() {
    $('#btn-enviar').attr('disabled', true);
    var formData = new FormData($('#formulario')[0]);

    $.ajax({
        data: formData,
        method: 'post',
        url: '../controlador/controladorCategoria.php?action=guardar',
        contentType: false,
        processData: false,
        success: function(datos) {
            limpiarForm();
            bootbox.alert(datos); // Muestra el mensaje de confirmación
            mostrarForm(false);
            tabla.api().ajax.reload(); // Recarga, actualiza DATATABLES
        }
    });
}

function mostrar(idcategoria) { // Función mostrar, permite que podamos editar
    $.post('../controlador/controladorCategoria.php?action=mostrar', {varIdCategoria : idcategoria}, function(datos, status, objeto) { // Datos que retornan, estado de la petición, Objetos de la peticion
        datos = JSON.parse(datos);
        mostrarForm(true);

        $('#idcategoria').val(datos.idcat);
        $('#nombre').val(datos.nom_cat);
        $('#descripcion').val(datos.des_cat);
    });
}

function desactivar(idcategoria) { // Función para desactivar registros
    bootbox.confirm('¿Está seguro de desactivar la categoría?', function(result) {
        if (result) { // Si la respuesta es Ok
            $.post('../controlador/controladorCategoria.php?action=desactivar', {varIdCategoria : idcategoria}, function(datos, status, objeto) {
                bootbox.alert(datos);
                tabla.api().ajax.reload();
            });
        } else { // Si la respuesta es Cancel
//            bootbox.alert('KKK');
        }
    });
}

function activar(idcategoria) { // Función para activar registros
    bootbox.confirm('¿Está seguro de activar la categoría?', function(result) {
        if (result) {
            $.post('../controlador/controladorCategoria.php?action=activar', {varIdCategoria : idcategoria}, function(datos) {
                bootbox.alert(datos);
                tabla.api().ajax.reload();
            });
        }
    });
}

/*************** weas ***************/

function limpiarForm() { // Función limpiarForm
    $('#idcategoria').val('');
    $('#nombre').val('');
    $('#descripcion').val('');
}

function mostrarForm(flag) { // Función mostrar formulario
    if (flag == true) {
        $('#listado-registros').hide();
        $('#formulario-registros').show();
        $('#btn-enviar').attr('disabled', false); // Cuando se de click en el boton agregar, el boton guardar se habilitara // Equivalente a .attr(), .attr() agrega atributos, y además attriedades

    } else {
        $('#listado-registros').show();
        $('#formulario-registros').hide();
    }
}

function cancelarForm() { // Función cancelar formulario
    limpiarForm();
    mostrarForm(false);
}
