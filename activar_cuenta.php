<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.5">
    <title>Activar cuenta</title>
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

</div> <!-- card.// -->
<script src="assets/js/jquery.slim.min.js" crossorigin="anonymous"></script>
<script src="assets/js/ajax/jquery.min.js"></script>
<script src="assets/js/select2.full.js"></script>
<script>
var id = "<?php echo $_GET["id"];?>";
$(function() {
    GuardarRegistro()
});

    function GuardarRegistro() {
        let values = {
            id: id
        }
        $.ajax({
                type : 'POST',
                data: values,
                url: 'php/activar_cuenta.php',
                beforeSend: function() {
                    $(".loader").css("display", "inline-block")
                },
                success: function(respuesta) {
                $(".loader").css("display", "none")
                let obj = JSON.parse(respuesta)
                if (obj.success) {
                    if (obj.message != "0") {
                        alert("La cuenta ha sido activada satisfactoriamente, puedes iniciar sesión.")
                        window.location.href = 'index.php';
                    }else{
                        
                        alert("No se pudo activar la cuenta.")
                    }
                }else{
                    alert('No se pudo activar la cuenta.')
                }
                },
                error: function() {
                $(".loader").css("display", "none")
                console.log("No se pudo activar la cuenta.");
                }
            }); 
    }

</script>