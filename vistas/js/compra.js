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
    $.post('../controlador/controladorCompra.php?action=buscar', {id:id}, function(data) {
        data = JSON.parse(data);

        mostrarForm(true);
        $('#id').val(data.id);        
        $('#idProveedor').val(data.id_proveedor); $('#idProveedor').selectpicker('refresh');
        $('#tipoComprobante').val(data.tipo_comprobante); $('#tipoComprobante').selectpicker('refresh');        
        $('#serieComprobante').val(data.serie_comprobante);
        $('#numComprobante').val(data.num_comprobante);
        $('#fechaHora').val(data.fecha); // fecha es fecha_hora en la tabla, fue formateada en la consulta
        $('#impuesto').val(data.impuesto);
                
        /****/
                
        $('#impuesto').attr('readonly', true);
        $('#divArticulos').hide();
        $('#thEliminar').hide();
        $('#crear').hide();  
        $('#cancelarCompra').hide();
    });
    
    $.post('../controlador/controladorCompra.php?action=buscarDetalle', {id:id}, function(data) {        
        $('#cargarDetalleVenta').html(data);                        
        calcularImporte(id);
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
            if (data == 'Error: La compra debe tener productos para ser creada') {
                cancelarCompra(); // limpiarForm();
                $('#crear').attr('disabled', false);
                tabla.ajax.reload();
                tabla2.ajax.reload();
                swal(data, 'You clicked the button!', 'error')
            } else {
                cancelarCompra(); // limpiarForm();
                mostrarForm(false);
                tabla.ajax.reload();
                tabla2.ajax.reload();
                if (data == 'Compra creada con éxito') {                
                    swal(data, 'You clicked the button!', 'success')
                } else {                
                    swal(data, 'You clicked the button!', 'error')
                }
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
        $('#idProveedor').html(data);
        $('#idProveedor').selectpicker('refresh');
    });
    
    $('#tipoComprobante').val('Boleta'); $('#tipoComprobante').selectpicker('refresh');
}

function date() {
    var now = new Date();
    var day = ("0" + now.getDate()).slice(-2);
    var month = ("0" + (now.getMonth() + 1)).slice(-2);
    var today = now.getFullYear()+"-"+(month)+"-"+(day) ;
    $('#fechaHora').val(today);
    
    /*
    Date.prototype.toDateInputValue = (function() {
        var local = new Date(this);
        local.setMinutes(this.getMinutes() - this.getTimezoneOffset());
        return local.toJSON().slice(0,10);
    });
    $('#fechaHora').val(new Date().toDateInputValue());
    */       
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
//    $('#tipoComprobante').val('');
//    $('#serieComprobante').val('');
//    $('#numComprobante').val('');
//    $('#fechaHora').val('');
    $('#impuesto').val('0');

    $('#idProveedor').val($('option:first', select).val());
    $('#tipoComprobante').val($('option:first', select).val());
}

function cancelarCompra() {
    $('#id').val('');
    $('#serieComprobante').val('Synthesis 001');
    $('#numComprobante').val('Autogenerado');
    date();
    $('#impuesto').val('0');
    
    $('#idProveedor').val($('option:first', select).val());
    $('#tipoComprobante').val($('option:first', select).val());
    
    /*****/
    
    $('tr[id^="row_"]').each(function() {
        $(this).remove();
    });
    calcularGranTotal();        
    
    /*****/
    
    $('#granTotal').text('Total');
    $('#granTotal2').val('');
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
    cancelarCompra(); // limpiarForm();
    mostrarForm(false);
    
    /****/
                
    $('#impuesto').attr('readonly', false);
    $('#divArticulos').show();
    $('#thEliminar').show();
    $('#crear').show();  
    $('#cancelarCompra').show();
}

/*************** weas ***************/

function agregar(id, nombre) {
    if (hasProducto(id)) {
        incrementaCantidad(id);
        return false; // No ejecuta el siguiente método, como un else
    }

    var response = '<tr id="row_'+ id +'">' +
                        '<td class="d-none">' +
                            '<input type="hidden" name="item_id[]" value="'+ id +'"></input>' +
                        '</td>' +
                        '<td>'+ nombre +'</td>' +
                        '<td style="width: 150px;">' +
                            '<input class="form-control col-sm-8" id="precioCompra_'+ id +'" type="number" name="precioCompra[]" value="1" min="1" step="any" onchange="calcularImporte(' + id + ');" required></input>' +
                        '</td>' +
                        '<td style="width: 150px;">' +
                            '<input class="form-control col-sm-8" id="precioVenta_'+ id +'" type="number" name="precioVenta[]" value="1" min="1" step="any" required></input>' +
                        '</td>' +
                        '<td style="width: 120px;">' +
                            '<input class="form-control col-sm-8" id="cantidad_'+ id +'" type="number" name="cantidad[]" value="1" min="1" onchange="calcularImporte(' + id + ');" required></input>' +
                        '</td>' +
                        '<td>' +
                            '<span id="totalImporte_'+ id +'">1</span>' +
                        '</td>' +
                        '<td>' +
                            '<button type="button" class="btn btn-sm btn-danger" onclick="eliminar(' + id + ');">Eliminar</button>' +
                        '</td>' +
                    '</tr>';
    $('#cargarDetalleVenta').append(response);            
        
    calcularImporte(id);
}

function eliminar(id) {
    $('#row_' + id).remove();
    calcularGranTotal();
}

function calcularImporte(id) {
    var precio = $('#precioCompra_' + id).val();
    var cantidad = $('#cantidad_' + id).val(); 
    $('#totalImporte_' + id).text((parseFloat(precio) * parseInt(cantidad)).toFixed(2));
    calcularGranTotal();
}

function calcularGranTotal() {
    var total = 0;
    $('span[id^="totalImporte_"]').each(function() { // All elements with a title attribute value starting with "totalImporte_"
        total += parseFloat($(this).text());
    });
    $('#granTotal').text(total.toFixed(2));
    $('#granTotal2').val(total.toFixed(2));
}

function hasProducto(id) {
    var resultado = false;

    $('input[name="item_id[]"]').each(function() { // Referenciamos cada input que tenga name="item_id[]"
        if( parseInt(id) == parseInt($(this).val()) ) {
            resultado = true;
        }
    });

    return resultado;
}

function incrementaCantidad(id) {
    var cantidad = $('#cantidad_' + id).val() ? parseInt($('#cantidad_' + id).val()) : 0;
    $('#cantidad_' + id).val(++cantidad);
    calcularImporte(id);
}

function cambiaImpuesto() {
    var tipoComprobante = $("#tipoComprobante option:selected").text();
    if (tipoComprobante == 'Factura') {
        $("#impuesto").val("18"); 
    } else {
        $("#impuesto").val("0"); 
    }
}