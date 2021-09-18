<?php
    session_start();
   include '../../php/conexion.php';

    $nit = $_POST["nit"];
    $nombre = $_POST["nombre"];
    $email = $_POST["email"];
    $telefono = $_POST["telefono"];
    $direccion = $_POST["direccion"];
    $id_pais = $_POST["id_pais"];
    $id_depto = $_POST["id_depto"];
    $id_terminos = $_POST["id_terminos"];
    $ciudad = $_POST["ciudad"];
    $avatar= $_POST["avatar"];
    $id_autor = $_SESSION['id'];
         
        $response = [];
        $con = mysqli_connect(DB_HOST,DB_USER, DB_PASS, DB_NAME);

        if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
        exit;
        }
        
        
        try{
            $result = mysqli_query($con, 	"SELECT * FROM hoteles WHERE nit = $nit");
            $code = "";										
            if(mysqli_num_rows($result) > 0)
            {	
    
                $response["success"] = false;
                $response["message"] = "El NIT ya se encuentra registrado.";
                echo json_encode($response);
                exit;
            }

            if ($avatar !== "assets/img/default.jpg") {

                $file = $avatar; //your data in base64 'data:image/png....';
                file_put_contents('../../assets/img/avatar'.$nit.'.png', base64_decode(explode(',', $avatar)[1]));

                $avatar = "assets/img/avatar".$nit.".png";
            }
             $result = mysqli_query($con, "INSERT INTO hoteles (nit, 
                                                                    nombre, 
                                                                    email, 
                                                                    telefono, 
                                                                    direccion, 
                                                                    id_pais, 
                                                                    id_depto, 
                                                                    id_terminos, 
                                                                    ciudad, 
                                                                    avatar,
                                                                    id_autor )
                                                            VALUES ('$nit', 
                                                                    '$nombre', 
                                                                    '$email', 
                                                                    '$telefono', 
                                                                    '$direccion', 
                                                                    $id_pais, 
                                                                    $id_depto, 
                                                                    $id_terminos, 
                                                                    '$ciudad', 
                                                                    '$avatar',
                                                                    $id_autor);");

                //var_dump($result);
                mysqli_query($con, $result);
                if (mysqli_insert_id($con) > 0) {
                    $response["success"] = true;
                    $response["id"] = mysqli_insert_id($con);
                    $response["message"] = "Hotel guardado exitosamente.";
                    $result = mysqli_query($con, "INSERT INTO permiso_hotel (id_usuario, 
                                                                    id_hotel,
                                                                    id_autor )
                                                            VALUES ($id_autor, 
                                                                    ".mysqli_insert_id($con).",
                                                                    $id_autor);");

                    //var_dump($result);
                    mysqli_query($con, $result);
                    if (mysqli_insert_id($con) > 0) {
                        $response["success2"] = true;
                        $response["id2"] = mysqli_insert_id($con);
                        $response["message2"] = "Asignación guardada correctamente";
                    } else {
                        $response["success2"] = false;
                        $response["id2"] = mysqli_insert_id($con);
                        $response["message2"] = "Error al guardar la información de permisos de hotel.";
                    }
                echo json_encode($response);
                } else {
                    $response["success"] = false;
                    $response["id"] = mysqli_insert_id($con);
                    $response["message"] = "Error al guardar la información en hotel.";
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
