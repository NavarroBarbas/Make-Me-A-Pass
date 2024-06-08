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
        echo "<div class='errorsesion' data-cy='no-login'>
        <br/><h2 data-cy='no-login-titulo'>Mensaje de Rechazo</h2>
        <br/>
        Lo siento, NO tiene privilegios para entrar en esta página, por favor vuelva a la página principal e ingrese un nombre de usuario y apellido.
        <br /><br />
        <a href='./' data-cy='no-login-volver'>Volver a página de Inicio </a>
        </div>";
      } else {

      ?>
    
      <main class="passwords__main">
        <div class="main__headpass">
        <h2 class="headpass__titulo" data-cy="passwords-titulo">
          Contraseñas
          <a class="titulo__addpass" data-cy="passwords-newpass"><img src="svg/add.svg" id="addpass" onclick="openOverlay(event)"></a>
        </h2>
        <input type="text" id="buscador" name="buscador" placeholder="Buscar..." class="headpass__buscador" onkeyup="buscarPassword()" data-cy="passwords-buscador">
        </div>
        <div id="add-new-pass" class="overlay" onclick="closeOverlay(event)">
              <div class="overlay__box">
                <form class="box__form" id="form-addnewpass" method="POST" onsubmit="return addNewPass()" novalidate>
                  <h4 class="form__titulo" data-cy="form-newpass-titulo">Añada una Contraseña</h4>
                
                  <input class="input" type="text" id="nombrepass" placeholder="Nombre" data-cy="form-newpass-nombre">
                  <div id="save-error-namepassword" class="label-error"></div>
                  <input class="input" type="password" id="newpassword" placeholder="Contraseña" data-cy="form-newpass-password">
                  <div id="save-error-newpassword" class="label-error"></div>
                  <input class="botonenviar" type="submit" value="Enviar" data-cy="btn-submit-newpass">
                </form>
              </div>
          </div>

        <section id="contrasenas" class="main__passwords" data-cy="passwords-list">
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

