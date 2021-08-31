<?php
session_start();
 if (!isset($_SESSION['id'])) {
    header ("Location:/index.php"); 
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
          <a class="nav-link" onclick="show_traer_tabla_hotel()" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Buscar</a>
        </li>
      </ul>
      <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
          <div class="card mt-3">
            <h5 class="card-header">Hotel</h5>
            <div class="card-body">
              <form role="form" onsubmit="event.preventDefault(); return GuardarHotel();" id="form_guardar" class="needs-validation">
                <div class="row">
                <div class="col-md-3 mb-3" >
                    <label for="lastName">NIT</label>
                    <input type="text" autocomplete="off" class="form-control " name="nit" id="nit" placeholder="" required>                    
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
        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
          <br>
          <br>
        <div class="responsive">
          <table id="tabla_hotel" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>codigo</th>
                    <th>Razón social</th>
                    <th>País</th>
                    <th>Ciudad</th>
                    <th>Depto</th>
                    <th>Teléfono</th>
                    <th>Email</th>
                    <th>Creación</th>
                    <th></th>
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

  <button type="button" id="brn_modal_print" class="btn btn-primary" style="display:none" data-toggle="modal" data-target=".bd-example-modal-lg">Large modal</button>

<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <div id="btn_pdf">

        </div>
        <h5 class="modal-title">Previsualización de cotización</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body" id="print_cotizacion">
        
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
  //alert(id_hotel)
  $("#menu_inicio").removeClass("active");
  $(".menu_principal").removeClass("active");
  $("#menu_hoteles").addClass("active");
  $("#menu_nombre_hotel").addClass("active");
  //traer_hotel()
  traer_paises()
  traer_terminos()
  $(".loader").css("display", "none")

});


function GuardarHotel() {
    
    //let form = $('#form_guardar')[0];
    //let formData = new FormData(form)
    let values = {
        nit :  $("#nit").val(),
        nombre :  $("#nombre").val(),
        email :  $("#email").val(),
        telefono :  $("#telefono").val(),
        direccion :  $("#direccion").val(),
        id_pais :  $("#select_pais").val(),
        id_depto :  $("#select_deptos").val(),
        id_terminos :  $("#select_terminos_condiciones").val(),
        ciudad :  $("#ciudad").val(),
        avatar : "/../upload.php"
    }
    $.ajax({
    type : 'POST',
    data: values,
    url: 'guardar_hotel.php',
    beforeSend: function() {
        $(".loader").css("display", "inline-block")
    },
    success: function(respuesta) {
      $(".loader").css("display", "none")
      console.log(respuesta)
      let obj = JSON.parse(respuesta)
      if (obj.success) {
        
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
          
        },
        error: function() {
          $(".loader").css("display", "none")
          console.log("No se ha podido obtener la información");
        }
      });

      $("#select_pais").select2();
    
  }

  function traer_deptos(id) {

    if ( id.length < 1) {
      $("#select_deptos").html('<option value="">Seleccionar</option>').select2();
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
          
        },
        error: function() {
          $(".loader").css("display", "none")
          console.log("No se ha podido obtener la información");
        }
      });

      $("#select_deptos").select2();
    
  }

  function traer_terminos() {
      let values = { 
            codigo: 'traer_terminos',
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
          fila += ''
          $.each(obj["resultado"], function( index, val ) {
            fila += `<option value='${val.id}'>${val.titulo}</option>`
          });

          $("#select_terminos_condiciones").html('<option value="">Seleccionar</option>'+fila)
          
        },
        error: function() {
          $(".loader").css("display", "none")
          console.log("No se ha podido obtener la información");
        }
      });

      $("#select_terminos_condiciones").select2();
    
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
    
    $("#nit").val("").change()
    $("#nombre").val("").change()
    $("#email").val("").change()
    $("#telefono").val("").change()
    $("#direccion").val("").change()
    $("#select_pais").val("").change()
    $("#select_deptos").val("").change()
    $("#select_terminos_condiciones").val("").change()
    $("#ciudad").val("").change()
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
  function show_traer_tabla_hotel(){
    setTimeout(() => {
      traer_tabla_hotel()
    }, 100);
  }

  function traer_tabla_hotel(){

    if ( ! $.fn.DataTable.isDataTable('#tabla_hotel')) {
			  dtable = $("#tabla_hotel").DataTable({
          "scrollY": true,
					"ajax": {
					"url": "hoteles.php",
					"type": "POST",
					"deferRender": false,
					"data":{
            codigo:'trael_hoteles',
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
					{ "data": "nombre"},
					{ "data": "pais"},
          { "data": "depto"},
					{ "data": "ciudad"},
					{ "data": "telefono"},
          { "data": "email"},
          { "data": "fecha_crea"},
          { "data": ""}

				],
				 "columnDefs": [
					 {
						"targets": 8,
						"data":"",
						 render: function ( data, type, row ) {
							return  `<button class="btn btn-link" onclick="traer_cotizacion(${row.id})"><i class="fa fa-eye" aria-hidden="true"></i></button>`;
						 }
					}],
				});
			}else{
			   dtable.destroy();
         traer_tabla_hotel();
			}

  }

</script>
</body>
</html>