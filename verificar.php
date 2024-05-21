<?php
include_once(__DIR__."/bbdd/usuario.php");

$id=$_GET['id'];
$token=$_GET['token'];
$type=$_GET['type'];

$u=new Usuario($id);

if ($type == 'vfyemail'){
  if ($token == $u->getToken()){
    session_start();
    $u->setToken(null);
    $u->update();
    $_SESSION['email'] = strtolower($u->getEmail());
    $_SESSION['usuarioID'] = $u->getIdUsuario();
    header("Location: index.php");
  } else {
    header("Location: index.php");
  }
} else if($type == 'reset'){
  if ($token == $u->getToken()){
    ?>
    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <!-- SEO = Básico -->
        <!-- Cada página del sitio tiene que ser diferente el título y la descripción -->
        <title>Make Me A Pass - Contraseñas</title>
        <meta name="description" content="" />
        <meta name="keywords" content="" />

        <!-- Etiquetas Open Graph y Twitter Card, para crear el SEO de Redes Sociales -->
        <meta property="og:title" content="Título de tu página" />
        <meta property="og:description" content="Descripción de tu página" />
        <meta
        property="og:image"
        content="URL de la imagen que quieres mostrar en las redes sociales"
        />
        <meta property="og:url" content="URL de tu página" />
        <meta property="og:type" content="website" />
        <meta name="twitter:card" content="summary_large_image" />
        <meta name="twitter:title" content="Título de tu página" />
        <meta name="twitter:description" content="Descripción de tu página" />
        <meta
        name="twitter:image"
        content="URL de la imagen que quieres mostrar en Twitter"
        />

        <!-- App Web, inidicar al navegador que elementos mostrar en un JSON -->
        <link rel="manifest" href="site.webmanifest" />
        <!-- icono de acceso para IOS -->
        <link rel="apple-touch-icon" href="icon.png" />
        <!-- Recordar que favicon.ico tiene que estar en el directorio inicial -->
        <link rel="icon" href="img/desktop/logo.webp" type="image/x-icon">
        <!-- links de estilos -->
        <link rel="stylesheet" href="css/style.css" />
        
        <!-- Se cambia el tema de algunos navegadores -->
        <meta name="theme-color" content="#fafafa" />
        <!-- Código de las plataformas de Análisis -->
        <script></script>
        <!-- Scripts a cargar antes de la renderización -->
        <script src="js/scroll.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        <script src="js/script.js"></script>
    </head>
    <body>
        <div class="container">
            <?php include 'components/header.php'; ?>
            <main class="reset__main">
              <form class="main__form" method="POST" onsubmit="return resetPassword()" novalidate>
                <h2 class="main__titulo">Nueva Contraseña</h2>
                        
                <input class="input" type="password" id="pass-reset" name="passregistro" placeholder="Contraseña">
                <div id="pass-error-msg" class="label-error"></div>
                        
                <input class="input" type="password" id="passvfy-reset" name="passregistro" placeholder="Repite la contraseña">
                <div id="passvfy-error-msg" class="label-error"></div>
                        
                <input class="botonenviar" type="submit" value="Enviar">
              </form>
            </main>
            <?php include 'components/footer.php'; ?>
        </div>
    </body>
    </html>
  <?php 
  } else {
    header("Location: index.php");
  
  }
} else {
  header("Location: index.php");
}