<?php

ob_start();
session_start();
if (!isset($_SESSION['nombre'])) { // Si la variable es null
    header('Location: login.php');
} else {
    if ($_SESSION['acceso'] == 1) {

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
                        <div class="card-header">Usuarios</div>
                        <div class="card-body text-primary"> <!-- card-body -->

                            <h5 class="card-title">Listado de usuarios</h5>
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
                                            <th>cargo</th>
                                            <th>username</th>
                                            <th>password</th>
                                            <th>imagen</th>
                                            <th>editar</th>
                                            <th>eliminar</th>
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
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <h4>
                                <a id="wea" class="btn btn-primary mr-2" href="javascript:mostrarForm(true)">Crear Usuario</a>
                            </h4>

                        </div>
                    </div>
                </div>

                <div id="formularioRegistros">
                    <div class="card bg-dark text-white">
                        <div class="card-header">Usuarios</div>
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
                                        <input type="text" name="numDocumento" value="" id="numDocumento" class="form-control" required> <!-- required -->
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
                                <div class="row form-group">
                                    <label for="cargo" class="col-form-label col-md-2">Cargo:</label>
                                    <div class="col-md-5">
                                        <select name="cargo" id="cargo" class="form-control selectpicker" data-live-search="true">
                                            <option value="Usuario">Usuario</option>
                                            <option value="Administrador">Administrador</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label for="username" class="col-form-label col-md-2">Username:</label>
                                    <div class="col-md-5">
                                        <input type="username" name="username" value="" id="username" class="form-control" required> <!-- required -->
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label for="password" class="col-form-label col-md-2">Password:</label>
                                    <div class="col-md-5">
                                        <input type="password" name="password" value="" id="password" class="form-control" required> <!-- required -->
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label for="permisos" class="col-form-label col-md-2">Permiso:</label>
                                    <div class="col-md-5">
                                        <span id="permisos">
                                            <!--
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" name="" value="" id="customCheck1" class="custom-control-input">
                                                <label class="custom-control-label" for="customCheck1">Check this custom checkbox</label>
                                            </div>
                                            -->
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group row clearfix">
			                        <label for="descripcion" class="col-form-label col-md-2">Imagén:</label>
                                    <div class="col-md-5">
                                        <div class="custom-file">
                                            <input type="file" name="file" id="file" class="custom-file-input"> <!-- required --> <!-- value="", genera error -->
                                            <label for="customFile" class="custom-file-label">Choose file</label>

                                            <input type="hidden" name="fileCurrent" id="fileCurrent" class="custom-file-input">
                                        </div>
                                    </div>
                                    <img src="" id="fileShow" class="float-right" width="66" height="66"></img>
			                    </div>
                                <h4>
                                    <button type="submit" id="crear" class="btn btn-secondary">Crear Usuario</button>
                                    <a class="btn btn-secondary" href="javascript:cancelarForm(false)">Atras</a>
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
                                <h6 class="modal-title" id="exampleModalLabel">Barcode</h6>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body" id="print">
                                <svg id="barcode"></svg>
                            </div>
                            <div class="modal-footer">
                                <a class="btn btn-sm btn-success" href="javascript:imprimirBarcode()">Imprimir</a>
                                <button type="button" class="btn btn-sm btn-success" data-dismiss="modal">Atras</button>
                            </div>
                        </div>
                    </div>
                </div>

                <?php require 'layout/footer.php'; ?>

            </div><!-- .col -->
        </div><!-- .row -->
    </div><!-- .container -->

    <?php require 'layout/cdn.php'; ?>

    <script src="js/usuario.js"></script>
</body>
</html>

<?php

    } else {
        require 'error_404.php';
    }
}
ob_end_flush();

?>
