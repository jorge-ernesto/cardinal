var tabla;

function init() {
    limpiarForm();
    mostrarForm(false);
    listar();
}
init();

function listar() {
    tabla = $('#table_id').DataTable({
        "processing": true,
        "serverSide": false,
        ajax: {
            method: 'get',
            url: '../controlador/controladorCategoria.php?action=listar',
            dataType: 'json',
            error: function(e) {
                console.log(e.responseText);
            }
        },
        language: {
            "sProcessing":     "Procesando...",
            "sLengthMenu":     "Mostrar _MENU_ registros",
            "sZeroRecords":    "No se encontraron resultados",
            "sEmptyTable":     "Ningún dato disponible en esta tabla",
            "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix":    "",
            "sSearch":         "Buscar:",
            "sUrl":            "",
            "sInfoThousands":  ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst":    "Primero",
                "sLast":     "Último",
                "sNext":     "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
        },
        "lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
        "pageLength": 10,
        dom: 'Bfrtip', // Blfrtip
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print', 'pageLength'
        ]
    });
}
wea();

function mostrar(id) {
    $.post('../controlador/controladorCategoria.php?action=mostrar', {idCategoria:id}, function(data) {
        data = JSON.parse(data);

        mostrarForm(true);
        $('#id').val(data.id);
        $('#nombre').val(data.nombre);
        $('#descripcion').val(data.descripcion);
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
            tabla.ajax.reload();
        }
    });
}

function desactivar(id) {
    bootbox.confirm('¿Está seguro de desactivar la categoría?',
    function(result){
        if (result) {
            $.post('../controlador/controladorCategoria.php?action=desactivar', {idCategoria:id}, function(data) {
                bootbox.alert(data);
                tabla.ajax.reload();
            });
        }
    });
}

function activar(id) {
    bootbox.confirm('¿Está seguro de activar la categoría?',
    function(result){
        if (result) {
            $.post('../controlador/controladorCategoria.php?action=activar', {idCategoria:id}, function(data) {
                bootbox.alert(data);
                tabla.ajax.reload();
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

function wea() {
    var div = $('<div class="row">\n\
                 <div id="div" class="col-sm-12 col-md-7">\n\
                 </div>\n\
                 <div id="div2" class="col-sm-12 col-md-5">\n\
                 </div>\n\
                 </div>');
    $('#table_id').before(div);
    $('#wea').appendTo('#div');
    $('.dt-buttons').appendTo('#div');
    $('#table_id_filter').appendTo('#div2');

    var div2 = $('<div class="row">\n\
                 <div id="div3" class="col-sm-12 col-md-5">\n\
                 </div>\n\
                 <div id="div4" class="col-sm-12 col-md-7">\n\
                 </div>\n\
                 </div>');
    $('#table_id').after(div2);
    $('#table_id_info').appendTo('#div3');
    $('#table_id_paginate').appendTo('#div4');

    //    $('.dt-buttons').addClass('mb-2');

    $('.dt-buttons button').removeClass('btn-secondary');
    $('.dt-buttons button').addClass('btn-primary');
}
