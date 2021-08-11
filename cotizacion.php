<?php
// start a session
session_start();
 if (!isset($_SESSION['id'])) {
    header ("Location:index.php"); 
 }
// manipulate session variables
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.6">
    <title>PQRSF</title>

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
                    <label for="id_hotel">Hotel</label>
                    <select style="width:100%" name="id_hotel" required id="id_hotel" onchange="detalle_hotel(this.value)" class="form-control form-control-sm id_hoteles">
                      <option value="">Seleccionar</option>
                    </select>
                  </div>
                  <div class="col-md-6 mb-3">
                    <button class="btn btn-link btn-sm float-right">Crear hotel</button>
                  </div>
                  <div class="col-md-12 mb-3" id="content_info_hotel" style="display:none">
                    <div class="multi-collapse collapse show"  >
                      <div class="card card-body">
                        <div class="row">
                          <div class="col-sm-4">
                            <p for="" ><b>Hotel: </b><span id="txt_nombre_hotel"></span></p>
                          </div>
                          <div class="col-sm-4">
                            <p for=""><b>Dirección: </b><span id="txt_direccion_hotel"></span></p>
                          </div>
                          <div class="col-sm-4">
                            <p for="" ><b>Teléfono - Email: </b><span id="txt_telefono_hotel"></span></p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
               
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
                            <p for=""><b>Dirección: </b><span id="txt_direccion_titular"></span></p>
                          </div>
                          <div class="col-sm-4">
                            <p for=""><b>Teléfono - Email: </b><span id="txt_telefono_titular"></span></p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="firstName">Tarifa</label>
                    <select style="width:100%" name="id_tarifa" required id="id_tarifa" onchange="detalle_tarifa(this.value)" class="form-control form-control-sm id_tarifas">
                      <option value="">Seleccionar</option>
                    </select>
                  </div>
                  <div class="col-md-3 mb-3">
                    <label for="lastName">No. Niños</label>
                    <input type="text" autocomplete="off"  class="form-control " name="child" id="child" placeholder="" required>                    
                  </div>
                  <div class="col-md-3 mb-3">
                    <label for="lastName">No. Aultos Simple</label>
                    <input type="text" autocomplete="off" class="form-control" name="adult_s" id="adult_s" placeholder="" required>                    
                  </div>
                  <div class="col-md-3 mb-3"  style="display:none">
                    <label for="lastName">Fecha entrada</label>
                    <input type="text" autocomplete="off" onfocusout="diferencia_dias()" class="form-control " name="startDate" id="startDate" placeholder="" required>                    
                  </div>
                  <div class="col-md-3 mb-3" style="display:none">
                    <label for="lastName">Fecha salida</label>
                    <input type="text" autocomplete="off" onfocusout="diferencia_dias()" class="form-control" name="endDate" id="endDate" placeholder="" required>
                    <input type="hidden" value="0" name="count_noches" id="count_noches">                    
                  </div>
                  <div class="col-md-3 mb-3">
                    <label for="lastName">No. Aultos doble</label>
                    <input type="text" autocomplete="off" class="form-control " name="adult_d" id="adult_d" placeholder="" required>                    
                  </div>
                  <div class="col-md-3 mb-3">
                    <label for="lastName">No. Aultos Tri /Cua</label>
                    <input type="text" autocomplete="off" class="form-control" name="adult_t_c" id="adult_t_c" placeholder="" required>                    
                  </div>
                  <div class="col-md-12 mb-3" id="content_info_tarifa" >
                    <div class="multi-collapse collapse show"  >
                      <div class="card card-body">
                        <div class="row">
                          <div class="col-sm-4">
                            <p for=""><b>No. Noches: </b><span id="txt_nombre_fecha"></span></p>
                          </div>
                          <div class="col-sm-4">
                            <p for=""><b>Dirección: </b><span id="txt_direccion_fecha"></span></p>
                          </div>
                          <div class="col-sm-4">
                            <p for=""><b>Teléfono - Email: </b><span id="txt_telefono_fecha"></span></p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12 mb-3">
                    <label for="lastName">Resumen del tipo de solicitud</label>
                    <textarea class="form-control" required name="descripcion" id="descripcion"></textarea>
                  </div>
                  <div class="col-md-12 mb-3 d-flex justify-content-center">
                    <button type="submit" class="btn btn-success mr-2">Registrar petición</button>
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
$(function() {
  traer_hotel()
  traer_titulares()

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

});

function diferencia_dias() {
  setTimeout(() => {
    var f_inicio = $('#startDate').val()
    var f_fin = $('#endDate').val()
    if (f_inicio.length > 0 && f_fin.length > 0) {
      var fecha1 = moment(f_inicio);
      var fecha2 = moment(f_fin);

      console.log(fecha2.diff(fecha1, 'days'), ' dias de diferencia');
    }
  }, 100);
  
}

function detalle_hotel(value) {
  if (value !== "") {
    traer_tarifas(value)
    var elem = $("#id_hotel option:selected")
    var nombre = elem.html()
    var direccion = elem.attr("pais")+ " "+elem.attr("depto")+ " "+elem.attr("ciudad")
    var telefono = elem.attr("telefono")+ " - "+elem.attr("email")
    $("#txt_nombre_hotel").text(nombre)
    $("#txt_direccion_hotel").text(direccion)
    $("#txt_telefono_hotel").text(telefono)
   $("#content_info_hotel").show()
  }else{
    $("#content_info_hotel").hide()
    $("#id_tarifa").html('<option value="">Seleccionar</option>')
    $("#id_tarifa").select2()
  }
  
}

function detalle_titular(value) {
  if (value !== "") {
    var elem = $("#id_usuario option:selected")
    var nombre = elem.attr("nombre")
    var direccion = elem.attr("pais")+ " - "+elem.attr("depto")+ " - "+elem.attr("ciudad")
    var telefono = elem.attr("telefono")+ " - "+elem.attr("email")
    var cedula = elem.attr("cedula")
    $("#txt_nombre_titular").text(nombre)
    $("#txt_direccion_titular").text(direccion)
    $("#txt_telefono_titular").text(telefono)
    $("#txt_cedula_titular").text(cedula)
   $("#content_info_titular").show()
  }else{
    $("#content_info_titular").hide()
  }
}

function GuardarCotizacion() {
    
    let form = $('#form_guardar')[0];
    let formData = new FormData(form)
    formData.append("fecha_suceso", $("#fecha_suceso").val());
    $.ajax({
    type : 'POST',
    enctype: 'multipart/form-data',
    data: formData,
    processData: false,
    contentType: false,
    url: 'php/guardar_solicitud.php',
    beforeSend: function() {
        $(".loader").css("display", "inline-block")
    },
    success: function(respuesta) {
      $(".loader").css("display", "none")
      let obj = JSON.parse(respuesta)
      if (obj.success) {
        alert("Su PQRSDF se ha enviado correctamente, Revisa en la bandeja de entrada o por seguridad de su servidor de correo en spam o correos no deseados.")
        window.location.href = 'pqrsdf.php';
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

  function traer_tarifas(id) {
      let values = { 
            codigo: 'traer_tarifas',
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
          $.each(obj["resultado"], function( index, val ) {
            fila += `<option value='${val.id}' nombre='${val.nombre}' child='${val.child}' adult_s='${val.adult_s}' adult_d='${val.adult_d}' adult_t_c='${val.adult_t_c}'>${val.nombre}</option>`
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

</script>
</body>
</html>