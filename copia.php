
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
<link href="/gestion_documental/assets/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
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
        background: url('/gestion_documental/assets/img/loader.gif') 
                    50% 50% no-repeat rgb(249,249,249);
      }
    </style>
  </head>
  <body class="bg-light mx-auto">
  <div class="loader"></div>
  <main role="main" class="container py-5">
    <div class="row">
      <div class="col-md-12 order-md-1">
      <div class="float-right"><img src="assets/img/logos.png" width="300px" alt="" srcset=""></div>
        <h2 class="py-3 mb-3">Bienvenido</h2>
        <p class="py-2 text-justify">Si desea interponer una Petición, Queja, Reclamo, Sugerencias, Denuncias o Felicitación o si desea radicar Glosas o Recobros con el fin de ser atendida por nuestra institución, por favor seleccione a continuación alguna de las siguientes opciones:</p>
        <div class="card">
            <div class="card-header">
              <h5>Información Básica</h6>
            </div>
            <div class="card-body">
              <form role="form" onsubmit="event.preventDefault(); return GuardarSolicitud();" id="form_guardar" class="needs-validation">
                  <div class="row">
                    <div class="col-md-6 mb-3">
                      <label for="tipo_solicitud">Tipo de solicitud</label>
                      <select name="tipo_solicitud" required id="tipo_solicitud" class="form-control tipo_solicitudes">
                        <option value="">Seleccionar</option>
                      </select>
                    </div>
                    <div class="col-md-6 mb-3">
                    <label for="firstName">Sedes</label>
                      <select name="sede" required id="sede" class="form-control sedes">
                        <option value="">Seleccionar</option>
                      </select>
                    </div>
                    <div class="col-md-6 mb-3">
                      <label for="firstName">Área</label>
                      <select name="area" required id="area" class="form-control">
                        <option value="">Seleccionar</option>
                        <option value="MEDICINA GENERAL">MEDICINA GENERAL</option>
                        <option value="ODONTOLOGÍA">ODONTOLOGÍA</option>
                        <option value="PROMOCIÓN Y PREVENCIÓN">PROMOCIÓN Y PREVENCIÓN</option>
                        <option value="ENFERMERÍA">ENFERMERÍA</option>
                        <option value="LABORATORIO CLÍNICO">LABORATORIO CLÍNICO</option>
                        <option value="IMAGENOLOGÍA">IMAGENOLOGÍA</option>
                        <option value="ADMISIÓN O FACTURACIÓN">ADMISIÓN O FACTURACIÓN</option>
                      </select>
                    </div>
                    <div class="col-md-3 mb-3">
                      <label for="firstName">Tipo de identificación</label>
                      <select name="tipo_identificacion" required id="tipo_identificacion" class="form-control tipo_identificaciones">
                      </select>
                    </div>
                    <div class="col-md-3 mb-3">
                      <label for="lastName">Identificación</label>
                      <input type="text" class="form-control" name="identificacion" id="identificacion" placeholder="Número" required>
                    </div>
                    <div class="col-md-12 mb-3">
                      <label for="lastName">Razón social</label>
                      <input type="text" class="form-control" name="razon_social" id="razon_social" placeholder="" required>
                    </div>
                    <div class="col-md-3 mb-3">
                      <label for="lastName">Primer nombre</label>
                      <input type="text" class="form-control" name="nombre1" id="nombre1" placeholder="" required>
                    </div>
                    <div class="col-md-3 mb-3">
                      <label for="lastName">Segundo nombre</label>
                      <input type="text" class="form-control" name="nombre2" id="nombre2" placeholder="" >
                    </div>
                    <div class="col-md-3 mb-3">
                      <label for="lastName">Primer apellido</label>
                      <input type="text" class="form-control" name="apellido1" id="apellido1" placeholder="" required>
                    </div>
                    <div class="col-md-3 mb-3">
                      <label for="lastName">Segundo apellido</label>
                      <input type="text" class="form-control" name="apellido2" id="apellido2" placeholder="" >
                    </div>
                    <div class="col-md-3 mb-3">
                      <label for="lastName">Fecha de nacimiento</label>
                      <input type="text" class="form-control datepicker" name="fecha_nace" id="fecha_nace" placeholder="" required>                    
                    </div>
                    <div class="col-md-3 mb-3">
                      <label for="lastName" style="width:100%">Sexo</label>
                      <div class="form-check-inline" style="width:100%">
                        <label>
                        <input type="radio" value="M" required name="sexo"><span class="m-2">Hombre</span>
                        <input type="radio" value="F" required name="sexo"><span class="m-1">Mujer</span>
                        </label>
                      </div>
                    </div>
                    <div class="col-md-3 mb-3">
                      <label for="lastName">Correo electrónico</label>
                      <input type="email" class="form-control" name="email" id="email" placeholder="" required >
                    </div>
                    <div class="col-md-3 mb-3">
                      <label for="lastName">Teléfono</label>
                      <input type="text" class="form-control" name="telefono" id="telefono" placeholder="" >
                    </div>
                    <div class="col-md-3 mb-3">
                      <label for="lastName">Celular</label>
                      <input type="text" class="form-control" name="celular" id="celular" placeholder="" required >
                    </div>
                    <div class="col-md-3 mb-3">
                      <label for="firstName">Etnia</label>
                      <select name="etnia" required id="etnia" class="form-control">
                        <option value="">Seleccionar</option>
                        <option value="MESTIZO">MESTIZO</option>
                        <option value="MULATO">MULATO</option>
                        <option value="BLANCO">BLANCO</option>
                        <option value="ROOM">ROOM</option>
                        <option value="INDIGENA">INDIGENA</option>
                      </select>
                    </div>
                    <div class="col-md-6 mb-3">
                      <label for="firstName">Población</label>
                      <select name="poblacion" required id="poblacion" class="form-control">
                      <option value="">Seleccionar</option>
                        <option value="DISCAPACITADO">DISCAPACITADO</option>
                        <option value="REINSERTADO">REINSERTADO</option>
                        <option value="DESPLAZADO">DESPLAZADO</option>
                        <option value="VINCULADO">VINCULADO</option>
                        <option value="VICTIMA DEL CONFLICTO">VICTIMA DEL CONFLICTO</option>
                      </select>
                    </div>
                    <div class="col-md-6 mb-3">
                      <label for="firstName">EPS</label>
                      <select name="eps" required id="eps" class="form-control entidades">
                        <option value="">Seleccionar</option>
                      </select>
                    </div>
                    <div class="col-md-6 mb-3">
                      <label for="firstName">Cliclos de vida</label>
                      <select name="cliclo_vida" required id="cliclo_vida" class="form-control">
                      <option value="">Seleccionar</option>
                        <option value="PRIMERA INFANCIA">PRIMERA INFANCIA</option>
                        <option value="E INFANCIA">E INFANCIA</option>
                        <option value="ADOLECENCIA">ADOLECENCIA</option>
                        <option value="JUVENTUD">JUVENTUD</option>
                        <option value="ADULTEZ">ADULTEZ</option>
                        <option value="VEJEZ">VEJEZ</option>
                      </select>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-md-3 mb-3">
                      <label for="lastName">Fecha del suceso</label>
                      <input type="text" class="form-control datepicker" name="fecha_suceso" id="fecha_suceso" placeholder="" required>                    
                    </div>
                    <div class="col-md-9 mb-3">
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
<script src="/gestion_documental/assets/js/jquery.slim.min.js" crossorigin="anonymous"></script>
<script>window.jQuery || document.write('<script src="/gestion_documental/assets/js/jquery.slim.min.js"><\/script>')</script>
<script src="/gestion_documental/assets/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
<script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
<script src="https://www.google.com/recaptcha/api.js" async></script>
<script>
$(function() {
  VerEntidades()
  VerSedes()
  VerTipoSolicitud()
  TipoIdentificacion()
  $(".loader").css("display", "none")

  $('#fecha_nace').datepicker({
      uiLibrary: 'bootstrap4'
  });
  $('#fecha_suceso').datepicker({
      uiLibrary: 'bootstrap4'
  });

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
        if (FileSize > 5) {
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
      url: '/gestion_pqrsdf/php/sel_recursos.php',
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
        $(".entidades").html('<option value="">Seleccionar</option>'+fila)
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
      url: '/gestion_pqrsdf/php/sel_recursos.php',
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
      },
      error: function() {
        $(".loader").css("display", "none")
        console.log("No se ha podido obtener la información");
      }
    });
    
  }

  function VerTipoSolicitud() {
      let values = { 
            cod: '3',
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
          fila += '<option value="'+val.id_tramite+'">'+val.nombre_tramite+'</option>'
        });
        $(".tipo_solicitudes").html('<option value="">Seleccionar</option>'+fila)
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

</script>
</body>
</html>