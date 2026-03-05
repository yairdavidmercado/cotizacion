(function ($) {
  'use strict';

  if (!$.fn || !$.fn.dataTable) return;

  // Defaults globales para que cualquier inicialización herede esto
  $.extend(true, $.fn.dataTable.defaults, {
    responsive: true,
    autoWidth: false,
    // Mejora la experiencia en pantallas pequeñas
    // (si un init define scrollX/scrollY explícito, prevalece)
    scrollCollapse: true
  });

  // Al inicializar, hacemos la tabla un poco más compacta
  $(document).on('init.dt', function (e, settings) {
    if (!settings || !settings.nTable) return;
    $(settings.nTable).addClass('table-sm');
  });
})(jQuery);
