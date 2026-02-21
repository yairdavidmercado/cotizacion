<?php
    session_start();
    include '../../php/conexion.php';

    $id = $_POST["id"] == "" ? "0": $_POST["id"] ;
    $nombre = $_POST["nombre"];
    $id_tipo_plan = isset($_POST["id_tipo_plan"]) ? $_POST["id_tipo_plan"] : "";
    $id_terminos = $_POST["id_terminos"];
    $descripcion = $_POST["descripcion"]; 
    $ids = $_POST["ids"];
    $id_autor = $_SESSION['id'];
         
    $response = [];
    $con = mysqli_connect(DB_HOST,DB_USER, DB_PASS, DB_NAME);

    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
        exit;
    }

    try{

        $id_tipo_plan_update = "";
        if ($id_tipo_plan !== "") {
            $id_tipo_plan_update = ", id_tipo_plan = " . intval($id_tipo_plan);
        }

        $result = mysqli_query($con, "UPDATE planes SET   nombre = '$nombre',
                                                            id_terminos = $id_terminos, 
                                                            descripcion = '$descripcion',
                                                            id_autor = $id_autor 
                                                            $id_tipo_plan_update
                                                            WHERE id = $id;");
        $resultado = 0;                                                            
        if (mysqli_affected_rows($con) > 0) {
            $resultado .= mysqli_affected_rows($con);
        }
        $ids_productos = explode(",", $ids);
        $values = "";
        for ($i=0; $i < count($ids_productos) ; $i++) { 
            $values .= $ids_productos[$i].",";
        }
        $values = substr($values, 0, -1);
        $result1 = mysqli_query($con, "DELETE FROM tipo_plan WHERE id_plan = $id AND id_producto NOT IN ($values) ");
        if (mysqli_affected_rows($con) > 0) {
            $resultado .= mysqli_affected_rows($con);
        }
        $datos_planes_new = '';
        for ($i=0; $i < count($ids_productos) ; $i++) { 
            $info_result = mysqli_query($con, "SELECT id_producto FROM tipo_plan WHERE id_plan = $id AND id_producto = $ids_productos[$i];");
            if(mysqli_num_rows($info_result) == 0)
            {		
               $datos_planes_new .= "(".$id.",".$ids_productos[$i]."),";
            }
        }

        $datos_planes_new = substr( $datos_planes_new, 0, -1);
        $result2 = mysqli_query($con, "INSERT INTO tipo_plan (id_plan, id_producto) VALUES  $datos_planes_new ");
        if (mysqli_insert_id($con) > 0) {
            $resultado .= mysqli_insert_id($con);
        }
        
        if ($resultado > 0) {
            $response["success"] = true;
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
