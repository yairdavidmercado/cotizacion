<?php
 if (!isset($_SESSION['id'])) {
    header ("Location:/index.php"); 
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
            $menu_config .= '<a class="dropdown-item menu_principal" id="menu_'.$i.'" href="'.$url.'">'.$nombre.'</a>
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

<style>
/* ====== COTICLICK NAV (minimal dark) ====== */
:root{
  --nav-bg: #001d40;
  --nav-bg2: rgba(0, 35, 77, 0.72);
  --nav-line: rgba(12, 34, 115, 0.08);
  --text: rgba(255,255,255,.92);
  --muted: rgba(255,255,255,.65);
  --accent: #18BDF7; /* ajusta al celeste del logo */
}

.navbar.cc-nav{
  background: linear-gradient(180deg, var(--nav-bg2), rgba(11,15,20,.35));
  backdrop-filter: blur(10px);
  -webkit-backdrop-filter: blur(10px);
  /* border-bottom: 1px solid var(--nav-line); */
  padding: .65rem 0;
}

.cc-nav .navbar-brand img{ height: 30px; width:auto; }
.cc-nav .navbar-toggler{ border-color: rgba(255,255,255,.12); }
.cc-nav .navbar-toggler:focus{ box-shadow: none; }

.cc-nav .nav-link{
  color: var(--muted) !important;
  font-weight: 500;
  padding: .6rem .85rem;
  border-radius: 12px;
  transition: all .18s ease;
}

.cc-nav .nav-link:hover{
  color: var(--text) !important;
  background: rgba(255,255,255,.06);
}

.cc-nav .nav-link.active{
  color: var(--text) !important;
  background: rgba(255,255,255,.06);
  position: relative;
}

.cc-nav .nav-link.active:after{
  content:"";
  position:absolute;
  left: 14px;
  right: 14px;
  bottom: -10px;
  height: 2px;
  background: var(--accent);
  border-radius: 999px;
  opacity: .9;
}

.cc-nav .dropdown-menu{
  background: rgba(17,24,39,.96);
  border: 1px solid rgba(255,255,255,.10);
  border-radius: 14px;
  padding: .4rem;
  margin-top: .6rem;
  box-shadow: 0 14px 50px rgba(0,0,0,.45);
}

.cc-nav .dropdown-item{
  color: rgba(255,255,255,.86);
  border-radius: 10px;
  padding: .55rem .7rem;
  transition: all .15s ease;
}

.cc-nav .dropdown-item:hover{
  background: rgba(255,255,255,.08);
  color: #fff;
}

.cc-nav .dropdown-divider{
  border-top: 1px solid rgba(255,255,255,.08);
  margin: .35rem 0;
}

.cc-right{
  display:flex;
  align-items:center;
  gap:.6rem;
}

.cc-chip{
  display:inline-flex;
  align-items:center;
  gap:.5rem;
  padding:.45rem .65rem;
  border: 1px solid rgba(255,255,255,.10);
  background: rgba(255,255,255,.04);
  color: rgba(255,255,255,.80);
  border-radius: 999px;
  font-size: .9rem;
  max-width: 260px;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}

.cc-icon-btn{
  width: 38px;
  height: 38px;
  border-radius: 12px;
  border: 1px solid rgba(255,255,255,.10);
  background: rgba(255,255,255,.04);
  display:inline-flex;
  align-items:center;
  justify-content:center;
  color: rgba(255,255,255,.82);
  transition: all .15s ease;
}

.cc-icon-btn:hover{
  background: rgba(255,255,255,.08);
  color: #fff;
}

.cc-avatar{
  width: 34px;
  height: 34px;
  border-radius: 999px;
  border: 2px solid rgba(24,189,247,.55);
  background: rgba(255,255,255,.10);
  display:inline-flex;
  align-items:center;
  justify-content:center;
  font-weight: 700;
  color: rgba(255,255,255,.9);
  font-size: .85rem;
}
</style>

<nav class="navbar navbar-expand-lg fixed-top navbar-dark cc-nav">
  <div class="container">

    <a class="navbar-brand" href="/welcome.php">
      <img src="assets/img/logos.png" alt="COTICLICK">
    </a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">

      <ul class="navbar-nav mr-auto">

        <?php echo $menu_general; ?>
        <?php echo $menu_config; ?>
      </ul>

      <div class="cc-right ml-auto">

        <!-- Hotel / empresa -->
        <?php if (!empty($_SESSION['nombre_hotel'])): ?>
          <span class="cc-chip" title="<?php echo $_SESSION['nombre_hotel']; ?>">
            <i class="fas fa-building" style="color: var(--accent);"></i>
            <?php echo $_SESSION['nombre_hotel']; ?>
          </span>
        <?php endif; ?>

        <!-- Campana (placeholder visual) -->
        <!-- <a class="cc-icon-btn" href="#" title="Notificaciones" aria-label="Notificaciones">
          <i class="far fa-bell"></i>
        </a> -->

        <!-- Usuario -->
        <?php
          $nombre = isset($_SESSION['nombre1']) ? $_SESSION['nombre1'] : '';
          $apellido = isset($_SESSION['apellido1']) ? $_SESSION['apellido1'] : '';
          $iniciales = '';
          if ($nombre !== '') $iniciales .= strtoupper(mb_substr($nombre, 0, 1));
          if ($apellido !== '') $iniciales .= strtoupper(mb_substr($apellido, 0, 1));
          if ($iniciales === '') $iniciales = 'U';
        ?>

        <div class="nav-item dropdown">
          <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="navbarDropdown"
             role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="cc-avatar mr-2"><?php echo $iniciales; ?></span>
            <span class="d-none d-lg-inline">
              <?php echo $nombre . ' ' . $apellido; ?>
            </span>
          </a>

          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
            <?php echo $panel_control; ?>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="/php/cerrar_sesion.php">
              <i class="fas fa-sign-out-alt mr-2" style="opacity:.85;"></i>
              Cerrar sesión
            </a>
          </div>
        </div>

      </div>
    </div>
  </div>
</nav>
