<?php
 if (!isset($_SESSION['id'])) {
    header ("Location:/cotizacion/index.php"); 
 }
$menu_general = '';
$menu_config = '';
$panel_control = '';
if ($_SESSION['menu_general']['success']) {
    for ($i=0; $i < count($_SESSION['menu_general']['resultado']) ; $i++) { 
        if ($_SESSION['menu_general']['resultado'][$i]['tipo'] == 'GENERAL') {
            $nombre = $_SESSION['menu_general']['resultado'][$i]['nombre'];
            $url = $_SESSION['menu_general']['resultado'][$i]['url'];
            $menu_general .= '<li class="nav-item">
                                    <a class="nav-link menu_principal" id="menu_'.$nombre.'" href="'.$url.'">'.$nombre.'</a>
                                </li>';
        }

        if ($_SESSION['menu_general']['resultado'][$i]['tipo'] == 'CONFIG') {
            $nombre = $_SESSION['menu_general']['resultado'][$i]['nombre'];
            $url = $_SESSION['menu_general']['resultado'][$i]['url'];
            $menu_config .= '<a class="dropdown-item menu_principal" style="color:#000; pading: 6px;" id="menu_'.$i.'" href="'.$url.'">'.$nombre.'</a>
            <div class="dropdown-divider"></div>';
        }

        if ($_SESSION['menu_general']['resultado'][$i]['tipo'] == 'SESION') {
            $nombre = $_SESSION['menu_general']['resultado'][$i]['nombre'];
            $url = $_SESSION['menu_general']['resultado'][$i]['url'];
            $panel_control = '<a class="dropdown-item" href="'.$url.'">'.$nombre.'</a>';
        }
    }

    if ($menu_config !== '') {
        $menu_config = '<li class="nav-item dropdown">
                            <a  class="nav-link  menu_principal dropdown-toggle " href="#" id="navbarDropdown1" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Configuración
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown1">
                                '.$menu_config.'
                            </div>
                        </li>';
    }
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
                <?php  echo $menu_general; ?>
                <?php  echo $menu_config; ?>
            </ul>
            <form class="form-inline my-2 my-lg-0">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link menu_principal" id="menu_nombre_hotel" href="#"> 
                            <?php echo isset( $_SESSION['nombre_hotel']) ? $_SESSION['nombre_hotel']: "";?>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a  class="nav-link dropdown-toggle " href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?php echo $_SESSION['nombre1'];?>  <?php echo $_SESSION['apellido1'];?>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <!-- <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a> -->
                            <?php echo $panel_control; ?>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="/cotizacion/php/cerrar_sesion.php">Cerrar sesión</a>
                        </div>
                    </li>
                </ul>
            </form>
        </div>
    </div>
    
</nav>