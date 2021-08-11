<?php
// start a session
session_start();
//  if (!isset($_SESSION['idUser'])) {
//     header ("Location:/gestion_pqrsdf/index.php"); 
//  }
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
    <link rel="icon" type="image/ico" href="/gestion_pqrsdf/assets/img/ideas.ico">
    <title>Recuperación de contraseña</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.3/examples/sign-in/">

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
  <body class="text-center">
  <div class="loader"></div>
  <br>
  <br>
    <form onsubmit="enviar_mail(); return false;" methods="POST" class="form-signin">
      <div class="mb-3"><img src="assets/img/logos.png" width="200px" alt="" srcset=""></div>
      <p style="font-size:14px">Enviaremos un email a su correo.</p>
      <label for="inputEmail" class="sr-only">Email</label>
      <input type="text" id="usuario" class="form-control" placeholder="Email" required autofocus>
      <button class="btn btn-lg btn-success btn-block" style="color:#fff" type="submit"><b>Recuperar Contraseña</b></button>
      <p class="text-right"><a href="/gestion_pqrsdf/index.php">Iniciar sesión</a> </p>
    </form>

    <script src="assets/js/jquery.slim.min.js" crossorigin="anonymous"></script>
    <script src="assets/js/ajax/jquery.min.js"></script>
<script>
$(function() {
  $(".loader").css("display", "none")
});

  function enviar_mail() {
    var values = { 
        parametro1: $('#usuario').val()
    };
    $.ajax({
    type : 'POST',
    data: values,
    url: 'php/enviar_mail.php',
    beforeSend: function() {
        $(".loader").css("display", "inline-block")
    },
    success: function(respuesta) {
       let obj = JSON.parse(respuesta)
       //alert(JSON.stringify(obj[0].length))
       if (obj.success) {
          alert('Hemos enviado un correo electrónico a '+$('#usuario').val())
          window.location.href = "index.php";
       }else{
        $('#usuario').val("")
        alert('el correo ingresado no ha sido registrado.')
       }
    },
    error: function() {
      console.log("No se ha podido obtener la información");
    }
  });
    
  }
</script>
</body>
</html>
