<?php
require 'database.php';
session_start();
// Verificar si se han enviado los datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $idArticulo = $_POST["idArticulo"];
    $idyo = $_SESSION["idUsuario"]; // Asumiendo que ya tienes la sesión iniciada
    $idvendedor = ""; // No se está utilizando actualmente, puedes eliminar esta línea si no es necesaria
    $metodoPago_idPago = $_POST['metodoPago']; // Método de pago por defecto

    // Obtener la fecha actual
    $fecha = date("Y-m-d H:i:s");

    // Consultar el precio del artículo
    $query = $conn->prepare("SELECT Precio FROM articulos WHERE idArticulos = ?");
    $query->execute([$idArticulo]);
    $precio = $query->fetchColumn(); // Obtiene el valor de la columna Precio

    // Insertar la venta en la tabla
    $query = $conn->prepare("INSERT INTO venta (Fecha, monto, status, Usuario_idUsuario, Articulos_idArticulos, metodoPago_idPago) VALUES (?, ?, 'Pendiente', ?, ?, ?)");
    $query->execute([$fecha, $precio, $idyo, $idArticulo, $metodoPago_idPago]);

    // Redireccionar o mostrar un mensaje de éxito
    // Por ejemplo, redireccionar a una página de confirmación
    header("Location: compra_exitosa.php");
    exit(); // Finalizar el script para prevenir ejecución adicional
} else {
    // Si no se envían los datos del formulario, redireccionar o mostrar un mensaje de error
    echo "Error: No se han recibido los datos del formulario.";
}
?>
