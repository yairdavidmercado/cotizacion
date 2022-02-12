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
        <div class="container mt-5">
            <div id="btn_crear_hotel">
              
            </div>
            <div class="row" id="content_hoteles">

            </div>	
        </div>
    </div>

    <!-- <div class="modal fade" id="modal" tabindex="-2" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog" >
          
        </div>
      </div> -->


    <div class="modal fade bd-example-modal-lg" id="modal_crear_hotel" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content" id="crop_img" style="display:none">
            <div class="modal-header">
              <h5 class="modal-title" id="modalLabel">Recortar imágen</h5>
              <button type="button" class="close" id="close_modal_crop" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="img-container">
                <img id="image" width="500px" src="https://avatars0.githubusercontent.com/u/3456749">
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
              <button type="button" class="btn btn-primary" id="crop">Recortar</button>
            </div>
          </div>
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Crear hotel</h5>
                    <button type="button" class="close" id="close_modal_hotel" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                <div class="card mt-3">
                    <div class="card-body">
                        <form role="form" onsubmit="event.preventDefault(); return GuardarHotel();" id="form_guardar" class="needs-validation">   
                            <div class="row" style="marging-left:50px">
                              <label class="label" data-toggle="tooltip" title="Change your avatar">
                                <img class="rounded" id="avatar" src="assets/img/default.jpg" width="100px" style="border-radius: 20%" alt="avatar">
                                <input type="file" class="sr-only" id="input" name="image" accept="image/*">
                              </label>
                            </div>
                            <div class="row">
                            <div class="col-md-3 mb-3" >
                                <label for="lastName">NIT</label>
                                <input type="text" autocomplete="off" onkeypress="return isNumber(event)" class="form-control " name="nit" id="nit" placeholder="" required>                    
                            </div>
                            <div class="col-md-9 mb-3" >
                                <label for="lastName">Razón social</label>
                                <input type="text" autocomplete="off" class="form-control " name="nombre" id="nombre" placeholder="" required>                    
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="lastName">Email</label>
                                <input type="text" autocomplete="off" class="form-control" name="email" id="email" placeholder="" required>                   
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="lastName">Teléfono</label>
                                <input type="text" autocomplete="off" onkeypress="return isNumber(event)" class="form-control " name="telefono" id="telefono" placeholder="" required>                    
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="firstName">Pais</label>
                                <select style="width:100%" name="select_pais" onchange="traer_deptos(this.value)" required id="select_pais" class="form-control form-control-sm paises">
                                <option value="">Seleccionar</option>
                                </select>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="firstName">Departamentos</label>
                                <select style="width:100%" name="select_deptos" required id="select_deptos" class="form-control form-control-sm deptos">
                                <option value="">Seleccionar</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="lastName">Ciudad</label>
                                <input type="text" autocomplete="off" class="form-control " name="ciudad" id="ciudad" placeholder="" required>                    
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="lastName">Dirección</label>
                                <input type="text" autocomplete="off" class="form-control " name="direccion" id="direccion" placeholder="" required>                    
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="firstName">Términos y condiciones</label>
                                <select style="width:100%" name="select_terminos_condiciones" required id="select_terminos_condiciones" class="form-control form-control-sm terminos_condiciones">
                                <option value="">Seleccionar</option>
                                </select>
                            </div>
                            <div class="col-md-12 mb-3 d-flex justify-content-center">
                                <button type="submit" class="btn btn-success mr-2">Guardar hotel</button>
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
            if (obj["resultado"].length > 0) {
              if (obj["resultado"].length == 1) {
                  $.each(obj["resultado"], function( index, val ) {
                      fila += `<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                              </div>
                              <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                  
                                  <div class="box-part text-center">
                                      
                                    <img src="${val.avatar}" width="100px">
                                      
                                      <div class="title">
                                          <button class="btn btn-link"><h4>${val.nombre}</h4></button>
                                      </div>

                                      <div class="text">
                                          <span>${val.descrpcion}</span>

                                      </div>
                                      
                                  </div>
                              </div>
                              <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                              </div>`
                  });
              }else if (obj["resultado"].length == 2) {
                  $.each(obj["resultado"], function( index, val ) {
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
              }else if (obj["resultado"].length > 2) {
                  $.each(obj["resultado"], function( index, val ) {
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
          }

          $("#content_hoteles").html(fila)
          
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
