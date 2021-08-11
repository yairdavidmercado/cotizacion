<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.5">
    <title>Regístrate</title>
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
    <div class="mb-4 text-center"><img src="assets/img/logos.png" width="200px" alt="" srcset=""></div>
    <h4 class="card-title mt-3 text-center">Crear cuenta personal</h4>
    <article class="card-body mx-auto" style="max-width: 400px;">
        <form id="form_registro" onsubmit="event.preventDefault(); return GuardarRegistro();">
                <div class="d-block my-3">
                    <div onclick="tipo_persona('1')" class="custom-control custom-radio custom-control-inline">
                        <input id="credit" name="paymentMethod" type="radio" class="custom-control-input" checked >
                        <label class="custom-control-label" for="credit">Persona Natural</label>
                    </div>
                    <div onclick="tipo_persona('2')" class="custom-control custom-radio custom-control-inline">
                        <input id="debit" name="paymentMethod" type="radio" class="custom-control-input">
                        <label class="custom-control-label" for="debit">Persona Jurídica</label>
                    </div>
                </div>
                <span class="help-block text-danger" style="font-size:10px">(*) Campo obligatorio</span>
                <div class="form-group input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"> <i class="fa fa-id-card"></i> </span>
                    </div>
                    <select name="conse_tipo_id" required class="custom-select tipo_identificaciones">
                        <option value="">Tipo identificación</option>
                    </select>
                </div> <!-- form-group// -->
                <span class="help-block text-danger" style="font-size:10px">(*) Campo obligatorio</span>
                <div class="form-group input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                    </div>
                    <input name="id_tercero" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" required class="form-control" placeholder="Identificación" type="text">
                </div> <!-- form-group// -->
                <span class="help-block text-danger" style="font-size:10px">(*) Campo obligatorio</span>
                <div class="form-group input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                    </div>
                    <input name="nombre1" required class="form-control" placeholder="Primer nombre" type="text">
                    <input name="nombre2" class="form-control" placeholder="Segundo nombre" type="text">
                </div> <!-- form-group// -->
                <span class="help-block text-danger" style="font-size:10px">(*) Campo obligatorio</span>
                <div class="form-group input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                    </div>
                    <input name="apellido1" required class="form-control" placeholder="Primer apellido" type="text">
                    <input name="apellido2" class="form-control" placeholder="Segundo apellido" type="text">
                </div> <!-- form-group// -->
                <span class="help-block text-danger" style="font-size:10px">(*) Campo obligatorio</span>
                <div class="form-group input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
                    </div>
                    <input name="email" id="email" required class="form-control" placeholder="Email" type="email">
                </div> <!-- form-group// -->
                <span class="help-block text-danger" style="font-size:10px">(*) Campo obligatorio</span>
                <div class="form-group input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"> <i class="fa fa-address-book"></i> </span>
                    </div>
                    <input name="direccion" required class="form-control" placeholder="Dirección" type="text">
                </div> <!-- form-group// -->
                <span class="help-block text-danger" style="font-size:10px">(*) Campo obligatorio</span>
                <br>
                <label for="">Fecha de nacimiento</label>
                <div class="form-group input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"> <i class="fa fa-birthday-cake"></i> </span>
                    </div>
                    <select name="day" required id="day" class="custom-select" style="max-width: 80px;">
                        <option value="">Día</option>
                        <option value="01">01</option>
                        <option value="02">02</option>
                        <option value="03">03</option>
                        <option value="04">04</option>
                        <option value="05">05</option>
                        <option value="06">06</option>
                        <option value="07">07</option>
                        <option value="08">08</option>
                        <option value="09">09</option>
                        <option value="10">10</option>
                        <option value="11">11</option>
                        <option value="12">12</option>
                        <option value="13">13</option>
                        <option value="14">14</option>
                        <option value="15">15</option>
                        <option value="16">16</option>
                        <option value="17">17</option>
                        <option value="18">18</option>
                        <option value="19">19</option>
                        <option value="20">20</option>
                        <option value="21">21</option>
                        <option value="22">22</option>
                        <option value="23">23</option>
                        <option value="24">24</option>
                        <option value="25">25</option>
                        <option value="26">26</option>
                        <option value="27">27</option>
                        <option value="28">28</option>
                        <option value="29">29</option>
                        <option value="30">30</option>
                        <option value="31">31</option>
                    </select>
                    <select name="month" required id="month" class="custom-select" style="max-width: 80px;">
                        <option value="">Mes</option>
                        <option value="01">ENERO</option>
                        <option value="02">FEBRERO</option>
                        <option value="03">MARZO</option>
                        <option value="04">ABRIL</option>
                        <option value="05">MAYO</option>
                        <option value="06">JUNIO</option>
                        <option value="07">JULIO</option>
                        <option value="08">AGOSTO</option>
                        <option value="09">SEPTIEMBRE</option>
                        <option value="10">OCTUBRE</option>
                        <option value="11">NOVIEMBRE</option>
                        <option value="12">DICIEMBRE</option>
                    </select>
                    <select name="year" required id="year" class="custom-select">
                        <option value="">Año</option>
                    </select>
                </div> <!-- form-group// -->
                <span class="help-block text-danger" style="font-size:10px">(*) Campo obligatorio</span>
                <div class="d-block my-3">
                    <div class="custom-control custom-radio custom-control-inline">
                        <input id="hombre" value="t" name="sexo" type="radio" class="custom-control-input" required>
                        <label class="custom-control-label" for="hombre">Hombre</label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input id="mujer" value="f" name="sexo" type="radio" class="custom-control-input" required>
                        <label class="custom-control-label" for="mujer">Mujer</label>
                    </div>
                </div>
                <div style="display:none" class="form-group input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                    </div>
                    <input name="area" class="form-control" value=" " placeholder="Area" type="text">
                </div> <!-- form-group// -->
                <span class="help-block text-danger" style="font-size:10px">(*) Campo obligatorio Celular</span>
                <div class="form-group input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"> <i class="fa fa-phone"></i> </span>
                    </div>
                    <input name="celular" required oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" class="form-control" placeholder="Celular" type="text">
                    <input name="telefono" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" class="form-control" placeholder="Teléfono" type="text">
                </div> <!-- form-group// -->
                <span class="help-block text-danger" style="font-size:10px">(*) Campo obligatorio</span>
                <div class="form-group input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"> <i class="fa fa-users"></i> </span>
                    </div>
                    <select name="etnia" id="etnia" required class="custom-select tipo_etnia">
                        <option value=""> Etnia</option>
                    </select>
                    <select name="poblacion" id="poblacion" required  class="custom-select tipo_poblacion">
                        <option value=""> Población</option>
                    </select>
                </div> <!-- form-group end.// -->
                <span class="help-block text-danger" style="font-size:10px">(*) Campo obligatorio</span>
                <div class="form-group">
                    <select name="eps" id="eps" required class="custom-select entidades" style="max-width: 100%;">
                        <option value=""> EPS</option>
                    </select> 
                </div> <!-- form-group end.// -->
                <span class="help-block text-danger" style="font-size:10px">(*) Campo obligatorio</span>
                <div class="form-group">
                    <select name="pais" id="pais" required class="custom-select pais" style="max-width: 100%;">
                        <option value=""> Paises</option>
                        <option value="CO">COLOMBIA</option>
                    </select> 
                </div> <!-- form-group end.// -->
                <span class="help-block text-danger" style="font-size:10px">(*) Campo obligatorio</span>
                <div class="form-group">
                    <select name="departamento" id="departamento" required class="custom-select departamentos" onchange="VerMunicipios(this.value)" style="max-width: 49%;">
                        <option value=""> Departamentos</option>
                    </select> 
                    <select name="municipio" id="municipio" required class="custom-select municipios" style="max-width: 49%;">
                        <option value=""> Municipios</option>
                    </select> 
                </div> <!-- form-group end.// -->
                <span class="help-block text-danger" style="font-size:10px">(*) Campo obligatorio (Mínimo 8 caracteres)</span>
                <div class="form-group input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                    </div>
                    <input class="form-control" minlength="8" name="password" id="password" required placeholder="Crear Contraseña" type="password">
                </div> <!-- form-group// -->
                <span class="help-block text-danger" style="font-size:10px">(*) Campo obligatorio (Mínimo 8 caracteres)</span>
                <div class="form-group input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                    </div>
                    <input class="form-control" minlength="8" name="password_confirmar" id="password_confirmar" required placeholder="Repetir contraseña" type="password">
                </div> <!-- form-group// --> 
                <div class="form-group">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" required id="acepto">
                        <label style="font-size:10px" class="custom-control-label text-justify" for="acepto">
                          Acepta el manejo de la información recopilada para fines relacionados con el objeto social de nuestra empresa, según la Ley 1581 de 2012 y a lo previsto en el artículo 10 del Decreto 1377 de 2013
                        </label>
                    </div>
                </div>
                <!-- <div class="form-group">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" required id="certifico">
                        <label style="font-size:10px" class="custom-control-label text-justify" for="certifico">
                        Certifico que el correo electrónico ingresado en mis datos personales se encuentra vigente, de igual manera autorizo a la empresa social del estado VIDASINU para el envío de la respuesta a mi solicitud por este medio.
                        </label>
                    </div>
                </div> -->
                <div class="form-group">
                    <button type="submit" class="btn btn-success btn-block"> Crear cuenta </button>
                </div> <!-- form-group// -->      
                <p class="text-center">¿Tienes una cuenta? <a href="index.php">Inicia sesión</a> </p>                                                              
        </form>
    </article>
</div> <!-- card.// -->
<script src="assets/js/jquery.slim.min.js" crossorigin="anonymous"></script>
<script src="assets/js/ajax/jquery.min.js"></script>
<script src="assets/js/select2.full.js"></script>
<script>
$(function() {
    $(".loader").css("display", "none")
    ComboAno()
    TipoIdentificacion()
    VerEntidades()
    TipoEtnia()
    TipoPoblacion()
    VerDepartamentos()
});
    function tipo_persona(value) {
        if (value == 1) {
            //window.location.href = 'registrate.php';
        }else if (value == 2) {
            window.location.href = 'register_empresa.php';
        }
    }

    function ComboAno(){
        var d = new Date();
        var n = d.getFullYear();
        var select = document.getElementById("year");
        for(var i = n; i >= 1900; i--) {
            var opc = document.createElement("option");
            opc.text = i;
            opc.value = i;
            select.add(opc)
        }
    }

    function GuardarRegistro() {
        if (isValidDate($("#day").val(),$("#month").val(),$("#year").val())) {
            //alert("fecha correcta")
            if ($("#password").val() !== $("#password_confirmar").val() ) {
                alert("Las contraseñas no coinciden.", "red")
                $("input[name*='password']").val("")
                $("input[name*='password_confirmar']").val("")
                return false
            }
            $.ajax({
                type : 'POST',
                data: $("#form_registro").serialize()+"&tipo_persona=1&tipo_entidad=Privada",
                url: 'php/registrate/guardar_tercero.php',
                beforeSend: function() {
                    $(".loader").css("display", "inline-block")
                },
                success: function(respuesta) {
                let obj = JSON.parse(respuesta)
                if (obj.success) {
                    $(".loader").css("display", "none")
                    if (obj.message != "0") {
                        if (obj.numero == 'Exitoso') {
                            alert("Registro exitoso, te hemos enviado un email de activacion al correo eletrónico "+$("#email").val()+", Revisa en la bandeja de entrada o por seguridad de su servidor de correo en spam o correos no deseados.")
                            window.location.href = 'registrate.php';
                        }else{
                            alert("Error, no pudimos guardar tu información.")
                        }
                        //alert("Hemos enviado una solicitud de verificación de inicio de sesión a tu cuenta de correo.")
                    }else{
                        alert("El usuario ya se encuentra registrado.")
                    }
                }else{
                    $(".loader").css("display", "none")
                    alert('Datos invalidos para el acceso')
                }
                },
                error: function() {
                $(".loader").css("display", "none")
                console.log("No se ha podido obtener la información");
                }
            });
      
        }else{
            alert("fecha de nacimiento es incorrecta")
        }  
    }


    function isValidDate(day,month,year)
{
    var dteDate;
    month=month-1;
    dteDate=new Date(year,month,day);
    return ((day==dteDate.getDate()) && (month==dteDate.getMonth()) && (year==dteDate.getFullYear()));
}

function VerEntidades() {
      let values = { 
            cod: '1',
            parametro1: "1",
            parametro2: "1"
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
        let fila = ''
        $.each(obj[0], function( index, val ) {
          fila += '<option value="'+val.cod_entidad+'">'+val.nombre_entidad+'</option>'
        });
        $(".entidades").html('<option value="">EPS</option>'+fila)
        let placeholder = "Seleccione EPS";
        $(".entidades").select2( {
                placeholder: placeholder,
            });
      },
      error: function() {
        $(".loader").css("display", "none")
        console.log("No se ha podido obtener la información");
      }
    });
    
  }

  function VerDepartamentos() {
      let values = { 
            cod: '9',
            parametro1: "1",
            parametro2: "1"
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
        let fila = ''
        $.each(obj[0], function( index, val ) {
          fila += '<option value="'+val.id+'">'+val.nombre+'</option>'
        });
        $(".departamentos").html('<option value="">Departamentos</option>'+fila)
        // let placeholder = "Seleccione Departamento";
        // $(".departamentos").select2( {
        //         placeholder: placeholder,
        //     });
      },
      error: function() {
        $(".loader").css("display", "none")
        console.log("No se ha podido obtener la información");
      }
    });
    
  }

  function VerMunicipios(id) {
      let values = { 
            cod: '10',
            parametro1: id,
            parametro2: "1"
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
        let fila = ''
        $.each(obj[0], function( index, val ) {
          fila += '<option value="'+val.codigo+'">'+val.nombre+'</option>'
        });
        $(".municipios").html('<option value="">Municipios</option>'+fila)
        // let placeholder = "Seleccione Municipio";
        // $(".municipios").select2( {
        //         placeholder: placeholder,
        //     });
      },
      error: function() {
        $(".loader").css("display", "none")
        console.log("No se ha podido obtener la información");
      }
    });
    
  }

  function TipoIdentificacion() {
      let values = { 
            cod: '4',
            parametro1: "1",
            parametro2: "1"
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
        let fila = ''
        $.each(obj[0], function( index, val ) {
          if (val.conse_tipo_id != 8) {
            fila += '<option value="'+val.conse_tipo_id+'">'+val.tipo_id+'</option>'   
          }
        });
        $(".tipo_identificaciones").html('<option value="">Tipo identificación</option>'+fila)
      },
      error: function() {
        $(".loader").css("display", "none")
        console.log("No se ha podido obtener la información");
      }
    });
    
  }

  function TipoEtnia() {
      let values = { 
            cod: "5",
            parametro1: "1",
            parametro2: "1"
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
        let fila = ''
        $.each(obj[0], function( index, val ) {
          fila += '<option value="'+val.conse+'">'+val.nombre+'</option>'
        });
        $(".tipo_etnia").html('<option value="">Etnia</option>'+fila)
      },
      error: function() {
        $(".loader").css("display", "none")
        console.log("No se ha podido obtener la información");
      }
    });
    
  }

  function TipoPoblacion() {
      let values = { 
            cod: "6",
            parametro1: "1",
            parametro2: "1"
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
        let fila = ''
        $.each(obj[0], function( index, val ) {
          fila += '<option value="'+val.conse+'">'+val.nombre+'</option>'
        });
        $(".tipo_poblacion").html('<option value="">Población</option>'+fila)
      },
      error: function() {
        $(".loader").css("display", "none")
        console.log("No se ha podido obtener la información");
      }
    });
    
  }

  function TipoCicloVida() {
      let values = { 
            cod: "7",
            parametro1: "1",
            parametro2: "1"
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
        let fila = ''
        $.each(obj[0], function( index, val ) {
          fila += '<option value="'+val.conse+'">'+val.nombre+'</option>'
        });
        $(".tipo_ciclo_vida").html('<option value="">Ciclo de vida</option>'+fila)
      },
      error: function() {
        $(".loader").css("display", "none")
        console.log("No se ha podido obtener la información");
      }
    });
    
  }

</script>