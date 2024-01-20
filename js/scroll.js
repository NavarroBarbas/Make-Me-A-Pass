document.addEventListener('DOMContentLoaded', function() {
    const contenido = document.querySelector('.container');
    const footer = document.querySelector('footer');

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