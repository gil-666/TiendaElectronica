<?php
require 'database.php';
require 'includes/header.php';

// Consulta para obtener los datos de la última venta realizada por el usuario actual

$query = $conn->prepare("SELECT venta.*,  articulos.Nombre AS NombreArticulo, metodopago.tipo AS TipoPago, metodopago.Caducidad AS CaducidadPago FROM venta
                        INNER JOIN articulos ON venta.Articulos_idArticulos = articulos.idArticulos
                        INNER JOIN metodopago ON venta.metodoPago_idPago = metodopago.idMetodoPago
                        WHERE venta.Usuario_idUsuario = ? ORDER BY Fecha DESC LIMIT 1");
$query->execute([$_SESSION['idUsuario']]);
$venta = $query->fetch(PDO::FETCH_ASSOC);

$query = $conn->prepare("SELECT Stock FROM articulos WHERE idArticulos = ?");
$query->execute([$venta['Articulos_idArticulos']]);
$stockarticulo = $query->fetch(PDO::FETCH_ASSOC);

if($stockarticulo['Stock'] <=1){//si solo hay 1 unidad del articulo, se marca como agotado
    $query = $conn->prepare("UPDATE articulos SET Estado = 'Agotado' WHERE idArticulos = ?");
$query->execute([$venta['Articulos_idArticulos']]);
}elseif($stockarticulo['Stock'] >1){//si hay mas de 1 unidad del articulo, se resta del Stock disponible
    $query = $conn->prepare("UPDATE articulos SET Stock = Stock - 1 WHERE idArticulos = ?");
    $query->execute([$venta['Articulos_idArticulos']]);
}


$query = $conn->prepare("SELECT usuario.Nombre FROM usuario JOIN articulos ON articulos.usuario_idVendedor = idUsuario WHERE articulos.idArticulos = ?");
        // Ejecutar la consulta con el ID del artículo
        $query->execute([$venta['Articulos_idArticulos']]);
        // Obtener el resultado de la consulta
        $nombrevendedor = $query->fetch(PDO::FETCH_ASSOC);

if ($venta) {
    // Mostrar los datos de la venta en un contenedor Bootstrap
    ?>
    <br>
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <h2>Compra exitosa</h2>
                <p>¡Gracias por tu compra!</p><br>
                <p class="text-center" style="color: black;">Detalles de la venta:</p>
                <ul class="list-group">
                    <li class="list-group-item"><strong>Fecha:</strong> <?php echo $venta['Fecha']; ?></li>
                    <li class="list-group-item"><strong>Artículo:</strong> <?php echo $venta['NombreArticulo']; ?></li>
                    <li class="list-group-item"><strong>Monto:</strong> $<?php echo $venta['monto']; ?></li>
                    <li class="list-group-item"><strong>Vendido por:</strong> <?php echo $nombrevendedor['Nombre']; ?></li>
                    <li class="list-group-item"><strong>Status:</strong> <?php echo $venta['status']; ?></li>
                    <li class="list-group-item"><strong>Método de pago:</strong> <?php echo $venta['TipoPago']; ?></li>
                    <li class="list-group-item"><strong>Caducidad:</strong> <?php echo $venta['CaducidadPago']; ?></li><br> 
                    <div class="text-center">
                        <a href="articulos.php" class="btn btn-primary hover">Seguir comprando</a>
                    </div>
                    
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
