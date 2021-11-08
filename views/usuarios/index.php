<?php session_start(); ?>
<?php
 if (!isset($_SESSION['id'])) {
    header ("Location://index.php"); 
 }

 if (!isset($_SESSION['id_hotel'])) {
    header ("Location:/welcome.php"); 
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

<link href="../../assets/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">
<link rel="stylesheet" href="../../assets/css/ajax/bootstrap.css">
<link href="../../assets/css/select2.min.css" rel="stylesheet">
<link href="../../assets/css/bootstrap-datepicker.css" rel="stylesheet">
<link rel="stylesheet" href="../../assets/css/dataTables/dataTables.bootstrap4.min.css">
<link href="../../assets/css/gijgo.min.css" rel="stylesheet" type="text/css" />
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
        background: url('../../assets/img/loader.gif') 
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
  <?php require("../../menu.php"); ?>
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
          <a class="nav-link" onclick="show_traer_tabla_usuarios()" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Buscar</a>
        </li>
      </ul>
      <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
          <div class="card mt-3">
            <h5 class="card-header">Usuarios</h5>
            <div class="card-body">
              <form role="form" onsubmit="event.preventDefault(); return GuardarUsuario();" id="form_guardar" class="needs-validation">
                <div class="row">
                  <div class="col-md-6 mb-3" >
                    <label for="lastName">Código</label>
                    <input type="text" autocomplete="off" class="form-control " maxLength="6" onkeypress="return isNumber(event)" name="codigo" id="codigo" placeholder="" required>                    
                  </div>
                  <div class="col-md-6 mb-3" >
                    <label for="lastName">Cédula</label>
                    <input type="text" autocomplete="off" class="form-control "  maxLength="11"  onkeypress="return isNumber(event)" name="cedula" id="cedula" placeholder="" required>                    
                  </div>
                  <div class="col-md-3 mb-3" >
                    <label for="lastName">Primer nombre</label>
                    <input type="text" autocomplete="off" class="form-control "  maxLength="255" name="nombre1" id="nombre1" placeholder="" required>                    
                  </div>
                  <div class="col-md-3 mb-3" >
                    <label for="lastName">Segundo nombre</label>
                    <input type="text" autocomplete="off" class="form-control "  maxLength="255" name="nombre2" id="nombre2" placeholder="" >                    
                  </div>
                  <div class="col-md-3 mb-3" >
                    <label for="lastName">Primer Apellido</label>
                    <input type="text" autocomplete="off" class="form-control "  maxLength="255" name="apellido1" id="apellido1" placeholder="" required>                    
                  </div>
                  <div class="col-md-3 mb-3" >
                    <label for="lastName">Segundo apellido</label>
                    <input type="text" autocomplete="off" class="form-control "  maxLength="255" name="apellido2" id="apellido2" placeholder="" >                    
                  </div>
                  <div class="col-md-6 mb-3">
                    <label for="lastName">Email</label>
                    <input type="text" autocomplete="off"  maxLength="100" class="form-control" name="email" id="email" placeholder="" required>                   
                  </div>
                  <div class="col-md-6 mb-3">
                    <label for="lastName">Teléfono</label>
                    <input type="text" autocomplete="off"  maxLength="15" onkeypress="return isNumber(event)" class="form-control " name="telefono" id="telefono" placeholder="" required>                    
                  </div>
                  <div class="col-md-3 mb-3">
                    <label for="firstName">Pais</label>
                    <select style="width:100%" name="select_pais" onchange="traer_deptos(this.value)" required id="select_pais" class="form-control form-control-sm paises">
                      <option value="">Seleccionar</option>
                    </select>
                  </div>
                  <div class="col-md-3 mb-3">
                    <label for="firstName">Departamento</label>
                    <select style="width:100%" name="select_deptos" required id="select_deptos" class="form-control form-control-sm deptos">
                      <option value="">Seleccionar</option>
                    </select>
                  </div>
                  <div class="col-md-6 mb-3">
                    <label for="lastName">Ciudad</label>
                    <input type="text" autocomplete="off"  maxLength="255" class="form-control " name="ciudad" id="ciudad" placeholder="" required>                    
                  </div>
                  <div class="col-md-6 mb-3">
                    <label for="lastName">Dirección</label>
                    <input type="text" autocomplete="off"  maxLength="100" class="form-control " name="direccion" id="direccion" placeholder="" required>                    
                  </div>
                  <div class="col-md-6 mb-3">
                    <label for="firstName">Perfil</label>
                    <select style="width:100%" name="tipo" required id="tipo" class="form-control form-control-sm terminos_condiciones">
                      <option value="">Seleccionar</option>
                      <option value="OPERADOR">Operador</option>
                      <option value="ADMINISTRADOR">Administrador</option>
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
        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
          <br>
          <br>
        <div class="responsive">
          <table id="tabla_usuarios" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th>Cédula</th>
                    <th>Nombre</th>
                    <th>País</th>
                    <th>Depto</th>
                    <th>Ciudad</th>
                    <th>Dirección</th>
                    <th>Teléfono</th>
                    <th>Email</th>
                    <th>Perfil</th>
                    <th>Creación</th>
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

  <button type="button" id="brn_modal_asociar" class="btn btn-primary" style="display:none" data-toggle="modal" data-target=".bd-example-modal-lg">Large modal</button>

<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" style="width:80%">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Asociar usuario a hoteles </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-sm-6">
            <table class="table table-bordered table-condensed table-hover table-striped">
              <thead>
                <tr>
                    <th >
                      Hoteles asociados
                    </th>
                    <th>
                    </th>
                </tr>
              </thead>
              <tbody class="text-left" id="tabla_asociados">
                
              </tbody>
            </table>
          </div>
          <div class="col-sm-6">
          <table class="table table-bordered table-condensed table-hover table-striped">
              <thead>
                <tr>
                    <th>
                    </th>
                    <th >
                      Hoteles sin asociar
                    </th>
                </tr>
              </thead>
              <tbody class="text-left" id="tabla_por_asociar">
                
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<div class="modal fade modal_editar_usuario" id="modal_editar_usuario" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" style="width:80%">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Editar usuario </h5>
        <button type="button" class="close" data-dismiss="modal" id="close_modal_edit_usuario" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="card mt-3">
            <h5 class="card-header">Usuarios</h5>
            <div class="card-body">
              <form role="form" onsubmit="event.preventDefault(); return EditarUsuario();" id="form_guardar" class="needs-validation">
                <div class="row">
                  <div class="col-md-6 mb-3" >
                    <label for="lastName">Código</label>
                    <input type="hidden" id="id_edit">
                    <input type="text" autocomplete="off" class="form-control " maxLength="6" onkeypress="return isNumber(event)" name="codigo_edit" id="codigo_edit" placeholder="" required>                    
                  </div>
                  <div class="col-md-6 mb-3" >
                    <label for="lastName">Cédula</label>
                    <input type="text" autocomplete="off" class="form-control "  maxLength="11"  onkeypress="return isNumber(event)" name="cedula_edit" id="cedula_edit" placeholder="" required>                    
                  </div>
                  <div class="col-md-3 mb-3" >
                    <label for="lastName">Primer nombre</label>
                    <input type="text" autocomplete="off" class="form-control "  maxLength="255" name="nombre1_edit" id="nombre1_edit" placeholder="" required>                    
                  </div>
                  <div class="col-md-3 mb-3" >
                    <label for="lastName">Segundo nombre</label>
                    <input type="text" autocomplete="off" class="form-control "  maxLength="255" name="nombre2_edit" id="nombre2_edit" placeholder="" >                    
                  </div>
                  <div class="col-md-3 mb-3" >
                    <label for="lastName">Primer Apellido</label>
                    <input type="text" autocomplete="off" class="form-control "  maxLength="255" name="apellido1_edit" id="apellido1_edit" placeholder="" required>                    
                  </div>
                  <div class="col-md-3 mb-3" >
                    <label for="lastName">Segundo apellido</label>
                    <input type="text" autocomplete="off" class="form-control "  maxLength="255" name="apellido2_edit" id="apellido2_edit" placeholder="" >                    
                  </div>
                  <div class="col-md-6 mb-3">
                    <label for="lastName">Email</label>
                    <input type="text" autocomplete="off"  maxLength="100" class="form-control" name="email_edit" id="email_edit" placeholder="" >                   
                  </div>
                  <div class="col-md-6 mb-3">
                    <label for="lastName">Teléfono</label>
                    <input type="text" autocomplete="off"  maxLength="15" onkeypress="return isNumber(event)" class="form-control " name="telefono_edit" id="telefono_edit" placeholder="" required>                    
                  </div>
                  <div class="col-md-3 mb-3">
                    <label for="firstName">Pais</label>
                    <select style="width:100%" name="select_pais_edit" onchange="traer_deptos(this.value)" required id="select_pais_edit" class="form-control form-control-sm paises">
                      <option value="">Seleccionar</option>
                    </select>
                  </div>
                  <div class="col-md-3 mb-3">
                    <label for="firstName">Departamento</label>
                    <select style="width:100%" name="select_deptos_edit" id="select_deptos_edit" class="form-control form-control-sm deptos">
                      <option value="">Seleccionar</option>
                    </select>
                  </div>
                  <div class="col-md-6 mb-3">
                    <label for="lastName">Ciudad</label>
                    <input type="text" autocomplete="off"  maxLength="255" class="form-control " name="ciudad_edit" id="ciudad_edit" placeholder="" required>                    
                  </div>
                  
                  <div class="col-md-6 mb-3">
                    <label for="lastName">Dirección</label>
                    <input type="text" autocomplete="off"  maxLength="100" class="form-control " name="direccion_edit" id="direccion_edit" placeholder="" >                    
                  </div>
                  <div class="col-md-6 mb-3">
                    <label for="firstName">Perfil</label>
                    <select style="width:100%" name="tipo_edit" id="tipo_edit" class="form-control form-control-sm terminos_condiciones">
                      <option value="">Seleccionar</option>
                      <option value="OPERADOR">Operador</option>
                      <option value="ADMINISTRADOR">Administrador</option>
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

<script src="../../assets/js/jquery.slim.min.js" crossorigin="anonymous"></script>
<script>window.jQuery || document.write('<script src="../../assets/js/jquery.slim.min.js"><\/script>')</script>
<script src="../../assets/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="../../assets/js/jquery.min.js"></script>
<script src="../../assets/js/select2.full.js"></script>
<script src="../../assets/js/bootstrap-datepicker.min.js"></script>
<script src="../../assets/js/dataTables/jquery.dataTables.min.js"></script>
<script src="../../assets/js/dataTables/dataTables.bootstrap4.min.js"></script>
<script src="../../assets/js/html2pdf.bundle.min.js"></script>
<script src="https://www.google.com/recaptcha/api.js" async></script>
<script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
<script src="http://momentjs.com/downloads/moment.min.js"></script>

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
  $("#menu_usuarios").addClass("active");
  $("#menu_nombre_hotel").addClass("active");
  //traer_hotel()
  traer_paises()
  traer_perfiles()
  $(".loader").css("display", "none")

});


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
    url: 'guardar_usuario.php',
    beforeSend: function() {
        $(".loader").css("display", "inline-block")
    },
    success: function(respuesta) {
      $(".loader").css("display", "none")
      console.log(respuesta)
      let obj = JSON.parse(respuesta)
      if (obj.success) {
        alert(obj.message)
        limpiar_formulario()
       
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
        url: '../../php/sel_recursos.php',
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
          $("#select_pais_edit").html('<option value="">Seleccionar</option>'+fila)
          
        },
        error: function() {
          $(".loader").css("display", "none")
          console.log("No se ha podido obtener la información");
        }
      });

      $("#select_pais").select2();
      $("#select_pais_edit").select2();
    
  }

  function traer_deptos(id) {

    if ( id.length < 1) {
      $("#select_deptos").html('<option value="">Seleccionar</option>').select2();
      $("#select_deptos_edit").html('<option value="">Seleccionar</option>').select2();
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
        url: '../../php/sel_recursos.php',
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
          $("#select_deptos_edit").html('<option value="">Seleccionar</option>'+fila)
          
        },
        error: function() {
          $(".loader").css("display", "none")
          console.log("No se ha podido obtener la información");
        }
      });

      $("#select_deptos").select2();
      $("#select_deptos_edit").select2();
    
  }

  function abrir_asociacion_hotel(id) {
    $("#brn_modal_asociar").click()
    hoteles_asociados(id)
    hoteles_por_asociar(id)
  }
  

  function hoteles_asociados(id) {
    
    let values = { 
          codigo: 'hoteles_asociados',
          parametro1: id,
          parametro2: ""
    };
    $.ajax({
      type : 'POST',
      data: values,
      url: 'usua.php',
      beforeSend: function() {
          $(".loader").css("display", "inline-block")
      },
      success: function(respuesta) {
        $(".loader").css("display", "none")
        let obj = JSON.parse(respuesta)
        let fila = ''
        fila += ''
        $.each(obj["resultado"], function( index, val ) {
          fila += `<tr>
                      <td>${val.nombre}</td>
                      <td>
                        <span style="cursor:pointer;:color:red" onclick="mover_hotel_usuario(${val.id}, ${id}, 'moverto_sin_asociar')"><i class="fa fa-chevron-right" aria-hidden="true"></i></span>
                      </td>
                  </tr>`
        });

        $("#tabla_asociados").html(fila)
        
      },
      error: function() {
        $(".loader").css("display", "none")
        console.log("No se ha podido obtener la información");
      }
    });

  }

  function hoteles_por_asociar(id) {
    
    let values = { 
          codigo: 'hoteles_por_asociar',
          parametro1: id,
          parametro2: ""
    };
    $.ajax({
      type : 'POST',
      data: values,
      url: 'usua.php',
      beforeSend: function() {
          $(".loader").css("display", "inline-block")
      },
      success: function(respuesta) {
        $(".loader").css("display", "none")
        let obj = JSON.parse(respuesta)
        let fila = ''
        fila += ''
        $.each(obj["resultado"], function( index, val ) {
          fila += `<tr>
                    <td>
                    <span style="cursor:pointer;:color:red" onclick="mover_hotel_usuario(${val.id}, ${id}, 'moverto_asociados')"><i class="fa fa-chevron-left" aria-hidden="true"></i></span>
                    </td>
                      <td>${val.nombre}</td>
                  </tr>`
        });

        $("#tabla_por_asociar").html(fila)
        
      },
      error: function() {
        $(".loader").css("display", "none")
        console.log("No se ha podido obtener la información");
      }
    });

  }

  function mover_hotel_usuario(id, id_usuario, accion) {

    let values = {
      codigo :  accion,
      parametro1 :  id,
      parametro2 :  id_usuario
    }
    $.ajax({
    type : 'POST',
    data: values,
    url: 'usua.php',
    beforeSend: function() {
        $(".loader").css("display", "inline-block")
    },
    success: function(respuesta) {
      $(".loader").css("display", "none")
      console.log(respuesta)
      let obj = JSON.parse(respuesta)
      if (obj.success) {
        hoteles_por_asociar(id_usuario)
        hoteles_asociados(id_usuario)
        //limpiar_formulario()
       
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
    
    $("#codigo").val("").change()
    $("#cedula").val("").change()
    $("#nombre1").val("").change()
    $("#nombre2").val("").change()
    $("#apellido1").val("").change()
    $("#apellido2").val("").change()
    $("#tipo").val("").change()
    $("#select_pais").val("").change()
    $("#select_deptos").val("").change()
    $("#ciudad").val("").change()
    $("#direccion").val("").change()
    $("#telefono").val("").change()
    $("#email").val("").change()
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
  function show_traer_tabla_usuarios(){
    setTimeout(() => {
      traer_tabla_usuarios()
    }, 100);
  }

  function traer_usuario_id(id) {

    let values = { 
            codigo: 'traer_usuarios_id',
            parametro1: id,
            parametro2: ""
      };
      $.ajax({
        type : 'POST',
        data: values,
        url: 'usua.php',
        beforeSend: function() {
            $(".loader").css("display", "inline-block")
        },
        success: function(respuesta) {
          $(".loader").css("display", "none")
          let obj = JSON.parse(respuesta)
          let fila = ''
          $.each(obj["resultado"], function( index, val ) {
            $("#id_edit").val(val.id)
            $("#codigo_edit").val(val.codigo).change()
            $("#cedula_edit").val(val.cedula).change()
            $("#nombre1_edit").val(val.nombre1).change()
            $("#nombre2_edit").val(val.nombre2).change()
            $("#apellido1_edit").val(val.apellido1).change()
            $("#apellido2_edit").val(val.apellido2).change()
            $("#tipo_edit").val(val.tipo).change()
            $("#select_pais_edit").val(val.pais).change()
            setTimeout(() => {
              $("#select_deptos_edit").val(val.depto).change()
            }, 300);
            $("#ciudad_edit").val(val.ciudad).change()
            $("#direccion_edit").val(val.direccion).change()
            $("#telefono_edit").val(val.telefono).change()
            $("#email_edit").val(val.email).change()
          });
          
        },
        error: function() {
          $(".loader").css("display", "none")
          console.log("No se ha podido obtener la información");
        }
      });
  }

  function traer_tabla_usuarios(){

    if ( ! $.fn.DataTable.isDataTable('#tabla_usuarios')) {
			  dtable = $("#tabla_usuarios").DataTable({
          "scrollY": true,
					"ajax": {
					"url": "usua.php",
					"type": "POST",
					"deferRender": false,
					"data":{
            codigo:'trael_usuarios',
            parametro1: "",
            parametro2: "",
          },
					"dataSrc": function (data) {	
            console.log(data)
						return data.data
					}

				  },
				  "columns": [
          { "data": "id"},
          { "data": "id"},
          { "data": "id"},
          { "data": "cedula"},
					{ "data": "nombre1"},
					{ "data": "pais"},
          { "data": "depto"},
					{ "data": "ciudad"},
          { "data": "direccion"},
					{ "data": "telefono"},
          { "data": "email"},
          { "data": "tipo"},
          { "data": "fecha_crea"},

				],
				 "columnDefs": [
					 {
						"targets": 4,
						"data":"",
						 render: function ( data, type, row ) {
							return  `${row.nombre1} ${row.nombre2} ${row.apellido1} ${row.apellido2}`;
						 }
					},
          {
						"targets": 0,
						"data":"",
						 render: function ( data, type, row ) {
							return  `<button class="btn btn-link"  data-toggle="modal" data-target="#modal_editar_usuario" onclick="traer_usuario_id(${row.id})"><i class="fa fa-edit" aria-hidden="true"></i></button>`;
						 }
					},
          {
						"targets": 1,
						"data":"",
						 render: function ( data, type, row ) {
							return  `<button class="btn btn-link" onclick="abrir_asociacion_hotel(${row.id})"><i class="fa fa-eye" aria-hidden="true"></i></button>`;
						 }
					},
          {
						"targets": 2,
						"data":"",
						 render: function ( data, type, row ) {
							return  `<button class="btn btn-link" style="color:red" onclick="EliminarUsuario(${row.id})"><i class="fa fa-trash" aria-hidden="true"></i></button>`;
						 }
					}],
				});
			}else{
			   dtable.destroy();
         traer_tabla_usuarios();
			}

  }

  function EditarUsuario() {
    
      let values = {
        id :  $("#id_edit").val(),
        codigo :  $("#codigo_edit").val(),
        cedula :  $("#cedula_edit").val(),
        nombre1 :  $("#nombre1_edit").val(),
        nombre2 :  $("#nombre2_edit").val(),
        apellido1 :  $("#apellido1_edit").val(),
        apellido2 :  $("#apellido2_edit").val(),
        tipo :  $("#tipo_edit").val(),
        id_pais :  $("#select_pais_edit").val(),
        id_depto :  $("#select_deptos_edit").val(),
        ciudad :  $("#ciudad_edit").val(),
        direccion :  $("#direccion_edit").val(),
        telefono :  $("#telefono_edit").val(),
        email :  $("#email_edit").val(),
        avatar : "/../upload.php"
      }
      $.ajax({
      type : 'POST',
      data: values,
      url: 'editar_usuario.php',
      beforeSend: function() {
          $(".loader").css("display", "inline-block")
      },
      success: function(respuesta) {
        $(".loader").css("display", "none")
        console.log(respuesta)
        let obj = JSON.parse(respuesta)
        if (obj.success) {
          alert(obj.message)
          traer_tabla_usuarios()
          $("#close_modal_edit_usuario").click()
        
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


  function EliminarUsuario(id) {
    
    let values = {
      id :  id,
      tabla : 'usuarios',
      accion :  'ELIMINAR',
    }
    $.ajax({
    type : 'POST',
    data: values,
    url: '../../php/eliminar.php',
    beforeSend: function() {
        $(".loader").css("display", "inline-block")
    },
    success: function(respuesta) {
      $(".loader").css("display", "none")
      console.log(respuesta)
      let obj = JSON.parse(respuesta)
      if (obj.success) {
        alert(obj.message)
        traer_tabla_usuarios()
        $("#close_modal_edit_usuario").click()
      
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

function traer_perfiles() {
      let values = { 
            codigo: 'traer_perfiles',
            parametro1: "",
            parametro2: ""
      };
      $.ajax({
        type : 'POST',
        data: values,
        url: '../../php/sel_recursos.php',
        beforeSend: function() {
            $(".loader").css("display", "inline-block")
        },
        success: function(respuesta) {
          $(".loader").css("display", "none")
          let obj = JSON.parse(respuesta)
          let fila = ''
          $.each(obj["resultado"], function( index, val ) {
            fila += `<option value='${val.nombre}'>${val.nombre}</option>`
          });

          $("#tipo").html('<option value="">Seleccionar</option>'+fila)
          $("#tipo_edit").html('<option value="">Seleccionar</option>'+fila)
          
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