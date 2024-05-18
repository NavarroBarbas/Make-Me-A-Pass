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
        echo "<div class='errorsesion'>
        <br/><h2>Mensaje de Rechazo</h2>
        <br/>
        Lo siento, NO tiene privilegios para entrar en esta página, por favor vuelva a la página principal e ingrese un nombre de usuario y apellido.
        <br /><br />
        <a href='./'>Volver a página de Inicio </a>
        </div>";
      } else {
      
      ?>
      
      <main class="cuenta__main">
        <div class="main__barra">
          <section class="barra__datos">
            <a class="datos__email"><u><?php echo $_SESSION["email"] ?></u></a>
            <div class="datos__opcion selected" id="opcionUsuario" onclick="selectedOption(event)">
              <a>Nombre de Usuario</a>
              <img src="svg/arrowright.svg" alt="Flecha derecha" />
            </div>

            <div class="datos__opcion"  id="opcionPassword" onclick="selectedOption()">
              <a>Cambiar Contraseña</a>
              <img src="svg/arrowright.svg" alt="Flecha derecha" />
            </div>

            <div class="datos__opcion datos__delete" id="opcionDelete" onclick="deleteUser()">
              <a>Eliminar Cuenta</a>
              <img src="svg/arrowright.svg" alt="Flecha derecha" />
            </div>
          </section>

          <a class="sessionout" onclick="cerrarSesion()">Cerrar Sesión</a>
        </div>

        <form id="form-nickname" class="main__form" method="POST" onsubmit="return newNickname()" novalidate>
          <input type="text" id="new-nickname" name="nickname" placeholder="Nombre de Usuario">
          <div id="text-error-nickname" class="label-error"></div>

          <input type="password" id="old-pass-nickname" name="old_pass"  placeholder="Contraseña">
          <div id="oldpass-error-nickname" class="label-error"></div>

          <input class="botonenviar" type="submit" value="Enviar">
        </form>

        <form id="formcambiopass" class="main__form" method="POST" onsubmit="return cambiarPass()" style="display:none" novalidate>
          <input type="password" id="new_pass" name="pass_change" placeholder="Nueva Contraseña">
          <div id="pass-error-change" class="label-error"></div>

          <input type="password" id="pass_verify_change" name="pass_verify_change" placeholder="Confirmar Contraseña">
          <div id="passvfy-error-change" class="label-error"></div>

          <input type="password" id="old_pass" name="old_pass"  placeholder="Contraseña Antigua">
          <div id="oldpass-error-change" class="label-error"></div>

          <input class="botonenviar" type="submit" value="Enviar">
        </form>
      </main>

      <!--<main class="cuenta__mainmobile">
        <a class="mainmobile__email"><u><?php echo $_SESSION["email"] ?></u></a>
        <div class="mainmobile__tab" id="usuario_name" onclick="nicknameForm()">
          <a>Nombre de Usuario</a>
          <img src="svg/arrowdown.svg" alt="Flecha derecha" id="arrowright" />
        </div>
        <form class="mainmobile__form" id="formnewnickname" method="POST" onsubmit="return cambiarPass()" novalidate>
          <input type="text" id="new_nickname" name="new_nickname" placeholder="Nuevo Usuario">
          <div id="user-error-mobile" class="label-error"></div>

          <input type="password" id="pass_verify" name="pass_verify" placeholder="Confirmar Contraseña">
          <div id="passvfy-error-mobile" class="label-error"></div>

          <input class="botonenviar" type="submit" value="Enviar">
        </form>
        
        <div class="mainmobile__tab" id="usuario_newpass" onclick="newpassForm()">
          <a>Cambiar Contraseña</a>
          <img src="svg/arrowdown.svg" alt="Flecha derecha" id="arrowright" />
        </div>
        <form class="mainmobile__form" id="formcambiopass" method="POST" onsubmit="return cambiarPass()" novalidate>
          <input type="password" id="new_pass" name="pass_change" placeholder="Nueva Contraseña">
          <div id="pass-error-mobile" class="label-error"></div>

          <input type="password" id="pass_verify_change" name="pass_verify_change" placeholder="Confirmar Contraseña">
          <div id="passvfy-error-mobile" class="label-error"></div>

          <input type="password" id="old_pass" name="old_pass"  placeholder="Contraseña Antigua">
          <div id="oldpass-error-mobile" class="label-error"></div>

          <input class="botonenviar" type="submit" value="Enviar">
        </form>
        
        <a class="sessionout" onclick="cerrarSesion()">Cerrar Sesión</a>
      </main>-->
      
      <?php } ?>
      
      <?php include 'components/footer.php' ?>
    </div>
  </body>
</html>
