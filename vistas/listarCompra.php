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
    <?php require 'layout/head.php'; ?>
</head>
<body>
    <?php require 'layout/header.php'; ?>

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
                                            <th>fecha</th>
                                            <th>proveedor</th>
                                            <th>usuario</th>
                                            <th>comprobante</th>
                                            <th>serie</th>
                                            <th>numero</th>
                                            <th>impuesto</th>
                                            <th>total</th>
                                            <th>editar</th>
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
                                    <label for="proveedor" class="col-form-label col-md-2">Proveedor:</label> <!-- col-md-4 -->
                                    <div class="col-md-5"> <!-- col-md-8 -->
                                        <select name="proveedor" id="proveedor" class="form-control selectpicker" data-live-search="true" data-show-subtext="true">
                                            <!-- <option value="" id="" data-subtext=""></option> -->
                                        </select>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label for="usuario" class="col-form-label col-md-2">Usuario:</label>
                                    <div class="col-md-5">
                                        <select name="usuario" id="usuario" class="form-control selectpicker" data-live-search="true" data-show-subtext="true">
                                            <!-- <option value="" id="" data-subtext=""></option> -->
                                        </select>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label for="tipoComprobante" class="col-form-label col-md-2">Tipo de comprobante:</label>
                                    <div class="col-md-5">
                                        <select name="tipoComprobante" id="tipoComprobante" class="form-control selectpicker" data-live-search="true">
                                            <option value="Boleta">Boleta</option>
                                            <option value="Factura">Factura</option>
                                            <option value="Ticket">Ticket</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label for="serieComprobante" class="col-form-label col-md-2">Serie de comprobante:</label>
                                    <div class="col-md-5">
                                        <input type="text" name="serieComprobante" value="001" id="serieComprobante" class="form-control" maxlength="3" required> <!-- required -->
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label for="numComprobante" class="col-form-label col-md-2">Numero de comprobante:</label>
                                    <div class="col-md-5">
                                        <input type="text" name="numComprobante" value="001" id="numComprobante" class="form-control" maxlength="10" required> <!-- required -->
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label for="fechaHora" class="col-form-label col-md-2">Fecha:</label>
                                    <div class="col-md-5">
                                        <input type="date" name="fechaHora" value="" id="fechaHora" class="form-control" required> <!-- required -->
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label for="impuesto" class="col-form-label col-md-2">Impuesto:</label>
                                    <div class="col-md-5">
                                        <input type="number" name="impuesto" value="" id="impuesto" class="form-control" max="100" required> <!-- required -->
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label for="productos" class="col-form-label col-md-2">Productos:</label>
                                    <div class="col-md-5">
                                        <a class="btn" style="border-color: #773CB8; color: #773CB8;" href="javascript:ver()">Productos</a>
                                    </div>
                                </div>

                                <!-- Contenido Detalle Venta  -->
								<table class="d-none">
									<thead>
									</thead>
									<tbody id="detalleVenta">
										<tr id="row_{ID}">
											<td class="d-none">
												<input type="hidden" name="item_id[]" value="{ID}"></input>
											</td>
											<td>{NOMBRE}</td>
											<td>{PRECIO}</td>
											<td>
												<input class="form-control col-sm-4" id="cantidad_{ID}" type="number" name="cantidad[]" value="1" min="1" onchange="funcionAyuda.calcularImporte({ID}, {PRECIO}, this.value);"></input>
											</td>
											<td>
												<span id="totalImporte_{ID}">0</span>
											</td>
											<td>
												<a class="btn btn-sm btn-danger" href="#" onclick="funcionAyuda.eliminarLineaDetalleVenta({ID});">
													<i class="icon-trash"></i>
												</a>
											</td>
										</tr>
									</tbody>
								</table>

								<table class="table table-bordered table-striped table-hover table-sm">
									<thead>
										<tr>
											<th class="d-none">ID</th>
											<th>Nombre</th>
											<th>Precio</th>
											<th>Cantidad</th>
											<th>Total</th>
											<th>Eliminar</th>
										</tr>
									</thead>
									<tbody id="cargarDetalleVenta">

									</tbody>
								</table>

								<h5 class="float-right clearfix"> Total <!-- id="margin85" -->
									<span class="badge badge-dark" id="granTotal">Total</span>
								</h5>
								<!-- Fin Contenido Detalle Venta -->

                                <h4>
                                    <button type="submit" id="crear" class="btn" style="background-color: #773CB8; color: #fff;">Crear Compra</button>
                                    <a class="btn" style="background-color: #773CB8; color: #fff;" href="javascript:cancelarForm(false)">Atras</a>
                                </h4>

                                <input type="hidden" name="id" value="" id="id" class="form-control">
                            </form>

                        </div>
                    </div>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                ...
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">Save changes</button>
                            </div>
                        </div>
                    </div>
                </div>

                <?php require 'layout/footer.php'; ?>

            </div><!-- .col -->
        </div><!-- .row -->
    </div><!-- .container -->

    <?php require 'layout/cdn.php'; ?>

    <script src="js/compra.js"></script>
</body>
</html>

<?php

    } else {
        require 'error_404.php';
    }
}
ob_end_flush();

?>
