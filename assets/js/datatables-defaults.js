(function ($) {
  'use strict';

  if (!$.fn || !$.fn.dataTable) return;

  const DT_UI_TEXT = {
    show: 'Mostrar',
    entries: 'registros',
    searchPlaceholder: 'Buscar'
  };

  function enhanceDataTableUI(settings) {
    if (!settings || !settings.nTable) return;

    const $table = $(settings.nTable);
    const $wrapper = $table.closest('.dataTables_wrapper');
    if (!$wrapper.length) return;
    if ($wrapper.data('dtMinimalApplied')) return;

    $wrapper.data('dtMinimalApplied', true);
    $wrapper.addClass('dt-minimal-wrap');

    // Asegura tabla compacta y consistente
    $table.addClass('table-sm');

    // ===== Search (filtro) =====
    const $filter = $wrapper.find('div.dataTables_filter');
    if ($filter.length) {
      const $input = $filter.find('input').first();
      if ($input.length) {
        const $inputDetached = $input.detach(); // mantiene eventos
        $inputDetached
          .addClass('form-control form-control-sm')
          .attr('placeholder', $inputDetached.attr('placeholder') || DT_UI_TEXT.searchPlaceholder);

        const $group = $('<div class="input-group input-group-sm dt-search-group"></div>');
        $group.append(
          '<div class="input-group-prepend">' +
            '<span class="input-group-text"><i class="fas fa-search"></i></span>' +
          '</div>'
        );
        $group.append($inputDetached);

        $filter.empty().append($group);
      }
    }

    // ===== Length (mostrar X) =====
    const $length = $wrapper.find('div.dataTables_length');
    if ($length.length) {
      const $select = $length.find('select').first();
      if ($select.length) {
        const $selectDetached = $select.detach();
        // Bootstrap 4
        $selectDetached.addClass('custom-select custom-select-sm');

        const $lengthRow = $('<div class="dt-length"></div>');
        $lengthRow.append(`<span class="dt-muted">${DT_UI_TEXT.show}</span>`);
        $lengthRow.append($selectDetached);
        $lengthRow.append(`<span class="dt-muted">${DT_UI_TEXT.entries}</span>`);

        $length.empty().append($lengthRow);
      }
    }
  }

  // Defaults globales para que cualquier inicialización herede esto
  $.extend(true, $.fn.dataTable.defaults, {
    responsive: true,
    autoWidth: false,
    // Mantener controles estándar de DataTables (no forzamos DOM)
    // Mejora la experiencia en pantallas pequeñas
    // (si un init define scrollX/scrollY explícito, prevalece)
    scrollCollapse: true
  });

  // Al inicializar, hacemos la tabla un poco más compacta
  $(document).on('init.dt', function (e, settings) {
    enhanceDataTableUI(settings);
  });
})(jQuery);
