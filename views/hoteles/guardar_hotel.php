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
        // Insert some values
        try{
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
