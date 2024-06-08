<header class="header" data-cy="header">
    <a href="./" class="header__nombre">
        <img class="nombre__logo" src="img/desktop/logo.webp" data-cy="header-logo">
        <h2 class="nombre__titulo" data-cy="header-titulo">Make Me A Pass</h2>
    </a>

    <a class="header__menubtn" id="menubtn" onclick="openMenu()"><img src="svg/menu.svg"></a>
    <nav class="header__menu" id="headermenu">
        <div class="menu__nav">
            <a class="nav__cerrar" id="cerrar-menu" onclick="cerrarMenu()"><img src="svg/cerrarmenu.svg"></a>
            <?php if (isset($_SESSION["email"])) {
                echo '<a id="cuenta" href="cuenta.php" class="menunav__registrarse">';
                if(isset($_SESSION['nickname']) && $_SESSION['nickname'] != "") {
                    echo $_SESSION['nickname'];
                } else {
                    echo $_SESSION['email'];
                }
                echo '</a>';
                echo '<a id="contraseñas" href="passwords.php" class="menunav__login">Contraseñas</a>';
                echo '<a id="logout" onclick=cerrarSesion() class="menunav__logout">Cerrar Sesión</a>';
            } else { ?>
            <a id="registroclick" onclick="openOverlay(event)" class="menunav__registrarse">Registrarse</a>
            <a id="loginclick" onclick="openOverlay(event)" class="menunav__login">Iniciar Sesión</a>
            <?php } ?>
        </div>
    </nav>
    <nav class="header__nav" id="headernav">
        <?php if (isset($_SESSION["email"])) {
            echo '<a id="contraseñas" href="passwords.php" class="nav__login">Contraseñas</a>';
            echo '<a id="cuenta" href="cuenta.php" class="nav__registrarse">';
                if(isset($_SESSION['nickname']) && $_SESSION['nickname'] != "") {
                    echo $_SESSION['nickname'];
                } else {
                    echo $_SESSION['email'];
                }
            echo '</a>';
        } else { ?>
        <a id="loginclick" onclick="openOverlay(event)" class="nav__login" data-cy="header-login">Iniciar Sesión</a>
        <a id="registroclick" onclick="openOverlay(event)" class="nav__registrarse" data-cy="header-registro">Registrarse</a>
        <?php } ?>
    </nav>
</header>

<div id="login" class="overlay" onclick="closeOverlay(event)" data-cy="modal-login">
    <div class="overlay__box">
        <section class="box__logo">
            <img class="logo__imagen" src="img/desktop/logo.webp" data-cy="modal-logo">
            <h4 class="logo__nombre" data-cy="modal-titulo-web">Make Me A Pass</h4>
        </section>

        <form class="box__form" id="formLogin" method="POST" onsubmit="return validarFormLogin()" novalidate>
            <h4 class="form__titulo" data-cy="form-titulo-login">Iniciar Sesión</h4>
            <input class="input" type="email" id="email-login"  placeholder="Email" data-cy="input-email-login">
            <div id="email-error-login" class="label-error" data-cy="email-error-login"></div>

            <input class="input" type="password" id="pass-login" placeholder="Contraseña" data-cy="input-pass-login">
            <div id="pass-error-login" class="label-error" data-cy="pass-error-login"></div>

            <a class="form__resetpass" id="resetclick" onclick="openOverlay(event)" data-cy="form-reset-pass-login">
                ¿Has olvidado tu contraseña?
            </a>

            <input class="botonenviar" type="submit" value="Enviar" data-cy="btn-submit-login">
        </form>
    </div>
</div>

<div id="registro" class="overlay" onclick="closeOverlay(event)" data-cy="modal-registro">
    <div class="overlay__box" data-cy="overlay-box">
        <section class="box__logo">
            <img class="logo__imagen" src="img/desktop/logo.webp" data-cy="modal-logo">
            <h4 class="logo__nombre" data-cy="modal-titulo-web">Make Me A Pass</h4>
        </section>

        <form class="box__form" id="formRegistro" method="POST" onsubmit="return validarFormRegistro()" novalidate>
            <h4 class="form__titulo" data-cy="form-titulo-registro">Regístrate</h4>
            <input class="input" type="email" id="email-registro" name="emailregistro" placeholder="Email" data-cy="input-email-registro">
            <div id="email-error-registro" class="label-error" data-cy="email-error-registro"></div>

            <input class="input" type="password" id="pass-registro" name="passregistro" placeholder="Contraseña" data-cy="input-pass-registro">
            <div id="pass-error-registro" class="label-error" data-cy="pass-error-registro"></div>

            <input class="input" type="password" id="pass_verify" name="passverify" placeholder="Confirmar Contraseña" data-cy="input-passvfy-registro">
            <div id="passverify-error-registro" class="label-error" data-cy="passvfy-error-registro"></div>

            <input class="botonenviar" type="submit" value="Enviar" data-cy="btn-submit-registro">
        </form>
    </div>
</div>

<div id="resetpass" class="overlay" onclick="closeOverlay(event)" data-cy="modal-reset-pass">
    <div class="overlay__box">
        <section class="box__logo">
            <img class="logo__imagen" src="img/desktop/logo.webp" data-cy="modal-logo">
            <h4 class="logo__nombre" data-cy="modal-titulo-web">Make Me A Pass</h4>
        </section>

        <form class="box__form" method="POST" onsubmit="return sendEmailResetPass()" novalidate>
            <h4 class="form__titulo" data-cy="form-titulo-reset-pass">¿Olvidaste tu Contraseña?</h4>

            <input class="input" type="email" id="email-reset" name="emailreset" placeholder="Email" data-cy="input-email-reset-pass">
            <div id="reset-email-msg" class="label-error" data-cy="email-error-reset-pass"></div>

            <input class="botonenviar" type="submit" value="Enviar" data-cy="btn-submit-reset-pass">
        </form>
    </div>
</div>