function openOverlay(event) {
    if(event.target.id == "loginclick") {
        var overlay = document.getElementById('login');
        overlay.style.opacity = '1';
        overlay.style.visibility = 'visible';
    } else if (event.target.id == "registroclick") {
        var overlay = document.getElementById('registro');
        overlay.style.opacity = '1';
        overlay.style.visibility = 'visible';
    }
}

function closeOverlay(event) {
    if(event.target.id == "login") {
        var overlay = document.getElementById('login');
        var formulario = document.querySelector('.overlay__box');

        if (event.target === overlay && !formulario.contains(event.target)) {
            login(event);
        }
    } else if (event.target.id == "registro") {
        var overlay = document.getElementById('registro');
        var formulario = document.querySelector('.overlay__box');

        if (event.target === overlay && !formulario.contains(event.target)) {
            login(event);
        }
    }
}

function login(event) {
    if(event.target.id == "login") {
        var overlay = document.getElementById('login');
        overlay.style.opacity = '0';
        overlay.style.visibility = 'hidden';

    } else if (event.target.id == "registro") {
        var overlay = document.getElementById('registro');
        overlay.style.opacity = '0';
        overlay.style.visibility = 'hidden';
    }
}