<?php
    session_start();

    $id = $_POST["id"] == "" ? "0": $_POST["id"] ;
    $codigo = $_POST["codigo"] == "" ? "0": $_POST["codigo"] ;
    $cedula =  $_POST["cedula"] == "" ? "0": $_POST["cedula"] ;
    $nombre1 = $_POST["nombre1"];
    $nombre2 = $_POST["nombre2"];
    $apellido1 = $_POST["apellido1"];
    $apellido2 = $_POST["apellido2"];
    $tipo = $_POST["tipo"];
    $id_pais = $_POST["id_pais"];
    $id_depto =  $_POST["id_depto"] == "" ? "0": $_POST["id_depto"] ;
    $ciudad = $_POST["ciudad"];
    $direccion = $_POST["direccion"];
    $telefono = $_POST["telefono"];
    $email = $_POST["email"];
    $avatar = $_POST["avatar"];
    $id_autor = $_SESSION['id'];
    
    if ($tipo == 'TITULAR') {
        include '../../php/conexion.php';
    }else {
        include '../../php/conectCompany.php';
    }
    $response = [];
    $con = mysqli_connect(DB_HOST,DB_USER, DB_PASS, DB_NAME);

    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
        exit;
    }

    try{

        $result = mysqli_query($con, "UPDATE usuarios SET codigo = '$codigo', 
                                                            cedula = '$cedula', 
                                                            nombre1 = '$nombre1', 
                                                            nombre2 = '$nombre2', 
                                                            apellido1 = '$apellido1', 
                                                            apellido2 = '$apellido2', 
                                                            tipo = '$tipo', 
                                                            id_pais = '$id_pais', 
                                                            id_depto = '$id_depto', 
                                                            ciudad = '$ciudad', 
                                                            direccion = '$direccion', 
                                                            telefono = '$telefono', 
                                                            email = '$email', 
                                                            avatar = '$avatar', 
                                                            id_autor = $id_autor 
                                                            WHERE id = $id;");


            //var_dump($result);
            //mysqli_query($con, $result);
            if (mysqli_affected_rows($con) > 0) {
                $response["success"] = true;
                $response["id"] = mysqli_insert_id($con);
                $response["message"] = "Editado exitosamente.";
                echo json_encode($response);
            } else {
                $response["success"] = false;
                $response["id"] = 0;
                $response["message"] = "No se realizaron cambios.";
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
