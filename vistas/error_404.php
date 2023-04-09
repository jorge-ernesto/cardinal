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

                <div class="card bg-danger text-white">
                    <div class="card-header">Error: Acceso Denegado!</div>
                    <div class="card-body">
                        <h5 class="card-title">
                            Los sentimos <?php echo $_SESSION['nombre']; ?>,
                            NO tienes permisos para acceder a este recurso.
                        </h5>
                        <a class="btn btn-outline-light" href="home.php">Ir a home</a>                        
                    </div>
                </div>

                <?php include 'layout/footer.php'; ?>

            </div><!-- .col -->
        </div><!-- .row -->
    </div><!-- .container -->

    <?php include 'layout/scripts.php'; ?>    
</body>
</html>
