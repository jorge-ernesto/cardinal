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
    <?php // include 'layout/header.php'; ?>
    <?php include 'layout/headerLogin.php'; ?>

    <div class="container">
        <div class="row justify-content-center mt-3 pt-2"> <!-- mt-5 pt5 -->
            <div class="col-md-12"> <!-- col-md-7 -->

                <div class="card border-primary text-center">
                    <div class="card-header">Por favor Sign In!</div>
                    <div class="card-body">

                        <form method="post" id="formularioLogin"> <!-- novalidate -->
                            <div class="form-group col-sm-6">
                                <input type="text" name="username" value="" id="username" class="form-control" placeholder="Username" autofocus required> <!-- required -->
                            </div>
                            <div class="form-group col-sm-6">
                                <input type="password" name="password" value="" id="password" class="form-control" placeholder="Password" required> <!-- required -->
                            </div>
                            <h4 class="form-group col-sm-6">
                                <button type="submit" id="signIn" class="btn btn-lg btn-primary btn-block">Sign In</button>
                            </h4>

                            <input type="hidden" name="id" value="" id="id" class="form-control">
                        </form>

                    </div>
                </div>

                <?php include 'layout/footer.php'; ?>

            </div><!-- .col -->
        </div><!-- .row -->
    </div><!-- .container -->

    <?php include 'layout/scripts.php'; ?>
    <script src="js/login.js"></script>
</body>
</html>
