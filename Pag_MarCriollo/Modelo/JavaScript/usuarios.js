function eliminarUsuarios(botón) {
    // Obtener la fila seleccionada
    var fila = botón.parentNode.parentNode;

    // Eliminar la fila
    fila.parentNode.removeChild(fila);

    // Actualizar la sesión
    var lista = [];
    for (var i = 0; i < $_SESSION["dato"].length; i++) {
        if ($_SESSION["dato"][i]['id'] !== fila.cells[0].textContent) {
            lista.push($_SESSION["dato"][i]);
        }
    }
    $_SESSION["dato"] = lista;

    // Mostrar un mensaje de éxito
    alert("Usuario eliminado con éxito");
}