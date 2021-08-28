<?php
    session_start();
   include '../../php/conexion.php';

    $nombre = $_POST["nombre"];
    $descripcion = $_POST["descripcion"]; 
    $id_hotel = $_POST["id_hotel"];
    $ids = $_POST["ids"];
    $id_autor = $_SESSION['id'];
         
        $response = [];
        $con = mysqli_connect(DB_HOST,DB_USER, DB_PASS, DB_NAME);

        if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
        exit;
        }
        // Insert some values
        try{
             $result = mysqli_query($con, "INSERT INTO planes (nombre, 
                                                                    descripcion, 
                                                                    id_hotel,
                                                                    id_autor )
                                                            VALUES ('$nombre', 
                                                                    '$descripcion', 
                                                                    $id_hotel,
                                                                    $id_autor);");

                //var_dump($result);
                mysqli_query($con, $result);
                if (mysqli_insert_id($con) > 0) {

                    $response["success"] = true;
                    $response["id"] = mysqli_insert_id($con);
                    $response["message"] = "Commiting transaction.";
                    $ids_productos = explode(",", $ids);
                    $values = "";
                    for ($i=0; $i < count($ids_productos) ; $i++) { 
                        $values .= "(".mysqli_insert_id($con).",".$ids_productos[$i]."),";
                    }
                    $values = substr($values, 0, -1);
                    $result1 = mysqli_query($con, "INSERT INTO tipo_plan (id_plan, id_producto) VALUES $values ");
                    mysqli_query($con, $result1);
                    if (mysqli_insert_id($con) > 0) {
                        $response["success2"] = true;
                        $response["id2"] = mysqli_insert_id($con);
                        $response["message2"] = "Commiting transaction.";
                    }else{
                        $response["success2"] = false;
                        $response["id2"] = mysqli_insert_id($con);
                        $response["message2"] = "Rolling back transaction.";
                    }
                    echo json_encode($response);
                } else {
                    $response["success"] = false;
                    $response["id"] = 0;
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
