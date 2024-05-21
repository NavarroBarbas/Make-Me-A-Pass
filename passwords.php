<?php session_start(); ?>
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
    <script src="preloader.js"></script>
    <script src="js/scroll.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="js/script.js"></script>
  </head>
  <body>
    <div class="container">
      <?php 
      include 'components/header.php';
      include_once(__DIR__."/bbdd/passwords.php");
      
      if (!isset($_SESSION["email"])){
        echo "<div class='errorsesion'>
        <br/><h2>Mensaje de Rechazo</h2>
        <br/>
        Lo siento, NO tiene privilegios para entrar en esta página, por favor vuelva a la página principal e ingrese un nombre de usuario y apellido.
        <br /><br />
        <a href='./'>Volver a página de Inicio </a>
        </div>";
      } else {

      ?>
    
      <main class="passwords__main">
        <div class="main__headpass">
        <h2 class="headpass__titulo">Contraseñas</h2>
        <input type="text" id="buscador" name="buscador" placeholder="Buscar..." class="headpass__buscador" onkeyup="buscarPassword()">
        </div>

        <section id="contrasenas" class="main__passwords">
          <?php
            $userID = $_SESSION['usuarioID'];
            $passwords = new Password();
            $passwords->setIdUsuario($userID);
            $passwords->load();
          ?>
        </section>
      </main>
      <?php } ?>

      <?php include 'components/footer.php' ?>
    </div>
  </body>
</html>

