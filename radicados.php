
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.6">
    <title>Mis radicados</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.4/examples/offcanvas/">

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">

<meta name="theme-color" content="#563d7c">


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
  <body class="bg-light">
  <?php require("menu.php"); ?>
  <div class="loader"></div>
  <br>
  <br>
<main role="main" class="container py-5">
<div class="row">
  <div class="col-md-12 order-md-1">
  <div class="float-right"><img src="assets/img/logos.png" width="300px" alt="" srcset=""></div>
    <h4 class="mb-3">Consultar radicados</h4>
    <form role="form" onsubmit="event.preventDefault(); return ShowRadicado();" class="needs-validation">
      <div class="row">
        <div class="col-md-3 mb-3">
          <label for="firstName">Número de radicado</label>
          <input type="text" placeholder="Presione ENTER para buscar" class="form-control" id="radicado" placeholder="" value="" required>
          <div class="invalid-feedback">
            Valid first name is required.
          </div>
        </div>
        <div class="col-md-3 mb-3">
          <label for="lastName">Código de verificación</label>
          <input type="text" placeholder="Presione ENTER para buscar" class="form-control" id="cv" placeholder="" value="" required>
          <div class="invalid-feedback">
            Valid last name is required.
          </div>
        </div>
        <div class="col-md-3" style="margin-top: 31px;">
            <button class="btn btn-success" type="submit">Consultar</button>
        </div>
      </div>
    </form>
    <div class="table-responsive-sm" >
    <table id="example" style="font-size:11px" class="table table-striped table-bordered" >
        <thead >
            <tr>
                <th style="width:10px">Radicado</th>
                <th style="width:300px">Nombre</th>
                <th style="width:300px">Asunto</th>
                <!-- <th style="width:10px">Dias de tramite</th> -->
                <th style="width:150px">Fecha</th>
                <th style="width:10px">Tramite</th>
                <th style="width:10px">Respuesta</th>
                <th style="width:10px">Subir radicado</th>
                <!-- <th style="width:10px">Descargar respuesta</th> -->
            </tr>
        </thead>
        <tbody id="tbodytable">
            
        </tbody>
        <tfoot>
            <tr>
                <th style="width:10px">Radicado</th>
                <th style="width:300px">Nombre</th>
                <th style="width:300px">Asunto</th>
                <!-- <th style="width:10px">Dias de tramite</th> -->
                <th style="width:10px">Fecha</th>
                <th style="width:10px">Tramite</th>
                <th style="width:10px">Respuesta</th>
                <th style="width:10px"></th>
            </tr>
        </tfoot>
    </table>
    </div>
    
  </div>
</div>
</main>
<script src="assets/js/jquery.slim.min.js" crossorigin="anonymous"></script>
<script>window.jQuery || document.write('<script src="assets/js/jquery.slim.min.js"><\/script>')</script>
<script src="assets/js/jquery.slim.min.js" crossorigin="anonymous"></script>
<script src="assets/js/ajax/jquery.min.js"></script>
<script src="assets/js/dataTables/jquery.dataTables.min.js"></script>
<script src="assets/js/dataTables/js/dataTables.bootstrap4.min.js"></script>
<script>
$(function() {
  $(".loader").css("display", "none")

  // $("#cv").keyup(function(e){ 
  //   var code = e.which; // recommended to use e.which, it's normalized across browsers
  //   if(code==13)e.preventDefault();
  //   if(code==32||code==13||code==188||code==186){
  //     ShowRadicado("2")
  //       //alert('Has presionado enter en el campo de cv')
  //   } // missing closing if brace
  // });
});

function ShowRadicado() {
    let values = { 
          cod: '1',
          radi: $('#radicado').val(),
          id: $('#cv').val()
    };
    $.ajax({
    type : 'POST',
    data: values,
    url: 'php/sel_radicado.php',
    beforeSend: function() {
        $(".loader").css("display", "inline-block")
    },
    success: function(respuesta) {
      $(".loader").css("display", "none")
       let obj = JSON.parse(respuesta)
       $("#example").dataTable().fnDestroy();
       let fila = ''
       $.each(obj[0], function( index, val ) {
         fila += '<tr>'+
                      '<td>'+val.id_radi+'</td>'+
                      '<td>'+val.razon+'</td>'+
                      '<td>'+val.asunto+'</td>'+
                      // '<td>'+val.dias_tramite+'</td>'+
                      '<td>'+val.fecha+'</td>'+
                      '<td>'+val.leido+'</td>'+
                      '<td>'+val.respuesta+'</td>'+
                      '<td><input style="display:none" id="subir_radicado" type="file"><a onclick="subir_radicado()" class="btn btn-sm btn-primary" style="color:#fff"><i class="fa fa-upload"></i></a></td>'+
                    //   '<td><a href="ftp://10.10.10.34/imagenes/Censo.png" class="btn btn-sm btn-danger" style="color:#fff"><i class="fa fa-file-pdf-o"></i></a></td>'+
                  '</tr>'
      });
      $("#tbodytable").html(fila)
      $('#example').DataTable();
        //$('#example').DataTable().ajax.reload();
    },
    error: function() {
      $(".loader").css("display", "")
      console.log("No se ha podido obtener la información");
    }
  });
    
  }

  function subir_radicado() {
    $("#subir_radicado").click()
  }
</script>
</body>
</html>
