function openOverlay(event) {
    if(event.target.id == "loginclick") {
        let overlay = document.getElementById('login');
        overlay.style.opacity = '1';
        overlay.style.visibility = 'visible';
    } else if (event.target.id == "registroclick") {
        let overlay = document.getElementById('registro');
        overlay.style.opacity = '1';
        overlay.style.visibility = 'visible';
    }
}

function closeOverlay(event) {
    if(event.target.id == "login") {
        let overlay = document.getElementById('login');
        let formulario = document.querySelector('.overlay__box');

        if (event.target === overlay && !formulario.contains(event.target)) {
            login(event);
        }
    } else if (event.target.id == "registro") {
        let overlay = document.getElementById('registro');
        let formulario = document.querySelector('.overlay__box');
        let emailError = document.getElementById('email-error');
        let passError = document.getElementById('pass-error');
        let passVerifyError = document.getElementById('passverify-error');
        emailError.innerHTML = "";
        passError.innerHTML = "";
        passVerifyError.innerHTML = "";

        if (event.target === overlay && !formulario.contains(event.target)) {
            login(event);
        }
    }
}

function login(event) {
    if(event.target.id == "login") {
        let overlay = document.getElementById('login');
        overlay.style.opacity = '0';
        overlay.style.visibility = 'hidden';

    } else if (event.target.id == "registro") {
        let overlay = document.getElementById('registro');
        overlay.style.opacity = '0';
        overlay.style.visibility = 'hidden';
    }
}

function validarFormRegistro() {
    // Obtener referencias a los campos y mensajes de error
    let email = document.getElementById("email");
    let pass = document.getElementById('pass');
    let pass_verify = document.getElementById('pass_verify');
    let emailError = document.getElementById('email-error');
    let passError = document.getElementById('pass-error');
    let passVerifyError = document.getElementById('passverify-error');

    let error = 0;

    // Restablecer mensajes de error
    emailError.innerHTML = '';
    passError.innerHTML = '';
    passVerifyError.innerHTML = '';

    // Validar campos
    if (!email.value.trim()) {
        emailError.innerHTML = 'Email es obligatorio';
        error = 1;
    }

    if (!pass.value.trim()) {
        passError.innerHTML = 'Contraseña es obligatoria';
        error = 1;
    }

    if (!pass_verify.value.trim()) {
        passVerifyError.innerHTML = 'Confirmar Contraseña es obligatorio';
        error = 1;
    }

    if(error == 1) {
        return false;
    }

    return true;
}
