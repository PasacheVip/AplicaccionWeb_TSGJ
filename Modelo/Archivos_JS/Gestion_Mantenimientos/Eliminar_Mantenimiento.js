function confirmarEliminacion(id) {

    Swal.fire({
        title: '¿Estás seguro?',
        text: "¡No podrás revertir esto!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar'
        
    }).then((result) => {

        if (result.isConfirmed) {
            // Redirigir a la URL de eliminación
            window.location.href = '../../Controlador/Ctrl_Administrador/MySQL_Borrar_Mantenimiento.php?IDM=' + id;
        }
    })
}