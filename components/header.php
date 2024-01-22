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

        <form class="box__form" method="POST" onsubmit="return validarFormLogin()" novalidate>
            <h4 class="form__titulo">Iniciar Sesión</h4>
            <input class="input" type="email" id="email-login"  placeholder="Email">
            <div id="email-error-login" class="label-error"></div>

            <input class="input" type="password" id="pass-login" placeholder="Contraseña">
            <div id="pass-error-login" class="label-error"></div>

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

        <form class="box__form" method="POST" onsubmit="return validarFormRegistro()" novalidate>
            <h4 class="form__titulo">Regístrate</h4>
            <input class="input" type="email" id="email-registro" name="emailregistro" placeholder="Email">
            <div id="email-error-registro" class="label-error"></div>

            <input class="input" type="password" id="pass-registro" name="passregistro" placeholder="Contraseña">
            <div id="pass-error-registro" class="label-error"></div>

            <input class="input" type="password" id="pass_verify" name="passverify" placeholder="Confirmar Contraseña">
            <div id="passverify-error-registro" class="label-error"></div>

            <input class="botonenviar" type="submit" value="Enviar">
        </form>
    </div>
</div>