/* global Swal */

function validarFormulario(evento) {
    evento.preventDefault();

    // Select Vehiculo
    var Vehiculo = document.querySelector('select[name="flotaVehiculo"]').value;
    if (Vehiculo.length === 0) {
        Swal.fire({
            width: '23rem',
            position: 'center',
            icon: 'info',
            title: 'Por favor, Seleccione un Vehiculo',
            showConfirmButton: false,
            timer: 1500
        });
        return;
    }

    // Input encargado
    var encargado = document.getElementById('encargado').value;
    if (encargado.length === 0) {
        Swal.fire({
            width: '23rem',
            position: 'center',
            icon: 'info',
            title: 'Por favor, Ingrese el Nombre del Encargado',
            showConfirmButton: false,
            timer: 1500
        });
        return;
    }

    // Input descripcion
    var descripcion = document.getElementById('descripcion').value;
    if (descripcion.length === 0) {
        Swal.fire({
            width: '23rem',
            position: 'center',
            icon: 'info',
            title: 'Por favor, Ingrese la descripcion del Mantenimiento',
            showConfirmButton: false,
            timer: 1500
        });
        return;
    }

    // Select productos
    var productos = document.querySelector('select[name="productosSeleccionados"]').value;
    if (productos.length === 0) {
        Swal.fire({
            width: '23rem',
            position: 'center',
            icon: 'info',
            title: 'Por favor, Seleccione el Producto a Utilizar.',
            showConfirmButton: false,
            timer: 1500
        });
        return;
    }

    // Input Fecha
    var Fecha = document.getElementById('fecha').value;
    if (Fecha.length === 0) {
        Swal.fire({
            width: '23rem',
            position: 'center',
            icon: 'info',
            title: 'Por favor, Ingrese la Fecha del Mantenimiento',
            showConfirmButton: false,
            timer: 1500
        });
        return;
    }

    // Select tipo_mantenimiento
    var tipo_mantenimiento = document.querySelector('select[name="tipo_mantenimiento"]').value;
    if (tipo_mantenimiento.length === 0) {
        Swal.fire({
            width: '23rem',
            position: 'center',
            icon: 'info',
            title: 'Por favor, Seleccione el Tipo de Mantenimiento.',
            showConfirmButton: false,
            timer: 1500
        });
        return;
    }

    this.submit();
}

document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('Agregar_Mantenimiento').addEventListener('submit', validarFormulario);
});

