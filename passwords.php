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
    <script src="js/script.js"></script>
  </head>
  <body>
    <div class="container">
      <?php 
      include 'components/header.php';
      include 'bbdd/conexiones.php';
      
      if (!isset($_SESSION["email"])){
        echo "<br/><h2>Mensaje de Rechazo</h2>
        <br/>
        Lo siento, NO tiene privilegios para entrar en esta página, por favor vuelva a la página principal e ingrese un nombre de usuario y apellido.
        <br /><br />
        <a href='index.php'>Volver a página de Inicio </a>";
      } else {

      ?>
    
      <main class="passwords__main">
        <h2 class="main__titulo">Contraseñas</h2>

        <section id="contrasenas" class="main__passwords">
          <?php 

          $pdo = new Conexion();

          $sql = $pdo->prepare('SELECT password_id, generated_pass, nombre_pass FROM saved_passwords AS sp
            INNER JOIN usuarios AS u ON sp.user_id = u.user_id
            WHERE u.email =:email ORDER BY nombre_pass ASC');
          
          $sql->bindValue(':email', $_SESSION['email']);
          $sql->execute();
          $sql->setFetchMode(PDO::FETCH_ASSOC);
          

          $resultado = $sql->fetchAll();
          foreach($resultado as $row) {
            $nombrePass = $row["nombre_pass"];
            $password = $row["generated_pass"];
            $passid = $row["password_id"];

            echo '<div id="savedpass" class="passwords__passdiv">
                    <h4 class="passdiv__nombre" id="' . $passid . '">' . $nombrePass . '</h4>
                    <a class="passdiv__password" id="' . $password . '">' . $password . '</a>
                    <nav class="passdiv__nav">
                    <a class="nav__eliminar" id="deleteClick" onclick="eliminarPass(\'' . $password . '\', \'' . $passid . '\')">Eliminar</a>
                    <a class="nav__copiar" onclick="copiar(\'' . $password . '\')">Copiar</a>
                    </nav>
                  </div>

                  ';
          }
          ?>
        </section>
        
      </main>

      <?php } ?>

      <?php include 'components/footer.php' ?>
    </div>
  </body>
</html>

