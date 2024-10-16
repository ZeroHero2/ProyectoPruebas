// -------------- Mensaje de usuario registrado correctamente -------------------
$(document).ready(() => {
    $('form#alta_usuario').submit((event) => {
        alta_usuario = $('form#alta_usuario');
        event.preventDefault();
        $.ajax({
            method: "POST",
            url: "../php/alta.php",
            data: $('form#alta_usuario').serialize(),
            cache: false,
            success: (respuesta_ajax) => {
                let json = JSON.parse(respuesta_ajax);
                let icono;
                json.code == 1 ? icono = "success" : icono = "error";
                Swal.fire({
                    title: "Alta de usuario",
                    html: json.message,
                    icon: icono,
                    confirmButtonText: "OK",
                    didDestroy: () => {
                        if (json.code == 1) alta_usuario[0].reset();
                    }
                });
            }
        });
    });

}); 

