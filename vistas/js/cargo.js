var tabla;

function init() {
    limpiarForm();
    mostrarForm(false);
    listar();

    permisos();   
}
init();

function listar() {
    tabla = $('#table_id').DataTable({
        "processing": true,
        "serverSide": false,
        ajax: {
            method: 'post',
            url: '../controlador/controladorCargo.php?action=listar',
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
    $('#table_id').before(div);              // Creamos el div antes de id='table_id'
    $('#wea').appendTo('#div');              // Agregamos id='wea' dentro del div
    $('.dt-buttons').appendTo('#div');       // Agregamos class="dt-buttons" dentro del div
    $('#table_id_filter').appendTo('#div2'); // Agregamos id="table_id_filter" dentro del div

    var div2 = $('<div class="row">\n\
                 <div id="div3" class="col-sm-12 col-md-5">\n\
                 </div>\n\
                 <div id="div4" class="col-sm-12 col-md-7">\n\
                 </div>\n\
                 </div>');
    $('#table_id').after(div2);                // Creamos el div2 antes de id='table_id'
    $('#table_id_info').appendTo('#div3');     // Agregamos id="table_id_info" dentro del div2
    $('#table_id_paginate').appendTo('#div4'); // Agregamos id="table_id_paginate" dentro del div2

    $('.dt-buttons button').removeClass('btn-secondary'); // Remueve class="btn-secondary"
    $('.dt-buttons button').addClass('btn-primary');      // Agrega class="btn-primary"
}

function buscar(id) {
    $.post('../controlador/controladorCargo.php?action=buscar', {id:id}, function(data) {                
        data = JSON.parse(data);

        mostrarForm(true);
        $('#id').val(data.id);
        $('#nombre').val(data.nombre);
        $('#descripcion').val(data.descripcion);

        $.post('../controlador/controladorCargo.php?action=permisos&id=' + id, function(data) { // Lo que se envia a través de la url se obtiene por el método get
            $('#permisos').html(data);
        });
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
        url: '../controlador/controladorCargo.php?action=guardar', // Lo que se envia a través de la url se obtiene por el método get
        contentType: false,
        processData: false,
        success: function(data) {
            limpiarForm();
            mostrarForm(false);
            tabla.ajax.reload();
            if (data == 'Categoría creada con éxito' || data == 'Categoría editada con éxito') {
                swal(data, 'You clicked the button!', 'success')
            } else {
                swal(data, 'You clicked the button!', 'error')
            }
        }
    });
}

function desactivar(id) {
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
            $.post('../controlador/controladorCargo.php?action=desactivar', {id:id}, function(data) {
                tabla.ajax.reload();
                swal(data, 'You clicked the button!', 'success')
            });
        }
    })
}

function activar(id) {
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
            $.post('../controlador/controladorCargo.php?action=activar', {id:id}, function(data) {
                tabla.ajax.reload();
                swal(data, 'You clicked the button!', 'success')
            });
        }
    })
}

function permisos() {
    $.post('../controlador/controladorCargo.php?action=permisos&id=', function(data) { // Lo que se envia a través de la url se obtiene por el método get
        $('#permisos').html(data);
    });
}

/*************** weas ***************/

function limpiarForm() {
    $('#id').val('');
    $('#nombre').val('');
    $('#descripcion').val('');

    $('input[name="permisos[]"]').attr('checked', false); // Referenciamos cada input que tenga name="permisos[]"
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
