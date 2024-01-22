<?php 
    include '../bbdd/conexiones.php';
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = $_POST['emailregistro'];
        $pass = $_POST['passregistro'];
        $pass_verify = $_POST['passverify'];

        $hash_pass = password_hash($pass, PASSWORD_DEFAULT);

        $vfyEmail = 'SELECT * FROM usuarios WHERE email = "' . $email . '"';
        $result = mysqli_query($conexion, $vfyEmail);
        
        if($result->num_rows > 0) {
            echo "Este usuario ya existe en el sistema";
        } else {
            echo "Añadiendo usuario";
            $addUser = 'INSERT INTO usuarios (email, password)
                    VALUES ("'. $email .'", "' . $hash_pass . '")';

            mysqli_query($conexion, $addUser);
        }
    } else {
        echo "Error: Método no permitido.";
    }
?>