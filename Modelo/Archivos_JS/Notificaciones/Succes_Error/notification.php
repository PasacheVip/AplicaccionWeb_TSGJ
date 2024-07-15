<!-- ==== NOTIFICACION DE LA ELIMINACION DEL MANTENIMIENTO ===== -->

<?php

if (isset($_SESSION['message']) && isset($_SESSION['message_type'])) {

    $message = $_SESSION['message'];
    $messageType = $_SESSION['message_type'];

    echo "

            <script>

            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: '$message',
                    icon: '$messageType',
                    confirmButtonText: 'OK'
                });
            });

            </script>
            
            ";

    // Eliminar los datos de la sesión
    unset($_SESSION['message']);
    unset($_SESSION['message_type']);
}

?>