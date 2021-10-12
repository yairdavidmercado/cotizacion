<?php
    session_start();
    include 'conexion.php';

    $id = $_POST["id"];
    $tabla = $_POST["tabla"];
    $accion = $_POST["accion"];
    $id_autor = $_SESSION['id'];
         
    $response = [];
    $con = mysqli_connect(DB_HOST,DB_USER, DB_PASS, DB_NAME);

    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
        exit;
    }

    try{

        $result0 = mysqli_query($con, "INSERT INTO auditoria ( tabla, accion, id_modi, id_autor) VALUES('$tabla', '$accion', $id, $id_autor);");

        $result = mysqli_query($con, "UPDATE $tabla SET activo = false WHERE id = $id;");


            if (mysqli_affected_rows($con) > 0) {
                $response["success"] = true;
                $response["id"] = mysqli_insert_id($con);
                $response["message"] = "Eliminado exitosamente.";
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
