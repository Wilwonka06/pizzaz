document.addEventListener("DOMContentLoaded", function () {
    // Botón para abrir el modal
    var openButton = document.getElementById("openCart");
    // Modal
    var modal = document.getElementById("cartModal");
    // Botón para cerrar el modal
    var closeButton = document.getElementById("closeCart");

    openButton.onclick = function () {
        modal.style.display = "block";
        // Lógica para mostrar los elementos del carrito y calcular el total
        // Puedes usar JavaScript para obtener los elementos del carrito y mostrarlos en la lista "#cartItems" y calcular el total.
    };

    closeButton.onclick = function () {
        modal.style.display = "none";
    };
});
