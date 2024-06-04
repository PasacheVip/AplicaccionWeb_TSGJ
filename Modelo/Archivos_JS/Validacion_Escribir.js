// Funcion para que todos los Input "TEXT", se combierte en mayuscula
function convertirAMayusculas(input) {
    input.value = input.value.toUpperCase();
}

//Funcion para limitar el numero de digitos de un INPUT TYPE "NUMBER"
function limitarDigitos(input, maxDigitos) {
    if (input.value.length > maxDigitos) {
        input.value = input.value.slice(0, maxDigitos); // Trunca el valor a la cantidad máxima de dígitos permitidos
    }
}

