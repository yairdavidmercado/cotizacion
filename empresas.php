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
    <link href="assets/css/select2.min.css" rel="stylesheet">
    <link href="assets/css/cropper.min.css" rel="stylesheet">

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
  <style>
      body{
            background: #fff;
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

        .page {
          margin: 1em auto;
          max-width: 768px;
          display: flex;
          align-items: flex-start;
          flex-wrap: wrap;
          height: 100%;
        }
  </style>
  </head>
  <body class="container bg-light">
    <div class="loader"></div>
    <div class="box">
        <!-- <img src="assets/img/logos.png" class="float-right" width="200px" alt="" srcset=""> -->
        <h2>Empresas certificadas <img src="assets/img/verificado.png" width="40px"/></h2>
        <div class="container mt-5">
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <input type="text" class="form-control" id="searhInput" placeholder="Buscar"/>
            </div>
            <div class="row" id="content_empresas">

            </div>	
        </div>
    </div>

    <script src="assets/js/jquery.slim.min.js" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="assets/js/jquery.slim.min.js"><\/script>')</script>
    <script src="assets/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/ajax/jquery.min.js"></script>
    <script src="assets/js/select2.full.js"></script>
  
    <script src="assets/js/cropper.min.js" ></script>
<script>
var id_usuario = "1"
let dataEmpresas = []

const btnSearch = document.getElementById("searhInput")
btnSearch.addEventListener('keyup', (e) => {
    const inputString = e.target.value.trim()
    console.log(inputString)
    const filterEmpresas = dataEmpresas.filter((empresas) => {
        return (
            empresas.nombre.toUpperCase().includes(inputString.toUpperCase()) || empresas.descripcion.toUpperCase().includes(inputString.toUpperCase())
        ) 
    })
    verEmpresas(filterEmpresas)
    console.log(filterEmpresas)

})

function accent_fold (s) {
  if (!s) { return ''; }
  var ret = '';
  for (var i = 0; i < s.length; i++) {
    ret += dataEmpresas[s.charAt(i)] || s.charAt(i);
  }
  return ret;
};

$(function() {
    card_empresas()
    $(".loader").css("display", "none")
});
function card_empresas() {
      let values = { 
            codigo: 'card_empresas',
            parametro1: "",
            parametro2: ""
      };
      $.ajax({
        type : 'POST',
        data: values,
        url: 'php/sel_company.php',
        beforeSend: function() {
            $(".loader").css("display", "inline-block")
        },
        success: function(respuesta) {
          $(".loader").css("display", "none")
          let obj = JSON.parse(respuesta)
          let fila = ''
          if (obj.success) {
            dataEmpresas = obj["resultado"]
            verEmpresas(obj["resultado"])
          }
        },
        error: function() {
          $(".loader").css("display", "none")
          console.log("No se ha podido obtener la información");
        }
      });
    
  }

  function verEmpresas(obj){
    let fila = ''
    if (obj.length > 0) {
        if (obj.length == 1) {
            $.each(obj, function( index, val ) {
                fila += `<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            
                            <div class="box-part text-center">
                                
                            <img src="${val.avatar}" width="100px">
                                
                                <div class="title">
                                    <button class="btn btn-link"><h4>${val.nombre}</h4></button>
                                </div>

                                <div class="text">
                                    <span>${val.descripcion}</span>

                                </div>
                                
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        </div>`
            });
        }else if (obj.length == 2) {
            $.each(obj, function( index, val ) {
                fila += `<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            
                            <div class="box-part text-center">
                                
                                <img src="${val.avatar}" width="100px">
                                
                                <div class="title">
                                    <button  class="btn btn-link"><h4>${val.nombre}</h4></button>
                                </div>
                                <div class="text">
                                    <span>${val.descripcion}</span>
                                </div>
                                
                            </div>
                        </div>`
            });
            fila = `<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                        </div>
                        ${fila}
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                        </div>`
        }else if (obj.length > 2) {
            $.each(obj, function( index, val ) {
                fila += `<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            
                            <div class="box-part text-center">
                                
                                <img src="${val.avatar}" width="100px">
                                
                                <div class="title">
                                    <button class="btn btn-link"><h4>${val.nombre}</h4></button>
                                </div>
                                <div class="text">
                                    <span>${val.descripcion}</span>
                                </div>
                                
                            </div>
                        </div>`
            });
        }
    }
    $("#content_empresas").html(fila)
  }


</script>
</body>
</html>
