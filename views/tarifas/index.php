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
          <a class="nav-link" onclick="show_traer_tabla_tarifas()" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Buscar</a>
        </li>
      </ul>
      <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
          <div class="card mt-3">
            <h5 class="card-header">Tarifas</h5>
            <div class="card-body">
              <form role="form" onsubmit="event.preventDefault(); return GuardarTarifas();" id="form_guardar" class="needs-validation">
                <div class="row">
                  <div class="col-md-6 mb-3" >
                    <label for="lastName">Titulo</label>
                    <input type="text" autocomplete="off" class="form-control " name="nombre" id="nombre" placeholder="" required>                    
                  </div>
                  <div class="col-md-6 mb-3">
                    <label><span>Tipo de servicio</span></label>
                    <br>
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input type="radio" name="tipo_hospedaje" onclick='mostrarOpciones(0, [])'  required value="0" class="form-check-input" >Pasadía
                      </label>
                    </div>
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input type="radio" name="tipo_hospedaje" onclick='mostrarOpciones(1, [])' required value="1" class="form-check-input" >Por noche
                      </label>
                    </div>
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input type="radio" name="tipo_hospedaje" onclick='mostrarOpciones(2, [])' required value="2" class="form-check-input" >Alquiler
                      </label>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6 mb-3">
                    <label><span>Tipo de plan</span></label>
                    <br>
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input type="radio" name="tipo_plan_tarifa" onclick="onTipoPlanChange(this.value)" required value="1" class="form-check-input" >Alojamiento
                      </label>
                    </div>
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input type="radio" name="tipo_plan_tarifa" onclick="onTipoPlanChange(this.value)" required value="2" class="form-check-input" >Tour
                      </label>
                    </div>
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input type="radio" name="tipo_plan_tarifa" onclick="onTipoPlanChange(this.value)" required value="3" class="form-check-input" >Alquiler
                      </label>
                    </div>
                  </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                      <label for="firstName">Planes</label>
                      <select style="width:100%" name="select_plan" required id="select_plan" class="form-control form-control-sm terminos_condiciones">
                        <option value="">Seleccionar</option>
                      </select>
                    </div>
                </div>
                <div class="row " id='iniciartarifas'>
                  
                </div>
                <div class="row">
                    <div class="col-md-12 mb-3" >
                      <label for="lastName">Descripción</label>
                      <textarea class="form-control" id="descripcion"></textarea>
                    </div>
                    <div class="col-md-12 mb-3 d-flex justify-content-center">
                      <button type="submit" class="btn btn-success mr-2">Guardar</button>
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
          <table id="tabla_tarifas" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>Titulo</th>
                    <th>descripcion</th>
                    <th>Niños</th>
                    <th>Adultos</th>
                    <th>Adultos dobles</th>
                    <th>Adultos triples/dobles</th>
                    <th>planes</th>
                    <th>tipo de hospedaje</th>
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
      </div>
        
        
      </div>
    </div>
  </main>

  <button type="button" id="brn_modal_print" class="btn btn-primary" style="display:none" data-toggle="modal" data-target="#modal_editar_tarifas">Large modal</button>

<div class="modal fade bd-example-modal-lg" id="modal_editar_tarifas" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <div id="btn_pdf">

        </div>
        <h5 class="modal-title">Editar tarifas</h5>
        <button type="button" class="close" id="close_modal_tarifas" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body" id="print_cotizacion">
        <form role="form" onsubmit="event.preventDefault(); return EditarTarifas();" id="form_guardar" class="needs-validation">
          <div class="row">
            <div class="col-md-6 mb-3" >
              <label for="lastName">Titulo</label>
              <input type="hidden" autocomplete="off" id="id_edit">
              <input type="text" autocomplete="off" class="form-control " name="nombre_edit" id="nombre_edit" placeholder="" required>                    
            </div>
            <div class="col-md-6 mb-3">
              <label><span>Tipo de servicio</span></label>
              <br>
              <div class="form-check-inline">
                <label class="form-check-label">
                  <input type="radio" name="tipo_hospedaje_edit" onclick='mostrarOpciones(0, [], 1)' id="tipo_hospedaje_edit0" required value="0" class="form-check-input">Pasadía
                </label>
              </div>
              <div class="form-check-inline">
                <label class="form-check-label">
                  <input type="radio" name="tipo_hospedaje_edit" onclick='mostrarOpciones(1, [], 1)' id="tipo_hospedaje_edit1" required value="1" class="form-check-input">Por noche
                </label>
              </div>
              <div class="form-check-inline">
                <label class="form-check-label">
                  <input type="radio" name="tipo_hospedaje_edit" onclick='mostrarOpciones(2, [], 1)' id="tipo_hospedaje_edit2" required value="2" class="form-check-input">Alquiler
                </label>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6 mb-3">
              <label><span>Tipo de plan</span></label>
              <br>
              <div class="form-check-inline">
                <label class="form-check-label">
                  <input type="radio" name="tipo_plan_tarifa_edit" onclick="onTipoPlanChange(this.value, 1)" id="tipo_plan_tarifa_edit1" required value="1" class="form-check-input" >Alojamiento
                </label>
              </div>
              <div class="form-check-inline">
                <label class="form-check-label">
                  <input type="radio" name="tipo_plan_tarifa_edit" onclick="onTipoPlanChange(this.value, 1)" id="tipo_plan_tarifa_edit2" required value="2" class="form-check-input" >Tour
                </label>
              </div>
              <div class="form-check-inline">
                <label class="form-check-label">
                  <input type="radio" name="tipo_plan_tarifa_edit" onclick="onTipoPlanChange(this.value, 1)" id="tipo_plan_tarifa_edit3" required value="3" class="form-check-input" >Alquiler
                </label>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="firstName">Planes</label>
              <select style="width:100%" name="select_plan_edit" required id="select_plan_edit" class="form-control form-control-sm terminos_condiciones">
                <option value="">Seleccionar</option>
              </select>
            </div>
          </div>
          <div class="row" id='iniciartarifas_edit'>
            
          </div>
          <div class="row">
            <div class="col-md-12 mb-3" >
              <label for="lastName">Descripción</label>
              <textarea class="form-control" id="descripcion_edit"></textarea>
            </div>
            <div class="col-md-12 mb-3 d-flex justify-content-center">
              <button type="submit" class="btn btn-success mr-2">Guardar</button>
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
  $("#menu_tarifas").addClass("active");
  $("#menu_nombre_hotel").addClass("active");
  //traer_hotel()
  $(".loader").css("display", "none")

});

function onTipoPlanChange(idTipoPlan, edit) {
  let isEdit = edit === 1 || edit === '1'
  if (isEdit) {
    $("#select_plan_edit").val("").change()
  } else {
    $("#select_plan").val("").change()
  }
  traer_planes(idTipoPlan, "", isEdit)
}

function mostrarOpciones(id, params, edit) {
  let campo1 = ''
  let campo2 = ''
  let campo3 = ''
  let campo4 = ''

  let edicion = ''
  if (edit == '1') {
    edicion = '_edit'
  }
  if (params.length > 0) {
    campo1 = params[0].campo1
    campo2 = params[0].campo2
    campo3 = params[0].campo3
    campo4 = params[0].campo4
  }

  if (id == '0') {
    $(`#iniciartarifas${edicion}`).html(`<div class="col-md-3 mb-3 inputsecundario">
                    <label for="lastName">Niños (3-11 Años)</label>
                    <input type="text" autocomplete="off" value='${campo1}' class="form-control" onkeypress="return isNumber(event)" name="child" id="child" placeholder="" required>                   
                  </div>
                  <div class="col-md-3 mb-3 inputsecundario">
                    <label for="lastName">Adultos </label>
                    <input type="text" autocomplete="off" class="form-control" value='${campo2}' onkeypress="return isNumber(event)" name="adult_s${edicion}" id="adult_s${edicion}" placeholder="" required>                   
                  </div>`)
  } else if (id == '1') {
    $(`#iniciartarifas${edicion}`).html(`<div class="col-md-3 mb-3 inputsecundario">
                                  <label for="lastName">Niños</label>
                                  <input type="text" autocomplete="off" value='${campo1}' class="form-control" onkeypress="return isNumber(event)" name="child${edicion}" id="child${edicion}" placeholder="" required>                   
                                </div>
                                <div class="col-md-3 mb-3 inputsecundario">
                                  <label for="lastName">Adultos individual</label>
                                  <input type="text" autocomplete="off" class="form-control" value='${campo2}' onkeypress="return isNumber(event)" name="adult_s${edicion}" id="adult_s${edicion}" placeholder="" required>                   
                                </div>
                                <div class="col-md-3 mb-3 inputsecundario">
                                  <label for="lastName">Adultos doble</label>
                                  <input type="text" autocomplete="off" class="form-control" value='${campo3}' onkeypress="return isNumber(event)" name="adult_d${edicion}" id="adult_d${edicion}" placeholder="" required>                   
                                </div>
                                <div class="col-md-3 mb-3 inputsecundario">
                                  <label for="lastName">Adultos triple/cuadruple</label>
                                  <input type="text" autocomplete="off" class="form-control" value='${campo4}' onkeypress="return isNumber(event)" name="adult_t_c${edicion}" id="adult_t_c${edicion}" placeholder="" required>                   
                                </div>`)
  } else if (id == '2') {
    $(`#iniciartarifas${edicion}`).html(`<div class="col-md-3 mb-3 inputsecundario">
                                  <label for="lastName">Valor Alquiler</label>
                                  <input type="text" autocomplete="off" value='${campo2}' class="form-control" onkeypress="return isNumber(event)" name="adult_s${edicion}" id="adult_s${edicion}" placeholder="" required>                   
                                </div>`)
  }
  
}


function GuardarTarifas() {
    
    //let form = $('#form_guardar')[0];
    //let formData = new FormData(form)
    let values = {
      nombre : $("#nombre").val(),
      child : $("#child").val() ? $("#child").val() : '0',
      adult_s : $("#adult_s").val() ? $("#adult_s").val() : '0',
      adult_d : $("#adult_d").val() ? $("#adult_d").val() : '0',
      adult_t_c : $("#adult_t_c").val() ? $("#adult_t_c").val() : '0',
      id_plan : $("#select_plan").val(),
      id_hotel : id_hotel,
      descripcion : $("#descripcion").val(),
      noches : $("input[name='tipo_hospedaje']:checked").val(),
    }
    $.ajax({
    type : 'POST',
    data: values,
    url: 'guardar_tarifas.php',
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

    function traer_planes(idTipoPlan, idPlanSeleccionado, isEdit) {
    let values = { 
      codigo: 'traer_planes',
      parametro1: id_hotel,
      parametro2: idTipoPlan ? idTipoPlan : ""
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
          if (obj["resultado"]) {
            $.each(obj["resultado"], function( index, val ) {
              fila += `<option value='${val.id}'>${val.nombre}</option>`
            });
          }

          $("#select_plan").html('<option value="">Seleccionar</option>'+fila)
          $("#select_plan_edit").html('<option value="">Seleccionar</option>'+fila)

          if (idPlanSeleccionado) {
            if (isEdit) {
              $("#select_plan_edit").val(idPlanSeleccionado).change()
            } else {
              $("#select_plan").val(idPlanSeleccionado).change()
            }
          }

          if ($("#select_plan").hasClass("select2-hidden-accessible")) {
            $("#select_plan").select2('destroy');
          }
          if ($("#select_plan_edit").hasClass("select2-hidden-accessible")) {
            $("#select_plan_edit").select2('destroy');
          }
          $("#select_plan").select2();
          $("#select_plan_edit").select2();
          
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


  function limpiar_formulario(){
    
      $("#nombre").val("")
      $("#child").val("")
      $("#adult_s").val("")
      $("#adult_d").val("")
      $("#adult_t_c").val("")
      $("#id_plan").val("")
      $("#descripcion").val("")
      $("#select_plan").val("").change()
      $("input:radio[name='tipo_hospedaje']").prop('checked',false);
        $("input:radio[name='tipo_plan_tarifa']").prop('checked',false);
  }


  function show_traer_tabla_tarifas(){
    setTimeout(() => {
      traer_tabla_tarifas()
    }, 100);
  }

  function traer_tabla_tarifas(){

    if ( ! $.fn.DataTable.isDataTable('#tabla_tarifas')) {
			  dtable = $("#tabla_tarifas").DataTable({
          "scrollY": true,
					"ajax": {
					"url": "tarifas.php",
					"type": "POST",
					"deferRender": false,
					"data":{
            codigo:'traer_tarifas',
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
          { "data": "child"},
					{ "data": "adult_s"},
					{ "data": "adult_d"},
          { "data": "adult_t_c"},
          { "data": "nombre_plan"},
          { "data": "noches"},
          { "data": "fecha_crea"},
          { "data": ""},
          { "data": ""}
				],
				 "columnDefs": [
					 {
						"targets": 9,
						"data":"",
						 render: function ( data, type, row ) {
							return  `<button class="btn btn-link"  data-toggle="modal" data-target="#modal_editar_tarifas" onclick="traer_tarifas(${row.id})"><i class="fa fa-edit" aria-hidden="true"></i></button>`;
						 }
					},
          {
						"targets": 10,
						"data":"",
						 render: function ( data, type, row ) {
							return  `<button class="btn btn-link" style="color:red" onclick="EliminarTarifas(${row.id})"><i class="fa fa-trash" aria-hidden="true"></i></button>`;
						 }
					}],
				});
			}else{
			   dtable.destroy();
         traer_tabla_tarifas();
			}

  }

  function traer_tarifas(id) {
    let values = { 
            codigo: 'traer_tarifas_id',
            parametro1: id_hotel,
            parametro2: id
      };
      $.ajax({
        type : 'POST',
        data: values,
        url: 'tarifas.php',
        beforeSend: function() {
            $(".loader").css("display", "inline-block")
        },
        success: function(respuesta) {
          $(".loader").css("display", "none")
          let obj = JSON.parse(respuesta)
          let fila = ''
          $.each(obj["resultado"], function( index, val ) {
            $("#id_edit").val(val.id)
            $("#nombre_edit").val(val.nombre)
            $("#child_edit").val(val.child)
            $("#adult_s_edit").val(val.adult_s)
            $("#adult_d_edit").val(val.adult_d)
            $("#adult_t_c_edit").val(val.adult_t_c)
            $("#id_plan_edit").val(val.id_plan)
            $("#descripcion_edit").val(val.descripcion)

            $("input:radio[name='tipo_plan_tarifa_edit']").prop('checked', false);
            if (val.id_tipo_plan && val.id_tipo_plan != '0') {
              $("input:radio[name='tipo_plan_tarifa_edit'][value='"+val.id_tipo_plan+"']").prop('checked', true);
              traer_planes(val.id_tipo_plan, val.nombre_plan, true)
            } else {
              $("#select_plan_edit").val(val.nombre_plan).change()
            }
            var values = [{campo1: val.child, campo2: val.adult_s, campo3: val.adult_d, campo4: val.adult_t_c}]
            if (val.noches == 0) {
              mostrarOpciones(val.noches, values, 1)
              $("#tipo_hospedaje_edit1").prop('checked',false).prop('disabled',true);
              $("#tipo_hospedaje_edit2").prop('checked',false).prop('disabled',true);
              $("#tipo_hospedaje_edit0").prop('checked',true).prop('disabled',false);              
            }else if (val.noches == 1) {
              mostrarOpciones(val.noches, values, 1)
              $("#tipo_hospedaje_edit1").prop('checked',true).prop('disabled',false);
              $("#tipo_hospedaje_edit2").prop('checked',false).prop('disabled',true);
              $("#tipo_hospedaje_edit0").prop('checked',false).prop('disabled',true);

            }else if (val.noches == 2) {
              mostrarOpciones(val.noches, values, 1)
              $("#tipo_hospedaje_edit1").prop('checked',false).prop('disabled',true);
              $("#tipo_hospedaje_edit2").prop('checked',true).prop('disabled',false);
              $("#tipo_hospedaje_edit0").prop('checked',false).prop('disabled',true);
            }
          });
          
        },
        error: function() {
          $(".loader").css("display", "none")
          console.log("No se ha podido obtener la información");
        }
      });
    
  }

  function EditarTarifas() {
    
    //let form = $('#form_guardar')[0];
    //let formData = new FormData(form)
    console.log($("#adult_s_edit").val())
    let values = {
      id : $("#id_edit").val(),
      nombre : $("#nombre_edit").val(),
      child : $("#child_edit").val() ? $("#child_edit").val() : '0',
      adult_s : $("#adult_s_edit").val() ? $("#adult_s_edit").val() : '0',
      adult_d : $("#adult_d_edit").val() ? $("#adult_d_edit").val() : '0',
      adult_t_c : $("#adult_t_c_edit").val() ? $("#adult_t_c_edit").val() : '0',
      id_plan : $("#select_plan_edit").val(),
      id_hotel : id_hotel,
      descripcion : $("#descripcion_edit").val(),
      noches : $("input[name='tipo_hospedaje_edit']:checked").val(),
    }
    $.ajax({
    type : 'POST',
    data: values,
    url: 'editar_tarifas.php',
    beforeSend: function() {
        $(".loader").css("display", "inline-block")
    },
    success: function(respuesta) {
      $(".loader").css("display", "none")
      //console.log(respuesta)
      let obj = JSON.parse(respuesta)
      if (obj.success) {
        $("#close_modal_tarifas").click()
        traer_tabla_tarifas()
        alert(obj.message)
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

function EliminarTarifas(id) {
    
    let values = {
      id :  id,
      tabla : 'tarifas',
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
        traer_tabla_tarifas()
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

</script>
</body>
</html>