// Funciones dinámicas con Jquery y Ajax

var tabla;

// Función que se ejecuta al inicio
function init() {
    mostrarForm(false);
    listar();
}

// Función limpiar
function limpiar() {
    $('#idcategoria').val('');
    $('#nombre').val('');
    $('#descripcion').val('');
}

// Función mostrar formulario
function mostrarForm(flag) {
    limpiar();
    if (flag) { // Si flag es true
        $('#listado-registros').hide();
        $('#formulario-registros').show();
        $('#btn-guardar').prop('disabled', 'false'); // Equivalente a .attr(), .prop() agrega atributos, y además propiedades
    } else {
        $('#listado-registros').show();
        $('formulario-registros').hide();
    }
}

// Función cancelar formulario
function cancelarForm() {
    limpiar();
    mostrarForm(false);
}

// Función listar
function listar () {
    tabla = $('#tbl-listado').DataTable({
        'aProcessing': 'true', // Activamos el procesamiento de datatables
        'aServerSide': 'true', // Paginación y filtrado realizados por el servidor
        'dom': 'Bfrtip', // Definimos los elementos del control de tabla
        'buttons': [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdf'                    
        ],
        ajax: {
            url: '../ajax/categoria.php?op=listar',
            type: 'get',
            dataType: 'json',
            error: function(e) {
                console.log(e.responseText);
            }
        },
        'bDestroy': 'true',
        'iDisplayLength': 5, // Cada cuanto registros se realiza la paginación
        'order': [[0, 'desc']]  // Orden de datos, utilizamos la columna 0 que seria el idcategoria, y ordenamos de forma descendente
    });
}

init();
