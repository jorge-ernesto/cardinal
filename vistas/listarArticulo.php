<?php
ob_start();
session_start();
if (!isset($_SESSION['nombre'])) { // Si la variable es null
    header('Location: login.php');
} else {
    if ($_SESSION['almacen'] == 1) {
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
                        <div class="card-header">Artículos</div>
                        <div class="card-body text-primary"> <!-- card-body -->

                            <h5 class="card-title">Listado de artículos</h5>
                            <div class="table-responsive">
                                <table id="table_id" class="table table-bordered table-striped"> <!-- <table class="table table-sm table-bordered table-striped table-hover table-responsive"> -->
                                    <thead> <!-- class="thead-dark" -->
                                        <tr>
                                            <th>id</th>
                                            <th>nombre</th>
                                            <th>descripcion</th>
                                            <th>categoria</th>
                                            <th>codigo</th>
                                            <th>stock</th>
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
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <h4>
                                <a id="wea" class="btn btn-primary mr-2" href="javascript:mostrarForm(true)">Crear Artículo</a>
                            </h4>

                        </div>
                    </div>
                </div>

                <div id="formularioRegistros">
                    <div class="card bg-dark text-white">
                        <div class="card-header">Artículos</div>
                        <div class="card-body">

                            <form method="post" id="formulario"> <!-- novalidate -->
                                <div class="row form-group">
                                    <label for="categoria" class="col-form-label col-md-2">Categoría:</label> <!-- col-md-4 -->
                                    <div class="col-md-5"> <!-- col-md-8 -->
                                        <select name="categoria" id="categoria" class="form-control selectpicker" data-live-search="true" data-show-subtext="true">
                                            <!-- <option value="" id="" data-subtext=""></option> -->
                                        </select>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label for="codigo" class="col-form-label col-md-2">Código:</label>
                                    <div class="col-md-5">
                                        <input type="text" name="codigo" value="" id="codigo" class="form-control"> <!-- required -->
                                    </div>
                                    <a class="btn btn-secondary" href="javascript:generarBarcode()">Barcode</a>
                                </div>
                                <div class="row form-group">
                                    <label for="nombre" class="col-form-label col-md-2">Nombre:</label>
                                    <div class="col-md-5">
                                        <input type="text" name="nombre" value="" id="nombre" class="form-control" required> <!-- required -->
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label for="stock" class="col-form-label col-md-2">Stock:</label>
                                    <div class="col-md-5">
                                        <input type="number" name="stock" value="" id="stock" class="form-control" min="1" required> <!-- required --> <!-- value="1" no funciona por limpiarForm() en init() -->
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label for="descripcion" class="col-form-label col-md-2">Descripción:</label>
                                    <div class="col-md-5">
                                        <input type="text" name="descripcion" value="" id="descripcion" class="form-control"> <!-- required -->
                                    </div>
                                </div>
                                <div class="form-group row clearfix">
			                        <label for="file" class="col-form-label col-md-2">Imagén:</label>
                                    <div class="col-md-5">
                                        <div class="custom-file">
                                            <input type="file" name="file" id="file" class="custom-file-input"> <!-- required --> <!-- value="", genera error -->
                                            <label for="customFile" class="custom-file-label">Choose file</label>

                                            <input type="hidden" name="fileCurrent" id="fileCurrent" class="custom-file-input">
                                        </div>
                                    </div>
                                    <img src="" id="fileShow" class="float-right" width="120" height="66"></img>
			                    </div>
                                <h4>
                                    <button type="submit" id="crear" class="btn btn-secondary">Crear Artículo</button>
                                    <a class="btn btn-secondary" href="javascript:cancelarForm()">Atras</a>
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
                                <a class="btn btn-sm btn-primary" href="javascript:imprimirBarcode()">Imprimir</a>
                                <button type="button" class="btn btn-sm btn-dark" data-dismiss="modal">Atras</button>
                            </div>
                        </div>
                    </div>
                </div>

                <?php include 'layout/footer.php'; ?>

            </div><!-- .col -->
        </div><!-- .row -->
    </div><!-- .container -->

    <?php include 'layout/scripts.php'; ?>
    <script src="js/articulo.js"></script>
</body>
</html>

<?php
    } else {
        include 'error_404.php';
    }
}
ob_end_flush();
?>
