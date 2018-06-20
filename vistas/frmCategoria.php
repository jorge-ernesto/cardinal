<!-- Vista HTML con Bootstrap, para poder realizar el listado y paginación de registros con DATATABLES -->

<?php
require 'frmHeader.php';
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
                                    <button id="btn-agregar" class="btn btn-success" type="button" onclick="mostrarForm(true)"><i class="fa fa-plus-circle"></i> Agregar</button>
                                </h1>
                                <div class="box-tools pull-right">
                                </div>
                            </div>
                            <!-- /.box-header -->
                            <!-- Centro -->                            
                            <div id="listado-registros" class="panel-body table-responsive"> <!-- <div id="listado-registros" class="panel-body table-responsive" style="height: 400px;"> -->
                                <table id="tbl-listado" class="table table-striped table-bordered table-condensed table-hover">
                                    <thead>
                                        <th>ID Categoría</th>
                                        <th>Nombre</th>
                                        <th>Descripción</th>
                                        <th>Estado</th>
                                    </thead>
                                    <tbody>
                                        
                                    </tbody>
                                    <tfoot>
                                        <th>ID Categoría</th>
                                        <th>Nombre</th>
                                        <th>Descripción</th>
                                        <th>Estado</th>
                                    </tfoot>
                                </table>
                            </div>
                                                        
                            <div id="formulario-registros" class="panel-body" style="height: 400px;"> <!-- <div id="formulario-registros" class="panel-body table-responsive" style="height: 400px;"> -->
                                <form id="formulario" name="formulario" method="post"> <!-- Cuando el usuario de click en Enviar, toda la informacion que tengamos en el formulario se enviara al archivo recibe.php -->
                                    <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <input id="idcategoria" name="idcategoria" type="hidden">                                        
                                        <label for="nombre">Nombre:</label> <!-- for se relaciona con id -->                                        
                                        <input id="nombre" class="form-control" name="nombre" type="text" placeholder="Nombre" maxlength="50" required>
                                    </div>
                                    <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <label for="descripcion">Descripción:</label>
                                        <input id="descripcion" class="form-control" name="descripcion" type="text" placeholder="Descripción" maxlength="256">
                                    </div>
                                    <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <button id="btn-guardar" class="btn btn-primary" type="submit"><i class="fa fa-save"></i> Guardar</button>
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
require 'frmFooter.php'
?>
        
<script src="scripts/categoria_funcionesDinamicasJquery_peticionesAjax.js"></script>  
