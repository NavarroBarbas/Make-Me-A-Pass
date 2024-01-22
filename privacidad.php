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
  </head>
  <body>
    <div class="container">
      <?php include 'components/header.php' ?>
      
      <main class="cookiesandpriv__main">
        <h2>Privacidad</h2>

        <h2>Información que recopilamos</h2>
        <p>Recopilamos información personal que proporcionas voluntariamente, como tu nombre, dirección de correo electrónico, y otra información identificable cuando utilizas nuestro sitio web.</p>
    
        <h2>Uso de la información</h2>
        <p>Utilizamos la información recopilada para personalizar tu experiencia en nuestro sitio web, mejorar nuestros productos y servicios, y enviar comunicaciones relevantes.</p>
    
        <h2>Compartir información con terceros</h2>
        <p>No compartimos tu información personal con terceros, excepto en situaciones legalmente requeridas.</p>
    
        <h2>Seguridad de la información</h2>
        <p>Tomamos medidas de seguridad para proteger tu información personal. Sin embargo, no podemos garantizar la seguridad completa de la información transmitida a través de Internet.</p>
    
        <h2>Derechos del usuario</h2>
        <p>Tienes el derecho de acceder, corregir, actualizar o eliminar tu información personal. Si deseas ejercer estos derechos, por favor, contáctanos.</p>
    
        <h2>Cambios en nuestra política de privacidad</h2>
        <p>Nos reservamos el derecho de actualizar nuestra política de privacidad en cualquier momento. Cualquier cambio será publicado en esta página.</p>
      </section>
      </main>

      <?php include 'components/footer.php' ?>
    </div>
  </body>
</html>

