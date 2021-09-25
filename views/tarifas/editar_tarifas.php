<?php
    session_start();
    include '../../php/conexion.php';

    $id = $_POST["id"] == "" ? "0": $_POST["id"] ;
    $nombre = $_POST["nombre"]; 
    $child = $_POST["child"]; 
    $adult_s = $_POST["adult_s"]; 
    $adult_d = $_POST["adult_d"]; 
    $adult_t_c = $_POST["adult_t_c"]; 
    $id_plan = $_POST["id_plan"]; 
    $id_hotel = $_POST["id_hotel"];  
    $descripcion = $_POST["descripcion"];  
    $noches = $_POST["noches"];
    $id_autor = $_SESSION['id'];
         
    $response = [];
    $con = mysqli_connect(DB_HOST,DB_USER, DB_PASS, DB_NAME);

    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
        exit;
    }

    try{

        $result = mysqli_query($con, "UPDATE tarifas SET   nombre = '$nombre', 
                                                            child = '$child',
                                                            adult_s = '$adult_s',
                                                            adult_d = '$adult_d',
                                                            adult_t_c = '$adult_t_c',
                                                            id_plan = '$id_plan',
                                                            id_hotel = '$id_hotel',
                                                            descripcion = '$descripcion',
                                                            noches = '$noches',
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
