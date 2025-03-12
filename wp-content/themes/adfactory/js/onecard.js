/***
 * 
 * ONECARD
 * 
 */

document.addEventListener('DOMContentLoaded', function () {
    const $botonEnviarContacto = $("#mi-boton-enviar");
    const botonEnviarContacto = $botonEnviarContacto[0];

    function actualizaBotonEnvio(enviando) {
        if (enviando) {
            botonEnviarContacto.setAttribute('disabled', 'disabled');
            botonEnviarContacto.value = 'Enviando...';
        } else {
            botonEnviarContacto.removeAttribute('disabled');
            botonEnviarContacto.value = 'Enviar';
        }
    }

    $(".wpcf7-form").on("submit", function (e) {
        console.log("submit wpcf7-form");
        actualizaBotonEnvio(true);

        return false;
    })

    document.addEventListener('wpcf7submit', function (event) {
        console.log("wpcf7submit", event);

        if (event.detail.status != "mail_sent") {
            actualizaBotonEnvio(false);
        }
    }, false);

    document.addEventListener('wpcf7invalid', function (event) {
        console.log("wpcf7invalid", event);

        actualizaBotonEnvio(false);
    }, false);
});


