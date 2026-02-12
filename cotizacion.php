<?php
// start a session
session_start();
 if (!isset($_SESSION['id'])) {
    header ("Location:index.php"); 
 }

 if (!isset($_SESSION['id_hotel'])) {
    header ("Location:welcome.php"); 
  }

  $usuarios = '<button type="button" class="btn btn-link btn-sm float-right" data-toggle="modal" data-target=".crear_titular_modal" >Crear titular</button>';
  if ($_SESSION['menu_general']['success']) {
    for ($i=0; $i < count($_SESSION['menu_general']['resultado']) ; $i++) { 
        if ($_SESSION['menu_general']['resultado'][$i]['nombre'] == 'usuarios') {
          $usuarios = '<button type="button" class="btn btn-link btn-sm float-right" data-toggle="modal" data-target=".crear_titular_modal" >Crear titular</button>';
        }
    }
  }
?>
<!doctype html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.6">
    <title>CotiClick</title>
<meta name="theme-color" content="#563d7c">

    <style>
      /* ===== COTICLICK MOCKUP LAYOUT ===== */
      .cc-page{
        background-image: url('assets/img/bg-coticlick.png');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        background-attachment: fixed; /* opcional: efecto “fijo” */
        min-height: 0;
      }

      /* Contenedor general: panel izquierda + imagen derecha */
      .cc-shell{
        min-height: 0;
        display: grid;
        grid-template-columns: 520px 1fr;
        gap: 28px;
        padding: 50px 48px 48px; /* deja espacio al menú fixed-top */
      }

      /* Panel flotante */
      .cc-panel{
        background: rgba(255,255,255,.92);
        border: 1px solid rgba(15,23,42,.08);
        border-radius: 18px;
        box-shadow: 0 18px 60px rgba(15,23,42,.12);
        padding: 18px;
        backdrop-filter: blur(6px);
      }

      /* Imagen derecha */
      .cc-hero{
        border-radius: 18px;
        background-image: url('assets/img/bg-coticlick.png'); /* <-- cambia esta ruta a tu imagen */
        background-size: cover;
        background-position: center;
        box-shadow: inset 0 0 0 1px rgba(15,23,42,.06);
      }

      /* ===== Ajustes visuales de Bootstrap dentro del panel ===== */

      /* Tabs más minimal */
      .cc-panel .nav-tabs{
        border-bottom: 1px solid rgba(15,23,42,.08);
      }
      .cc-panel .nav-tabs .nav-link{
        border: 0;
        color: rgba(15,23,42,.65);
        font-weight: 600;
      }
      .cc-panel .nav-tabs .nav-link.active{
        color: #0f172a;
        background: transparent;
        border: 0;
        position: relative;
      }
      .cc-panel .nav-tabs .nav-link.active::after{
        content:"";
        position:absolute;
        left: 10px;
        right: 10px;
        bottom: -10px;
        height: 2px;
        background: #2d7ff9;
        border-radius: 999px;
      }

      /* Card estilo mockup */
      .cc-panel .card{
        border: 1px solid rgba(15,23,42,.08) !important;
        border-radius: 16px !important;
        box-shadow: 0 10px 30px rgba(15,23,42,.06);
        overflow: hidden;
      }
      .cc-panel .card-header{
        background: #fff !important;
        border-bottom: 1px solid rgba(15,23,42,.08) !important;
        font-weight: 700;
      }

      /* Inputs compactos */
      .cc-panel .form-control,
      .cc-panel .select2-selection{
        border-radius: 12px !important;
        border: 1px solid rgba(15,23,42,.12) !important;
        height: 40px;
      }
      .cc-panel textarea.form-control{
        height: auto;
        min-height: 90px;
      }

      /* Select2 dentro del panel */
      .select2-container--default .select2-selection--single{
        height: 40px !important;
        border-radius: 12px !important;
        border: 1px solid rgba(15,23,42,.12) !important;
      }
      .select2-container--default .select2-selection--single .select2-selection__rendered{
        line-height: 40px !important;
      }
      .select2-container--default .select2-selection--single .select2-selection__arrow{
        height: 40px !important;
      }

      /* Botón principal como mockup */
      .cc-panel .btn-success{
        background: #2d7ff9 !important;
        border-color: #2d7ff9 !important;
        border-radius: 12px !important;
        padding: 10px 16px;
        font-weight: 700;
      }
      .cc-panel .btn-success:hover{
        filter: brightness(1.05);
      }

      /* Botón "Crear titular" como link pill */
      .cc-panel .btn-link{
        color: #2d7ff9 !important;
        font-weight: 700;
        text-decoration: none !important;
      }
      .cc-panel .btn-link:hover{
        text-decoration: underline !important;
      }

      /* Responsive */
      @media (max-width: 1100px){
        .cc-shell{
          grid-template-columns: 1fr;
          padding: 50px 18px 24px;
        }
        .cc-hero{
          min-height: 260px;
          order: -1;
        }
      }

      .cc-panel .datarange, .cc-panel .datarange_tour, .cc-panel .datarange_alq {
        border-radius: 12px 0 0 12px !important;
        border: 1px solid rgba(15, 23, 42, .12) !important;
        height: 40px;
      }

        /* Estilo limpio tipo mockup */
      .pax-card{
        border: 1px solid rgba(15,23,42,.10);
        border-radius: 16px;
        box-shadow: 0 10px 30px rgba(15,23,42,.08);
      }
      .pax-row{
        /* border: 1px solid rgba(15,23,42,.12); */
        border-radius: 12px;
        padding: .2rem .50rem;
        background: #fff;
        width: 100%;
        margin: 0 15px;
      }
      .pax-row + .pax-row{ margin-top: .75rem; }
      .pax-label{
        font-weight: 600;
        margin-bottom: .35rem;
        color: #0f172a;
      }
      .pax-row.disabled{
        opacity: .55;
      }
      .pax-stepper{
        max-width: 130px;
      }
      .pax-stepper input{
        text-align: center;
        font-weight: 700;
      }
      .pax-stepper .btn{
        /* border-color: rgba(15,23,42,.12); */
      }

      .form-control.pax-input {
        border-radius: 0px !important;
      }


      @media (min-width: 1100px){
        .cc-shell-wrap{
          transform: scale(0.85);
          transform-origin: top left;
          width: calc(100% / 0.85);
          height: calc(100% / 0.85);
        }

        .select2-dropdown {
          /* transform: scale(0.85);
          transform-origin: top left; */
          width: calc(100% / 0.85);
          /* height: calc(100% / 0.85);
          position: relative !important; */
        }
      }
      @media (max-width: 1099px){
        .cc-shell-wrap{
          transform: none;
          width: 100%;
          height: auto;
        }
      }
      .field-error {
        border-color: #dc3545 !important;
      }

      .select2-selection.field-error {
        border-color: #dc3545 !important;
      }

      .invalid-feedback {
        display: block !important;
        font-size: 0.875rem;
        color: #dc3545;
        margin-top: 0.25rem;
        font-weight: 500;
      }

      /* ===== ESTILOS PARA PREVISUALIZACIÓN TIPO MOCKUP ===== */
      .cotizacion-preview-container {
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
      }
      .cotizacion-section {
        background: white;
        border-radius: 12px;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
        box-shadow: 0 1px 3px rgba(0,0,0,0.05);
      }
      .section-header {
        display: flex;
        align-items: center;
        margin-bottom: 1rem;
        padding-bottom: 0.75rem;
        border-bottom: 1px solid #e2e8f0;
      }
      .section-icon {
        width: 36px;
        height: 36px;
        background: #eff6ff;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 12px;
        color: #3b82f6;
        font-size: 18px;
      }
      .section-title {
        font-size: 16px;
        font-weight: 700;
        color: #1e293b;
        margin: 0;
      }
      .info-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1rem;
        font-size: 13px;
      }
      @media (max-width: 768px) {
        .info-grid {
          grid-template-columns: 1fr;
        }
      }
      .info-item {
        display: flex;
        flex-direction: column;
      }
      .info-label {
        font-size: 11px;
        color: #64748b;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 4px;
      }
      .info-value {
        color: #1e293b;
        font-weight: 500;
      }
      .cotizacion-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 13px;
      }
      .table-wrapper {
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
      }
      @media (max-width: 768px) {
        .cotizacion-table {
          font-size: 11px;
        }
        .cotizacion-table th,
        .cotizacion-table td {
          padding: 8px 6px;
        }
      }
      .cotizacion-table thead {
        background: #f8fafc;
      }
      .cotizacion-table th {
        padding: 10px;
        text-align: left;
        font-size: 11px;
        font-weight: 700;
        color: #64748b;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        border-bottom: 2px solid #e2e8f0;
      }
      .cotizacion-table td {
        padding: 12px 10px;
        border-bottom: 1px solid #f1f5f9;
        color: #334155;
      }
      .cotizacion-table tbody tr:last-child td {
        border-bottom: none;
      }
      .table-number {
        text-align: center;
        font-weight: 600;
        color: #94a3b8;
      }
      .table-right {
        text-align: right;
      }
      .totals-section {
        background: #f8fafc;
        border-radius: 8px;
        padding: 1rem;
        margin-top: 1rem;
      }
      .total-row {
        display: flex;
        justify-content: space-between;
        padding: 8px 0;
        font-size: 13px;
      }
      .total-row.grand-total {
        border-top: 2px solid #cbd5e1;
        margin-top: 8px;
        padding-top: 12px;
        font-size: 18px;
        font-weight: 700;
        color: #1e293b;
      }
      .acomodacion-box {
        background: #f8fafc;
        border-radius: 8px;
        padding: 1rem;
        font-size: 12px;
        color: #475569;
        line-height: 1.6;
      }
      .acomodacion-label {
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 4px;
      }
    </style>
  </head>
  <body class="cc-page">
  <?php require("menu.php"); ?>
  <div class="loader"></div>
  <br>
  <br>
  <main class="cc-shell-wrap"> 
    <main class="cc-shell">
      <section class="cc-panel">
        <div class="row">
          <div class="col-12">
            <div class="card mt-3">
              <div class="card-body">
                
                <div class="row">
                  <div class="col-md-12 mb-3">
                  <?php echo $usuarios ?>
                  <label for="firstName">Nombre del titular</label>
                    <select style="width:100%" name="id_usuario" required id="id_usuario" onchange="detalle_titular(this.value)" class="form-control form-control-md id_usuarios">
                      <option value="">Seleccionar</option>
                    </select>
                  </div>
                  <div class="col-md-12 mb-3">
                    <label><span >Tipo de Cotización</span></label>
                    <br>
                    <div class="form-check-inline">
                      <label class="form-check-label" style='font-size:12px'>
                        <input type="checkbox" name="tipo_cotizacion[]" required value="1" onclick="showFormCotizacion(1, this.checked)" class="form-check-input">Alojamiento
                      </label>
                    </div>
                    <div class="form-check-inline">
                      <label class="form-check-label" style='font-size:12px'>
                        <input type="checkbox" name="tipo_cotizacion[]" required value="2" onclick="showFormCotizacion(2, this.checked)" class="form-check-input">Tour
                      </label>
                    </div>
                    <div class="form-check-inline">
                      <label class="form-check-label" style='font-size:12px'>
                        <input type="checkbox" name="tipo_cotizacion[]" required value="3" onclick="showFormCotizacion(3, this.checked)" class="form-check-input">Alquiler
                      </label>
                    </div>
                  </div>
                </div>

              </div>
            </div>
          </div>
          <div class="col-12">
            <form role="form" onsubmit="event.preventDefault(); return GuardarTodoCotizaciones();" style="display:none" id="form_alojamiento" class="needs-validation">
              <div class="card mt-3">
                <h5 class="card-header d-flex justify-content-between align-items-center"
                data-toggle="collapse"
                data-target="#collapseCotizacion"
                aria-expanded="true"
                style="cursor:pointer;">
                Cotización de alojamiento</h5>
                <div id="collapseCotizacion" class="collapse show">
                  <div class="card-body">
                    <input type="hidden" name="id_titular" class="id_titular_hidden" value="">
                    <div class="row">
                      <div class="col-md-12 mb-3">
                        <label for="firstName">Motivo de viaje</label>
                        <select style="width:100%" name="id_motivo" required id="id_motivo" class="form-control form-control-md id_motivos">
                          <option value="">Seleccionar</option>
                        </select>
                      </div>
                      <div class="col-md-12 mb-3">
                        <label for="firstName">Planes</label>
                        <select style="width:100%" name="id_planes" onchange="traer_productos(this.value, '')" required id="id_planes" class="form-control form-control-md id_planess">
                          <option value="">Seleccionar</option>
                        </select>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12 mb-3">
                        <label><span >Tipo de servicio</span></label>
                        <br>
                        <div class="form-check-inline">
                          <label class="form-check-label" style='font-size:12px'>
                            <input type="radio" name="tipo_viaje" onclick="traer_tarifas(0, '')" required value="0" class="form-check-input" value="">Pasadía
                          </label>
                        </div>
                        <div class="form-check-inline">
                          <label class="form-check-label" style='font-size:12px'>
                            <input type="radio" name="tipo_viaje" onclick="traer_tarifas(1, '')" required value="1" class="form-check-input" value="">Noches
                          </label>
                        </div>
                        <div class="form-check-inline" style="display:none">
                          <label class="form-check-label" style='font-size:12px'>
                            <input type="radio" name="tipo_viaje" onclick="traer_tarifas(2, '')" required value="2" class="form-check-input" value="">Alquiler
                          </label>
                        </div>
                      </div>
                      <div class="col-md-12 mb-3">
                        <label for="firstName">Tarifa</label>
                        <select style="width:100%" name="id_tarifa" disabled required id="id_tarifa" class="form-control form-control-md id_tarifas">
                            <option value="">Seleccionar</option>
                        </select>
                      </div>
                      <div class="col-md-12 mb-3" id="content_dateRange">
                        <label for="lastName">Fecha</label>
                        <div class="input-group">
                            <input id="DateRange" required disabled name="DateRange" autocomplete="off" placeholder="Seleccionar rango de fechas" class="form-control datarange" />
                            <input type="hidden" autocomplete="off" class="form-control datarange " name="startDate" id="startDate" placeholder="" required>
                            <input type="hidden" autocomplete="off" class="form-control datarange" name="endDate" id="endDate" placeholder="" required>                  
                            <div class="input-group-append">
                              <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                            </div>
                          </div>
                      </div>
                      <!-- <div class="col-md-12 mb-3" id="content_startDate">
                        <label for="lastName">Fecha entrada</label>
                        <input type="text" autocomplete="off" disabled class="form-control datarange " name="startDate" id="startDate" placeholder="" required>  
                      </div>
                      <div class="col-md-12 mb-3" id="content_endDate">
                        <label for="lastName">Fecha salida</label>
                        <input type="text" autocomplete="off" disabled class="form-control datarange" name="endDate" id="endDate" placeholder="" required>
                        <input type="hidden" value="0" name="count_noches" id="count_noches">                    
                      </div> -->
                    </div>
                    <div class="row" id="iniciartarifas">
                      
                    </div>
                    <div class="row">
                      <div class="col-md-12 mb-3">
                        <label for="firstName">Acomodación</label>
                        <textarea style="width:100%" name="id_acomodacion" required id="id_acomodacion" class="form-control form-control-md id_acomodacion"></textarea>
                      </div>
                    </div>
                  </div>

                </div>    
              </div>  
            </form>
            <form role="form" onsubmit="event.preventDefault(); return GuardarTodoCotizaciones();" style="display:none" id="form_tour" class="needs-validation">
              <div class="card mt-3">
                <h5 class="card-header d-flex justify-content-between align-items-center"
                    data-toggle="collapse"
                    data-target="#collapseCotizacionTour"
                    aria-expanded="true"
                    style="cursor:pointer;">
                  Cotización de Tours
                </h5>

                <div id="collapseCotizacionTour" class="collapse show">
                  <div class="card-body">
                    <input type="hidden" name="id_titular" class="id_titular_hidden" value="">
                    <div class="row">

                      <div class="col-md-12 mb-3">
                        <label for="id_motivo_tour">Motivo de viaje</label>
                        <select style="width:100%" name="id_motivo_tour" required id="id_motivo_tour"
                                class="form-control form-control-md id_motivos_tour">
                          <option value="">Seleccionar</option>
                        </select>
                      </div>

                      <div class="col-md-12 mb-3">
                        <label for="id_planes_tour">Planes</label>
                        <select style="width:100%" name="id_planes_tour" onchange="traer_productos(this.value, '_tour')" required
                                id="id_planes_tour" class="form-control form-control-md id_planess_tour">
                          <option value="">Seleccionar</option>
                        </select>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-12 mb-3">
                        <label><span>Tipo de servicio</span></label>
                        <br>

                        <div class="form-check-inline">
                          <label class="form-check-label" style="font-size:12px">
                            <input type="radio" name="tipo_viaje_tour" onclick="traer_tarifas(0, '_tour')" required value="0" class="form-check-input">
                            Pasadía
                          </label>
                        </div>

                        <div class="form-check-inline">
                          <label class="form-check-label" style="font-size:12px">
                            <input type="radio" name="tipo_viaje_tour" onclick="traer_tarifas(1, '_tour')" required value="1" class="form-check-input">
                            Noches
                          </label>
                        </div>

                        <div class="form-check-inline" style="display:none">
                          <label class="form-check-label" style="font-size:12px">
                            <input type="radio" name="tipo_viaje_tour" onclick="traer_tarifas(2, '_tour')" required value="2" class="form-check-input">
                            Alquiler
                          </label>
                        </div>
                      </div>

                      <div class="col-md-12 mb-3">
                        <label for="id_tarifa_tour">Tarifa</label>
                        <select style="width:100%" name="id_tarifa_tour" disabled required id="id_tarifa_tour"
                                class="form-control form-control-md id_tarifas_tour">
                          <option value="">Seleccionar</option>
                        </select>
                      </div>

                      <div class="col-md-12 mb-3" id="content_dateRange_tour">
                        <label for="DateRange_tour">Fecha</label>
                        <div class="input-group">
                          <input id="DateRange_tour" disabled name="DateRange_tour" autocomplete="off"
                                placeholder="Seleccionar rango de fechas" class="form-control datarange_tour" />
                          <input type="hidden" autocomplete="off" disabled class="form-control datarange_tour"
                                name="startDate_tour" id="startDate_tour" required>
                          <input type="hidden" autocomplete="off" disabled class="form-control datarange_tour"
                                name="endDate_tour" id="endDate_tour" required>
                          <div class="input-group-append">
                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="row" id="iniciartarifas_tour"></div>

                    <div class="row">
                      <div class="col-md-12 mb-3">
                        <label for="id_acomodacion_tour">Acomodación</label>
                        <textarea style="width:100%" name="id_acomodacion_tour" required id="id_acomodacion_tour"
                                  class="form-control form-control-md id_acomodacion_tour"></textarea>
                      </div>
                    </div>

                  </div>
                </div>
              </div>
            </form>
            <form role="form" onsubmit="event.preventDefault(); return GuardarTodoCotizaciones();" style="display:none" id="form_alquiler" class="needs-validation">
              <div class="card mt-3">
                <h5 class="card-header d-flex justify-content-between align-items-center"
                    data-toggle="collapse"
                    data-target="#collapseCotizacionAlq"
                    aria-expanded="true"
                    style="cursor:pointer;">
                  Cotización de Alquileres
                </h5>

                <div id="collapseCotizacionAlq" class="collapse show">
                  <div class="card-body">
                    <input type="hidden" name="id_titular" class="id_titular_hidden" value="">
                    <div class="row">

                      <div class="col-md-12 mb-3">
                        <label for="id_motivo_alq">Motivo de viaje</label>
                        <select style="width:100%" name="id_motivo_alq" required id="id_motivo_alq"
                                class="form-control form-control-md id_motivos_alq">
                          <option value="">Seleccionar</option>
                        </select>
                      </div>

                      <div class="col-md-12 mb-3">
                        <label for="id_planes_alq">Planes</label>
                        <select style="width:100%" name="id_planes_alq" onchange="traer_productos(this.value, '_alq')" required
                                id="id_planes_alq" class="form-control form-control-md id_planess_alq">
                          <option value="">Seleccionar</option>
                        </select>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-12 mb-3">
                        <label><span>Tipo de servicio</span></label>
                        <br>

                        <!-- En alquiler normalmente tendría sentido dejar solo “Alquiler” visible -->
                        <div class="form-check-inline">
                          <label class="form-check-label" style="font-size:12px">
                            <input type="radio" name="tipo_viaje_alq" onclick="traer_tarifas(2, '_alq')" required value="2" class="form-check-input">
                            Alquiler
                          </label>
                        </div>

                        <!-- Si quieres mantener las otras opciones, quita el display:none -->
                        <div class="form-check-inline" style="display:none">
                          <label class="form-check-label" style="font-size:12px">
                            <input type="radio" name="tipo_viaje_alq" onclick="traer_tarifas(0, '_alq')" required value="0" class="form-check-input">
                            Pasadía
                          </label>
                        </div>

                        <div class="form-check-inline" style="display:none">
                          <label class="form-check-label" style="font-size:12px">
                            <input type="radio" name="tipo_viaje_alq" onclick="traer_tarifas(1, '_alq')" required value="1" class="form-check-input">
                            Noches
                          </label>
                        </div>
                      </div>

                      <div class="col-md-12 mb-3">
                        <label for="id_tarifa_alq">Tarifa</label>
                        <select style="width:100%" name="id_tarifa_alq" disabled required id="id_tarifa_alq"
                                class="form-control form-control-md id_tarifas_alq">
                          <option value="">Seleccionar</option>
                        </select>
                      </div>

                      <div class="col-md-12 mb-3" id="content_dateRange_alq">
                        <label for="DateRange_alq">Fecha</label>
                        <div class="input-group">
                          <input id="DateRange_alq" disabled name="DateRange_alq" autocomplete="off"
                                placeholder="Seleccionar rango de fechas" class="form-control datarange_alq" />
                          <input type="hidden" autocomplete="off" disabled class="form-control datarange_alq"
                                name="startDate_alq" id="startDate_alq" required>
                          <input type="hidden" autocomplete="off" disabled class="form-control datarange_alq"
                                name="endDate_alq" id="endDate_alq" required>
                          <div class="input-group-append">
                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="row" id="iniciartarifas_alq"></div>

                    <div class="row">
                      <div class="col-md-12 mb-3">
                        <label for="id_acomodacion_alq">Acomodación</label>
                        <textarea style="width:100%" name="id_acomodacion_alq" required id="id_acomodacion_alq"
                                  class="form-control form-control-md id_acomodacion_alq"></textarea>
                      </div>
                    </div>

                  </div>
                </div>
              </div>
            </form>
          </div>
          <div class="col-12">
            <div class="card mt-3">
              <div class="card-body">
                
                <div class="row">
                  <div class="col-12 mb-3">
                    <button type="button" class="btn btn-success btn-block" onclick="GuardarTodoCotizaciones()">
                      Guardar cotización
                    </button>
                  </div>
                </div>

              </div>
            </div>
          </div>

        </div>
      </section>
      <section class="cc-hero" aria-hidden="true">
        <div class="row">
          <div class="col-12">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Crear</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" onclick="show_traer_tabla_cotizacion()" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Buscar</a>
              </li>
            </ul>
            <div class="tab-content" id="myTabContent">
              <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                <div class="cotizacion-preview-container" style="max-width: 900px; margin: 0 auto; padding: 1rem;">
                  <div class="cotizacion-section" id="content_info_titular" style="display:none">
                    <div class="section-header">
                      <div class="section-icon">
                        <i class="fas fa-user"></i>
                      </div>
                      <h2 class="section-title">Información del titular</h2>
                    </div>
                    <div class="info-grid">
                      <div class="info-item">
                        <span class="info-label">Nombre</span>
                        <span class="info-value" id="txt_nombre_titular"></span>
                      </div>
                      <div class="info-item">
                        <span class="info-label">Email</span>
                        <span class="info-value" id="txt_email_titular"></span>
                      </div>
                      <div class="info-item">
                        <span class="info-label">Cédula</span>
                        <span class="info-value" id="txt_cedula_titular"></span>
                      </div>
                      <div class="info-item">
                        <span class="info-label">Teléfono</span>
                        <span class="info-value" id="txt_telefono_titular"></span>
                      </div>
                      <div class="info-item" style="grid-column: 1 / -1;">
                        <span class="info-label">Dirección</span>
                        <span class="info-value" id="txt_direccion_titular"></span>
                      </div>
                    </div>
                  </div>
                  <div class="cotizacion-section" id="content_info_planes" style="display:none">
                    <div class="section-header">
                      <div class="section-icon">
                        <i class="fas fa-bed"></i>
                      </div>
                      <h2 class="section-title">Acomodación</h2>
                    </div>
                    <div class="acomodacion-box">
                      <div id="content_detalles_plan"></div>
                      <div id="descripcion_servicios" style="margin-top: 1rem;"></div>
                      <div id="content_servicios_incluidos" style="margin-top: 1rem; color: #64748b; font-size: 11px;"></div>
                    </div>
                  </div>
                  <div class="cotizacion-section" id="content_info_planes_tour" style="display:none">
                    <div class="section-header">
                      <div class="section-icon">
                        <i class="fas fa-route"></i>
                      </div>
                      <h2 class="section-title">Descripción del Plan - Tour</h2>
                    </div>
                    <div class="acomodacion-box">
                      <div id="content_detalles_plan_tour"></div>
                      <div id="descripcion_servicios_tour" style="margin-top: 1rem;"></div>
                      <div id="content_servicios_incluidos_tour" style="margin-top: 1rem; color: #64748b; font-size: 11px;"></div>
                    </div>
                  </div>
                  <div class="cotizacion-section" id="content_info_planes_alq" style="display:none">
                    <div class="section-header">
                      <div class="section-icon">
                        <i class="fas fa-car"></i>
                      </div>
                      <h2 class="section-title">Descripción del Plan - Alquiler</h2>
                    </div>
                    <div class="acomodacion-box">
                      <div id="content_detalles_plan_alq"></div>
                      <div id="descripcion_servicios_alq" style="margin-top: 1rem;"></div>
                      <div id="content_servicios_incluidos_alq" style="margin-top: 1rem; color: #64748b; font-size: 11px;"></div>
                    </div>
                  </div>
                  <div class="cotizacion-section" id="content_info_tarifa" style="display:none">
                    <div class="section-header">
                      <div class="section-icon">
                        <i class="fas fa-list-ul"></i>
                      </div>
                      <h2 class="section-title">Detalles - Alojamiento</h2>
                    </div>
                    <div class="info-grid" id="detalle_tarifa" style="margin-bottom: 1rem;"></div>
                    <div class="table-wrapper">
                      <table class="cotizacion-table">
                        <thead>
                          <tr>
                            <th>Item</th>
                            <th style="width: 100px; text-align: center;">Cantidad</th>
                            <th style="width: 140px; text-align: right;">Valor unitario</th>
                            <th style="width: 120px; text-align: right;">Total</th>
                          </tr>
                        </thead>
                        <tbody id="tbody_tarifa"></tbody>
                      </table>
                    </div>
                    <div class="totals-section" id="content_subtotal"></div>
                  </div>
                  <div class="cotizacion-section" id="content_info_tarifa_tour" style="display:none">
                    <div class="section-header">
                      <div class="section-icon">
                        <i class="fas fa-route"></i>
                      </div>
                      <h2 class="section-title">Detalles - Tour</h2>
                    </div>
                    <div class="info-grid" id="detalle_tarifa_tour" style="margin-bottom: 1rem;"></div>
                    <div class="table-wrapper">
                      <table class="cotizacion-table">
                        <thead>
                          <tr>
                            <th>Item</th>
                            <th style="width: 100px; text-align: center;">Cantidad</th>
                            <th style="width: 140px; text-align: right;">Valor unitario</th>
                            <th style="width: 120px; text-align: right;">Total</th>
                          </tr>
                        </thead>
                        <tbody id="tbody_tarifa_tour"></tbody>
                      </table>
                    </div>
                    <div class="totals-section" id="content_subtotal_tour"></div>
                  </div>
                  <div class="cotizacion-section" id="content_info_tarifa_alq" style="display:none">
                    <div class="section-header">
                      <div class="section-icon">
                        <i class="fas fa-car"></i>
                      </div>
                      <h2 class="section-title">Detalles - Alquiler</h2>
                    </div>
                    <div class="info-grid" id="detalle_tarifa_alq" style="margin-bottom: 1rem;"></div>
                    <div class="table-wrapper">
                      <table class="cotizacion-table">
                        <thead>
                          <tr>
                            <th>Item</th>
                            <th style="width: 100px; text-align: center;">Cantidad</th>
                            <th style="width: 140px; text-align: right;">Valor unitario</th>
                            <th style="width: 120px; text-align: right;">Total</th>
                          </tr>
                        </thead>
                        <tbody id="tbody_tarifa_alq"></tbody>
                      </table>
                    </div>
                    <div class="totals-section" id="content_subtotal_alq"></div>
                  </div>
                </div>
              </div>
              <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <br>
                <br>
                <div class="responsive">
                  <table id="tabla_cotizacion" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>codigo</th>
                            <th>cédula</th>
                            <th>Titular</th>
                            <th>Noches</th>
                            <th>Motivo</th>
                            <th>Plan</th>
                            <th>Fecha entrada</th>
                            <th>fecha salida</th>
                            <th>Fecha expedición</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="body_table_cotizacion">
                        
                    </tbody>
                  </table>
                </div>
                

                </div>
            </div>
          </div>
        </div>
      </section>
    </main>
  </main>

  <button type="button" id="brn_modal_print" class="btn btn-primary" style="display:none" data-toggle="modal" data-target=".bd-example-modal-lg">Large modal</button>

<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" style="max-width: 95%;">
    <div class="modal-content">
      <div class="modal-header">
        <div id="btn_pdf">

        </div>
        <h5 class="modal-title">Previsualización de cotización</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body" id="print_cotizacion" style="padding: 0; background: #f8fafc;">
        
      </div>
    </div>
  </div>
</div>


<div class="modal fade crear_titular_modal" id="crear_titular_modal" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <div id="btn_pdf">

        </div>
        <h5 class="modal-title">Crear titular</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="card mt-3">
          <div class="card-body">
            <form role="form" onsubmit="event.preventDefault(); return GuardarUsuario();" id="form_guardar" class="needs-validation">
              <div class="row">
                <div style="display:none" class="col-md-6 mb-3" >
                  <label for="lastName">Código</label>
                  <input type="text" autocomplete="off"  value="0" class="form-control " onkeypress="return isNumber(event)" name="codigo" id="codigo" placeholder="" required>                    
                </div>
                <div class="col-md-3 mb-3" >
                  <label for="lastName">Primer nombre</label>
                  <input type="text" autocomplete="off" class="form-control  "  maxLength="255" name="nombre1" id="nombre1" placeholder="" required>                    
                </div>
                <div class="col-md-3 mb-3" >
                  <label for="lastName">Segundo nombre</label>
                  <input type="text" autocomplete="off" class="form-control "  maxLength="255" name="nombre2" id="nombre2" placeholder="" >                    
                </div>
                <div class="col-md-3 mb-3" >
                  <label for="lastName">Primer Apellido</label>
                  <input type="text" autocomplete="off" class="form-control "  maxLength="255" name="apellido1" id="apellido1" placeholder="" >                    
                </div>
                <div class="col-md-3 mb-3" >
                  <label for="lastName">Segundo apellido</label>
                  <input type="text" autocomplete="off" class="form-control "  maxLength="255" name="apellido2" id="apellido2" placeholder="" >                    
                </div>
                <div class="col-md-6 mb-3" >
                  <label for="lastName">Cédula</label>
                  <input type="text" autocomplete="off" class="form-control "  maxLength="11"  onkeypress="return isNumber(event)" name="cedula" id="cedula" placeholder="" >                    
                </div>
                <div class="col-md-6 mb-3">
                  <label for="lastName">Email</label>
                  <input type="email" autocomplete="off" class="form-control"  maxLength="100" name="email" id="email" placeholder="" >                   
                </div>
                <div class="col-md-6 mb-3">
                  <label for="lastName">Teléfono</label>
                  <input type="text" autocomplete="off" onkeypress="return isNumber(event)"  maxLength="15" class="form-control " name="telefono" id="telefono" placeholder="" required>                    
                </div>
                <div class="col-md-3 mb-3">
                  <label for="firstName">Pais</label>
                  <select style="width:100%" name="select_pais" onchange="traer_deptos(this.value)" required id="select_pais" class="form-control form-control-md paises">
                    <option value="">Seleccionar</option>
                  </select>
                </div>
                <div class="col-md-3 mb-3">
                  <label for="firstName">Departamento</label>
                  <select style="width:100%" name="select_deptos" id="select_deptos" class="form-control form-control-md deptos">
                    <option value="">Seleccionar</option>
                  </select>
                </div>
                <div class="col-md-6 mb-3">
                  <label for="lastName">Ciudad</label>
                  <input type="text" autocomplete="off" class="form-control "  maxLength="255" name="ciudad" id="ciudad" placeholder="" >                    
                </div>
                <div class="col-md-6 mb-3">
                  <label for="lastName">Dirección</label>
                  <input type="text" autocomplete="off" class="form-control "  maxLength="100" name="direccion" id="direccion" placeholder="">                    
                </div>
                <div class="col-md-6 mb-3" style="display:none">
                  <label for="firstName">Perfil</label>
                  <select style="width:100%" name="tipo" required id="tipo" class="form-control form-control-md terminos_condiciones">
                    <option value="TITULAR">Titular</option>
                  </select>
                </div>
                <div class="col-md-12 mb-3 d-flex justify-content-center">
                  <button type="submit" class="btn btn-success mr-2">Guardar usuario</button>
                  <!-- <div class="btn btn-warning text-white">Cancelar</div> -->
                </div>
              </div>
              <div class="row">
                
              </div>
              
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php require 'partials/librerias.php'; ?>

<script>
  var id_hotel = "<?php echo $_SESSION['id_hotel'] ?>";
  var nombre_hotel = "<?php echo $_SESSION['nombre_hotel'] ?>";

  var direccion_hotel = "<?php echo $_SESSION['direccion_hotel'] ?>";
  var telefono_hotel = "<?php echo $_SESSION['telefono_hotel'] ?>";
  var pais_hotel = "<?php echo $_SESSION['pais_hotel'] ?>";
  var depto_hotel = "<?php echo $_SESSION['depto_hotel'] ?>";
  var email_hotel = "<?php echo $_SESSION['email_hotel'] ?>";
  var avatar_hotel = "<?php echo $_SESSION['avatar_hotel'] ?>";

  var cod_vendedor = "<?php echo $_SESSION['codigo'] ?>";

  $(function() {

    $('#DateRange, #DateRange_tour, #DateRange_alq').daterangepicker({
      autoUpdateInput: false,
      locale: {
        format: 'DD/MM/YYYY',
        applyLabel: 'Aplicar',
        cancelLabel: 'Cancelar',
        daysOfWeek: ['Do','Lu','Ma','Mi','Ju','Vi','Sa'],
        monthNames: [
          'Enero','Febrero','Marzo','Abril','Mayo','Junio',
          'Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'
        ],
        firstDay: 1
      },
      minDate: moment(), // 👈 hoy o fechas futuras
    });
    $("#menu_inicio").removeClass("active");
    //traer_hotel()
    traer_titulares()
    traer_motivos()
    traer_paises()
    traer_planes(id_hotel)

    $(".loader").css("display", "none")

  });

  function mostrarOpciones(id, suffix) {
    suffix = suffix || ''; // Por defecto vacío para alojamiento

    // Para ALOJAMIENTO (sin suffix): pasadía (0) y noches (1) tienen las mismas 5 opciones
    if ((id == '0' || id == '1') && suffix === '') {
      $(`#iniciartarifas` + suffix).html(`<!-- Infante -->
                                <div class="pax-row d-flex align-items-center justify-content-between" data-field="infante">
                                  <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input pax-check" id="chk_infante${suffix}" data-target="#infante${suffix}">
                                    <label class="custom-control-label" for="chk_infante${suffix}">Infante</label>
                                  </div>

                                  <div class="input-group pax-stepper ml-3">
                                    <div class="input-group-prepend">
                                      <button class="btn btn-light pax-minus" type="button" data-target="#infante${suffix}" disabled>-</button>
                                    </div>
                                    <input type="text" class="form-control pax-input" id="infante${suffix}" name="infante${suffix}" value="0" disabled>
                                    <div class="input-group-append">
                                      <button class="btn btn-light pax-plus" type="button" data-target="#infante${suffix}" disabled>+</button>
                                    </div>
                                  </div>
                                </div>

                                <!-- Niños -->
                                <div class="pax-row d-flex align-items-center justify-content-between" data-field="child">
                                  <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input pax-check" id="chk_child${suffix}" data-target="#child${suffix}">
                                    <label class="custom-control-label" for="chk_child${suffix}">Niños</label>
                                  </div>

                                  <div class="input-group pax-stepper ml-3">
                                    <div class="input-group-prepend">
                                      <button class="btn btn-light pax-minus" type="button" data-target="#child${suffix}" disabled>-</button>
                                    </div>
                                    <input type="text" class="form-control pax-input" id="child${suffix}" name="child${suffix}" value="0" disabled>
                                    <div class="input-group-append">
                                      <button class="btn btn-light pax-plus" type="button" data-target="#child${suffix}" disabled>+</button>
                                    </div>
                                  </div>
                                </div>

                                <!-- Adultos individual -->
                                <div class="pax-row d-flex align-items-center justify-content-between" data-field="adult_s">
                                  <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input pax-check" id="chk_adult_s${suffix}" data-target="#adult_s${suffix}">
                                    <label class="custom-control-label" for="chk_adult_s${suffix}">Adultos individual</label>
                                  </div>

                                  <div class="input-group pax-stepper ml-3">
                                    <div class="input-group-prepend">
                                      <button class="btn btn-light pax-minus" type="button" data-target="#adult_s${suffix}" disabled>-</button>
                                    </div>
                                    <input type="text" class="form-control pax-input" id="adult_s${suffix}" name="adult_s${suffix}" value="0" disabled>
                                    <div class="input-group-append">
                                      <button class="btn btn-light pax-plus" type="button" data-target="#adult_s${suffix}" disabled>+</button>
                                    </div>
                                  </div>
                                </div>

                                <!-- Adultos doble -->
                                <div class="pax-row d-flex align-items-center justify-content-between" data-field="adult_d">
                                  <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input pax-check" id="chk_adult_d${suffix}" data-target="#adult_d${suffix}">
                                    <label class="custom-control-label" for="chk_adult_d${suffix}">Adultos doble</label>
                                  </div>

                                  <div class="input-group pax-stepper ml-3">
                                    <div class="input-group-prepend">
                                      <button class="btn btn-light pax-minus" type="button" data-target="#adult_d${suffix}" disabled>-</button>
                                    </div>
                                    <input type="text" class="form-control pax-input" id="adult_d${suffix}" name="adult_d${suffix}" value="0" disabled>
                                    <div class="input-group-append">
                                      <button class="btn btn-light pax-plus" type="button" data-target="#adult_d${suffix}" disabled>+</button>
                                    </div>
                                  </div>
                                </div>

                                <!-- Adultos triple/cuadruple -->
                                <div class="pax-row d-flex align-items-center justify-content-between" data-field="adult_t_c">
                                  <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input pax-check" id="chk_adult_t_c${suffix}" data-target="#adult_t_c${suffix}">
                                    <label class="custom-control-label" for="chk_adult_t_c${suffix}">Adultos triple/cuadruple</label>
                                  </div>

                                  <div class="input-group pax-stepper ml-3">
                                    <div class="input-group-prepend">
                                      <button class="btn btn-light pax-minus" type="button" data-target="#adult_t_c${suffix}" disabled>-</button>
                                    </div>
                                    <input type="text" class="form-control pax-input" id="adult_t_c${suffix}" name="adult_t_c${suffix}" value="0" disabled>
                                    <div class="input-group-append">
                                      <button class="btn btn-light pax-plus" type="button" data-target="#adult_t_c${suffix}" disabled>+</button>
                                    </div>
                                  </div>
                                </div>`)
    } 
    // Para TOUR/ALQUILER pasadía: solo 3 opciones
    else if (id == '0' && suffix !== '') {
      $(`#iniciartarifas` + suffix).html(`<div class="pax-row d-flex align-items-center justify-content-between" data-field="infante">
                                  <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input pax-check" id="chk_infante${suffix}" data-target="#infante${suffix}">
                                    <label class="custom-control-label" for="chk_infante${suffix}">Infante</label>
                                  </div>

                                  <div class="input-group pax-stepper ml-3">
                                    <div class="input-group-prepend">
                                      <button class="btn btn-light pax-minus" type="button" data-target="#infante${suffix}" disabled>-</button>
                                    </div>
                                    <input type="text" class="form-control pax-input" id="infante${suffix}" name="infante${suffix}" value="0" disabled>
                                    <div class="input-group-append">
                                      <button class="btn btn-light pax-plus" type="button" data-target="#infante${suffix}" disabled>+</button>
                                    </div>
                                  </div>
                                </div>

                                <!-- Niños -->
                                <div class="pax-row d-flex align-items-center justify-content-between" data-field="child">
                                  <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input pax-check" id="chk_child${suffix}" data-target="#child${suffix}">
                                    <label class="custom-control-label" for="chk_child${suffix}">Niños (3-11 Años)</label>
                                  </div>

                                  <div class="input-group pax-stepper ml-3">
                                    <div class="input-group-prepend">
                                      <button class="btn btn-light pax-minus" type="button" data-target="#child${suffix}" disabled>-</button>
                                    </div>
                                    <input type="text" class="form-control pax-input" id="child${suffix}" name="child${suffix}" value="0" disabled>
                                    <div class="input-group-append">
                                      <button class="btn btn-light pax-plus" type="button" data-target="#child${suffix}" disabled>+</button>
                                    </div>
                                  </div>
                                </div>

                                <!-- Adultos -->
                                <div class="pax-row d-flex align-items-center justify-content-between" data-field="adult_s">
                                  <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input pax-check" id="chk_adult_s${suffix}" data-target="#adult_s${suffix}">
                                    <label class="custom-control-label" for="chk_adult_s${suffix}">Adultos</label>
                                  </div>

                                  <div class="input-group pax-stepper ml-3">
                                    <div class="input-group-prepend">
                                      <button class="btn btn-light pax-minus" type="button" data-target="#adult_s${suffix}" disabled>-</button>
                                    </div>
                                    <input type="text" class="form-control pax-input" id="adult_s${suffix}" name="adult_s${suffix}" value="0" disabled>
                                    <div class="input-group-append">
                                      <button class="btn btn-light pax-plus" type="button" data-target="#adult_s${suffix}" disabled>+</button>
                                    </div>
                                  </div>
                                </div>`)
    } 
    // Para TOUR/ALQUILER noches: 5 opciones
    else if (id == '1' && suffix !== '') {
      $(`#iniciartarifas` + suffix).html(`<div class="pax-row d-flex align-items-center justify-content-between" data-field="infante">
                                  <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input pax-check" id="chk_infante${suffix}" data-target="#infante${suffix}">
                                    <label class="custom-control-label" for="chk_infante${suffix}">Infante</label>
                                  </div>

                                  <div class="input-group pax-stepper ml-3">
                                    <div class="input-group-prepend">
                                      <button class="btn btn-light pax-minus" type="button" data-target="#infante${suffix}" disabled>-</button>
                                    </div>
                                    <input type="text" class="form-control pax-input" id="infante${suffix}" name="infante${suffix}" value="0" disabled>
                                    <div class="input-group-append">
                                      <button class="btn btn-light pax-plus" type="button" data-target="#infante${suffix}" disabled>+</button>
                                    </div>
                                  </div>
                                </div>

                                <!-- Niños -->
                                <div class="pax-row d-flex align-items-center justify-content-between" data-field="child">
                                  <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input pax-check" id="chk_child${suffix}" data-target="#child${suffix}">
                                    <label class="custom-control-label" for="chk_child${suffix}">Niños</label>
                                  </div>

                                  <div class="input-group pax-stepper ml-3">
                                    <div class="input-group-prepend">
                                      <button class="btn btn-light pax-minus" type="button" data-target="#child${suffix}" disabled>-</button>
                                    </div>
                                    <input type="text" class="form-control pax-input" id="child${suffix}" name="child${suffix}" value="0" disabled>
                                    <div class="input-group-append">
                                      <button class="btn btn-light pax-plus" type="button" data-target="#child${suffix}" disabled>+</button>
                                    </div>
                                  </div>
                                </div>

                                <!-- Adultos individual -->
                                <div class="pax-row d-flex align-items-center justify-content-between" data-field="adult_s">
                                  <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input pax-check" id="chk_adult_s${suffix}" data-target="#adult_s${suffix}">
                                    <label class="custom-control-label" for="chk_adult_s${suffix}">Adultos individual</label>
                                  </div>

                                  <div class="input-group pax-stepper ml-3">
                                    <div class="input-group-prepend">
                                      <button class="btn btn-light pax-minus" type="button" data-target="#adult_s${suffix}" disabled>-</button>
                                    </div>
                                    <input type="text" class="form-control pax-input" id="adult_s${suffix}" name="adult_s${suffix}" value="0" disabled>
                                    <div class="input-group-append">
                                      <button class="btn btn-light pax-plus" type="button" data-target="#adult_s${suffix}" disabled>+</button>
                                    </div>
                                  </div>
                                </div>

                                <!-- Adultos doble -->
                                <div class="pax-row d-flex align-items-center justify-content-between" data-field="adult_d">
                                  <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input pax-check" id="chk_adult_d${suffix}" data-target="#adult_d${suffix}">
                                    <label class="custom-control-label" for="chk_adult_d${suffix}">Adultos doble</label>
                                  </div>

                                  <div class="input-group pax-stepper ml-3">
                                    <div class="input-group-prepend">
                                      <button class="btn btn-light pax-minus" type="button" data-target="#adult_d${suffix}" disabled>-</button>
                                    </div>
                                    <input type="text" class="form-control pax-input" id="adult_d${suffix}" name="adult_d${suffix}" value="0" disabled>
                                    <div class="input-group-append">
                                      <button class="btn btn-light pax-plus" type="button" data-target="#adult_d${suffix}" disabled>+</button>
                                    </div>
                                  </div>
                                </div>

                                <!-- Adultos triple/cuadruple -->
                                <div class="pax-row d-flex align-items-center justify-content-between" data-field="adult_t_c">
                                  <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input pax-check" id="chk_adult_t_c${suffix}" data-target="#adult_t_c${suffix}">
                                    <label class="custom-control-label" for="chk_adult_t_c${suffix}">Adultos triple/cuadruple</label>
                                  </div>

                                  <div class="input-group pax-stepper ml-3">
                                    <div class="input-group-prepend">
                                      <button class="btn btn-light pax-minus" type="button" data-target="#adult_t_c${suffix}" disabled>-</button>
                                    </div>
                                    <input type="text" class="form-control pax-input" id="adult_t_c${suffix}" name="adult_t_c${suffix}" value="0" disabled>
                                    <div class="input-group-append">
                                      <button class="btn btn-light pax-plus" type="button" data-target="#adult_t_c${suffix}" disabled>+</button>
                                    </div>
                                  </div>
                                </div>`)
    } else if (id == '2') {
      $(`#iniciartarifas` + suffix).html(`<div style="display:none" class="col-md-12 mb-3">
                                    <label for="lastName">Infante</label>
                                    <input type="text" autocomplete="off" value="0" onkeypress="return isNumber(event)" class="form-control " name="infante${suffix}" id="infante${suffix}" placeholder="" required>                    
                                  </div>
                                  <div class="col-md-12 mb-3 inputsecundario">
                                    <label for="lastName">N° Alquiler</label>
                                    <input type="text" autocomplete="off" value='' class="form-control" onkeypress="return isNumber(event)" name="adult_s${suffix}" id="adult_s${suffix}" placeholder="" required>                   
                                  </div>`)
    }
    
  }

  function GuardarUsuario() {
      
      //let form = $('#form_guardar')[0];
      //let formData = new FormData(form)
      let values = {
        codigo :  $("#codigo").val(),
        cedula :  $("#cedula").val(),
        nombre1 :  $("#nombre1").val(),
        nombre2 :  $("#nombre2").val(),
        apellido1 :  $("#apellido1").val(),
        apellido2 :  $("#apellido2").val(),
        pass :  "202cb962ac59075b964b07152d234b70",
        tipo :  $("#tipo").val(),
        id_pais :  $("#select_pais").val(),
        id_depto :  $("#select_deptos").val(),
        ciudad :  $("#ciudad").val(),
        direccion :  $("#direccion").val(),
        telefono :  $("#telefono").val(),
        email :  $("#email").val(),
        avatar : "/../upload.php"
      }
      $.ajax({
      type : 'POST',
      data: values,
      url: 'views/usuarios/guardar_usuario.php',
      beforeSend: function() {
          $(".loader").css("display", "inline-block")
      },
      success: function(respuesta) {
        $(".loader").css("display", "none")
        console.log(respuesta)
        let obj = JSON.parse(respuesta)
        if (obj.success) {
          ccAlert(obj.message, obj.success ? 'success' : 'error');
          limpiar_formulario_usuarios()
          traer_titulares()
        
        }else{
          ccAlert(obj.message, 'error');
        }

      },
      error: function(e) {
        $(".loader").css("display", "none")
        ccAlert("No se ha podido obtener la información", 'error');
      }
    });
      
  }

  function traer_paises() {
        let values = { 
              codigo: 'traer_paises',
              parametro1: "",
              parametro2: ""
        };
        $.ajax({
          type : 'POST',
          data: values,
          url: 'php/sel_recursos.php',
          beforeSend: function() {
              $(".loader").css("display", "inline-block")
          },
          success: function(respuesta) {
            $(".loader").css("display", "none")
            let obj = JSON.parse(respuesta)
            let fila = ''
            $.each(obj["resultado"], function( index, val ) {
              fila += `<option value='${val.id}'>${val.paisnombre}</option>`
            });

            $("#select_pais").html('<option value="">Seleccionar</option>'+fila)
            
          },
          error: function() {
            $(".loader").css("display", "none")
            ccAlert("No se ha podido obtener la información", 'error');
          }
        });

        /* $("#select_pais").select2({
            dropdownParent: $('#crear_titular_modal')
        }); */
      
  }

  function traer_deptos(id) {

    if ( id.length < 1) {
      $("#select_deptos").html('<option value="">Seleccionar</option>').select2({
        dropdownParent: $('#crear_titular_modal')
      });
      return false
    }
    let values = { 
          codigo: 'traer_deptos',
          parametro1: id,
          parametro2: ""
    };
    $.ajax({
      type : 'POST',
      data: values,
      url: 'php/sel_recursos.php',
      beforeSend: function() {
          $(".loader").css("display", "inline-block")
      },
      success: function(respuesta) {
        $(".loader").css("display", "none")
        let obj = JSON.parse(respuesta)
        let fila = ''
        fila += ''
        $.each(obj["resultado"], function( index, val ) {
          fila += `<option value='${val.id}'>${val.estadonombre}</option>`
        });

        $("#select_deptos").html('<option value="">Seleccionar</option>'+fila)
        
      },
      error: function() {
        $(".loader").css("display", "none")
        ccAlert("No se ha podido obtener la información", 'error');
      }
    });

    /* $("#select_deptos").select2({
          dropdownParent: $('#crear_titular_modal')
    }); */

  }

  function detalle_titular(value) {
    $(".id_titular_hidden").val(value); // <-- lo mete en todos los forms
    if (value !== "") {
      var elem = $("#id_usuario option:selected")
      var nombre = elem.attr("nombre")
      var direccion = elem.attr("pais")+ " - "+elem.attr("depto")+ " - "+elem.attr("ciudad")
      var telefono = elem.attr("telefono")
      var email = elem.attr("email")
      var cedula = elem.attr("cedula")
      $("#txt_nombre_titular").text(nombre)
      $("#txt_direccion_titular").text(direccion)
      $("#txt_telefono_titular").text(telefono)
      $("#txt_email_titular").text(email)
      $("#txt_cedula_titular").text(cedula)
    $("#content_info_titular").show()
    }else{
      $("#content_info_titular").hide()
    }
  }

  function traer_titulares() {
      let values = { 
            codigo: 'traer_titulares',
            parametro1: "",
            parametro2: ""
      };
      $.ajax({
        type : 'POST',
        data: values,
        url: 'php/sel_recursos.php',
        beforeSend: function() {
            $(".loader").css("display", "inline-block")
        },
        success: function(respuesta) {
          $(".loader").css("display", "none")
          let obj = JSON.parse(respuesta)
          let fila = ''
          fila += ''
          $.each(obj["resultado"], function( index, val ) {
            fila += `<option value='${val.id}' nombre='${val.nombre1} ${val.apellido1} ${val.apellido2}' pais='${val.pais}' depto='${val.depto}' telefono='${val.telefono}' ciudad='${val.ciudad}' email='${val.email}' cedula='${val.cedula}'>${val.cedula} - ${val.nombre1} ${val.nombre2} ${val.apellido1} ${val.apellido2}</option>`
          });

          $("#id_usuario").html('<option value="">Seleccionar</option>'+fila)
          
        },
        error: function() {
          $(".loader").css("display", "none")
          console.log("No se ha podido obtener la información");
        }
      });

      $("#id_usuario").select2({
        dropdownParent: $('.cc-page')
      });
    
  }

  function traer_motivos() {
      let values = { 
            codigo: 'traer_motivos',
            parametro1: "",
            parametro2: ""
      };
      $.ajax({
        type : 'POST',
        data: values,
        url: 'php/sel_recursos.php',
        beforeSend: function() {
            $(".loader").css("display", "inline-block")
        },
        success: function(respuesta) {
          $(".loader").css("display", "none")
          let obj = JSON.parse(respuesta)
          let fila = ''
          fila += ''
          $.each(obj["resultado"], function( index, val ) {
            fila += `<option value='${val.id}'>${val.nombre}</option>`
          });

          $("#id_motivo, #id_motivo_tour, #id_motivo_alq").html('<option value="">Seleccionar</option>'+fila)
          
        },
        error: function() {
          $(".loader").css("display", "none")
          console.log("No se ha podido obtener la información");
        }
      });

      $("#id_motivo, #id_motivo_tour, #id_motivo_alq").select2({
        dropdownParent: $('.cc-page')
      });
    
  }

  function traer_planes(id_hotel) {
      let values = { 
            codigo: 'traer_planes',
            parametro1: id_hotel,
            parametro2: ""
      };
      $.ajax({
        type : 'POST',
        data: values,
        url: 'php/sel_recursos.php',
        beforeSend: function() {
            $(".loader").css("display", "inline-block")
        },
        success: function(respuesta) {
          $(".loader").css("display", "none")
          let obj = JSON.parse(respuesta)
          let fila = ''
          $.each(obj["resultado"], function( index, val ) {
            fila += `<option value='${val.id}' data-id_terminos='${val.id_terminos}' descripcion='${val.descripcion}'>${val.nombre}</option>`
          });

          $("#id_planes, #id_planes_tour, #id_planes_alq").html('<option value="">Seleccionar</option>'+fila)
          
        },
        error: function() {
          $(".loader").css("display", "none")
          console.log("No se ha podido obtener la información");
        }
      });

      $("#id_planes, #id_planes_tour, #id_planes_alq").select2({
        dropdownParent: $('.cc-page')
      });
    
  }

  function traer_productos(id_plan, suffix) {
    suffix = suffix || ''; // Por defecto vacío para alojamiento
    validar_plan(suffix)
   
    // NO ocultar todas las secciones, solo la correspondiente al sufijo
    // para que puedan coexistir previsualizaciones de diferentes tipos
    $("#content_info_planes" + suffix).hide()
    
    var elem = $("#id_planes" + suffix + " option:selected")
    var descripcion = elem.attr("descripcion")
      let values = { 
            codigo: 'traer_productos',
            parametro1: id_plan,
            parametro2: ""
      };
      $.ajax({
        type : 'POST',
        data: values,
        url: 'php/sel_recursos.php',
        beforeSend: function() {
            $(".loader").css("display", "inline-block")
        },
        success: function(respuesta) {
          $(".loader").css("display", "none")
          let obj = JSON.parse(respuesta)
          let fila = ''
          let fila2 = ''
          if (obj.success) {
            // Mostrar la sección correcta según el sufijo
            $("#content_info_planes" + suffix).show()
            
            $.each(obj["resultado"], function( index, val ) {
              if (val.tipo == 'CONSUMO') {
                fila += `<div style="margin-bottom: 0.5rem; color: #475569;"><b style="color: #3b82f6;">•</b> ${val.nombre}</div>`
              }

              if (val.tipo == 'SERVICIOS') {
                fila2 += `<div style="margin-bottom: 0.5rem; color: #475569;"><b style="color: #3b82f6;">•</b> ${val.nombre}</div>`
              }
            
          });
            
          }

          // Actualizar los elementos correspondientes al sufijo
          $("#content_detalles_plan" + suffix).html(fila)
          $("#content_servicios_incluidos" + suffix).html(fila2)
          $("#descripcion_servicios" + suffix).html(`<div style="color: #64748b; font-size: 12px; line-height: 1.6;">${descripcion}</div>`)
          
        },
        error: function() {
          $(".loader").css("display", "none")
          console.log("No se ha podido obtener la información");
        }
      });
    
  }

  function traer_cotizacion(id) {

      let values = { 
            codigo: 'traer_cotizacion',
            parametro1: id,
            parametro2: ""
      };
      $.ajax({
        type : 'POST',
        data: values,
        url: 'php/sel_recursos.php',
        beforeSend: function() {
            $(".loader").css("display", "inline-block")
        },
        success: function(respuesta) {
          //console.log(respuesta)
          $("#brn_modal_print").click()
          let obj = JSON.parse(respuesta)
          let acomodo = obj["resultado"][0]["acomodo"]
          let cod_vendedor = obj["resultado"][0]["cod_vendedor"]
          let fecha_entrada = obj["resultado"][0]["fecha_entrada"]
          let fecha_expedicion = obj["resultado"][0]["fecha_expedicion"]
          let fecha_salida = obj["resultado"][0]["fecha_salida"]
          
          let nombre_plan = obj["resultado"][0]["nombre_plan"]
          let descripcion_plan = obj["resultado"][0]["descripcion_plan"]

          let n_adult_d = obj["resultado"][0]["n_adult_d"]
          let n_adult_s = obj["resultado"][0]["n_adult_s"]
          let n_adult_t_c = obj["resultado"][0]["n_adult_t_c"]
          let n_child = obj["resultado"][0]["n_child"]
          let n_infante = obj["resultado"][0]["n_infante"]
          let noche = obj["resultado"][0]["noche"]
          let tipo_servicio = obj["resultado"][0]["tipo_servicio"]
          let nombre_motivo = obj["resultado"][0]["nombre_motivo"]
          let terminos = obj["resultado"][0]["terminos"]
          console.log(tipo_servicio)
            let cedula = ""
            let ciudad = ""
            let depto = ""
            let direccion = ""
            let email = ""
            let nombre_titular = ""
            let pais = ""
            let telefono = ""
          $.each(obj["info_titular"], function( index, val ) {
            cedula = val.cedula
            ciudad = val.ciudad
            depto = val.depto
            direccion = val.direccion
            email = val.email
            nombre_titular = val.nombre1+" "+val.nombre2+" "+val.apellido1+" "+val.apellido2
            pais = val.pais
            telefono = val.telefono

          })
            let tarifa_adult_d = 0
            let tarifa_adult_s = 0
            let tarifa_adult_t_c = 0
            let tarifa_child = 0
            let tarifa_nombre = ""

          $.each(obj["info_tarifa"], function( index, val ) {
            tarifa_adult_d = parseInt(val.adult_d)
            tarifa_adult_s = parseInt(val.adult_s)
            tarifa_adult_t_c = parseInt(val.adult_t_c)
            tarifa_child = parseInt(val.child)
            tarifa_nombre = val.nombre

          })
          let consumo = ""
          let servicios = ""
          $.each(obj["info_planes"], function( index, val ) {
            if (val.tipo == "CONSUMO") {
              consumo+= "* "+val.nombre+", ";
            }else if (val.tipo == "SERVICIOS") {
              servicios+=  "* "+val.nombre+"<br>";
            }

          })

          let totalchild = parseInt( n_child )* parseInt( tarifa_child )
          let totaladult_s = parseInt( n_adult_s )* parseInt( tarifa_adult_s )
          let totaladult_d = parseInt( n_adult_d )* parseInt( tarifa_adult_d )
          let totaladult_t_c = parseInt( n_adult_t_c )* parseInt( tarifa_adult_t_c )

          let total_pasajero = parseInt( n_child )+parseInt( n_adult_s )+parseInt( n_adult_d )+parseInt( n_adult_t_c)

          let subtotal = totalchild+totaladult_s+totaladult_d+totaladult_t_c
          let n_noches = noche == "N/A" ? 1 : parseInt(noche)
          let noche_tour = noche == "N/A" ? 'tour/alquiler' :'noches'

          let content_fila = ''
          if (tipo_servicio == '0') {
            content_fila = `<tbody id="tbody_tarifa_modal">
                              <tr>
                                  <td class="table-number">1</td>
                                  <td>Niños (3-11 Años)</td>
                                  <td style="text-align: center;">${n_child}</td>
                                  <td class="table-right">$${puntosDecimales(tarifa_child)}</td>
                                  <td class="table-right">$${puntosDecimales(totalchild)}</td>
                              </tr>
                              <tr>
                                  <td class="table-number">2</td>
                                  <td>Adultos</td>
                                  <td style="text-align: center;">${n_adult_s}</td>
                                  <td class="table-right">$${puntosDecimales(tarifa_adult_s)}</td>
                                  <td class="table-right">$${puntosDecimales(totaladult_s)}</td>
                              </tr>
                            </tbody>`
          }else if (tipo_servicio == '1') {
            content_fila = `<tbody id="tbody_tarifa_modal">
                              <tr>
                                  <td class="table-number">1</td>
                                  <td>Niños</td>
                                  <td style="text-align: center;">${n_child}</td>
                                  <td class="table-right">$${puntosDecimales(tarifa_child)}</td>
                                  <td class="table-right">$${puntosDecimales(totalchild)}</td>
                              </tr>
                              <tr>
                                  <td class="table-number">2</td>
                                  <td>Adultos normal</td>
                                  <td style="text-align: center;">${n_adult_s}</td>
                                  <td class="table-right">$${puntosDecimales(tarifa_adult_s)}</td>
                                  <td class="table-right">$${puntosDecimales(totaladult_s)}</td>
                              </tr>
                              <tr>
                                  <td class="table-number">3</td>
                                  <td>Adultos dobles</td>
                                  <td style="text-align: center;">${n_adult_d}</td>
                                  <td class="table-right">$${puntosDecimales( tarifa_adult_d)}</td>
                                  <td class="table-right">$${puntosDecimales(totaladult_d)}</td>
                              </tr>
                              <tr>
                                  <td class="table-number">4</td>
                                  <td>Adultos triple / Cuadruple</td>
                                  <td style="text-align: center;">${n_adult_t_c}</td>
                                  <td class="table-right">$${puntosDecimales(tarifa_adult_t_c)}</td>
                                  <td class="table-right">$${puntosDecimales(totaladult_t_c)}</td>
                              </tr>
                            </tbody>`
          }else if (tipo_servicio == '2') {
            content_fila = `<tbody id="tbody_tarifa_modal">
                              <tr>
                                  <td class="table-number">1</td>
                                  <td>N° Alquiler</td>
                                  <td style="text-align: center;">${n_adult_s}</td>
                                  <td class="table-right">$${puntosDecimales(tarifa_adult_s)}</td>
                                  <td class="table-right">$${puntosDecimales(totaladult_s)}</td>
                              </tr>
                            </tbody>`
          }

          let total = subtotal * parseInt(n_noches)
          $("#btn_pdf").html(`<button onclick="imprimir_cotizacion('${id}')" class="btn btn-danger btn-sm" style="display: flex; align-items: center; gap: 8px;"><i class="fas fa-file-pdf"></i> Descargar PDF</button>`)
              let fila = `
              <style>
                .cotizacion-mockup {
                  font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
                  color: #1e293b;
                  background: #f8fafc;
                  padding: 2rem;
                  max-width: 900px;
                  margin: 0 auto;
                }
                @media print {
                  .cotizacion-mockup {
                    background: white;
                    padding: 1rem;
                  }
                  .cotizacion-section {
                    box-shadow: none !important;
                    page-break-inside: avoid;
                  }
                }
                .cotizacion-header {
                  display: flex;
                  justify-content: space-between;
                  align-items: flex-start;
                  margin-bottom: 1.5rem;
                  padding-bottom: 1.5rem;
                  border-bottom: 2px solid #e2e8f0;
                  flex-wrap: wrap;
                  gap: 1rem;
                }
                .cotizacion-logo {
                  font-size: 28px;
                  font-weight: 300;
                  color: #3b82f6;
                  font-style: italic;
                  min-width: 200px;
                }
                .cotizacion-logo img {
                  max-width: 150px;
                  max-height: 80px;
                  object-fit: contain;
                }
                .cotizacion-logo small {
                  display: block;
                  font-size: 10px;
                  letter-spacing: 2px;
                  color: #64748b;
                  font-style: normal;
                  margin-top: 2px;
                }
                .cotizacion-title-section {
                  text-align: center;
                  flex: 1;
                  margin: 0 2rem;
                }
                .cotizacion-title {
                  font-size: 22px;
                  font-weight: 700;
                  letter-spacing: 3px;
                  color: #1e293b;
                  margin: 0;
                }
                .cotizacion-subtitle {
                  font-size: 12px;
                  color: #64748b;
                  margin: 5px 0;
                }
                .cotizacion-badge {
                  display: inline-block;
                  background: #dbeafe;
                  color: #1e40af;
                  padding: 4px 12px;
                  border-radius: 12px;
                  font-size: 10px;
                  font-weight: 600;
                  margin-top: 8px;
                }
                .cotizacion-number {
                  text-align: right;
                }
                .cotizacion-id {
                  font-size: 32px;
                  font-weight: 700;
                  color: #1e293b;
                  margin: 0;
                }
                .cotizacion-date {
                  font-size: 11px;
                  color: #64748b;
                  margin-top: 4px;
                }
                .cotizacion-section {
                  background: white;
                  border-radius: 12px;
                  padding: 1.5rem;
                  margin-bottom: 1.5rem;
                  box-shadow: 0 1px 3px rgba(0,0,0,0.05);
                }
                .section-header {
                  display: flex;
                  align-items: center;
                  margin-bottom: 1rem;
                  padding-bottom: 0.75rem;
                  border-bottom: 1px solid #e2e8f0;
                }
                .section-icon {
                  width: 36px;
                  height: 36px;
                  background: #eff6ff;
                  border-radius: 8px;
                  display: flex;
                  align-items: center;
                  justify-content: center;
                  margin-right: 12px;
                  color: #3b82f6;
                  font-size: 18px;
                }
                .section-title {
                  font-size: 16px;
                  font-weight: 700;
                  color: #1e293b;
                  margin: 0;
                }
                .info-grid {
                  display: grid;
                  grid-template-columns: 1fr 1fr;
                  gap: 1rem;
                  font-size: 13px;
                }
                @media (max-width: 768px) {
                  .info-grid {
                    grid-template-columns: 1fr;
                  }
                  .cotizacion-header {
                    flex-direction: column;
                    text-align: center;
                  }
                  .cotizacion-logo, .cotizacion-number {
                    text-align: center;
                    width: 100%;
                  }
                }
                .info-item {
                  display: flex;
                  flex-direction: column;
                }
                .info-label {
                  font-size: 11px;
                  color: #64748b;
                  font-weight: 600;
                  text-transform: uppercase;
                  letter-spacing: 0.5px;
                  margin-bottom: 4px;
                }
                .info-value {
                  color: #1e293b;
                  font-weight: 500;
                }
                .cotizacion-table {
                  width: 100%;
                  border-collapse: collapse;
                  font-size: 13px;
                }
                .table-wrapper {
                  overflow-x: auto;
                  -webkit-overflow-scrolling: touch;
                }
                @media (max-width: 768px) {
                  .cotizacion-table {
                    font-size: 11px;
                  }
                  .cotizacion-table th,
                  .cotizacion-table td {
                    padding: 8px 6px;
                  }
                }
                .cotizacion-table thead {
                  background: #f8fafc;
                }
                .cotizacion-table th {
                  padding: 10px;
                  text-align: left;
                  font-size: 11px;
                  font-weight: 700;
                  color: #64748b;
                  text-transform: uppercase;
                  letter-spacing: 0.5px;
                  border-bottom: 2px solid #e2e8f0;
                }
                .cotizacion-table td {
                  padding: 12px 10px;
                  border-bottom: 1px solid #f1f5f9;
                  color: #334155;
                }
                .cotizacion-table tbody tr:last-child td {
                  border-bottom: none;
                }
                .table-number {
                  text-align: center;
                  font-weight: 600;
                  color: #94a3b8;
                }
                .table-right {
                  text-align: right;
                }
                .totals-section {
                  background: #f8fafc;
                  border-radius: 8px;
                  padding: 1rem;
                  margin-top: 1rem;
                }
                .total-row {
                  display: flex;
                  justify-content: space-between;
                  padding: 8px 0;
                  font-size: 13px;
                }
                .total-row.grand-total {
                  border-top: 2px solid #cbd5e1;
                  margin-top: 8px;
                  padding-top: 12px;
                  font-size: 18px;
                  font-weight: 700;
                  color: #1e293b;
                }
                .acomodacion-box {
                  background: #f8fafc;
                  border-radius: 8px;
                  padding: 1rem;
                  font-size: 12px;
                  color: #475569;
                  line-height: 1.6;
                }
                .acomodacion-label {
                  font-weight: 700;
                  color: #1e293b;
                  margin-bottom: 4px;
                }
                .politicas-list {
                  list-style: none;
                  padding: 0;
                  margin: 0;
                }
                .politica-item {
                  display: flex;
                  align-items: flex-start;
                  margin-bottom: 12px;
                  font-size: 12px;
                  line-height: 1.5;
                }
                .politica-number {
                  width: 24px;
                  height: 24px;
                  background: #3b82f6;
                  color: white;
                  border-radius: 50%;
                  display: flex;
                  align-items: center;
                  justify-content: center;
                  font-weight: 700;
                  font-size: 11px;
                  margin-right: 10px;
                  flex-shrink: 0;
                }
                .politica-text {
                  color: #475569;
                  padding-top: 2px;
                }
                .politica-text strong {
                  color: #1e293b;
                }
                .cotizacion-footer {
                  text-align: center;
                  margin-top: 2rem;
                  padding-top: 1.5rem;
                  border-top: 2px solid #e2e8f0;
                  font-size: 12px;
                  color: #64748b;
                }
                .footer-thank-you {
                  font-size: 14px;
                  color: #1e293b;
                  margin-bottom: 1rem;
                }
                .footer-company {
                  font-weight: 700;
                  color: #3b82f6;
                  margin-bottom: 0.5rem;
                  font-size: 14px;
                }
                .footer-contact {
                  color: #64748b;
                  font-size: 11px;
                }
              </style>
              <div class="cotizacion-mockup">
                <div class="cotizacion-header">
                  <div class="cotizacion-logo">
                    ${avatar_hotel && avatar_hotel !== '' ? `<img src="${avatar_hotel}" alt="${nombre_hotel}">` : nombre_hotel}
                  </div>
                  <div class="cotizacion-title-section">
                    <h1 class="cotizacion-title">COTIZACIÓN</h1>
                    <p class="cotizacion-subtitle">Cotización válida por 24 HRS</p>
                    <span class="cotizacion-badge">Válida por 24 HRS</span>
                  </div>
                  <div class="cotizacion-number">
                    <div class="cotizacion-id">#${id}</div>
                    <div class="cotizacion-date">Fecha de emisión: ${fecha_expedicion}</div>
                  </div>
                </div>

                <div class="cotizacion-section">
                  <div class="section-header">
                    <div class="section-icon">
                      <i class="fas fa-user"></i>
                    </div>
                    <h2 class="section-title">Información del titular</h2>
                  </div>
                  <div class="info-grid">
                    <div class="info-item">
                      <span class="info-label">Nombre</span>
                      <span class="info-value">${nombre_titular}</span>
                    </div>
                    <div class="info-item">
                      <span class="info-label">Email</span>
                      <span class="info-value">${email}</span>
                    </div>
                    <div class="info-item">
                      <span class="info-label">Procedencia</span>
                      <span class="info-value">${ciudad ? ciudad + ', ' : ''}${depto ? depto + ', ' : ''}${pais}</span>
                    </div>
                    <div class="info-item">
                      <span class="info-label">Teléfono</span>
                      <span class="info-value">${telefono}</span>
                    </div>
                  </div>
                </div>

                <div class="cotizacion-section">
                  <div class="section-header">
                    <div class="section-icon">
                      <i class="fas fa-calendar-alt"></i>
                    </div>
                    <h2 class="section-title">Reserva</h2>
                  </div>
                  <div class="info-grid">
                    <div class="info-item">
                      <span class="info-label">Check-in</span>
                      <span class="info-value">${fecha_entrada}</span>
                    </div>
                    <div class="info-item">
                      <span class="info-label">Check-out</span>
                      <span class="info-value">${fecha_salida}</span>
                    </div>
                    <div class="info-item">
                      <span class="info-label">Noches</span>
                      <span class="info-value">${noche} ${parseInt(noche) === 1 ? 'noche' : 'noches'}</span>
                    </div>
                    <div class="info-item">
                      <span class="info-label">Personas</span>
                      <span class="info-value">${total_pasajero} personas</span>
                    </div>
                  </div>
                </div>

                <div class="cotizacion-section">
                  <div class="section-header">
                    <div class="section-icon">
                      <i class="fas fa-list-ul"></i>
                    </div>
                    <h2 class="section-title">Detalles</h2>
                  </div>
                  <div class="table-wrapper">
                    <table class="cotizacion-table">
                      <thead>
                        <tr>
                          <th style="width: 40px;">#</th>
                          <th>Item</th>
                          <th style="width: 100px; text-align: center;">Cantidad</th>
                          <th style="width: 140px; text-align: right;">Valor unitario</th>
                          <th style="width: 120px; text-align: right;">Total</th>
                        </tr>
                      </thead>
                      ${content_fila}
                    </table>
                  </div>
                  <div class="totals-section">
                    <div class="total-row">
                      <span>Subtotal ${noche_tour}:</span>
                      <span>$${puntosDecimales(subtotal)}</span>
                    </div>
                    <div class="total-row grand-total">
                      <span>TOTAL:</span>
                      <span>$${puntosDecimales(total)} COP</span>
                    </div>
                  </div>
                </div>

                <div class="cotizacion-section">
                  <div class="section-header">
                    <div class="section-icon">
                      <i class="fas fa-bed"></i>
                    </div>
                    <h2 class="section-title">Acomodación</h2>
                  </div>
                  <div class="acomodacion-box">
                    <div class="acomodacion-label">Plan: ${nombre_plan}</div>
                    <div style="margin-bottom: 8px;">${acomodo}</div>
                    <div style="color: #64748b; font-size: 11px;">${descripcion_plan}</div>
                  </div>
                </div>

                <div class="cotizacion-section">
                  <div class="section-header">
                    <div class="section-icon">
                      <i class="fas fa-file-alt"></i>
                    </div>
                    <h2 class="section-title">Políticas de Reserva</h2>
                  </div>
                  <ul class="politicas-list">
                    <li class="politica-item">
                      <div class="politica-number">1</div>
                      <div class="politica-text"><strong>Check-in:</strong> 3:00 pm. – <strong>Check-out:</strong> 11:30 am.</div>
                    </li>
                    <li class="politica-item">
                      <div class="politica-number">2</div>
                      <div class="politica-text"><strong>Incluye:</strong> Desayuno continental, Wi-Fi y acceso para gym/piscina. Aros, sombrilla y 1 para.</div>
                    </li>
                    <li class="politica-item">
                      <div class="politica-number">3</div>
                      <div class="politica-text"><strong>No incluye:</strong> Seguro hotelero: $16,000 gratis, niños de 4 años/personas.</div>
                    </li>
                    <li class="politica-item">
                      <div class="politica-number">4</div>
                      <div class="politica-text"><strong>Registro:</strong> Todos los huéspedes deben presentar un documento de identidad.</div>
                    </li>
                    <li class="politica-item">
                      <div class="politica-number">5</div>
                      <div class="politica-text"><strong>No fumar:</strong> Ampliando todos los espacios, sin tarifa añadida.</div>
                    </li>
                    <li class="politica-item">
                      <div class="politica-number">6</div>
                      <div class="politica-text"><strong>Cancelaciones:</strong> Se cobra 50% de las noches al cancelar fuera de los términos establecidos.</div>
                    </li>
                  </ul>
                </div>

                ${terminos ? `<div class="cotizacion-section">
                  <div style="font-size: 11px; color: #64748b; line-height: 1.6;">
                    ${terminos}
                  </div>
                </div>` : ''}

                <div class="cotizacion-footer">
                  <div class="footer-thank-you">Gracias por elegir ${nombre_hotel}: Estamos listos para recibirte.</div>
                  <div class="footer-company">${nombre_hotel.toUpperCase()}</div>
                  <div class="footer-contact">
                    ${direccion_hotel} - ${pais_hotel}, ${depto_hotel} - Tel: ${telefono_hotel}
                  </div>
                </div>
              </div>`
          $(".loader").css("display", "none")

          $("#print_cotizacion").html(fila)
          
        },
        error: function() {
          $(".loader").css("display", "none")
          console.log("No se ha podido obtener la información");
        }
      });
    
  }

  function traer_tarifas(tipo, suffix) {
    suffix = suffix || ''; // Por defecto vacío para alojamiento
    $(`#iniciartarifas` + suffix).html("")
    var tipo_plan = $("#id_planes" + suffix).val()
    if (tipo_plan == "") {
      ccAlert("por favor selecciona el tipo de plan", 'error');
      $("input:radio[name='tipo_viaje" + suffix + "']").prop('checked', false);
      return false
    }
    $("#id_tarifa" + suffix).prop('disabled',false);
    $("#child" + suffix).prop('disabled',false);
    $("#adult_s" + suffix).prop('disabled',false);
    $("#adult_d" + suffix).prop('disabled',false);
    $("#adult_t_c" + suffix).prop('disabled',false);
    $("#startDate" + suffix).prop('disabled',false);
    $("#endDate" + suffix).prop('disabled',false);
    $("#infante" + suffix).prop('disabled',false);
    
      let values = { 
            codigo: 'traer_tarifas',
            parametro1: id_hotel,
            parametro2: tipo,
            parametro3: tipo_plan
      };
      $.ajax({
        type : 'POST',
        data: values,
        url: 'php/sel_recursos.php',
        beforeSend: function() {
            $(".loader").css("display", "inline-block")
        },
        success: function(respuesta) {
          $(".loader").css("display", "none")
          let obj = JSON.parse(respuesta)
          let fila = ''

          if (obj.success == false) {
            $("input:radio[name='tipo_viaje" + suffix + "']").prop('checked',false);
            $("#id_tarifa" + suffix).val("").trigger('change').prop('disabled',true);
            $("#child" + suffix).val("").prop('disabled',true);
            $("#adult_s" + suffix).val("").prop('disabled',true);
            $("#adult_d" + suffix).val("").prop('disabled',true);
            $("#adult_t_c" + suffix).val("").prop('disabled',true);
            $("#startDate" + suffix).val("").prop('disabled',true);
            $("#endDate" + suffix).val("").prop('disabled',true);
            $("#DateRange" + suffix).val("").prop('disabled',true);
            
            // Ocultar el contenedor de previsualización correspondiente
            if (suffix === '') {
              $("#content_info_tarifa").hide()
            } else if (suffix === '_tour') {
              $("#content_info_tarifa_tour").hide()
            } else if (suffix === '_alq') {
              $("#content_info_tarifa_alq").hide()
            }
            
            // Mensaje mejorado con información específica
            const nombrePlan = $("#id_planes" + suffix + " option:selected").text();
            const tipoServicio = tipo == 0 ? 'Pasadía' : (tipo == 1 ? 'Noches' : 'Alquiler');
            ccAlert(`El plan "${nombrePlan}" no tiene tarifas configuradas para el tipo de servicio "${tipoServicio}". Por favor, seleccione otro tipo de servicio o contacte al administrador.`, 'error');
            return false
            
          }

          if (tipo == 0) {
            cambiarModoDateRange(true, suffix)
          } else if (tipo == 1) {
            cambiarModoDateRange(false, suffix)
          } else if (tipo == 2) {
            cambiarModoDateRange(true, suffix) // Alquiler usa fecha única (pasadía)
          }
          mostrarOpciones(tipo, suffix)
          $.each(obj["resultado"], function( index, val ) {
            console.log(val.noches)
            fila += `<option value='${val.id}' id='${val.id}' nombre='${val.nombre}' child='${val.child}' adult_s='${val.adult_s}' adult_d='${val.adult_d}' noches='${val.noches}' adult_t_c='${val.adult_t_c}' noches='${val.noches}'>${val.nombre}</option>`
          });

          // Solo actualizar el select del formulario correspondiente
          $("#id_tarifa" + suffix).html('<option value="">Seleccionar</option>'+fila)
          
        },
        error: function() {
          $(".loader").css("display", "none")
          console.log("No se ha podido obtener la información");
        }
      });

      // Solo inicializar select2 para el select correspondiente
      $("#id_tarifa" + suffix).select2({
        dropdownParent: $('.cc-page')
      });
    
  }

  function isNumber(evt) {
      evt = (evt) ? evt : window.event;
      var charCode = (evt.which) ? evt.which : evt.keyCode;
      if (charCode > 31 && (charCode < 48 || charCode > 57)) {
          return false;
      }
      return true;
  }

  function puntosDecimales(value) {
   return new Intl.NumberFormat("de-DE").format(value)
  }

  function imprimir_cotizacion(id) {
    $(".loader").css("display", "inline-block")
    const element = document.getElementById("print_cotizacion")
    const opt = {
      filename: 'Cotizacion'+id+'.pdf',
      margin: 2,
      image: {type: 'jpeg', quality: 1},
      jsPDF: {format: 'letter', orientation: 'portrait'}
    };

    html2pdf().set({
      pagebreak: {mode: 'avoid-all', before:'#pageX'}
    });
    // Adds page-breaks according to the CSS break-before, break-after, and break-inside properties.
    // Only recognizes always/left/right for before/after, and avoid for inside.
    html2pdf().set({
      pagebreak: {mode: 'css' }
    });
    // New Promise-based usage:
    html2pdf().set(opt).from(element).save();
    // Old monolithic-style usage:
    //html2pdf(element, opt);
    $(".loader").css("display", "none")
  }

  function limpiar_formulario(){
      $("input:radio").prop('checked', false);
      $("#infante").val("0").prop('disabled',true)
      $("#child").val("0").prop('disabled',true)
      $("#adult_s").val("0").prop('disabled',true)
      $("#adult_d").val("0").prop('disabled',true)
      $("#adult_t_c").val("0").prop('disabled',true)
      $("#id_usuario").val("").change()
      $("#id_tarifa").val("").change().prop('disabled',true)
      $("#id_planes").val("").change()
      $("#id_motivo").val("").change()
      $("#cantidad_noches").text("")
      $("#id_acomodacion").val("")
      $("#startDate").val("").prop('disabled',true)
      $("#endDate").val("").prop('disabled',true)
      $("#tbody_tarifa").html("")
      $("#content_subtotal").html("")
      $("#content_info_tarifa").hide()
      $("#content_info_planes").hide()
  }

  function validar_plan(suffix){
      suffix = suffix || ''; // Por defecto vacío para alojamiento
      $("input:radio[name='tipo_viaje" + suffix + "']").prop('checked', false);
      $("#infante" + suffix).val("0").prop('disabled',true)
      $("#child" + suffix).val("0").prop('disabled',true)
      $("#adult_s" + suffix).val("0").prop('disabled',true)
      $("#adult_d" + suffix).val("0").prop('disabled',true)
      $("#adult_t_c" + suffix).val("0").prop('disabled',true)
      $("#id_tarifa" + suffix).val("").change().prop('disabled',true)
      $("#cantidad_noches" + suffix).text("")
      $("#startDate" + suffix).val("").prop('disabled',true)
      $("#endDate" + suffix).val("").prop('disabled',true)
      $("#tbody_tarifa" + suffix).html("")
      $("#content_subtotal" + suffix).html("")
      
      // Ocultar los contenedores de previsualización correspondientes
      if (suffix === '') {
        $("#content_info_tarifa").hide()
        $("#content_info_planes").hide()
      } else if (suffix === '_tour') {
        $("#content_info_tarifa_tour").hide()
        $("#content_info_planes_tour").hide()
      } else if (suffix === '_alq') {
        $("#content_info_tarifa_alq").hide()
        $("#content_info_planes_alq").hide()
      }
  }
  function show_traer_tabla_cotizacion(){
    setTimeout(() => {
      traer_tabla_cotizacion()
    }, 100);
  }

  function traer_tabla_cotizacion(){

      if ( ! $.fn.DataTable.isDataTable('#tabla_cotizacion')) {
			  dtable = $("#tabla_cotizacion").DataTable({
          "scrollY": true,
					"ajax": {
					"url": "php/sel_recursos.php",
					"type": "POST",
					"deferRender": false,
					"data":{
            codigo:'traer_tabla_cotizacion',
            parametro1: "",
            parametro2: "",
          },
          /* "dataSrc": function (data) {	
            console.log(data)
						return data.data
					} */

				  },
				  "columns": [
            { "data": "id"},
            { "data": "cedula_titular"},
            { "data": "nombre_titular"},
            { "data": "noche"},
            { "data": "nombre_motivo"},
            { "data": "nombre_plan"},
            { "data": "fecha_entrada"},
            { "data": "fecha_salida"},
            { "data": "fecha_expedicion"},
            { "data": ""}
          ],
				 "columnDefs": [
					 {
						"targets": 9,
						"data":"",
						 render: function ( data, type, row ) {
							return  `<button class="btn btn-link" onclick="traer_cotizacion(${row.id})"><i class="fa fa-eye" aria-hidden="true"></i></button>`;
						 }
					}],
				});
			}else{
			   dtable.destroy();
         traer_tabla_cotizacion();
			}

  }

  function limpiar_formulario_usuarios(){
    
    $("#cedula").val("").change()
    $("#nombre1").val("").change()
    $("#nombre2").val("").change()
    $("#apellido1").val("").change()
    $("#apellido2").val("").change()
    $("#select_pais").val("").change()
    $("#select_deptos").val("").change()
    $("#ciudad").val("").change()
    $("#direccion").val("").change()
    $("#telefono").val("").change()
    $("#email").val("").change()
  }

  function cambiarModoDateRange(esUnaFecha, suffix) {
    suffix = suffix || ''; // Por defecto vacío para alojamiento

    $('#DateRange' + suffix).prop('disabled', false).prop('required', true);
    $('#startDate' + suffix + ', #endDate' + suffix).prop('disabled', false); // 👈 clave

    // Destruir el daterangepicker anterior si existe
    const $picker = $('#DateRange' + suffix);
    if ($picker.data('daterangepicker')) {
      $picker.data('daterangepicker').remove();
      $picker.removeData('daterangepicker');
    }

    const config = {
      singleDatePicker: esUnaFecha,
      showDropdowns: true,
      autoUpdateInput: false,
      minDate: moment(),
      locale: {
        format: "YYYY-MM-DD",
        applyLabel: "Aplicar",
        cancelLabel: "Cancelar",
        fromLabel: "Desde",
        toLabel: "Hasta",
        customRangeLabel: "Personalizado",
        weekLabel: "S",
        daysOfWeek: ["Do","Lu","Ma","Mi","Ju","Vi","Sa"],
        monthNames: ["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"],
      }
    };

    // Si es rango (noches), requerir al menos 1 día de diferencia
    if (!esUnaFecha) {
      config.minSpan = {
        days: 1
      };
    }

    $picker.daterangepicker(config);

    $('#DateRange' + suffix).off('apply.daterangepicker').on('apply.daterangepicker', function(ev, picker) {
      // Validación adicional para modo rango (noches): debe haber al menos 1 día de diferencia
      if (!esUnaFecha) {
        const diffDays = picker.endDate.diff(picker.startDate, 'days');
        if (diffDays < 1) {
          ccAlert('Para el modo "Noches" debe seleccionar al menos 1 día de diferencia entre la fecha de entrada y salida', 'error');
          $(this).val('');
          $('#startDate' + suffix).val('');
          $('#endDate' + suffix).val('');
          return false;
        }
        // Modo rango - mostrar ambas fechas
        $(this).val(picker.startDate.format('DD-MM-YYYY') + ' - ' + picker.endDate.format('DD-MM-YYYY'));
      } else {
        // Modo una sola fecha - mostrar solo la fecha inicial
        $(this).val(picker.startDate.format('DD-MM-YYYY'));
      }
      
      $('#startDate' + suffix).val(picker.startDate.format('YYYY-MM-DD')).trigger('change');
      $('#endDate' + suffix).val(picker.endDate.format('YYYY-MM-DD')).trigger('change');
    });

    $('#DateRange' + suffix).off('cancel.daterangepicker').on('cancel.daterangepicker', function() {
      $(this).val('');
      $('#startDate' + suffix).val('').trigger('change');
      $('#endDate' + suffix).val('').trigger('change');
    });
  }

  function showFormCotizacion(tipo, estado) {
    if (tipo == 1) {
      estado ? $("#form_alojamiento").show() : $("#form_alojamiento").hide()
      // Ocultar la previsualización cuando se desmarque
      if (!estado) {
        $("#content_info_planes").hide()
        $("#content_info_tarifa").hide()
      }
    }
    
    if (tipo == 2) {
      estado ? $("#form_tour").show() : $("#form_tour").hide()
      // Ocultar la previsualización cuando se desmarque
      if (!estado) {
        $("#content_info_planes_tour").hide()
        $("#content_info_tarifa_tour").hide()
      }
    } 
    if (tipo == 3) {
      estado ? $("#form_alquiler").show() : $("#form_alquiler").hide()
      // Ocultar la previsualización cuando se desmarque
      if (!estado) {
        $("#content_info_planes_alq").hide()
        $("#content_info_tarifa_alq").hide()
      }
    }
  }

  function getFieldLabel(el, form) {
    const id = el.id;
    if (id) {
      const lbl = form.querySelector(`label[for="${CSS.escape(id)}"]`);
      if (lbl) return lbl.innerText.trim();
    }
    // fallback
    return el.getAttribute('placeholder') || el.name || 'Campo requerido';
  }

  function estaActivoTipo(tipo) {
    // Usa los checkbox de arriba (los que llaman showFormCotizacion)
    // OJO: en tu HTML esos checkbox comparten name="tipo_viaje" con los radios -> mejor NO usar name, usa value.
    return $(`input[type="checkbox"][value="${tipo}"]`).is(':checked');
  }

  function abrirFormSiEstaCerrado(tipo) {
    if (tipo == 1) $("#form_alojamiento").show();
    if (tipo == 2) $("#form_tour").show();
    if (tipo == 3) $("#form_alquiler").show();
  }

  function expandirCollapseDelForm(formId) {
    // abre cualquier collapse padre del form (por si el form entero está dentro)
    $(`#${formId}`).parents('.collapse').collapse('show');

    // y también abre los collapse internos del form (tus #collapseCotizacion, etc.)
    $(`#${formId}`).find('.collapse').collapse('show');
  }

  function buildCotizacionAlojamiento() {
    return {
      tipo_cotizacion: 1,
      cod_vendedor: cod_vendedor,
      id_hotel: id_hotel,
      id_titular: $("#id_usuario").val(),
      id_plan: $("#id_planes").val(),
      id_motivo: $("#id_motivo").val(),
      id_tarifa: $("#id_tarifa").val(),
      id_terminos: $("#id_planes option:selected").data('id_terminos'),
      fecha_entrada: $("#startDate").val(),
      fecha_salida: $("#endDate").val(),
      noche: $("#cantidad_noches").text(),
      n_infante: $("#infante").val(),
      n_child: $("#child").val() || "0",
      n_adult_s: $("#adult_s").val() || "0",
      n_adult_d: $("#adult_d").val() || "0",
      n_adult_t_c: $("#adult_t_c").val() || "0",
      acomodo: $("#id_acomodacion").val()
    };
  }

  function buildCotizacionTour() {
    return {
      tipo_cotizacion: 2,
      cod_vendedor: cod_vendedor,
      id_hotel: id_hotel,
      id_titular: $("#id_usuario").val(),
      id_plan: $("#id_planes_tour").val(),
      id_motivo: $("#id_motivo_tour").val(),
      id_tarifa: $("#id_tarifa_tour").val(),
      id_terminos: $("#id_planes_tour option:selected").data('id_terminos'),
      fecha_entrada: $("#startDate_tour").val(),
      fecha_salida: $("#endDate_tour").val(),
      noche: $("#cantidad_noches_tour").text() || "N/A",
      n_infante: $("#infante_tour").val() || "0",
      n_child: $("#child_tour").val() || "0",
      n_adult_s: $("#adult_s_tour").val() || "0",
      n_adult_d: $("#adult_d_tour").val() || "0",
      n_adult_t_c: $("#adult_t_c_tour").val() || "0",
      acomodo: $("#id_acomodacion_tour").val()
    };
  }

  function buildCotizacionAlquiler() {
    return {
      tipo_cotizacion: 3,
      cod_vendedor: cod_vendedor,
      id_hotel: id_hotel,
      id_titular: $("#id_usuario").val(),
      id_plan: $("#id_planes_alq").val(),
      id_motivo: $("#id_motivo_alq").val(),
      id_tarifa: $("#id_tarifa_alq").val(),
      id_terminos: $("#id_planes_alq option:selected").data('id_terminos'),
      fecha_entrada: $("#startDate_alq").val(),
      fecha_salida: $("#endDate_alq").val(),
      noche: "N/A",
      n_infante: "0",
      n_child: "0",
      n_adult_s: $("#adult_s_alq").val() || "0", // N° Alquiler
      n_adult_d: "0",
      n_adult_t_c: "0",
      acomodo: $("#id_acomodacion_alq").val()
    };
  }

  function GuardarCotizacionFetch(cotizaciones) {
    $(".loader").css("display", "inline-block");

    return fetch('php/guardar_cotizacion.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json; charset=utf-8' },
      body: JSON.stringify({
        id_titular: $("#id_usuario").val(),   // 👈 IMPORTANTE (root)
        id_hotel,
        cod_vendedor,
        cotizaciones
      })
    })
    .then(async (response) => {
      const text = await response.text(); // para ver errores PHP aunque no sea JSON
      if (!response.ok) throw new Error(`HTTP ${response.status}: ${text}`);

      let obj;
      try { obj = JSON.parse(text); }
      catch { throw new Error("Respuesta no es JSON: " + text); }

      if (!obj.success) throw new Error(obj.message || "Error guardando");
      return obj;
    })
    .finally(() => $(".loader").css("display", "none"));
  }

  async function GuardarTodoCotizaciones() {
    try {
      // Limpiar todos los errores previos
      limpiarErrores(document.body);

      // Validar que al menos un tipo de cotización esté seleccionado
      if ($('input[type="checkbox"][name="tipo_cotizacion[]"]:checked').length === 0) {
        const $bloque = $('input[type="checkbox"][name="tipo_cotizacion[]"]').first().closest('.col-md-12');
        mostrarErrorEnContenedor($bloque, 'Selecciona al menos un tipo de cotización');
        $bloque[0]?.scrollIntoView({ behavior: 'smooth', block: 'center' });
        return;
      }
      if (!$("#id_usuario").val()) {
        const $el = $("#id_usuario");
        mostrarErrorCampo($el, 'Selecciona un titular para la cotización');
        $el[0]?.scrollIntoView({ behavior: 'smooth', block: 'center' });
        return;
      }

      const cotizaciones = [];

      // Validar formularios checkeados, incluso si están colapsados
      if (estaActivoTipo(1)) {
        if (!validarFormularioCheckeado('form_alojamiento')) return;
        cotizaciones.push(buildCotizacionAlojamiento());
      }

      if (estaActivoTipo(2)) {
        if (!validarFormularioCheckeado('form_tour')) return;
        cotizaciones.push(buildCotizacionTour());
      }

      if (estaActivoTipo(3)) {
        if (!validarFormularioCheckeado('form_alquiler')) return;
        cotizaciones.push(buildCotizacionAlquiler());
      }

      if (cotizaciones.length === 0) {
        ccAlert("Selecciona al menos un tipo de cotización.", "error");
        return;
      }

      const result = await GuardarCotizacionFetch(cotizaciones);
      ccAlert("Cotización(es) guardada(s) correctamente.", "success");

      console.log(result);

    } catch (e) {
      ccAlert(e.message || "Ocurrió un error al guardar.", "error");
    }
  }

  function limpiarErrores(scope) {
    $(scope).find('.field-error').removeClass('field-error');
    $(scope).find('.invalid-feedback').remove();
  }

  // Inserta error después del control (o después de select2)
  function mostrarErrorCampo(el, mensaje) {
    const $el = $(el);

    // marca el control
    $el.addClass('field-error');

    // si es select2, marcar también el contenedor visible
    if ($el.hasClass('select2-hidden-accessible')) {
      $el.next('.select2').find('.select2-selection').addClass('field-error');
    }

    // evita duplicados cerca
    // (para select2 el error lo ponemos después de .select2)
    if ($el.hasClass('select2-hidden-accessible')) {
      $el.next('.select2').next('.invalid-feedback').remove();
      $el.next('.select2').after(`<div class="invalid-feedback" style="display: block !important; color: #dc3545;">${mensaje}</div>`);
    } else {
      $el.next('.invalid-feedback').remove();
      $el.after(`<div class="invalid-feedback" style="display: block !important; color: #dc3545;">${mensaje}</div>`);
    }
    
    console.log('Error mostrado:', mensaje, 'en elemento:', el);
  }

  // Inserta error debajo de un contenedor (para radios/checkbox)
  function mostrarErrorEnContenedor($container, mensaje) {
    $container.find('.invalid-feedback').remove();
    $container.append(`<div class="invalid-feedback" style="display: block !important; color: #dc3545; margin-top: 0.5rem;">${mensaje}</div>`);
    console.log('Error en contenedor:', mensaje);
  }

  // Valida un form que está checkeado, incluso si está colapsado
  function validarFormularioCheckeado(formId) {
    const form = document.getElementById(formId);
    if (!form) return true;

    limpiarErrores(form);

    // Expandir cualquier collapse dentro del formulario para poder validar
    expandirCollapseDelForm(formId);

    // Obtener TODOS los campos requeridos en orden DOM (de arriba hacia abajo)
    const $allFields = $(form)
      .find('input[required], select[required], textarea[required]')
      .filter(':enabled')
      .not(':disabled');

    const validatedRadioGroups = new Set();

    // Validar en orden de aparición en el DOM
    for (let i = 0; i < $allFields.length; i++) {
      const el = $allFields[i];
      const $el = $(el);

      // Si es un radio button
      if (el.type === 'radio') {
        const groupName = el.name;
        
        // Si ya validamos este grupo, continuar
        if (validatedRadioGroups.has(groupName)) continue;
        
        // Marcar el grupo como validado
        validatedRadioGroups.add(groupName);
        
        // Validar que al menos uno esté seleccionado en este grupo
        const checked = $(form).find(`input[name="${groupName}"]:checked`).length > 0;
        if (!checked) {
          const $block = $(form).find(`input[name="${groupName}"]`).first().closest('.col-md-12, .form-group, .row');
          mostrarErrorEnContenedor($block, 'Selecciona una opción');
          $block[0]?.scrollIntoView({ behavior: 'smooth', block: 'center' });
          return false;
        }
      }
      // Si es checkbox, validar solo si está marcado que debe estarlo
      else if (el.type === 'checkbox') {
        // Los checkbox normalmente se validan de forma diferente
        // Por ahora los saltamos a menos que tengas lógica específica
        continue;
      }
      // Para todos los demás campos (select, input[text], textarea, etc.)
      else {
        const val = $el.val();
        if (val === null || String(val).trim() === '') {
          mostrarErrorCampo(el, 'Este campo es obligatorio');
          el.scrollIntoView({ behavior: 'smooth', block: 'center' });
          setTimeout(() => el.focus(), 300);
          return false;
        }
      }
    }

    return true;
  }

  // Mantener función anterior para compatibilidad (ahora llama a la nueva)
  function validarFormularioVisible(formId) {
    return validarFormularioCheckeado(formId);
  }

  function calcularTarifaTour() {
    const $opt = $('#id_tarifa_tour option:selected');
    if (!$opt.length || !$('#id_tarifa_tour').val()) {
      $("#content_info_tarifa_tour").hide();
      $("#detalle_tarifa_tour").html("");
      $("#tbody_tarifa_tour").html("");
      $("#content_subtotal_tour").html("");
      return;
    }

    const child = parseInt($opt.attr("child") || "0", 10);
    const adult_s = parseInt($opt.attr("adult_s") || "0", 10);
    const adult_d = parseInt($opt.attr("adult_d") || "0", 10);
    const adult_t_c = parseInt($opt.attr("adult_t_c") || "0", 10);
    const validar_noches = String($opt.attr("noches") || "");

    const f_inicio = $('#startDate_tour').val();
    const f_fin = $('#endDate_tour').val();
    if (!f_inicio || !f_fin) {
      $("#content_info_tarifa_tour").hide();
      return;
    }

    const fechaIni = new Date(f_inicio);
    const fechaFin = new Date(f_fin);
    const diff = fechaFin - fechaIni;
    const noches = Math.floor(diff / (1000 * 60 * 60 * 24));

    // Validación pasadía vs noches
    if (validar_noches === "1" && noches === 0) {
      $("#DateRange_tour, #startDate_tour, #endDate_tour").val("");
      $("#tbody_tarifa_tour").html("");
      $("#content_info_tarifa_tour").hide();
      ccAlert("La fecha de entrada no puede ser igual a la fecha de salida", 'error');
      return;
    }

    if (validar_noches === "0" && noches > 0) {
      $("#DateRange_tour, #startDate_tour, #endDate_tour").val("");
      $("#tbody_tarifa_tour").html("");
      $("#content_info_tarifa_tour").hide();
      ccAlert("La fecha de entrada debe ser igual a la fecha de salida", 'error');
      return;
    }

    // Cantidades
    const tipo_viaje = $("input[type='radio'][name='tipo_viaje_tour']:checked").val();

    let inputchild = parseInt($("#child_tour").val() || "0", 10);
    let inputadult_s = parseInt($("#adult_s_tour").val() || "0", 10);
    let inputadult_d = parseInt($("#adult_d_tour").val() || "0", 10);
    let inputadult_t_c = parseInt($("#adult_t_c_tour").val() || "0", 10);
    let infantes = parseInt($("#infante_tour").val() || "0", 10);

    if (tipo_viaje === '0') {
      inputadult_d = 0;
      inputadult_t_c = 0;
    }

    if (tipo_viaje === '2') {
      infantes = 0;
      inputchild = 0;
      inputadult_d = 0;
      inputadult_t_c = 0;
    }

    // Si el pax está deshabilitado por checkbox, su valor queda en 0
    const totalchild = inputchild * child;
    const totaladult_s = inputadult_s * adult_s;
    const totaladult_d = inputadult_d * adult_d;
    const totaladult_t_c = inputadult_t_c * adult_t_c;

    const total_pasajero = inputchild + inputadult_s + inputadult_d + inputadult_t_c;
    const n_noches = (noches === 0 ? "N/A" : noches);
    const infanteTxt = (infantes === 0 ? "No" : "Si");

    $("#detalle_tarifa_tour").html(`
      <div class="info-item">
        <span class="info-label">Noches</span>
        <span class="info-value" id="cantidad_noches_tour">${n_noches}</span>
      </div>
      <div class="info-item">
        <span class="info-label">Pasajeros</span>
        <span class="info-value">${total_pasajero}</span>
      </div>
      <div class="info-item">
        <span class="info-label">Infante</span>
        <span class="info-value">${infanteTxt}</span>
      </div>
    `);

    $("#content_info_tarifa_tour").show();

    // Construcción de tabla según tipo
    const chk_child = $("#chk_child_tour").is(":checked");
    const chk_adult_s = $("#chk_adult_s_tour").is(":checked");
    const chk_adult_d = $("#chk_adult_d_tour").is(":checked");
    const chk_adult_t_c = $("#chk_adult_t_c_tour").is(":checked");

    let filas = "";

    if (tipo_viaje === '0') {
      if (chk_child) filas += `<tr><td>Niños (3-11 Años)</td><td style="text-align:center;">${inputchild}</td><td class="table-right">$${puntosDecimales(child)}</td><td class="table-right">$${puntosDecimales(totalchild)}</td></tr>`;
      if (chk_adult_s) filas += `<tr><td>Adultos</td><td style="text-align:center;">${inputadult_s}</td><td class="table-right">$${puntosDecimales(adult_s)}</td><td class="table-right">$${puntosDecimales(totaladult_s)}</td></tr>`;

      $("#tbody_tarifa_tour").html(filas);
      const subtotal = totalchild + totaladult_s;
      const nochesCalc = (validar_noches === "0" ? 1 : noches);
      const total = subtotal * parseInt(nochesCalc, 10);

      $("#content_subtotal_tour").html(`
        <div class="total-row">
          <span>Valor tour:</span>
          <span>$${puntosDecimales(subtotal)}</span>
        </div>
        <div class="total-row grand-total" style="font-size: 16px;">
          <span>Total tour:</span>
          <span>$${puntosDecimales(total)}</span>
        </div>
      `);
      return;
    }

    if (tipo_viaje === '1') {
      if (chk_child) filas += `<tr><td>Niños</td><td style="text-align:center;">${inputchild}</td><td class="table-right">$${puntosDecimales(child)}</td><td class="table-right">$${puntosDecimales(totalchild)}</td></tr>`;
      if (chk_adult_s) filas += `<tr><td>Adultos sencilla</td><td style="text-align:center;">${inputadult_s}</td><td class="table-right">$${puntosDecimales(adult_s)}</td><td class="table-right">$${puntosDecimales(totaladult_s)}</td></tr>`;
      if (chk_adult_d) filas += `<tr><td>Adultos dobles</td><td style="text-align:center;">${inputadult_d}</td><td class="table-right">$${puntosDecimales(adult_d)}</td><td class="table-right">$${puntosDecimales(totaladult_d)}</td></tr>`;
      if (chk_adult_t_c) filas += `<tr><td>Adultos triple / Cuadruple</td><td style="text-align:center;">${inputadult_t_c}</td><td class="table-right">$${puntosDecimales(adult_t_c)}</td><td class="table-right">$${puntosDecimales(totaladult_t_c)}</td></tr>`;

      $("#tbody_tarifa_tour").html(filas);

      const subtotal = totalchild + totaladult_s + totaladult_d + totaladult_t_c;
      const nochesCalc = (validar_noches === "0" ? 1 : noches);
      const total = subtotal * parseInt(nochesCalc, 10);

      $("#content_subtotal_tour").html(`
        <div class="total-row">
          <span>Valor noche:</span>
          <span>$${puntosDecimales(subtotal)}</span>
        </div>
        <div class="total-row grand-total" style="font-size: 16px;">
          <span>Total noche:</span>
          <span>$${puntosDecimales(total)}</span>
        </div>
      `);
      return;
    }

    if (tipo_viaje === '2') {
      // alquiler: usa adult_s como número alquiler
      $("#tbody_tarifa_tour").html(`
        <tr>
          <td>N° Alquiler</td>
          <td style="text-align:center;">${inputadult_s}</td>
          <td class="table-right">$${puntosDecimales(adult_s)}</td>
          <td class="table-right">$${puntosDecimales(totaladult_s)}</td>
        </tr>
      `);

      const nochesCalc = (n_noches === "N/A" ? 1 : noches);
      const subtotal = totaladult_s;
      const total = subtotal * parseInt(nochesCalc, 10);

      $("#content_subtotal_tour").html(`
        <div class="total-row">
          <span>Valor Alquiler:</span>
          <span>$${puntosDecimales(subtotal)}</span>
        </div>
        <div class="total-row grand-total" style="font-size: 16px;">
          <span>Total Alquiler:</span>
          <span>$${puntosDecimales(total)}</span>
        </div>
      `);
    }
  }

  function calcularTarifaAlquiler() {
    const $opt = $('#id_tarifa_alq option:selected');
    if (!$opt.length || !$('#id_tarifa_alq').val()) {
      $("#content_info_tarifa_alq").hide();
      $("#detalle_tarifa_alq").html("");
      $("#tbody_tarifa_alq").html("");
      $("#content_subtotal_alq").html("");
      return;
    }

    const child = parseInt($opt.attr("child") || "0", 10);
    const adult_s = parseInt($opt.attr("adult_s") || "0", 10);
    const adult_d = parseInt($opt.attr("adult_d") || "0", 10);
    const adult_t_c = parseInt($opt.attr("adult_t_c") || "0", 10);
    const validar_noches = String($opt.attr("noches") || "");

    const f_inicio = $('#startDate_alq').val();
    const f_fin = $('#endDate_alq').val();
    if (!f_inicio || !f_fin) {
      $("#content_info_tarifa_alq").hide();
      return;
    }

    const fechaIni = new Date(f_inicio);
    const fechaFin = new Date(f_fin);
    const diff = fechaFin - fechaIni;
    const noches = Math.floor(diff / (1000 * 60 * 60 * 24));

    // Validación pasadía vs noches
    if (validar_noches === "1" && noches === 0) {
      $("#DateRange_alq, #startDate_alq, #endDate_alq").val("");
      $("#tbody_tarifa_alq").html("");
      $("#content_info_tarifa_alq").hide();
      ccAlert("La fecha de entrada no puede ser igual a la fecha de salida", 'error');
      return;
    }

    if (validar_noches === "0" && noches > 0) {
      $("#DateRange_alq, #startDate_alq, #endDate_alq").val("");
      $("#tbody_tarifa_alq").html("");
      $("#content_info_tarifa_alq").hide();
      ccAlert("La fecha de entrada debe ser igual a la fecha de salida", 'error');
      return;
    }

    // Cantidades
    const tipo_viaje = $("input[type='radio'][name='tipo_viaje_alq']:checked").val();

    let inputchild = parseInt($("#child_alq").val() || "0", 10);
    let inputadult_s = parseInt($("#adult_s_alq").val() || "0", 10);
    let inputadult_d = parseInt($("#adult_d_alq").val() || "0", 10);
    let inputadult_t_c = parseInt($("#adult_t_c_alq").val() || "0", 10);
    let infantes = parseInt($("#infante_alq").val() || "0", 10);

    if (tipo_viaje === '0') {
      inputadult_d = 0;
      inputadult_t_c = 0;
    }

    if (tipo_viaje === '2') {
      infantes = 0;
      inputchild = 0;
      inputadult_d = 0;
      inputadult_t_c = 0;
    }

    // Si el pax está deshabilitado por checkbox, su valor queda en 0
    const totalchild = inputchild * child;
    const totaladult_s = inputadult_s * adult_s;
    const totaladult_d = inputadult_d * adult_d;
    const totaladult_t_c = inputadult_t_c * adult_t_c;

    const total_pasajero = inputchild + inputadult_s + inputadult_d + inputadult_t_c;
    const n_noches = (noches === 0 ? "N/A" : noches);
    const infanteTxt = (infantes === 0 ? "No" : "Si");

    // Ajustar el detalle según el tipo de servicio
    if (tipo_viaje === '2') {
      // Para alquiler, mostrar solo días y número de alquiler
      $("#detalle_tarifa_alq").html(`
        <div class="info-item">
          <span class="info-label">Días</span>
          <span class="info-value" id="cantidad_noches_alq">${n_noches === "N/A" ? "1" : n_noches}</span>
        </div>
        <div class="info-item">
          <span class="info-label">N° Alquiler</span>
          <span class="info-value">${inputadult_s}</span>
        </div>
      `);
    } else {
      // Para pasadía y noches con pasajeros
      $("#detalle_tarifa_alq").html(`
        <div class="info-item">
          <span class="info-label">Noches</span>
          <span class="info-value" id="cantidad_noches_alq">${n_noches}</span>
        </div>
        <div class="info-item">
          <span class="info-label">Pasajeros</span>
          <span class="info-value">${total_pasajero}</span>
        </div>
        <div class="info-item">
          <span class="info-label">Infante</span>
          <span class="info-value">${infanteTxt}</span>
        </div>
      `);
    }

    $("#content_info_tarifa_alq").show();

    // Construcción de tabla según tipo
    const chk_child = $("#chk_child_alq").is(":checked");
    const chk_adult_s = $("#chk_adult_s_alq").is(":checked");
    const chk_adult_d = $("#chk_adult_d_alq").is(":checked");
    const chk_adult_t_c = $("#chk_adult_t_c_alq").is(":checked");

    let filas = "";

    if (tipo_viaje === '0') {
      if (chk_child) filas += `<tr><td>Niños (3-11 Años)</td><td style="text-align:center;">${inputchild}</td><td class="table-right">$${puntosDecimales(child)}</td><td class="table-right">$${puntosDecimales(totalchild)}</td></tr>`;
      if (chk_adult_s) filas += `<tr><td>Adultos</td><td style="text-align:center;">${inputadult_s}</td><td class="table-right">$${puntosDecimales(adult_s)}</td><td class="table-right">$${puntosDecimales(totaladult_s)}</td></tr>`;

      $("#tbody_tarifa_alq").html(filas);
      const subtotal = totalchild + totaladult_s;
      const nochesCalc = (validar_noches === "0" ? 1 : noches);
      const total = subtotal * parseInt(nochesCalc, 10);

      $("#content_subtotal_alq").html(`
        <div class="total-row">
          <span>Valor tour:</span>
          <span>$${puntosDecimales(subtotal)}</span>
        </div>
        <div class="total-row grand-total" style="font-size: 16px;">
          <span>Total tour:</span>
          <span>$${puntosDecimales(total)}</span>
        </div>
      `);
      return;
    }

    if (tipo_viaje === '1') {
      if (chk_child) filas += `<tr><td>Niños</td><td style="text-align:center;">${inputchild}</td><td class="table-right">$${puntosDecimales(child)}</td><td class="table-right">$${puntosDecimales(totalchild)}</td></tr>`;
      if (chk_adult_s) filas += `<tr><td>Adultos sencilla</td><td style="text-align:center;">${inputadult_s}</td><td class="table-right">$${puntosDecimales(adult_s)}</td><td class="table-right">$${puntosDecimales(totaladult_s)}</td></tr>`;
      if (chk_adult_d) filas += `<tr><td>Adultos dobles</td><td style="text-align:center;">${inputadult_d}</td><td class="table-right">$${puntosDecimales(adult_d)}</td><td class="table-right">$${puntosDecimales(totaladult_d)}</td></tr>`;
      if (chk_adult_t_c) filas += `<tr><td>Adultos triple / Cuadruple</td><td style="text-align:center;">${inputadult_t_c}</td><td class="table-right">$${puntosDecimales(adult_t_c)}</td><td class="table-right">$${puntosDecimales(totaladult_t_c)}</td></tr>`;

      $("#tbody_tarifa_alq").html(filas);

      const subtotal = totalchild + totaladult_s + totaladult_d + totaladult_t_c;
      const nochesCalc = (validar_noches === "0" ? 1 : noches);
      const total = subtotal * parseInt(nochesCalc, 10);

      $("#content_subtotal_alq").html(`
        <div class="total-row">
          <span>Valor noche:</span>
          <span>$${puntosDecimales(subtotal)}</span>
        </div>
        <div class="total-row grand-total" style="font-size: 16px;">
          <span>Total noche:</span>
          <span>$${puntosDecimales(total)}</span>
        </div>
      `);
      return;
    }

    if (tipo_viaje === '2') {
      // alquiler: usa adult_s como número alquiler
      // En este caso, el campo es un input simple, no un checkbox con stepper
      const numAlquiler = inputadult_s; // Ya está parseado arriba
      
      $("#tbody_tarifa_alq").html(`
        <tr>
          <td>N° Alquiler</td>
          <td style="text-align:center;">${numAlquiler}</td>
          <td class="table-right">$${puntosDecimales(adult_s)}</td>
          <td class="table-right">$${puntosDecimales(totaladult_s)}</td>
        </tr>
      `);

      const nochesCalc = (n_noches === "N/A" ? 1 : noches);
      const subtotal = totaladult_s;
      const total = subtotal * parseInt(nochesCalc, 10);

      $("#content_subtotal_alq").html(`
        <div class="total-row">
          <span>Valor Alquiler:</span>
          <span>$${puntosDecimales(subtotal)}</span>
        </div>
        <div class="total-row grand-total" style="font-size: 16px;">
          <span>Total Alquiler:</span>
          <span>$${puntosDecimales(total)}</span>
        </div>
      `);
    }
  }

  function calcularTarifa() {
    const $opt = $('#id_tarifa option:selected');
    if (!$opt.length || !$('#id_tarifa').val()) {
      $("#content_info_tarifa").hide();
      $("#detalle_tarifa").html("");
      $("#tbody_tarifa").html("");
      $("#content_subtotal").html("");
      return;
    }

    const child = parseInt($opt.attr("child") || "0", 10);
    const adult_s = parseInt($opt.attr("adult_s") || "0", 10);
    const adult_d = parseInt($opt.attr("adult_d") || "0", 10);
    const adult_t_c = parseInt($opt.attr("adult_t_c") || "0", 10);
    const validar_noches = String($opt.attr("noches") || "");

    const f_inicio = $('#startDate').val();
    const f_fin = $('#endDate').val();
    if (!f_inicio || !f_fin) {
      $("#content_info_tarifa").hide();
      return;
    }

    const fechaIni = new Date(f_inicio);
    const fechaFin = new Date(f_fin);
    const diff = fechaFin - fechaIni;
    const noches = Math.floor(diff / (1000 * 60 * 60 * 24));

    // Validación pasadía vs noches
    if (validar_noches === "1" && noches === 0) {
      $("#DateRange, #startDate, #endDate").val("");
      $("#tbody_tarifa").html("");
      $("#content_info_tarifa").hide();
      ccAlert("La fecha de entrada no puede ser igual a la fecha de salida", 'error');
      return;
    }

    if (validar_noches === "0" && noches > 0) {
      $("#DateRange, #startDate, #endDate").val("");
      $("#tbody_tarifa").html("");
      $("#content_info_tarifa").hide();
      ccAlert("La fecha de entrada debe ser igual a la fecha de salida", 'error');
      return;
    }

    // Cantidades
    const tipo_viaje = $("input[type='radio'][name='tipo_viaje']:checked").val();

    let inputchild = parseInt($("#child").val() || "0", 10);
    let inputadult_s = parseInt($("#adult_s").val() || "0", 10);
    let inputadult_d = parseInt($("#adult_d").val() || "0", 10);
    let inputadult_t_c = parseInt($("#adult_t_c").val() || "0", 10);
    let infantes = parseInt($("#infante").val() || "0", 10);

    if (tipo_viaje === '2') {
      infantes = 0;
      inputchild = 0;
      inputadult_d = 0;
      inputadult_t_c = 0;
    }

    // Si el pax está deshabilitado por checkbox, su valor queda en 0 (tu código ya lo hace)
    const totalchild = inputchild * child;
    const totaladult_s = inputadult_s * adult_s;
    const totaladult_d = inputadult_d * adult_d;
    const totaladult_t_c = inputadult_t_c * adult_t_c;

    const total_pasajero = inputchild + inputadult_s + inputadult_d + inputadult_t_c;
    const n_noches = (noches === 0 ? "N/A" : noches);
    const infanteTxt = (infantes === 0 ? "No" : "Si");

    $("#detalle_tarifa").html(`
      <div class="info-item">
        <span class="info-label">Noches</span>
        <span class="info-value" id="cantidad_noches">${n_noches}</span>
      </div>
      <div class="info-item">
        <span class="info-label">Pasajeros</span>
        <span class="info-value">${total_pasajero}</span>
      </div>
      <div class="info-item">
        <span class="info-label">Infante</span>
        <span class="info-value">${infanteTxt}</span>
      </div>
    `);

    $("#content_info_tarifa").show();

    // Construcción de tabla según tipo
    const chk_child = $("#chk_child").is(":checked");
    const chk_adult_s = $("#chk_adult_s").is(":checked");
    const chk_adult_d = $("#chk_adult_d").is(":checked");
    const chk_adult_t_c = $("#chk_adult_t_c").is(":checked");

    let filas = "";

    // Para ALOJAMIENTO: pasadía y noches tienen las mismas 5 opciones
    if (tipo_viaje === '0' || tipo_viaje === '1') {
      if (chk_child) filas += `<tr><td>Niños</td><td style="text-align:center;">${inputchild}</td><td class="table-right">$${puntosDecimales(child)}</td><td class="table-right">$${puntosDecimales(totalchild)}</td></tr>`;
      if (chk_adult_s) filas += `<tr><td>Adultos individual</td><td style="text-align:center;">${inputadult_s}</td><td class="table-right">$${puntosDecimales(adult_s)}</td><td class="table-right">$${puntosDecimales(totaladult_s)}</td></tr>`;
      if (chk_adult_d) filas += `<tr><td>Adultos doble</td><td style="text-align:center;">${inputadult_d}</td><td class="table-right">$${puntosDecimales(adult_d)}</td><td class="table-right">$${puntosDecimales(totaladult_d)}</td></tr>`;
      if (chk_adult_t_c) filas += `<tr><td>Adultos triple/cuadruple</td><td style="text-align:center;">${inputadult_t_c}</td><td class="table-right">$${puntosDecimales(adult_t_c)}</td><td class="table-right">$${puntosDecimales(totaladult_t_c)}</td></tr>`;

      $("#tbody_tarifa").html(filas);
      
      const subtotal = totalchild + totaladult_s + totaladult_d + totaladult_t_c;
      const nochesCalc = (validar_noches === "0" ? 1 : noches);
      const total = subtotal * parseInt(nochesCalc, 10);

      const labelValor = (tipo_viaje === '0' ? 'Valor pasadía' : 'Valor noche');
      const labelTotal = (tipo_viaje === '0' ? 'Total pasadía' : 'Total noche');

      $("#content_subtotal").html(`
        <div class="total-row">
          <span>${labelValor}:</span>
          <span>$${puntosDecimales(subtotal)}</span>
        </div>
        <div class="total-row grand-total" style="font-size: 16px;">
          <span>${labelTotal}:</span>
          <span>$${puntosDecimales(total)}</span>
        </div>
      `);
      return;
    }

    if (tipo_viaje === '2') {
      // alquiler: usa adult_s como número alquiler
      $("#tbody_tarifa").html(`
        <tr>
          <td>N° Alquiler</td>
          <td style="text-align:center;">${inputadult_s}</td>
          <td class="table-right">$${puntosDecimales(adult_s)}</td>
          <td class="table-right">$${puntosDecimales(totaladult_s)}</td>
        </tr>
      `);

      const nochesCalc = (n_noches === "N/A" ? 1 : noches);
      const subtotal = totaladult_s;
      const total = subtotal * parseInt(nochesCalc, 10);

      $("#content_subtotal").html(`
        <div class="total-row">
          <span>Valor Alquiler:</span>
          <span>$${puntosDecimales(subtotal)}</span>
        </div>
        <div class="total-row grand-total" style="font-size: 16px;">
          <span>Total Alquiler:</span>
          <span>$${puntosDecimales(total)}</span>
        </div>
      `);
    }
  }

    // Limpia error cuando cambian (incluye select2)
  $(document).on('input change', 'input, select, textarea', function () {
    const $el = $(this);
    $el.removeClass('field-error');
    $el.next('.invalid-feedback').remove();

    // limpiar select2 visible
    if ($el.hasClass('select2-hidden-accessible')) {
      $el.next('.select2').find('.select2-selection').removeClass('field-error');
      $el.next('.select2').next('.invalid-feedback').remove();
    }
  });

  // Disparadores (IMPORTANTES)
  $(document).on('change input', 
    '#id_tarifa, #DateRange, #startDate, #endDate, #infante, #child, #adult_s, #adult_d, #adult_t_c, input[name="tipo_viaje"], .pax-check',
    calcularTarifa
  );

  // Disparadores para TOUR
  $(document).on('change input', 
    '#id_tarifa_tour, #DateRange_tour, #startDate_tour, #endDate_tour, #infante_tour, #child_tour, #adult_s_tour, #adult_d_tour, #adult_t_c_tour, input[name="tipo_viaje_tour"], .pax-check',
    calcularTarifaTour
  );

  // Disparadores para ALQUILER
  $(document).on('change input', 
    '#id_tarifa_alq, #DateRange_alq, #startDate_alq, #endDate_alq, #infante_alq, #child_alq, #adult_s_alq, #adult_d_alq, #adult_t_c_alq, input[name="tipo_viaje_alq"], .pax-check',
    calcularTarifaAlquiler
  );

     // Checkbox habilita/deshabilita input + botones +/- y resetea a 0 si se apaga
  $(document).on('change', '.pax-check', function () {
    const target = $(this).data('target');
    const enabled = $(this).is(':checked');
    const row = $(this).closest('.pax-row');

    $(target).prop('disabled', !enabled);
    row.toggleClass('disabled', !enabled);

    row.find('.pax-minus, .pax-plus').prop('disabled', !enabled);

    if (!enabled) {
      $(target).val('0');
    } else {
      if ($(target).val() === '0') $(target).val('1');
    }
    
    // Trigger cálculo según el formulario
    const inputId = target.replace('#', '');
    if (inputId.includes('_tour')) {
      calcularTarifaTour();
    } else if (inputId.includes('_alq')) {
      calcularTarifaAlquiler();
    } else {
      calcularTarifa();
    }
  });

  // Stepper +/-
  $(document).on('click', '.pax-plus', function () {
    const target = $(this).data('target');
    const v = parseInt($(target).val() || '0', 10);
    $(target).val(v + 1).trigger('input');
  });

  $(document).on('click', '.pax-minus', function () {
    const target = $(this).data('target');
    const v = parseInt($(target).val() || '0', 10);
    $(target).val(Math.max(0, v - 1)).trigger('input');
  });

  // Solo números (y permite vacío momentáneo)
  $(document).on('input', '.pax-input', function(){
    this.value = this.value.replace(/[^\d]/g,'');
    if (this.value === '') this.value = '0';
    
    // Trigger cálculo según el formulario
    const inputId = $(this).attr('id');
    if (inputId && inputId.includes('_tour')) {
      calcularTarifaTour();
    } else if (inputId && inputId.includes('_alq')) {
      calcularTarifaAlquiler();
    } else if (inputId) {
      calcularTarifa();
    }
  });

</script>
</body>
</html>