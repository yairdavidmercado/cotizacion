<?php
// start a session
session_start();
if (!isset($_SESSION['id'])) {
    header ("Location:index.php"); 
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
    <meta name="generator" content="Jekyll v3.8.5">
    <title>Iniciar sesión</title>
    <link rel="icon" type="image/ico" href="/cotizacion/assets/img/ideas.ico">
    <link rel="canonical" href="https://getbootstrap.com/docs/4.3/examples/sign-in/">

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
  <style>
      body{
            background: #eee;
        }
        span{
            font-size:15px;
        }

        .box{
            padding:60px 0px;
        }

        .box-part{
            background:#FFF;
            border-radius:0;
            padding:60px 10px;
            margin:30px 0px;
        }
        .text{
            margin:20px 0px;
        }

        .fa{
            color:#4183D7;
        }

        .menu_principal{
            display:none;
        }
  </style>
  </head>
  <body class="container bg-light">
  <?php require("menu.php"); ?>
  <div class="loader"></div>
  <div class="box">
    <div class="container mt-5">
        <div class="row" id="content_hoteles">

        </div>	
    </div>
</div>
    <script src="assets/js/jquery.slim.min.js" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="assets/js/jquery.slim.min.js"><\/script>')</script>
    <script src="assets/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/ajax/jquery.min.js"></script>
<script>
var id_usuario = "<?php echo $_SESSION['id'] ?>"

$(function() {
    setTimeout(() => {
        Notifications("asdasd", "success")
    }, 1000);
    
    card_hotel(id_usuario)
    $(".loader").css("display", "none")
});
function card_hotel(id) {
      let values = { 
            codigo: 'card_hotel',
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
          if (obj["resultado"].length > 0) {
            if (obj["resultado"].length == 1) {
                $.each(obj["resultado"], function( index, val ) {
                    fila += `<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                
                                <div class="box-part text-center">
                                    
                                    <i class="fa fa-instagram fa-3x" aria-hidden="true"></i>
                                    
                                    <div class="title">
                                        <h4>${val.nombre}</h4>
                                    </div>

                                    <div class="text">
                                        <span>${val.direccion}</span>
                                        <br>
                                        <span>${val.telefono}</span>
                                        <br>
                                        <span>${val.pais} - ${val.depto}</span>
                                        <br>
                                    </div>
                                    
                                    <button onclick="change_hotel(${val.id},'${val.nombre}','${val.id_terminos}','${val.direccion}','${val.telefono}','${val.pais}','${val.depto}','${val.email}','${val.avatar}')" class="btn btn-link">Acceder</button>
                                    
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            </div>`
                });
            }else if (obj["resultado"].length == 2) {
                $.each(obj["resultado"], function( index, val ) {
                    fila += `<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                
                                <div class="box-part text-center">
                                    
                                    <i class="fa fa-instagram fa-3x" aria-hidden="true"></i>
                                    
                                    <div class="title">
                                        <h4>${val.nombre}</h4>
                                    </div>
                                    <div class="text">
                                        <span>${val.direccion}</span>
                                        <br>
                                        <span>${val.telefono}</span>
                                        <br>
                                        <span>${val.pais} - ${val.depto}</span>
                                        <br>
                                    </div>
                                    
                                    <button onclick="change_hotel(${val.id},'${val.nombre}','${val.id_terminos}','${val.direccion}','${val.telefono}','${val.pais}','${val.depto}','${val.email}','${val.avatar}')" class="btn btn-link">Acceder</button>
                                    
                                </div>
                            </div>`
                });
                fila = `<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                            </div>
                            ${fila}
                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                            </div>`
            }else if (obj["resultado"].length > 2) {
                $.each(obj["resultado"], function( index, val ) {
                    fila += `<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                
                                <div class="box-part text-center">
                                    
                                    <i class="fa fa-instagram fa-3x" aria-hidden="true"></i>
                                    
                                    <div class="title">
                                        <h4>${val.nombre}</h4>
                                    </div>
                                    <div class="text">
                                        <span>${val.direccion}</span>
                                        <br>
                                        <span>${val.telefono}</span>
                                        <br>
                                        <span>${val.pais} - ${val.depto}</span>
                                        <br>
                                    </div>
                                    
                                    <button onclick="change_hotel(${val.id},'${val.nombre}','${val.id_terminos}','${val.direccion}','${val.telefono}','${val.pais}','${val.depto}','${val.email}','${val.avatar}')" class="btn btn-link">Acceder</button>
                                    
                                </div>
                            </div>`
                });
            }
          }
          

          $("#content_hoteles").html(fila)
          
        },
        error: function() {
          $(".loader").css("display", "none")
          console.log("No se ha podido obtener la información");
        }
      });
    
  }

  function change_hotel(id, nombre, id_terminos, direccion, telefono, pais, depto, email, avatar) {

      let values = { 
            parametro1: id,
            parametro2: nombre,
            parametro3: id_terminos,
            parametro4: direccion,
            parametro5: telefono,
            parametro6: pais,
            parametro7: depto,
            parametro8: email,
            parametro9: avatar,
      };

      $.ajax({
        type : 'POST',
        data: values,
        url: 'php/sel_hotel.php',
        beforeSend: function() {
            $(".loader").css("display", "inline-block")
        },
        success: function(respuesta) {
          //$(".loader").css("display", "none")
          let obj = JSON.parse(respuesta)
          let fila = ''
          if (obj.success) {
            $(location).attr('href',"cotizacion.php")
          }
          
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
