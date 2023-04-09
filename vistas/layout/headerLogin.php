<header th:fragment="header">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">App Angular</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">                
                <li class="nav-item"><a class="nav-link" href="about.php">About</a></li>
            </ul>
            <!--
            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
            -->
            <ul class="navbar-nav navbar-right">                
                <li class="dropdown"> <!-- dropdown show --> <!-- show, mantiene hover sobre el boton -->
                    <a id="dropdownMenuLink" class="btn btn-outline-primary dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Sign Out</a>

                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">                        
                        <a class="dropdown-item" href="../controlador/controladorUsuario.php?action=signOut">Sign Out</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</header>

<!--
<header th:fragment="header">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">App Angular</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link active" href="home.php">Home</a>
                </li>
                <li class="nav-item"><a class="nav-link" href="listarCategoria.php">Categorías</a></li>
                <li class="nav-item"><a class="nav-link" href="listarArticulo.php">Artículos</a></li>
                <li class="nav-item"><a class="nav-link" href="listarProveedor.php">Proveedores</a></li>
                <li class="nav-item"><a class="nav-link" href="listarPermiso.php">Permisos</a></li>
                <li class="nav-item"><a class="nav-link" href="about.php">About</a></li>                
            </ul>
            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
    </nav>
</header>
-->
