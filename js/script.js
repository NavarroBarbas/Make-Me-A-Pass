// Abrir Overlay Login, Registro, GuardarPass, BorrarPass
function openOverlay(event) {
    //Overlay Login
    if(event.target.id == "loginclick") {
        cerrarMenu();
        let overlay = document.getElementById("login");
        overlay.style.opacity = "1";
        overlay.style.visibility = "visible";
    } else if (event.target.id == "registroclick") { // Overlay Registro
        cerrarMenu();
        let overlay = document.getElementById("registro");
        overlay.style.opacity = "1";
        overlay.style.visibility = "visible";
    } else if (event.target.id == "guardarclick") { //Overlay Guardar Contraseña
        let overlay = document.getElementById("savepass");
        overlay.style.opacity = "1";
        overlay.style.visibility = "visible";
    } else if(event.target.id == "resetclick") {
        let overlay = document.getElementById("resetpass");
        overlay.style.opacity = "1";
        overlay.style.visibility = "visible";
        atributosOverlay("login");
    }
}

// Cerrar Overlay Login, Registro, GuardarPass, BorrarPass
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
            atributosOverlay(event.target.id);
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
            atributosOverlay(event.target.id);
        }
    } else if (event.target.id == "savepass") { //Cierra Overlay Guardar Contraseña al clickar fuera del form
        console.log(event.target.id);
        let overlay = document.getElementById("savepass");
        let formulario = document.querySelector(".overlay__box");
        let saveError = document.getElementById("save-error-savepass");
        saveError.innerHTML = "";

        if (event.target === overlay && !formulario.contains(event.target)) {
            atributosOverlay(event.target.id);
        }
    } else if (event.target.id == "resetpass") { //Cierra Overlay Guardar Contraseña al clickar fuera del form
        console.log(event.target.id);
        let overlay = document.getElementById("resetpass");
        let formulario = document.querySelector(".overlay__box");
        let resetpassmsg = document.getElementById("reset-pass-msg");
        resetpassmsg.innerHTML = "";
        if (event.target === overlay && !formulario.contains(event.target)) {
            atributosOverlay(event.target.id);
        }
    }
}

// Estilos de visibilidad para el Overlay
function atributosOverlay(id) { 
    //Quita la visibilidad del overlay login
    if(id == "login") {
        let overlay = document.getElementById("login");
        overlay.style.opacity = "0";
        overlay.style.visibility = "hidden";

    } else if (id == "registro") { //Quita la visibilidad del overlay registro
        let overlay = document.getElementById("registro");
        overlay.style.opacity = "0";
        overlay.style.visibility = "hidden";

    } else if (id == "savepass") { //Quita la visibilidad del overlay Guardar Contraseña
        let overlay = document.getElementById("savepass");
        overlay.style.opacity = "0";
        overlay.style.visibility = "hidden";
    } else if (id == "resetpass") { //Quita la visibilidad del overlay Guardar Contraseña
        let overlay = document.getElementById("resetpass");
        overlay.style.opacity = "0";
        overlay.style.visibility = "hidden";
    }
}

//Valor del slider la longitud de contraseña deseada
function numLength() {
    var slider = document.getElementById("length");
    var output = document.getElementById("valor");
    output.innerHTML = slider.value;
    
    slider.oninput = function() {
        output.innerHTML = this.value;
    }
}

//Registro Usuario
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

    if(error == 1) { // Si hay errores
        return false;
    } else { // Si no hay errores
        $.ajax({
            type: 'POST',
            url: 'php/registrarse.php',
            data: { emailregistro: email, passregistro: pass},
            success: function(response) {
                // Añadir usuario
                if(response === 'Añadiendo usuario') {
                    passVerifyError.innerHTML = "Revise su email para confirmar su cuenta";
                } else if(response === "Este usuario ya existe en el sistema") {
                    // Usuario existente
                    passVerifyError.innerHTML = "Revise su email para confirmar su cuenta";
                }
            } ,
            error: function() {
                passError.innerHTML = "Error al procesar la solicitud";
            }
        });
        return false;
    }
}

//Login Usuario
function validarFormLogin() {
    let email = document.getElementById("email-login").value;
    let pass = document.getElementById("pass-login").value;
    let emailError = document.getElementById("email-error-login");
    let passError = document.getElementById("pass-error-login");

    let error = 0;

    // Restablecer mensajes de error
    emailError.innerHTML = "";
    passError.innerHTML = "";

    // Validación de email correcto y obligatorio
    if (email.length == 0 || email == null) {
        emailError.innerHTML = "Email es obligatorio";
        error = 1;
    } else if(!(/^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$/.test(email))) {
        emailError.innerHTML = "Email es incorrecto";
        error = 1;
    }

    //Validación de contraseña obligatoria
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
                // Login
                if(response === 'Login Correcto') {
                    window.location.reload();
                } else {
                    // Login error
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

//Logout Usuario
function cerrarSesion() {
    $.ajax ({
        type: 'POST',
        url: 'php/logout.php',
        success: function(response) {
            // Cierra sesión
            if(response === 'Sesion Cerrada') {
                window.location.href="./";
            }
        },
        error: function() {
            alert("Error al procesar la solicitud");
        }
    });
}

//Cuenta Usuario Opción Seleccionada
function selectedOption() {
    let opcionUsuario = document.getElementById("opcionUsuario");
    let opcionPassword = document.getElementById("opcionPassword");
    let formNickname = document.getElementById("form-nickname");
    let formPassword = document.getElementById("formcambiopass");

    if(!opcionUsuario.classList.contains("selected")) {
        opcionUsuario.classList.add("selected");
        opcionPassword.classList.remove("selected");
        opcionDelete.classList.remove("selected");
        formNickname.style.display = "flex";
        formPassword.style.display = "none";
        document.getElementById("text-error-nickname").innerHTML = "";
        document.getElementById("oldpass-error-nickname").innerHTML = "";
    } else if(!opcionPassword.classList.contains("selected")) {
        opcionPassword.classList.add("selected");
        opcionUsuario.classList.remove("selected");
        opcionDelete.classList.remove("selected");
        formNickname.style.display = "none";
        formPassword.style.display = "flex";
        document.getElementById("pass-error-change").innerHTML = "";
        document.getElementById("passvfy-error-change").innerHTML = "";
        document.getElementById("oldpass-error-change").innerHTML = "";
    }
}

// Cambiar contraseña Usuario cuenta.php
function cambiarPass() {
    // Valores formulario
    let formulario = document.getElementById("formcambiopass");
    let password = document.getElementById("new_pass").value;
    let pass_verify = document.getElementById("pass_verify_change").value;
    let oldPass = document.getElementById("old_pass").value;
    
    // Variables de error
    let passError = document.getElementById("pass-error-change");
    let passVfyError = document.getElementById("passvfy-error-change");
    let oldPassError = document.getElementById("oldpass-error-change");

    let error = 0;

    passError.innerHTML = "";
    passVfyError.innerHTML = "";
    oldPassError.innerHTML = "";

    // Validar contraseña obligatoria y válida
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

    //Validar que sean iguales
    if(password != pass_verify) {
        passVfyError.innerHTML = "Las contraseñas deben coincidir";
        error = 1;
    }

    // Validar que la contraseña antigua sea obligatoria
    if (oldPass.length == 0 || oldPass == null) {
        oldPassError.innerHTML = "La antigua contraseña es obligatoria";
        error = 1;
    }

    if(error == 1) {
        return false;
    } else {
        $.ajax ({
            type: 'POST',
            url: 'php/changepass.php',
            data: { oldpass: oldPass, changepass: password},
            success: function(response) {
                if(response === "Password Changed") {
                    // Cambio de contraseña del usuario y popup de confirmación
                    Swal.fire({
                        position: "center",
                        icon: "success",
                        title: "Contraseña Cambiada",
                        showConfirmButton: false,
                        timer: 1500
                    });
                    
                    //Recarga el formulario para tenerlo en blanco
                    formulario.reset();
                } else {
                    // Error email incorrecto o no es posible cambiarla
                    oldPassError.innerHTML = response;
                }
            },
            error: function() {
                oldPassError.innerHTML = "Error al procesar la solicitud";
            }
        });
        return false;
    }
}

function newNickname() {
    let formulario = document.getElementById("form-nickname");
    let nickname = document.getElementById("new-nickname").value;
    let oldPass = document.getElementById("old-pass-nickname").value;

    let newNicknameError = document.getElementById("text-error-nickname");
    let oldPassError = document.getElementById("oldpass-error-nickname");

    let error = 0;

    newNicknameError.innerHTML = "";
    oldPassError.innerHTML = "";

    if(nickname.length == 0 || nickname == null) {
        newNicknameError.innerHTML = "El nombre de Usuario es obligatorio";
        error = 1;
    } else if(nickname.length < 6) {
        newNicknameError.innerHTML = "El nombre de Usuario no puede tener menos de 6 carácteres";
        error = 1;
    } else if(nickname.length > 16) {
        newNicknameError.innerHTML = "El nombre de Usuario no puede tener más de 16 carácteres";
        error = 1;
    }

    // Validar que la contraseña antigua sea obligatoria
    if (oldPass.length == 0 || oldPass == null) {
        oldPassError.innerHTML = "La antigua contraseña es obligatoria";
        error = 1;
    }

    if(error == 1) {
        return false;
    } else {
        $.ajax ({
            type: 'POST',
            url: 'php/changenickname.php',
            data: { oldpass: oldPass, nickname: nickname},
            success: function(response) {
                if(response === "Nickname Changed") {
                    // Cambio de contraseña del usuario y popup de confirmación
                    Swal.fire({
                        position: "center",
                        icon: "success",
                        title: "Usuario Actualizado",
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => {
                        window.location.reload();
                    });
                    
                    //Recarga el formulario para tenerlo en blanco
                    formulario.reset();
                } else if(response === "Contraseña incorrecta") {
                    oldPassError.innerHTML = response;
                } else {
                    // Error email incorrecto o no es posible cambiarla
                    newNicknameError.innerHTML = response;
                }
            },
            error: function() {
                oldPassError.innerHTML = "Error al procesar la solicitud";
            }
        });
        return false;
    }
}

function deleteUser() {
    Swal.fire({
        title: "¿Está seguro de eliminar su cuenta?",
        text: "No se podrá revertir esta acción!",
        showCancelButton: true,
        confirmButtonColor: "#0073c7",
        cancelButtonColor: "#d33",
        cancelButtonText: "Cancelar",
        confirmButtonText: "Si, Eliminar Cuenta!"
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax ({
                type: 'POST',
                url: 'php/deleteuser.php',
                success: function(response) {
                    if(response === "Usuario eliminado") {
                        // Usuario eliminado y popup de confirmación
                        Swal.fire({
                            position: "center",
                            icon: "success",
                            title: "Usuario Eliminado",
                            showConfirmButton: true,
                            confirmButtonColor: "#0073c7",
                        }).then((result) => {
                            if(result.isConfirmed) {
                                window.location.href = "./";
                            }
                        });
                    } else {
                        Swal.fire({
                            icon: "error",
                            title: "Oops...",
                            text: "Algo fue mal!",
                            footer: 'No se puedo eliminar la cuenta'
                        });
                    }
                },
                error: function() {
                    oldPassError.innerHTML = "Error al procesar la solicitud";
                }
            });
        }
    });
}

// Generar contraseña index.php
function generarPass() {
    let randompass = document.getElementById("randompass");

    // Variables con los strings y array necesarios
    let caracteresEspeciales = "!@#$%^&*()_-+=<>?/{}[]";
    let letrasMayusculas = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    let letrasMinusculas = "abcdefghijklmnopqrstuvwxyz";
    let numeros = "0123456789";
    let caracteres = [letrasMayusculas, letrasMinusculas, numeros, caracteresEspeciales];

    // Índice inicial del array caracteres
    function obtenerIndiceCaracter() {
        let indice = Math.floor(Math.random() * caracteres.length);      
        return indice;
    }

    // Generador de la contraseña
    function generador(length) {
        let password = "";

        // Indices del array caracteres
        let indiceAnterior = obtenerIndiceCaracter();
        let indiceNuevo = obtenerIndiceCaracter();

        // Bucle para generar la contraseña con la longitud deseada
        for (let index = 0; index < length; index++) {
            if(caracteres.length > 1) {
                // Si el indice es igual al anterior vuelve a generar uno nuevo hasta que cambie
                while(indiceAnterior == indiceNuevo) {
                    indiceNuevo = obtenerIndiceCaracter();
                }
            }

            // Añadimos en la contraseña un caracter random del string del índice seleccionado
            // Y cambiamos el indice nuevo por el anterior y generamos uno nuevo
            let caracter = caracteres[indiceNuevo].charAt(Math.floor(Math.random() * caracteres[indiceNuevo].length));
            if(caracter == "<") {
                caracter = "&lt;"
            }
            indiceAnterior = indiceNuevo;
            indiceNuevo = obtenerIndiceCaracter();
            password += caracter;
            console.log(password);
        }

        // Mostramos contraseña
        randompass.innerHTML = password;
    }

    $.ajax ({
        type: 'POST',
        url: 'php/confirmarsesion.php',
        success: function(response) {
            if(response === 'Sesion iniciada') { // Login hecho
                // Valor de la longitud escogida y checkbox de las opciones
                let length = document.getElementById("length").value;
                let uppercase = document.getElementById("uppercase");       //0
                let lowercase = document.getElementById("lowercase");       //1            
                let charNumeros = document.getElementById("numeros");       //2
                let charEspeciales = document.getElementById("caracteres"); //3

                // Verificación de las opciones marcadas del checkbox
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

                generador(length);

            } else if(response === 'Sesion no iniciada'){ // Login no hecho
                generador(8);
            }
        },
        error: function() {
            randompass.innerHTML = "Operación no válida";
        }
    });
}

// Copiar contraseña
function copiar(elementId) {
    /*//Valor de la contraseña
    let texto = document.getElementById(idelement).innerText;

    // Copiar al portapapeles
    navigator.clipboard.writeText(texto);*/
    let texto = document.getElementById(elementId).innerText;

    // Si no hay contraseña generada no la copia
    if(texto === "Click Generar") {
        exit;
    }
    
    // Crea un elemento de textarea temporal para copiar el texto
    let textarea = document.createElement('textarea');
    textarea.value = texto;
    textarea.style.position = 'fixed'; // asegura que no se mueva de su posición
    document.body.appendChild(textarea);
    
    // Selecciona y copia el texto dentro del textarea
    textarea.select();
    document.execCommand('copy');
    
    // Elimina el textarea temporal
    document.body.removeChild(textarea);

    // Popup de confirmación
    Swal.fire({
        position: "center",
        icon: "success",
        title: "Contraseña Copiada",
        showConfirmButton: false,
        timer: 1500
    });
    
}

// Guardar Contraseña
function guardarPass() {
    // Variables necesarias
    let randompass = document.getElementById("randompass").innerText;
    let nombrepass = document.getElementById("nombrepass").value;
    let errorPass = document.getElementById("save-error-savepass");
    let regex = /^[a-zA-Z0-9 @.]+$/;
    let error = 0;

    errorPass.innerHTML = "";

    // Validaciones necesarias de email y contraseña
    if (nombrepass.length == 0 || nombrepass == null) {
        errorPass.innerHTML = "Nombre es obligatorio";
        error = 1;
    } else if (randompass == "Click Generar") {
        errorPass.innerHTML = "Debes generar una contraseña";
        error = 1;
    } else if (!regex.test(nombrepass)) {
        errorPass.innerHTML = "El nombre no puede contener carácteres especiales";
        error = 1;
    } else if (nombrepass.length > 30) {
        errorPass.innerHTML = "El nombre no puede tener mas de 30 carácteres";
        error = 1;
    }

    if(error == 1) {
        return false;
    } else { // Sin errores
        $.ajax ({
            type: 'POST',
            url: 'php/guardarpass.php',
            data: {password: randompass, nombre: nombrepass},
            success: function(response) {
                // Guardamos contraseña y pop up de confirmación
                if(response === "Insert realizado") {
                    Swal.fire({
                        position: "center",
                        icon: "success",
                        title: "Contraseña Guardada",
                        showConfirmButton: false,
                        timer: 1500
                    });

                    //Cerramos overlay
                    atributosOverlay("savepass");
                } else {
                    errorPass.innerHTML = response;
                }
            },
            error: function() {
                errorPass.innerHTML = "Operación no válida";
            }
        });
        return false;
    }
}

// Eliminar contraseña
function eliminarPass(idpass, namepass) {
    // Desde el HTML se le pasan los datos necesarios y cogemos sus valores
    let pass = document.getElementById(idpass).innerText;
    let name = document.getElementById(namepass).innerText;

    $.ajax ({
        type: 'POST',
        url: 'php/deletepass.php',
        data: {password: pass, nombrepass: name, passid: namepass},
        success: function(response) {
            // Eliminamos contraseña
            if(response === "Contraseña Eliminada") {
                // Recargamos solo el apartado de las contraseñas
                $("#contrasenas").load("passwords.php #savedpass");
            } else {
                alert(response);
            }
        },
        error: function() {
            alert("Operación no válida");
        }
    });
}

//Open Menu Movil
function openMenu() {
    let menu = document.getElementById("headermenu");
    menu.style.height = "100vh";
}

//Close Menu Movil
function cerrarMenu() {
    let menu = document.getElementById("headermenu");
    menu.style.height = "0vh";
}