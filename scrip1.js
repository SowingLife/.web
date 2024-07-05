document.addEventListener("DOMContentLoaded", function() {

    var enlaces = document.querySelectorAll('.enlace1');


    enlaces.forEach(function(enlace) {
        enlace.addEventListener('click', function(event) {
            // Evitar el comportamiento predeterminado del enlace
            event.preventDefault();

            // Mostrar una alerta
            var respuesta = confirm('Por favor, inicie sesión');

            // Redirigir a Login.html si se acepta la alerta
            if (respuesta) {
                window.location.href = 'Login.html';
            }
        });
    });
});

