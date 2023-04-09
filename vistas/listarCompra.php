<?php
ob_start();
session_start();
if (!isset($_SESSION['nombre'])) { // Si la variable es null
    header('Location: login.php');
} else {
    if ($_SESSION['compras'] == 1) {
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>App Angular</title>
    <?php include 'layout/head.php'; ?>
</head>
<body>
    <?php include 'layout/header.php'; ?>

    <div class="container">
        <div class="row justify-content-center mt-3 pt-2"> <!-- mt-5 pt5 -->
            <div class="col-md-12"> <!-- col-md-7 -->

                <div id="listadoRegistros">
                    <div class="card border-primary"> <!-- card bg-light -->
                        <div class="card-header">Categorías</div>
                        <div class="card-body text-primary"> <!-- card-body -->

                            <h5 class="card-title">Listado de compras</h5>
                            <div class="table-responsive">
                                <table id="table_id" class="table table-bordered table-striped"> <!-- <table class="table table-sm table-bordered table-striped table-hover table-responsive"> -->
                                    <thead> <!-- class="thead-dark" -->
                                        <tr>
                                            <th>id</th>
                                            <th>proveedor</th>
                                            <th>usuario</th>
                                            <th>comprobante</th>
                                            <th>serie</th>
                                            <th>numero</th>
                                            <th>fecha</th>
                                            <th>impuesto</th>
                                            <th>total</th>
                                            <th>detalle</th>
                                            <th>anular</th>
                                            <th>estado</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <h4>
                                <a id="wea" class="btn btn-primary mr-2" href="javascript:mostrarForm(true)">Crear Compra</a>
                            </h4>

                        </div>
                    </div>
                </div>

                <div id="formularioRegistros">
                    <div class="card bg-light" style="border-color: #773CB8;">
                        <div class="card-header">Compras</div>
                        <div class="card-body">

                            <form method="post" id="formulario"> <!-- novalidate -->
                                <div class="row form-group">
                                    <label for="idProveedor" class="col-form-label col-md-2">Proveedor:</label> <!-- col-md-4 -->
                                    <div class="col-md-5"> <!-- col-md-8 -->
                                        <select name="idProveedor" id="idProveedor" class="form-control selectpicker" data-live-search="true">
                                            <!-- <option value="" id=""></option> -->
                                        </select>
                                    </div>
                                </div>                                
                                <div class="row form-group">
                                    <label for="tipoComprobante" class="col-form-label col-md-2">Tipo de comprobante:</label>
                                    <div class="col-md-5">
                                        <select name="tipoComprobante" id="tipoComprobante" class="form-control selectpicker" data-live-search="true" onchange="cambiaImpuesto();">
                                            <option value="Boleta">Boleta</option>
                                            <option value="Factura">Factura</option>
                                            <option value="Ticket">Ticket</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label for="serieComprobante" class="col-form-label col-md-2">Serie de comprobante:</label>
                                    <div class="col-md-5">
                                        <input type="text" name="serieComprobante" value="Synthesis 001" id="serieComprobante" class="form-control" maxlength="13" readonly> <!-- required -->
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label for="numComprobante" class="col-form-label col-md-2">Número de comprobante:</label>
                                    <div class="col-md-5">
                                        <input type="text" name="numComprobante" value="Autogenerado" id="numComprobante" class="form-control" maxlength="10" readonly> <!-- required -->
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label for="fechaHora" class="col-form-label col-md-2">Fecha:</label>
                                    <div class="col-md-5">
                                        <input type="date" name="fechaHora" value="" id="fechaHora" class="form-control" readonly> <!-- required -->
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label for="impuesto" class="col-form-label col-md-2">Impuesto:</label>
                                    <div class="col-md-5">
                                        <input type="number" name="impuesto" value="0" min="0" max="100" id="impuesto" class="form-control" required> <!-- required -->
                                    </div>
                                </div>
                                <div id="divArticulos" class="row form-group">
                                    <label for="productos" class="col-form-label col-md-2">Artículos:</label>
                                    <div class="col-md-5">
                                        <a class="btn" style="border-color: #773CB8; color: #773CB8;" href="javascript:ver()">Artículos</a>
                                    </div>
                                </div>

                                <!-- Contenido Detalle Venta  -->
                                <!--
                                <table class="d-none">
                                    <thead>
                                    </thead>
                                    <tbody id="detalleVenta">
                                        <tr id="row_${pro[0]}"> /***** Esto es de semana_08_wea, lo demás de capriccio *****/
                                            <td class="d-none">
                                                <input type="hidden" name="item_id[]" value="${pro[0]}"></input>
                                            </td>
                                            <td>${pro[1]}</td>
                                            <td>${pro[2]}</td>
                                            <td class="col-sm-4">
                                                <input class="form-control" id="cantidad_${pro[0]}" type="number" name="cantidad[]" value="1" min="1" onchange="calcularImporte(${pro[0]}, ${pro[2]}, this.value);"></input>
                                            </td>  
                                            <td>
                                                <span id="totalImporte_${pro[0]}">${pro[2]}</span>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-sm btn-danger" onclick="eliminar( ${pro[0]} );">Eliminar</button>
                                            </td>
                                        </tr> /***** Esto es de semana_08_wea, lo demás de capriccio *****/
                                    </tbody>
                                </table>
                                -->

                                <table class="table table-bordered table-striped table-hover table-sm">
                                    <thead>
                                        <tr>
                                            <th class="d-none">ID</th>
                                            <th>Nombre</th>
                                            <th>Precio compra</th>
                                            <th>Precio venta</th>
                                            <th>Cantidad</th>
                                            <th>Total</th>
                                            <th id="thEliminar">Eliminar</th>
                                        </tr>
                                    </thead>
                                    <tbody id="cargarDetalleVenta">

                                    </tbody>
                                </table>

                                <h5 class="float-right clearfix"> Total <!-- id="margin85" -->                                    
                                    <span class="badge badge-dark" id="granTotal">Total</span>
                                    <input type="hidden" name="granTotal2" value="" id="granTotal2" class="form-control">
                                </h5>
                                <!-- Fin Contenido Detalle Venta -->

                                <h4>
                                    <button type="submit" id="crear" class="btn" style="background-color: #773CB8; color: #fff;">Crear Compra</button>
                                    <a id="cancelarCompra" class="btn" style="background-color: #773CB8; color: #fff;" href="javascript:cancelarCompra()">Cancelar Compra</a>
                                    <a class="btn" style="background-color: #773CB8; color: #fff;" href="javascript:cancelarForm()">Atras</a>
                                </h4>

                                <input type="hidden" name="id" value="" id="id" class="form-control">
                            </form>

                        </div>
                    </div>
                </div>

                <!-- Modal -->
                <div id="exampleModal" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Artículos</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                
                                <h5 class="card-title">Listado de artículos</h5>
                                <div class="table-responsive">
                                    <table id="table_id_2" class="table table-bordered table-striped"> <!-- <table class="table table-sm table-bordered table-striped table-hover table-responsive"> -->
                                        <thead> <!-- class="thead-dark" -->
                                            <tr>
                                                <th>id</th>
                                                <th>nombre</th>
                                                <th>descripcion</th>
                                                <th>categoria</th>
                                                <th>codigo</th>
                                                <th>stock</th>
                                                <th>imagen</th>
                                                <th>agregar</th>                                            
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>                                                                                        
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn" style="background-color: #773CB8; color: #fff;" data-dismiss="modal">Atras</button>                                
                            </div>
                        </div>
                    </div>
                </div>

                <?php include 'layout/footer.php'; ?>

            </div><!-- .col -->
        </div><!-- .row -->
    </div><!-- .container -->

    <?php include 'layout/scripts.php'; ?>
    <script src="js/compra.js"></script>
</body>
</html>

<?php
    } else {
        include 'error_404.php';
    }
}
ob_end_flush();
?>
