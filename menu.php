<?php
 if (!isset($_SESSION['id'])) {
    header ("Location:/cotizacion/index.php"); 
 }
?>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css">
<nav class="navbar navbar-expand-lg fixed-top navbar-dark" style="background-color: #002744;">
    <div class="container">
        <a class="navbar-brand" href="#"><img src="/cotizacion/assets/img/logos.png" width="140px" alt=""></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                    <a class="nav-link active" id="menu_inicio" href="/cotizacion/welcome.php">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active menu_principal" id="menu_cotizaciones" href="/cotizacion/cotizacion.php">Cotización</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu_principal" id="menu_hoteles" href="/cotizacion/views/hoteles">Hoteles</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu_principal" id="menu_planes" href="/cotizacion/views/planes">Planes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu_principal" id="menu_motivos" href="/cotizacion/views/motivos">Motivos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu_principal" id="menu_tarifas" href="/cotizacion/views/tarifas">Tarifas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu_principal" id="menu_usuarios"  href="/cotizacion/views/usuarios">Usuarios</a>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link menu_principal" id="menu_nombre_hotel" href="#"> 
                            <?php echo $_SESSION['nombre_hotel'];?>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                    <a  class="nav-link dropdown-toggle " href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <?php echo $_SESSION['nombre1'];?>  <?php echo $_SESSION['apellido1'];?>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <!-- <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a> -->
                        <a class="dropdown-item" href="#"></a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="/cotizacion/php/cerrar_sesion.php">Cerrar sesión</a>
                    </div>
                    </li>
                </ul>
            </form>
        </div>
    </div>
    
</nav>