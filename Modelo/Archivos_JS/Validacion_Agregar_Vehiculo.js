/* global Swal */

function validarFormulario(evento) {
    evento.preventDefault();

    // Input Placa
    var placa = document.getElementById('placa').value;
    if (placa.length === 0) {
        Swal.fire({
            width: '23rem',
            position: 'center',
            icon: 'info',
            title: 'Por favor, Ingrese una Placa',
            showConfirmButton: false,
            timer: 1500
        });
        return;
    }

    // Input Año
    var año = document.getElementById('año').value;
    if (año.length === 0) {
        Swal.fire({
            width: '22rem',
            position: 'center',
            icon: 'info',
            title: 'Por favor, Ingrese un Año',
            showConfirmButton: false,
            timer: 1500
        });
        return;
    } else if (año.length !== 4 || isNaN(año)) {
        Swal.fire({
            width: '22rem',
            position: 'center',
            icon: 'info',
            title: 'Por favor, Ingrese un Año Válido (4 dígitos)',
            showConfirmButton: false,
            timer: 1500
        });
        return;
    }

    // Input Marca
    var marca = document.getElementById('marca').value;
    if (marca.length === 0) {
        Swal.fire({
            width: '23rem',
            position: 'center',
            icon: 'info',
            title: 'Por favor, Ingrese una Marca',
            showConfirmButton: false,
            timer: 1500
        });
        return;
    }

    // Input Marca
    var modelo = document.getElementById('modelo').value;
    if (modelo.length === 0) {
        Swal.fire({
            width: '23rem',
            position: 'center',
            icon: 'info',
            title: 'Por favor, Ingrese un Modelo',
            showConfirmButton: false,
            timer: 1500
        });
        return;
    }

    // Select Tipo de Vehículo
    var tipoVehiculo = document.querySelector('select[name="tipo_vehiculo_id"]').value;
    if (tipoVehiculo.length === 0) {
        Swal.fire({
            width: '23rem',
            position: 'center',
            icon: 'info',
            title: 'Por favor, Seleccione un Tipo de Vehículo',
            showConfirmButton: false,
            timer: 1500
        });
        return;
    }

    // Select Tipo de Combustible
    var tipoCombustible = document.querySelector('select[name="tipo_combustible_id"]').value;
    if (tipoCombustible.length === 0) {
        Swal.fire({
            width: '23rem',
            position: 'center',
            icon: 'info',
            title: 'Por favor, Seleccione un Tipo de Combustible',
            showConfirmButton: false,
            timer: 1500
        });
        return;
    }

    this.submit();
}

document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('Registrar_Flota').addEventListener('submit', validarFormulario);
});
