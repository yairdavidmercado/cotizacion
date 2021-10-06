<?php
    session_start();
   include 'conexion.php';

   $id_reserva = $_POST["id_reserva"];
   $id_cotizacion = $_POST["id_cotizacion"];
   $deposito = $_POST["deposito"];
   $id_metodo_pago = $_POST["id_metodo_pago"];
   $id_hotel = $_POST["id_hotel"];
   $id_autor = $_SESSION['id'];
         
        $response = [];
        $con = mysqli_connect(DB_HOST,DB_USER, DB_PASS, DB_NAME);

        if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
        exit;
        }
        // Insert some values
        try{
             $result = mysqli_query($con, "INSERT INTO vaucher (reserva, id_cotizacion, deposito, id_metodo_pago, id_hotel, id_autor)
                                                            VALUES ($id_reserva, $id_cotizacion ,$deposito,$id_metodo_pago ,$id_hotel,$id_autor);");

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
