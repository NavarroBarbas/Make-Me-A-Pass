function openOverlay(event) {
    //Overlay Login
    if(event.target.id == "loginclick") {
        let overlay = document.getElementById("login");
        overlay.style.opacity = "1";
        overlay.style.visibility = "visible";
    } else if (event.target.id == "registroclick") { // Overlay Registro
        let overlay = document.getElementById("registro");
        overlay.style.opacity = "1";
        overlay.style.visibility = "visible";
    }
}

function closeOverlay(event) {
    //Cierra Overlay Login al clickar fuera del form
    if(event.target.id == "login") {
        let overlay = document.getElementById("login");
        let formulario = document.querySelector(".overlay__box");

        if (event.target === overlay && !formulario.contains(event.target)) {
            login(event);
        }
    } else if (event.target.id == "registro") { //Cierra Overlay Registro al clickar fuera del form
        let overlay = document.getElementById("registro");
        let formulario = document.querySelector(".overlay__box");
        let emailError = document.getElementById("email-error");
        let passError = document.getElementById("pass-error");
        let passVerifyError = document.getElementById("passverify-error");
        emailError.innerHTML = "";
        passError.innerHTML = "";
        passVerifyError.innerHTML = "";

        if (event.target === overlay && !formulario.contains(event.target)) {
            login(event);
        }
    }
}

function login(event) { 
    //Quita la visibilidad del overlay login
    if(event.target.id == "login") {
        let overlay = document.getElementById("login");
        overlay.style.opacity = "0";
        overlay.style.visibility = "hidden";

    } else if (event.target.id == "registro") { //Quita la visibilidad del overlay registro
        let overlay = document.getElementById("registro");
        overlay.style.opacity = "0";
        overlay.style.visibility = "hidden";
    }
}

function validarFormRegistro() {
    // Obtener referencias a los campos y mensajes de error
    let email = document.getElementById("email-registro").value;
    let pass = document.getElementById("pass-registro").value;
    let pass_verify = document.getElementById("pass_verify").value;
    let emailError = document.getElementById("email-error");
    let passError = document.getElementById("pass-error");
    let passVerifyError = document.getElementById("passverify-error");

    let error = 0;

    // Restablecer mensajes de error
    emailError.innerHTML = "";
    passError.innerHTML = "";
    passVerifyError.innerHTML = "";

    // Validar Email
    if (email.length == 0 || email == null) {
        emailError.innerHTML = "Email es obligatorio";
        error = 1;
    } else if(!(/^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$/.test(email))) {
        emailError.innerHTML = "Email es incorrecto";
        error = 1;
    }

    //Validar Contraseña
    if (pass.length == 0 || pass == null) {
        passError.innerHTML = "Contraseña es obligatoria";
        error = 1;
    } else if(!(/^.{8,}$/.test(pass))) {
        passError.innerHTML = "Contraseña debe tener mínimo 8 carácteres";
        error = 1;
    }

    //Validar confirmación de Contraseña
    if (pass_verify == 0 || pass_verify == null) {
        passVerifyError.innerHTML = "Confirmar contraseña es obligatorio";
        error = 1;
    }

    //Validar que sean iguales
    if(pass != pass_verify) {
        passVerifyError.innerHTML = "Las contraseñas deben coincidir";
        error = 1;
    }

    if(error == 1) {
        return false;
    }

    return true;
}

function validarLogin() {
    
}