<?php
    session_start();

    $codigo = $_POST["codigo"] == "" ? "0": $_POST["codigo"] ;
    $cedula =  $_POST["cedula"] == "" ? "0": $_POST["cedula"] ;
    $nombre1 = $_POST["nombre1"];
    $nombre2 = $_POST["nombre2"];
    $apellido1 = $_POST["apellido1"];
    $apellido2 = $_POST["apellido2"];
    $pass = $_POST["pass"];
    $tipo = $_POST["tipo"];
    $id_pais = $_POST["id_pais"];
    $id_depto =  $_POST["id_depto"] == "" ? "0": $_POST["id_depto"] ;
    $ciudad = $_POST["ciudad"];
    $direccion = $_POST["direccion"];
    $telefono = $_POST["telefono"];
    $email = $_POST["email"];
    $avatar = $_POST["avatar"];
    $id_autor = $_SESSION['id'];
    $id_db = ','.$_SESSION['id_db'];
    $var_campo = '';
    if ($tipo == 'TITULAR') {
        include '../../php/conexion.php';
        $var_campo = '';
        $id_db = '';
        
    }else {
        include '../../php/conectCompany.php';
        $var_campo = ',id_empresa';
    }
    $response = [];
    $con = mysqli_connect(DB_HOST,DB_USER, DB_PASS, DB_NAME);

    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
        exit;
    }
    // Insert some values
    try{
        /* $result = mysqli_query($con, 	"SELECT * FROM usuarios WHERE cedula = $cedula");
        $code = "";										
        if(mysqli_num_rows($result) > 0)
        {	

            $response["success"] = false;
            $response["message"] = "la identificación ya existe.";
            echo json_encode($response);
            exit;
        } */
        if ($codigo !== "0") {
            $result = mysqli_query($con, 	"SELECT * FROM usuarios WHERE codigo = $codigo");
            $code = "";										
            if(mysqli_num_rows($result) > 0)
            {	
                
                $response["success"] = false;
                $response["message"] = "El código ya existe.";
                echo json_encode($response);
                exit;
            }
        }

        $result = mysqli_query($con, "INSERT INTO usuarios (codigo, 
                                                            cedula, 
                                                            nombre1, 
                                                            nombre2, 
                                                            apellido1, 
                                                            apellido2, 
                                                            pass, 
                                                            tipo, 
                                                            id_pais, 
                                                            id_depto, 
                                                            ciudad, 
                                                            direccion, 
                                                            telefono, 
                                                            email, 
                                                            avatar,
                                                            id_autor
                                                            $var_campo )
                                                        VALUES ('$codigo', 
                                                                $cedula, 
                                                                '$nombre1', 
                                                                '$nombre2', 
                                                                '$apellido1', 
                                                                '$apellido2', 
                                                                '$pass', 
                                                                '$tipo', 
                                                                $id_pais, 
                                                                $id_depto, 
                                                                '$ciudad', 
                                                                '$direccion', 
                                                                '$telefono', 
                                                                '$email', 
                                                                '$avatar',
                                                                $id_autor
                                                                $id_db);");


            //var_dump($result);
            mysqli_query($con, $result);
            if (mysqli_insert_id($con) > 0) {
                $response["success"] = true;
                $response["id"] = mysqli_insert_id($con);
                $response["message"] = "Guardado exitosamente.";
                echo json_encode($response);
            } else {
                $response["success"] = false;
                $response["id"] = mysqli_insert_id($con);
                $response["message"] = "Error al guardar los datos.";
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
