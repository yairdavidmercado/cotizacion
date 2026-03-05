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
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="assets/css/datatables-minimal.css">
<link href="assets/css/gijgo.min.css" rel="stylesheet" type="text/css" />
<link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />

<link href="assets/css/buttons-minimal.css" rel="stylesheet">

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
          <a class="nav-link active"  onclick="show_traer_tabla_vaucher()" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Voucher</a>
        </li>
        <!-- <li class="nav-item">
          <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Buscar</a>
        </li> -->
      </ul>
      <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
          <br>
          <br>
          <button type="button" class="btn btn-success btn-sm float-right" onclick="mostrar_modal_exportar_excel()">Exportar Excel</button>
          <div class="responsive">
            <table id="tabla_vaucher" class="table table-striped table-bordered" style="width:100%">
              <thead>
                  <tr>
                      <th>Codigo</th>
                      <th>No. Reserva</th>
                      <th>Cédula</th>
                      <th>Titular</th>
                      <th>Noches</th>
                      <th>Motivo</th>
                      <th>Cantidad</th>
                      <th>Deposito</th>
                      <th></th>
                      <th></th>
                  </tr>
              </thead>
              <tbody id="body_table_cotizacion">
                  
              </tbody>
            </table>
          </div>
        </div>
        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
          
        

        </div>
      </div>
        
        
      </div>
    </div>
  </main>

<button type="button" id="brn_modal_vaucher" class="btn btn-primary" style="display:none" data-toggle="modal" data-target=".modal_vaucher">Large modal</button>

<div class="modal fade modal_vaucher" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel1" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Crear deposito</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="card mt-3">
          <div class="card-body">
            <form role="form" onsubmit="event.preventDefault(); return GuardarVaucher();" id="form_guardar" class="needs-validation">
              
              <div class="row">
                <div class="col-md-6 mb-3" id="content_id_reserva" style="display:none" >
                  <label for="lastName">No. reserva</label>
                  <input type="text" autocomplete="off" class="form-control " name="id_reserva" id="id_reserva" placeholder="" required>                  
                </div>
                <div class="col-md-6 mb-3">
                  <label for="lastName">Deposito</label>
                  <input type="text" autocomplete="off"  onkeyup="format(this)" onchange="format(this)" class="form-control " name="deposito" id="deposito" placeholder="" required>
                  <input type="hidden" id="id_cotizacion" required />                    
                </div>
                <div class="col-md-6 mb-3">
                  <label for="firstName">Método de pago</label>
                  <select style="width:100%" name="id_metodo_pago" required id="id_metodo_pago" class="form-control id_metodo_pagos">
                    <option value="">Seleccionar</option>
                  </select>
                </div>
                <div class="col-md-12 mb-3 d-flex justify-content-center">
                  <button type="submit" class="btn btn-success mr-2">Guardar Deposito</button>
                  <!-- <div class="btn btn-warning text-white">Cancelar</div> -->
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

  <button type="button" id="brn_modal_print" class="btn btn-primary" style="display:none" data-toggle="modal" data-target=".bd-example-modal-lg">Large modal</button>

<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <div id="btn_pdf">

        </div>
        <h5 class="modal-title">Previsualización de voucher</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body" id="print_cotizacion">
        
      </div>
    </div>
  </div>
</div>

<button type="button" id="modal_export_excel" class="btn btn-primary" style="display:none" data-toggle="modal" data-target=".modal_export_excel">Large modal</button>

<div class="modal fade modal_export_excel" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <div id="btn_pdf">

        </div>
        <h5 class="modal-title">Consulta por rango de fecha</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <form role="form" onsubmit="event.preventDefault(); return ExportarInformeExcel();" id="form_guardar" class="needs-validation">
          <div class="row">
            <div class="col-md-4">
              <label for="firstName">Tipo de fecha</label>
              <select style="width:100%" name="tipo_excel" required id="tipo_excel" class="form-control form-control-sm tipo_excels">
                  <option value="">Seleccionar</option>
                  <option value="1">Por fecha de expedición</option>
                  <option value="2">Por fecha de entrada</option>
                  <option value="3">Por fecha de salida</option>
              </select>
            </div>
            <div class="col-md-4" >
              <label for="lastName">Fecha inicio</label>
              <input type="text" autocomplete="off" class="form-control form-control-sm " name="fecha_ini_excel" id="fecha_ini_excel" placeholder="" required>                    
            </div>
            <div class="col-md-4">
              <label for="lastName">Fecha final</label>
              <input type="text" autocomplete="off" class="form-control form-control-sm" name="fecha_fin_excel" id="fecha_fin_excel" placeholder="" required>                 
            </div>
          </div>
          <br>
          <div class="row">
            <div class="col-md-12">
              <button class="btn btn-primary btn-sm float-right" type="submit" >Exportar</button>
            </div>
          </div>
        </form>
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
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap4.min.js"></script>
<script src="assets/js/datatables-defaults.js"></script>
<script src="assets/js/html2pdf.bundle.min.js"></script>
<script src="https://www.google.com/recaptcha/api.js" async></script>
<script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
<script src="https://momentjs.com/downloads/moment.min.js"></script>

<script>
var id_hotel = "<?php echo $_SESSION['id_hotel'] ?>";
var nombre_hotel = "<?php echo $_SESSION['nombre_hotel'] ?>";
var id_terminos = "<?php echo $_SESSION['id_terminos'] ?>";
var direccion_hotel = "<?php echo $_SESSION['direccion_hotel'] ?>";
var telefono_hotel = "<?php echo $_SESSION['telefono_hotel'] ?>";
var pais_hotel = "<?php echo $_SESSION['pais_hotel'] ?>";
var depto_hotel = "<?php echo $_SESSION['depto_hotel'] ?>";
var email_hotel = "<?php echo $_SESSION['email_hotel'] ?>";
var avatar_hotel = "<?php echo $_SESSION['avatar_hotel'] ?>";


var cod_vendedor = "<?php echo $_SESSION['codigo'] ?>";
$(function() {
  
  $("#menu_inicio").removeClass("active");
  $(".menu_principal").removeClass("active");
  $("#menu_vauche").addClass("active");
  $("#menu_nombre_hotel").addClass("active");
  traer_metodo_pago()
  show_traer_tabla_vaucher()

  $(".loader").css("display", "none")

  var today = new Date(new Date().getFullYear(), new Date().getMonth(), new Date().getDate());
  $('#fecha_ini_excel').datepicker({
      uiLibrary: 'bootstrap4',
      iconsLibrary: 'fontawesome',
      format: "yyyy-mm-dd",
      maxDate: function () {
          return $('#endDate').val();
      }
  });
  $('#fecha_fin_excel').datepicker({
      uiLibrary: 'bootstrap4',
      iconsLibrary: 'fontawesome',
      format: "yyyy-mm-dd",
      minDate: function () {
          return $('#fecha_ini_excel').val();
      }
  });

});


function GuardarVaucher() {
    
    //let form = $('#form_guardar')[0];
    //let formData = new FormData(form)
    let values = {
      id_reserva : $("#id_reserva").val(),
      id_cotizacion : $("#id_cotizacion").val(),
      deposito : $("#deposito").val().replace(/[.]/g,''),
      id_metodo_pago : $("#id_metodo_pago").val(),
      id_hotel :  id_hotel
    }
    $.ajax({
    type : 'POST',
    data: values,
    url: 'php/guardar_vauche.php',
    beforeSend: function() {
        $(".loader").css("display", "inline-block")
    },
    success: function(respuesta) {
      $(".loader").css("display", "none")
      console.log(respuesta)
      let obj = JSON.parse(respuesta)
      if (obj.success) {
        limpiar_formulario()
        traer_cotizacion($("#id_cotizacion").val())
        show_traer_tabla_vaucher()
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


  function traer_metodo_pago() {
      let values = { 
            codigo: 'traer_metodo_pago',
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
            fila += `<option value='${val.id}'>${val.nombre}</option>`
          });

          $("#id_metodo_pago").html('<option value="">Seleccionar</option>'+fila)
          
        },
        error: function() {
          $(".loader").css("display", "none")
          console.log("No se ha podido obtener la información");
        }
      });

      $("#id_metodo_pago").select2();
    
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
  function ExportarInformeExcel(){
    var tipo = $("#tipo_excel").val()
    var fechaini = $("#fecha_ini_excel").val()
    var fechafin = $("#fecha_fin_excel").val()
    window.location.href = 'php/reports/reporte_excel.php?tipo='+tipo+'&fechaini='+fechaini+'&fechafin='+fechafin;
  }

  function mostrar_modal_exportar_excel(){
    $("#modal_export_excel").click()
  }

  function crear_vaucher(id, id_reserva){
    if (id_reserva == null) {
      $("#content_id_reserva").show()
    }else{
      $("#content_id_reserva").hide()
    }
    $("#brn_modal_vaucher").click()
    $("#id_cotizacion").val(id)
    $("#id_reserva").val(id_reserva)
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
          const resultados = obj["resultado"] || []
          if (!Array.isArray(resultados) || resultados.length === 0) {
            $(".loader").css("display", "none")
            console.log('Sin resultado en traer_cotizacion', obj)
            return
          }

          const primera = resultados[0]
          const cod_vendedor = primera.cod_vendedor || ''
          const fecha_entrada = primera.fecha_entrada || ''
          const fecha_salida = primera.fecha_salida || ''
          const nombre_plan = primera.nombre_plan || ''
          const descripcion_plan = primera.descripcion_plan || ''
          const n_infante = parseInt(primera.n_infante || 0)
          const nochePrimera = primera.noche
          const deposito = primera.deposito == null ? 0 : parseInt(primera.deposito || 0)
          const fecha_vaucher = primera.vaucher_fecha_crea || ''
          const id_vaucher = primera.id_vaucher || ''
          const n_reserva = primera.n_reserva || ''

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
          const getTarifaForCot = (cot) => {
            const tarifa = { adult_d: 0, adult_s: 0, adult_t_c: 0, child: 0 }
            if (cot && cot.info_tarifa) {
              tarifa.adult_d = parseInt(cot.info_tarifa.adult_d || 0)
              tarifa.adult_s = parseInt(cot.info_tarifa.adult_s || 0)
              tarifa.adult_t_c = parseInt(cot.info_tarifa.adult_t_c || 0)
              tarifa.child = parseInt(cot.info_tarifa.child || 0)
              return tarifa
            }
            if (Array.isArray(obj["info_tarifa"]) && obj["info_tarifa"].length) {
              const t = obj["info_tarifa"][0]
              tarifa.adult_d = parseInt(t.adult_d || 0)
              tarifa.adult_s = parseInt(t.adult_s || 0)
              tarifa.adult_t_c = parseInt(t.adult_t_c || 0)
              tarifa.child = parseInt(t.child || 0)
            }
            return tarifa
          }

          const getPlanesForCot = (cot) => {
            if (cot && Array.isArray(cot.info_planes)) return cot.info_planes
            if (Array.isArray(obj["info_planes"])) return obj["info_planes"]
            return []
          }

          const tipoLabel = (t) => (t == '1' ? 'Alojamiento' : (t == '2' ? 'Tour' : 'Alquiler'))

          const buildTbodyDetalle = (tipo_servicio, n_child, n_adult_s, n_adult_d, n_adult_t_c, tarifa) => {
            const totalchild = n_child * tarifa.child
            const totaladult_s = n_adult_s * tarifa.adult_s
            const totaladult_d = n_adult_d * tarifa.adult_d
            const totaladult_t_c = n_adult_t_c * tarifa.adult_t_c

            if (tipo_servicio == '0') {
              return `<tbody>
                        <tr>
                            <td class="center">1</td>
                            <td class="left">Niños (3-11 Años)</td>
                            <td class="center">${n_child}</td>
                            <td style="text-align: right;">$${puntosDecimales(tarifa.child)}</td>
                            <td style="text-align: right;">$${puntosDecimales(totalchild)}</td>
                        </tr>
                        <tr>
                            <td class="center">2</td>
                            <td class="left">Adultos</td>
                            <td class="center">${n_adult_s}</td>
                            <td style="text-align: right;">$${puntosDecimales(tarifa.adult_s)}</td>
                            <td style="text-align: right;">$${puntosDecimales(totaladult_s)}</td>
                        </tr>
                      </tbody>`
            }
            if (tipo_servicio == '1') {
              return `<tbody>
                        <tr>
                            <td class="center">1</td>
                            <td class="left">Niños</td>
                            <td class="center">${n_child}</td>
                            <td style="text-align: right;">$${puntosDecimales(tarifa.child)}</td>
                            <td style="text-align: right;">$${puntosDecimales(totalchild)}</td>
                        </tr>
                        <tr>
                            <td class="center">2</td>
                            <td class="left">Adultos normal</td>
                            <td class="center">${n_adult_s}</td>
                            <td style="text-align: right;">$${puntosDecimales(tarifa.adult_s)}</td>
                            <td style="text-align: right;">$${puntosDecimales(totaladult_s)}</td>
                        </tr>
                        <tr>
                            <td class="center">3</td>
                            <td class="left">Adultos dobles</td>
                            <td class="center">${n_adult_d}</td>
                            <td style="text-align: right;">$${puntosDecimales(tarifa.adult_d)}</td>
                            <td style="text-align: right;">$${puntosDecimales(totaladult_d)}</td>
                        </tr>
                        <tr>
                            <td class="center">4</td>
                            <td class="left">Adultos triple / Cuadruple</td>
                            <td class="center">${n_adult_t_c}</td>
                            <td style="text-align: right;">$${puntosDecimales(tarifa.adult_t_c)}</td>
                            <td style="text-align: right;">$${puntosDecimales(totaladult_t_c)}</td>
                        </tr>
                      </tbody>`
            }
            if (tipo_servicio == '2') {
              return `<tbody>
                        <tr>
                            <td class="center">1</td>
                            <td class="left">N° Alquiler</td>
                            <td class="center">${n_adult_s}</td>
                            <td style="text-align: right;">$${puntosDecimales(tarifa.adult_s)}</td>
                            <td style="text-align: right;">$${puntosDecimales(totaladult_s)}</td>
                        </tr>
                      </tbody>`
            }
            return `<tbody></tbody>`
          }

          let detalleCotizacionesHTML = ''
          let planesCotizacionesHTML = ''
          let terminosHTML = ''
          let subtotalGeneral = 0
          let totalGeneral = 0

          resultados.forEach((cot, idx) => {
            const cotId = cot.id || ''
            const tipo_cotizacion = cot.tipo_cotizacion
            const tipo_servicio = cot.tipo_servicio
            const nombre_motivo = cot.nombre_motivo || ''

            const n_child = parseInt(cot.n_child || 0)
            const n_adult_s = parseInt(cot.n_adult_s || 0)
            const n_adult_d = parseInt(cot.n_adult_d || 0)
            const n_adult_t_c = parseInt(cot.n_adult_t_c || 0)

            const tarifa = getTarifaForCot(cot)

            const totalchild = n_child * tarifa.child
            const totaladult_s = n_adult_s * tarifa.adult_s
            const totaladult_d = n_adult_d * tarifa.adult_d
            const totaladult_t_c = n_adult_t_c * tarifa.adult_t_c
            const subtotal = totalchild + totaladult_s + totaladult_d + totaladult_t_c

            const nocheRaw = cot.noche
            const nocheInt = parseInt(nocheRaw)
            const n_noches = (nocheRaw == "N/A" || isNaN(nocheInt) || nocheInt <= 0) ? 1 : nocheInt
            const nocheLabel = (nocheRaw == "N/A" || isNaN(nocheInt) || nocheInt <= 0) ? '1 día' : `${nocheRaw} ${nocheInt === 1 ? 'noche' : 'noches'}`
            const total = subtotal * n_noches

            subtotalGeneral += subtotal
            totalGeneral += total

            const total_pasajero = n_child + n_adult_s + n_adult_d + n_adult_t_c

            const tbodyDetalle = buildTbodyDetalle(tipo_servicio, n_child, n_adult_s, n_adult_d, n_adult_t_c, tarifa)

            let consumo = ''
            let servicios = ''
            getPlanesForCot(cot).forEach((p) => {
              if (p.tipo == 'CONSUMO') consumo += `* ${p.nombre}, `
              if (p.tipo == 'SERVICIOS') servicios += `* ${p.nombre}<br>`
            })

            detalleCotizacionesHTML += `
              <div class="col-sm-12 mt-3">
                <h6>Detalle cotización #${cotId} ${tipo_cotizacion != null ? `- ${tipoLabel(tipo_cotizacion)}` : ''}</h6>
                ${nombre_motivo ? `<div style="font-size:12px; margin-top:4px;"><b>Motivo:</b> ${nombre_motivo}</div>` : ''}
              </div>
              <div class="col-sm-12">
                <div class="table-responsive-sm">
                  <table width='100%' cellpadding='4' cellspacing='4' border='0' style="font-size:13px;">
                    <tr>
                      <td><b>FECHA INICIO</b></td>
                      <td>${cot.fecha_entrada || ''}</td>
                      <td><b>FECHA FIN</b></td>
                      <td>${cot.fecha_salida || ''}</td>
                      <td><b>DURACIÓN</b></td>
                      <td>${nocheLabel}</td>
                    </tr>
                    <tr>
                      <td><b>PLAN</b></td>
                      <td colspan="5">${cot.nombre_plan || ''}</td>
                    </tr>
                  </table>
                </div>
              </div>
              <div class="col-sm-12">
                <div class="table-responsive-sm">
                  <table class="table">
                    <thead>
                      <tr>
                        <th class="center">#</th>
                        <th>Item</th>
                        <th class="center">Cantidad</th>
                        <th style="text-align: right;">Valor unitario</th>
                        <th style="text-align: right;">Total</th>
                      </tr>
                    </thead>
                    ${tbodyDetalle}
                  </table>
                </div>
              </div>
              <div class="col-sm-12">
                <div class="table-responsive-sm">
                  <table class="table table-clear" style="width: 100%;">
                    <tbody>
                      <tr>
                        <td class="left"><strong>Subtotal</strong></td>
                        <td style="text-align: right;">$${puntosDecimales(subtotal)}</td>
                      </tr>
                      <tr>
                        <td class="left"><strong>Total</strong></td>
                        <td style="text-align: right;"><strong>$${puntosDecimales(total)}</strong></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
              <div class="col-sm-12">
                <div class="table-responsive-sm">
                  <table class="table" style="font-size:14px;font-family: 'Helvetica', 'Arial', sans-serif;">
                    <tbody>
                      <tr>
                        <td><b>Acomodación:</b></td>
                        <td colspan="3">${cot.acomodo || ''}</td>
                      </tr>
                      <tr>
                        <td><b>Descripción:</b></td>
                        <td colspan="3">${cot.descripcion_plan || ''}</td>
                      </tr>
                      <tr>
                        <td><b>Incluye:</b></td>
                        <td colspan="3">${consumo}<br><br><strong>Servicios</strong><br>${servicios}</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            `

            planesCotizacionesHTML += `
              <tr>
                <td><b>#${cotId}</b></td>
                <td>${cot.nombre_plan || ''}</td>
                <td class="text-right">${tipo_cotizacion != null ? tipoLabel(tipo_cotizacion) : ''}</td>
                <td class="text-right">$${puntosDecimales(total)}</td>
              </tr>
            `

            if (cot.terminos) {
              terminosHTML += `<p style="margin-bottom:16px;"><b>Términos cotización #${cotId}</b><br>${cot.terminos}</p>`
            }
          })

          const saldoGeneral = totalGeneral - deposito
          const nocheIntPrimera = parseInt(nochePrimera)
          const nocheLabelPrimera = (nochePrimera == "N/A" || isNaN(nocheIntPrimera) || nocheIntPrimera <= 0) ? '1 día' : nochePrimera
          const total_pasajero_primera = parseInt(primera.n_child || 0) + parseInt(primera.n_adult_s || 0) + parseInt(primera.n_adult_d || 0) + parseInt(primera.n_adult_t_c || 0)

          $("#btn_pdf").html(`<span onclick="imprimir_cotizacion('${id}')" style="text-align: right;font-size:28px;cursor:pointer;font-family: 'Helvetica', 'Arial', sans-serif;" class="mr-4"><i class="fas fa-print"></i></span>`)
              let fila = `<div class="row" style="background-color:#02317c;color:#fff">
                            <div class="col-sm-12" style="background-color:#1a2b48">
                              <h3 class="text-center">VOUCHER</h3>
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
                                    <b>No.: </b>${n_reserva}<br>
                                    <b>Fecha expe: </b>${fecha_vaucher}<br>
                                    <b>Código vendedor: </b>${cod_vendedor}<br>
                                    <b>No. Voucher: </b>${id_vaucher}
                                  </p>
                                  </td>
                                </tr>
                              </table>
                            </div>
                          </div>   
                          </div>
                          <div class="row mt-3" style="font-size:14px;font-family: 'Helvetica', 'Arial', sans-serif;">
                            <div class="col-sm-12">
                              <h6>Información del titular</h6>
                              <hr>
                            </div>
                            <div class="col-sm-12">
                              <div class="table-responsive-sm">
                                <table width='100%' cellpadding='4' cellspacing='4' border='0'>
                                  <tr>
                                    <td><b>TITULAR RESERVA</b></td>
                                    <td colspan="3" id="print_nombre_titular">${nombre_titular}</td>
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
                                    <td><b>FECHA DE ENTREGA</b></td>
                                    <td id="print_fecha_ini">${fecha_entrada}</td>
                                    <td><b>Nº NOCHE</b></td>
                                    <td>${nocheLabelPrimera}</td>
                                    <td><b>INFANTE</b></td>
                                    <td>${n_infante}</td>
                                  </tr>
                                  <tr>
                                    <td><b>FECHA DE SALIDA</b></td>
                                    <td id="print_fecha_fin">${fecha_salida}</td>
                                    <td><b>N° PERSONAS</b></td>
                                    <td>${total_pasajero_primera}</td>
                                    <td><b>TOTAL GENERAL</b></td>
                                    <td>$${puntosDecimales(totalGeneral)}</td>
                                  </tr>
                                  <tr>
                                    <td><b>DEPOSITO</b></td>
                                    <td><span style="color:green"><b>${puntosDecimales(deposito)}</b></span></td>
                                    <td><b>SALDO</b></td>
                                    <td><span style="color:red" ><b>${puntosDecimales(saldoGeneral)}</b></span></td>
                                  </tr>
                                </table>
                              </div>
                            </div>
                          </div>
                          <div class="row mt-2" style="font-size:14px;font-family: 'Helvetica', 'Arial', sans-serif;">
                            ${detalleCotizacionesHTML}
                          </div>

                          <div class="row">
                            <div class="col-lg-5 col-sm-5 ml-auto" style="font-size:14px;font-family: 'Helvetica', 'Arial', sans-serif;" id="content_subtotal">
                              <table class="table table-clear">
                                <tbody>
                                  <tr>
                                    <td class="left"><strong>Subtotal general</strong></td>
                                    <td style="text-align: right;">$${puntosDecimales(subtotalGeneral)}</td>
                                  </tr>
                                  <tr>
                                    <td class="left"><strong>Total general</strong></td>
                                    <td style="text-align: right;"><strong>$${puntosDecimales(totalGeneral)}</strong></td>
                                  </tr>
                                </tbody>
                              </table>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-sm-12">
                              <div class="table-responsive-sm">
                                <table class="table" style="font-size:14px;font-family: 'Helvetica', 'Arial', sans-serif;">
                                  <tbody>
                                    <tr>
                                      <td><b>Plan (principal): </b></td>
                                      <td id="print_nombre_plan">${nombre_plan}</td>
                                      <td class="text-right"><b>Descripción: </b></td>
                                      <td class="text-right">${descripcion_plan}</td>
                                    </tr>
                                    <tr>
                                      <td><b>Resumen</b></td>
                                      <td colspan="3">
                                        <div class="table-responsive-sm">
                                          <table width='100%' cellpadding='4' cellspacing='4' border='0'>
                                            ${planesCotizacionesHTML}
                                          </table>
                                        </div>
                                      </td>
                                    </tr>
                                  </tbody>
                                </table>
                              </div>
                            </div>
                          </div>
                          <div class="row" id="pageX" >
                            <div class="col-sm-12">
                              <div style="font-size:12px;text-align:left; margin-top:200px;font-family: 'Helvetica', 'Arial', sans-serif;" >${terminosHTML}</div>
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
    const namefile = $("#print_nombre_titular").html()+'_'+$("#print_fecha_ini").html()+'_'+$("#print_fecha_fin").html()+'_'+$("#print_nombre_plan").html()
    const opt = {
      filename: namefile+'.pdf',
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
      $("#deposito").val("").change()
      $("#id_metodo_pago").val("").change()
  }

  function show_traer_tabla_vaucher(){
    setTimeout(() => {
      traer_tabla_vaucher()
    }, 100);
  }

  function traer_tabla_vaucher(){

    if ( ! $.fn.DataTable.isDataTable('#tabla_vaucher')) {
			  dtable = $("#tabla_vaucher").DataTable({
					"ajax": {
					"url": "php/sel_recursos.php",
					"type": "POST",
					"deferRender": false,
					"data":{
            codigo:'traer_tabla_vaucher',
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
          { "data": "n_voucher"},
					{ "data": "cedula_titular"},
					{ "data": "nombre_titular"},
          { "data": "noche"},
					{ "data": "nombre_motivo"},
					{ "data": "total_vaucher"},
          { "data": "deposito"},
          { "data": ""},
          { "data": ""}
				],
				 "columnDefs": [
           {
						"targets": 7,
						"data":"",
						 render: function ( data, type, row ) {
               if (row.deposito !== null) {
                return puntosDecimales(row.deposito);
               }else{
                return  `0`;
               }
							
						 }
					},
					 {
						"targets": 8,
						"data":"",
						 render: function ( data, type, row ) {
              return  `<button class="btn btn-link" onclick="traer_cotizacion(${row.id})"><i class="fa fa-eye" aria-hidden="true"></i></button>`;
               /* if (row.deposito !== null) {
                return  `<button class="btn btn-link" onclick="traer_cotizacion(${row.id})"><i class="fa fa-eye" aria-hidden="true"></i></button>`;
               }else{
                return  ``;
               } */
							
						 }
					},
          {
						"targets": 9,
						"data":"",
						 render: function ( data, type, row ) {
							return  `<button class="btn btn-link" onclick="crear_vaucher(${row.id}, ${row.n_voucher})"><i class="fa fa-edit" aria-hidden="true"></i></button>`;
						 }
					}],
				});
			}else{
			   dtable.destroy();
         traer_tabla_vaucher();
			}

  }

  function format(input)
  {
    var num = input.value.replace(/\./g,'');
    if(!isNaN(num)){
      num = num.toString().split('').reverse().join('').replace(/(?=\d*\.?)(\d{3})/g,'$1.');
      num = num.split('').reverse().join('').replace(/^[\.]/,'');
      input.value = num;
    }
    
    else{ 
      input.value = input.value.replace(/[^\d\.]*/g,'');
    }
  }

</script>
</body>
</html>