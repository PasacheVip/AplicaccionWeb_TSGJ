



/* Funcion para convertir lo ingreso por el usario, automaticamente a mayuscula de un INPUT TYPE "TEXT"
 * - <input type="text" onkeyup="convertirAMayusculas(this)"> Sintaxis HTML */

function convertirAMayusculas(input) {
    input.value = input.value.toUpperCase();
}

/* Funcion para limitar el numero de digitos de un INPUT TYPE "NUMBER"
 * - <input type="number" oninput="limitarDigitos(this, 11)"> Sintaxis HTML */
function limitarDigitos(input, maxDigitos) {
    if (input.value.length > maxDigitos) {
        input.value = input.value.slice(0, maxDigitos); // Trunca el valor a la cantidad máxima de dígitos permitidos
    }
}

/* Funcion para limitar el numero de digitos de un INPUT TYPE "NUMBER"
 * - <input type="text" oninput="limitarLetras(this, 10)"> Sintaxis HTML */
function limitarLetras(input, maxLetras) {
    if (input.value.length > maxLetras) {
        input.value = input.value.slice(0, maxLetras); // Trunca el valor a la cantidad máxima de letras permitidas
    }
}

