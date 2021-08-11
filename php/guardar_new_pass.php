<?php

   include 'conexion.php';

        $id = $_POST["id"];
        $code = $_POST["code"];
        $pass = $_POST["password"];
         
      $response = [];
		$conn = pg_connect("user=".DB_USER." password=".DB_PASS." port=".DB_PORT." dbname=".DB_NAME." host=".DB_HOST) or die ("Could not connect to server\n");

		try{
			pg_query("BEGIN") or die("Could not start transaction\n");
         $result = pg_query($conn, "UPDATE usuarios_pqrs set pass = MD5('$pass') WHERE email = '$id' AND recover = '$code';");
			$fch = pg_affected_rows($result);
			if ($fch == 1) {
				$response["success"] = true;
				$response["message"] = "Commiting transaction.";
            pg_query("COMMIT") or die("Transaction commit failed\n");
            echo json_encode($response);
			} else {
				$response["success"] = false;
				$response["message"] = "Rolling back transaction.";
            pg_query("ROLLBACK") or die("Transaction rollback failed\n");;
            echo json_encode($response);
			}
		}catch(Exception $e){
			$response["success"] = false;
			$response["message"] = $e->getMessage();
			echo json_encode($response);
		}
		pg_close($conn); 
?>
