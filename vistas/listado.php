<?php

require 'header.php';

?>

        <!-- Contenido -->
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">

            <section class="content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="box">
                            <div class="box-header with-border">
                                <h1 class="box-title">Tabla <button class="btn btn-success" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i> Agregar</button></h1>
                                <div class="box-tools pull-right">
                                </div>
                            </div>
                            <!-- /.box-header -->
                            <!-- Centro -->
                            <div class="panel-body table-responsive" style="height: 400px;" id="listadoregistros">

                            </div>
                            <!-- Fin-Centro -->
                        </div><!-- /.box -->
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </section><!-- /.content -->

        </div><!-- /.content-wrapper -->
        <!-- Fin-Contenido -->

<?php

require 'footer.php'

?>
