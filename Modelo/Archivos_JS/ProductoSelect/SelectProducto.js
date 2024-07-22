function agregarProducto() {

    var select = document.getElementById("productos");
    var selectedOption = select.options[select.selectedIndex];

    if (selectedOption.value !== "") {

        var selectedList = document.getElementById("productosSeleccionados");

        // Verificar si el producto ya ha sido agregado
        var items = selectedList.getElementsByTagName("li");
        for (var i = 0; i < items.length; i++) {
            if (items[i].dataset.id == selectedOption.value) {
                // Mostrar los datos en una alerta
                Swal.fire({
                    width: '20rem',
                    position: 'center',
                    icon: 'warning',
                    text: 'Este producto ya ha sido seleccionado.',
                    showConfirmButton: false,
                    timer: 1500
                });
                return;
            }
        }

        // Crear un nuevo elemento de lista con el producto seleccionado
        var li = document.createElement("li");
        li.textContent = selectedOption.text + " - ";

        // Crear un campo de entrada numérico para la cantidad
        var cantidadInput = document.createElement("input");
        cantidadInput.type = "number";
        cantidadInput.name = "cantidadesSeleccionadas[]";
        cantidadInput.min = 1;
        cantidadInput.value = 1; // Valor por defecto
        cantidadInput.style.width = "40px";
        cantidadInput.style.marginRight = "10px"; // Espacio entre cantidad y botón eliminar

        li.dataset.id = selectedOption.value;
        li.appendChild(cantidadInput);

        // Crear un botón para eliminar el producto seleccionado
        var removeButton = document.createElement("button");
        removeButton.textContent = "Eliminar";
        removeButton.className = "remove-button";
        removeButton.onclick = function () {
            li.remove();
            actualizarProductosSeleccionados();
        };

        li.appendChild(removeButton);
        selectedList.appendChild(li);
        actualizarProductosSeleccionados();

    }
}

function actualizarProductosSeleccionados() {

    var selectedList = document.getElementById("productosSeleccionados");
    var selectedInputs = document.getElementById("productosSeleccionadosInputs");

    selectedInputs.innerHTML = ""; // Limpiar campos ocultos
    
    var items = selectedList.getElementsByTagName("li");

    for (var i = 0; i < items.length; i++) {
        var input = document.createElement("input");
        input.type = "hidden";
        input.name = "productosSeleccionados[]";
        input.value = items[i].dataset.id;
        selectedInputs.appendChild(input);

        // Añadir el campo oculto para la cantidad
        var cantidadInput = document.createElement("input");
        cantidadInput.type = "hidden";
        cantidadInput.name = "cantidadesSeleccionadas[]";
        cantidadInput.value = items[i].querySelector('input[type="number"]').value;
        selectedInputs.appendChild(cantidadInput);
    }
}
