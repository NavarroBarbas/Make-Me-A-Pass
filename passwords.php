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
    <script src="js/script.js"></script>
  </head>
  <body>
    <div class="container">
      <?php include 'components/header.php' ?>
    
      <main class="passwords__main">
        <h2 class="main__titulo">Contraseñas</h2>

        <section class="main__passwords">
          <div class="passwords__passdiv">
            <h4 class="passdiv__nombre">Nombre Password</h4>
            <a class="passdiv__password">12345678901234567890123456789012</a>
          </div>
          <div class="passwords__passdiv">
            <h4 class="passdiv__nombre">Nombre Password</h4>
            <a class="passdiv__password">Password</a>
          </div>
          <div class="passwords__passdiv">
            <h4 class="passdiv__nombre">Nombre Password</h4>
            <a class="passdiv__password">Password</a>
          </div>
          <div class="passwords__passdiv">
            <h4 class="passdiv__nombre">Nombre Password</h4>
            <a class="passdiv__password">Password</a>
          </div>
          <div class="passwords__passdiv">
            <h4 class="passdiv__nombre">Nombre Password</h4>
            <a class="passdiv__password">Password</a>
          </div>
          
          
        </section>
        
      </main>

      <?php include 'components/footer.php' ?>
    </div>
  </body>
</html>

