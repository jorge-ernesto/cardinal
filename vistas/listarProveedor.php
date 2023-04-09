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
                        <div class="card-header">Proveedores</div>
                        <div class="card-body text-primary"> <!-- card-body -->

                            <h5 class="card-title">Listado de proveedores</h5>
                            <div class="table-responsive">
                                <table id="table_id" class="table table-bordered table-striped"> <!-- <table class="table table-sm table-bordered table-striped table-hover table-responsive"> -->
                                    <thead> <!-- class="thead-dark" -->
                                        <tr>
                                            <th>id</th>
                                            <th>nombre</th>
                                            <th>documento</th>
                                            <th>numero</th>
                                            <th>direccion</th>
                                            <th>telefono</th>
                                            <th>email</th>
                                            <th>editar</th>
                                            <th>eliminar</th>
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
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <h4>
                                <a id="wea" class="btn btn-primary mr-2" href="javascript:mostrarForm(true)">Crear Proveedor</a>
                            </h4>

                        </div>
                    </div>
                </div>

                <div id="formularioRegistros">
                    <div class="card bg-dark text-white">
                        <div class="card-header">Proveedores</div>
                        <div class="card-body">

                            <form method="post" id="formulario"> <!-- novalidate -->
                                <div class="row form-group">
                                    <label for="nombre" class="col-form-label col-md-2">Nombre:</label> <!-- col-md-4 -->
                                    <div class="col-md-5"> <!-- col-md-8 -->
                                        <input type="text" name="nombre" value="" id="nombre" class="form-control" required> <!-- required -->
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label for="tipoDocumento" class="col-form-label col-md-2">Tipo de documento:</label>
                                    <div class="col-md-5">
                                        <select name="tipoDocumento" id="tipoDocumento" class="form-control selectpicker" data-live-search="true">
                                            <option value="DNI">DNI</option>
                                            <option value="RUC">RUC</option>
                                            <option value="CEDULA">CEDULA</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label for="numDocumento" class="col-form-label col-md-2">Número de documento:</label>
                                    <div class="col-md-5">
                                        <input type="text" name="numDocumento" value="" id="numDocumento" class="form-control"> <!-- required -->
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label for="direccion" class="col-form-label col-md-2">Dirección:</label>
                                    <div class="col-md-5">
                                        <input type="text" name="direccion" value="" id="direccion" class="form-control"> <!-- required -->
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label for="telefono" class="col-form-label col-md-2">Teléfono:</label>
                                    <div class="col-md-5">
                                        <input type="text" name="telefono" value="" id="telefono" class="form-control"> <!-- required -->
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label for="email" class="col-form-label col-md-2">Email:</label>
                                    <div class="col-md-5">
                                        <input type="email" name="email" value="" id="email" class="form-control"> <!-- required -->
                                    </div>
                                </div>
                                <h4>
                                    <button type="submit" id="crear" class="btn btn-secondary">Crear Proveedor</button>
                                    <a class="btn btn-secondary" href="javascript:cancelarForm()">Atras</a>
                                </h4>

                                <input type="hidden" name="id" value="" id="id" class="form-control">
                                <input type="hidden" name="tipoPersona" value="Proveedor" id="tipoPersona" class="form-control">
                            </form>

                        </div>
                    </div>
                </div>

                <?php include 'layout/footer.php'; ?>

            </div><!-- .col -->
        </div><!-- .row -->
    </div><!-- .container -->

    <?php include 'layout/scripts.php'; ?>
    <script src="js/proveedor.js"></script>
</body>
</html>

<?php
    } else {
        include 'error_404.php';
    }
}
ob_end_flush();
?>
