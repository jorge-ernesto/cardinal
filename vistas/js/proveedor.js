var tabla;

function init() {
    limpiarForm();
    mostrarForm(false);
    listar();

    select();
}
init();

function listar() {
    tabla = $('#table_id').DataTable({
        "processing": true,
        "serverSide": false,
        ajax: {
            method: 'post',
            url: '../controlador/controladorPersona.php?action=listarProveedor',
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

    $('.dt-buttons button').removeClass('btn-secondary');
    $('.dt-buttons button').addClass('btn-primary');
}

function buscar(id) {
    $.post('../controlador/controladorPersona.php?action=buscar', {id:id}, function(data) {
        data = JSON.parse(data);

        mostrarForm(true);
        $('#id').val(data.id);
        $('#nombre').val(data.nombre);
        $('#tipoDocumento').val(data.tipo_documento); $('#tipoDocumento').selectpicker('refresh');
        $('#numDocumento').val(data.num_documento);
        $('#direccion').val(data.direccion);
        $('#telefono').val(data.telefono);
        $('#email').val(data.email);
    });
}

$('#formulario').on('submit', function(e) {
    guardar(e);
});

function guardar(e) {
    e.preventDefault();
    $('#crear').attr('disabled', true);
    var formData = new FormData($('#formulario')[0]);

    $.ajax({
        data: formData,
        method: 'post',
        url: '../controlador/controladorPersona.php?action=guardar',
        contentType: false,
        processData: false,
        success: function(data) {
            limpiarForm();
            mostrarForm(false);
            tabla.ajax.reload();
            if (data == 'Persona creada con éxito' || data == 'Persona editada con éxito') {
                swal(data, 'You clicked the button!', 'success')
            } else {
                swal(data, 'You clicked the button!', 'error')
            }
        }
    });
}

function eliminar(id) {
    swal({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.value) {
            $.post('../controlador/controladorPersona.php?action=eliminar', {id:id}, function(data) {
                tabla.ajax.reload();
                swal(data, 'You clicked the button!', 'success')
            });
        }
    })
}

function select() {
    $('#tipoDocumento').val('DNI'); $('#tipoDocumento').selectpicker('refresh');
}

/*************** weas ***************/

function limpiarForm() {
    $('#id').val('');
    $('#nombre').val('');
    // $('#tipoDocumento').val('');
    $('#numDocumento').val('');
    $('#direccion').val('');
    $('#telefono').val('');
    $('#email').val('');

    $('#tipoDocumento').val($('option:first', select).val());
}

function mostrarForm(posta) {
    if (posta == true) {
        $('#listadoRegistros').hide();
        $('#formularioRegistros').show();
        $('#crear').attr('disabled', false);
    } else {
        $('#listadoRegistros').show();
        $('#formularioRegistros').hide();
        $('#crear').attr('disabled', true);
    }
}

function cancelarForm() {
    limpiarForm();
    mostrarForm(false);
}
