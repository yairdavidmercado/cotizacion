<?php
 if (!isset($_SESSION['id'])) {
    header ("Location:/cotizacion/index.php"); 
 }
?>

<nav class="navbar navbar-expand-lg fixed-top navbar-dark" style="background-color: #563D7C;">
    <div class="container">
    <a class="navbar-brand" href="#"><img src="assets/img/logos.png" width="140px" alt=""></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                    <a class="nav-link active" href="#">Cotización</a>
            </li>
            <li id="li_glosas" class="nav-item">
                <a class="nav-link" href="#">Hoteles</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Planes</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Tarifas</a>
            </li>
            <!-- <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Dropdown
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="#">Action</a>
                <a class="dropdown-item" href="#">Another action</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">Something else here</a>
                </div>
            </li> -->
        </ul>
        <form class="form-inline my-2 my-lg-0">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <?php echo $_SESSION['nombre1'];?>  <?php echo $_SESSION['apellido1'];?>
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <!-- <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a> -->
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="php/cerrar_sesion.php">Cerrar sesión</a>
                </div>
                </li>
            </ul>
        </form>
    </div>
    </div>
    
</nav>