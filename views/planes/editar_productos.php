<?php
    session_start();
    include '../../php/conexion.php';

    $id = $_POST["id"] == "" ? "0": $_POST["id"] ;
    $nombre = $_POST["nombre"];
    $tipo = $_POST["tipo"]; 
    $id_hotel = $_POST["id_hotel"];
    $id_autor = $_SESSION['id'];
    
    $response = [];
    $con = mysqli_connect(DB_HOST,DB_USER, DB_PASS, DB_NAME);

    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
        exit;
    }

    try{

        $result = mysqli_query($con, "UPDATE productos SET  nombre = '$nombre',
                                                            tipo = '$tipo',
                                                            id_hotel = $id_hotel,
                                                            id_autor = $id_autor 
                                                            WHERE id = $id;");

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
