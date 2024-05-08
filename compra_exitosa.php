<?php
require 'database.php';
require 'includes/header.php';

// Consulta para obtener los datos de la última venta realizada por el usuario actual
$query = $conn->prepare("SELECT venta.*, articulos.Nombre AS NombreArticulo, metodopago.tipo AS TipoPago, metodopago.Caducidad AS CaducidadPago FROM venta
                        INNER JOIN articulos ON venta.Articulos_idArticulos = articulos.idArticulos
                        INNER JOIN metodopago ON venta.metodoPago_idPago = metodopago.idMetodoPago
                        WHERE venta.Usuario_idUsuario = ? ORDER BY Fecha DESC LIMIT 1");
$query->execute([$_SESSION['idUsuario']]);
$venta = $query->fetch(PDO::FETCH_ASSOC);

if ($venta) {
    // Mostrar los datos de la venta en un contenedor Bootstrap
    ?>
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <h2>Compra exitosa</h2>
                <p>¡Gracias por tu compra!</p>
                <ul class="list-group">
                    <li class="list-group-item"><strong>Fecha:</strong> <?php echo $venta['Fecha']; ?></li>
                    <li class="list-group-item"><strong>Artículo:</strong> <?php echo $venta['NombreArticulo']; ?></li>
                    <li class="list-group-item"><strong>Monto:</strong> $<?php echo $venta['monto']; ?></li>
                    <li class="list-group-item"><strong>Status:</strong> <?php echo $venta['status']; ?></li>
                    <li class="list-group-item"><strong>Método de pago:</strong> <?php echo $venta['TipoPago']; ?></li>
                    <li class="list-group-item"><strong>Caducidad:</strong> <?php echo $venta['CaducidadPago']; ?></li>
                </ul>
            </div>
        </div>
    </div>
    <?php
} else {
    // Si no se encuentra ninguna venta, mostrar un mensaje de error
    echo "No se encontraron datos de compra.";
}
?>
