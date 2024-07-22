function editarCantidad(id, cantidadActual) {
    
    Swal.fire({
        title: 'Editar Cantidad',
        input: 'number',
        inputValue: cantidadActual,
        showCancelButton: true,
        confirmButtonText: 'Modificar',
        cancelButtonText: 'Cancelar',

        preConfirm: (cantidad) => {

            return new Promise((resolve, reject) => {
                
                // Enviar la solicitud AJAX para actualizar la cantidad
                fetch('../../Controlador/Productos/Editar_Producto.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ id: id, cantidad: cantidad })
                })

                .then(response => response.json())

                .then(data => {

                    if (data.success) {

                        // Actualizar la cantidad en la tabla
                        let cantidadElement = document.querySelector(`.cantidad[data-id='${id}']`);

                        if (cantidadElement) {
                            cantidadElement.innerText = cantidad;
                        }

                        resolve();
                        Swal.fire({
                            icon: 'success',
                            title: 'Cantidad actualizada',
                            text: 'La cantidad ha sido actualizada correctamente.'
                        });

                    } else {

                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: data.message || 'Error al actualizar la cantidad'
                        });
                        reject();

                    }
                })

                .catch((error) => {

                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: error.message || 'Error al actualizar la cantidad'
                    });
                    reject();

                });
            });
        }
    });
}