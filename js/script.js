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
    } else if (event.target.id == "guardarclick") { //Overlay Guardar Contraseña
        let overlay = document.getElementById("savepass");
        overlay.style.opacity = "1";
        overlay.style.visibility = "visible";
    }
}

function closeOverlay(event) {
    //Cierra Overlay Login al clickar fuera del form
    if(event.target.id == "login") {
        let overlay = document.getElementById("login");
        let formulario = document.querySelector(".overlay__box");
        let emailError = document.getElementById("email-error-login");
        let passError = document.getElementById("pass-error-login");
        emailError.innerHTML = "";
        passError.innerHTML = "";

        if (event.target === overlay && !formulario.contains(event.target)) {
            login(event);
        }
    } else if (event.target.id == "registro") { //Cierra Overlay Registro al clickar fuera del form
        let overlay = document.getElementById("registro");
        let formulario = document.querySelector(".overlay__box");
        let emailError = document.getElementById("email-error-registro");
        let passError = document.getElementById("pass-error-registro");
        let passVerifyError = document.getElementById("passverify-error-registro");
        emailError.innerHTML = "";
        passError.innerHTML = "";
        passVerifyError.innerHTML = "";

        if (event.target === overlay && !formulario.contains(event.target)) {
            login(event);
        }
    }  else if (event.target.id == "savepass") { //Cierra Overlay Registro al clickar fuera del form
        let overlay = document.getElementById("savepass");
        let formulario = document.querySelector(".overlay__box");
        let saveError = document.getElementById("save-error-savepass");
        saveError.innerHTML = "";


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
    } else if (event.target.id == "savepass") { //Quita la visibilidad del overlay Guardar Contraseña
        let overlay = document.getElementById("savepass");
        overlay.style.opacity = "0";
        overlay.style.visibility = "hidden";
    }
}

function numLength() {
    var slider = document.getElementById("length");
    var output = document.getElementById("valor");
    output.innerHTML = slider.value;
    
    slider.oninput = function() {
        output.innerHTML = this.value;
    }
}

function validarFormRegistro() {
    // Obtener referencias a los campos y mensajes de error
    let email = document.getElementById("email-registro").value;
    let pass = document.getElementById("pass-registro").value;
    let pass_verify = document.getElementById("pass_verify").value;
    let emailError = document.getElementById("email-error-registro");
    let passError = document.getElementById("pass-error-registro");
    let passVerifyError = document.getElementById("passverify-error-registro");

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
    if (pass_verify.length == 0 || pass_verify == null) {
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
    } else {
        $.ajax({
            type: 'POST',
            url: 'php/registrarse.php',
            data: { emailregistro: email, passregistro: pass, passverify:  pass_verify},
            success: function(response) {
                if(response === 'Añadiendo usuario') {
                    alert("Añadiendo usuario");
                    //Continuar para crear sesión
                    window.location.reload();
                } else if(response === "Este usuario ya existe en el sistema") {
                    passVerifyError.innerHTML = response;
                }
            } ,
            error: function() {
                passError.innerHTML = "Error al procesar la solicitud";
            }
        });
        return false;
    }
}

function validarFormLogin() {
    let email = document.getElementById("email-login").value;
    let pass = document.getElementById("pass-login").value;
    let emailError = document.getElementById("email-error-login");
    let passError = document.getElementById("pass-error-login");

    let error = 0;

    // Restablecer mensajes de error
    emailError.innerHTML = "";
    passError.innerHTML = "";

    if (email.length == 0 || email == null) {
        emailError.innerHTML = "Email es obligatorio";
        error = 1;
    } else if(!(/^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$/.test(email))) {
        emailError.innerHTML = "Email es incorrecto";
        error = 1;
    }

    if (pass.length == 0 || pass == null) {
        passError.innerHTML = "Contraseña es obligatoria";
        error = 1;
    }

    if(error == 1) {
        return false;
    } else {
        $.ajax({
            type: 'POST',
            url: 'php/login.php',
            data: { correo: email, password: pass },
            success: function(response) {
                if(response === 'Login Correcto') {
                    window.location.reload();
                } else {
                    passError.innerHTML = response;
                }
            },
            error: function() {
                passError.innerHTML = "Error al procesar la solicitud";
            }
        });
        return false;
    }
}

function cerrarSesion() {
    $.ajax ({
        type: 'POST',
        url: 'php/logout.php',
        success: function(response) {
            if(response === 'Sesion Cerrada') {
                window.location.href="index.php";
            }
        },
        error: function() {
            alert("Error al procesar la solicitud");
        }
    });
}

function cambiarPass() {
    let password = document.getElementById("new_pass");
    let pass_verify = document.getElementById("pass_verify_change");
    let email = document.getElementById("email");
    
    let passError = document.getElementById("pass-error-change");
    let passVfyError = document.getElementById("passvfy-error-change");
    let emailError = document.getElementById("email-error-change");

    let error = 0;

    passError.innerHTML = "";
    passVfyError = "";
    emailError.innerHTML = "";

    if (password.length == 0 || password == null) {
        passError.innerHTML = "Contraseña es obligatoria";
        error = 1;
    } else if(!(/^.{8,}$/.test(password))) {
        passError.innerHTML = "Contraseña debe tener mínimo 8 carácteres";
        error = 1;
    }

    //Validar confirmación de Contraseña
    if (pass_verify.length == 0 || pass_verify == null) {
        passVfyError.innerHTML = "Confirmar contraseña es obligatorio";
        error = 1;
    }

    if (email.length == 0 || email == null) {
        emailError.innerHTML = "Email es obligatorio";
        error = 1;
    }

    if(error == 1) {
        return false;
    } else {
        $.ajax ({
            type: 'POST',
            url: 'php/changepass.php',
            data: { email: email, changepass: password, passvfy:  pass_verify},
            success: function(response) {
                if(response === "") {

                }
            },
            error: function(response) {
                emailError.innerHTML = "Error al procesar la solicitud";
            }
        });
    }
}

function generarPass() {
    let randompass = document.getElementById("randompass");

    let caracteresEspeciales = "!@#$%^&*()_-+=<>?/{}[]";
    let letrasMayusculas = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    let letrasMinusculas = "abcdefghijklmnopqrstuvwxyz";
    let numeros = "0123456789";
    let caracteres = [letrasMayusculas, letrasMinusculas, numeros, caracteresEspeciales];

    function obtenerIndiceCaracter() {
        let indice = Math.floor(Math.random() * caracteres.length);      
        return indice;
    }

    $.ajax ({
        type: 'POST',
        url: 'php/passlength.php',
        data: {length: length},
        success: function(response) {
            let password = "";

            if(response === 'Sesion iniciada') {
                let length = document.getElementById("length").value;
                let uppercase = document.getElementById("uppercase");       //0
                let lowercase = document.getElementById("lowercase");       //1            
                let charNumeros = document.getElementById("numeros");       //2
                let charEspeciales = document.getElementById("caracteres"); //3

                if(!uppercase.checked) {
                    caracteres = caracteres.filter(elemento => elemento !== letrasMayusculas);
                }

                if(!lowercase.checked) {
                    caracteres = caracteres.filter(elemento => elemento !== letrasMinusculas);
                }
                
                if(!charNumeros.checked) {
                    caracteres = caracteres.filter(elemento => elemento !== numeros);
                }
                
                if(!charEspeciales.checked) {
                    caracteres = caracteres.filter(elemento => elemento !== caracteresEspeciales);
                }

                let indiceAnterior = obtenerIndiceCaracter();
                let indiceNuevo = obtenerIndiceCaracter();

                for (let index = 0; index < length; index++) {
                    if(caracteres.length > 1) {
                        while(indiceAnterior == indiceNuevo) {
                            indiceNuevo = obtenerIndiceCaracter();
                            //Saca menos caracteres de lo marcado a veces
                        }
                    }
                    let caracter = caracteres[indiceNuevo].charAt(Math.floor(Math.random() * caracteres[indiceNuevo].length));
                    indiceAnterior = indiceNuevo;
                    indiceNuevo = obtenerIndiceCaracter();
                    password += caracter;
                }

                randompass.innerHTML = password;
            } else if(response === 'Sesion no iniciada'){
                let indiceAnterior = obtenerIndiceCaracter();
                let indiceNuevo = obtenerIndiceCaracter();

                for (let index = 0; index < 8; index++) {
                    while(indiceAnterior == indiceNuevo) {
                        indiceNuevo = obtenerIndiceCaracter();
                    }
                    let caracter = caracteres[indiceNuevo].charAt(Math.floor(Math.random() * caracteres[indiceNuevo].length));
                    indiceAnterior = indiceNuevo;
                    indiceNuevo = obtenerIndiceCaracter();
                    password += caracter;
                }

                randompass.innerHTML = password;
            }
        },
        error: function() {
            randompass.innerHTML = "Operación no válida";
        }
    });
}

function copiar() {
    let texto = document.getElementById('randompass').innerText;

    // Crear un elemento de input oculto
    let input = document.createElement('input');
    input.value = texto;
    document.body.appendChild(input);

    // Seleccionar el contenido del input
    input.select();

    // Intentar copiar el contenido al portapapeles
    document.execCommand('copy');

    // Eliminar el elemento de input creado
    document.body.removeChild(input);
}

function guardarPass() {
    let randompass = document.getElementById("randompass").innerText;
    let nombrepass = document.getElementById("nombrepass").value;
    let errorPass = document.getElementById("save-error-savepass");
    let error = 0;

    errorPass.innerHTML = "";

    if (nombrepass.length == 0 || nombrepass == null) {
        errorPass.innerHTML = "Nombre es obligatorio";
        error = 1;
    } else if (randompass == "Click Generar") {
        errorPass.innerHTML = "Debes generar una contraseña";
        error = 1;
    }

    if(error == 1) {
        return false;
    } else {
        $.ajax ({
            type: 'POST',
            url: 'php/guardarpass.php',
            data: {password: randompass, nombre: nombrepass},
            success: function(response) {
                if(response === "Insert realizado") {
                    window.location.reload();
                } else {
                    alert(response);
                }
            },
            error: function() {
                errorPass.innerHTML = "Operación no válida";
            }
        });
        return false;
    }
}