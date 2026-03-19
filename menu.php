<?php
function cc_base_path() {
  static $basePath = null;
  if ($basePath !== null) return $basePath;

  $docRoot = isset($_SERVER['DOCUMENT_ROOT']) ? str_replace('\\', '/', rtrim($_SERVER['DOCUMENT_ROOT'], '/')) : '';
  $menuDir = str_replace('\\', '/', __DIR__);

  if ($docRoot !== '' && strpos($menuDir, $docRoot) === 0) {
    $basePath = substr($menuDir, strlen($docRoot));
  } else {
    $basePath = '/' . basename($menuDir);
  }

  $basePath = '/' . trim($basePath, '/');
  return $basePath;
}

function cc_menu_url($url) {
  $url = trim((string)$url);
  if ($url === '') return '#';

  if (preg_match('/^(https?:)?\/\//i', $url) || preg_match('/^(mailto:|tel:|javascript:|#)/i', $url)) {
    return $url;
  }

  $base = cc_base_path();

  if (strpos($url, $base . '/') === 0 || $url === $base) {
    return $url;
  }

  if ($url[0] === '/') {
    return $base . $url;
  }

  return $base . '/' . ltrim($url, '/');
}

 if (!isset($_SESSION['id'])) {
  header ("Location:" . cc_menu_url('/index.php')); 
 }
$menu_general = '';
$menu_config = '';
$panel_control = '';
if ($_SESSION['menu_general']['success']) {
    for ($i=0; $i < count($_SESSION['menu_general']['resultado']) ; $i++) { 
        if ($_SESSION['menu_general']['resultado'][$i]['tipo'] == 'GENERAL') {
            $nombre = $_SESSION['menu_general']['resultado'][$i]['nombre'];
            $url = $_SESSION['menu_general']['resultado'][$i]['url'];
          $url = cc_menu_url($url);
            $menu_general .= '<li class="nav-item">
                                    <a class="nav-link menu_principal" id="menu_'.$nombre.'" href="'.$url.'">'.$nombre.'</a>
                                </li>';
        }

        if ($_SESSION['menu_general']['resultado'][$i]['tipo'] == 'CONFIG') {
            $nombre = $_SESSION['menu_general']['resultado'][$i]['nombre'];
            $url = $_SESSION['menu_general']['resultado'][$i]['url'];
          $url = cc_menu_url($url);
            $menu_config .= '<a class="dropdown-item menu_principal" id="menu_'.$i.'" href="'.$url.'">'.$nombre.'</a>
            <div class="dropdown-divider"></div>';
        }

        if ($_SESSION['menu_general']['resultado'][$i]['tipo'] == 'SESION') {
            $nombre = $_SESSION['menu_general']['resultado'][$i]['nombre'];
            $url = $_SESSION['menu_general']['resultado'][$i]['url'];
          $url = cc_menu_url($url);
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

    <a class="navbar-brand" href="<?php echo cc_menu_url('/welcome.php'); ?>">
      <img src="<?php echo cc_menu_url('/assets/img/logos.png'); ?>" alt="COTICLICK">
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
            <a class="dropdown-item" href="<?php echo cc_menu_url('/php/cerrar_sesion.php'); ?>">
              <i class="fas fa-sign-out-alt mr-2" style="opacity:.85;"></i>
              Cerrar sesión
            </a>
          </div>
        </div>

      </div>
    </div>
  </div>
</nav>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="<?php echo cc_menu_url('/partials/SweetAlert.js'); ?>"></script>

<script>
(function() {
  if (window.__ccFormSweetInstalled) {
    return;
  }
  window.__ccFormSweetInstalled = true;

  var nativeAlert = window.alert ? window.alert.bind(window) : null;
  var lastManualMessage = { at: 0, message: '' };

  function normalizeType(type) {
    var safeType = String(type || 'info').toLowerCase();
    if (safeType === 'danger') {
      return 'error';
    }
    if (safeType !== 'success' && safeType !== 'error' && safeType !== 'warning' && safeType !== 'info') {
      return 'info';
    }
    return safeType;
  }

  function inferTypeFromMessage(message) {
    var text = String(message || '').toLowerCase();
    if (/error|fallo|fall\u00f3|fallida|invalid|invalido|inv\u00e1lido|no se pudo|denegad|rollback/.test(text)) {
      return 'error';
    }
    if (/exito|\u00e9xito|guardad|editad|actualizad|correctamente/.test(text)) {
      return 'success';
    }
    return 'info';
  }

  function sanitizeClientMessage(message, action, success) {
    var text = String(message || '').trim();
    var fallback = success
      ? (action === 'editar' ? 'Editado exitosamente' : 'Guardado exitosamente')
      : (action === 'editar' ? 'No se pudo editar la informacion. Intenta nuevamente.' : 'No se pudo guardar la informacion. Intenta nuevamente.');

    if (!text) {
      return fallback;
    }

    var technicalPattern = /(commit|transaccion|transacci\u00f3n|rollback|sql|mysqli|pdo|query|insert into|update\s+|delete\s+from|exception|stack|warning:|notice:|fatal error|undefined|line\s+\d+|rows? affected|execute|prepare)/i;
    if (technicalPattern.test(text)) {
      return fallback;
    }

    if (text.length > 180) {
      return fallback;
    }

    return text;
  }

  function showSweetMessage(message, type) {
    var safeMessage = String(message || '').trim() || 'Operacion realizada.';
    var safeType = normalizeType(type);

    if (typeof window.ccAlert === 'function') {
      window.ccAlert(safeMessage, safeType);
      return;
    }

    if (window.Swal && typeof window.Swal.fire === 'function') {
      window.Swal.fire({
        icon: safeType,
        text: safeMessage,
        confirmButtonText: 'Aceptar'
      });
      return;
    }

    if (nativeAlert) {
      nativeAlert(safeMessage);
    }
  }

  window.ccFormMessage = showSweetMessage;

  window.alert = function(message) {
    var text = String(message || '').trim() || 'Operacion realizada.';
    lastManualMessage = { at: Date.now(), message: text };
    showSweetMessage(text, inferTypeFromMessage(text));
  };

  function getCrudAction(url) {
    var match = String(url || '').match(/(?:^|\/)(guardar|editar)[^/]*\.php(?:\?|$)/i);
    return match ? match[1].toLowerCase() : null;
  }

  function parseJson(text) {
    if (!text) {
      return null;
    }
    try {
      return JSON.parse(text);
    } catch (e) {
      return null;
    }
  }

  function getDefaultMessage(action, success) {
    if (success) {
      return action === 'editar' ? 'Editado exitosamente' : 'Guardado exitosamente';
    }
    return action === 'editar' ? 'Error al editar' : 'Error al guardar';
  }

  function installCrudHooks() {
    if (!window.jQuery) {
      return false;
    }

    var $ = window.jQuery;

    $(document).ajaxComplete(function(event, xhr, settings) {
      var action = getCrudAction(settings && settings.url);
      if (!action) {
        return;
      }

      var data = (xhr && xhr.responseJSON) ? xhr.responseJSON : parseJson(xhr && xhr.responseText ? xhr.responseText : '');
      if (!data || data.success !== true) {
        return;
      }

      var message = sanitizeClientMessage(data.message, action, true);
      if ((Date.now() - lastManualMessage.at) < 700 && lastManualMessage.message === message) {
        return;
      }

      showSweetMessage(message, 'success');
    });

    $(document).ajaxError(function(event, xhr, settings) {
      var action = getCrudAction(settings && settings.url);
      if (!action) {
        return;
      }
      showSweetMessage(sanitizeClientMessage('', action, false), 'error');
    });

    return true;
  }

  if (!installCrudHooks()) {
    var tries = 0;
    var maxTries = 80;
    var intervalId = setInterval(function() {
      tries += 1;
      if (installCrudHooks() || tries >= maxTries) {
        clearInterval(intervalId);
      }
    }, 200);
  }
})();
</script>
