<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PIZZAZ</title>
    <!-- Incluye el script de PayPal SDK -->
    <script src="https://www.paypal.com/sdk/js?client-id=AdFPplIPFg138swlDUyjGDo4pUZ_1eGf50WM9pOwkLwpqu0XOiUWOJGdSx7d-SLCX5UZNwTN6kQBws9I&currency=USD"></script>
</head>
<body>
    <div id="paypal-button-container"></div>
    <script>
        // Inicializa los botones de PayPal
        paypal.Buttons({
            style: {
                color: 'blue',
                shape: 'pill',
                label: 'pay'
            },
            // Función para crear una orden
            createOrder: function (data, actions) {
                return actions.order.create({
                    purchase_units: [{ amount: { value: 20 } }]
                });
            },
            // Función que se ejecuta cuando se aprueba el pago
            onApprove: function (data, actions) {
                // Captura la orden y muestra detalles
                actions.order.capture().then(function (detalles) {
                    console.log(detalles);
                    alert("Gracias por su compra");
                    window.location.href = '../pizzas.php';
                })
            },
            // Función que se ejecuta cuando se cancela el pago
            onCancel: function (data) {
                alert("Pago cancelado!");
                console.log(data);
            }
        }).render('#paypal-button-container');
    </script>
</body>
</html>
