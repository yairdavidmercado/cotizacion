<?php
// start a session
session_start();
 if (!isset($_SESSION['idUser'])) {
    header ("Location:index.php"); 
 }else if ($_SESSION['Tipo_persona'] == 1) {
  header ("Location:pqrsdf.php");
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
    <title>Glosas</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.4/examples/offcanvas/">

    <!-- Bootstrap core CSS -->
<link rel="icon" type="image/ico" href="/gestion_pqrsdf/assets/img/ideas.ico">
<link href="/gestion_pqrsdf/assets/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">
<link rel="stylesheet" href="/gestion_pqrsdf/assets/css/ajax/bootstrap.css">
<link href="assets/css/select2.min.css" rel="stylesheet">
<link href="assets/css/bootstrap-datepicker.css" rel="stylesheet">
<link rel="stylesheet" href="/gestion_pqrsdf/assets/css/dataTables/dataTables.bootstrap4.min.css">
<link href="/gestion_pqrsdf/assets/css/gijgo.min.css" rel="stylesheet" type="text/css" />

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
        background: url('/gestion_pqrsdf/assets/img/loader.gif') 
                    50% 50% no-repeat rgb(249,249,249);
      }
    </style>
  </head>
  <body class="bg-light mx-auto">
  <?php require("menu.php"); ?>
  <div class="loader"></div>
  <br>
  <br>
  <main role="main" class="container py-5">
    <div class="row">
      <div class="col-md-12 order-md-1">
      <div class="float-right"><img src="assets/img/logos.png" width="300px" alt="" srcset=""></div>
        <h2 class="py-3 mb-3">Bienvenido</h2>
        <p class="py-2 text-justify">Si desea interponer una Petición, Queja, Reclamo, Sugerencias, Denuncias o Felicitación o si desea radicar Glosas o Recobros con el fin de ser atendida por nuestra institución, por favor seleccione a continuación alguna de las siguientes opciones:</p>
        <div class="card">
            <div class="card-header">
              <h5>Información de Glosas</h6>
            </div>
            <div class="card-body">
              <form role="form" onsubmit="event.preventDefault(); return GuardarSolicitud();" id="form_guardar" class="needs-validation">
                  <div class="row">
                    <div class="col-md-6 mb-3">
                      <label for="tipo_solicitud">Tipo de solicitud</label>
                      <select style="width:100%" name="tipo_solicitud" required id="tipo_solicitud" class="form-control tipo_solicitudes">
                        <option selected value="">Seleccionar</option>
                      </select>
                    </div>
                    <div style="display:none" class="col-md-6 mb-3">
                    <label for="firstName">Sedes</label>
                      <select style="width:100%" name="sede" value="1" required id="sede" class="form-control sedes">
                        <option value="61">Seleccionar</option>
                      </select>
                    </div>
                    <div style="display:none" class="col-md-6 mb-3">
                      <label for="firstName">Área</label>
                      <select name="area" required id="area" value="1" class="form-control areas">
                        <option value="1">Seleccionar</option>
                      </select>
                    </div>
                    <div class="col-md-6 mb-3">
                      <label for="firstName" style="font-size:12px;">¿ Usted desea ser notificado del trámite de esta solicitud ?</label>
                      <select name="notificar" required id="notificar" onchange="notificaciones(this.value)" class="form-control ">
                        <option value="">Seleccionar</option>
                        <option value="SI">SI</option>
                        <option value="NO">NO</option>
                      </select>
                    </div>

                    <div class="col-md-12 mb-3" style="background-color:#f0f0f0; display:none;">
                      <label for="firstName" style="font-size:12px;">Seleccione el medio por el cual desea ser notificado de esta solicitud:</label>
                      <br>
                      <label for="firstName" style="font-size:12px;">Usted debe diligenciar la dirección o correo electrónico</label>
                      <div class="row">
                        <div class="col-sm-1">
                          <input name="tipo_notificacion" onclick="tipoEnvio('correo')" value="correo" disabled required type="radio">
                        </div>
                        <div class="col-md-3">
                        <label for="firstName" style="font-size:12px;">¿Correo electrónico?</label>
                        </div>
                        <div class="col-md-8">
                          <input class="form-control input-sm" disabled required name="text_notificacion" id="id_text_email" type="email">
                        </div>
                        <div class="col-sm-1">
                          <input name="tipo_notificacion" onclick="tipoEnvio('direccion')" value="direccion" disabled required type="radio">
                        </div>
                        <div class="col-md-3">
                        <label for="firstName" style="font-size:12px;">¿Dirección?</label>
                        </div>
                        <div class="col-md-8">
                          <input class="form-control input-sm" disabled required name="text_notificacion" id="id_text_direccion" type="text">
                        </div>
                      </div>
                      <label style="font-size:11px;" for="">Nota: Señor usuario no existen costos de reproducción asociados a la respuesta de su solicitud</label>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div style="display:none" class="col-md-3 mb-3">
                      <label for="lastName">Fecha del suceso</label>
                      <input type="text" class="form-control fecha" name="fecha_suceso" id="fecha_suceso" placeholder="">                    
                    </div>
                    <div class="col-md-12 mb-3">
                      <label for="lastName">Asunto</label>
                      <input type="text" class="form-control datepicker" name="asunto" id="asunto" placeholder="" required>                    
                    </div>
                    <div class="col-md-12 mb-3">
                      <label for="lastName">Resumen del tipo de solicitud</label>
                      <textarea class="form-control" required name="descripcion" id="descripcion"></textarea>
                    </div>
                    <div class="col-md-12 mb-3 d-flex justify-content-center">
                      <span id="btn-adjuntar-soporte" class="btn btn-sm btn-warning text-white">
                        <i class="fa fa-upload"></i> 
                        <input id="soporte_adjunto" name="soporte_adjunto" type="file">
                      </span>
                      <span class="text-danger d-flex justify-content-center text-validation-file"></span>
                    </div>
                    <div class="col-md-12 mb-3">
                      <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" required id="acepto">
                        <label class="custom-control-label text-justify" for="acepto">
                          Acepta el manejo de la información recopilada para fines relacionados con el objeto social de nuestra empresa, según la Ley 1581 de 2012 y a lo previsto en el artículo 10 del Decreto 1377 de 2013
                        </label>
                      </div>
                    </div>
                    <div class="col-md-12 mb-3">
                      <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" required id="certifico">
                        <label class="custom-control-label text-justify" for="certifico">
                          Certifico que el correo electrónico ingresado en mis datos personales se encuentra vigente, de igual manera autorizo a la empresa social del estado E.S.E VIDASINU para el envío de la respuesta a mi solicitud por este medio.
                        </label>
                      </div>
                    </div>
                    <div class="col-md-12 mb-3 d-flex justify-content-center">
                        <div class="g-recaptcha" data-sitekey="6LcFrNMUAAAAABO3lJiim0IfjTeIKxXiEeIG5Xhe"></div>
                    </div>
                    <div class="col-md-12 mb-3 d-flex justify-content-center">
                      <button type="submit" class="btn btn-success mr-2">Registrar petición</button>
                      <div class="btn btn-warning text-white">Cancelar</div>
                    </div>
                  </div>
                </form>
            </div>
        </div>
        
      </div>
    </div>
  </main>
<script src="/gestion_pqrsdf/assets/js/jquery.slim.min.js" crossorigin="anonymous"></script>
<script>window.jQuery || document.write('<script src="/gestion_pqrsdf/assets/js/jquery.slim.min.js"><\/script>')</script>
<script src="/gestion_pqrsdf/assets/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="/gestion_pqrsdf/assets/js/jquery.min.js"></script>
<script src="assets/js/select2.full.js"></script>
<script src="assets/js/bootstrap-datepicker.min.js"></script>
<script src="/gestion_pqrsdf/assets/js/dataTables/jquery.dataTables.min.js"></script>
<script src="/gestion_pqrsdf/assets/js/dataTables/dataTables.bootstrap4.min.js"></script>
<script src="https://www.google.com/recaptcha/api.js" async></script>
<script>
$(function() {
  VerEntidades()
  // VerSedes()
  // VerAreas()
  VerTipoSolicitud(2)
  //TipoIdentificacion()
  $(".loader").css("display", "none")

  $('.fecha').datepicker({
    format: "yyyy-mm-dd",
    todayHighlight: true,
    language:"es"                       
  });

  var d = new Date();
  var currMonth = d.getMonth();
  var currYear = d.getFullYear();
  var currDay = d.getDate();
  var startDate = new Date(currYear, currMonth, currDay);
  $(".fecha").datepicker("setDate", startDate)

  $("#soporte_adjunto").change(function(){
    showFileSize()
  });

});

function GuardarSolicitud() {
    
    let form = $('#form_guardar')[0];
    let formData = new FormData(form)
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
        alert("Su Glosa se ha enviado correctamente, Revisa en la bandeja de entrada o por seguridad de su servidor de correo en spam o correos no deseados.")
        window.location.href = 'glosas.php';
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

  function showFileSize() {
    var input, file;

    // (Can't use `typeof FileReader === "function"` because apparently
    // it comes back as "object" on some browsers. So just see if it's there
    // at all.)
    if (!window.FileReader) {
        bodyAppend("p", "The file API isn't supported on this browser yet.");
        $("#btn-adjuntar-soporte").removeClass("btn-primary").addClass("btn-warning")
        return;
    }

    input = document.getElementById('soporte_adjunto');
    if (!input) {
        bodyAppend("p", "Um, couldn't find the soporte_adjunto element.");
        $("#btn-adjuntar-soporte").removeClass("btn-primary").addClass("btn-warning")
    }
    else if (!input.files) {
        bodyAppend("p", "This browser doesn't seem to support the `files` property of file inputs.");
        $("#btn-adjuntar-soporte").removeClass("btn-primary").addClass("btn-warning")
    }
    else if (!input.files[0]) {
        bodyAppend("p", "Por favor seleccione un archivo");
        $("#btn-adjuntar-soporte").removeClass("btn-primary").addClass("btn-warning")
    }else if (ValidateExtension()) {
        file = input.files[0];
        var FileSize = file.size / 1024 / 1024; // in MB
        if (FileSize > 50000) {
            alert('El archivo seleccionado ha excedido los 5MB permitidos')
            $("#soporte_adjunto").val("")
            $(".text-validation-file").html("")
            $("#btn-adjuntar-soporte").removeClass("btn-primary").addClass("btn-warning")
            return false
        }else{
          $("#btn-adjuntar-soporte").removeClass("btn-warning").addClass("btn-primary")
          $(".text-validation-file").html("")
          //bodyAppend("p", "File " + file.name + " is " + file.size + " bytes in size");
        }
    }
}

function bodyAppend(tagName, innerHTML) {
    var elm;

    elm = document.createElement(tagName);
    elm.innerHTML = innerHTML;
    $("#soporte_adjunto").val("")
    $(".text-validation-file").html(elm);
}

function ValidateExtension() {
        var allowedFiles = [".doc", ".docx", ".pdf", ".png", ".jpg", ".jpeg", ".xlsx"];
        var fileUpload = document.getElementById("soporte_adjunto");
        var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(" + allowedFiles.join('|') + ")$");
        if (!regex.test(fileUpload.value.toLowerCase())) {
            alert("Cargue archivos que tengan extensiones: " + allowedFiles.join(', ') + " solamente.")
            $("#soporte_adjunto").val("")
            $(".text-validation-file").html("")
            $("#btn-adjuntar-soporte").removeClass("btn-primary").addClass("btn-warning")
            return false;
        }
        return true;
    }

    function VerEntidades() {
      let values = { 
            cod: '1',
            parametro1: "1",
            parametro2: "1"
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
        $.each(obj[0], function( index, val ) {
          fila += '<option value="'+val.cod_entidad+'">'+val.nombre_entidad+'</option>'
        });
        $(".entidades").html('<option value="">EPS</option>'+fila)
        let placeholder = "Seleccione EPS";
        $(".entidades").select2( {
                placeholder: placeholder,
            });
      },
      error: function() {
        $(".loader").css("display", "none")
        console.log("No se ha podido obtener la información");
      }
    });
    
  }

  function VerSedes() {
      let values = { 
            cod: '2',
            parametro1: "1",
            parametro2: "1"
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
        $.each(obj[0], function( index, val ) {
          fila += '<option value="'+val.id_sede+'">'+val.nombre_sede+'</option>'
        });
        $(".sedes").html('<option value="">Seleccionar</option>'+fila)
        let placeholder = "Seleccione la sede";
        $(".sedes").select2( {
            placeholder: placeholder,
        });
      },
      error: function() {
        $(".loader").css("display", "none")
        console.log("No se ha podido obtener la información");
      }
    });
    
  }

  function notificaciones(value) {
    if (value == 'SI') {
      $( "input[name*='tipo_notificacion']" ).prop( "disabled", false );
      $("#content_notificacion").prop("style", "background-color:#f0f0f0;display:block" );
    }else{
      $( "input[name*='tipo_notificacion']" ).prop( "disabled", true );
      $( "input[name*='tipo_notificacion']" ).prop( "checked", false );
      $( "input[name*='text_notificacion']" ).prop( "disabled", true );
      $( "input[name*='text_notificacion']" ).val('');
      $("#content_notificacion").prop("style", "background-color:#f0f0f0;display:none" );
    }
  }

  function tipoEnvio(value) {
    if (value == 'correo') {
      $( "#id_text_email" ).prop( "disabled", false );
      $( "#id_text_direccion" ).prop( "disabled", true );
    }else if(value == 'direccion'){
      $( "#id_text_email" ).prop( "disabled", true );
      $( "#id_text_direccion" ).prop( "disabled", false );
    }
    $( "input[name*='text_notificacion']" ).val('');
  }

  function VerTipoSolicitud(id) {
      let values = { 
            cod: '3',
            parametro1: id,
            parametro2: "1"
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
        $.each(obj[0], function( index, val ) {
          fila += '<option value="'+val.id_tramite+'">'+val.nombre_tramite+'</option>'
        });
        $(".tipo_solicitudes").html('<option value="">Seleccionar</option>'+fila)
        let placeholder = "Seleccione la sede";
        $(".tipo_solicitudes").select2( {
            placeholder: placeholder,
        });
      },
      error: function() {
        $(".loader").css("display", "none")
        console.log("No se ha podido obtener la información");
      }
    });
    
  }

  function TipoIdentificacion() {
      let values = { 
            cod: '4',
            parametro1: "1",
            parametro2: "1"
      };
      $.ajax({
      type : 'POST',
      data: values,
      url: '/gestion_pqrsdf/php/sel_recursos.php',
      beforeSend: function() {
          $(".loader").css("display", "inline-block")
      },
      success: function(respuesta) {
        $(".loader").css("display", "none")
        let obj = JSON.parse(respuesta)
        let fila = ''
        $.each(obj[0], function( index, val ) {
          fila += '<option value="'+val.conse_tipo_id+'">'+val.tipo_id+'</option>'
        });
        $(".tipo_identificaciones").html('<option value="">Seleccionar</option>'+fila)
      },
      error: function() {
        $(".loader").css("display", "none")
        console.log("No se ha podido obtener la información");
      }
    });
    
  }

  function VerAreas() {
      let values = { 
            cod: '8',
            parametro1: "1",
            parametro2: "1"
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
        $.each(obj[0], function( index, val ) {
          fila += '<option value="'+val.conse+'">'+val.nombre+'</option>'
        });
        $(".areas").html('<option value="">área</option>'+fila)
        let placeholder = "Seleccione área";
        $(".areas").select2( {
                placeholder: placeholder,
            });
      },
      error: function() {
        $(".loader").css("display", "none")
        console.log("No se ha podido obtener la información");
      }
    });
    
  }

</script>
</body>
</html>