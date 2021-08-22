<?php
// start a session
session_start();
 if (!isset($_SESSION['id'])) {
    header ("Location:index.php"); 
 }

 if (!isset($_SESSION['id_hotel'])) {
    header ("Location:welcome.php"); 
  }
// manipulate session variables
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
          <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Buscar</a>
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
                    <button class="btn btn-link btn-sm float-right">Crear titular</button>
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
                    <label><span style="font-size:12px">Tipo de viaje</span></label>
                    <br>
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input type="radio" name="tipo_viaje" onclick="traer_tarifas(0)" required value="0" class="form-check-input" value="">Pasadía
                      </label>
                    </div>
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input type="radio" name="tipo_viaje" onclick="traer_tarifas(1)" required value="1" class="form-check-input" value="">Por noche
                      </label>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6 mb-3">
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
                    <input type="text" autocomplete="off" disabled onkeypress="return isNumber(event)" class="form-control " name="infante" id="infante" placeholder="" required>                    
                  </div>
                  <div class="col-md-2 mb-3">
                    <label for="lastName">No. Niños</label>
                    <input type="text" autocomplete="off" disabled onkeypress="return isNumber(event)" class="form-control " name="child" id="child" placeholder="" required>                    
                  </div>
                  <div class="col-md-3 mb-3">
                    <label for="lastName">No. Adultos Simple</label>
                    <input type="text" autocomplete="off" disabled onkeypress="return isNumber(event)" class="form-control" name="adult_s" id="adult_s" placeholder="" required>                    
                  </div>
                  
                  <div class="col-md-3 mb-3">
                    <label for="lastName">No. Adultos doble</label>
                    <input type="text" autocomplete="off" disabled onkeypress="return isNumber(event)" class="form-control " name="adult_d" id="adult_d" placeholder="" required>                    
                  </div>
                  <div class="col-md-3 mb-3">
                    <label for="lastName">No. Adultos Tri /Cua</label>
                    <input type="text" autocomplete="off" disabled onkeypress="return isNumber(event)" class="form-control" name="adult_t_c" id="adult_t_c" placeholder="" required>                    
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
                  <div class="col-md-6 mb-3">
                    <label for="firstName">Planes</label>
                    <select style="width:100%" name="id_planes" onchange="traer_productos(this.value)" required id="id_planes" class="form-control form-control-sm id_planess">
                      <option value="">Seleccionar</option>
                    </select>
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
        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">...</div>
      </div>
        
        
      </div>
    </div>
  </main>

  <!-- Large modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">Large modal</button>

<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      ...
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
<script src="https://www.google.com/recaptcha/api.js" async></script>
<script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
<script src="http://momentjs.com/downloads/moment.min.js"></script>

<script>
var id_hotel = "<?php echo $_SESSION['id_hotel'] ?>"
var cod_vendedor = "<?php echo $_SESSION['codigo'] ?>"
$(function() {
  traer_cotizacion("5")
  
  $("#menu_inicio").removeClass("active");
  //traer_hotel()
  traer_titulares()
  traer_motivos()
  traer_planes(id_hotel)

  $(".loader").css("display", "none")

  var today = new Date(new Date().getFullYear(), new Date().getMonth(), new Date().getDate());
  $('#startDate').datepicker({
      uiLibrary: 'bootstrap4',
      iconsLibrary: 'fontawesome',
      minDate: today,
      format: "yyyy-mm-dd",
      maxDate: function () {
          return $('#endDate').val();
      }
  });
  $('#endDate').datepicker({
      uiLibrary: 'bootstrap4',
      iconsLibrary: 'fontawesome',
      format: "yyyy-mm-dd",
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
                                    <td class="left">Adultos simple</td>
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
                                                                            <strong>Valor por noche</strong>
                                                                        </td>
                                                                        <td style="text-align: right;" id="subtotal">$${puntosDecimales(subtotal)}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="left">
                                                                            <strong>Total por noches</strong>
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
            fila += `<option value='${val.id}' nombre='${val.nombre1} ${val.apellido1} ${val.apellido2}' pais='${val.pais}' depto='${val.depto}' telefono='${val.telefono}' ciudad='${val.ciudad}' email='${val.email}' cedula='${val.cedula}'>${val.cedula} - ${val.nombre1} ${val.apellido1} ${val.apellido2}</option>`
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
            fila += `<option value='${val.id}' descripcion='${val.descripcion}'>${val.nombre}</option>`
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
          if (obj["resultado"]. length > 0) {
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
          console.log(respuesta)
          return false
          $(".loader").css("display", "none")
          let obj = JSON.parse(respuesta)
          let fila = ''
          $.each(obj["resultado"], function( index, val ) {
            fila += `<option value='${val.id}' descripcion='${val.descripcion}'>${val.nombre}</option>`
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


  function traer_tarifas(tipo) {

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
            parametro2: tipo
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

</script>
</body>
</html>