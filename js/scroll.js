document.addEventListener('DOMContentLoaded', function() {
    const contenido = document.querySelector('.container');
    const footer = document.querySelector('footer');

    /* Ajusta la posición del footer en función del contenido y la altura de la ventana.
        Si la altura del contenido es menor o igual a la altura de la ventana, 
        el pie de página se posiciona en la parte inferior de la ventana.
        De lo contrario, el pie de página se posiciona estáticamente.*/

    function ajustarFooter() {
        const contenidoAltura = contenido.clientHeight;
        const ventanaAltura = window.innerHeight;

        if (contenidoAltura <= ventanaAltura) {
            footer.style.position = 'sticky';
            footer.style.bottom = '0';
        } else {
            footer.style.position = 'static';
        }
    }

    ajustarFooter();

    window.addEventListener('resize', ajustarFooter);
});