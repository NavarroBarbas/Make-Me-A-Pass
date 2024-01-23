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

//No carga index correctamente
function cerrarSesion() {
    window.location.href = "index.php";
    $.ajax ({
        type: 'POST',
        url: 'php/logout.php',
        success: function(response) {
            if(response === 'Sesion Cerrada') {
                alert("La sesión se ha cerrado correctamente");
                window.location.reload();
            }
        },
        error: function() {
            alert("Error al procesar la solicitud");
        }
    });
}

function generarPass() {
    let randompass = document.getElementById("randompass");

    let caracteresEspeciales = "!@#$%^&*()_-+=<>?/{}[]";
    let letrasMayusculas = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    let letrasMinusculas = "abcdefghijklmnopqrstuvwxyz";
    let numeros = "0123456789";
    let caracteres = [letrasMayusculas, letrasMinusculas, numeros, caracteresEspeciales];

    function obtenerCaracter() {
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
                /*let uppercase = document.getElementById("uppercase");       //0
                let lowercase = document.getElementById("lowercase");       //1            
                let numeros = document.getElementById("numeros");           //2
                let charEspeciales = document.getElementById("caracteres"); //3

                if(!uppercase.checked) {
                    caracteres.splice(0, 1);
                }

                if(!lowercase.checked) {
                    caracteres.splice(1, 1);
                }
                
                if(!numeros.checked) {
                    caracteres.splice(2, 1);
                }
                
                if(!charEspeciales.checked) {
                    caracteres.splice(3, 1);
                }*/

                let indiceAnterior = obtenerCaracter();
                let indiceNuevo = obtenerCaracter();

                for (let index = 0; index < length; index++) {
                    while(indiceAnterior == indiceNuevo) {
                        indiceNuevo = obtenerCaracter();
                        //Saca mas de 8 caracteres
                    }
                    let caracter = caracteres[indiceNuevo].charAt(Math.floor(Math.random() * caracteres[indiceNuevo].length));
                    indiceAnterior = indiceNuevo;
                    indiceNuevo = obtenerCaracter();
                    password += caracter;
                }
                randompass.innerHTML = password;
            } else if(response === 'Sesion no iniciada'){
                let indiceAnterior = obtenerCaracter();
                let indiceNuevo = obtenerCaracter();

                for (let index = 0; index < 8; index++) {
                    while(indiceAnterior == indiceNuevo) {
                        indiceNuevo = obtenerCaracter();
                    }
                    let caracter = caracteres[indiceNuevo].charAt(Math.floor(Math.random() * caracteres[indiceNuevo].length));
                    indiceAnterior = indiceNuevo;
                    indiceNuevo = obtenerCaracter();
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