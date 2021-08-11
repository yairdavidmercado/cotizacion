<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.5">
    <title>Recuperación de contraseña</title>
    <link rel="icon" type="image/ico" href="/gestion_pqrsdf/assets/img/ideas.ico">
</head>
<link href="assets/css/bootstrap.min.css" rel="stylesheet">
<link href="assets/css/select2.min.css" rel="stylesheet">

<!------ Include the above in your HEAD tag ---------->

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">
<style>
 body{
     background-color: #F8F9FA
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
<div class="bg-light py-5">
<div class="loader"></div>
  <br>
  <br>
    <div class="mb-4 text-center"><img src="assets/img/logos.png" width="200px" alt="" srcset=""></div>
    <h4 class="card-title mt-3 text-center">Reestablece tú contraseña</h4>
    <article class="card-body mx-auto" style="max-width: 400px;">
    <input style="display:none" class="form-control" id="id" disabled type="text">
    <input style="display:none" class="form-control" id="code" disabled type="text">
        <form id="form_registro" onsubmit="event.preventDefault(); return GuardarRegistro();">
                <span class="help-block text-danger" style="font-size:10px">(*) Campo obligatorio</span>
                <div class="form-group input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                    </div>
                    <input class="form-control" name="password" id="password" required placeholder="Nueva Contraseña" type="password">
                </div> <!-- form-group// -->
                <div class="form-group input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                    </div>
                    <input class="form-control" name="password_confirmar" id="password_confirmar" required placeholder="Repetir contraseña" type="password">
                </div> <!-- form-group// --> 
                <div class="form-group">
                    <button type="submit" class="btn btn-success btn-block"> Reestablecer contraseña </button>
                </div> <!-- form-group// -->                                                                   
        </form>
    </article>
</div> <!-- card.// -->
<script src="assets/js/jquery.slim.min.js" crossorigin="anonymous"></script>
<script src="assets/js/ajax/jquery.min.js"></script>
<script src="assets/js/select2.full.js"></script>
<script>
var id = "<?php echo $_GET["id"];?>"
var code = "<?php echo $_GET["code"];?>"
$(function() {
    validar_acceso()
    //alert(id+" "+code)
});

    function validar_acceso(params) {
        let values = { 
            cod: '7',
            parametro1: id,
            parametro2: code
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
                if (obj[0].length > 0) {
                    $.each(obj[0], function( index, val ) {
                        $("#id").val(val.email)
                        $("#code").val(val.recover)
                    });   
                }else{
                    $(".loader").css("display", "none")
                    alert("Ha ocurrido un error en la validación de la información.")
                    window.location.href = 'index.php';
                }
            },
            error: function() {
                $(".loader").css("display", "none")
                console.log("No se ha podido obtener la información");
            }
        });
    }

    function GuardarRegistro() {
        if ($("#password").val() !== $("#password_confirmar").val() ) {
                alert("Las contraseñas no coinciden.", "red")
                $("input[name*='password']").val("")
                $("input[name*='password_confirmar']").val("")
                return false
            }
            $.ajax({
                type : 'POST',
                data: $("#form_registro").serialize()+"&id="+$("#id").val()+"&code="+$("#code").val(),
                url: 'php/guardar_new_pass.php',
                beforeSend: function() {
                    $(".loader").css("display", "inline-block")
                },
                success: function(respuesta) {
                $(".loader").css("display", "none")
                let obj = JSON.parse(respuesta)
                if (obj.success) {
                    if (obj.message != "0") {
                        alert("Cambio de contraseña exitoso, puedes iniciar sesión.")
                        //alert("Hemos enviado una solicitud de verificación de inicio de sesión a tu cuenta de correo.")
                        window.location.href = 'index.php';
                    }else{
                        
                        alert("no se pudo cambiar la contraseña.")
                    }
                }else{
                    alert('Datos invalidos para el acceso')
                }
                },
                error: function() {
                $(".loader").css("display", "none")
                console.log("No se ha podido obtener la información");
                }
            }); 
    }

</script>