
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.6">
    <title>Offcanvas template · Bootstrap</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.4/examples/offcanvas/">

    <!-- Bootstrap core CSS -->
<link href="../../assets/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">

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
    </style>
  </head>
  <body class="bg-light">
  <?php require("../menu.php"); ?>

<main role="main" class="container py-5">
  <div class="py-5 bg-white rounded shadow-sm">
    <div class="container">
    <div class="row">
            <div class="col-sm-3">
                <!-- form user info -->
                <div v-if="editarproveedoractivo" class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Editar proveedor</h5>
                    </div>
                    <div class="card-body">
                        <form class="form" role="form" @submit.prevent="editarformproveedor(dato)" autocomplete="off">
                            <div class="container">
                                <div class="form-group">
                                    <input class="form-control form-control-sm" v-model="dato.nit" type="text" placeholder="NIT">
                                </div>
                                <div class="form-group">
                                    <input class="form-control form-control-sm" v-model="dato.nombre" type="text" placeholder="Nombre">
                                </div>
                                <div class="form-group">
                                    <input class="form-control form-control-sm" v-model="dato.direccion" type="text" placeholder="Dirección">
                                </div>
                                <div class="form-group">
                                    <input class="form-control form-control-sm" v-model="dato.telefono" type="text" placeholder="Teléfono">
                                </div>
                                <div class="form-group">
                                    <input class="form-control form-control-sm" v-model="dato.email" type="text" placeholder="Email">
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-success" type="submit">guardar</button>
                                    <button class="btn btn-primary" type="button" @click="NuevoProveedor()">Nuevo</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div v-else class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Crear proveedor</h5>
                    </div>
                    <div class="card-body">
                        <form class="form" role="form" @submit.prevent="guardarProveedores()" autocomplete="off">
                            <div class="container">
                                <div class="form-group">
                                    <input ref="nit" class="form-control form-control-sm" v-model="dato.nit" type="text" placeholder="NIT">
                                </div>
                                <div class="form-group">
                                    <input class="form-control form-control-sm" v-model="dato.nombre" type="text" placeholder="Nombre">
                                </div>
                                <div class="form-group">
                                    <input class="form-control form-control-sm" v-model="dato.direccion" type="text" placeholder="Dirección">
                                </div>
                                <div class="form-group">
                                    <input class="form-control form-control-sm" v-model="dato.telefono" type="text" placeholder="Teléfono">
                                </div>
                                <div class="form-group">
                                    <input class="form-control form-control-sm" v-model="dato.email" type="text" placeholder="Email">
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-primary" type="submit">Agregar</button>
                                    <button class="btn btn-danger" type="button" @click="limpiarproveedores()">Limpiar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /form user info -->
            </div>
            <div class="col-sm-9">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Proveedores</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-responsive-sm">
                            <thead class="thead-light">
                                <tr>
                                <th scope="col">NIT</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Dirección</th>
                                <th scope="col">Teléfono</th>
                                <th scope="col">Email</th>
                                <th style="width:10px" scope="col"></th>
                                <th style="width:10px" scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(item, index) in datas" :key="index">
                                    <td>{{item.nit}}</td>
                                    <td>{{item.nombre}}</td>
                                    <td>{{item.direccion}}</td>
                                    <td>{{item.telefono}}</td>
                                    <td>{{item.email}}</td>
                                    <td><button class="btn btn-warning btn-sm" @click="editarproveedor(item)" >Editar</button></td>
                                    <td><button class="btn btn-danger btn-sm" @click="eliminarproveedor(item, index)" >x</button></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>
</main>
<script src="../../assets/js/jquery.slim.min.js" crossorigin="anonymous"></script>
      <script>window.jQuery || document.write('<script src="../../assets/js/jquery.slim.min.js"><\/script>')</script><script src="../../assets/js/bootstrap.bundle.min.js" integrity="sha384-6khuMg9gaYr5AxOqhkVIODVIvm9ynTT5J4V1cfthmT+emCG6yVmEZsRHdxlotUnm" crossorigin="anonymous"></script>
<script>
$(function() {
        console.log( "index!" );
  });
</script>
</body>
</html>
