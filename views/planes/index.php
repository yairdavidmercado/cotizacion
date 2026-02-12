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
          <a class="nav-link active" onclick="traer_check_productos()" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Crear</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" onclick="show_traer_tabla_planes()" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Buscar</a>
        </li>
        <li class="nav-item">
          <a class="nav-link " id="productos-tab" data-toggle="tab" href="#productos" role="tab" aria-controls="productos" aria-selected="true">Crear productos</a>
        </li>
        <!-- <li class="nav-item">
          <a class="nav-link" id="list_productos-tab" data-toggle="tab" href="#list_productos" role="tab" aria-controls="list_productos" aria-selected="false">Buscar productos</a>
        </li> -->
      </ul>
      <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
          <div class="card mt-3">
            <h5 class="card-header">Planes</h5>
            <div class="card-body">
              <form role="form" onsubmit="event.preventDefault(); return GuardarPlanes();" id="form_guardar" class="needs-validation">
                <div class="row">
                  <div class="col-sm-6">
                    <div class="row">
                      <div class="col-md-12 mb-3" >
                        <label for="lastName">Nombre</label>
                        <input type="text" autocomplete="off" class="form-control " name="nombre_planes" id="nombre_planes" placeholder="" required>                    
                      </div>
                      <div class="col-md-12 mb-3">
                        <label for="firstName">Términos y condiciones</label>
                        <select style="width:100%" name="select_terminos_condiciones" required id="select_terminos_condiciones" class="form-control form-control-sm terminos_condiciones">
                          <option value="">Seleccionar</option>
                        </select>
                      </div>
                      <div class="col-md-12 mb-3">
                        <label for="lastName">Descripción</label>
                        <textarea style="height:300px"  autocomplete="off" class="form-control" id="descripcion_planes" required></textarea>
                      
                      </div>
                      <div class="col-md-12 mb-3 d-flex">
                        <button type="submit" class="btn btn-success mr-2">Guardar</button>
                        <!-- <div class="btn btn-warning text-white">Cancelar</div> -->
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="row">
                      <table class="table table-bordered table-condensed table-hover table-striped">
                        <thead>
                          <tr>
                              <th>
                              <input type="checkbox" onchange="select_check(this)" name="all">
                              </th>
                              <th >
                                PRODUCTOS
                              </th>
                              <th >
                                TIPO
                              </th>
                          </tr>
                        </thead>
                        <tbody class="text-left" id="table_check_productos">
                          
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
          <br>
          <br>
          <div class="responsive" style="width:100%">
            <table id="tabla_planes" class="table table-striped table-bordered" style="width:100%">
              <thead>
                  <tr>
                      <th>Nombre</th>
                      <th>Descripción</th>
                      <th>Cantidad de productos</th>
                      <th>Creación</th>
                      <th></th>
                      <th></th>
                  </tr>
              </thead>
              <tbody id="body_table_cotizacion">
                  
              </tbody>
            </table>
          </div>
        </div>
        <div class="tab-pane fade show" id="productos" role="tabpanel" aria-labelledby="productos-tab">
          <div class="card mt-3">
            <h5 class="card-header">Productos</h5>
            <div class="card-body">
              <form role="form" onsubmit="event.preventDefault(); return GuardarProductos();" id="form_guardar" class="needs-validation">
                <div class="row">
                  <div class="col-md-6 mb-3" >
                    <label for="lastName">Nombre de producto</label>
                    <input type="text" autocomplete="off" class="form-control " name="nombre_producto" id="nombre_producto" placeholder="" required>                    
                  </div>
                  <div class="col-md-6 mb-3">
                    <label for="firstName">Tipo</label>
                    <select style="width:100%" name="select_tipo" required id="select_tipo" class="form-control form-control-sm tipo">
                      <option value="">Seleccionar</option>
                      <!-- <option value="CONSUMO">CONSUMO</option> -->
                      <option selected value="SERVICIOS">SERVICIOS</option>
                    </select>
                  </div>
                  <div class="col-md-6 mb-3">
                    <label for="firstName">Tipo de guardado</label>
                    <select style="width:100%" name="select_tipo_guardado" required id="select_tipo_guardado" class="form-control form-control-sm tipo_guardado">
                      <option value="">Seleccionar</option>
                      <option value="0">General</option>
                      <option value="<?php echo $_SESSION['id_hotel'] ?>">Solo para <?php echo $_SESSION['nombre_hotel'] ?></option>
                    </select>
                  </div>
                  
                  <div class="col-md-12 mb-3 d-flex justify-content-center">
                    <button type="submit" class="btn btn-success mr-2">Guardar </button>
                    <!-- <div class="btn btn-warning text-white">Cancelar</div> -->
                  </div>
                </div>
                <div class="row">
                  <br>
                  <br>
                  <div class="responsive" style="width:100%">
                    <table id="tabla_productos" class="table table-striped table-bordered" style="width:100%">
                      <thead>
                          <tr>
                              <th>Nombre</th>
                              <th>Tipo</th>
                              <th>Tipo de guardado</th>
                              <th>Creación</th>
                              <th></th>
                              <th></th>
                          </tr>
                      </thead>
                      <tbody id="body_tabla_productos">
                          
                      </tbody>
                    </table>
                  </div>
                </div>
                
              </form>
            </div>
          </div>
        </div>
        <!-- <div class="tab-pane fade show" id="list_productos" role="tabpanel" aria-labelledby="list_productos-tab">
          list
        </div> -->
      </div>
        
        
      </div>
    </div>
  </main>

  <button type="button" id="brn_modal_print" class="btn btn-primary" style="display:none" data-toggle="modal" data-target="#modal_editar_planes">Large modal</button>

<div class="modal fade bd-example-modal-lg" id="modal_editar_planes" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <div id="btn_pdf">

        </div>
        <h5 class="modal-title">Editar planes</h5>
        <button type="button" class="close" id="close_modal_planes_edit" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body" id="print_cotizacion">
        <form role="form" onsubmit="event.preventDefault(); return EditarPlanes();" id="form_guardar" class="needs-validation">
          <div class="row">
            <div class="col-sm-6">
              <div class="row">
                <div class="col-md-12 mb-3" >
                  <label for="lastName">Nombre</label>
                  <input type="hidden" id="id_planes_edit">
                  <input type="text" autocomplete="off" class="form-control " name="nombre_planes_edit" id="nombre_planes_edit" placeholder="" required>                    
                </div>
                <div class="col-md-12 mb-3">
                  <label for="firstName">Términos y condiciones</label>
                  <select style="width:100%" name="select_terminos_condiciones_edit" required id="select_terminos_condiciones_edit" class="form-control form-control-sm terminos_condiciones">
                    <option value="">Seleccionar</option>
                  </select>
                </div>
                <div class="col-md-12 mb-3">
                  <label for="lastName">Descripción</label>
                  <textarea style="height:300px"  autocomplete="off" class="form-control" id="descripcion_planes_edit" required></textarea>
                
                </div>
                <div class="col-md-12 mb-3 d-flex">
                  <button type="submit" class="btn btn-success mr-2">Guardar</button>
                  <!-- <div class="btn btn-warning text-white">Cancelar</div> -->
                </div>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="row">
                <table class="table table-bordered table-condensed table-hover table-striped">
                  <thead>
                    <tr>
                        <th>
                        <input type="checkbox" onchange="select_check_edit(this)" name="all_edit">
                        </th>
                        <th >
                          PRODUCTOS
                        </th>
                        <th >
                          TIPO
                        </th>
                    </tr>
                  </thead>
                  <tbody class="text-left" id="table_check_productos_edit">
                    
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade bd-example-modal-lg" id="modal_editar_productos" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <div id="btn_pdf">

        </div>
        <h5 class="modal-title">Editar productos</h5>
        <button type="button" class="close" id="close_modal_productos_edit" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body" id="print_cotizacion">
        <form role="form" onsubmit="event.preventDefault(); return EditarProductos();" id="form_guardar" class="needs-validation">
          <div class="row">
            <div class="col-md-6 mb-3" >
              <label for="lastName">Nombre de producto</label>
              <input type="hidden" id="id_productos_edit">
              <input type="text" autocomplete="off" class="form-control " name="nombre_producto_edit" id="nombre_producto_edit" placeholder="" required>                    
            </div>
            <div class="col-md-6 mb-3">
              <label for="firstName">Tipo</label>
              <select style="width:100%" name="select_tipo_edit" required id="select_tipo_edit" class="form-control form-control-sm tipo">
                <option value="">Seleccionar</option>
                <option value="CONSUMO">CONSUMO</option>
                <option value="SERVICIOS">SERVICIOS</option>
              </select>
            </div>
            <div class="col-md-6 mb-3">
              <label for="firstName">Tipo de guardado</label>
              <select style="width:100%" name="select_tipo_guardado_edit" required id="select_tipo_guardado_edit" class="form-control form-control-sm tipo_guardado">
                <option value="">Seleccionar</option>
                <option value="0">General</option>
                <option value="<?php echo $_SESSION['id_hotel'] ?>">Solo para <?php echo $_SESSION['nombre_hotel'] ?></option>
              </select>
            </div>
            
            <div class="col-md-12 mb-3 d-flex justify-content-center">
              <button type="submit" class="btn btn-success mr-2">Guardar </button>
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
  $("#menu_planes").addClass("active");
  $("#menu_nombre_hotel").addClass("active");
  //traer_hotel()
  traer_tabla_productos()
  traer_check_productos()
  traer_terminos()
  $(".loader").css("display", "none")

});


function GuardarPlanes() { 
    var items = document.getElementsByName('brand')
    var count = 0
    if( $('.micheckbox').is(':checked') ) {
      count++
    }
    if (count < 1) {
      alert("Debe seleccionar almenos un producto")
      return false
    }
    var ids_productos = ""
    for (var i = 0; i < items.length; i++) {
        if (items[i].checked){
          ids_productos += items[i].value+","
        }     
    }
    ids_productos = ids_productos.substring(0, ids_productos.length - 1);
    //let form = $('#form_guardar')[0];
    //let formData = new FormData(form)
    let values = {
        nombre :  $("#nombre_planes").val(),
        id_terminos: $("#select_terminos_condiciones").val(),
        descripcion :  $("#descripcion_planes").val(),
        ids: ids_productos,
        id_hotel : id_hotel,
    }
    $.ajax({
    type : 'POST',
    data: values,
    url: 'guardar_planes.php',
    beforeSend: function() {
        $(".loader").css("display", "inline-block")
    },
    success: function(respuesta) {
      $(".loader").css("display", "none")
      console.log(respuesta)
      let obj = JSON.parse(respuesta)
      if (obj.success) {
        
        limpiar_formulario_planes()
        //traer_tabla_planes()
       
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

  function GuardarProductos() { 
    
    //let form = $('#form_guardar')[0];
    //let formData = new FormData(form)
    let values = {
        nombre :  $("#nombre_producto").val(),
        tipo :  $("#select_tipo").val(),
        id_hotel :  $("#select_tipo_guardado").val(),
    }
    $.ajax({
    type : 'POST',
    data: values,
    url: 'guardar_productos.php',
    beforeSend: function() {
        $(".loader").css("display", "inline-block")
    },
    success: function(respuesta) {
      $(".loader").css("display", "none")
      console.log(respuesta)
      let obj = JSON.parse(respuesta)
      if (obj.success) {
        
        limpiar_formulario_productos()
        traer_tabla_productos()
        traer_check_productos()
       
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

  function traer_check_productos() {
      let values = { 
            codigo: 'traer_check_productos',
            parametro1: id_hotel,
            parametro2: ""
      };
      $.ajax({
        type : 'POST',
        data: values,
        url: 'planes.php',
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
                        <td style="width:10px"><input value="${val.id}" type="checkbox" class="micheckbox" name="brand"></td>
                        <td>${val.nombre}</td>
                        <td>${val.tipo}</td>
                    </tr>`
          });

          $("#table_check_productos").html(fila)
          
        },
        error: function() {
          $(".loader").css("display", "none")
          console.log("No se ha podido obtener la información");
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


  function limpiar_formulario_productos(){
    
    $("#nombre_producto").val("").change()
    $("#select_tipo").val("").change()
    $("#select_tipo_guardado").val("").change()
  }

  function limpiar_formulario_planes(){
    
    $("#nombre_planes").val("").change()
    $("#select_terminos_condiciones").val("").change()
    $("#select_terminos_condiciones_edit").val("").change()
    $("#descripcion_planes").val("").change()
    uncheckAll()
    var items = document.getElementsByName('all');
    items[0].checked = false

  }


  function show_traer_tabla_planes(){
    setTimeout(() => {
      traer_tabla_planes()
    }, 100);
  }

  function traer_tabla_planes(){

    if ( ! $.fn.DataTable.isDataTable('#tabla_planes')) {
      dtable = $("#tabla_planes").DataTable({
        "scrollY": true,
        "ajax": {
        "url": "planes.php",
        "type": "POST",
        "deferRender": false,
        "data":{
          codigo:'traer_planes',
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
        { "data": "cantidad_productos"},
        { "data": "fecha_crea"},
        { "data": ""},
        { "data": ""}

      ],
      "columnDefs": [
        {
          "targets": 4,
          "data":"",
          render: function ( data, type, row ) {
            return  `<button class="btn btn-link" data-toggle="modal" data-target="#modal_editar_planes" onclick="traer_planes_id(${row.id})"><i class="fa fa-edit" aria-hidden="true"></i></button>`;
          }
        },
        {
          "targets": 5,
          "data":"",
          render: function ( data, type, row ) {
            return  `<button class="btn btn-link" style="color:red" onclick="EliminarPlanes(${row.id})"><i class="fa fa-trash" aria-hidden="true"></i></button>`;
          }
        }],
      });
    }else{
      dtable.destroy();
      traer_tabla_planes();
    }
  }

  function traer_tabla_productos(){

    if ( ! $.fn.DataTable.isDataTable('#tabla_productos')) {
			  dtable2 = $("#tabla_productos").DataTable({
          "scrollY": true,
					"ajax": {
					"url": "planes.php",
					"type": "POST",
					"deferRender": false,
					"data":{
            codigo:'traer_productos',
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
					{ "data": "tipo"},
          { "data": "tipo_guardado"},
          { "data": "fecha_crea"},
          { "data": ""},
          { "data": ""}

				],
				 "columnDefs": [
					 {
						"targets": 4,
						"data":"",
						 render: function ( data, type, row ) {
							return  `<a class="btn btn-link" data-toggle="modal" data-target="#modal_editar_productos" onclick="traer_productos_id(${row.id})"><i class="fa fa-edit" aria-hidden="true"></i></a>`;
						 }
					},
          {
						"targets": 5,
						"data":"",
						 render: function ( data, type, row ) {
							return  `<a class="btn btn-link" style="color:red" onclick="EliminarProductos(${row.id})"><i class="fa fa-trash" aria-hidden="true"></i></a>`;
						 }
					}],
				});
			}else{
			   dtable2.destroy();
         traer_tabla_productos();
			}

  }

  // Select all check boxes : Setting the checked property to true in checkAll() function
  function checkAll(){
        var items = document.getElementsByName('brand');
          for (var i = 0; i < items.length; i++) {
              if (items[i].type == 'checkbox')
                  items[i].checked = true;
          }
      }
  // Clear all check boxes : Setting the checked property to false in uncheckAll() function
      function uncheckAll(){
        var items = document.getElementsByName('brand');
          for (var i = 0; i < items.length; i++) {
              if (items[i].type == 'checkbox')
                  items[i].checked = false;
          }
      }

      function select_check(estado){
        if (estado.checked) {
          checkAll()
        }else{
          uncheckAll()
        }
      }

    function traer_planes_id(id) {
      let values = { 
            codigo: 'traer_planes_id',
            parametro1: id_hotel,
            parametro2: id
      };
      $.ajax({
        type : 'POST',
        data: values,
        url: 'planes.php',
        beforeSend: function() {
            $(".loader").css("display", "inline-block")
        },
        success: function(respuesta) {
          console.log(respuesta)
          $(".loader").css("display", "none")
          let obj = JSON.parse(respuesta)
          let fila = ''
          let checked = ''
          fila += ''
          $.each(obj["resultado"], function( index, val ) {
            $("#id_planes_edit").val(val.id).change()
            $("#nombre_planes_edit").val(val.nombre).change()
            $("#descripcion_planes_edit").val(val.descripcion).change()
            $("#select_terminos_condiciones_edit").val(val.id_terminos).change()
          })
          $.each(obj["info_productos"], function( index, val ) {
            if (val.checked == 1) {
              checked = 'checked'
            }else if(val.checked == 0){
              checked = ''
            }
            fila += `<tr>
                        <td style="width:10px"><input value="${val.id}" type="checkbox" ${checked} class="micheckbox_edit" name="brand_edit"></td>
                        <td>${val.nombre}</td>
                        <td>${val.tipo}</td>
                    </tr>`
          });

          $("#table_check_productos_edit").html(fila)
          
        },
        error: function() {
          $(".loader").css("display", "none")
          console.log("No se ha podido obtener la información");
        }
      });
    
    }

   // Select all check boxes : Setting the checked property to true in checkAll() function
   function checkAllEdit(){
        var items = document.getElementsByName('brand_edit');
          for (var i = 0; i < items.length; i++) {
              if (items[i].type == 'checkbox')
                  items[i].checked = true;
          }
      }
  // Clear all check boxes : Setting the checked property to false in uncheckAllEdit() function
      function uncheckAllEdit(){
        var items = document.getElementsByName('brand_edit');
          for (var i = 0; i < items.length; i++) {
              if (items[i].type == 'checkbox')
                  items[i].checked = false;
          }
      }

      function select_check_edit(estado){
        if (estado.checked) {
          checkAllEdit()
        }else{
          uncheckAllEdit()
        }
      }

  function EditarPlanes() { 
    var items = document.getElementsByName('brand_edit')
    var count = 0
    if( $('.micheckbox_edit').is(':checked') ) {
      count++
    }
    if (count < 1) {
      alert("Debe seleccionar almenos un producto")
      return false
    }
    var ids_productos = ""
    for (var i = 0; i < items.length; i++) {
        if (items[i].checked){
          ids_productos += items[i].value+","
        }     
    }
    ids_productos = ids_productos.substring(0, ids_productos.length - 1);
    //let form = $('#form_guardar')[0];
    //let formData = new FormData(form)
    let values = {
        id :  $("#id_planes_edit").val(),
        nombre :  $("#nombre_planes_edit").val(),
        id_terminos: $("#select_terminos_condiciones_edit").val(),
        descripcion :  $("#descripcion_planes_edit").val(),
        ids: ids_productos,
        id_hotel : id_hotel,
    }
    $.ajax({
    type : 'POST',
    data: values,
    url: 'editar_planes.php',
    beforeSend: function() {
        $(".loader").css("display", "inline-block")
    },
    success: function(respuesta) {
      $(".loader").css("display", "none")
      console.log(respuesta)
      let obj = JSON.parse(respuesta)
      if (obj.success) {
        traer_tabla_planes()
        $("#close_modal_planes_edit").click()
        //traer_tabla_planes()
       
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

function traer_productos_id(id) {
      let values = { 
            codigo: 'traer_productos_id',
            parametro1: id_hotel,
            parametro2: id
      };
      $.ajax({
        type : 'POST',
        data: values,
        url: 'planes.php',
        beforeSend: function() {
            $(".loader").css("display", "inline-block")
        },
        success: function(respuesta) {
          console.log(respuesta)
          $(".loader").css("display", "none")
          let obj = JSON.parse(respuesta)
          let fila = ''
          let checked = ''
          fila += ''
          $.each(obj["resultado"], function( index, val ) {
            $("#id_productos_edit").val(val.id).change()
            $("#nombre_producto_edit").val(val.nombre).change()
            $("#select_tipo_edit").val(val.tipo).change()
            $("#select_tipo_guardado_edit").val(val.tipo_guardado).change()
          })
          $.each(obj["info_productos"], function( index, val ) {
            if (val.checked == 1) {
              checked = 'checked'
            }else if(val.checked == 0){
              checked = ''
            }
            fila += `<tr>
                        <td style="width:10px"><input value="${val.id}" type="checkbox" ${checked} class="micheckbox_edit" name="brand_edit"></td>
                        <td>${val.nombre}</td>
                        <td>${val.tipo}</td>
                    </tr>`
          });

          $("#table_check_productos_edit").html(fila)
          
        },
        error: function() {
          $(".loader").css("display", "none")
          console.log("No se ha podido obtener la información");
        }
      });
    
    }

  function EditarProductos() { 
    
    let values = {
        id :  $("#id_productos_edit").val(),
        nombre :  $("#nombre_producto_edit").val(),
        tipo :  $("#select_tipo_edit").val(),
        id_hotel :  $("#select_tipo_guardado_edit").val(),
    }
    $.ajax({
    type : 'POST',
    data: values,
    url: 'editar_productos.php',
    beforeSend: function() {
        $(".loader").css("display", "inline-block")
    },
    success: function(respuesta) {
      $(".loader").css("display", "none")
      console.log(respuesta)
      let obj = JSON.parse(respuesta)
      if (obj.success) {
        $('#close_modal_productos_edit').click()
        traer_tabla_productos()
        traer_check_productos()
       
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

  function EliminarPlanes(id) {
    
    let values = {
      id :  id,
      tabla : 'planes',
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
        traer_tabla_planes()
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

function EliminarProductos(id) {
    
    let values = {
      id :  id,
      tabla : 'productos',
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
        traer_tabla_productos()
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
      $("#select_terminos_condiciones_edit").html('<option value="">Seleccionar</option>'+fila)
      
    },
    error: function() {
      $(".loader").css("display", "none")
      console.log("No se ha podido obtener la información");
    }
  });

  $("#select_terminos_condiciones").select2();

}

</script>
</body>
</html>