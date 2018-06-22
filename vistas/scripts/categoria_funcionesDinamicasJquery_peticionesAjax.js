// Funciones dinámicas con Jquery y peticiones Ajax

var tabla;

// Función que se ejecuta al inicio
function init() {
    limpiar();
    mostrarForm(false);
    listar();
    
    $('#formulario').on('submit', function(e) {
        guardaryeditar(e);
    });
}

// Función limpiar
function limpiar() {
    $('#idcategoria').val('');
    $('#nombre').val('');
    $('#descripcion').val('');
}

// Función mostrar formulario
function mostrarForm(flag) {    
    if (flag) { // Si flag es true
        $('#listado-registros').hide();
        $('#formulario-registros').show();
        $('#btn-guardar').prop('disabled', false); // Cuando se de click en el boton agregar, el boton guardar se habilitara // Cuando se de click en el boton agregar, este se deshabilitara // Equivalente a .attr(), .prop() agrega atributos, y además propiedades

    } else {
        $('#listado-registros').show();
        $('#formulario-registros').hide();
    }
}

// Función cancelar formulario
function cancelarForm() {
    limpiar();
    mostrarForm(false);
}

// Función listar
function listar() {
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
            url: '../ajax/categoria.php?op=listar', // Petición Ajax
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

// Función para guardar ó editar
function guardaryeditar(e) {
    e.preventDefault(); // No se activará la acción predeterminada del evento
    $('#btn-guardar').prop('disabled', true);
    var formData = new FormData($('#formulario')[0]); // Todos los datos del formulario son enviados a la variable $formData
    
    $.ajax({
        url: '../ajax/categoria.php?op=guardaryeditar', // Petición Ajax
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

// Función mostrar, permite que podamos editar
function mostrar(idcategoria) {
    $.post('../ajax/categoria.php?op=mostrar', {idcategoria : idcategoria}, function(datos, status) { // Petición Ajax
        datos = JSON.parse(datos);
        mostrarForm(true);
            
        $('#idcategoria').val(datos.idcategoria);
        $('#nombre').val(datos.nombre);
        $('#descripcion').val(datos.descripcion);            
    });
}

// Función para desactivar registros
function desactivar(idcategoria) {
    bootbox.confirm('¿Está seguro de desactivar la categoría?', function(result) {
        if (result) { // Si la respuesta es Ok
            $.post('../ajax/categoria.php?op=desactivar', {idcategoria : idcategoria}, function(datos) { // Peticion Ajax
                bootbox.alert(datos);
                tabla.api().ajax.reload();
            });
        } else { // Si la respuesta es Cancel
//            bootbox.alert('KKK');
        }
    });
}

// Función para activar registros
function activar(idcategoria) {
    bootbox.confirm('¿Está seguro de activar la categoría?', function(result) {
        if (result) {
            $.post('../ajax/categoria.php?op=activar', {idcategoria : idcategoria}, function(datos) { // Peticion Ajax
                bootbox.alert(datos);
                tabla.api().ajax.reload();
            });            
        } else {
//            bootbox.alert('KKK');
        }
    });
}

init();
