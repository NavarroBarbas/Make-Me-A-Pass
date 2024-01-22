<header class="header">
    <a href="index.php" class="header__nombre">
        <h2>Make Me</h2>
        <img class="nombre__logo" src="img/desktop/logo.webp">
        <h2>A Pass</h2>
    </a>

    <nav class="header__nav">
        <a id="loginclick" onclick="openOverlay(event)" class="nav__login">Iniciar Sesión</a>
        <a id="registroclick" onclick="openOverlay(event)" class="nav__registrarse">Registrarse</a>
    </nav>
</header>

<div id="login" class="overlay" onclick="closeOverlay(event)">
    <div class="overlay__box">
        <section class="box__logo">
            <h4 class="logo__nombre">Make Me A Pass</h4>
            <img class="logo__imagen" src="img/desktop/logo.webp">
        </section>

        <form class="box__form" action="login.php" method="POST">
            <h4 class="form__titulo">Iniciar Sesión</h4>
            <input class="input" type="email" id="email-login" name="email"  placeholder="Email">
            <input class="input" type="password" id="pass-login" name="pass" placeholder="Contraseña">
            <input class="botonenviar" type="submit" value="Enviar">
        </form>
    </div>
</div>

<div id="registro" class="overlay" onclick="closeOverlay(event)">
    <div class="overlay__box">
        <section class="box__logo">
            <h4 class="logo__nombre">Make Me A Pass</h4>
            <img class="logo__imagen" src="img/desktop/logo.webp">
        </section>

        <form class="box__form" action="php/registrarse.php" method="POST" onsubmit="return validarFormRegistro()" novalidate>
            <h4 class="form__titulo">Regístrate</h4>
            <input class="input" type="email" id="email-registro" name="email" placeholder="Email">
            <div id="email-error" class="label-error"></div>

            <input class="input" type="password" id="pass-registro" name="pass" placeholder="Contraseña">
            <div id="pass-error" class="label-error"></div>

            <input class="input" type="password" id="pass_verify" name="pass_verify" placeholder="Confirmar Contraseña">
            <div id="passverify-error" class="label-error"></div>

            <input class="botonenviar" type="submit" value="Enviar">
        </form>
    </div>
</div>