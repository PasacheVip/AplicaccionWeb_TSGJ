
/* global Swal */

function validarFormulario(evento) {
    evento.preventDefault();

    // Select Categoria
    var categoria = document.querySelector('select[name="tipo_Categoria"]').value;
    if (categoria.length === 0) {
        Swal.fire({
            width: '23rem',
            position: 'center',
            icon: 'info',
            title: 'Por favor, Seleccione la Categoria del Suministro',
            showConfirmButton: false,
            timer: 1500
        });
        return;
    }

    // Select Unidad de Medida
    var unidad_Medida = document.querySelector('select[name="tipo_presentacion"]').value;
    if (unidad_Medida.length === 0) {
        Swal.fire({
            width: '23rem',
            position: 'center',
            icon: 'info',
            title: 'Por favor, Seleccione una Unidad de Medida.',
            showConfirmButton: false,
            timer: 1500
        });
        return;
    }

    // Select Proveedor
    var proveedor = document.querySelector('select[name="proveedor"]').value;
    if (proveedor.length === 0) {
        Swal.fire({
            width: '23rem',
            position: 'center',
            icon: 'info',
            title: 'Por favor, Seleccione un Proveedor.',
            showConfirmButton: false,
            timer: 1500
        });
        return;
    }

    // Input Codigo Producto
    var codigo_producto = document.getElementById('codigo_producto').value;
    if (codigo_producto.length === 0) {
        Swal.fire({
            width: '22rem',
            position: 'center',
            icon: 'info',
            title: 'Por favor, Ingrese el Codigo del Producto.',
            showConfirmButton: false,
            timer: 1500
        });
        return;
    } 
    // else if (codigo_producto.length !== 10 || isNaN(codigo_producto)) {
    //     Swal.fire({
    //         width: '22rem',
    //         position: 'center',
    //         icon: 'info',
    //         title: 'Por favor, Ingrese un Codigo Válido (10 dígitos)',
    //         showConfirmButton: false,
    //         timer: 1500
    //     });
    //     return;
    // }
    
    // Input Nombre del Producto
    var nombre_producto = document.getElementById('nombre_producto').value;
    if (nombre_producto.length === 0) {
        Swal.fire({
            width: '23rem',
            position: 'center',
            icon: 'info',
            title: 'Por favor, Ingrese el Nombre del Producto.',
            showConfirmButton: false,
            timer: 1500
        });
        return;
    }

        // Input Precio Producto
        var precio_producto = document.getElementById('precio_producto').value;
        if (precio_producto.length === 0) {
            Swal.fire({
                width: '22rem',
                position: 'center',
                icon: 'info',
                title: 'Por favor, Ingrese el Precio del Producto.',
                showConfirmButton: false,
                timer: 1500
            });
            return;
        } 
        // else if (precio_producto.length !== 10 || isNaN(precio_producto)) {
        //     Swal.fire({
        //         width: '22rem',
        //         position: 'center',
        //         icon: 'info',
        //         title: 'Por favor, Ingrese un Precio Válido (10 dígitos)',
        //         showConfirmButton: false,
        //         timer: 1500
        //     });
        //     return;
        // }

        // Input Cantidad Producto
        var stock_producto = document.getElementById('stock_producto').value;
        if (stock_producto.length === 0) {
            Swal.fire({
                width: '22rem',
                position: 'center',
                icon: 'info',
                title: 'Por favor, Ingrese la Cantidad del Producto.',
                showConfirmButton: false,
                timer: 1500
            });
            return;
        } 
        // else if (stock_producto.length !== 10 || isNaN(stock_producto)) {
        //     Swal.fire({
        //         width: '22rem',
        //         position: 'center',
        //         icon: 'info',
        //         title: 'Por favor, Ingrese una Cantidad Válida (10 dígitos)',
        //         showConfirmButton: false,
        //         timer: 1500
        //     });
        //     return;
        // }

    this.submit();
}

document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('Agregar_Suministro').addEventListener('submit', validarFormulario);
});

