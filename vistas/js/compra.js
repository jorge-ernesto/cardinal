var tabla;
var tabla2;

function init() {
    limpiarForm();
    mostrarForm(false);
    listar(); 
    listarArticulosActivos();
    
    select();    
    date();
}
init();

function listar() {
    tabla = $('#table_id').DataTable({
        "processing": true,
        "serverSide": false,
        ajax: {
            method: 'post',
            url: '../controlador/controladorCompra.php?action=listar',
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
    
    wea();
}

function buscar(id) {
    $.post('../controlador/controladorCompra.php?action=buscar', {id:id}, function(data) {
        data = JSON.parse(data);

        mostrarForm(true);
        $('#id').val(data.id);
        $('#nombre').val(data.nombre);
        $('#descripcion').val(data.descripcion);
    });
}

$('#formulario').on('submit', function(e) {
    guardar(e);
});

function guardar(e) {
    e.preventDefault(); // avoid to execute the actual submit of the form
    $('#crear').attr('disabled', true); // Si usamos boolean no usar comillas simples
    var formData = new FormData($('#formulario')[0]);

    $.ajax({
        data: formData, // Lo que se envie a través de variables se obtiene por el método que se especifique
        method: 'post',
        url: '../controlador/controladorCompra.php?action=guardar', // Lo que se envia a través de la url se obtiene por el método get
        contentType: false,
        processData: false,
        success: function(data) {
            limpiarForm();
            mostrarForm(false);
            tabla.ajax.reload();
            if (data == 'Compra creada con éxito') {
                swal(data, 'You clicked the button!', 'success')
            } else {
                swal(data, 'You clicked the button!', 'error')
            }
        }
    });
}

function anular(id) {
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
            $.post('../controlador/controladorCompra.php?action=anular', {id:id}, function(data) {
                tabla.ajax.reload();
                swal(data, 'You clicked the button!', 'success')
            });
        }
    })
}

function select() {
    $.post('../controlador/controladorCompra.php?action=selectProveedor', function(data) {
        $('#proveedor').html(data);
        $('#proveedor').selectpicker('refresh');
    });
    
    $('#tipoComprobante').val('Boleta'); $('#tipoComprobante').selectpicker('refresh');
}

function ver() {    
    $('#exampleModal').modal('show');    
}

function listarArticulosActivos() {
    tabla2 = $('#table_id_2').DataTable({
        "processing": true,
        "serverSide": false,
        ajax: {
            method: 'post',
            url: '../controlador/controladorCompra.php?action=listarArticulosActivos',
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
            'pageLength'
        ]
    });
    
    var div3 = $('<div class="row">\n\
                 <div id="div5" class="col-sm-12 col-md-7">\n\
                 </div>\n\
                 <div id="div6" class="col-sm-12 col-md-5">\n\
                 </div>\n\
                 </div>');
    $('#table_id_2').before(div3);    
    $('#table_id_2_wrapper .dt-buttons').appendTo('#div5');
    $('#table_id_2_filter').appendTo('#div6');

    var div4 = $('<div class="row">\n\
                 <div id="div7" class="col-sm-12 col-md-5">\n\
                 </div>\n\
                 <div id="div8" class="col-sm-12 col-md-7">\n\
                 </div>\n\
                 </div>');
    $('#table_id_2').after(div4);
    $('#table_id_2_info').appendTo('#div7');
    $('#table_id_2_paginate').appendTo('#div8');    


    $('#table_id_2_wrapper .dt-buttons button').removeClass('btn-secondary');
    $('#table_id_2_wrapper .dt-buttons button').addClass('btn-primary');
}

/*************** weas ***************/

function limpiarForm() {
    $('#id').val('');
//    $('#idProveedor').val('');
//    $('#idUsuario').val('');
//    $('#tipoComprobante').val('');
//    $('#serieComprobante').val('');
//    $('#numComprobante').val('');
//    $('#fechaHora').val('');
//    $('#impuesto').val('');
    $('#totalCompra').val('');
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

    // $('.dt-buttons').addClass('mb-2');

    $('.dt-buttons button').removeClass('btn-secondary');
    $('.dt-buttons button').addClass('btn-primary');
}

function date() {
    Date.prototype.toDateInputValue = (function() {
        var local = new Date(this);
        local.setMinutes(this.getMinutes() - this.getTimezoneOffset());
        return local.toJSON().slice(0,10);
    });

    $('#fechaHora').val(new Date().toDateInputValue());
}

/*************** weas ***************/

function agregar(id, nombre) {
    // if (hasProducto(id)) {
    //     incrementaCantidad(id, precio);
    //     return false; // No ejecuta el siguiente método, como un else
    // }

        var response = '<tr id="row_'+ id +'">' +
                            '<td class="d-none">' +
                                '<input type="hidden" name="item_id[]" value="'+ id +'"></input>' +
                            '</td>' +
                            '<td>'+ nombre +'</td>' +
                            '<td>${pro[2]}</td>' +
                            '<td>${pro[3]}</td>' +
                            '<td>' +
                                '<input class="form-control col-sm-4" id="cantidad_${pro[0]}" type="number" name="cantidad[]" value="1" min="1" onchange="calcularImporte(${pro[0]}, ${pro[2]}, this.value);"></input>' +
                            '</td>' +
                            '<td>' +
                                '<span id="totalImporte_${pro[0]}">${pro[2]}</span>' +
                            '</td>' +
                            '<td>' +
                                '<button type="button" class="btn btn-sm btn-danger" onclick="eliminar( ${pro[0]} );">Eliminar</button>' +
                            '</td>' +
                        '</tr>';

    $('#cargarDetalleVenta').append(response);            
}