<?php session_start() ?>

<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- SEO = Básico -->
    <!-- Cada página del sitio tiene que ser diferente el título y la descripción -->
    <title>Make Me A Pass - Cuenta</title>
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
      <?php include 'components/header.php';
      
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

      <script>
        windowWidth  = window.innerWidth;
        if (windowWidth > 575) {
          createMobileCuentaMain(windowWidth, '<?php echo $_SESSION["email"] ?>');
        } else {
          createMobileCuentaMain(windowWidth, '<?php echo $_SESSION["email"] ?>');
        }

        window.addEventListener('resize', function() {
        if (!document.querySelector('.cuenta__mainmobile') && window.innerWidth < 575) {
          createMobileCuentaMain();
        } else {
          checkScreenSize();
        }});
      </script>
      <?php } ?>
      
      <?php include 'components/footer.php' ?>
    </div>
  </body>
</html>
