<?php
// start a session
session_start();
 if (!isset($_SESSION['id'])) {
    header ("Location:index.php"); 
 }

 if (!isset($_SESSION['id_hotel'])) {
    header ("Location:welcome.php"); 
  }

  $usuarios = '<button type="button" class="btn btn-link btn-sm float-right" data-toggle="modal" data-target=".crear_titular_modal" >Crear Cliente</button>';
  if ($_SESSION['menu_general']['success']) {
    for ($i=0; $i < count($_SESSION['menu_general']['resultado']) ; $i++) { 
        if ($_SESSION['menu_general']['resultado'][$i]['nombre'] == 'usuarios') {
          $usuarios = '<button type="button" class="btn btn-link btn-sm float-right" data-toggle="modal" data-target=".crear_titular_modal" >Crear Cliente</button>';
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
        background: #fff;
        /* <-- background-image: url('assets/img/bg-coticlick.png');  cambia esta ruta a tu imagen */
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
      .cc-panel .ts-control{
        border-radius: 12px !important;
        border: 1px solid rgba(15,23,42,.12) !important;
        height: 40px;
      }
      .cc-panel textarea.form-control{
        height: auto;
        min-height: 90px;
      }

      /* Tom Select dentro del panel */
      .ts-wrapper.single .ts-control{
        min-height: 40px !important;
        border-radius: 12px !important;
        border: 1px solid rgba(15,23,42,.12) !important;
        padding: 7px 10px !important;
      }
      .ts-wrapper.single .ts-control .item{
        line-height: 24px !important;
      }
      .ts-dropdown{
        border-radius: 12px !important;
        border: 1px solid rgba(15,23,42,.12) !important;
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

      /* Botón "Crear Cliente" como link pill */
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

      .ts-control.field-error {
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

      /* Botón flotante PDF en modal de previsualización */
      .cc-pdf-fab {
        position: absolute;
        top: 14px;
        right: 14px;
        z-index: 5;
      }
      .cc-pdf-fab-btn {
        width: 44px;
        height: 44px;
        border-radius: 999px;
        border: 0;
        background: #dc3545;
        color: #fff;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 10px 20px rgba(0,0,0,0.18);
      }
      .cc-pdf-fab-btn:hover { filter: brightness(0.98); }
      .cc-pdf-fab-btn:focus { outline: none; box-shadow: 0 0 0 0.2rem rgba(220,53,69,0.25), 0 10px 20px rgba(0,0,0,0.18); }
      .cc-pdf-fab-btn i { font-size: 18px; }
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

      /* ===== Tabla de búsqueda (DataTables) responsive ===== */
      #tabla_cotizacion_container{
        width: 100%;
        max-width: 100%;
        overflow-x: hidden;
        -webkit-overflow-scrolling: touch;
        margin: 15px 0;
      }
      #tabla_cotizacion_container .dataTables_wrapper{
        width: 100% !important;
      }
      #tabla_cotizacion{
        width: 100% !important;
        max-width: 100%;
      }
      #tabla_cotizacion th,
      #tabla_cotizacion td{
        white-space: nowrap;
      }

      /* Truncate para celdas largas (fallback en pantallas pequeñas) */
      #tabla_cotizacion .dt-truncate{
        display: inline-block;
        max-width: 260px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        vertical-align: bottom;
      }
      @media (max-width: 768px){
        #tabla_cotizacion .dt-truncate{ max-width: 140px; }
      }
      @media (max-width: 420px){
        #tabla_cotizacion .dt-truncate{ max-width: 110px; }
      }

      /* Fallback: ocultar columnas por ancho si Responsive no entra */
      @media (max-width: 1200px){
        #tabla_cotizacion th:nth-child(5),
        #tabla_cotizacion td:nth-child(5){
          display: none;
        }
      }
      @media (max-width: 992px){
        #tabla_cotizacion th:nth-child(3),
        #tabla_cotizacion td:nth-child(3){
          display: none;
        }
      }
      @media (max-width: 768px){
        #tabla_cotizacion th:nth-child(4),
        #tabla_cotizacion td:nth-child(4){
          display: none;
        }
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

      .nav-tabs {
        border-bottom: none !important;
      }

      .btn-option {
        background: transparent !important;
        border-radius: 15px !important;
        color: rgba(15,23,42,.65) !important;
        font-weight: 600;
      }

      .btn-option.active {
        color: #fff !important;
        background: #2D7FF9 !important;
        border: 0 !important;
      }

      .nav-options {
        margin: 10px;
      }

      div.dataTables_wrapper div.dataTables_filter input {
        margin-left: 0 !important;
        border-radius: 0 12px 12px 0 !important;
      }

      .dataTables_wrapper.dt-minimal-wrap .dt-search-group .input-group-text {
        border-radius: 12px 0 0 12px !important;
      }

      .dataTables_wrapper.dt-minimal-wrap .dt-length .custom-select, .dataTables_wrapper.dt-minimal-wrap .dt-length select {
        border-radius: 12px !important;
      }

      /* LAYOUT DE MODAL DE CREACION DE TITULAR */
            /* MODAL GLASS */
      .crear_titular_modal .modal-content{
          border-radius:12px;
          border:none;
          background:rgba(255,255,255,0.85);
          backdrop-filter: blur(10px);
          box-shadow:0 15px 40px rgba(0,0,0,0.15);
      }

      /* HEADER */
      .crear_titular_modal .modal-header{
          border-bottom:1px solid rgba(0,0,0,.05);
          padding:18px 22px;
      }

      .crear_titular_modal .modal-title{
          font-weight:600;
          font-size:18px;
      }

      /* BODY */
      .crear_titular_modal .modal-body{
          padding:25px;
          overflow: visible;
      }

        .crear_titular_modal .ts-dropdown{
          z-index: 2055 !important;
        }

      /* INPUTS */
      .crear_titular_modal .form-control{
          border-radius:10px;
          border:1px solid #e5e7eb;
          height:42px;
          font-size:14px;
      }

      .crear_titular_modal .form-control:focus{
          border-color:#3b82f6;
          box-shadow:0 0 0 3px rgba(59,130,246,.15);
      }

      /* LABELS */
      .crear_titular_modal label{
          font-size:13px;
          font-weight:600;
          color:#6b7280;
      }

      /* INPUT ICON */
      .input-icon{
          position:relative;
      }

      .input-icon i{
          position:absolute;
          left:12px;
          top:50%;
          transform:translateY(-50%);
          color:#9ca3af;
      }

      .input-icon input{
          padding-left:35px;
      }

      /* BOTON */
      .btn-save-user{
          border-radius:10px;
          padding:10px 28px;
          font-weight:600;
          background:#22c55e;
          border:none;
      }

      .btn-save-user:hover{
          background:#16a34a;
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
                <div class="col-md-12 mb-3">
                  <?php echo $usuarios ?>
                  <label for="firstName">Nombre del cliente</label>
                    <select style="width:100%" name="id_usuario" required id="id_usuario" onchange="detalle_titular(this.value)" class="form-control form-control-md id_usuarios">
                      <option value="">Seleccionar</option>
                    </select>
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
                      <div class="col-md-12 mb-3" style="display:none">
                        <label><span>Tipo de servicio</span></label>
                        <br>

                        <div class="form-check-inline">
                          <label class="form-check-label" style="font-size:12px">
                            <input type="radio" name="tipo_viaje_tour" onclick="traer_tarifas(0, '_tour')" required value="0" class="form-check-input">
                            Tour
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

                    <div class="row" style="display:none">
                      <div class="col-md-12 mb-3">
                        <label for="id_acomodacion_tour">Descripción</label>
                        <textarea style="width:100%" name="id_acomodacion_tour" id="id_acomodacion_tour"
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
                      <div class="col-md-12 mb-3" style="display:none">
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

                    <div class="row" style="display:none">
                      <div class="col-md-12 mb-3">
                        <label for="id_acomodacion_alq">Descripción</label>
                        <textarea style="width:100%" name="id_acomodacion_alq" id="id_acomodacion_alq"
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
                  <div class="col-md-12 mb-3">
                    <button type="button" class="btn btn-success btn-block" onclick="GuardarTodoCotizaciones()">
                      <i class="fas fa-save"></i> Guardar cotización
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
            <ul class="nav nav-tabs nav-options" id="myTab" role="tablist">
              <li class="nav-item">
                <button class="btn btn-option active" onclick="show_traer_tabla_cotizacion()" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Buscar</button>
              </li>
              <li class="nav-item">
                <button class="btn btn-option" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Previsualización</button>
              </li>
              <!-- <li class="nav-item ml-auto">
                
              </li> -->
            </ul>
            <div class="tab-content" id="myTabContent">
              <div class="tab-pane fade" id="home" role="tabpanel" aria-labelledby="home-tab">
                <div class="d-flex justify-content-end float-right" style="margin: 8px 10px 10px;">
                  <button type="button" class="cc-pdf-fab-btn cc-pdf-fab-btn--sm" onclick="previsualizarPDFBorrador()" title="Previsualizar" aria-label="Previsualizar" id="pdf">
                    <i class="fas fa-eye"></i>
                  </button>
                </div>
                <div class="cotizacion-preview-container" style="max-width: 900px; margin: 0 auto; padding: 1rem;">
                  <div id="logoGifWrap" style="display: flex; align-items: center; justify-content: center; margin-bottom: 1.5rem; clear: both;">
                    <p style="padding: 8rem;color:#e3e3e3">Genera la cotizacion a tu gusto y haz clic en "<i class="text-danger fas fa-eye"></i>" para ver el resultado.</p>
                    <!-- <img src="assets/img/logo-gif.gif" id="logoGif" style="width: 50%; height: auto; right: 55%;" alt="Imagen decorativa"> -->
                  </div>
                  <div class="cotizacion-section" id="content_info_titular" style="display:none">
                    <div class="section-header">
                      <div class="section-icon">
                        <i class="fas fa-user"></i>
                      </div>
                      <h2 class="section-title">Información del cliente</h2>
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
              <div class="tab-pane fade show active dt-responsive" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <div class="container-fluid">
                  <div class="row">
                    <div class="col-sm-12">
                      <div id="tabla_cotizacion_container" >
                        <table id="tabla_cotizacion" class="table table-striped dt-responsive nowrap" style="width:100%">
                          <thead>
                              <tr>
                                <th class="all">ID</th>
                                <th class="all">Cliente</th>
                                <th class="min-tablet-l">Autor</th>
                                <th class="min-tablet-p">Fecha creación</th>
                                <th class="min-desktop">Fecha actualización</th>
                                <th class="all"></th>
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
        <h5 class="modal-title">Previsualización de cotización</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body" style="padding: 0; background: #f8fafc; position: relative;">
        <div id="btn_pdf" class="cc-pdf-fab"></div>
        <div id="print_cotizacion"></div>
      </div>
    </div>
  </div>
</div>


<div class="modal fade crear_titular_modal" id="crear_titular_modal" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    
    <div class="modal-content">
      
      <div class="modal-header">
        <h5 class="modal-title">Crear Cliente</h5>

        <div id="btn_pdf_crear_titular"></div>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>

      <div class="modal-body">

        <div class="card mt-3" style="border-radius:12px !important;">
          <div class="card-body">

            <form 
              role="form"
              onsubmit="event.preventDefault(); return GuardarUsuario();"
              id="form_guardar"
              class="needs-validation"
            >

              <div class="row">

                <div style="display:none" class="col-md-6 mb-3">
                  <label for="codigo">Código</label>
                  <input 
                    type="text"
                    autocomplete="off"
                    value="0"
                    class="form-control"
                    onkeypress="return isNumber(event)"
                    name="codigo"
                    id="codigo"
                    required
                  >
                </div>

                <div class="col-md-12 mb-3">
                  <label for="cedula">Cédula</label>
                  <input 
                    type="text"
                    autocomplete="off"
                    class="form-control"
                    maxlength="11"
                    onkeypress="return isNumber(event)"
                    name="cedula"
                    id="cedula"
                  >
                </div>

                <div class="col-md-12 mb-3">
                  <label for="nombre1">Primer nombre</label>
                  <input 
                    type="text"
                    autocomplete="off"
                    class="form-control"
                    maxlength="255"
                    name="nombre1"
                    id="nombre1"
                    required
                  >
                </div>

                <div class="col-md-12 mb-3">
                  <label for="nombre2">Segundo nombre</label>
                  <input 
                    type="text"
                    autocomplete="off"
                    class="form-control"
                    maxlength="255"
                    name="nombre2"
                    id="nombre2"
                  >
                </div>

                <div class="col-md-12 mb-3">
                  <label for="apellido1">Primer Apellido</label>
                  <input 
                    type="text"
                    autocomplete="off"
                    class="form-control"
                    maxlength="255"
                    name="apellido1"
                    id="apellido1"
                  >
                </div>

                <div class="col-md-12 mb-3">
                  <label for="apellido2">Segundo apellido</label>
                  <input 
                    type="text"
                    autocomplete="off"
                    class="form-control"
                    maxlength="255"
                    name="apellido2"
                    id="apellido2"
                  >
                </div>

                <div class="col-md-12 mb-3">
                  <label for="email">Email</label>
                  <input 
                    type="email"
                    autocomplete="off"
                    class="form-control"
                    maxlength="100"
                    name="email"
                    id="email"
                  >
                </div>

                <div class="col-md-12 mb-3">
                  <label for="telefono_indicativo">Pais</label>
                  <select
                    id="telefono_indicativo"
                    name="telefono_indicativo"
                    class="form-control"
                    onchange="traer_deptos(this.value)"
                    required
                  >
                    <option value="+57">🇨🇴 +57 Colombia</option>
                    <option value="+1">🇺🇸 +1 Estados Unidos</option>
                    <option value="+52">🇲🇽 +52 México</option>
                    <option value="+54">🇦🇷 +54 Argentina</option>
                    <option value="+55">🇧🇷 +55 Brasil</option>
                    <option value="+56">🇨🇱 +56 Chile</option>
                    <option value="+58">🇻🇪 +58 Venezuela</option>
                    <option value="+51">🇵🇪 +51 Perú</option>
                    <option value="+593">🇪🇨 +593 Ecuador</option>
                    <option value="+591">🇧🇴 +591 Bolivia</option>
                    <option value="+595">🇵🇾 +595 Paraguay</option>
                    <option value="+598">🇺🇾 +598 Uruguay</option>
                    <option value="+507">🇵🇦 +507 Panamá</option>
                    <option value="+506">🇨🇷 +506 Costa Rica</option>
                    <option value="+503">🇸🇻 +503 El Salvador</option>
                    <option value="+502">🇬🇹 +502 Guatemala</option>
                    <option value="+504">🇭🇳 +504 Honduras</option>
                    <option value="+505">🇳🇮 +505 Nicaragua</option>
                    <option value="+53">🇨🇺 +53 Cuba</option>
                    <option value="+34">🇪🇸 +34 España</option>
                    <option value="+33">🇫🇷 +33 Francia</option>
                    <option value="+39">🇮🇹 +39 Italia</option>
                    <option value="+44">🇬🇧 +44 Reino Unido</option>
                    <option value="+49">🇩🇪 +49 Alemania</option>
                  </select>
                </div>

                <div class="col-md-12 mb-3">
                  <label for="telefono">Celular</label>
                  <div class="row">
                    <div class="col-12 pl-1">
                      <input 
                        type="text"
                        autocomplete="off"
                        onkeypress="return isNumber(event)"
                        maxlength="15"
                        class="form-control"
                        name="telefono"
                        id="telefono"
                        placeholder="Celular"
                        required
                      >
                    </div>
                  </div>
                </div>

                <div class="col-md-12 mb-3">
                  <label for="select_deptos">Departamento</label>
                  <select 
                    style="width:100%"
                    name="select_deptos"
                    id="select_deptos"
                    class="form-control form-control-md deptos"
                  >
                    <option value="">Seleccionar</option>
                  </select>
                </div>

                <div class="col-md-12 mb-3">
                  <label for="ciudad">Ciudad</label>
                  <input 
                    type="text"
                    autocomplete="off"
                    class="form-control"
                    maxlength="255"
                    name="ciudad"
                    id="ciudad"
                  >
                </div>

                <div class="col-md-12 mb-3">
                  <label for="direccion">Dirección</label>
                  <input 
                    type="text"
                    autocomplete="off"
                    class="form-control"
                    maxlength="100"
                    name="direccion"
                    id="direccion"
                  >
                </div>

                <div class="col-md-12 mb-3" style="display:none">
                  <label for="tipo">Perfil</label>
                  <select 
                    style="width:100%"
                    name="tipo"
                    required
                    id="tipo"
                    class="form-control form-control-md terminos_condiciones"
                  >
                    <option value="TITULAR">Cliente</option>
                  </select>
                </div>

                <div class="col-md-12 mb-3">
                  <button type="submit" class="btn btn-success float-right">
                    Guardar usuario
                  </button>
                </div>

              </div>

              <div class="row"></div>

            </form>

          </div>
        </div>

      </div>

    </div>

  </div>
</div>

<?php require 'partials/librerias.php'; ?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/css/tom-select.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/js/tom-select.complete.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/es.js"></script>

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
  var flatpickrInstances = {};

  function formatDateDisplay(date) {
    const day = String(date.getDate()).padStart(2, '0');
    const month = String(date.getMonth() + 1).padStart(2, '0');
    const year = date.getFullYear();
    return `${day}-${month}-${year}`;
  }

  function formatDateISO(date) {
    const day = String(date.getDate()).padStart(2, '0');
    const month = String(date.getMonth() + 1).padStart(2, '0');
    const year = date.getFullYear();
    return `${year}-${month}-${day}`;
  }

  function clearDateRangeFields(suffix) {
    $('#DateRange' + suffix).val('');
    $('#startDate' + suffix).val('').trigger('change');
    $('#endDate' + suffix).val('').trigger('change');
  }

  function destroyFlatpickrInstance(suffix) {
    if (flatpickrInstances[suffix]) {
      flatpickrInstances[suffix].destroy();
      delete flatpickrInstances[suffix];
    }
  }

  function initFlatpickrDateRange(esUnaFecha, suffix) {
    suffix = suffix || '';
    const input = document.getElementById('DateRange' + suffix);
    if (!input || typeof flatpickr === 'undefined') return;

    destroyFlatpickrInstance(suffix);

    flatpickrInstances[suffix] = flatpickr(input, {
      mode: esUnaFecha ? 'single' : 'range',
      dateFormat: 'd-m-Y',
      locale: flatpickr.l10ns.es,
      disableMobile: true,
      allowInput: false,
      conjunction: ' - ',
      onChange: function(selectedDates, dateStr, instance) {
        if (esUnaFecha) {
          if (selectedDates.length === 1) {
            const start = selectedDates[0];
            instance.input.value = formatDateDisplay(start);
            $('#startDate' + suffix).val(formatDateISO(start)).trigger('change');
            $('#endDate' + suffix).val(formatDateISO(start)).trigger('change');
          } else {
            clearDateRangeFields(suffix);
          }
          return;
        }

        if (selectedDates.length < 2) {
          clearDateRangeFields(suffix);
          return;
        }

        const start = selectedDates[0];
        const end = selectedDates[1];
        const diffDays = Math.floor((end - start) / (1000 * 60 * 60 * 24));

        if (diffDays < 1 && ('_alq' !== suffix)) {
          ccAlert('Para el modo "Noches" debe seleccionar al menos 1 día de diferencia entre la fecha de entrada y salida', 'error');
          instance.clear();
          clearDateRangeFields(suffix);
          return;
        }

        instance.input.value = `${formatDateDisplay(start)} - ${formatDateDisplay(end)}`;
        $('#startDate' + suffix).val(formatDateISO(start)).trigger('change');
        $('#endDate' + suffix).val(formatDateISO(end)).trigger('change');
      }
    });
  }

  function initTomSelect(selector, options) {
    if (typeof TomSelect === 'undefined') return;

    function syncTomSelectDropdown(ts) {
      if (!ts || !ts.dropdown || !ts.control) return;

      const dropdownParent = ts.settings.dropdownParent;
      if (!dropdownParent || dropdownParent === 'body') return;

      const parentEl = dropdownParent.jquery ? dropdownParent[0] : dropdownParent;
      if (!parentEl || !parentEl.getBoundingClientRect) return;

      const controlRect = ts.control.getBoundingClientRect();
      const parentRect = parentEl.getBoundingClientRect();

      const top = controlRect.bottom - parentRect.top + parentEl.scrollTop;
      const left = controlRect.left - parentRect.left + parentEl.scrollLeft;

      ts.dropdown.style.position = 'absolute';
      ts.dropdown.style.top = top + 'px';
      ts.dropdown.style.left = left + 'px';
      ts.dropdown.style.width = controlRect.width + 'px';
      ts.dropdown.style.minWidth = controlRect.width + 'px';
    }

    $(selector).each(function () {
      if (this.tomselect) {
        this.tomselect.destroy();
      }

      const $modalParent = $(this).closest('.modal');
      const baseOptions = {
        create: false,
        allowEmptyOption: true,
        dropdownParent: $modalParent.length ? $modalParent[0] : 'body'
      };

      const ts = new TomSelect(this, Object.assign(baseOptions, options || {}));

      if ($modalParent.length) {
        const ns = '.tsModalPos-' + (this.id || Math.random().toString(36).slice(2));
        const $modalBody = $modalParent.find('.modal-body');

        const sync = function () {
          syncTomSelectDropdown(ts);
        };

        ts.on('dropdown_open', function () {
          setTimeout(sync, 0);
        });

        $(window).off('resize' + ns).on('resize' + ns, sync);
        $modalParent.off('scroll' + ns).on('scroll' + ns, sync);
        $modalBody.off('scroll' + ns).on('scroll' + ns, sync);

        ts.on('destroy', function () {
          $(window).off('resize' + ns);
          $modalParent.off('scroll' + ns);
          $modalBody.off('scroll' + ns);
        });
      }
    });
  }

  function rebuildTomSelectOptions(selector, optionsHtml, options) {
    $(selector).each(function () {
      if (this.tomselect) {
        this.tomselect.destroy();
      }
      $(this).html(optionsHtml);
    });

    initTomSelect(selector, options);
  }

  function setSelectValue(selector, value, silent) {
    const targetValue = (typeof value === 'undefined') ? '' : value;
    const isSilent = !!silent;

    $(selector).each(function () {
      if (this.tomselect) {
        const hasEmptyOption = typeof this.tomselect.options[''] !== 'undefined';

        if (targetValue === '' || targetValue === null) {
          // Selecciona explicitamente la opcion vacia para mostrar "Seleccionar"
          // y evitar que el dropdown conserve visualmente la ultima opcion activa.
          this.tomselect.clear(true);
          if (hasEmptyOption) {
            this.tomselect.setValue('', true);
          }
          this.tomselect.setTextboxValue('');
          this.tomselect.clearActiveOption();
          this.tomselect.refreshItems();
          if (!isSilent) {
            this.tomselect.trigger('change');
          }
        } else {
          this.tomselect.setValue(targetValue, isSilent);
        }
        return;
      }

      $(this).val(targetValue);
      if (!isSilent) {
        $(this).trigger('change');
      }
    });
  }

  function construirTelefonoConIndicativo() {
    const indicativo = ($('#telefono_indicativo').val() || '+57').trim();
    const numero = String($('#telefono').val() || '').replace(/\D+/g, '');

    if (!numero) return '';
    return `${indicativo} ${numero}`;
  }

  function restaurarFormularioTitularInicial() {
    const form = document.getElementById('form_guardar');
    if (!form) return;

    form.reset();
    limpiarErrores(form);

    $('#codigo').val('0');
    $('#tipo').val('TITULAR');
    $('#telefono').val('');

    if ($('#telefono_indicativo')[0] && $('#telefono_indicativo')[0].tomselect) {
      $('#telefono_indicativo')[0].tomselect.setValue('+57', true);
    } else {
      $('#telefono_indicativo').val('+57').trigger('change');
    }

    rebuildTomSelectOptions('#select_deptos', '<option value="">Seleccionar</option>');

    $('#nombre1').trigger('focus');
  }

  function shouldHideLogoGif() {
    var hasTipoCotizacion = $('input[type="checkbox"][name="tipo_cotizacion[]"]:checked').length > 0;
    var titularSeleccionado = ($('#id_usuario').val() || '') !== '';
    return hasTipoCotizacion || titularSeleccionado;
  }

  function updateLogoGifVisibility() {
    var hide = shouldHideLogoGif();
    $('#logoGifWrap').toggle(!hide);
  }

  $(function() {
    traer_deptos('+57');
    show_traer_tabla_cotizacion();
    initTomSelect('#id_usuario, #id_motivo, #id_motivo_tour, #id_motivo_alq, #id_planes, #id_planes_tour, #id_planes_alq, #id_tarifa, #id_tarifa_tour, #id_tarifa_alq, #select_deptos, #telefono_indicativo');
    initFlatpickrDateRange(false, '');
    initFlatpickrDateRange(false, '_tour');
    initFlatpickrDateRange(false, '_alq');
    $("#menu_inicio").removeClass("active");
    //traer_hotel()
    traer_titulares()
    traer_motivos()
    traer_planes(id_hotel, 1, '')
    traer_planes(id_hotel, 2, '_tour')
    traer_planes(id_hotel, 3, '_alq')

    // Ocultar logo si se selecciona titular o tipo cotización
    $(document).on('change', 'input[type="checkbox"][name="tipo_cotizacion[]"]', updateLogoGifVisibility);
    $('#id_usuario').on('change', updateLogoGifVisibility);
    updateLogoGifVisibility();

    // Re-render dentro del modal para evitar problemas de visualizacion
    $('#crear_titular_modal').on('shown.bs.modal', function () {
      initTomSelect('#select_deptos, #telefono_indicativo');
    });

    $('#crear_titular_modal').on('hidden.bs.modal', function () {
      restaurarFormularioTitularInicial();
    });

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
        id_pais : 0,
        id_depto : $("#select_deptos").val() ? $("#select_deptos").val() : 0,
        ciudad :  $("#ciudad").val(),
        direccion : $("#direccion").val(),
        telefono : construirTelefonoConIndicativo(),
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
          restaurarFormularioTitularInicial()
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

  function traer_deptos(id) {
    
    if ( id.length < 1) {
      rebuildTomSelectOptions('#select_deptos', '<option value="">Seleccionar</option>');
      return false
    }
    let values = {
          codigo: 'traer_deptos',
          parametro1: id =='+57' ? 82 : 0,
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

        rebuildTomSelectOptions('#select_deptos', '<option value="">Seleccionar</option>'+fila);
        
      },
      error: function() {
        $(".loader").css("display", "none")
        ccAlert("No se ha podido obtener la información", 'error');
      }
    });
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

    updateLogoGifVisibility();
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

          rebuildTomSelectOptions('#id_usuario', '<option value="">Seleccionar</option>'+fila);
          
        },
        error: function() {
          $(".loader").css("display", "none")
          console.log("No se ha podido obtener la información");
        }
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

          rebuildTomSelectOptions('#id_motivo, #id_motivo_tour, #id_motivo_alq', '<option value="">Seleccionar</option>'+fila);
          
        },
        error: function() {
          $(".loader").css("display", "none")
          console.log("No se ha podido obtener la información");
        }
      });
  }

    function traer_planes(id_hotel, id_tipo_plan, suffix) {
    suffix = suffix || '';
    let selectId = "#id_planes" + suffix;
      let values = { 
            codigo: 'traer_planes',
            parametro1: id_hotel,
      parametro2: id_tipo_plan ? id_tipo_plan : ""
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
          if (obj["resultado"]) {
            $.each(obj["resultado"], function( index, val ) {
              fila += `<option value='${val.id}' data-id_terminos='${val.id_terminos}' descripcion='${val.descripcion}'>${val.nombre}</option>`
            });
          }

          rebuildTomSelectOptions(selectId, '<option value="">Seleccionar</option>'+fila);
          
        },
        error: function() {
          $(".loader").css("display", "none")
          console.log("No se ha podido obtener la información");
        }
      });
    
  }

  function traer_productos(id_plan, suffix) {
    suffix = suffix || ''; // Por defecto vacío para alojamiento
    validar_plan(suffix)

    // Auto-asignar tipo de servicio al seleccionar plan (solo Tours y Alquiler)
    if (id_plan && suffix === '_tour') {
      $("input[type='radio'][name='tipo_viaje_tour'][value='0']").prop('checked', true);
      traer_tarifas(0, '_tour');
    }
    if (id_plan && suffix === '_alq') {
      $("input[type='radio'][name='tipo_viaje_alq'][value='2']").prop('checked', true);
      traer_tarifas(2, '_alq');
    }
   
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
          console.log('Respuesta del servidor:', respuesta)
          $("#brn_modal_print").click()
          let obj = JSON.parse(respuesta)
          
          console.log('Total cotizaciones recibidas:', obj["resultado"].length)
          
          // Procesar TODAS las cotizaciones para el PDF
          let cotizaciones_para_pdf = [];
          let info_titular_comun = null;
          let fecha_expedicion_comun = null;
          let id_primera = (obj["id_principal"] && obj["id_principal"] !== '0') ? obj["id_principal"] : id;

          const calcularDuracionServicio = (tipoCotizacion, fechaEntrada, fechaSalida, nocheRaw) => {
            const tipoEsAlquiler = String(tipoCotizacion) === '3';
            const nocheInt = parseInt(nocheRaw, 10);

            const parseFechaUtc = (valor) => {
              const limpio = String(valor || '').trim().split(' ')[0];
              if (!limpio) return null;

              let y, m, d;
              if (/^\d{4}-\d{2}-\d{2}$/.test(limpio)) {
                [y, m, d] = limpio.split('-').map(Number);
              } else if (/^\d{2}-\d{2}-\d{4}$/.test(limpio)) {
                [d, m, y] = limpio.split('-').map(Number);
              } else {
                const fecha = new Date(limpio);
                if (isNaN(fecha.getTime())) return null;
                return Date.UTC(fecha.getFullYear(), fecha.getMonth(), fecha.getDate());
              }

              return Date.UTC(y, m - 1, d);
            };

            const entradaUtc = parseFechaUtc(fechaEntrada);
            const salidaUtc = parseFechaUtc(fechaSalida);
            const diasRango = (entradaUtc !== null && salidaUtc !== null)
              ? Math.round((salidaUtc - entradaUtc) / 86400000)
              : 0;

            if (tipoEsAlquiler) {
              const dias = diasRango > 0 ? diasRango : ((!isNaN(nocheInt) && nocheInt > 0) ? nocheInt : 1);
              return {
                cantidad: dias,
                label: `${dias} ${dias === 1 ? 'día' : 'días'}`
              };
            }

            const noches = (!isNaN(nocheInt) && nocheInt > 0) ? nocheInt : 1;
            const fallback = (nocheRaw == "N/A" || isNaN(nocheInt) || nocheInt <= 0);
            return {
              cantidad: noches,
              label: fallback ? '1 día' : `${noches} ${noches === 1 ? 'noche' : 'noches'}`
            };
          };
          
          $.each(obj["resultado"], function(index, cotizacion) {
            console.log('Procesando cotización ' + (index + 1) + ':', cotizacion);
            if (index === 0) {
              fecha_expedicion_comun = cotizacion.fecha_expedicion;
            }
            
            // Info del titular (común para todas)
            if (!info_titular_comun && obj["info_titular"]) {
              $.each(obj["info_titular"], function(idx, val) {
                info_titular_comun = {
                  cedula: val.cedula,
                  email: val.email,
                  telefono: val.telefono,
                  nombre_titular: val.nombre1 + " " + val.nombre2 + " " + val.apellido1 + " " + val.apellido2,
                  ciudad: val.ciudad,
                  depto: val.depto,
                  pais: val.pais,
                  direccion: val.direccion
                };
              });
            }
            
            // Info de la tarifa para esta cotización
            let tarifa_info = {
              tarifa_adult_d: 0,
              tarifa_adult_s: 0,
              tarifa_adult_t_c: 0,
              tarifa_child: 0,
              tarifa_nombre: ""
            };
            
            if (cotizacion.info_tarifa) {
              tarifa_info.tarifa_adult_d = parseInt(cotizacion.info_tarifa.adult_d || 0);
              tarifa_info.tarifa_adult_s = parseInt(cotizacion.info_tarifa.adult_s || 0);
              tarifa_info.tarifa_adult_t_c = parseInt(cotizacion.info_tarifa.adult_t_c || 0);
              tarifa_info.tarifa_child = parseInt(cotizacion.info_tarifa.child || 0);
              tarifa_info.tarifa_nombre = cotizacion.info_tarifa.nombre || "";
            }
            
            // Info de los planes para esta cotización
            let consumo = "";
            let servicios = "";
            if (cotizacion.info_planes) {
              $.each(cotizacion.info_planes, function(idx, val) {
                if (val.tipo == "CONSUMO") {
                  consumo += "• " + val.nombre + "\n";
                } else if (val.tipo == "SERVICIOS") {
                  servicios += "• " + val.nombre + "\n";
                }
              });
            }
            
            // Calcular totales
            let n_child = parseInt(cotizacion.n_child || 0);
            let n_adult_s = parseInt(cotizacion.n_adult_s || 0);
            let n_adult_d = parseInt(cotizacion.n_adult_d || 0);
            let n_adult_t_c = parseInt(cotizacion.n_adult_t_c || 0);
            
            let totalchild = n_child * tarifa_info.tarifa_child;
            let totaladult_s = n_adult_s * tarifa_info.tarifa_adult_s;
            let totaladult_d = n_adult_d * tarifa_info.tarifa_adult_d;
            let totaladult_t_c = n_adult_t_c * tarifa_info.tarifa_adult_t_c;
            
            let subtotal = totalchild + totaladult_s + totaladult_d + totaladult_t_c;
            const duracionServicio = calcularDuracionServicio(
              cotizacion.tipo_cotizacion,
              cotizacion.fecha_entrada,
              cotizacion.fecha_salida,
              cotizacion.noche
            );
            let n_noches = duracionServicio.cantidad;
            let noche_tour = duracionServicio.label;
            let total = subtotal * n_noches;
            
            // Construir objeto de cotización para PDF
            cotizaciones_para_pdf.push({
              tipo_cotizacion: cotizacion.tipo_cotizacion,
              tipo_servicio: cotizacion.tipo_servicio,
              nombre_plan: cotizacion.nombre_plan,
              descripcion_plan: cotizacion.descripcion_plan || '',
              nombre_motivo: cotizacion.nombre_motivo,
              fecha_entrada: cotizacion.fecha_entrada,
              fecha_salida: cotizacion.fecha_salida,
              acomodo: cotizacion.acomodo ? cotizacion.acomodo.replace(/<br\s*\/?>/gi, '\n') : '',
              consumo: consumo,
              servicios: servicios,
              terminos: normalizarTextoHtmlParaPdf(cotizacion.terminos),
              n_child: n_child,
              n_adult_s: n_adult_s,
              n_adult_d: n_adult_d,
              n_adult_t_c: n_adult_t_c,
              tarifa_child: tarifa_info.tarifa_child,
              tarifa_adult_s: tarifa_info.tarifa_adult_s,
              tarifa_adult_d: tarifa_info.tarifa_adult_d,
              tarifa_adult_t_c: tarifa_info.tarifa_adult_t_c,
              totalchild: totalchild,
              totaladult_s: totaladult_s,
              totaladult_d: totaladult_d,
              totaladult_t_c: totaladult_t_c,
              subtotal: subtotal,
              noche_tour: noche_tour,
              total: total
            });
          });
          
          console.log('Total cotizaciones para PDF:', cotizaciones_para_pdf.length, cotizaciones_para_pdf)
          
          // Guardar datos para generar PDF con pdfmake (múltiples cotizaciones)
          window.cotizacionDataParaPDF = {
            id: id_primera,
            nombre_hotel: nombre_hotel,
            direccion_hotel: direccion_hotel,
            pais_hotel: pais_hotel,
            depto_hotel: depto_hotel,
            telefono_hotel: telefono_hotel,
            fecha_expedicion: fecha_expedicion_comun,
            nombre_titular: info_titular_comun ? info_titular_comun.nombre_titular : '',
            cedula: info_titular_comun ? info_titular_comun.cedula : '',
            email: info_titular_comun ? info_titular_comun.email : '',
            telefono: info_titular_comun ? info_titular_comun.telefono : '',
            pais: info_titular_comun ? info_titular_comun.pais : '',
            depto: info_titular_comun ? info_titular_comun.depto : '',
            ciudad: info_titular_comun ? info_titular_comun.ciudad : '',
            cotizaciones: cotizaciones_para_pdf  // Array de cotizaciones
          };

          // Variables del titular para visualización en modal
          let nombre_titular = info_titular_comun ? info_titular_comun.nombre_titular : '';
          let email_titular = info_titular_comun ? info_titular_comun.email : '';
          let telefono = info_titular_comun ? info_titular_comun.telefono : '';
          let ciudad = info_titular_comun ? info_titular_comun.ciudad : '';
          let depto = info_titular_comun ? info_titular_comun.depto : '';
          let pais = info_titular_comun ? info_titular_comun.pais : '';

          const tipoLabelResumen = (t) => (t == '1' ? 'Alojamiento' : (t == '2' ? 'Tour' : 'Alquiler'));
          const buildDetallesTarifaTbody = (tipo_servicio, n_child, n_adult_s, n_adult_d, n_adult_t_c, tarifa_child, tarifa_adult_s, tarifa_adult_d, tarifa_adult_t_c) => {
            const totalchild = n_child * tarifa_child;
            const totaladult_s = n_adult_s * tarifa_adult_s;
            const totaladult_d = n_adult_d * tarifa_adult_d;
            const totaladult_t_c = n_adult_t_c * tarifa_adult_t_c;

            const rows = [];
            const pushRow = (label, qty, unit, total) => {
              const q = parseInt(qty || 0) || 0;
              const t = parseInt(total || 0) || 0;
              if (q <= 0 || t <= 0) return;
              rows.push({ label, qty: q, unit: parseInt(unit || 0) || 0, total: t });
            };

            if (tipo_servicio == '0') {
              pushRow('Niños (3-11 Años)', n_child, tarifa_child, totalchild);
              pushRow('Adultos', n_adult_s, tarifa_adult_s, totaladult_s);
            } else if (tipo_servicio == '1') {
              pushRow('Niños', n_child, tarifa_child, totalchild);
              pushRow('Adultos normal', n_adult_s, tarifa_adult_s, totaladult_s);
              pushRow('Adultos dobles', n_adult_d, tarifa_adult_d, totaladult_d);
              pushRow('Adultos triple / Cuadruple', n_adult_t_c, tarifa_adult_t_c, totaladult_t_c);
            } else if (tipo_servicio == '2') {
              pushRow('N° Alquiler', n_adult_s, tarifa_adult_s, totaladult_s);
            }

            if (rows.length === 0) return `<tbody></tbody>`;

            let html = '<tbody>';
            rows.forEach((r, idx) => {
              html += `
                <tr>
                  <td class="table-number">${idx + 1}</td>
                  <td>${r.label}</td>
                  <td style="text-align: center;">${r.qty}</td>
                  <td class="table-right">$${puntosDecimales(r.unit)}</td>
                  <td class="table-right">$${puntosDecimales(r.total)}</td>
                </tr>`;
            });
            html += '</tbody>';
            return html;
          };

          // Render del modal: mostrar todas las cotizaciones (no solo la primera)
          let cotizacionesDetalleHTML = '';
          (obj["resultado"] || []).forEach((cot, idx) => {
            const tipoCot = cot.tipo_cotizacion;
            const tipo_servicio = cot.tipo_servicio;

            const fecha_entrada = cot.fecha_entrada || '';
            const fecha_salida = cot.fecha_salida || '';
            const nombre_plan = cot.nombre_plan || '';
            const descripcion_plan = cot.descripcion_plan || '';
            const acomodo = cot.acomodo || '';
            const nombre_motivo = cot.nombre_motivo || '';

            const n_child = parseInt(cot.n_child || 0);
            const n_adult_s = parseInt(cot.n_adult_s || 0);
            const n_adult_d = parseInt(cot.n_adult_d || 0);
            const n_adult_t_c = parseInt(cot.n_adult_t_c || 0);

            let tarifa_adult_d = 0, tarifa_adult_s = 0, tarifa_adult_t_c = 0, tarifa_child = 0;
            if (cot.info_tarifa) {
              tarifa_adult_d = parseInt(cot.info_tarifa.adult_d || 0);
              tarifa_adult_s = parseInt(cot.info_tarifa.adult_s || 0);
              tarifa_adult_t_c = parseInt(cot.info_tarifa.adult_t_c || 0);
              tarifa_child = parseInt(cot.info_tarifa.child || 0);
            }

            const totalchild = n_child * tarifa_child;
            const totaladult_s = n_adult_s * tarifa_adult_s;
            const totaladult_d = n_adult_d * tarifa_adult_d;
            const totaladult_t_c = n_adult_t_c * tarifa_adult_t_c;
            const total_pasajero = n_child + n_adult_s + n_adult_d + n_adult_t_c;
            const subtotal = totalchild + totaladult_s + totaladult_d + totaladult_t_c;

            const nocheRaw = cot.noche;
            const duracionServicio = calcularDuracionServicio(tipoCot, fecha_entrada, fecha_salida, nocheRaw);
            const n_noches = duracionServicio.cantidad;
            const nochesLabel = duracionServicio.label;
            const total = subtotal * n_noches;

            const tbodyDetalles = buildDetallesTarifaTbody(tipo_servicio, n_child, n_adult_s, n_adult_d, n_adult_t_c, tarifa_child, tarifa_adult_s, tarifa_adult_d, tarifa_adult_t_c);

            cotizacionesDetalleHTML += `
              <div class="cotizacion-section">
                <div class="section-header">
                  <div class="section-icon"><i class="fas fa-clipboard-list"></i></div>
                  <h2 class="section-title">Cotización #${id_primera} - ${tipoLabelResumen(tipoCot)}${nombre_motivo ? ` (${nombre_motivo})` : ''}</h2>
                </div>
                <div class="info-grid">
                  <div class="info-item">
                    <span class="info-label">Plan</span>
                    <span class="info-value">${nombre_plan}</span>
                  </div>
                  <div class="info-item">
                    <span class="info-label">Personas</span>
                    <span class="info-value">${total_pasajero} personas</span>
                  </div>
                </div>
              </div>

              <div class="cotizacion-section">
                <div class="section-header">
                  <div class="section-icon"><i class="fas fa-calendar-alt"></i></div>
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
                    <span class="info-label">Duración</span>
                    <span class="info-value">${nochesLabel}</span>
                  </div>
                  <div class="info-item">
                    <span class="info-label">Total</span>
                    <span class="info-value">$${puntosDecimales(total)} COP</span>
                  </div>
                </div>
              </div>

              <div class="cotizacion-section">
                <div class="section-header">
                  <div class="section-icon"><i class="fas fa-bed"></i></div>
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
                  <div class="section-icon"><i class="fas fa-list-ul"></i></div>
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
                    ${tbodyDetalles}
                  </table>
                </div>
                <div class="totals-section">
                  <div class="total-row">
                    <span>Subtotal:</span>
                    <span>$${puntosDecimales(subtotal)}</span>
                  </div>
                  <div class="total-row">
                    <span>Noches/Días:</span>
                    <span>${nochesLabel}</span>
                  </div>
                  <div class="total-row grand-total">
                    <span>TOTAL:</span>
                    <span>$${puntosDecimales(total)} COP</span>
                  </div>
                </div>
              </div>

              ${cot.terminos ? `<div class="cotizacion-section">
                <div style="font-size: 11px; color: #64748b; line-height: 1.6;">
                  ${cot.terminos}
                </div>
              </div>` : ''}
            `;
          });

          $("#btn_pdf").html(`
            <button type="button" class="cc-pdf-fab-btn" onclick="imprimir_cotizacion('${id_primera}', false)" title="Descargar PDF" aria-label="Descargar PDF">
              <i class="fas fa-file-download"></i>
            </button>
          `)

          // Resumen final (modal) - todas las cotizaciones + total general
          const totalGeneralModal = cotizaciones_para_pdf.reduce((acc, c) => acc + (parseInt(c.total || 0) || 0), 0);
          let rowsResumenModal = '';
          cotizaciones_para_pdf.forEach((c, idx) => {
            rowsResumenModal += `
              <tr>
                <td class="table-number">${idx + 1}</td>
                <td>${tipoLabelResumen(c.tipo_cotizacion)}</td>
                <td>${c.nombre_plan || ''}</td>
                <td>${c.fecha_entrada || ''}</td>
                <td>${c.fecha_salida || ''}</td>
                <td class="table-right">$${puntosDecimales(parseInt(c.total || 0) || 0)}</td>
              </tr>`;
          });
          const resumenCotizacionesModalHTML = `
            <div class="cotizacion-section">
              <div class="section-header">
                <div class="section-icon"><i class="fas fa-receipt"></i></div>
                <h2 class="section-title">Resumen de cotizaciones</h2>
              </div>
              <div class="table-wrapper">
                <table class="cotizacion-table">
                  <thead>
                    <tr>
                      <th style="width: 40px;">#</th>
                      <th style="width: 90px;">Tipo</th>
                      <th>Plan</th>
                      <th style="width: 90px;">Check-in</th>
                      <th style="width: 90px;">Check-out</th>
                      <th style="width: 140px; text-align: right;">Total</th>
                    </tr>
                  </thead>
                  <tbody>
                    ${rowsResumenModal}
                    <tr>
                      <td colspan="5" class="table-right" style="font-weight: 700; color:#1e293b;">TOTAL GENERAL</td>
                      <td class="table-right" style="font-weight: 700; color:#1e293b;">$${puntosDecimales(totalGeneralModal)} COP</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>`;
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
                  </div>
                  <div class="cotizacion-number">
                    <div class="cotizacion-id">#${id_primera || id}</div>
                    <div class="cotizacion-date">Fecha de emisión: ${fecha_expedicion_comun || ''}</div>
                  </div>
                </div>

                <div class="cotizacion-section">
                  <div class="section-header">
                    <div class="section-icon">
                      <i class="fas fa-user"></i>
                    </div>
                    <h2 class="section-title">Información del Cliente</h2>
                  </div>
                  <div class="info-grid">
                    <div class="info-item">
                      <span class="info-label">Nombre</span>
                      <span class="info-value">${nombre_titular}</span>
                    </div>
                    <div class="info-item">
                      <span class="info-label">Email</span>
                      <span class="info-value">${email_titular}</span>
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

                ${cotizacionesDetalleHTML}

                ${resumenCotizacionesModalHTML}

                <div class="cotizacion-footer">
                  <div class="footer-company">${nombre_hotel.toUpperCase()}</div>
                  <div class="footer-contact">
                    ${direccion_hotel} - ${pais_hotel}, ${depto_hotel} - Tel: ${telefono_hotel}
                  </div>
                </div>
              </div>`
              //<div class="footer-thank-you">Gracias por elegir ${nombre_hotel}: Estamos listos para recibirte.</div>
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
            let tipoServicio = tipo == 0 ? 'Pasadía' : (tipo == 1 ? 'Noches' : 'Alquiler');
            if (suffix === '_tour' && tipo == 0) {
              tipoServicio = 'Tour';
            }
            ccAlert(`El plan "${nombrePlan}" no tiene tarifas configuradas para el tipo de servicio "${tipoServicio}". Por favor, seleccione otro tipo de servicio o contacte al administrador.`, 'error');
            return false
            
          }

          if (tipo == 0) {
            cambiarModoDateRange(true, suffix)
          } else if (tipo == 1) {
            cambiarModoDateRange(false, suffix)
          } else if (tipo == 2) {
            cambiarModoDateRange(false, suffix)
          }
          mostrarOpciones(tipo, suffix)
          $.each(obj["resultado"], function( index, val ) {
            console.log(val.noches)
            fila += `<option value='${val.id}' id='${val.id}' nombre='${val.nombre}' child='${val.child}' adult_s='${val.adult_s}' adult_d='${val.adult_d}' noches='${val.noches}' adult_t_c='${val.adult_t_c}' noches='${val.noches}'>${val.nombre}</option>`
          });

          // Solo actualizar el select del formulario correspondiente
          rebuildTomSelectOptions('#id_tarifa' + suffix, '<option value="">Seleccionar</option>'+fila);
          
        },
        error: function() {
          $(".loader").css("display", "none")
          console.log("No se ha podido obtener la información");
        }
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

  function normalizarTextoHtmlParaPdf(html) {
    if (!html) return '';

    const normalized = String(html)
      .replace(/<\s*br\s*\/?>/gi, "\n")
      .replace(/<\s*\/\s*(p|div|h[1-6])\s*>/gi, "\n")
      .replace(/<\s*li\s*>/gi, "• ")
      .replace(/<\s*\/\s*li\s*>/gi, "\n");

    const temp = document.createElement('div');
    temp.innerHTML = normalized;
    return (temp.textContent || temp.innerText || '')
      .replace(/\u00A0/g, ' ')
      .replace(/\n{3,}/g, "\n\n")
      .trim();
  }

  // Función auxiliar para convertir imagen a base64
  function convertImageToBase64(url, callback) {
    if (!url || url === '') {
      callback(null);
      return;
    }
    
    const img = new Image();
    img.crossOrigin = 'Anonymous';
    img.onload = function() {
      const canvas = document.createElement('canvas');
      canvas.width = img.width;
      canvas.height = img.height;
      const ctx = canvas.getContext('2d');
      ctx.drawImage(img, 0, 0);
      const dataURL = canvas.toDataURL('image/png');
      callback(dataURL);
    };
    img.onerror = function() {
      console.error('Error al cargar la imagen del logo');
      callback(null);
    };
    img.src = url;
  }

  function imprimir_cotizacion(id, esBorrador = false) {
    $(".loader").css("display", "inline-block")
    
    // Obtener los datos del modal
    const data = window.cotizacionDataParaPDF;
    
    if (!data) {
      ccAlert("No hay datos de cotización para generar el PDF", 'error');
      $(".loader").css("display", "none");
      return;
    }
    
    // Convertir logo a base64 y luego generar PDF
    convertImageToBase64(avatar_hotel, function(logoBase64) {
      data.logoBase64 = logoBase64;
      generarPDFConPdfMake(data, id, esBorrador);
      $(".loader").css("display", "none")
    });
  }

  function generarPDFConPdfMake(data, id, esBorrador = false) {
    console.log('Datos para PDF:', data); // Debug

    // Tipografía PDF
    const PDF_BASE_FONT_SIZE = 9;
    const PDF_TITLE_FONT_SIZE = 10;
    const watermark = esBorrador ? {
      text: 'BORRADOR',
      color: 'red',
      opacity: 0.15,
      bold: true,
      italics: false,
      fontSize: 80,
      angle: 45
    } : null;

    const COLOR_BLUE = '#1e40af';
    const COLOR_TEXT = '#334155';
    const COLOR_MUTED = '#64748b';
    const COLOR_BORDER = '#e2e8f0';
    const COLOR_SECTION_BG = '#f1f5f9';
    const COLOR_TABLE_HDR = '#eef2f7';

    const safe = (v) => (v === null || v === undefined ? '' : String(v));
    const textToLines = (txt) => safe(txt).split(/\n+/).map(s => s.trim()).filter(Boolean);
    const stripLeadingBullet = (s) => s.replace(/^\s*[•\-]\s+/, '').trim();

    const makeSectionHeader = (title, margin = [0, 12, 0, 8]) => ({
      table: {
        widths: ['*'],
        body: [[{text: title, style: 'sectionHeaderText'}]]
      },
      layout: {
        hLineWidth: () => 0,
        vLineWidth: () => 0,
        paddingLeft: () => 10,
        paddingRight: () => 10,
        paddingTop: () => 7,
        paddingBottom: () => 7,
        fillColor: () => COLOR_SECTION_BG
      },
      margin
    });

    const kvLine = (label, value) => ({
      text: [
        {text: label + ' ', style: 'kvLabel'},
        {text: safe(value), style: 'kvValue'}
      ],
      margin: [0, 0, 0, 6]
    });

    const makeSeparator = (margin = [0, 10, 0, 14]) => ({
      canvas: [{type: 'line', x1: 0, y1: 0, x2: 495, y2: 0, lineWidth: 1, lineColor: COLOR_BORDER}],
      margin
    });

    // Verificar si hay múltiples cotizaciones
    const cotizaciones = data.cotizaciones || [];
    let contentArray = [];
    
    // Construir contenido para cada cotización
    if (cotizaciones.length > 0) {
      // Múltiples cotizaciones
      cotizaciones.forEach((cot, index) => {
        const isFirst = index === 0;
        const isLast = index === cotizaciones.length - 1;

        if (!isFirst) {
          contentArray.push(makeSeparator([0, 6, 0, 10]));
        }
        
        // Sección: Descripción / Información
        contentArray.push(makeSectionHeader(
          cot.tipo_cotizacion == '1' ? 'Descripción de alojamiento' : (cot.tipo_cotizacion == '2' ? 'Información del Tour' : 'Información del Alquiler'),
          [0, 0, 0, 10]
        ));

        contentArray.push({
          columns: [
            {
              width: '*',
              stack: [
                kvLine('Plan:', cot.nombre_plan),
                kvLine('Motivo de viaje:', cot.nombre_motivo)
              ]
            },
            {
              width: '*',
              stack: [
                kvLine('Check-in:', cot.fecha_entrada),
                kvLine('Check-out:', cot.fecha_salida)
              ]
            }
          ],
          columnGap: 30,
          margin: [0, 0, 0, 8]
        });

        // Sección: Acomodación / Descripción
        contentArray.push(makeSectionHeader(
          cot.tipo_cotizacion == '1' ? 'Acomodación' : (cot.tipo_cotizacion == '2' ? 'Descripción del Tour' : 'Descripción del Alquiler'),
          [0, 8, 0, 10]
        ));

        const acomodoLines = textToLines(cot.acomodo);
        const comentarios = [];
        textToLines(cot.consumo).forEach(l => comentarios.push(stripLeadingBullet(l)));
        textToLines(cot.servicios).forEach(l => comentarios.push(stripLeadingBullet(l)));

        const acomodoStack = [];
        if (cot.descripcion_plan) {
          acomodoStack.push({text: safe(cot.descripcion_plan), style: 'bodyText', margin: [0, 0, 0, 8]});
        }
        if (acomodoLines.length > 0) {
          acomodoStack.push({ul: acomodoLines.map(stripLeadingBullet), style: 'bulletList', margin: [0, 0, 0, 8]});
        }
        if (comentarios.length > 0) {
          acomodoStack.push({text: 'Servicios incluidos:', style: 'subSectionLabel', margin: [0, 4, 0, 6]});
          acomodoStack.push({ul: comentarios, style: 'bulletList', margin: [0, 0, 0, 0]});
        }

        if (acomodoStack.length > 0) {
          contentArray.push({stack: acomodoStack, margin: [0, 0, 0, 10]});
        }
        
        // Tabla de tarifas
        contentArray.push(makeSectionHeader('Detalles de la tarifa', [0, 12, 0, 10]));
        
        let tableBody = [
          [
            {text: '#', style: 'tableHeader', alignment: 'center', fillColor: COLOR_TABLE_HDR},
            {text: 'Item', style: 'tableHeader', fillColor: COLOR_TABLE_HDR},
            {text: 'Cantidad', style: 'tableHeader', alignment: 'center', fillColor: COLOR_TABLE_HDR},
            {text: 'Valor unitario', style: 'tableHeader', alignment: 'right', fillColor: COLOR_TABLE_HDR},
            {text: 'Total', style: 'tableHeader', alignment: 'right', fillColor: COLOR_TABLE_HDR}
          ]
        ];

        const detailRows = [];
        const addDetailRow = (label, qty, unit, total) => {
          const q = parseInt(qty || 0) || 0;
          const t = parseInt(total || 0) || 0;
          if (q <= 0 || t <= 0) return;
          detailRows.push({ label, qty: q, unit: parseInt(unit || 0) || 0, total: t });
        };

        if (cot.tipo_servicio == '0') {
          addDetailRow('Niños (3-11 Años)', cot.n_child, cot.tarifa_child, cot.totalchild);
          addDetailRow('Adultos', cot.n_adult_s, cot.tarifa_adult_s, cot.totaladult_s);
        } else if (cot.tipo_servicio == '1') {
          addDetailRow('Niños', cot.n_child, cot.tarifa_child, cot.totalchild);
          addDetailRow('Adultos normal', cot.n_adult_s, cot.tarifa_adult_s, cot.totaladult_s);
          addDetailRow('Adultos dobles', cot.n_adult_d, cot.tarifa_adult_d, cot.totaladult_d);
          addDetailRow('Adultos triple/Cuádruple', cot.n_adult_t_c, cot.tarifa_adult_t_c, cot.totaladult_t_c);
        } else if (cot.tipo_servicio == '2') {
          addDetailRow('N° Alquiler', cot.n_adult_s, cot.tarifa_adult_s, cot.totaladult_s);
        }

        detailRows.forEach((r, idx2) => {
          tableBody.push([
            String(idx2 + 1),
            r.label,
            {text: String(r.qty), alignment: 'center'},
            {text: '$' + puntosDecimales(r.unit), alignment: 'right'},
            {text: '$' + puntosDecimales(r.total), alignment: 'right'}
          ]);
        });
        
        contentArray.push({
          table: {
            headerRows: 1,
            widths: [35, '*', 60, 90, 90],
            body: tableBody
          },
          layout: {
            hLineWidth: function (i, node) {
              return (i === 0 || i === 1 || i === node.table.body.length) ? 1 : 0.5;
            },
            vLineWidth: function () { return 0; },
            hLineColor: function () { return COLOR_BORDER; },
            paddingLeft: function () { return 8; },
            paddingRight: function () { return 8; },
            paddingTop: function () { return 8; },
            paddingBottom: function () { return 8; }
          },
          margin: [0, 0, 0, 14]
        });
        
        // Totales
        contentArray.push({
          columns: [
            {width: '*', text: ''},
            {
              width: 220,
              stack: [
                {
                  columns: [
                    {text: 'Subtotal:', style: 'totalLabel'},
                    {text: '$' + puntosDecimales(cot.subtotal), style: 'totalValue', alignment: 'right'}
                  ],
                  margin: [0, 0, 0, 8]
                },
                {
                  columns: [
                    {text: 'Noches/Días:', style: 'totalLabel'},
                    {text: cot.noche_tour, style: 'totalValue', alignment: 'right'}
                  ],
                  margin: [0, 0, 0, 8]
                },
                {canvas: [{type: 'line', x1: 0, y1: 0, x2: 220, y2: 0, lineWidth: 1, lineColor: COLOR_BORDER}], margin: [0, 8, 0, 8]},
                {
                  columns: [
                    {text: 'Total:', style: 'grandTotalLabel'},
                    {text: '$' + puntosDecimales(cot.total), style: 'grandTotalValue', alignment: 'right'}
                  ]
                }
              ],
              margin: [0, 0, 0, 0]
            }
          ],
          margin: [0, 0, 0, 12]
        });
        
        // Términos y condiciones (por servicio)
        const terminosTxt = normalizarTextoHtmlParaPdf(cot.terminos);
        if (terminosTxt) {
          contentArray.push(makeSectionHeader('Términos y condiciones', [0, 12, 0, 8]));
          contentArray.push({text: terminosTxt, style: 'termsText', margin: [0, 0, 0, 14]});
        }
      });
    } else {
      // Formato antiguo (una sola cotización) - mantener compatibilidad
      const tableBody = [
        [
          {text: '#', style: 'tableHeader', alignment: 'center', fillColor: '#f8fafc'},
          {text: 'Item', style: 'tableHeader', fillColor: '#f8fafc'},
          {text: 'Cantidad', style: 'tableHeader', alignment: 'center', fillColor: '#f8fafc'},
          {text: 'Valor unitario', style: 'tableHeader', alignment: 'right', fillColor: '#f8fafc'},
          {text: 'Total', style: 'tableHeader', alignment: 'right', fillColor: '#f8fafc'}
        ]
      ];

      const legacyDetailRows = [];
      const addLegacyRow = (label, qty, unit, total) => {
        const q = parseInt(qty || 0) || 0;
        const t = parseInt(total || 0) || 0;
        if (q <= 0 || t <= 0) return;
        legacyDetailRows.push({ label, qty: q, unit: parseInt(unit || 0) || 0, total: t });
      };

      if (data.tipo_servicio == '0') {
        addLegacyRow('Niños (3-11 Años)', data.n_child, data.tarifa_child, data.totalchild);
        addLegacyRow('Adultos', data.n_adult_s, data.tarifa_adult_s, data.totaladult_s);
      } else if (data.tipo_servicio == '1') {
        addLegacyRow('Niños', data.n_child, data.tarifa_child, data.totalchild);
        addLegacyRow('Adultos normal', data.n_adult_s, data.tarifa_adult_s, data.totaladult_s);
        addLegacyRow('Adultos dobles', data.n_adult_d, data.tarifa_adult_d, data.totaladult_d);
        addLegacyRow('Adultos triple/Cuádruple', data.n_adult_t_c, data.tarifa_adult_t_c, data.totaladult_t_c);
      } else if (data.tipo_servicio == '2') {
        addLegacyRow('N° Alquiler', data.n_adult_s, data.tarifa_adult_s, data.totaladult_s);
      }

      legacyDetailRows.forEach((r, idx3) => {
        tableBody.push([
          String(idx3 + 1),
          r.label,
          {text: String(r.qty), alignment: 'center'},
          {text: '$' + puntosDecimales(r.unit), alignment: 'right'},
          {text: '$' + puntosDecimales(r.total), alignment: 'right'}
        ]);
      });
      
      // Contenido formato antiguo
      contentArray = [
        // Línea separadora
        makeSeparator([0, 0, 0, 16]),
        
        // Información del cliente
        makeSectionHeader('Información del Cliente', [0, 0, 0, 10]),
        {
          columns: [
            [
              kvLine('Nombre:', data.nombre_titular),
              kvLine('Procedencia:', (safe(data.pais || '') ? (safe(data.pais) + (safe(data.depto || '') ? ', ' + safe(data.depto) : '') + (safe(data.ciudad || '') ? ', ' + safe(data.ciudad) : '')) : ''))
            ],
            [
              kvLine('Email:', data.email),
              kvLine('Teléfono:', data.telefono)
            ]
          ],
          columnGap: 30,
          margin: [0, 0, 0, 8]
        },
        
        // Información de la reserva
        makeSectionHeader(data.tipo_cotizacion == '1' ? 'Descripción de alojamiento' : (data.tipo_cotizacion == '2' ? 'Información del Tour' : 'Información del Alquiler'), [0, 12, 0, 10]),
        {
          columns: [
            [
              kvLine('Plan:', data.nombre_plan),
              kvLine('Motivo de viaje:', data.nombre_motivo)
            ],
            [
              kvLine('Check-in:', data.fecha_entrada),
              kvLine('Check-out:', data.fecha_salida)
            ]
          ],
          columnGap: 30,
          margin: [0, 0, 0, 8]
        },
        
        // Acomodación
        makeSectionHeader(data.tipo_cotizacion == '1' ? 'Acomodación' : (data.tipo_cotizacion == '2' ? 'Descripción del Tour' : 'Descripción del Alquiler'), [0, 12, 0, 10]),
        {
          stack: [
            data.descripcion_plan ? {text: data.descripcion_plan, style: 'bodyText', margin: [0, 0, 0, 8]} : {},
            textToLines(data.acomodo).length ? {ul: textToLines(data.acomodo).map(stripLeadingBullet), style: 'bulletList', margin: [0, 0, 0, 8]} : {},
            (textToLines(data.consumo).length || textToLines(data.servicios).length) ? {text: 'Servicios incluidos:', style: 'subSectionLabel', margin: [0, 4, 0, 6]} : {},
            (textToLines(data.consumo).length || textToLines(data.servicios).length) ? {
              ul: [...textToLines(data.consumo), ...textToLines(data.servicios)].map(l => stripLeadingBullet(l)),
              style: 'bulletList',
              margin: [0, 0, 0, 0]
            } : {}
          ],
          margin: [0, 0, 0, 10]
        },
        
        // Detalles de la tarifa
        makeSectionHeader('Detalles de la tarifa', [0, 12, 0, 10]),
        {
          table: {
            headerRows: 1,
            widths: [35, '*', 60, 90, 90],
            body: tableBody
          },
          layout: {
            hLineWidth: function (i, node) {
              return (i === 0 || i === 1 || i === node.table.body.length) ? 1 : 0.5;
            },
            vLineWidth: function () { return 0; },
            hLineColor: function () { return COLOR_BORDER; },
            paddingLeft: function () { return 8; },
            paddingRight: function () { return 8; },
            paddingTop: function () { return 8; },
            paddingBottom: function () { return 8; }
          },
          margin: [0, 0, 0, 14]
        },
        
        // Totales
        {
          columns: [
            {width: '*', text: ''},
            {
              width: 220,
              stack: [
                {
                  columns: [
                    {text: 'Subtotal:', style: 'totalLabel'},
                    {text: '$' + puntosDecimales(data.subtotal), style: 'totalValue', alignment: 'right'}
                  ],
                  margin: [0, 0, 0, 8]
                },
                {
                  columns: [
                    {text: 'Noches/Días:', style: 'totalLabel'},
                    {text: data.noche_tour, style: 'totalValue', alignment: 'right'}
                  ],
                  margin: [0, 0, 0, 8]
                },
                {canvas: [{type: 'line', x1: 0, y1: 0, x2: 220, y2: 0, lineWidth: 1, lineColor: '#cbd5e1'}], margin: [0, 8, 0, 8]},
                {
                  columns: [
                    {text: 'TOTAL:', style: 'grandTotalLabel'},
                    {text: '$' + puntosDecimales(data.total), style: 'grandTotalValue', alignment: 'right'}
                  ]
                }
              ],
              margin: [0, 0, 0, 0]
            }
          ],
          margin: [0, 0, 0, 25]
        },
        
        // Términos y condiciones
        normalizarTextoHtmlParaPdf(data.terminos) ? makeSectionHeader('Términos y condiciones', [0, 12, 0, 8]) : {},
        normalizarTextoHtmlParaPdf(data.terminos) ? {text: normalizarTextoHtmlParaPdf(data.terminos), style: 'termsText', margin: [0, 0, 0, 14]} : {}
      ];
    }

    // Resumen final (por cotización + total general)
    const resumenLista = (cotizaciones.length > 0) ? cotizaciones : (data && typeof data === 'object' ? [data] : []);
    if (resumenLista.length > 0) {
      const tipoLabelResumen = (t) => (t == '1' ? 'Alojamiento' : (t == '2' ? 'Tour' : 'Alquiler'));
      const totalGeneral = resumenLista.reduce((acc, c) => acc + (parseInt(c.total || 0) || 0), 0);

      const bodyResumen = [
        [
          {text: '#', style: 'tableHeader', alignment: 'center', fillColor: COLOR_TABLE_HDR},
          {text: 'Tipo', style: 'tableHeader', fillColor: COLOR_TABLE_HDR},
          {text: 'Plan', style: 'tableHeader', fillColor: COLOR_TABLE_HDR},
          {text: 'Check-in', style: 'tableHeader', fillColor: COLOR_TABLE_HDR},
          {text: 'Check-out', style: 'tableHeader', fillColor: COLOR_TABLE_HDR},
          {text: 'Total', style: 'tableHeader', alignment: 'right', fillColor: COLOR_TABLE_HDR}
        ]
      ];

      resumenLista.forEach((c, idx) => {
        bodyResumen.push([
          {text: String(idx + 1), alignment: 'center'},
          {text: tipoLabelResumen(c.tipo_cotizacion), color: COLOR_TEXT},
          {text: c.nombre_plan || '', color: COLOR_TEXT},
          {text: c.fecha_entrada || '', color: COLOR_TEXT},
          {text: c.fecha_salida || '', color: COLOR_TEXT},
          {text: '$' + puntosDecimales(parseInt(c.total || 0) || 0), alignment: 'right', color: COLOR_TEXT}
        ]);
      });

      bodyResumen.push([
        {text: 'TOTAL GENERAL', colSpan: 5, alignment: 'right', bold: true, color: COLOR_BLUE, fillColor: COLOR_SECTION_BG, border: [false, true, false, false]}, {}, {}, {}, {},
        {text: '$' + puntosDecimales(totalGeneral), alignment: 'right', bold: true, color: COLOR_BLUE, fillColor: COLOR_SECTION_BG, border: [false, true, false, false]}
      ]);

      contentArray.push(
        makeSectionHeader('Resumen de cotizaciones', [0, 12, 0, 10]),
        {
          table: {
            headerRows: 1,
            widths: [20, 70, '*', 70, 70, 80],
            body: bodyResumen
          },
          layout: {
            hLineWidth: function (i, node) {
              return (i === 0 || i === 1 || i === node.table.body.length) ? 1 : 0.5;
            },
            vLineWidth: function () { return 0; },
            hLineColor: function () { return COLOR_BORDER; },
            paddingLeft: function () { return 8; },
            paddingRight: function () { return 8; },
            paddingTop: function () { return 8; },
            paddingBottom: function () { return 8; }
          },
          margin: [0, 0, 0, 0]
        }
      );
    }

    const docDefinition = {
      watermark: watermark,
      pageSize: 'LETTER',
      pageMargins: [50, 100, 50, 80],
      defaultStyle: {
        fontSize: PDF_BASE_FONT_SIZE
      },
      header: function(currentPage) {
        const headerColumns = data.logoBase64 ? [
          {
            width: 90,
            image: data.logoBase64,
            fit: [55, 55],
            margin: [50, 8, 0, 0]
          },
          {
            width: '*',
            stack: [
              {text: 'COTIZACIÓN', style: 'headerTitle', alignment: 'center', margin: [0, 18, 0, 2]},
              {text: 'Cotización válida por 24 HRS', style: 'headerSubtitle', alignment: 'center', margin: [0, 0, 0, 0]}
            ]
          },
          {
            width: 170,
            stack: [
              {text: '#' + (id || 'BORRADOR'), style: 'headerNumber', alignment: 'right', margin: [0, 18, 50, 4]},
              {text: 'Fecha de emisión:', style: 'headerDateLabel', alignment: 'right', margin: [0, 0, 50, 2]},
              {text: safe(data.fecha_expedicion), style: 'headerDate', alignment: 'right', margin: [0, 0, 50, 0]}
            ]
          }
        ] : [
          {
            width: '*',
            stack: [
              {text: 'COTIZACIÓN', style: 'headerTitle', alignment: 'center', margin: [0, 18, 0, 2]},
              {text: 'Cotización válida por 24 HRS', style: 'headerSubtitle', alignment: 'center', margin: [0, 0, 0, 0]}
            ]
          },
          {
            width: 170,
            stack: [
              {text: '#' + (id || 'BORRADOR'), style: 'headerNumber', alignment: 'right', margin: [0, 18, 50, 4]},
              {text: 'Fecha de emisión:', style: 'headerDateLabel', alignment: 'right', margin: [0, 0, 50, 2]},
              {text: safe(data.fecha_expedicion), style: 'headerDate', alignment: 'right', margin: [0, 0, 50, 0]}
            ]
          }
        ];

        return {
          stack: [
            {columns: headerColumns},
            {canvas: [{type: 'line', x1: 50, y1: 0, x2: 545, y2: 0, lineWidth: 1, lineColor: COLOR_BORDER}], margin: [0, 10, 0, 0]}
          ]
        };
      },
      content: [
        // Línea separadora y info del cliente (solo para múltiples)
        ...(cotizaciones.length > 0 ? [
          makeSectionHeader('Información del Cliente', [0, 0, 0, 10]),
          {
            columns: [
              {
                width: '*',
                stack: [
                  kvLine('Nombre:', data.nombre_titular),
                  kvLine('Procedencia:', [safe(data.ciudad), safe(data.depto), safe(data.pais)].filter(Boolean).join(', '))
                ]
              },
              {
                width: '*',
                stack: [
                  kvLine('Email:', data.email),
                  kvLine('Teléfono:', data.telefono)
                ]
              }
            ],
            columnGap: 30,
            margin: [0, 0, 0, 8]
          }
        ] : []),
        ...contentArray
      ],
      footer: function(currentPage, pageCount) {
        return {
          stack: [
            {canvas: [{type: 'line', x1: 50, y1: 0, x2: 545, y2: 0, lineWidth: 1, lineColor: '#e5e7eb'}], margin: [0, 0, 0, 10]},
            {
              columns: [
                {
                  width: '*',
                  stack: [
                    {text: nombre_hotel, style: 'footerHotelName'},
                    {text: direccion_hotel + ' - ' + pais_hotel + ', ' + depto_hotel, style: 'footerHotelInfo'},
                    {text: 'Tel: ' + telefono_hotel + ' | Email: ' + email_hotel, style: 'footerHotelInfo'}
                  ],
                  margin: [50, 0, 0, 0]
                },
                {
                  width: 'auto',
                  text: 'Página ' + currentPage + ' de ' + pageCount,
                  style: 'footerPage',
                  margin: [0, 15, 50, 0]
                }
              ]
            }
          ]
        };
      },
      styles: {
        headerTitle: {
          fontSize: 14,
          bold: true,
          color: COLOR_BLUE
        },
        headerSubtitle: {
          fontSize: 9,
          color: COLOR_MUTED
        },
        headerBadgeText: {
          fontSize: PDF_TITLE_FONT_SIZE,
          bold: true,
          color: '#ffffff',
          alignment: 'center',
          margin: [5, 3, 5, 3]
        },
        headerNumber: {
          fontSize: 12,
          bold: true,
          color: COLOR_BLUE
        },
        headerDateLabel: {
          fontSize: 8,
          color: COLOR_MUTED
        },
        headerDate: {
          fontSize: 8,
          color: COLOR_TEXT
        },
        footerHotelName: {
          fontSize: PDF_BASE_FONT_SIZE,
          bold: true,
          color: '#1e293b'
        },
        footerHotelInfo: {
          fontSize: PDF_BASE_FONT_SIZE,
          color: '#64748b'
        },
        footerPage: {
          fontSize: PDF_BASE_FONT_SIZE,
          color: '#64748b'
        },
        sectionHeaderText: {
          fontSize: 10,
          bold: true,
          color: COLOR_BLUE
        },
        kvLabel: {
          fontSize: 9,
          bold: true,
          color: COLOR_TEXT
        },
        kvValue: {
          fontSize: 9,
          color: COLOR_TEXT
        },
        tableHeader: {
          fontSize: 9,
          bold: true,
          color: COLOR_TEXT
        },
        totalLabel: {
          fontSize: 9,
          color: COLOR_MUTED
        },
        totalValue: {
          fontSize: 9,
          color: COLOR_TEXT
        },
        grandTotalLabel: {
          fontSize: 11,
          bold: true,
          color: COLOR_BLUE
        },
        grandTotalValue: {
          fontSize: 14,
          bold: true,
          color: COLOR_BLUE
        },
        bodyText: {
          fontSize: 9,
          color: COLOR_TEXT,
          lineHeight: 1.35
        },
        subSectionLabel: {
          fontSize: 9,
          bold: true,
          color: COLOR_TEXT
        },
        bulletList: {
          fontSize: 9,
          color: COLOR_TEXT,
          lineHeight: 1.25
        },
        termsText: {
          fontSize: 8.5,
          color: COLOR_MUTED,
          lineHeight: 1.25
        },
        footer: {
          fontSize: PDF_BASE_FONT_SIZE,
          color: '#94a3b8'
        }
      }
    };

    const filename = esBorrador ? 'Cotizacion_Borrador.pdf' : 'Cotizacion_' + id + '.pdf';
    pdfMake.createPdf(docDefinition).download(filename);
  }

  function limpiar_formulario(){
      $("input:radio").prop('checked', false);
      $("#infante").val("0").prop('disabled',true)
      $("#child").val("0").prop('disabled',true)
      $("#adult_s").val("0").prop('disabled',true)
      $("#adult_d").val("0").prop('disabled',true)
      $("#adult_t_c").val("0").prop('disabled',true)
      setSelectValue("#id_usuario", "")
      setSelectValue("#id_tarifa", "")
      $("#id_tarifa").prop('disabled',true)
      setSelectValue("#id_planes", "")
      setSelectValue("#id_motivo", "")
      $("#cantidad_noches").text("")
      $("#id_acomodacion").val("")
      $("#DateRange").val("").prop('disabled',true)
      $("#startDate").val("").prop('disabled',true)
      $("#endDate").val("").prop('disabled',true)
      $("#tbody_tarifa").html("")
      $("#content_subtotal").html("")
      $("#content_info_tarifa").hide()
      $("#content_info_planes").hide()
      if (flatpickrInstances['']) {
        flatpickrInstances[''].clear();
      }
  }

  function validar_plan(suffix){
      suffix = suffix || ''; // Por defecto vacío para alojamiento
      $("input:radio[name='tipo_viaje" + suffix + "']").prop('checked', false);
      $("#infante" + suffix).val("0").prop('disabled',true)
      $("#child" + suffix).val("0").prop('disabled',true)
      $("#adult_s" + suffix).val("0").prop('disabled',true)
      $("#adult_d" + suffix).val("0").prop('disabled',true)
      $("#adult_t_c" + suffix).val("0").prop('disabled',true)
      setSelectValue("#id_tarifa" + suffix, "")
      $("#id_tarifa" + suffix).prop('disabled',true)
      $("#cantidad_noches" + suffix).text("")
      $("#DateRange" + suffix).val("").prop('disabled',true)
      $("#startDate" + suffix).val("").prop('disabled',true)
      $("#endDate" + suffix).val("").prop('disabled',true)
      $("#tbody_tarifa" + suffix).html("")
      $("#content_subtotal" + suffix).html("")
      if (flatpickrInstances[suffix]) {
        flatpickrInstances[suffix].clear();
      }
      
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

  function restaurarFormularioCotizacionInicial() {
    limpiarErrores(document.body);

    $('input[type="checkbox"][name="tipo_cotizacion[]"]').prop('checked', false);
    setSelectValue("#id_usuario", "");
    $("#content_info_titular").hide();

    limpiar_formulario();

    ['_tour', '_alq'].forEach(function(suffix) {
      validar_plan(suffix);

      setSelectValue("#id_planes" + suffix, "");
      setSelectValue("#id_motivo" + suffix, "");
      setSelectValue("#id_tarifa" + suffix, "");
      $("#id_tarifa" + suffix).prop('disabled', true);
      $("#id_acomodacion" + suffix).val("");

      $("#detalle_tarifa" + suffix).html("");
      $("#content_detalles_plan" + suffix).html("");
      $("#content_servicios_incluidos" + suffix).html("");
      $("#iniciartarifas" + suffix).html("");
    });

    $("#content_detalles_plan").html("");
    $("#content_servicios_incluidos").html("");
    $("#iniciartarifas").html("");
    $("#detalle_tarifa").html("");

    $("#form_alojamiento, #form_tour, #form_alquiler").hide();
    $("#content_info_planes, #content_info_tarifa, #content_info_planes_tour, #content_info_tarifa_tour, #content_info_planes_alq, #content_info_tarifa_alq").hide();

    updateLogoGifVisibility();
  }

  function actualizarTablaCotizaciones() {
    if ($.fn.DataTable.isDataTable('#tabla_cotizacion') && typeof dtable !== 'undefined') {
      dtable.ajax.reload(null, false);
      return;
    }

    traer_tabla_cotizacion();
  }

  function irATabBuscar() {
    const $tabBuscar = $("#profile-tab");

    if (!$tabBuscar.length) {
      actualizarTablaCotizaciones();
      return;
    }

    try {
      if (typeof $tabBuscar.tab === 'function') {
        $tabBuscar.tab('show');
      }
      $tabBuscar.trigger('click');
    } catch (e) {
      $tabBuscar.trigger('click');
    }
  }

  function show_traer_tabla_cotizacion(){
    setTimeout(() => {
      traer_tabla_cotizacion()
    }, 500);
  }

  // Cuando se muestra el tab "Buscar", ajustar anchos (evita desbordes por inicialización en tabs)
  (function bindTablaCotizacionAdjustOnTab(){
    function bind(){
      if (!window.jQuery) return;
      $(document).on('shown.bs.tab', 'a[data-toggle="tab"][href="#profile"]', function () {
        if ($.fn.DataTable.isDataTable('#tabla_cotizacion') && typeof dtable !== 'undefined') {
          try {
            dtable.columns.adjust();
            if (dtable.responsive && dtable.responsive.recalc) {
              dtable.responsive.recalc();
            }
          } catch (e) {}
        }
      });
    }

    if (window.jQuery) {
      bind();
    } else {
      document.addEventListener('DOMContentLoaded', bind);
    }
  })();

  function traer_tabla_cotizacion(){

      function escapeHtml(value) {
        return String(value ?? '')
          .replace(/&/g, '&amp;')
          .replace(/</g, '&lt;')
          .replace(/>/g, '&gt;')
          .replace(/"/g, '&quot;')
          .replace(/'/g, '&#39;');
      }

      if ( ! $.fn.DataTable.isDataTable('#tabla_cotizacion')) {
			  dtable = $("#tabla_cotizacion").DataTable({
          "autoWidth": false,
          "order": [[3, "desc"]],
          "responsive": {
            details: {
              type: 'inline',
              target: 'tr'
            }
          },

          "initComplete": function(){
            const api = this.api();
            setTimeout(() => {
              try {
                api.columns.adjust();
                if (api.responsive && api.responsive.rebuild) {
                  api.responsive.rebuild();
                }
                if (api.responsive && api.responsive.recalc) {
                  api.responsive.recalc();
                }
              } catch (e) {}
            }, 0);
          },
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
            { "data": "nombre_titular"},
            { "data": "nombre_autor"},
            { "data": "created_at"},
            { "data": "update_at"},
            { "data": ""}
          ],
				 "columnDefs": [
          {
            targets: 0,
            responsivePriority: 1
          },
          {
            targets: 1,
            responsivePriority: 2,
            render: function(data, type){
              if (type !== 'display') return data;
              const safe = escapeHtml(data);
              return `<span class="dt-truncate" title="${safe}">${safe}</span>`;
            }
          },
          {
            targets: 2,
            responsivePriority: 5,
            render: function(data, type){
              if (type !== 'display') return data;
              const safe = escapeHtml(data);
              return `<span class="dt-truncate" title="${safe}">${safe}</span>`;
            }
          },
          {
            targets: 3,
            responsivePriority: 4
          },
          {
            targets: 4,
            responsivePriority: 6
          },
					 {
            "targets": 5,
            "responsivePriority": 3,
						"data":"",
						 render: function ( data, type, row ) {
              return  `<button class="btn btn-link" onclick="event.stopPropagation(); traer_cotizacion(${row.id})"><i class="fa fa-eye" aria-hidden="true"></i></button>`;
						 }
					}],

          "drawCallback": function () {
            const api = this.api();
            try {
              api.columns.adjust();
              if (api.responsive && api.responsive.rebuild) {
                api.responsive.rebuild();
              }
              if (api.responsive && api.responsive.recalc) {
                api.responsive.recalc();
              }
            } catch (e) {}
          }
				});

      $(window).off('resize.tablaCotizacion').on('resize.tablaCotizacion', function () {
        if (dtable) {
          try {
            dtable.columns.adjust();
            if (dtable.responsive && dtable.responsive.rebuild) {
              dtable.responsive.rebuild();
            }
            if (dtable.responsive && dtable.responsive.recalc) {
              dtable.responsive.recalc();
            }
          } catch (e) {}
        }
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
    $("#select_deptos").val("").change()
    $("#ciudad").val("").change()
    $("#direccion").val("").change()
    $("#telefono_indicativo").val("+57").change()
    $("#telefono").val("").change()
    $("#email").val("").change()
  }

  function cambiarModoDateRange(esUnaFecha, suffix) {
    suffix = suffix || ''; // Por defecto vacío para alojamiento

    $('#DateRange' + suffix).prop('disabled', false).prop('required', true);
    $('#startDate' + suffix + ', #endDate' + suffix).prop('disabled', false); // 👈 clave

    clearDateRangeFields(suffix);
    initFlatpickrDateRange(esUnaFecha, suffix);
  }

  function showFormCotizacion(tipo, estado) {
    if (tipo == 1) {
      estado ? $("#form_alojamiento").show() : $("#form_alojamiento").hide()
      if (estado) {
        traer_planes(id_hotel, 1, '')
      }
      // Ocultar la previsualización cuando se desmarque
      if (!estado) {
        $("#content_info_planes").hide()
        $("#content_info_tarifa").hide()
      }
    }
    
    if (tipo == 2) {
      estado ? $("#form_tour").show() : $("#form_tour").hide()
      if (estado) {
        traer_planes(id_hotel, 2, '_tour')
      }
      // Ocultar la previsualización cuando se desmarque
      if (!estado) {
        $("#content_info_planes_tour").hide()
        $("#content_info_tarifa_tour").hide()
      }
    } 
    if (tipo == 3) {
      estado ? $("#form_alquiler").show() : $("#form_alquiler").hide()
      if (estado) {
        traer_planes(id_hotel, 3, '_alq')
      }
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
        mostrarErrorCampo($el, 'Selecciona un Cliente para la cotización');
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

      const confirmacion = await Swal.fire({
        title: '¿Confirmar guardado?',
        text: cotizaciones.length > 1
          ? `Se guardarán ${cotizaciones.length} cotizaciones.`
          : 'Se guardará la cotización actual.',
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Confirmar',
        cancelButtonText: 'Cancelar',
        reverseButtons: true,
        focusCancel: true
      });

      if (!confirmacion.isConfirmed) {
        return;
      }

      const result = await GuardarCotizacionFetch(cotizaciones);
      
      const mensajeCotizaciones = cotizaciones.length > 1 
        ? `Se guardaron ${cotizaciones.length} cotizaciones (${cotizaciones.map(c => c.tipo_cotizacion == 1 ? 'Alojamiento' : c.tipo_cotizacion == 2 ? 'Tour' : 'Alquiler').join(' + ')})`
        : 'Cotización guardada correctamente';

      restaurarFormularioCotizacionInicial();
      irATabBuscar();
      
      ccAlert(mensajeCotizaciones, "success");

      console.log('Resultado de guardar:', result);
      console.log('id_principal:', result.id_principal);
      console.log('ids_detalle:', result.ids_detalle);
      console.log('Total cotizaciones guardadas:', cotizaciones.length);

    } catch (e) {
      ccAlert(e.message || "Ocurrió un error al guardar.", "error");
    }
  }

  function previsualizarPDFBorrador() {
    // Validar que haya un cliente seleccionado
    if (!$("#id_usuario").val()) {
      ccAlert('Debes seleccionar un cliente antes de previsualizar el PDF', 'error');
      return;
    }

    // Obtener información del titular (común para todas)
    const titular = $("#id_usuario option:selected");
    
    // Construir array de cotizaciones desde los formularios activos
    const cotizaciones_borrador = [];
    
    // Función helper para construir cotización desde formulario
    function buildCotizacionBorrador(tipo_cot, suffix) {
      const plan = $("#id_planes" + suffix + " option:selected");
      const motivo = $("#id_motivo" + suffix + " option:selected");
      const tarifa = $("#id_tarifa" + suffix + " option:selected");
      
      if (!tarifa.val() || !plan.val()) {
        return null;
      }
      
      const tipo_viaje_name = suffix === '' ? 'tipo_viaje' : (suffix === '_tour' ? 'tipo_viaje_tour' : 'tipo_viaje_alq');
      const tipo_servicio = $("input[name='" + tipo_viaje_name + "']:checked").val();
      
      if (!tipo_servicio) {
        return null;
      }
      
      const n_child = parseInt($("#child" + suffix).val() || "0");
      const n_adult_s = parseInt($("#adult_s" + suffix).val() || "0");
      const n_adult_d = parseInt($("#adult_d" + suffix).val() || "0");
      const n_adult_t_c = parseInt($("#adult_t_c" + suffix).val() || "0");
      
      const tarifa_child = parseInt(tarifa.attr('child') || "0");
      const tarifa_adult_s = parseInt(tarifa.attr('adult_s') || "0");
      const tarifa_adult_d = parseInt(tarifa.attr('adult_d') || "0");
      const tarifa_adult_t_c = parseInt(tarifa.attr('adult_t_c') || "0");
      
      const totalchild = n_child * tarifa_child;
      const totaladult_s = n_adult_s * tarifa_adult_s;
      const totaladult_d = n_adult_d * tarifa_adult_d;
      const totaladult_t_c = n_adult_t_c * tarifa_adult_t_c;
      
      const subtotal = totalchild + totaladult_s + totaladult_d + totaladult_t_c;
      
      const fecha_entrada = $("#startDate" + suffix).val();
      const fecha_salida = $("#endDate" + suffix).val();
      
      if (!fecha_entrada || !fecha_salida) {
        return null;
      }
      
      const fechaIni = new Date(fecha_entrada);
      const fechaFin = new Date(fecha_salida);
      const diff = fechaFin - fechaIni;
      const noches = Math.floor(diff / (1000 * 60 * 60 * 24));
      const n_noches = noches === 0 ? 1 : noches;
      const noche_tour = noches === 0 ? '1 día' : noches + ' noches';
      
      const total = subtotal * n_noches;
      const acomodo = $("#id_acomodacion" + suffix).val() || 'Sin especificar';
      const descripcion_plan = plan.attr('descripcion') || '';
      
      // Construir consumo desde content_detalles_plan
      let consumo = '';
      $("#content_detalles_plan" + suffix + " div").each(function() {
        const texto = $(this).text().trim();
        if (texto) {
          consumo += "• " + texto + "\n";
        }
      });
      
      // Construir servicios desde content_servicios_incluidos
      let servicios = '';
      $("#content_servicios_incluidos" + suffix + " div").each(function() {
        const texto = $(this).text().trim();
        if (texto) {
          servicios += "• " + texto + "\n";
        }
      });
      
      return {
        tipo_cotizacion: tipo_cot.toString(),
        tipo_servicio: tipo_servicio,
        nombre_plan: plan.text(),
        descripcion_plan: descripcion_plan,
        nombre_motivo: motivo.text(),
        fecha_entrada: fecha_entrada,
        fecha_salida: fecha_salida,
        acomodo: acomodo,
        consumo: consumo,
        servicios: servicios,
        terminos: '',
        n_child: n_child,
        n_adult_s: n_adult_s,
        n_adult_d: n_adult_d,
        n_adult_t_c: n_adult_t_c,
        tarifa_child: tarifa_child,
        tarifa_adult_s: tarifa_adult_s,
        tarifa_adult_d: tarifa_adult_d,
        tarifa_adult_t_c: tarifa_adult_t_c,
        totalchild: totalchild,
        totaladult_s: totaladult_s,
        totaladult_d: totaladult_d,
        totaladult_t_c: totaladult_t_c,
        subtotal: subtotal,
        noche_tour: noche_tour,
        total: total
      };
    }
    
    // Procesar Alojamiento
    if (estaActivoTipo(1)) {
      const cot = buildCotizacionBorrador(1, '');
      if (cot) cotizaciones_borrador.push(cot);
    }
    
    // Procesar Tour
    if (estaActivoTipo(2)) {
      const cot = buildCotizacionBorrador(2, '_tour');
      if (cot) cotizaciones_borrador.push(cot);
    }
    
    // Procesar Alquiler
    if (estaActivoTipo(3)) {
      const cot = buildCotizacionBorrador(3, '_alq');
      if (cot) cotizaciones_borrador.push(cot);
    }
    
    if (cotizaciones_borrador.length === 0) {
      ccAlert('Debes completar al menos un formulario de cotización para previsualizar', 'error');
      return;
    }
    
    // Preparar datos para PDF (formato multi-cotización)
    window.cotizacionDataParaPDF = {
      id: 'BORRADOR',
      nombre_hotel: nombre_hotel,
      direccion_hotel: direccion_hotel,
      pais_hotel: pais_hotel,
      depto_hotel: depto_hotel,
      telefono_hotel: telefono_hotel,
      fecha_expedicion: new Date().toLocaleString('es-ES', {
        year: 'numeric',
        month: '2-digit',
        day: '2-digit',
        hour: '2-digit',
        minute: '2-digit',
        second: '2-digit',
        hour12: false
      }).replace(/(\d+)\/(\d+)\/(\d+),?\s*(\d+:\d+:\d+)/, '$3-$2-$1 $4'),
      nombre_titular: titular.attr('nombre'),
      cedula: titular.attr('cedula'),
      email: titular.attr('email'),
      telefono: titular.attr('telefono'),
      cotizaciones: cotizaciones_borrador  // Array de cotizaciones
    };

    // Abrir modal de previsualización (igual que traer_cotizacion)
    $("#brn_modal_print").click();

    // Botón de descarga (genera el PDF cuando el usuario lo solicite)
    $("#btn_pdf").html(
      `<div class="d-flex justify-content-end" style="margin: 8px 10px 10px;">
                  <button type="button" class="cc-pdf-fab-btn cc-pdf-fab-btn--sm" onclick="imprimir_cotizacion('BORRADOR', true)" title="Previsualizar" aria-label="Previsualizar" id="pdf">
                    <i class="fas fa-file-pdf"></i>
                  </button>
                </div>`
    );

    // Renderizar vista previa en el modal (acumula TODAS las cotizaciones del borrador)
    const fecha_emision = window.cotizacionDataParaPDF.fecha_expedicion;
    const titularNombre = window.cotizacionDataParaPDF.nombre_titular || '';
    const titularEmail = window.cotizacionDataParaPDF.email || '';
    const titularTelefono = window.cotizacionDataParaPDF.telefono || '';

    const tipoLabel = (t) => (t == '1' ? 'Alojamiento' : (t == '2' ? 'Tour' : 'Alquiler'));

    let listaTipos = '';
    cotizaciones_borrador.forEach((c, idx) => {
      listaTipos += `<li style="margin: 0 0 6px 0;">${idx + 1}. ${tipoLabel(c.tipo_cotizacion)} — ${c.nombre_plan}</li>`;
    });

    function renderTablaDetalle(cot) {
      const tipoServicio = String(cot.tipo_servicio);

      const rows = [];
      const pushRow = (label, qty, unit, total) => {
        const q = parseInt(qty || 0) || 0;
        const t = parseInt(total || 0) || 0;
        if (q <= 0 || t <= 0) return;
        rows.push({ label, qty: q, unit: parseInt(unit || 0) || 0, total: t });
      };

      if (tipoServicio === '0') {
        pushRow('Niños', cot.n_child, cot.tarifa_child, cot.totalchild);
        pushRow('Adultos', cot.n_adult_s, cot.tarifa_adult_s, cot.totaladult_s);
      } else if (tipoServicio === '1') {
        pushRow('Niños', cot.n_child, cot.tarifa_child, cot.totalchild);
        pushRow('Adultos individual', cot.n_adult_s, cot.tarifa_adult_s, cot.totaladult_s);
        pushRow('Adultos doble', cot.n_adult_d, cot.tarifa_adult_d, cot.totaladult_d);
        pushRow('Adultos triple/cuadruple', cot.n_adult_t_c, cot.tarifa_adult_t_c, cot.totaladult_t_c);
      } else {
        // tipo_servicio 2 (alquiler) u otros
        pushRow('Valor', cot.n_adult_s, cot.tarifa_adult_s, cot.totaladult_s);
      }

      if (rows.length === 0) return '<tbody></tbody>';

      let html = '<tbody>';
      rows.forEach((r, idx) => {
        html += `
          <tr>
            <td class="table-number">${idx + 1}</td>
            <td>${r.label}</td>
            <td style="text-align:center;">${r.qty}</td>
            <td class="table-right">$${puntosDecimales(r.unit)}</td>
            <td class="table-right">$${puntosDecimales(r.total)}</td>
          </tr>`;
      });
      html += '</tbody>';
      return html;
    }

    function renderBulletsFromNewlines(texto) {
      if (!texto) return '';
      const items = String(texto)
        .split('\n')
        .map(s => s.trim())
        .filter(Boolean);
      if (items.length === 0) return '';
      let html = '<ul style="margin:0; padding-left: 18px; color:#334155; font-size: 13px;">';
      items.forEach((it) => {
        html += `<li style="margin: 0 0 6px 0;">${it.replace(/^•\s*/, '')}</li>`;
      });
      html += '</ul>';
      return html;
    }

    let detallesHTML = '';
    cotizaciones_borrador.forEach((c, idx) => {
      const tabla = renderTablaDetalle(c);
      const consumoHTML = renderBulletsFromNewlines(c.consumo);
      const serviciosHTML = renderBulletsFromNewlines(c.servicios);

      detallesHTML += `
        <div class="cotizacion-section">
          <div class="section-header"><h2 class="section-title">Detalle (${idx + 1} de ${cotizaciones_borrador.length}) — ${tipoLabel(c.tipo_cotizacion)}</h2></div>
          <div class="info-grid" style="margin-bottom: 1rem;">
            <div class="info-item"><span class="info-label">Plan</span><span class="info-value">${c.nombre_plan}</span></div>
            <div class="info-item"><span class="info-label">Motivo</span><span class="info-value">${c.nombre_motivo}</span></div>
            <div class="info-item"><span class="info-label">Check-in</span><span class="info-value">${c.fecha_entrada}</span></div>
            <div class="info-item"><span class="info-label">Check-out</span><span class="info-value">${c.fecha_salida}</span></div>
            <div class="info-item"><span class="info-label">Duración</span><span class="info-value">${c.noche_tour}</span></div>
            <div class="info-item"><span class="info-label">Acomodación</span><span class="info-value">${c.acomodo || ''}</span></div>
          </div>

          ${c.descripcion_plan ? `<div style="font-size: 12px; color:#64748b; line-height:1.6; margin-bottom: 1rem;">${c.descripcion_plan}</div>` : ''}

          ${(consumoHTML || serviciosHTML) ? `
            <div class="info-grid" style="margin-bottom: 1rem;">
              ${consumoHTML ? `<div class="info-item"><span class="info-label">Consumo</span><div class="info-value" style="font-weight: 400;">${consumoHTML}</div></div>` : ''}
              ${serviciosHTML ? `<div class="info-item"><span class="info-label">Servicios incluidos</span><div class="info-value" style="font-weight: 400;">${serviciosHTML}</div></div>` : ''}
            </div>
          ` : ''}

          <div class="table-wrapper">
            <table class="cotizacion-table">
              <thead>
                <tr>
                  <th style="width: 40px;">#</th>
                  <th>Item</th>
                  <th style="width: 100px; text-align:center;">Cantidad</th>
                  <th style="width: 140px; text-align:right;">Valor unitario</th>
                  <th style="width: 120px; text-align:right;">Total</th>
                </tr>
              </thead>
              ${tabla}
            </table>
          </div>

          <div class="totals-section">
            <div class="total-row"><span>Subtotal:</span><span>$${puntosDecimales(c.subtotal)}</span></div>
            <div class="total-row grand-total"><span>TOTAL:</span><span>$${puntosDecimales(c.total)} COP</span></div>
          </div>
        </div>
      `;
    });

    // Resumen al final (borrador)
    const totalGeneralBorrador = cotizaciones_borrador.reduce((acc, c) => acc + (parseInt(c.total || 0) || 0), 0);
    const subtotalGeneralBorrador = cotizaciones_borrador.reduce((acc, c) => acc + (parseInt(c.subtotal || 0) || 0), 0);
    let rowsResumenBorrador = '';
    cotizaciones_borrador.forEach((c, idx) => {
      rowsResumenBorrador += `
        <tr>
          <td class="table-number">${idx + 1}</td>
          <td>${tipoLabel(c.tipo_cotizacion)}</td>
          <td>${c.nombre_plan}</td>
          <td class="table-right">$${puntosDecimales(c.subtotal)}</td>
          <td class="table-right">$${puntosDecimales(c.total)}</td>
        </tr>
      `;
    });
    const resumenHTMLBorrador = `
      <div class="cotizacion-section">
        <div class="section-header"><h2 class="section-title">Resumen</h2></div>
        <div class="table-wrapper">
          <table class="cotizacion-table">
            <thead>
              <tr>
                <th style="width: 40px;">#</th>
                <th style="width: 110px;">Tipo</th>
                <th>Plan</th>
                <th style="width: 140px; text-align:right;">Subtotal</th>
                <th style="width: 140px; text-align:right;">Total</th>
              </tr>
            </thead>
            <tbody>
              ${rowsResumenBorrador}
              <tr>
                <td colspan="3" class="table-right" style="font-weight:700; color:#1e293b;">TOTAL GENERAL</td>
                <td class="table-right" style="font-weight:700; color:#1e293b;">$${puntosDecimales(subtotalGeneralBorrador)}</td>
                <td class="table-right" style="font-weight:700; color:#1e293b;">$${puntosDecimales(totalGeneralBorrador)} COP</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    `;

    const fila = `
      <style>
        .cotizacion-mockup{font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Oxygen,Ubuntu,Cantarell,sans-serif;color:#1e293b;background:#f8fafc;padding:2rem;max-width:900px;margin:0 auto;}
        .cotizacion-section{background:white;border-radius:12px;padding:1.25rem;margin-bottom:1rem;box-shadow:0 1px 3px rgba(0,0,0,0.05);}
        .section-header{display:flex;align-items:center;margin-bottom:.75rem;padding-bottom:.5rem;border-bottom:1px solid #e2e8f0;}
        .section-title{font-size:16px;font-weight:700;color:#1e293b;margin:0;}
        .info-grid{display:grid;grid-template-columns:1fr 1fr;gap:1rem;font-size:13px;}
        .info-item{display:flex;flex-direction:column;}
        .info-label{font-size:11px;color:#64748b;font-weight:600;text-transform:uppercase;letter-spacing:.5px;margin-bottom:4px;}
        .info-value{color:#1e293b;font-weight:500;}
        .cotizacion-table{width:100%;border-collapse:collapse;font-size:13px;}
        .cotizacion-table thead{background:#f8fafc;}
        .cotizacion-table th{padding:10px;text-align:left;font-size:11px;font-weight:700;color:#64748b;text-transform:uppercase;letter-spacing:.5px;border-bottom:2px solid #e2e8f0;}
        .cotizacion-table td{padding:10px;border-bottom:1px solid #f1f5f9;color:#334155;}
        .table-number{text-align:center;font-weight:600;color:#94a3b8;}
        .table-right{text-align:right;}
        .totals-section{background:#f8fafc;border-radius:8px;padding:1rem;margin-top:1rem;}
        .total-row{display:flex;justify-content:space-between;padding:6px 0;font-size:13px;}
        .total-row.grand-total{border-top:2px solid #cbd5e1;margin-top:8px;padding-top:10px;font-size:16px;font-weight:700;color:#1e293b;}
      </style>
      <div class="cotizacion-mockup">
        <div class="cotizacion-section">
          <div class="section-header"><h2 class="section-title">Previsualización (Borrador)</h2></div>
          <div class="info-grid">
            <div class="info-item"><span class="info-label">Hotel</span><span class="info-value">${nombre_hotel}</span></div>
            <div class="info-item"><span class="info-label">Fecha de emisión</span><span class="info-value">${fecha_emision}</span></div>
          </div>
        </div>

        <div class="cotizacion-section">
          <div class="section-header"><h2 class="section-title">Cliente</h2></div>
          <div class="info-grid">
            <div class="info-item"><span class="info-label">Nombre</span><span class="info-value">${titularNombre}</span></div>
            <div class="info-item"><span class="info-label">Email</span><span class="info-value">${titularEmail}</span></div>
            <div class="info-item"><span class="info-label">Teléfono</span><span class="info-value">${titularTelefono}</span></div>
            <div class="info-item"><span class="info-label">Documento</span><span class="info-value">${window.cotizacionDataParaPDF.cedula || ''}</span></div>
          </div>
        </div>

        <div class="cotizacion-section">
          <div class="section-header"><h2 class="section-title">Cotizaciones incluidas</h2></div>
          <ul style="margin:0; padding-left: 18px; color:#334155; font-size: 13px;">${listaTipos}</ul>
        </div>

        ${detallesHTML}

        ${resumenHTMLBorrador}

        <div class="cotizacion-section">
          <div style="font-size: 12px; color:#64748b; line-height: 1.6;">
            Este es un borrador. El PDF descargado llevará marca de agua “BORRADOR”.
          </div>
        </div>
      </div>
    `;

    $("#print_cotizacion").html(fila);
  }

  function limpiarErrores(scope) {
    $(scope).find('.field-error').removeClass('field-error');
    $(scope).find('.invalid-feedback').remove();
  }

  // Inserta error después del control (o después de Tom Select)
  function mostrarErrorCampo(el, mensaje) {
    const $el = $(el);
    const isTomSelect = !!($el[0] && $el[0].tomselect);

    // marca el control
    $el.addClass('field-error');

    // si es Tom Select, marcar también el contenedor visible
    if (isTomSelect) {
      $el.next('.ts-wrapper').find('.ts-control').addClass('field-error');
    }

    // evita duplicados cerca
    // (para Tom Select el error lo ponemos después de .ts-wrapper)
    if (isTomSelect) {
      $el.next('.ts-wrapper').next('.invalid-feedback').remove();
      $el.next('.ts-wrapper').after(`<div class="invalid-feedback" style="display: block !important; color: #dc3545;">${mensaje}</div>`);
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

    // Limpia error cuando cambian (incluye Tom Select)
  $(document).on('input change', 'input, select, textarea', function () {
    const $el = $(this);
    const isTomSelect = !!($el[0] && $el[0].tomselect);
    $el.removeClass('field-error');
    $el.next('.invalid-feedback').remove();

    // limpiar contenedor visible de Tom Select
    if (isTomSelect) {
      $el.next('.ts-wrapper').find('.ts-control').removeClass('field-error');
      $el.next('.ts-wrapper').next('.invalid-feedback').remove();
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