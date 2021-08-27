<?php
    session_start();
   include '../../php/conexion.php';

   $codigo = $_POST["codigo"];
   $cedula = $_POST["cedula"];
   $nombre1 = $_POST["nombre1"];
   $nombre2 = $_POST["nombre2"];
   $apellido1 = $_POST["apellido1"];
   $apellido2 = $_POST["apellido2"];
   $pass = $_POST["pass"];
   $tipo = $_POST["tipo"];
   $id_pais = $_POST["id_pais"];
   $id_depto = $_POST["id_depto"];
   $ciudad = $_POST["ciudad"];
   $direccion = $_POST["direccion"];
   $telefono = $_POST["telefono"];
   $email = $_POST["email"];
   $avatar = $_POST["avatar"];
    $id_autor = $_SESSION['id'];
         
        $response = [];
        $con = mysqli_connect(DB_HOST,DB_USER, DB_PASS, DB_NAME);

        if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
        exit;
        }
        // Insert some values
        try{
             $result = mysqli_query($con, "INSERT INTO usuarios (codigo, 
                                                                cedula, 
                                                                nombre1, 
                                                                nombre2, 
                                                                apellido1, 
                                                                apellido2, 
                                                                pass, 
                                                                tipo, 
                                                                id_pais, 
                                                                id_depto, 
                                                                ciudad, 
                                                                direccion, 
                                                                telefono, 
                                                                email, 
                                                                avatar, 
                                                                id_autor )
                                                            VALUES ('$codigo', 
                                                                    $cedula, 
                                                                    '$nombre1', 
                                                                    '$nombre2', 
                                                                    '$apellido1', 
                                                                    '$apellido2', 
                                                                    '$pass', 
                                                                    '$tipo', 
                                                                    $id_pais, 
                                                                    $id_depto, 
                                                                    '$ciudad', 
                                                                    '$direccion', 
                                                                    '$telefono', 
                                                                    '$email', 
                                                                    '$avatar',
                                                                    $id_autor);");


                //var_dump($result);
                mysqli_query($con, $result);
                if (mysqli_insert_id($con) > 0) {
                    $response["success"] = true;
                    $response["id"] = mysqli_insert_id($con);
                    $response["message"] = "Commiting transaction.";
                echo json_encode($response);
                } else {
                    $response["success"] = false;
                    $response["id"] = mysqli_insert_id($con);
                    $response["message"] = "Rolling back transaction.";
                echo json_encode($response);
                }
            }catch(Exception $e){
                $response["success"] = false;
                $response["message"] = $e->getMessage();
                echo json_encode($response);
            }

        

        // Close connection
        mysqli_close($con);
?>
