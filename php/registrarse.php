<?php 
    include '../bbdd/conexiones.php';

    session_start();
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = $_POST['emailregistro'];
        $pass = $_POST['passregistro'];
        $pass_verify = $_POST['passverify'];
        $hash_pass = password_hash($pass, PASSWORD_DEFAULT);

        $pdo = new Conexion();
        $sql = $pdo->prepare('SELECT * FROM usuarios WHERE email =:email');
        $sql->bindValue(':email', $email);
        $sql->execute();
        $numrows = $sql->rowCount();
        $sql->setFetchMode(PDO::FETCH_ASSOC);

        if($numrows > 0) {
            echo "Este usuario ya existe en el sistema";
        } else {
            $adduser = $pdo->prepare('INSERT INTO usuarios (email, password)
                VALUES (:email, :hashedpass)');
            $adduser->bindValue(':email', $email);
            $adduser->bindValue(':hashedpass', $hash_pass);
            $adduser->execute();

            $_SESSION['email'] = strtolower($email);
            echo "Añadiendo usuario";
        }
    } else {
        echo "Error: Método no permitido.";
    }
?>