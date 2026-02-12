// --- SweetAlert2 Pretty (CotiClick v2) ---
const CC_SWAL = {
  colors: {
    success: { main: '#22c55e', bg: 'rgba(34,197,94,.12)', glow: 'rgba(34,197,94,.25)' },
    error:   { main: '#ef4444', bg: 'rgba(239,68,68,.12)', glow: 'rgba(239,68,68,.25)' },
    warning: { main: '#f59e0b', bg: 'rgba(245,158,11,.12)', glow: 'rgba(245,158,11,.25)' },
    info:    { main: '#3b82f6', bg: 'rgba(59,130,246,.12)', glow: 'rgba(59,130,246,.25)' },
  },

  // Iconos más “finos”: círculo + gradiente sutil + trazo redondeado
  icons: {
    success: (c) => `
      <div class="cc-icon" style="--cc:${c.main};">
        <svg viewBox="0 0 24 24" aria-hidden="true">
          <path d="M20 7L10.5 16.5L4 10" />
        </svg>
      </div>`,
    error: (c) => `
      <div class="cc-icon" style="--cc:${c.main};">
        <svg viewBox="0 0 24 24" aria-hidden="true">
          <path d="M16 8L8 16" />
          <path d="M8 8L16 16" />
        </svg>
      </div>`,
    warning: (c) => `
      <div class="cc-icon" style="--cc:${c.main};">
        <svg viewBox="0 0 24 24" aria-hidden="true">
          <path d="M12 9v5" />
          <path d="M12 17h.01" />
        </svg>
      </div>`,
    info: (c) => `
      <div class="cc-icon" style="--cc:${c.main};">
        <svg viewBox="0 0 24 24" aria-hidden="true">
          <path d="M12 10.5V17" />
          <path d="M12 7h.01" />
        </svg>
      </div>`,
  },
};

// API simple: ccAlert("mensaje", "success|error|warning|info", "Título opcional")
function ccAlert(message, type = 'info', title = '') {
  const theme = CC_SWAL.colors[type] || CC_SWAL.colors.info;
  const iconHtml = (CC_SWAL.icons[type] || CC_SWAL.icons.info)(theme);

  return Swal.fire({
    title: title || '',
    html: `
      <div class="cc-body">
        <div class="cc-message">${message}</div>
      </div>
    `,
    icon: undefined,
    iconHtml,
    customClass: {
      popup: 'cc-swal',
      title: 'cc-swal-title',
      htmlContainer: 'cc-swal-html',
      confirmButton: 'cc-swal-btn',
    },
    buttonsStyling: false,
    confirmButtonText: 'Aceptar',
    showClass: { popup: 'cc-anim-in' },
    hideClass: { popup: 'cc-anim-out' },
    backdrop: 'rgba(15, 23, 42, .45)',
    focusConfirm: false,
  });
}

// Estilos (puedes moverlos a CSS)
(function injectCCSwalStyles() {
  const css = `
    /* Popup */
    .cc-swal{
      width: min(460px, calc(100vw - 32px)) !important;
      border-radius: 18px !important;
      padding: 18px 18px 14px !important;
      background: rgba(255,255,255,.88) !important;
      backdrop-filter: blur(10px) saturate(140%);
      -webkit-backdrop-filter: blur(10px) saturate(140%);
      border: 1px solid rgba(148,163,184,.35) !important;
      box-shadow:
        0 22px 70px rgba(15,23,42,.28),
        0 2px 0 rgba(255,255,255,.6) inset !important;
    }

    /* Animaciones */
    .cc-anim-in{ animation: ccIn .18s ease-out both; }
    .cc-anim-out{ animation: ccOut .14s ease-in both; }
    @keyframes ccIn{ from{ transform: translateY(8px) scale(.98); opacity: 0; } to{ transform: translateY(0) scale(1); opacity: 1; } }
    @keyframes ccOut{ from{ transform: translateY(0) scale(1); opacity: 1; } to{ transform: translateY(6px) scale(.98); opacity: 0; } }

    /* Icon wrapper */
    .cc-swal .swal2-icon{
      border: 0 !important;
      margin: 4px auto 0 !important;
      width: auto !important;
      height: auto !important;
    }
    .cc-icon{
      width: 54px;
      height: 54px;
      border-radius: 16px;
      display: grid;
      place-items: center;
      background:
        radial-gradient(120% 120% at 20% 10%, rgba(255,255,255,.9) 0%, rgba(255,255,255,.35) 35%, transparent 60%),
        linear-gradient(180deg, rgba(255,255,255,.65), rgba(255,255,255,.35)),
        var(--ccbg);
      border: none !important;
      box-shadow:
        0 10px 30px rgba(15,23,42,.10),
        0 0 0 6px var(--ccglow);
    }
    .cc-icon svg{
      width: 26px;
      height: 26px;
      stroke: var(--cc);
      fill: none;
      stroke-width: 6.4;
      stroke-linecap: round;
      stroke-linejoin: round;
      filter: drop-shadow(0 6px 10px rgba(15,23,42,.12));
    }

    /* Title + body */
    .cc-swal-title{
      font-size: 16px !important;
      font-weight: 900 !important;
      letter-spacing: -.2px;
      color: #0f172a !important;
      margin: 10px 0 4px !important;
    }
    .cc-swal-html{
      margin: 6px 0 14px !important;
      padding: 0 !important;
    }
    .cc-body{
      display: grid;
      gap: 10px;
    }
    .cc-message{
      font-size: 14px;
      line-height: 1.45;
      color: rgba(15,23,42,.85);
    }

    /* Buttons */
    .cc-swal-btn{
      border: 0 !important;
      border-radius: 14px !important;
      padding: 11px 16px !important;
      font-weight: 900 !important;
      letter-spacing: -.1px;
      color: #fff !important;
      background: linear-gradient(135deg, #3b82f6 0%, #2563eb 55%, #1d4ed8 100%) !important;
      box-shadow: 0 12px 28px rgba(37,99,235,.28);
      transition: transform .12s ease, filter .12s ease, box-shadow .12s ease;
    }
    .cc-swal-btn:hover{
      filter: brightness(1.02);
      transform: translateY(-1px);
      box-shadow: 0 16px 34px rgba(37,99,235,.34);
    }
    .cc-swal-btn:active{
      transform: translateY(0);
      box-shadow: 0 10px 22px rgba(37,99,235,.26);
    }
    .cc-swal-btn:focus{
      box-shadow: 0 0 0 4px rgba(59,130,246,.25), 0 14px 30px rgba(37,99,235,.30) !important;
      outline: none !important;
    }

    /* Reduce extra spacing sweetalert adds */
    .cc-swal .swal2-actions{ margin: 0 !important; }
  `;

  const style = document.createElement('style');
  style.setAttribute('data-cc-swal', 'true');
  style.innerHTML = css;
  document.head.appendChild(style);
})();
