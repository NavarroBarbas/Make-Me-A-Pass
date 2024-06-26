<?php
include_once(__DIR__."/bbdd/usuario.php");
if($_GET["id"] == null || $_GET["token"] == null) {
    header("Location: index.php");
}
$id=$_GET['id'];
$token=$_GET['token'];
$u=new Usuario($id);
if ($token == $u->getToken()) {
?>
    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <!-- SEO = Básico -->
        <!-- Cada página del sitio tiene que ser diferente el título y la descripción -->
        <title>Make Me A Pass - Reset Pass</title>
        <meta name="description" content="" />
        <meta name="keywords" content="" />

        <!-- Etiquetas Open Graph y Twitter Card, para crear el SEO de Redes Sociales -->
        <meta property="og:title" content="Título de tu página" />
        <meta property="og:description" content="Descripción de tu página" />
        <meta property="og:image" content="URL de la imagen que quieres mostrar en las redes sociales" />
        <meta property="og:url" content="URL de tu página" />
        <meta property="og:type" content="website" />
        <meta name="twitter:card" content="summary_large_image" />
        <meta name="twitter:title" content="Título de tu página" />
        <meta name="twitter:description" content="Descripción de tu página" />
        <meta name="twitter:image" content="URL de la imagen que quieres mostrar en Twitter" />

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
            <?php include 'components/header.php'; ?>
            <main class="reset__main">
                <form class="main__form" method="POST" onsubmit="return resetPass()" novalidate>
                    <h2 class="main__titulo">Nueva Contraseña</h2>

                    <input class="input" type="password" id="new-pass-reset" name="passregistro" placeholder="Nueva Contraseña">
                    <div id="reset-newpass-msg" class="label-error"></div>

                    <input class="input" type="password" id="newpass-verify-reset" name="passregistro" placeholder="Repite la contraseña">
                    <div id="reset-newpassvfy-msg" class="label-error"></div>
                    
                    <input type="hidden" type="text" id="id" value="<?php echo $id; ?>">
                    <input type="hidden" type="text" id="token" value="<?php echo $token; ?>">

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
