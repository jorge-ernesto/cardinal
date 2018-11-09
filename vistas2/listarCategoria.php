<?php
require 'layout/header.php';
?>

        <!-- Contenido -->
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">

            <section class="content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="box">
                            <div class="box-header with-border">
                                <h1 class="box-title">Categoría
                                    <button id="btn-nuevo" class="btn btn-success" type="button" onclick="mostrarForm(true)"><i class="fa fa-plus-circle"></i> Nuevo</button>
                                </h1>
                                <div class="box-tools pull-right">
                                </div>
                            </div><!-- /.box-header -->
                            <!-- Centro -->
                            <div id="listado-registros" class="panel-body table-responsive">
                                <table id="table_id" class="table table-striped table-bordered table-condensed table-hover">
                                    <thead>
                                        <th>Opciones</th>
                                        <th>Nombre</th>
                                        <th>Descripción</th>
                                        <th>Estado</th>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                    <tfoot>
                                        <th>Opciones</th>
                                        <th>Nombre</th>
                                        <th>Descripción</th>
                                        <th>Estado</th>
                                    </tfoot>
                                </table>
                            </div>

                            <div id="formulario-registros" class="panel-body" style="height: 400px;">
                                <form id="formulario" method="post">
                                    <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <input id="id" name="id" type="hidden">
                                        <label for="nombre">Nombre:</label>
                                        <input id="nombre" class="form-control" name="nombre" type="text" placeholder="Nombre" maxlength="50" required>
                                    </div>
                                    <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <label for="descripcion">Descripción:</label>
                                        <input id="descripcion" class="form-control" name="descripcion" type="text" placeholder="Descripción" maxlength="250">
                                    </div>
                                    <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <button id="btn-enviar" class="btn btn-primary" type="submit"><i class="fa fa-cloud"></i> Enviar</button>
                                        <button id="btn-cancelar" class="btn btn-danger" type="button" onclick="cancelarForm()"><i class="fa fa-arrow-circle-left"></i> Cancelar</button>
                                    </div>
                                </form>
                            </div>
                            <!-- Fin-Centro -->
                        </div><!-- /.box -->
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </section><!-- /.content -->

        </div><!-- /.content-wrapper -->
        <!-- Fin-Contenido -->

<?php
require 'layout/footer.php'
?>

<script src="js/categoria.js"></script>
