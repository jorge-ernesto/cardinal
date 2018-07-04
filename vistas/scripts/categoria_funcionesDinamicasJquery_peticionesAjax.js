// Funciones dinámicas con Jquery y peticiones Ajax

var tabla;

function init() { // Función que se ejecuta al inicio
    limpiar();
    mostrarForm(false);
    listar();

    $('#formulario').on('submit', function(e) {
        insertar_editar(e);
    });
}

function limpiar() { // Función limpiar
    $('#idcategoria').val('');
    $('#nombre').val('');
    $('#descripcion').val('');
}

function mostrarForm(flag) { // Función mostrar formulario
    if (flag) { // Si flag es true
        $('#listado-registros').hide();
        $('#formulario-registros').show();
        $('#btn-guardar').prop('disabled', false); // Cuando se de click en el boton agregar, el boton guardar se habilitara // Cuando se de click en el boton agregar, este se deshabilitara // Equivalente a .attr(), .prop() agrega atributos, y además propiedades

    } else {
        $('#listado-registros').show();
        $('#formulario-registros').hide();
    }
}

function cancelarForm() { // Función cancelar formulario
    limpiar();
    mostrarForm(false);
}

function listar() { // Función listar
    tabla = $('#tbl-listado').dataTable({
        'aProcessing': true, // Activamos el procesamiento de DATATABLES
        'aServerSide': true, // Paginación y filtrado realizados por el servidor
        'dom': 'Bfrtip', // Definimos los elementos del control de tabla
        'buttons': [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdf'
        ],
        ajax: {
            url: '../controlador/controladorCategoria.php?op=listar', // Ejecuta la petición Ajax
            type: 'get',
            dataType: 'json',
            error: function(e) {
                console.log(e.responseText);
            }
        },
        'bDestroy': true,
        'iDisplayLength': 5, // Cada cuanto registros se realiza la paginación de registros
        'order': [[0, 'asc']]  // desc // Orden de datos, utilizamos la columna 0 que seria el idcategoria, y ordenamos de forma ascendente
    });
}

function insertar_editar(e) { // Función para guardar ó editar
    e.preventDefault(); // No se activará la acción predeterminada del evento // Evitamos que al dar click, se agregue en la barra de busqueda el caracter de #, es decir que te envie a la página
    $('#btn-guardar').prop('disabled', true);
    var formData = new FormData($('#formulario')[0]); // Todos los datos del formulario son enviados a la variable $formData

    $.ajax({
        url: '../controlador/controladorCategoria.php?op=insertar_editar', // Ejecuta la petición Ajax
        type: 'post',
        data: formData,
        contentType: false,
        processData: false,
        success: function(datos) {
            limpiar();
            bootbox.alert(datos); // Muestra el mensaje de confirmación
            mostrarForm(false);
            tabla.api().ajax.reload(); // Recarga, actualiza DATATABLES
        }
    });
}

function mostrar(idcategoria) { // Función mostrar, permite que podamos editar
    $.post('../controlador/controladorCategoria.php?op=mostrar', {idcategoria : idcategoria}, function(datos, status) { // Ejecuta la petición Ajax, no lo envia hacia el parametro de la función, sino hacia el value de la etiqueta id="idcategoria"
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
            $.post('../controlador/controladorCategoria.php?op=desactivar', {idcategoria : idcategoria}, function(datos) { // Ejecuta la petición Ajax, no lo envia hacia el parametro de la función, sino hacia el value de la etiqueta id="idcategoria"
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
            $.post('../controlador/controladorCategoria.php?op=activar', {idcategoria : idcategoria}, function(datos) { // Ejecuta la petición Ajax, no lo envia hacia el parametro de la función, sino hacia el value de la etiqueta id="idcategoria"
                bootbox.alert(datos);
                tabla.api().ajax.reload();
            });
        } else {
//            bootbox.alert('KKK');
        }
    });
}

init();
