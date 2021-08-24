<?php
    session_start();
   include 'conexion.php';

   $cod_vendedor = $_POST["cod_vendedor"];
   $n_infante = $_POST["n_infante"];
   $n_child = $_POST["n_child"];
   $n_adult_s = $_POST["n_adult_s"];
   $n_adult_d = $_POST["n_adult_d"];
   $n_adult_t_c = $_POST["n_adult_t_c"];
   $id_titular = $_POST["id_titular"];
   $id_terminos = $_POST["id_terminos"];
   $id_hotel = $_POST["id_hotel"];
   $id_tarifa = $_POST["id_tarifa"];
   $id_plan = $_POST["id_plan"];
   $acomodo = $_POST["acomodo"];
   $id_motivo = $_POST["id_motivo"];
   $noche = $_POST["noche"];
   $fecha_entrada = $_POST["fecha_entrada"];
   $fecha_salida = $_POST["fecha_salida"];
   $id_autor = $_SESSION['id'];
         
        $response = [];
        $con = mysqli_connect(DB_HOST,DB_USER, DB_PASS, DB_NAME);

        if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
        exit;
        }
        // Insert some values
        try{
             $result = mysqli_query($con, "INSERT INTO cotizacion (cod_vendedor, n_infante, n_child, n_adult_s, n_adult_d, n_adult_t_c, id_titular, id_hotel, id_terminos,
                                                            id_tarifa, id_plan, id_motivo, noche, acomodo, fecha_entrada, fecha_salida, id_autor)
                                                            VALUES ('$cod_vendedor' ,$n_infante,$n_child ,$n_adult_s ,$n_adult_d ,$n_adult_t_c,$id_titular ,$id_hotel,$id_terminos ,$id_tarifa , $id_plan,
                                                            $id_motivo ,'$noche' ,'$acomodo',STR_TO_DATE('$fecha_entrada', '%Y-%m-%d') ,STR_TO_DATE('$fecha_salida', '%Y-%m-%d') ,$id_autor);");

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
