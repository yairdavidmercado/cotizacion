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

    <link rel="canonical" href="https://getbootstrap.com/docs/4.4/examples/offcanvas/">

    <!-- Bootstrap core CSS -->
    <link rel="icon" type="image/ico" href="/gestion_pqrsdf/assets/img/ideas.ico">
<link href="assets/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">
<link rel="stylesheet" href="assets/css/ajax/bootstrap.css">
<link href="assets/css/select2.min.css" rel="stylesheet">
<link href="assets/css/bootstrap-datepicker.css" rel="stylesheet">
<link rel="stylesheet" href="assets/css/dataTables/dataTables.bootstrap4.min.css">
<link href="assets/css/gijgo.min.css" rel="stylesheet" type="text/css" />
<link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />

<meta name="theme-color" content="#563d7c">


    <style>
      body{
        width: 60%;
      }
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }

      .loader{
        position: fixed;
        left: 0px;
        top: 0px;
        width: 100%;
        height: 100%;
        z-index: 9999;
        background: url('assets/img/loader.gif') 
                    50% 50% no-repeat rgb(249,249,249);
      }

      .card {
          margin-bottom: 1.5rem
      }

      .card {
          position: relative;
          display: -ms-flexbox;
          display: flex;
          -ms-flex-direction: column;
          flex-direction: column;
          min-width: 0;
          word-wrap: break-word;
          background-color: #fff;
          background-clip: border-box;
          border: 1px solid #c8ced3;
          border-radius: .25rem
      }

      .card-header:first-child {
          border-radius: calc(0.25rem - 1px) calc(0.25rem - 1px) 0 0
      }

      .card-header {
          padding: .75rem 1.25rem;
          margin-bottom: 0;
          background-color: #f0f3f5;
          border-bottom: 1px solid #c8ced3
      }
    </style>
  </head>
  <body class="container bg-light">
  <?php require("menu.php"); ?>
  <div class="loader"></div>
  <br>
  <br>
  <main role="main">
    <div class="row">
      <div class="col-md-12 order-md-1 mt-5">
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
          <div class="card mt-3">
            <h5 class="card-header">Cotizaciones</h5>
            <div class="card-body">
              <form role="form" onsubmit="event.preventDefault(); return GuardarCotizacion();" id="form_guardar" class="needs-validation">
               
                <div class="row">
                  <div class="col-md-6 mb-3">
                  <label for="firstName">Nombre del titular</label>
                    <select style="width:100%" name="id_usuario" required id="id_usuario" onchange="detalle_titular(this.value)" class="form-control form-control-sm id_usuarios">
                      <option value="">Seleccionar</option>
                    </select>
                  </div>
                  <div class="col-md-6 mb-3">
                    <?php echo $usuarios ?>
                  </div>
                  <div class="col-md-12 mb-3" id="content_info_titular" style="display:none">
                    <div class="multi-collapse collapse show"  >
                      <div class="card card-body">
                        <div class="row">
                          <div class="col-sm-4">
                            <p for=""><b>Titular: </b><span id="txt_nombre_titular"></span></p>
                            <p for=""><b>Cédula: </b><span id="txt_cedula_titular"></span></p>
                          </div>
                          <div class="col-sm-4">
                            <p for=""><b>Teléfono: </b><span id="txt_telefono_titular"></span></p>
                            <p for=""><b>Email: </b><span id="txt_email_titular"></span></p>
                          </div>
                          <div class="col-sm-4">
                            <p for=""><b>Dirección: </b><span id="txt_direccion_titular"></span></p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6 mb-3">
                    <label for="firstName">Motivo de viaje</label>
                    <select style="width:100%" name="id_motivo" required id="id_motivo" class="form-control form-control-sm id_motivos">
                      <option value="">Seleccionar</option>
                    </select>
                  </div>
                  <div class="col-md-6 mb-3">
                    <label for="firstName">Planes</label>
                    <select style="width:100%" name="id_planes" onchange="traer_productos(this.value)" required id="id_planes" class="form-control form-control-sm id_planess">
                      <option value="">Seleccionar</option>
                    </select>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-3 mb-3">
                    <label><span >Tipo de servicio</span></label>
                    <br>
                    <div class="form-check-inline">
                      <label class="form-check-label" style='font-size:12px'>
                        <input type="radio" name="tipo_viaje" onclick="traer_tarifas(0)" required value="0" class="form-check-input" value="">Pasadía
                      </label>
                    </div>
                    <div class="form-check-inline">
                      <label class="form-check-label" style='font-size:12px'>
                        <input type="radio" name="tipo_viaje" onclick="traer_tarifas(1)" required value="1" class="form-check-input" value="">Noches
                      </label>
                    </div>
                    <div class="form-check-inline">
                      <label class="form-check-label" style='font-size:12px'>
                        <input type="radio" name="tipo_viaje" onclick="traer_tarifas(2)" required value="2" class="form-check-input" value="">Alquiler
                      </label>
                    </div>
                  </div>
                  <div class="col-md-3 mb-3">
                    <label for="firstName">Tarifa</label>
                    <select style="width:100%" name="id_tarifa" disabled required id="id_tarifa" class="form-control form-control-sm id_tarifas">
                        <option value="">Seleccionar</option>
                    </select>
                  </div>
                  <div class="col-md-3 mb-3" id="content_startDate">
                    <label for="lastName">Fecha entrada</label>
                    <input type="text" autocomplete="off" disabled class="form-control " name="startDate" id="startDate" placeholder="" required>                    
                  </div>
                  <div class="col-md-3 mb-3" id="content_endDate">
                    <label for="lastName">Fecha salida</label>
                    <input type="text" autocomplete="off" disabled class="form-control" name="endDate" id="endDate" placeholder="" required>
                    <input type="hidden" value="0" name="count_noches" id="count_noches">                    
                  </div>
                  <div class="col-md-1 mb-3">
                    <label for="lastName">Infante</label>
                    <input type="text" autocomplete="off" value="0" disabled onkeypress="return isNumber(event)" class="form-control " name="infante" id="infante" placeholder="" required>                    
                  </div>
                  <div class="col-md-2 mb-3">
                    <label for="lastName">No. Niños</label>
                    <input type="text" autocomplete="off" value="0" disabled onkeypress="return isNumber(event)" class="form-control " name="child" id="child" placeholder="" required>                    
                  </div>
                  <div class="col-md-3 mb-3">
                    <label for="lastName">No. Adultos individual</label>
                    <input type="text" autocomplete="off" value="0" disabled onkeypress="return isNumber(event)" class="form-control" name="adult_s" id="adult_s" placeholder="" required>                    
                  </div>
                  
                  <div class="col-md-3 mb-3">
                    <label for="lastName">No. Adultos doble</label>
                    <input type="text" autocomplete="off" value="0" disabled onkeypress="return isNumber(event)" class="form-control " name="adult_d" id="adult_d" placeholder="" required>                    
                  </div>
                  <div class="col-md-3 mb-3">
                    <label for="lastName">No. Adultos Tri /Cua</label>
                    <input type="text" autocomplete="off" value="0" disabled onkeypress="return isNumber(event)" class="form-control" name="adult_t_c" id="adult_t_c" placeholder="" required>                    
                  </div>
                  <div class="col-md-12 mb-3" id="content_info_tarifa" style="display:none" >
                    <div class="container-fluid">
                      <div id="ui-view" data-select2-id="ui-view">
                          <div>
                              <div class="card">
                                  <div class="card-body">
                                    <div class="row mb-4" id="detalle_tarifa">
                                      
                                    </div>
                                    <div class="table-responsive-sm">
                                      <table class="table ">
                                        <thead>
                                            <tr>
                                                <th class="center">#</th>
                                                <th>Item</th>
                                                <th class="center">Cantidad</th>
                                                <th style="text-align: right;">Valor unitario</th>
                                                <th style="text-align: right;">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbody_tarifa">
                                            
                                        </tbody>
                                      </table>
                                    </div>
                                    <div class="row">
                                      <div class="col-lg-5 col-sm-5 ml-auto" id="content_subtotal">
                                          
                                      </div>
                                    </div>
                                </div>
                              </div>
                          </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12 mb-3" id="content_info_tarifa_alquiler" style="display:none" >
                    <div class="container-fluid">
                      <div id="ui-view" data-select2-id="ui-view">
                          <div>
                              <div class="card">
                                  <div class="card-body">
                                    <div class="row mb-4" id="detalle_tarifa">
                                      
                                    </div>
                                    <div class="table-responsive-sm">
                                      <table class="table ">
                                        <thead>
                                            <tr>
                                                <th class="center">#</th>
                                                <th>Item</th>
                                                <th class="center">Cantidad</th>
                                                <th style="text-align: right;">Valor unitario</th>
                                                <th style="text-align: right;">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbody_tarifa">
                                            
                                        </tbody>
                                      </table>
                                    </div>
                                    <div class="row">
                                      <div class="col-lg-5 col-sm-5 ml-auto" id="content_subtotal">
                                          
                                      </div>
                                    </div>
                                </div>
                              </div>
                          </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12 mb-3" id="content_info_planes" style="display:none">
                    <div class="multi-collapse collapse show"  >
                      <div class="card card-body">
                        <div class="row">
                          <div class="col-sm-12">
                            <p for=""><b>Detalles del plan: </b></p>
                          </div>
                        </div>
                        <div class="row" id="content_detalles_plan">
                          
                        </div>
                      </div>
                    </div>
                    <div class="multi-collapse collapse show"  >
                      <div class="card card-body">
                        <div class="row">
                          <div class="col-sm-12">
                            <p for=""><b>Descripción: </b></p>
                          </div>
                        </div>
                        <div class="row" id="descripcion_servicios">

                        </div>
                      </div>
                    </div>
                    <div class="multi-collapse collapse show"  >
                      <div class="card card-body">
                        <div class="row">
                          <div class="col-sm-12">
                            <p for=""><b>Servicios incluidos: </b></p>
                          </div>
                        </div>
                        <div class="row" id="content_servicios_incluidos">

                        </div>
                      </div>
                    </div>
                    
                  </div>
                  <div class="col-md-12 mb-3">
                    <label for="firstName">Acomodación</label>
                    <textarea style="width:100%" name="id_acomodacion" required id="id_acomodacion" class="form-control form-control-sm id_acomodacion"></textarea>
                  </div>
                  
                  <div class="col-md-12 mb-3 d-flex justify-content-center">
                    <button type="submit" class="btn btn-success mr-2">Guardar cotización</button>
                    <!-- <div class="btn btn-warning text-white">Cancelar</div> -->
                  </div>
                </div>
              </form>
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
  </main>

  <button type="button" id="brn_modal_print" class="btn btn-primary" style="display:none" data-toggle="modal" data-target=".bd-example-modal-lg">Large modal</button>

<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <div id="btn_pdf">

        </div>
        <h5 class="modal-title">Previsualización de cotización</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body" id="print_cotizacion">
        
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
                  <select style="width:100%" name="select_pais" onchange="traer_deptos(this.value)" required id="select_pais" class="form-control form-control-sm paises">
                    <option value="">Seleccionar</option>
                  </select>
                </div>
                <div class="col-md-3 mb-3">
                  <label for="firstName">Departamento</label>
                  <select style="width:100%" name="select_deptos" id="select_deptos" class="form-control form-control-sm deptos">
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
                  <select style="width:100%" name="tipo" required id="tipo" class="form-control form-control-sm terminos_condiciones">
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

<script src="assets/js/jquery.slim.min.js" crossorigin="anonymous"></script>
<script>window.jQuery || document.write('<script src="assets/js/jquery.slim.min.js"><\/script>')</script>
<script src="assets/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/select2.full.js"></script>
<script src="assets/js/bootstrap-datepicker.min.js"></script>
<script src="assets/js/dataTables/jquery.dataTables.min.js"></script>
<script src="assets/js/dataTables/dataTables.bootstrap4.min.js"></script>
<script src="assets/js/html2pdf.bundle.min.js"></script>
<script src="https://www.google.com/recaptcha/api.js" async></script>
<script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
<script src="http://momentjs.com/downloads/moment.min.js"></script>

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
  
  $("#menu_inicio").removeClass("active");
  //traer_hotel()
  traer_titulares()
  traer_motivos()
  traer_paises()
  traer_planes(id_hotel)

  $(".loader").css("display", "none")

  var today = new Date(new Date().getFullYear(), new Date().getMonth(), new Date().getDate());
  $('#startDate').datepicker({
      uiLibrary: 'bootstrap4',
      iconsLibrary: 'fontawesome',
      minDate: today,
      format: "yyyy-mm-dd",
      language: 'es',
      maxDate: function () {
          return $('#endDate').val();
      }
  });
  $('#endDate').datepicker({
      uiLibrary: 'bootstrap4',
      iconsLibrary: 'fontawesome',
      format: "yyyy-mm-dd",
      language: 'es',
      minDate: function () {
          return $('#startDate').val();
      }
  });

  
  detalle_tarifa()

});

function detalle_tarifa() {
  setInterval(() => {

    var id_tarifa = $('#id_tarifa option:selected')
    var child = ""
    var adult_s = ""
    var adult_d = ""
    var adult_t_c = ""
    var noches = ""

    if($('input:radio[name=tipo_viaje]:checked').val() == 2){
      console.log(id_tarifa.attr("id"))
      if (id_tarifa.attr("id") !== undefined) {
        $('#content_info_tarifa').hide()
        $('#content_info_tarifa_alquiler').show()
        return false
      }

    }

    if (id_tarifa.attr("id") !== "") {
      child = id_tarifa.attr("child")
      adult_s = id_tarifa.attr("adult_s")
      adult_d = id_tarifa.attr("adult_d")
      adult_t_c = id_tarifa.attr("adult_t_c")
      validar_noches = id_tarifa.attr("noches")
    }
    var f_inicio = $('#startDate').val()
    var f_fin = $('#endDate').val()
    if (f_inicio.length > 0 && f_fin.length > 0) {

    var fechaIni = new Date(f_inicio);
    var fechaFin = new Date(f_fin);

    var diff = fechaFin - fechaIni;

    diferenciaDias = Math.floor(diff / (1000 * 60 * 60 * 24));

      var noches = diferenciaDias
    
      
      if (validar_noches == "1") {
        if (noches == 0 ) {
          $("#startDate").val("")
          $("#endDate").val("")
          $("#tbody_tarifa").html("")
          $("#content_info_tarifa").hide()
          alert("Las fecha de entrada no puede ser igual a la fecha de salida")
          return false 
        }
      }else if (validar_noches == "0") {
        if (noches > 0 ) {
          $("#startDate").val("")
          $("#endDate").val("")
          $("#tbody_tarifa").html("")
          $("#content_info_tarifa").hide()
          alert("La fecha de entrada debe ser igual a la fecha de salida ")
          return false 
        }
      }
      var children = $("#infante").val()
      var inputchild = $("#child").val()
      var inputadult_s = $("#adult_s").val()
      var inputadult_d = $("#adult_d").val()
      var inputadult_t_c = $("#adult_t_c").val()

      var totalchild = parseInt( inputchild )* parseInt( child )
      var totaladult_s = parseInt( inputadult_s )* parseInt( adult_s )
      var totaladult_d = parseInt( inputadult_d )* parseInt( adult_d )
      var totaladult_t_c = parseInt( inputadult_t_c )* parseInt( adult_t_c )

      if ( $('#id_tarifa').val() == "" || $.trim(inputchild).length < 1 || $.trim(children).length < 1 || $.trim(inputadult_s).length < 1 || $.trim(inputadult_d).length < 1 || $.trim(inputadult_t_c).length < 1 ) {
        $("#content_info_tarifa").hide()
        $("#detalle_tarifa").html("")
        return false
      }

      var total_pasajero = parseInt( inputchild )+parseInt( inputadult_s )+parseInt( inputadult_d )+parseInt( inputadult_t_c)
      var infante = children == "0" ? "No": "Si"
      var n_noches = noches == "0" ? "N/A": noches
      
      $("#detalle_tarifa").html(`<div class="col-sm-4">
                                      <h6 class="mb-3">No. noches: <strong id="cantidad_noches">${n_noches}</strong></h6>
                                  </div>
                                  <div class="col-sm-4">
                                      <h6 class="mb-3">No. Pasajeros: <strong>${total_pasajero}</strong></h6>
                                  </div>
                                  <div class="col-sm-4">
                                      <h6 class="mb-3">Infante: <strong>${infante}</strong></h6>
                                  </div>`)

      $("#content_info_tarifa").show()
      $("#tbody_tarifa").html(`<tr>
                                    <td class="center">1</td>
                                    <td class="left">Niños</td>
                                    <td class="center">${inputchild}</td>
                                    <td style="text-align: right;">$${puntosDecimales(child)}</td>
                                    <td style="text-align: right;">$${puntosDecimales(totalchild)}</td>
                                </tr>
                                <tr>
                                    <td class="center">2</td>
                                    <td class="left">Adultos sencilla</td>
                                    <td class="center">${inputadult_s}</td>
                                    <td style="text-align: right;">$${puntosDecimales(adult_s)}</td>
                                    <td style="text-align: right;">$${puntosDecimales(totaladult_s)}</td>
                                </tr>
                                <tr>
                                    <td class="center">3</td>
                                    <td class="left">Adultos dobles</td>
                                    <td class="center">${inputadult_d}</td>
                                    <td style="text-align: right;">$${puntosDecimales(adult_d)}</td>
                                    <td style="text-align: right;">$${puntosDecimales(totaladult_d)}</td>
                                </tr>
                                <tr>
                                    <td class="center">4</td>
                                    <td class="left">Adultos triple / Cuadruple</td>
                                    <td class="center">${inputadult_t_c}</td>
                                    <td style="text-align: right;">$${puntosDecimales(adult_t_c)}</td>
                                    <td style="text-align: right;">$${puntosDecimales(totaladult_t_c)}</td>
                                </tr>`)
                                noches = validar_noches == "0" ? "1": noches
                                var subtotal = totalchild+totaladult_s+totaladult_d+totaladult_t_c
                                var total = subtotal * parseInt(noches)
                                $("#content_subtotal").html(`<table class="table table-clear">
                                                                <tbody>
                                                                    <tr>
                                                                        <td class="left">
                                                                            <strong>Valor tour/alquiler</strong>
                                                                        </td>
                                                                        <td style="text-align: right;" id="subtotal">$${puntosDecimales(subtotal)}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="left">
                                                                            <strong>Total tour/alquiler</strong>
                                                                        </td>
                                                                        <td style="text-align: right;">
                                                                            <strong>$${puntosDecimales(total)}</strong>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>`)
      
    }
  }, 100);
  
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
        alert(obj.message)
        limpiar_formulario_usuarios()
        traer_titulares()
       
      }else{
        alert(obj.message)
      }

    },
    error: function(e) {
      $(".loader").css("display", "none")
      console.log("No se ha podido obtener la información"+e);
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
          console.log("No se ha podido obtener la información");
        }
      });

      /* $("#select_pais").select2({
          dropdownParent: $('#crear_titular_modal')
      }); */
    
  }

function traer_deptos(id) {

if ( id.length < 1) {
  $("#select_deptos").html('<option value="">Seleccionar</option>').select2();
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
      console.log("No se ha podido obtener la información");
    }
  });

  /* $("#select_deptos").select2({
        dropdownParent: $('#crear_titular_modal')
  }); */

}

function detalle_titular(value) {
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

function GuardarCotizacion() {
    
    //let form = $('#form_guardar')[0];
    //let formData = new FormData(form)
    let values = {
      cod_vendedor : cod_vendedor,
      n_infante : $("#infante").val(),
      n_child :  $("#child").val(),
      n_adult_s :  $("#adult_s").val(),
      n_adult_d :  $("#adult_d").val(),
      n_adult_t_c :  $("#adult_t_c").val(),
      id_terminos :  $("#id_planes option:selected").data('id_terminos'),
      id_hotel :  id_hotel,
      id_titular :  $("#id_usuario").val(),
      id_tarifa :  $("#id_tarifa").val(),
      id_plan :  $("#id_planes").val(),
      id_motivo :  $("#id_motivo").val(),
      noche :  $("#cantidad_noches").text(),
      acomodo :  $("#id_acomodacion").val(),
      fecha_entrada :  $("#startDate").val(),
      fecha_salida :  $("#endDate").val(),
      acomod : $("#id_acomodacion").val(), 
    }
    $.ajax({
    type : 'POST',
    data: values,
    url: 'php/guardar_cotizacion.php',
    beforeSend: function() {
        $(".loader").css("display", "inline-block")
    },
    success: function(respuesta) {
      $(".loader").css("display", "none")
      console.log(respuesta)
      let obj = JSON.parse(respuesta)
      if (obj.success) {
        limpiar_formulario()
        traer_cotizacion(obj.id)
        //alert("Su PQRSDF se ha enviado correctamente, Revisa en la bandeja de entrada o por seguridad de su servidor de correo en spam o correos no deseados.")
        //window.location.href = 'pqrsdf.php';
      }else{
        alert(obj.message)
      }

    },
    error: function(e) {
      $(".loader").css("display", "none")
      console.log("No se ha podido obtener la información"+e);
    }
  });
    
  }


  function traer_hotel() {
      let values = { 
            codigo: 'traer_hotel',
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
            fila += `<option value='${val.id}' nombre='${val.nombre}' pais='${val.pais}' depto='${val.depto}' telefono='${val.telefono}' ciudad='${val.ciudad}' email='${val.email}'>${val.nombre}</option>`
          });

          $("#id_hotel").html('<option value="">Seleccionar</option>'+fila)
          
        },
        error: function() {
          $(".loader").css("display", "none")
          console.log("No se ha podido obtener la información");
        }
      });

      $("#id_hotel").select2();
    
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

      $("#id_usuario").select2();
    
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

          $("#id_motivo").html('<option value="">Seleccionar</option>'+fila)
          
        },
        error: function() {
          $(".loader").css("display", "none")
          console.log("No se ha podido obtener la información");
        }
      });

      $("#id_motivo").select2();
    
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

          $("#id_planes").html('<option value="">Seleccionar</option>'+fila)
          
        },
        error: function() {
          $(".loader").css("display", "none")
          console.log("No se ha podido obtener la información");
        }
      });

      $("#id_planes").select2();
    
  }

  function traer_productos(id_plan, descripcion) {
    validar_plan()
   
    $("#content_info_planes").hide()
    var elem = $("#id_planes option:selected")
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
            $("#content_info_planes").show()
            $.each(obj["resultado"], function( index, val ) {
              if (val.tipo == 'CONSUMO') {
                fila += `<div class="col-sm-4">
                        <p for=""><b>*</b> ${val.nombre}</p>
                      </div>`
              }

              if (val.tipo == 'SERVICIOS') {
                fila2 += `<div class="col-sm-4">
                        <p for=""><b>*</b> ${val.nombre}</p>
                      </div>`
              }
            
          });
            
          }

          $("#content_detalles_plan").html(fila)
          $("#content_servicios_incluidos").html(fila2)
          $("#descripcion_servicios").html(`<div class="col-sm-4">${descripcion}</div>`)
          
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
          let nombre_motivo = obj["resultado"][0]["nombre_motivo"]
          let terminos = obj["resultado"][0]["terminos"]

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

          let total = subtotal * parseInt(n_noches)
          $("#btn_pdf").html(`<span onclick="imprimir_cotizacion('${id}')" style="text-align: right;font-size:28px;cursor:pointer" class="mr-4"><i class="fas fa-print"></i></span>`)
              let fila = `<div class="row" style="background-color:#02317c;color:#fff">
                            <div class="col-sm-12" style="background-color:#1a2b48">
                              <h3 class="text-center">COTIZACIÓN</h3>
                              <p class="text-center">Cotización valida por 24 HRS</p>
                            </div>
                          <div class="col-sm-12">
                            <div class="table-responsive-sm">
                              <table width='100%' cellpadding='4' cellspacing='4' border='0'>
                                <tr>
                                  <td style="width: 200px"><img src="${avatar_hotel}" width="70%" style="border-radius: 20%;"></td>
                                  <td>
                                    <p>${nombre_hotel}<br>
                                    ${telefono_hotel}<br>
                                    ${direccion_hotel}<br>
                                    ${pais_hotel} - ${depto_hotel}
                                    </p>
                                  </td>
                                  <td class="text-right">
                                    <p>
                                    <b>No.: </b>${id}<br>
                                    <b>Fecha expe: </b>${fecha_expedicion}<br>
                                    <b>Código vendedor: </b>${cod_vendedor}
                                  </p>
                                  </td>
                                </tr>
                              </table>
                            </div>
                          </div>   
                          </div>
                          <div class="row mt-3" style="font-size:12px">
                            <div class="col-sm-12">
                              <h6>Información del titular</h6>
                              <hr>
                            </div>
                            <div class="col-sm-12">
                              <div class="table-responsive-sm">
                                <table width='100%' cellpadding='4' cellspacing='4' border='0'>
                                  <tr>
                                    <td><b>TITULAR RESERVA</b></td>
                                    <td colspan="3">${nombre_titular}</td>
                                    <td><b>EMAIL</b></td>
                                    <td>${email}</td>
                                  </tr>
                                  <tr>
                                    <td><b>PROCEDENCIA</b></td>
                                    <td colspan="3">${direccion} ${pais} ${depto} ${ciudad}</td>
                                    <td><b>CELULAR</b></td>
                                    <td>${telefono}</td></td>
                                  </tr>
                                  <tr>
                                    <td><b>FECHA DE ENTRADA</b></td>
                                    <td>${fecha_entrada}</td>
                                    <td><b>Nº NOCHE</b></td>
                                    <td>${noche}</td>
                                    <td><b>INFANTE</b></td>
                                    <td>${n_infante}</td>
                                  </tr>
                                  <tr>
                                    <td><b>FECHA DE SALIDA</b></td>
                                    <td>${fecha_salida}</td>
                                    <td><b>N° PERSONAS</b></td>
                                    <td>${total_pasajero}</td>
                                    <td><b>MOTIVO DE VIAJE</b></td>
                                    <td>${nombre_motivo}</td>
                                  </tr>
                                </table>
                              </div>
                            </div>
                            <div class="col-sm-12 mt-3">
                              <h6>Detalles</h6>
                            </div>
                            <div class="col-sm-12">
                              <div class="table-responsive-sm">
                                <table class="table ">
                                  <thead>
                                      <tr>
                                          <th class="center">#</th>
                                          <th>Item</th>
                                          <th class="center">Cantidad</th>
                                          <th style="text-align: right;">Valor unitario</th>
                                          <th style="text-align: right;">Total</th>
                                      </tr>
                                  </thead>

                                  <tbody id="tbody_tarifa_modal">
                                    <tr>
                                        <td class="center">1</td>
                                        <td class="left">Niños</td>
                                        <td class="center">${n_child}</td>
                                        <td style="text-align: right;">$${puntosDecimales(tarifa_child)}</td>
                                        <td style="text-align: right;">$${puntosDecimales(totalchild)}</td>
                                    </tr>
                                    <tr>
                                        <td class="center">2</td>
                                        <td class="left">Adultos normal</td>
                                        <td class="center">${n_adult_s}</td>
                                        <td style="text-align: right;">$${puntosDecimales(tarifa_adult_s)}</td>
                                        <td style="text-align: right;">$${puntosDecimales(totaladult_s)}</td>
                                    </tr>
                                    <tr>
                                        <td class="center">3</td>
                                        <td class="left">Adultos dobles</td>
                                        <td class="center">${n_adult_d}</td>
                                        <td style="text-align: right;">$${puntosDecimales( tarifa_adult_d)}</td>
                                        <td style="text-align: right;">$${puntosDecimales(totaladult_d)}</td>
                                    </tr>
                                    <tr>
                                        <td class="center">4</td>
                                        <td class="left">Adultos triple / Cuadruple</td>
                                        <td class="center">${n_adult_t_c}</td>
                                        <td style="text-align: right;">$${puntosDecimales(tarifa_adult_t_c)}</td>
                                        <td style="text-align: right;">$${puntosDecimales(totaladult_t_c)}</td>
                                    </tr>
                                  </tbody>
                                </table>
                              </div>
                            </div>   
                          </div>
                          <div class="row">
                            <div class="col-lg-5 col-sm-5 ml-auto" style="font-size:12px" id="content_subtotal">
                              <table class="table table-clear">
                                  <tbody>
                                      <tr>
                                          <td class="left">
                                              <strong>Valor ${noche_tour}</strong>
                                          </td>
                                          <td style="text-align: right;" id="subtotal">$${puntosDecimales(subtotal)}</td>
                                      </tr>
                                      <tr>
                                          <td class="left">
                                              <strong>Total ${noche_tour}</strong>
                                          </td>
                                          <td style="text-align: right;">
                                              <strong>$${puntosDecimales(total)}</strong>
                                          </td>
                                      </tr>
                                  </tbody>
                              </table>
                                
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-sm-12">
                              <div class="table-responsive-sm">
                                <table class="table"  style="font-size:12px">
                                  <tbody>
                                    <tr>
                                      <td ><b>Plan: </b></td>
                                      <td>${nombre_plan}</td>
                                      <td class="text-right"><b>Descripción: </b></td>
                                      <td class="text-right">${descripcion_plan}</td>
                                    </tr>
                                    <tr>
                                      <td><b>Acomodación: </b></td>
                                      <td  colspan="2">${acomodo}</td>
                                      <td class="text-right" >
                                      ${consumo}<br><br>
                                      <strong>Servicios</strong><br>
                                      ${servicios}
                                      </td>
                                    </tr>
                                  </tbody>
                                </table>
                              </div>
                            </div>
                          </div>
                          <div class="row" id="pageX" >
                            <div class="col-sm-12">
                              <p style="font-size:12px;text-align:left; margin-top:200px" >${terminos}</p>
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


  function traer_tarifas(tipo) {
    var tipo_plan = $("#id_planes").val()
    if (tipo_plan == "") {
      alert("por favor selecciona el tipo de plan")
      $("input:radio").prop('checked', false);
      return false
    }
    setInterval(() => {
      
    }, 100);

    $("#id_tarifa").prop('disabled',false);
    $("#child").prop('disabled',false);
    $("#adult_s").prop('disabled',false);
    $("#adult_d").prop('disabled',false);
    $("#adult_t_c").prop('disabled',false);
    $("#startDate").prop('disabled',false);
    $("#endDate").prop('disabled',false);
    $("#infante").prop('disabled',false);
    
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
            $("input:radio[name='tipo_viaje']").prop('checked',false);
            $("#id_tarifa").val("").change("").prop('disabled',true);
            $("#child").val("").prop('disabled',true);
            $("#adult_s").val("").prop('disabled',true);
            $("#adult_d").val("").prop('disabled',true);
            $("#adult_t_c").val("").prop('disabled',true);
            $("#startDate").val("").prop('disabled',true);
            $("#endDate").val("").prop('disabled',true);

            alert("Usted no tiene tarifas parametrizadas para este tipo de viaje")
            return false
            
          } 
          $.each(obj["resultado"], function( index, val ) {
            fila += `<option value='${val.id}' id='${val.id}' nombre='${val.nombre}' child='${val.child}' adult_s='${val.adult_s}' adult_d='${val.adult_d}' noches='${val.noches}' adult_t_c='${val.adult_t_c}' noches='${val.noches}'>${val.nombre}</option>`
          });

          $("#id_tarifa").html('<option value="">Seleccionar</option>'+fila)
          
        },
        error: function() {
          $(".loader").css("display", "none")
          console.log("No se ha podido obtener la información");
        }
      });

      $("#id_tarifa").select2();
    
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
  }

  function validar_plan(){
      $("input:radio").prop('checked', false);
      $("#infante").val("0").prop('disabled',true)
      $("#child").val("0").prop('disabled',true)
      $("#adult_s").val("0").prop('disabled',true)
      $("#adult_d").val("0").prop('disabled',true)
      $("#adult_t_c").val("0").prop('disabled',true)
      $("#id_tarifa").val("").change().prop('disabled',true)
      $("#cantidad_noches").text("")
      $("#startDate").val("").prop('disabled',true)
      $("#endDate").val("").prop('disabled',true)
      $("#tbody_tarifa").html("")
      $("#content_subtotal").html("")
      $("#content_info_tarifa").hide()
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
/* 					"dataSrc": function (data) {	
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

</script>
</body>
</html>