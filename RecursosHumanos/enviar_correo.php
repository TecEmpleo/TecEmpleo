<?php
// Verificar si se recibieron los datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['email']) && isset($_POST['mensaje'])) {
    // Recuperar los datos del formulario
    $email = $_POST['email'];
    $mensaje = $_POST['mensaje'];

    // Aquí podrías agregar el código para enviar el mensaje al usuario por correo electrónico,
    // utilizar una API de mensajería, o cualquier otro método de entrega de mensajes.

    // Ejemplo: envío de un mensaje de correo electrónico (necesitarás configurar correctamente tu servidor para enviar correos electrónicos)
    $asunto = "Nuevo mensaje de usuario";
    $cuerpoMensaje = "Mensaje enviado desde el formulario:\n\n" . $mensaje;

    if (mail($email, $asunto, $cuerpoMensaje)) {
        // Si el mensaje se envía correctamente, devuelve una respuesta de éxito
        echo "Mensaje enviado";
    } else {
        // Si hay un error al enviar el mensaje, devuelve un mensaje de error
        echo "Error al enviar el mensaje. Por favor, inténtelo de nuevo más tarde.";
    }
} else {
    // Si no se reciben los datos del formulario, devuelve un mensaje de error
    echo "No se recibieron los datos del formulario.";
}
?>
