<?php
// start a session
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
          <a class="nav-link" onclick="show_traer_tabla_motivos()" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Buscar</a>
        </li>
      </ul>
      <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
          <div class="card mt-3">
            <h5 class="card-header">Motivos</h5>
            <div class="card-body">
              <form role="form" onsubmit="event.preventDefault(); return GuardarMotivos();" id="form_guardar" class="needs-validation">
                <div class="row">
                  <div class="col-md-12 mb-3" >
                    <label for="lastName">Titulo</label>
                    <input type="text" autocomplete="off" class="form-control " name="nombre" id="nombre" placeholder="" required>                    
                  </div>
                  <div class="col-md-12 mb-3" >
                    <label for="lastName">Descripci??n</label>
                    <textarea class="form-control" id="descripcion"></textarea>
                  </div>
                  <div class="col-md-12 mb-3 d-flex justify-content-center">
                    <button type="submit" class="btn btn-success mr-2">Guardar</button>
                    <!-- <div class="btn btn-warning text-white">Cancelar</div> -->
                  </div>
                </div>                
              </form>
            </div>
          </div>
        </div>
        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
          <br>
          <br>
        <div class="responsive">
          <table id="tabla_motivos" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Descripci??n</th>
                    <th>Creaci??n</th>
                    <th></th>
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

  <button type="button" id="brn_modal_print" class="btn btn-primary" style="display:none" data-toggle="modal" data-target="#modal_editar_motivos">Large modal</button>

<div class="modal fade modal_editar_motivos" id="modal_editar_motivos" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <div id="btn_pdf">

        </div>
        <h5 class="modal-title">Editar motivos</h5>
        <button type="button" class="close" id="close_modal_editar_motivos" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">??</span>
        </button>
      </div>
      <div class="modal-body" id="print_cotizacion">
        <form role="form" onsubmit="event.preventDefault(); return EditarMotivos();" id="form_guardar" class="needs-validation">
          <div class="row">
            <div class="col-md-12 mb-3" >
              <label for="lastName">Titulo</label>
              <input type="hidden" id="id_edit">
              <input type="text" autocomplete="off" class="form-control " name="nombre_edit" id="nombre_edit" placeholder="" required>                    
            </div>
            <div class="col-md-12 mb-3" >
              <label for="lastName">Descripci??n</label>
              <textarea class="form-control" id="descripcion_edit"></textarea>
            </div>
            <div class="col-md-12 mb-3 d-flex justify-content-center">
              <button type="submit" class="btn btn-success mr-2">Guardar</button>
              <!-- <div class="btn btn-warning text-white">Cancelar</div> -->
            </div>
          </div>                
        </form>
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
  $("#menu_motivos").addClass("active");
  $("#menu_nombre_hotel").addClass("active");
  //traer_hotel()
  //traer_planes()
  $(".loader").css("display", "none")

});


function GuardarMotivos() {
    
    //let form = $('#form_guardar')[0];
    //let formData = new FormData(form)
    let values = {
      nombre : $("#nombre").val(),
      id_hotel : id_hotel,
      descripcion : $("#descripcion").val(),
    }
    $.ajax({
    type : 'POST',
    data: values,
    url: 'guardar_motivos.php',
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
      console.log("No se ha podido obtener la informaci??n"+e);
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


  function limpiar_formulario(){
    
      $("#nombre").val("")
      $("#descripcion").val("")
  }


  function show_traer_tabla_motivos(){
    setTimeout(() => {
      traer_tabla_motivos()
    }, 100);
  }

  function traer_tabla_motivos(){

    if ( ! $.fn.DataTable.isDataTable('#tabla_motivos')) {
			  dtable = $("#tabla_motivos").DataTable({
          "scrollY": true,
					"ajax": {
					"url": "motivos.php",
					"type": "POST",
					"deferRender": false,
					"data":{
            codigo:'traer_motivos',
            parametro1: id_hotel,
            parametro2: "",
          },
					"dataSrc": function (data) {	
            console.log(data)
						return data.data
					}

				  },
				  "columns": [
					{ "data": "nombre"},
					{ "data": "descripcion"},
          { "data": "fecha_crea"},
          { "data": ""},
          { "data": ""}
				],
				 "columnDefs": [
					 {
						"targets": 3,
						"data":"",
						 render: function ( data, type, row ) {
							return  `<button class="btn btn-link" data-toggle="modal" data-target="#modal_editar_motivos" onclick="traer_motivos(${row.id})"><i class="fa fa-edit" aria-hidden="true"></i></button>`;
						 }
					},
          {
						"targets": 4,
						"data":"",
						 render: function ( data, type, row ) {
							return  `<button class="btn btn-link" style="color:red" onclick="EliminarMotivos(${row.id})"><i class="fa fa-trash" aria-hidden="true"></i></button>`;
						 }
					}],
				});
			}else{
			   dtable.destroy();
         traer_tabla_motivos();
			}

  }

  function traer_motivos(id) {
    let values = { 
            codigo: 'traer_motivos_id',
            parametro1: id,
            parametro2: ""
      };
      $.ajax({
        type : 'POST',
        data: values,
        url: 'motivos.php',
        beforeSend: function() {
            $(".loader").css("display", "inline-block")
        },
        success: function(respuesta) {
          $(".loader").css("display", "none")
          let obj = JSON.parse(respuesta)
          let fila = ''
          $.each(obj["resultado"], function( index, val ) {
            $("#id_edit").val(val.id)
            $("#nombre_edit").val(val.nombre).change()
            $("#descripcion_edit").val(val.descripcion).change()
          });
          
        },
        error: function() {
          $(".loader").css("display", "none")
          console.log("No se ha podido obtener la informaci??n");
        }
      });
    
  }

  
function EditarMotivos() {
    
    //let form = $('#form_guardar')[0];
    //let formData = new FormData(form)
    let values = {
      id : $("#id_edit").val(),
      nombre : $("#nombre_edit").val(),
      id_hotel : id_hotel,
      descripcion : $("#descripcion_edit").val(),
    }
    $.ajax({
    type : 'POST',
    data: values,
    url: 'editar_motivos.php',
    beforeSend: function() {
        $(".loader").css("display", "inline-block")
    },
    success: function(respuesta) {
      $(".loader").css("display", "none")
      console.log(respuesta)
      let obj = JSON.parse(respuesta)
      if (obj.success) {
        $("#close_modal_editar_motivos").click()
        traer_tabla_motivos()
        alert(obj.message)
      }else{
        alert(obj.message)
      }

    },
    error: function(e) {
      $(".loader").css("display", "none")
      console.log("No se ha podido obtener la informaci??n"+e);
    }
  });
    
}

function EliminarMotivos(id) {
    
    let values = {
      id :  id,
      tabla : 'motivos',
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
        traer_tabla_motivos()
        $("#close_modal_edit_usuario").click()
      
      }else{
        alert(obj.message)
      }

    },
    error: function(e) {
      $(".loader").css("display", "none")
      console.log("No se ha podido obtener la informaci??n"+e);
    }
  });
    
}

</script>
</body>
</html>