<?php
// start a session
session_start();

if (isset($_SESSION['id'])) {
  header ("Location:welcome.php"); 
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
    <meta name="generator" content="Jekyll v3.8.5">
    <title>Iniciar sesión</title>
    <link rel="icon" type="image/ico" href="/cotizacion/assets/img/ideas.ico">
    <link rel="canonical" href="https://getbootstrap.com/docs/4.3/examples/sign-in/">
    <link rel="stylesheet" href="assets/css/ajax/bootstrap.css">

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    
    <style>
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

        html,
        body {
        height: 100%;
        }

        body {
        display: -ms-flexbox;
        display: flex;
        -ms-flex-align: center;
        align-items: center;
        padding-top: 40px;
        padding-bottom: 40px;
        background-color: #f5f5f5;
        }

        .form-signin {
        width: 100%;
        max-width: 330px;
        padding: 15px;
        margin: auto;
        }
        .form-signin .checkbox {
        font-weight: 400;
        }
        .form-signin .form-control {
        position: relative;
        box-sizing: border-box;
        height: auto;
        padding: 10px;
        font-size: 16px;
        }
        .form-signin .form-control:focus {
        z-index: 2;
        }
        .form-signin input[type="email"] {
        margin-bottom: -1px;
        border-bottom-right-radius: 0;
        border-bottom-left-radius: 0;
        }
        .form-signin input[type="password"] {
        margin-bottom: 10px;
        border-top-left-radius: 0;
        border-top-right-radius: 0;
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
  <body style="background-color: #002744;" >
  <div style="position:fixed;margin-bottom:35%;margin-left:92%" onclick="verificacion()" data-toggle="tooltip" data-placement="top" title="Empresas verificadas">
    <img src="assets/img/verificado.png" width="40px"/>        
      <!-- <div style="text-align:center">
        <span style="color:#fff;font-size:9px">Empresas Verificadas</span>
      </div> -->
    
  </div>
  <div class="loader"></div>
    <form onsubmit="validar_sesion(); return false;" methods="POST" class="form-signin text-center">
      <div class="mb-3"><img src="assets/img/logos.png" width="200px" alt="" srcset=""></div>
      <h4  style="color:#fff" id="name_empresa"></h4>
      <label for="inputEmail" class="sr-only">correo electronico</label>
      <input type="text" id="usuario" class="form-control" placeholder="correo electronico" required autofocus>
      <label for="inputPassword" class="sr-only">Contraseña</label>
      <input type="password" id="password" class="form-control" placeholder="Contraseña" required>
      <button class="btn btn-lg btn-primary btn-block" style="color:#fff" type="submit"><b>Iniciar sesión</b></button>
      <!-- <a class="btn btn-link" style="color:#0069D9" onclick="abrir_modal_empresas()"><b>Seleccionar otra empresa</b></a> -->
      <!-- <p class=" float-left"><a href="/cotizacion/recover.php">¿Olvidaste tu contraseña?</a> </p>
      <p class="text-right"><a href="/cotizacion/registrate.php">Registrate</a> </p> -->
    </form>

    <!-- <button type="button" id="btn_modal_empresas" style="display:none" class="btn btn-primary"  data-toggle="modal" data-target="#modal_empresas">Large modal</button>

    <div class="modal fade modal_empresas" id="modal_empresas" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="myLargeModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-xs">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Seleccionar empresa</h5>
            <button type="button" style="display:none" class="close" id="close_modal_empresas" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body" id="content_empresas">
            
            
          </div>
        </div>
      </div>
    </div> -->

    <script src="assets/js/jquery.slim.min.js" crossorigin="anonymous"></script>
    <script src="assets/js/ajax/jquery.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    
    <script src="assets/js/notify.js"></script>
<script>
var dbname = "<?php echo isset($_SESSION['dbname']) ? $_SESSION['dbname'] : '0'  ?>";
$(function() {
  $(".loader").css("display", "none")
  $('[data-toggle="tooltip"]').tooltip()
  //mostrar_empresas(dbname)
});
  
  function validar_sesion() {
    var values = {
        codigo: 'login', 
        parametro1: $('#usuario').val(),
        parametro2: $('#password').val()
    };
    $.ajax({
    type : 'POST',
    data: values,
    url: 'php/sel_usuarios.php',
    beforeSend: function() {
        $(".loader").css("display", "inline-block")
    },
    success: function(respuesta) {
       let obj = JSON.parse(respuesta)

       if (obj.success) {
        //$(".loader").css("display", "none")
        $(location).attr('href',"welcome.php")
       }else{
        $(".loader").css("display", "none")
        Notifications('Datos invalidos para el acceso', 'danger')
       }   
    },
    error: function() {
      $(".loader").css("display", "none")
      console.log("No se ha podido obtener la información");
    }
  });
    
  }

  function verificacion(){
    window.open('empresas.php', '_blank');
  }

 /*  function mostrar_empresas() {
    
    $("#btn_modal_empresas").click()

    var values = {
        codigo: 'sel_empresas', 
        parametro1: '',
        parametro2:''
      };
      $.ajax({
        type : 'POST',
        data: values,
        url: 'php/sel_company.php',
        beforeSend: function() {
            
        },
        success: function(respuesta) {
          let obj = JSON.parse(respuesta)
          if (obj.success) {
            let fila = ''
            $.each(obj["resultado"], function( index, val ) {
              fila += `<div class="card" style="cursor:pointer" onclick="loginEmpresa('${val.dbname}', '${val.nombre}')">
                          <div class="card-body">
                            <img src="${val.avatar}" width="60px" class="float-left rounded-circle">
                            <div class="message">
                              <h5 class="card-title">${val.nombre}</h5>
                              <h6 class="card-subtitle mb-2 text-muted">${val.descripcion}</h6>
                            </div>
                          </div>
                        </div>`
            });
            $("#content_empresas").html(fila)
            //console.log(obj);
          }else{
            $(".loader").css("display", "none")
            console.log("No se ha podido obtener la información");
          }
        },
        error: function() {
          $(".loader").css("display", "none")
          console.log("No se ha podido obtener la información");
        }
      });
  }
 */
  /* function loginEmpresa(dbname, name){
    $("#btn_modal_empresas").click()
      var values = {
        codigo: 'loginCompany', 
        parametro1: dbname,
        parametro2:''
      };
      $.ajax({
        type : 'POST',
        data: values,
        url: 'php/sel_company.php',
        beforeSend: function() {
            
        },
        success: function(respuesta) {
          let obj = JSON.parse(respuesta)
          if (obj.success) {
            $("#name_empresa").text(name)
            $("#close_modal_empresas").click() 
          }else{
            $(".loader").css("display", "none")
            console.log("No se ha podido obtener la información");
          }   
        },
        error: function() {
          $(".loader").css("display", "none")
          console.log("No se ha podido obtener la información");
        }
      });
  }
 */
  function abrir_modal_empresas() {
    $("#btn_modal_empresas").click()
    mostrar_empresas()
  }

  function Notifications(mensaje, estado) {
    //add a new style 'foo'
    $.notify(mensaje, estado);
  }
</script>
</body>
</html>
